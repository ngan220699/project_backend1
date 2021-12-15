<?php
class OrderDetail extends Db
{
    static function getAllOrder()
    {
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    static function getOrder_ByOrderId($orderId)
    {
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail WHERE orderid = ?");
        $sql->bind_param('i', $orderId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    
    static function getOrder_Product($productId, $orderId)
    {
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail WHERE productid = ? AND orderid = ?");
        $sql->bind_param('ii', $productId, $orderId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function insertOrder($orderId, $productId, $quantity, $price)
    {
        $sql = self::$connection->prepare("INSERT INTO ordersdetail(orderid, productid, quantity, price) VALUES (?,?,?,?)");
        $sql->bind_param('iiii', $orderId, $productId, $quantity, $price);
        return $sql->execute();
    }

    static function updateCart($orderId, $productId, $quantity, $price)
    {
        $sql = self::$connection->prepare("UPDATE ordersdetail SET quantity = $quantity, price = $price WHERE productid = $productId AND orderid = $orderId");
        return $sql->execute();
    }

    static function removeProduct_ById($orderId, $productId)
    {
        $sql = self::$connection->prepare("DELETE FROM ordersdetail WHERE productid = $productId AND orderid = $orderId");
        return $sql->execute();
    }

    static function removeAll()
    {
        $sql = self::$connection->prepare("DELETE FROM ordersdetail");
        return $sql->execute();
    }
}
