<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- make it more mobile friendly -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Client Dashboard</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="css/client_dashboard.css">
</head>

<body>

    <div class="grid-container">

        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>

            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
                <div class="logout-icon" onclick="logout()">
                    <span class="material-icons-outlined">logout</span>
                </div>
                <div class="profile-icon" onclick="profilePage_redirect()">
                    <span class="material-icons-outlined">account_circle</span>
                </div>
            </div>
        </header>

        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">inventory</span> <?=$_SESSION['name']?><!--</p>-->
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">note_add</span> Enroll to class
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">stacked_bar_chart</span> Summary
                </li>
            </ul>
            
        </aside>

        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
            </div>

        </main>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/menu_dashboard.js"></script>
    <script src="js/profilePage_redirect.js"></script>
    <script src="js/logout.js"></script>
</body>

</html>