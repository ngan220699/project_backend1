<?php
class User extends Db {
    //LOGIN.
    public function login($username) {
        $sql = self::$connection->prepare("SELECT * FROM users where username = ? ");
        $sql->bind_param("s",$username);//return an object
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    
    static function getUserLogin($username, $permission)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM users WHERE permission = ? AND username = ?");
        $sql->bind_param('ss', $permission, $username);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    /**____________________________________________________________________________________________________
     * LẤY DỮ LIỆU BẢNG users:
     */
    //Lấy danh sách tất cả user:
    static function getAllUsers() {
        $sql = self::$connection->prepare("SELECT * FROM users");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
    //Lấy danh sách tất cả user và Phân trang:
    static function getAllUsers_andCreatePagination($page, $resultsPerPage) {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM users LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }


    /**____________________________________________________________________________________________________
     * XÓA User THEO id:
     */
    static function deleteUserByID($id) {
        $sql = self::$connection->prepare("DELETE FROM users WHERE id = ? and permission = 'User'");
        $sql->bind_param("i", $id);
        $sql->execute();
    }

        /**____________________________________________________________________________________________________
     * Lấy User THEO id:
     */
    static function getUserName($id) {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $item = $sql->get_result()->fetch_assoc();
        return $item;
    }

    /**____________________________________________________________________________________________________
     * SỬA USER:
     */
    static function updateUser($id, $username, $password, $permission) {
        $sql = self::$connection->prepare("UPDATE users SET `username`=?,`password`=?,`permission`=? WHERE id=?");
        $sql->bind_param("sssi", $username, $password, $permission, $id);
        return $sql->execute();
    }




    /**____________________________________________________________________________________________________
     * THÊM User:
     */
    static function insertUser($username, $password, $role) {
        $sql = self::$connection->prepare("INSERT INTO `users`(`id`, `username`, `password`, `permission`)
        VALUES (NULL, ?, ?, ?)");
        $sql->bind_param("sss", $username, $password, $role);
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

    static function searchUser($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE username like '%$keyword%'");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }

    static function searchUser_andCreatePagination($keyword, $page, $resultsPerPage) {
        //Tính xem nên bắt đầu hiển thị từ trang có số thứ tự là bao nhiêu:
        $firstLink = ($page - 1) * $resultsPerPage; //(Trang hiện tại - 1) * (Số kết quả hiển thị trên 1 trang).
        //Dùng LIMIT để giới hạn số lượng kết quả được hiển thị trên 1 trang:
        $sql = self::$connection->prepare("SELECT * FROM users WHERE username like '%$keyword%' LIMIT $firstLink, $resultsPerPage");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array.
    }
}