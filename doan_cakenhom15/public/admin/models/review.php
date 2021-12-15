<?php

class Review extends Db {


    
    /**____________________________________________________________________________________________________
     * LẤY DANH SÁCH REVIEW THEO product_id:
     */
    static function getReviews_ByProID($product_id) {
        $sql = self::$connection->prepare("SELECT * FROM reviews WHERE product_id like ?");
        $sql->bind_param("i", $product_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy ra các sản phẩm cùng một loại và Phân trang:
    static function getReviews_ByProID_andCreatePagination($product_id, $page, $resultsPerPage) {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM reviews WHERE product_id = ? LIMIT $firstLink, $resultsPerPage");
        $sql->bind_param("i", $product_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    
    static function getLatestReview()
    {
        $sql = self::$connection->prepare("(SELECT * FROM reviews ORDER BY created_at DESC LIMIT 0,3)");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    /**____________________________________________________________________________________________________
     * THÊM REVIEW:
     */
    static function insertReview($product_id, $reviewer_name, $reviewer_email, $content) {
        $sql = self::$connection->prepare("INSERT INTO reviews (product_id, reviewer_name, reviewer_email, content)
        VALUES (?, ?, ?, ?)");
        $sql->bind_param('isss', $product_id, $reviewer_name, $reviewer_email, $content);
        return $sql->execute();
    }

    static function removeReview_ById($product_id) {
        $sql = self::$connection->prepare("DELETE FROM reviews WHERE product_id = $product_id");
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
}