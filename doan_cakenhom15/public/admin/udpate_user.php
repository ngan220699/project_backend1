<?php
require_once 'header-require-models.php';
?>
<?php
$updateResult = -1;
if (isset($_GET['id']) && isset($_GET['username']) && isset($_GET['newpassword']) && isset($_GET['password2']) && isset($_GET['password']) && isset($_GET['permission'])) {
    echo "True";
    $id = $_GET['id'];
    $username = $_GET['username'];
    $old_Password = $_GET['password'];
    $new_Password = str_replace(" ", "", $_GET['newpassword']);
    $confirm_Password = $_GET['password2'];
    $permission = $_GET['permission'];
    if (empty($new_Password)) {
        $getAllUser = User::getAllUsers();
        $flag = true;
        foreach ($getAllUser as $value) {
            if ($value['username'] == $username) {
                $flag = false;
            }
        }
        if ($flag == true) {
            $updateResult = User::updateUser($id, $username, $old_Password, $permission);
        }
        header("Location: form_update.php?functionType=user&id=" . $_GET['id'] . "&updateResult=$updateResult");
    } else {
        if ($new_Password == $confirm_Password) {
            $updateResult = User::updateUser($id, $username, md5($new_Password), $permission);
        }
        header("Location: form_update.php?functionType=user&id=" . $_GET['id'] . "&updateResult=$updateResult");
    }
} else {
    header('location:./users.php');
}
