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

    static function getOrder_ByProductId($productId)
    {
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail WHERE productid = ?");
        $sql->bind_param('i', $productId);
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

    static function removeAll_ByOrderId($orderId)
    {
        $sql = self::$connection->prepare("DELETE FROM ordersdetail WHERE orderid = $orderId");
        return $sql->execute();
    }

    static function searchProduct_ByOrderId($orderId)
    {
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail WHERE orderid = $orderId");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function searchProduct_ByOrderIdAndCreatePaginate($orderId, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM ordersdetail WHERE orderid = $orderId LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset)
    {
        $totalLinks = ceil($totalResults / $resultsPerPage);
        $links = "";
        $from = $page - $offset;
        $to = $page + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if ($to > $totalLinks) {
            $to = $totalLinks;
        }
        $firstLink = "";
        $lastLink = "";
        $prevLink = "";
        $nextLink = "";
        // Trường hợp để xuất hiện $firstLink, $lastLink, $prevLink, $nextLink:
        if($page > 1) {
            $prev = $page - 1;
            $prevLink = "<a style=\"padding:10px;\" href='$url" . "page=$prev'>< Previous</a>";
            $firstLink = "<a style=\"padding:10px;\" href='$url" . "page=1'><< First</a>";
        }
        if($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<a style=\"padding:10px;\" href='$url" . "page=$next'>Next ></a>";
            $lastLink = "<a style=\"padding:10px;\" href='$url" . "page=$totalLinks'>Last >></a>";
        }
        // $links:
        for($i=$from; $i<=$to; $i++) {
            if($page == $i) {
                $links = $links . "<a style=\"padding:10px;text-decoration:underline;color:red;font-weight:bold;\" href='$url" . "page=$i'>$i</a>";
            }
            else
            {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i'>$i</a>";
            }
        }
        return $firstLink . $prevLink . $links . $nextLink . $lastLink;
    }
}
