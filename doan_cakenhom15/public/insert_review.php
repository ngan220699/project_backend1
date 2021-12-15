<?php
require_once "config.php";
require_once "models/db.php";
require_once "models/product.php";
require_once "models/protype.php";
require_once "models/manufacturer.php";
require_once "models/review.php";
$review = new Review;
?>
<?php
    if(isset($_POST['product_id'])) {
        $insertResult = Review::insertReview($_POST['product_id'], $_POST['reviewer_name'], $_POST['reviewer_email'], $_POST['content']);
    }
    header("Location: product-details.php?id=" . $_POST['product_id']);
?>