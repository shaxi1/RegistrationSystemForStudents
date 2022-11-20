// open hide sidebar | there is extra menu icon for smaller devices

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");

function sidebarOpen() {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar-responsive");
        sidebarOpen = true;
    }
}

function sidebarClose() {
    if (sidebarOpen) {
        sidebar.classList.remove("sidebar-responsive");
        sidebarOpen = false;
    }
}