<?php
require_once 'header-require-models.php';
?>
<?php
$updateResult = -1;
if (isset($_GET['type_id']) && isset($_GET['type_name'])) {
    $type_id = $_GET['type_id'];
    $getAllProduct_ByProtype = Product::getProducts_ByTypeID($type_id);
    if (count($getAllProduct_ByProtype) == 0) {
        $updateResult = 1;
        $updateResult = Protype::updateProtype($_GET['type_id'], $_GET['type_name']);
    } 
    header("Location: form_update.php?functionType=protypes&type_id=" . $_GET['type_id'] . "&updateResult=$updateResult");
} else {
    header('./protypes.php');
}
?>