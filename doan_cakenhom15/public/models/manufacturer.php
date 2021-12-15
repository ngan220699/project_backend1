<?php
class Manufacturer extends Db {
    /**____________________________________________________________________________________________________
     * LẤY DỮ LIỆU BẢNG manufacturers :
     */
    //Lấy danh sách tất cả manufacture:
    static function getAllManufacturers() {
        $sql = self::$connection->prepare(" SELECT * FROM manufactures ");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy danh sách tất cả manufacturer và Phân trang:
    static function getAllManufacturers_andCreatePagination($page, $resultsPerPage) {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM manufactures  order by manu_id desc LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    /**____________________________________________________________________________________________________
     * LẤY Manufacturer THEO id:
     */
    static function getBrand($manu_id) {
        $sql = self::$connection->prepare("SELECT * FROM manufactures  WHERE manu_id = ?");
        $sql->bind_param("i", $manu_id);
        $sql->execute();
        $brand = $sql->get_result()->fetch_assoc();
        return $brand['manu_name'];
    }



    /**____________________________________________________________________________________________________
     * XÓA Manufacturer THEO id:
     */
    static function deleteManufactureByID($manu_id) {
        $sql = self::$connection->prepare("DELETE FROM manufactures  WHERE manu_id = ?");
        $sql->bind_param("i", $manu_id);
        $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * THÊM Manufacturer:
     */
    static function insertManufacturer($manu_name) {
        $sql = self::$connection->prepare("INSERT INTO manufactures (manu_id, manu_name) VALUES(0, '$manu_name')");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * SỬA MANU:
     */
    static function updateManufacturer($manu_id, $manu_name) {
        $sql = self::$connection->prepare("UPDATE manufactures  SET manu_name='$manu_name' WHERE manu_id=$manu_id");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * PAGINATE: ĐÁNH SỐ TRANG, TẠO LINK TỚI CÁC TRANG.
     */
    static function paginate($url, $page, $totalResults, $resultsPerPage, $offset) {
        $totalLinks = ceil(floatval($totalResults)/floatval($resultsPerPage));
        $links = "";

        $from = $page - $offset;
        $to = $page + $offset;
        if($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if($to > $totalLinks) {
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

    static function searchManufacture($keyword) {
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_name like '%$keyword%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function searchManufacture_andCreatePagination($keyword, $page, $resultsPerPage) {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_name like '%$keyword%' LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
}