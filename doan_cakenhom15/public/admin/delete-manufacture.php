<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['manu_id'])) {
    // Kiểm tra xem có còn sản phẩm nào thuộc manufacture đó hay không, nếu còn thì không được xóa.
    if (count(Product::getProducts_ByManuID($_GET['manu_id'])) == 0) {
        $deleteResult = Manufacturer::deleteManufactureByID($_GET['manu_id']);
    }
}
header("Location: manufactures.php?deleteResult=$deleteResult");
