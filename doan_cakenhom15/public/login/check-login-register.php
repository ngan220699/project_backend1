<?php
session_start();
include_once "../config.php";
include_once "../models/db.php";
include_once "../models/user.php";
include_once "../models/order.php";
$userInfo = new User();
if (isset($_POST['login'])) {
    $login = -1;
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['permission'])) {
        $getUserLogin = User::getUserLogin($_POST['username'], $_POST['permission']);
        if (count($getUserLogin) != 0) {
            if ($getUserLogin[0]['password'] == md5($_POST['password'])) {
                if ($getUserLogin[0]['permission'] == "Admin") {
                    $_SESSION['isLogin']["Admin"] = $getUserLogin[0]['id'];
                    header('location:../admin/index.php');
                }
                if ($getUserLogin[0]['permission'] == "User") {
                    $_SESSION['isLogin']["User"] = $getUserLogin[0]['id'];
                    header('location:../index.php');
                }
            } else {
                header('location:./login.php?login='.$login);
            }
        } else {
            header('location:./login.php?login='.$login);
        }
    }
} else if (isset($_POST['register'])) {
    $register = -1;
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_Password = $_POST['password2'];
        $flag = true;
        $validUsername = checkUsername($username);
        if ($validUsername !== true) {
            $flag = false;
        }
        $validPassword = checkPassword($password);
        if ($validPassword !== true) {
            $flag = false;  
        }
        if ($password == $confirm_Password) {
            $getAllUser = User::getAllUsers();
            foreach ($getAllUser as $key) {
                if ($key['username'] == $username) {
                    $flag = false;
                }
            }
            if ($flag == true) {
                $insertUser = User::insertUser($username, md5($password), 'User');
                if ($insertUser) {
                    $getUserLogin = User::getUserLogin($username, 'User');
                    if (count($getUserLogin) != 0) {
                        $getOrder_ByCustomerId = Order::getOrder_ByCustomerId($getUserLogin[0]['id']);
                        if (count($getOrder_ByCustomerId) == 0) {
                            $register = Order::insertOrder($getUserLogin[0]['id']);
                        }
                    }
                }
            }
        }
        $idUser = Order::getOrder_ByCustomerId(User::getUserLogin($username, 'User')[0]['id']);
        header('location:./login.php?register='.$register.'&id='.$idUser[0]['id']);
    } else {
        header('location:./login.php?register='.$register);
    }
}


function checkUsername($username)
{
    $username = trim($username);
    if (strlen($username) < 4) {
        return false;
    } elseif (strlen($username) > 26) {
        return false;
    } elseif (!preg_match('~^[a-z]{2}~i', $username)) {
        return false;
    } elseif (preg_match('~[^a-z0-9_.]+~i', $username)) {
        return false;
    } elseif (substr_count($username, ".") > 1) {
        return false;
    } elseif (substr_count($username, "_") > 1) {
        return false;
    }

    return true;
}

function checkPassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if (!$uppercase) {
        return false;
    } else     if (!$lowercase) {
        return false;
    } else  if (!$number) {
        return false;
    }
    return true;
}
