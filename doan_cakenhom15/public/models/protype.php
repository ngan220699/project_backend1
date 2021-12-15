<?php
class Protype extends Db
{



    /**____________________________________________________________________________________________________
     * LẤY DỮ LIỆU BẢNG protypes:
     */
    //Lấy danh sách tất cả protype:
    static function getAllProtypes()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy danh sách tất cả protype và Phân trang:
    static function getAllProtypes_andCreatePagination($page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM protypes order by type_id desc LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * LẤY type_name CỦA protype THEO type_id (Smartphone, Laptop,...):
     */
    static function getTypeName($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_id = ?");
        $sql->bind_param("i", $type_id);
        $sql->execute();
        $type = $sql->get_result()->fetch_assoc();
        return $type['type_name'];
    }



    /**____________________________________________________________________________________________________
     * XÓA protype THEO type_id:
     */
    static function deleteProtype_ByTypeID($type_id)
    {
        $sql = self::$connection->prepare("DELETE FROM protypes WHERE type_id = ?");
        $sql->bind_param("i", $type_id);
        $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * THÊM protype:
     */
    static function insertProtype($type_name)
    {
        $sql = self::$connection->prepare("INSERT INTO protypes(type_id, type_name) VALUES(0, '$type_name')");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * SỬA protype:
     */
    static function updateProtype($type_id, $type_name)
    {
        $sql = self::$connection->prepare("UPDATE protypes SET type_name='$type_name' WHERE type_id=$type_id");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * PAGINATE: ĐÁNH SỐ TRANG, TẠO LINK TỚI CÁC TRANG.
     */
    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset)
    {
        $totalLinks = ceil(floatval($totalResults) / floatval($resultsPerPage));
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
        if ($page > 1) {
            $prev = $page - 1;
            $prevLink = "<a style=\"padding:10px;\" href='$url" . "page=$prev'>< Previous</a>";
            $firstLink = "<a style=\"padding:10px;\" href='$url" . "page=1'><< First</a>";
        }
        if ($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<a style=\"padding:10px;\" href='$url" . "page=$next'>Next ></a>";
            $lastLink = "<a style=\"padding:10px;\" href='$url" . "page=$totalLinks'>Last >></a>";
        }
        // $links:
        for ($i = $from; $i <= $to; $i++) {
            if ($page == $i) {
                $links = $links . "<a style=\"padding:10px;text-decoration:underline;color:red;font-weight:bold;\" href='$url" . "page=$i'>$i</a>";
            } else {
                $links = $links . "<a style=\"padding:10px;\" href='$url" . "page=$i'>$i</a>";
            }
        }
        return $firstLink . $prevLink . $links . $nextLink . $lastLink;
    }

    static function searchProtype($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_name like '%$keyword%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function searchProtype_andCreatePagination($keyword, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_name like '%$keyword%' LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
}
