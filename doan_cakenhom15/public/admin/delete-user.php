<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['id']) == TRUE) {
    $idUser = $_GET['id'];
    $getOrder_ByCustomerId = Order::getOrder_ByCustomerId($idUser)[0]['id'];
    $getAllOrder = $orderDetail::getAllOrder();
    $flag = true;
    foreach ($getAllOrder as $item) {
        if ($item['orderid'] == $getOrder_ByCustomerId) {
            $flag = false;
        }
    }
    if ($flag == true) {
        $deleteResult = User::deleteUserByID($_GET['id']);
    } 
}
header("Location: users.php");
