<?php
session_start();
// Establish a database connection (Replace with your actual DB credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getaway";
// Create a connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the merchant ID from the session or URL parameters
$merchantId = 1; // Default to 1 if neither session nor URL parameter is set

// Check if the session variable 'MerchantId' is set
if (isset($_SESSION['merchant_id'])) {
    $merchantId = $_SESSION['merchant_id'];
} elseif (isset($_SESSION['tourism_officer_id'])) {
    // If session 'tourism_id' is set, get the merchant ID from the URL parameter
    $merchantId = isset($_GET['merchant_id']) ? $_GET['MerchantID'] : 1;
}
// Default filter
$filter = 'YEAR'; // Default to year, change this as needed

// Check if a filter is set and get its value
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

// Get current date information
$currentYear = date('Y');
$currentMonth = date('m');
$currentDay = date('d');

// Fetch sales data from the database based on the selected filter
$sql = '';
$bindings = array(':merchant_id' => $merchantId);

switch ($filter) {
    case 'YEAR':
        $sql = "SELECT PaymentType, COUNT(fk_ProductID) as productCount
                FROM tbl_payment
                WHERE fk_ProductID IN (
                    SELECT ProductID 
                    FROM tbl_product 
                    WHERE fk_MerchantID = :merchant_id
                )
                AND YEAR(PurchaseDate) = :current_year
                GROUP BY PaymentType";
        $bindings[':current_year'] = $currentYear;
        break;
    case 'MONTH':
        $sql = "SELECT PaymentType, COUNT(fk_ProductID) as productCount
                FROM tbl_payment
                WHERE fk_ProductID IN (
                    SELECT ProductID 
                    FROM tbl_product 
                    WHERE fk_MerchantID = :merchant_id
                )
                AND YEAR(PurchaseDate) = :current_year
                AND MONTH(PurchaseDate) = :current_month
                GROUP BY PaymentType";
        $bindings[':current_year'] = $currentYear;
        $bindings[':current_month'] = $currentMonth;
        break;
    case 'DAY':
        $sql = "SELECT PaymentType, COUNT(fk_ProductID) as productCount
                FROM tbl_payment
                WHERE fk_ProductID IN (
                    SELECT ProductID 
                    FROM tbl_product 
                    WHERE fk_MerchantID = :merchant_id
                )
                AND YEAR(PurchaseDate) = :current_year
                AND MONTH(PurchaseDate) = :current_month
                AND DAY(PurchaseDate) = :current_day
                GROUP BY PaymentType";
        $bindings[':current_year'] = $currentYear;
        $bindings[':current_month'] = $currentMonth;
        $bindings[':current_day'] = $currentDay;
        break;
    default:
        // Invalid filter, handle accordingly
        break;
}

$stmt = $conn->prepare($sql);
$stmt->execute($bindings);

$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the sales data to get the counts for each payment type
$groupedSales = [];

foreach ($sales as $sale) {
    $paymentType = $sale['PaymentType'];
    $productCount = $sale['productCount'];
    $groupedSales[$paymentType] = $productCount;
}

ksort($groupedSales);

// Fetch sales data from the database based on the selected filter (for the line chart)
$lineChartData = [];
$lineSql = "SELECT COUNT(p.fk_ProductID) as productCount, c.CAge as customerAge
            FROM tbl_payment p
            JOIN tbl_customer c ON p.fk_CustomerID = c.CustomerID
            WHERE p.fk_ProductID IN (
                SELECT ProductID 
                FROM tbl_product 
                WHERE fk_MerchantID = :merchant_id
            )";

$lineBindings = array(':merchant_id' => $merchantId); // Resetting the lineBindings

switch ($filter) {
    case 'YEAR':
        $lineSql .= " AND YEAR(p.PurchaseDate) = :current_year";
        $lineBindings[':current_year'] = $currentYear;
        break;
    case 'MONTH':
        $lineSql .= " AND YEAR(p.PurchaseDate) = :current_year AND MONTH(p.PurchaseDate) = :current_month";
        $lineBindings[':current_year'] = $currentYear;
        $lineBindings[':current_month'] = $currentMonth;
        break;
    case 'DAY':
        $lineSql .= " AND YEAR(p.PurchaseDate) = :current_year AND MONTH(p.PurchaseDate) = :current_month AND DAY(p.PurchaseDate) = :current_day";
        $lineBindings[':current_year'] = $currentYear;
        $lineBindings[':current_month'] = $currentMonth;
        $lineBindings[':current_day'] = $currentDay;
        break;
    default:
        // Invalid filter, handle accordingly
        break;
}

$lineSql .= " GROUP BY c.CAge";

$lineStmt = $conn->prepare($lineSql);
$lineStmt->execute($lineBindings); // Use the updated $lineBindings array

$lineSales = $lineStmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($lineSales as $lineSale) {
    $lineChartData[] = [
        'customerAge' => $lineSale['customerAge'],
        'productCount' => $lineSale['productCount']
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Merchant Sales Dashboard</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #filter {
            margin-bottom: 20px;
        }

        #statistics {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        #chart, #lineChart {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Merchant Sales Dashboard</h1>
        <a href="View.php">Back to List</a>
    </header>
    <div class="container">
        <div id="filter">
            <form method="get">
                <label for="filter">Select Filter:</label>
                <select name="filter" id="filter">
                    <option value="YEAR" <?php if ($filter === 'YEAR') echo 'selected'; ?>>Year</option>
                    <option value="MONTH" <?php if ($filter === 'MONTH') echo 'selected'; ?>>Month</option>
                    <option value="DAY" <?php if ($filter === 'DAY') echo 'selected'; ?>>Day</option>
                </select>
                <input type="submit" value="Apply">
            </form>
            <div id="statistics" style="margin-top: 20px;">
            <?php
    $customerCount = 0;
    $totalProductsSold = 0;
    $totalRevenue = 0;

    // Query to get the number of unique customers
    $customerQuery = "SELECT COUNT(DISTINCT fk_CustomerID) AS customerCount 
        FROM tbl_payment 
        WHERE fk_ProductID IN (SELECT ProductID FROM tbl_product WHERE fk_MerchantID = :merchant_id)";

    $bindings = array(':merchant_id' => $merchantId);
    // Update query based on filter
    switch ($filter) {
        case 'YEAR':
            $customerQuery .= " AND YEAR(PurchaseDate) = :current_year";
            $bindings[':current_year'] = $currentYear;
            break;
        case 'MONTH':
            $customerQuery .= " AND YEAR(PurchaseDate) = :current_year AND MONTH(PurchaseDate) = :current_month";
            $bindings[':current_year'] = $currentYear;
            $bindings[':current_month'] = $currentMonth;
            break;
        case 'DAY':
            $customerQuery .= " AND YEAR(PurchaseDate) = :current_year AND MONTH(PurchaseDate) = :current_month AND DAY(PurchaseDate) = :current_day";
            $bindings[':current_year'] = $currentYear;
            $bindings[':current_month'] = $currentMonth;
            $bindings[':current_day'] = $currentDay;
            break;
        default:
            break;
    }
    $customerStmt = $conn->prepare($customerQuery);
    $customerStmt->execute($bindings);
    $customerResult = $customerStmt->fetch(PDO::FETCH_ASSOC);
    if ($customerResult) {
        $customerCount = $customerResult['customerCount'];
    }

        // Statistics
        $revenueQuery = "SELECT SUM(tbl_product.ProductCost * tbl_payment.ProductAmount) AS totalRevenue 
        FROM tbl_payment 
        JOIN tbl_product ON tbl_payment.fk_ProductID = tbl_product.ProductID 
        WHERE tbl_product.fk_MerchantID = :merchant_id";

    $revenueBindings = array(':merchant_id' => $merchantId);
    // Update the query based on the filter
    switch ($filter) {
        case 'YEAR':
            $revenueQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year";
            $revenueBindings[':current_year'] = $currentYear;
            break;
        case 'MONTH':
            $revenueQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year AND MONTH(tbl_payment.PurchaseDate) = :current_month";
            $revenueBindings[':current_year'] = $currentYear;
            $revenueBindings[':current_month'] = $currentMonth;
            break;
        case 'DAY':
            $revenueQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year AND MONTH(tbl_payment.PurchaseDate) = :current_month AND DAY(tbl_payment.PurchaseDate) = :current_day";
            $revenueBindings[':current_year'] = $currentYear;
            $revenueBindings[':current_month'] = $currentMonth;
            $revenueBindings[':current_day'] = $currentDay;
            break;
        default:
            // Invalid filter, handle accordingly
            break;
    }

    $revenueStmt = $conn->prepare($revenueQuery);
    $revenueStmt->execute($revenueBindings);
    $revenueResult = $revenueStmt->fetch(PDO::FETCH_ASSOC);
    if ($revenueResult) {
        $totalRevenue = $revenueResult['totalRevenue'];
    }


    $productSoldQuery = "SELECT SUM(ProductAmount) as totalProductsSold 
    FROM tbl_payment 
    JOIN tbl_product ON tbl_payment.fk_ProductID = tbl_product.ProductID 
    WHERE tbl_product.fk_MerchantID = :merchant_id";
    
    $Soldbindings = array(':merchant_id' => $merchantId);
    // Update the query based on the filter
    switch ($filter) {
    case 'YEAR':
        $productSoldQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year";
        $Soldbindings[':current_year'] = $currentYear;
        break;
    case 'MONTH':
        $productSoldQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year AND MONTH(tbl_payment.PurchaseDate) = :current_month";
        $Soldbindings[':current_year'] = $currentYear;
        $Soldbindings[':current_month'] = $currentMonth;
        break;
    case 'DAY':
        $productSoldQuery .= " AND YEAR(tbl_payment.PurchaseDate) = :current_year AND MONTH(tbl_payment.PurchaseDate) = :current_month AND DAY(tbl_payment.PurchaseDate) = :current_day";
        $Soldbindings[':current_year'] = $currentYear;
        $Soldbindings[':current_month'] = $currentMonth;
        $Soldbindings[':current_day'] = $currentDay;
        break;
    default:
        // Invalid filter, handle accordingly
        break;
    }
    $productSoldStmt = $conn->prepare($productSoldQuery);
    $productSoldStmt->execute($Soldbindings);
    $productSoldResult = $productSoldStmt->fetch(PDO::FETCH_ASSOC);
    if ($productSoldResult) {
    $totalProductsSold = $productSoldResult['totalProductsSold'];
    }

    function getMonthName($monthNumber) {
        $monthNames = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
    
        // Subtract 1 from the monthNumber to match array index
        $monthIndex = (int)$monthNumber - 1;
    
        return isset($monthNames[$monthIndex]) ? $monthNames[$monthIndex] : '';
    }


    $productSalesSql = "SELECT MONTH(PurchaseDate) as saleMonth, tbl_product.ProductName, COUNT(tbl_payment.fk_ProductID) as productCount
                   FROM tbl_payment
                   JOIN tbl_product ON tbl_payment.fk_ProductID = tbl_product.ProductID
                   WHERE tbl_payment.fk_ProductID IN (
                       SELECT ProductID 
                       FROM tbl_product 
                       WHERE fk_MerchantID = :merchant_id
                   )
                   AND YEAR(tbl_payment.PurchaseDate) = :current_year
                   GROUP BY saleMonth, tbl_product.ProductName";

$Prodbindings = array(':merchant_id' => $merchantId, ':current_year' => $currentYear);
$productSalesStmt = $conn->prepare($productSalesSql);
$productSalesStmt->execute($Prodbindings);
$productSales = $productSalesStmt->fetchAll(PDO::FETCH_ASSOC);

// Process the product sales data
$productSalesChartData = [];
foreach ($productSales as $sale) {
    $saleMonth = getMonthName($sale['saleMonth']); // Convert numerical month to month name
    $productName = $sale['ProductName'];
    $productCount = $sale['productCount'];
    $productSalesChartData[$saleMonth][$productName] = $productCount;
}

ksort($productSalesChartData);
        ?>

<style>
    .box {
        display: inline-block;
        margin-right: 20px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* Adding shadow effect */
        background-color: #f9f9f9; /* Light background color */
    }

    /* Styles for the headings (optional) */
    h3 {
        margin-bottom: 8px;
    }

    p {
        margin: 0;
    }

    .chart-container {
        display: flex;
    }

    #chart,
    #lineChart {
        flex: 1;
        margin: 10px;
    }

    footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin: 0;
            margin-top: 100px;
        }

</style>

<div>
    <div class="box">
        <h3>Customers</h3>
        <p><?php echo $customerCount; ?></p>
    </div>

    <div class="box">
        <h3>Total Products Sold</h3>
        <p><?php echo $totalProductsSold; ?></p>
    </div>

    <div class="box">
        <h3>Total Revenue</h3>
        <p>$<?php echo number_format($totalRevenue, 2); ?></p>
    </div>
</div>
    </div>
</div>
        </div>

         <div class="chart-container">
        <div id="chart"></div>
        <div id="lineChart"></div>
    </div>
    <div id="productSalesChart"></div>
    </div>

    <script>
        // Bar chart data
        var paymentTypes = <?php echo json_encode(array_keys($groupedSales)); ?>;
        var productCounts = <?php echo json_encode(array_values($groupedSales)); ?>;
        
        var data = [{
            x: paymentTypes,
            y: productCounts,
            type: 'bar'
        }];

        var layout = {
            title: 'Merchant Sales by Payment Type',
            xaxis: { title: 'Payment Type' },
            yaxis: { title: 'Number of Products Sold' }
        };

        Plotly.newPlot('chart', data, layout);

        

        // Line chart data
        var lineData = [{
            x: <?php echo json_encode(array_column($lineChartData, 'customerAge')); ?>,
            y: <?php echo json_encode(array_column($lineChartData, 'productCount')); ?>,
            type: 'scatter',
            mode: 'lines',
            name: 'Product Count by Customer Age'
        }];

        var lineLayout = {
            title: 'Product Count by Customer Age',
            xaxis: { title: 'Customer Age' },
            yaxis: { title: 'Number of Products Sold' }
        };

        Plotly.newPlot('lineChart', lineData, lineLayout);

        var productNames = <?php echo json_encode(array_values(array_unique(array_column($productSales, 'ProductName')))); ?>;
var monthLabels = <?php echo json_encode(array_values(array_unique(array_column($productSales, 'saleMonth')))); ?>;

var productSalesData = [];

// Initialize counts array for each product
var productCounts = {};
for (var i = 0; i < productNames.length; i++) {
    productCounts[productNames[i]] = [];
}

// Populate counts array with product sales for each month
for (var j = 0; j < monthLabels.length; j++) {
    // Initialize counts for each product for the current month
    var counts = {};
    for (var i = 0; i < productNames.length; i++) {
        counts[productNames[i]] = 0;
    }

    // Update counts based on the actual product sales data
    for (var k = 0; k < <?php echo json_encode($productSales); ?>.length; k++) {
        var sale = <?php echo json_encode($productSales); ?>[k];
        if (sale['saleMonth'] === monthLabels[j]) {
            counts[sale['ProductName']] = sale['productCount'];
        }
    }

    // Push the counts for each product to the productSalesData array
    for (var i = 0; i < productNames.length; i++) {
        productCounts[productNames[i]].push(counts[productNames[i]]);
    }
}

// Create traces for each product
for (var i = 0; i < productNames.length; i++) {
    productSalesData.push({
        x: monthLabels,
        y: productCounts[productNames[i]],
        type: 'bar',
        name: productNames[i]
    });
}

var productSalesLayout = {
    title: 'Product Sales by Months',
    xaxis: {
        title: 'Month',
        type: 'category', // Set x-axis type to category
        categoryorder: 'array', // Use array order for categories
        categoryarray: monthLabels // Specify the order of categories
    },
    yaxis: { title: 'Number of Products Sold' },
    barmode: 'stack'
};

// Plot the Product Sales Chart
Plotly.newPlot('productSalesChart', productSalesData, productSalesLayout);

    </script>
    
</body>

<footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
</html>