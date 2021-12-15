<?php
class Db
{
    public static $connection;
    public function __construct()
    {
        //Dùng từ khóa self vì có từ khóa static.
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);
            self::$connection->set_charset(DB_CHARSET);
        }
        return self::$connection;
    }
        //3. Execute Query
        
}
?>