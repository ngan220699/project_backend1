<?php
require_once 'header-require-models.php';
$deleteResult = -1;
if (isset($_GET['type_id'])) {
    // Kiểm tra xem có còn sản phẩm nào thuộc protype đó hay không, nếu còn thì không được xóa.
    if (count(Product::getProducts_ByTypeID($_GET['type_id'])) == 0) {
        $deleteResult = Protype::deleteProtype_ByTypeID($_GET['type_id']);
    }
}
header("Location: protypes.php?deleteResult=$deleteResult");
