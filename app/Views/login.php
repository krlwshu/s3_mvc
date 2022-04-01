<!DOCTYPE html>
<html lang="en">


<head>
    <link rel="shortcut icon" href="./assets/img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/loginStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>



<body class="animate__animated animate__fadeIn">
    <div class="wrapper">
        <div class="loginLeft">
            <img class="bg-img" src="<?= base_url()?>/assets/img/header-image-2-1024x683-1.jpg" alt="">
        </div>
        <div class="loginLeft">
            <div class="slogan animate__animated animate__fadeInUp animate__delay-1s">
                <h1> Design, Build, Maintain solutions for industry </h1>
            </div>
        </div>
        <div class="loginRight">
            <img class="bg-img" src="https://www.actemium.com/app/uploads/sites/4/2021/02/market-segments-bg-2.jpg"
                alt="">
        </div>

        <div class="loginRight ">
            <div class="login-container">

                <section class="Login-form">
                    <div class="logo-container">
                        <img style="height: 100%; " src="<?= base_url()?>/assets/img/brand_logo_only.svg" alt="">
                        <h1>Actemium</h1>
                    </div>

                    <div class="form-content">
                        <h2></h2>

                        <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                        <?php endif;?>
                        <form action="<?php echo base_url(); ?>/LoginController/loginAuth" method="post">
                            <div class="form-group mb-3">
                                <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>