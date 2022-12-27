<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- make it more mobile friendly -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="css/submit_button.css">
</head>

<body>

    <div class="grid-container">

        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>

            <div class="header-left">
                <!-- <span class="material-icons-outlined">search</span> -->
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
                    <span class="material-icons-outlined">inventory</span> <?=$_SESSION['name']?> <!--</p>-->
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </li>
                <li class="sidebar-list-item" onclick="openLecturerSection()">
                    <span class="material-icons-outlined">engineering</span> Dodaj Wykładowcę
                </li>
                <li class="sidebar-list-item" onclick="openClassSection()">
                    <span class="material-icons-outlined">note_add</span> Dodaj Zajęcia
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">stacked_bar_chart</span> Podsumowanie
                </li>
            </ul>

        </aside>

        <main class="main-container">
            <div class="main-title">
                <p class="font-weight-bold">DASHBOARD</p>
            </div>

            <div class="main-cards">
                <!-- TODO: add charts based on database https://www.youtube.com/watch?v=UALn3klXFBM ApexCharts -->
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">CLASSES</p>
                        <span class="material-icons-outlined text-blue">inventory_2</span>
                    </div>
                    <span class="text-primary font-weight-bold">249</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">TBE</p>
                        <span class="material-icons-outlined text-orange">add_shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold">83</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">TBE</p>
                        <span class="material-icons-outlined text-green">shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold">79</span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">ALERTS</p>
                        <span class="material-icons-outlined text-red">notification_important</span>
                    </div>
                    <span class="text-primary font-weight-bold">56</span>
                </div>

            </div>

            <div class="addClass-section">

                <form action="phpdatabase/add_class.php" method="post">
                    <div class="txt_field">
                        <input type="text" name="name" required>
                        <span></span>
                        <label>Nazwa Przedmiotu</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="departament" required>
                        <span></span>
                        <label>Wydział</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="course" required>
                        <span></span>
                        <label>Kierunek</label>
                    </div>
                    <div class="txt_field">
                        <input type="number" name="semester" min="1" max="8" onKeyDown="return false" required>
                        <span></span>
                        <label>Semestr</label>
                    </div>
                    <div class="txt_field">
                        <input type="number" name="room" required>
                        <span></span>
                        <label>Sala</label>
                    </div>
                    <div class="txt_field">
                        <input type="date" name="date" required>
                        <span></span>
                        <label>Pierwsze zajęcia</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="lecturer_surname" required>
                        <span></span>
                        <label>Nazwisko Wykładowcy</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="lecturer_name" required>
                        <span></span>
                        <label>Imię Wykładowcy</label>
                    </div>

                    <input type="submit" value="Dodaj" onMouseOver="this.style.backgroundColor='#2691d9'" onMouseOut="this.style.backgroundColor='#f1c50e'">

                </form>

            </div>
            <!-- <div class="add-class-ok"> 
                Class Added!
            </div> -->
            <div class="addLecturer-section">
                <form action="phpdatabase/add_lecturer.php" method="post">
                    <div class="txt_field">
                        <input type="text" name="name" required>
                        <span></span>
                        <label>Imię</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="surname" required>
                        <span></span>
                        <label>Nazwisko</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="degree" required>
                        <span></span>
                        <label>Stopień</label>
                    </div>

                    <input type="submit" value="Dodaj" onMouseOver="this.style.backgroundColor='#2691d9'" onMouseOut="this.style.backgroundColor='#f1c50e'">
            </div>

        </main>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/menu_dashboard.js"></script>
    <script src="js/mainSections_appear_admin.js"></script>
    <script src="js/profilePage_redirect.js"></script>
    <script src="js/logout.js"></script>
</body>

</html>