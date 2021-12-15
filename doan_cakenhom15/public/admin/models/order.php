<?php
class Order extends Db
{
    static function getAllOrder()
    {
        $sql = self::$connection->prepare("SELECT * FROM orders");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function getOrder_ByCustomerId($customerId)
    {
        $sql = self::$connection->prepare("SELECT * FROM orders WHERE customerid = ?");
        $sql->bind_param('i',$customerId);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function insertOrder($customerid)
    {
        $sql = self::$connection->prepare("INSERT INTO orders(customerid) VALUES (?)");
        $sql->bind_param('i',$customerid);
        return $sql->execute();
    }
}
