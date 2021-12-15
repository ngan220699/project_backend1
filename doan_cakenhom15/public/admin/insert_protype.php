<?php
require_once 'header-require-models.php';
?>
<?php
    $insertResult = -1;
    if(isset($_GET['type_name'])) {
        $type_name = $_GET['type_name'];
        $getAllProtype = Protype::getAllProtypes();
        $flag = true;
        foreach ($getAllProtype as $value) {
            if ($value['type_name'] == $type_name) {
                $flag == false;
            } 
        }
        if ($flag == true) {
            $insertResult = Protype::insertProtype($_GET['type_name']);
        }
        header("Location: form.php?functionType=protypes&insertResult=$insertResult");
    } else { 
        header('location:./protypes.php');
    }
?>