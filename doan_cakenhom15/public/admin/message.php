<?php require_once 'header.php' ?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <?php
        $listMessage  = [];
        $allOrder = OrderDetail::getAllOrder();
        $idOrder =  $allOrder[0]['orderid'];
        foreach ($allOrder as $key => $value) {
            if ($value['orderid'] == $idOrder) {
                if (in_array($value['orderid'], $listMessage)) {
                    continue;
                } else {
                    array_push($listMessage, $idOrder);
                }
            } else {
                $idOrder = $value['orderid'];
                if (in_array($value['orderid'], $listMessage)) {
                    continue;
                } else {
                    array_push($listMessage, $idOrder);
                }
            }
        }
        ?>
        <h1>Manage User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Messages</h5>
                        <?php
                        if (isset($_GET['message'])) {
                            $orderId = $_GET['message'];
                            if ($orderId != '') {
                                $listOrder = OrderDetail::getOrder_ByOrderId($orderId);

                        ?>
                                <form action="#" method="get" name="get-message">
                                    <select name="message" id="message" onchange="this.form.submit()">
                                        <?php
                                        foreach ($listMessage as $key => $value) {
                                            if (isset($_GET['message'])) {
                                                $orderId = $_GET['message'];
                                                if ($value == $orderId) {
                                                    echo '<option value=' . $value . ' selected>' . $value . '</option>';
                                                } else {
                                                    echo '<option value=' . $value . '>' . $value . '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </form>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo "<p style=\"text-align:center;\"><b>There are " . count($listMessage) . " messages unchecked.</b></p>";
                                ?>
                                <?php
                                foreach ($listOrder as $key => $value) {
                                    $product = Product::getProduct_ByID($value['productid']);
                                    if ($product['receipt'] < $value['quantity']) {
                                ?>
                                        <tr style="color: red">
                                            <td width=250><img src="../img/cake-feature/<?php echo $product['pro_image']; ?>" alt=""></td>
                                            <td>
                                                <h5><?php echo $product['name']; ?></h5>
                                            </td>
                                            <td>
                                                <h5><?php echo $value['quantity']; ?></h5>
                                            </td>
                                            <td>
                                                <h5><?php echo number_format($value['price']); ?></h5>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="./check_order.php?id=c<?= $value['productid'] ?>&messageid=<?= $orderId ?>&qty=<?= $value['quantity']; ?>" class="btn btn-success btn-mini">Send Email</a>
                                            </td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td width=250><img src="../img/cake-feature/<?php echo $product['pro_image']; ?>" alt=""></td>
                                            <td>
                                                <h5><?php echo $product['name']; ?></h5>
                                            </td>
                                            <td>
                                                <h5><?php echo $value['quantity']; ?></h5>
                                            </td>
                                            <td>
                                                <h5><?php echo number_format($value['price']); ?></h5>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="./check_order.php?id=c<?= $value['productid'] ?>&messageid=<?= $orderId ?>&qty=<?= $value['quantity']; ?>" class="btn btn-success btn-mini">Check</a>
                                                <a href="./check_order.php?id=u<?= $value['productid'] ?>&messageid=<?= $orderId ?>&qty=<?= $value['quantity']; ?>" class="btn btn-danger btn-mini" target="_blank">UnCheck</a>
                                            </td>

                                        </tr>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: center; padding-top: 20px">
                        <a href="./check_order.php?messageid=<?= $orderId ?>" class="btn btn-success btn-large">Check All</a>
                    </div>
                </div>
                <?php
                if (count($listMessage) == 0) {
                    echo "<h2 class='text-center text-success'>NO MESSAGE NOW !!!</h2>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2021 &copy; TDC - Lập trình web 1</div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>

</html>