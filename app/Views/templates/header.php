<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineer Appraisal System</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
            <h6 class="nav-title">Engineer Appraisal System</h6>
        </div>
        <div class="header_img">
            <img src="./assets/img/avatars/john-engineer.jpg" alt="" />
        </div>

        <button type="button" class="btn btn-primary position-relative">
            Inbox
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                1
                <span class="visually-hidden">unread messages</span>
            </span>
        </button>

    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">

                    <div style="height:15px">
                        <img style="height: 100%; " src="./assets/img/brand_logo_only.svg" alt="">
                        <span class="nav_logo-name">Actemium</span>
                    </div>
                </a>

                <div class="nav_list">

                    <a href="#" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="pmdash.php" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">My Team</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Notifications</span>
                    </a>

                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Analytics</span>
                    </a>

                    <a href="SearchData.php" class="nav_link">
                        <i class='bi bi-search nav_icon'></i>
                        <span class="nav_name">Search Tool</span>
                    </a>

                    <a href="engDash.php" class="nav_link">
                        <i class='bi bi-search nav_icon'></i>
                        <span class="nav_name">Engineer Dashboard</span>
                    </a>

                    <a href="histPage.php" class="nav_link">
                        <i class='bi bi-search nav_icon'></i>
                        <span class="nav_name">Historic Appraisal</span>
                    </a>
                    <a href="appraisalPage2.php" class="nav_link">
                        <i class='bi bi-search nav_icon'></i>
                        <span class="nav_name">KW TESTING</span>
                    </a>

                </div>
            </div>
            <a href="signout.php" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>

    <!-- Notify -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>