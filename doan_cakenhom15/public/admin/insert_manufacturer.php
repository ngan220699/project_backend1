<?php
require_once 'header-require-models.php';
?>
<?php
    $insertResult = -1;
    if(isset($_GET['manu_name'])) {
        $manu_name = $_GET['manu_name'];
        $getAllAManufacture = Manufacturer::getAllManufacturers();
        $flag = true;
        foreach ($getAllAManufacture as $value) {
            if ($value['manu_name'] == $manu_name) {
                $flag == false;
            } 
        }
        if ($flag == true) {
            $insertResult = Manufacturer::insertManufacturer($_GET['manu_name']);
        }
        header("Location: form.php?functionType=manufacturers&insertResult=$insertResult");
    } else {
        header('location:./manufactures.php');
    }
?>