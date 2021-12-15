<?php

class Product extends Db
{

    /**____________________________________________________________________________________________________
     * LẤY DỮ LIỆU BẢNG products:
     */
    //Lấy danh sách tất cả sản phẩm:
    static function getAllProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by id desc");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy danh sách tất cả sản phẩm và Phân trang:
    static function getAllProducts_andCreatePagination($page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at ASC LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * Lấy ra các sản phẩm mới nhất:
     */
    static function getLatestProducts($number_of_records)
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY create_at DESC LIMIT 0,$number_of_records");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    static function getLatestProducts_ByManuId($manu_id, $product_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ? AND id <> ?  order by receipt DESC LIMIT 0,3");
        $sql->bind_param("ii", $manu_id, $product_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function getLatestProducts_ByTypeId($type_id, $product_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ? AND id <> ?  order by receipt DESC LIMIT 0,3");
        $sql->bind_param("ii", $type_id, $product_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    /**____________________________________________________________________________________________________
     * Lấy ra các sản phẩm rẻ nhất:
     */
    static function getCheapestProducts($number_of_records)
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY price ASC LIMIT 0,$number_of_records");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * Lấy ra các sản phẩm đắt nhất:
     */
    static function getMostExpensiveProducts($number_of_records)
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY price DESC LIMIT 0,$number_of_records");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * Lấy ra tất cả sản phẩm nổi bật.
     */
    static function getAllFeaturedProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE feature = 1  order by receipt DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * LẤY SẢN PHẨM THEO id:
     */
    static function getProduct_ByID($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = $sql->get_result()->fetch_assoc();
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * LẤY DANH SÁCH SẢN PHẨM THEO manu_id:
     */
    static function getProducts_ByManuID($manu_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id like ?");
        $sql->bind_param("i", $manu_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy ra các sản phẩm cùng một hãng và Phân trang:
    static function getProducts_ByManuIdAndCreatePagination($manu_id, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ?  order by receipt DESC LIMIT $firstLink, $resultsPerPage");
        $sql->bind_param("i", $manu_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * LẤY DANH SÁCH SẢN PHẨM THEO type_id:
     */
    static function getProducts_ByTypeID($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id like ?");
        $sql->bind_param("i", $type_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy ra các sản phẩm cùng một loại và Phân trang:
    static function getProducts_ByTypeID_andCreatePagination($type_id, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ?  order by receipt DESC LIMIT $firstLink, $resultsPerPage");
        $sql->bind_param("i", $type_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }



    /**____________________________________________________________________________________________________
     * XÓA SẢN PHẨM THEO id:
     */
    static function deleteProductByID($id)
    {
        $sql = self::$connection->prepare("DELETE FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * THÊM SẢN PHẨM:
     */
    static function insertProduct($name, $manu_id, $type_id, $price, $pro_image, $description, $feature, $create_at, $receipt)
    {
        $sql = self::$connection->prepare("INSERT INTO products(id, name, manu_id, type_id, price, pro_image, description, feature, created_at, receipt) VALUES(0, '$name', $manu_id, $type_id, $price, '$pro_image', '$description', $feature, '$create_at', '$receipt')");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * SỬA SẢN PHẨM:
     */
    static function updateProduct($id, $name, $manu_id, $type_id, $price, $pro_image, $description, $feature, $create_at, $receipt)
    {
        $sql = self::$connection->prepare("UPDATE products SET name='$name', manu_id=$manu_id, type_id=$type_id, price=$price, pro_image='$pro_image', description='$description', feature=$feature, created_at='$create_at', receipt= $receipt WHERE id=$id");
        return $sql->execute();
    }



    /**____________________________________________________________________________________________________
     * SEARCHING:
     */
    //(SEARCHING) Tìm kiếm sản phẩm:
    static function searchProduct($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name like '%$keyword%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //(SEARCHING + Paging/Pagination) Tìm kiếm sản phẩm và Phân trang:

    static function searchProduct_andCreatePagination($keyword, $page, $resultsPerPage)
    {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name like '%$keyword%' ORDER BY created_at ASC LIMIT $firstLink, $resultsPerPage");
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
