<?php
require_once 'header-require-models.php';
?>
<?php
    $updateResult = -1;
    if(isset($_GET['manu_id']) && isset($_GET['manu_name'])) {
        $manu_id = $_GET['manu_id'];
        $getAllProduct_ByManufacture = Product::getProducts_ByManuID($manu_id);
        if (count($getAllProduct_ByManufacture) == 0) {
            $updateResult = Manufacturer::updateManufacturer($_GET['manu_id'], $_GET['manu_name']);
        }
        header("Location: form_update.php?functionType=manufacturers&manu_id=" .$_GET['manu_id'] ."&updateResult=$updateResult");
    } else {
        header('./manufactures.php');
    }
?>