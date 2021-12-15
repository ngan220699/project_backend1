<?php

require_once 'header-require-models.php';

if (isset($_GET['messageid'])) {
    $messageId = $_GET['messageid'];
    if (isset($_GET['id']) && isset($_GET['qty'])) {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        if ($id[0] == 'c' || $id[0] == 'u') {
            $newId = substr($id, 1, strlen($id));
            switch ($id[0]) {
                case 'c':
                    $getOrder_ByProductId = OrderDetail::getOrder_Product($newId, $messageId);
                    if (count($getOrder_ByProductId) != 0) {
                        $orderId = $getOrder_ByProductId[0]['orderid'];
                        $productId = $getOrder_ByProductId[0]['productid'];
                        $receipt = Product::getProduct_ByID($productId)[0]['receipt'];
                        if ($qty < $receipt) {
                            $removeProduct_ById = OrderDetail::removeProduct_ById($orderId, $productId);
                        }
                    }
                    header('location:./message.php?message=' . $messageId);
                    break;
                case 'u':
                    echo '<script language="javascript">';
                    echo 'alert("UnCheck And Send Email To Customer")';
                    echo '</script>';
                    break;
                default:
                    break;
            }
        }
    } else {
        $removeAll_ByOrderId = OrderDetail::removeAll_ByOrderId($messageId);
        $listMessage  = [];
        $allOrder = OrderDetail::getAllOrder();
        $idOrder =  $allOrder[0]['orderid'];
        foreach ($allOrder as $key => $value) {
            if ($value['orderid'] == $idOrder) {
                if (in_array($value['orderid'], $listMessage)) {
                    continue;
                } else {
                    array_push($listMessage, $idOrder);
                }
            } else {
                $idOrder = $value['orderid'];
                if (in_array($value['orderid'], $listMessage)) {
                    continue;
                } else {
                    array_push($listMessage, $idOrder);
                }
            }
        }
        header('location:./message.php?message=' . $listMessage[0]);
    }
}
