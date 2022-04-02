<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineer Appraisal System</title>
    <link rel="shortcut icon" href="<?= base_url()?>/assets/img/favicon.ico">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="<?= base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= base_url();?>/assets/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?= base_url();?>/assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?= base_url();?>/assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet'
        media='print'>

    <link href="<?= base_url();?>/assets/css/animate.css" rel="stylesheet">
    <link href="<?= base_url();?>/assets/css/style_theme.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= site_url();?>assets/css/style.css">

</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
            <h4 class="nav-title">Engineer Appraisal System</h4>
        </div>
        <div class="header_img">
            <img src="<?= base_url();?>assets/img/avatars/john-engineer.jpg" alt="" />
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
        <?php
            // Set Active Tab
            $uri = service('uri');
            $activePage = $uri->getSegment(1);
        ?>
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">

                    <div style="height:15px">
                        <img style="height: 100%; " src="<?= base_url()?>/assets/img/brand_logo_only.svg" alt="">
                        <span class="nav_logo-name">Actemium</span>
                    </div>
                </a>

                <div class="nav_list">
                    <?php if ($_SESSION['role'] == "pm") {
                    // PM linkgs    
                    ?>
                    <a href="<?=base_url()?>/PmDash" class="nav_link <?= ($activePage == "PmDash" ? "active": "")?>">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>

                    <a href="<?=base_url()?>/Analysis"
                        class="nav_link <?= ($activePage == "Analysis" ? "active": "")?>">
                        <i class='bi bi-search nav_icon'></i>
                        <span class="nav_name">Analysis</span>
                    </a>

                    <?php } elseif ($_SESSION['role'] == "eng") {?>

                    <a href="<?=base_url()?>/EngDash" class="nav_link <?= ($activePage == "EngDash" ? "active": "")?>">
                        <i class='bi bi bi-person nav_icon'></i>
                        <span class="nav_name">My Dashboard</span>
                    </a>

                    <?php } ?>

                </div>
            </div>
            <a href="<?= base_url()?>/LoginController/Logout" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>

    <!-- Notify -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>