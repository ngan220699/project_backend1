<?php
session_start();
if (!isset($_SESSION['isLogin']['Admin'])) {
    header('location:../login/login.php');
}

require_once "./config.php";
require_once "./models/db.php";
require_once "./models/product.php";
require_once "./models/protype.php";
require_once "./models/manufacturer.php";
require_once "./models/review.php";
require_once "./models/order.php";
require_once "./models/orderdetail.php";
require_once "./models/user.php";
$product = new Product;
$manufacturer = new Manufacturer;
$protype = new Protype;
$review = new Review;
$order = new Order;
$orderDetail = new OrderDetail;
$user = new User;