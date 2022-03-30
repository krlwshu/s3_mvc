<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/loginStyle.css" />
</head>

<body>
    <div class="loginLeft">
        <div class=text>
            <h1> Design, Build, Maintain solutions for industry </h1>
        </div>
    </div>

    <div class="loginRight">
        <div class="login-container">
            <section class="Login-form">
                <h1 style="text-align:center;"> Login </h1>
                <div class="form-content">
                    <form method="post">

                        <label for="usrname">Username</label>
                        <input type="text" id="usrname" name="usrname" placeholder="Username">
                        <!-- <span class="text-danger"><?php echo $nameErr; ?></span> -->

                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="password" placeholder="Password">
                        <!-- type password shows start symbols instead of characters when use enters input -->
                        <!-- <span class="text-danger"><?php echo $pwderr; ?></span> -->

                        <!-- Temporarily disable -->
                        <!-- <button type="submit" name="submit"> Login </button> -->
                        <a name="" id="" class="btn btn-primary" href="MyTeam.php" role="button">
                            Login
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>

                        <!--<span class="text-danger"><?php echo $invalidMesg; ?></span> -->
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>