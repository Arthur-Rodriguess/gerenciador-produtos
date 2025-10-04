const menuIcon = document.getElementById('menu-icon');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');

menuIcon.addEventListener("click", () => {
    menuIcon.classList.toggle("show");
    sidebar.classList.toggle("show");
    mainContent.classList.toggle("aside-hidden");
})