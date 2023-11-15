const openSidebarButton = document.getElementById('openSidebar');
const sidebar = document.getElementById('sidebar');

openSidebarButton.addEventListener('click', () => {
    sidebar.style.left = '0'; // Open the sidebar
});

document.addEventListener('click', (e) => {
    if (e.target !== openSidebarButton && e.target !== sidebar) {
        sidebar.style.left = '-250px'; // Close the sidebar
    }
});

sidebar.addEventListener('click', (e) => {
    e.stopPropagation(); // Prevent closing the sidebar when clicking inside it
});