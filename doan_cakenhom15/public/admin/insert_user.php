<?php
require_once 'header-require-models.php';
?>
<?php
$insertResult = -1;
if (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['password2']) && isset($_GET['permission'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $confirm_Password = $_GET['password2'];
    $permission = $_GET['permission'];
    if ($password == $confirm_Password) {
        $getAllUser = User::getAllUsers();
        $flag = true;
        foreach ($getAllUser as $value) {
            if ($value['username'] == $username) {
                $flag = false;
            }
        }
        if ($flag == true) {
            $insertResult = User::insertUser($_GET['username'], md5($_GET['password']), $_GET['permission']);
        }
        header("Location: form.php?functionType=users&insertResult=$insertResult");
    }
} else {
    header('location:./users.php');
}