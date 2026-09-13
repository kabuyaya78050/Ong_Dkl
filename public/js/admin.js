const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.querySelector('.admin-sidebar');

if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });
}