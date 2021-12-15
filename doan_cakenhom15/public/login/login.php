<?php session_start();
require_once "../config.php";
require_once "../models/db.php";
require_once "../models/user.php";
$user = new User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Space Login Form Flat Responsive Widget Template :: w3layouts</title>

    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Space Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../js/jquery-3.2.1.min.js">
    <script src="../js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tag Keywords -->

    <!-- css files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- css files -->

    <!-- Online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <!-- //Online-fonts -->
    <style>
        select {
            background-color: transparent;
            border-radius: 5px;
            color: #fff;
            width: 249px;
        }

        select option {
            margin: 40px;
            background: #4c4c4a;
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>
    <!-- main -->
    <div class="main">
        <div class="main-w3l">
            <h1 class="logo-w3">Login Form or
                <span>
                    <a href="../index.php"><img src="../img/logo-2.png" alt="" style="transform: translateY(10px);">
                    </a>
                </span>
            </h1>
            <div class="w3layouts-main">
                <h2><span>Login now</span></h2>

                <?php
                if (isset($_GET['register'])) {
                    $register = $_GET['register'];
                    if ($register == 1) {
                        echo "<h3 class='text-success'>Success Register</h3>";
                    } else {
                        echo "<h3 class='text-danger'>Fail Register</h3>";
                    }
                } else if (isset($_GET['login'])) {
                    $login = $_GET['login'];
                    if ($login == -1) {
                        echo "<h3 class='text-danger'>Fail Login</h3>";
                    }
                } else {
                    echo "<h3>---</h3>";
                }


                ?>
                <form action="./check-login-register.php" method="POST">
                    <?php
                    if (isset($_GET['id'])) {
                        $idUser = $_GET['id'];
                        $username = User::getUserName($idUser)['username'];
                        echo "<input placeholder='Username or Email' name='username' type='text' required='' value='$username'>";
                    } else {
                        echo '<input placeholder="Username or Email" name="username" type="text" required="">';
                    }
                    ?>
                    <input placeholder="Password" name="password" type="password" required="">
                    <br>
                    <select name="permission" id="permission">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div style="text-align: center; color: red;">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                        }
                        unset($_SESSION['error']); ?>

                    </div>
                    <input type="submit" value="Signin" name="login">
                    <button type="button" data-toggle="modal" class="btn btn-outline-success rounded-pill" data-target="#exampleModal" id="register">
                        Register New Account
                    </button>
                </form>
            </div>
            <div class="register">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-success">
                            <div class="modal-header">
                                <h5 class="modal-title text-white" id="exampleModalLabel">User Register</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p">
                                <form action="./check-login-register.php" method="POST">
                                    <input placeholder="Username or Email" name="username" type="text" required="">
                                    <input placeholder="Password" name="password" type="password" required="">
                                    <input placeholder="Confirm Password" name="password2" type="password" required="">
                                    <input type="submit" value="register" name="register">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //main -->

            <!--footer-->
            <div class="footer-w3l">
                <p>&copy; 2017 Space Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
            <!--//footer-->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        const btnRegister = document.querySelector('#register');
        const productModelId = document.querySelector('#exampleModal');
        btnRegister.addEventListener('click', function() {
            const myModal = new bootstrap.Modal(productModelId);
            myModal.show();
        });
    </script>
</body>

</html>