<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    session_destroy();
    header('location:./login.php');
} else {
    header('location:./login.php');
}
