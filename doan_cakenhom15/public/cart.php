<!--================Main Header Area =================-->
<?php
session_start();
require_once "navbar_header.php";
?>
<!--================End Main Header Area =================-->

<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Cart</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->

<!--================Cart Table Area =================-->
<section class="cart_table_area p_100">
    <?php
    if (isset($_SESSION['isLogin']['User'])) {
        $totalPrice = 0;
        $idUserLogin = $_SESSION['isLogin']['User'];
        $idOrder = Order::getOrder_ByCustomerId($idUserLogin)[0]['id'];
        $orderDetail = OrderDetail::getOrder_ByOrderId($idOrder);

    ?>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-cart">
                        <?php
                        if (count($orderDetail) != 0) {
                            foreach ($orderDetail as $item) {
                                $product = Product::getProduct_ByID($item['productid']);
                                if ($product['receipt'] < $item['quantity']) {
                        ?>
                                <tr style="background: #ef5353;">
                                    <td class="product-thumbnail">
                                        <a href="product-details.php?id=<?php echo $product['id']; ?>"><img style="width:100%;height:auto;" alt="poster_1_up" class="shop_thumbnail" src="img/cake-feature/<?php echo $product['pro_image']; ?>"></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount"><?php echo number_format($product['price']); ?>
                                            đ</span>
                                    </td>
                                    <td class="product-quantity text-center">
                                        <div class="quantity buttons_added">
                                            <a href="add-cart.php?id=m<?= $item['productid'] ?>" class="btn btn-outline-info" style="float: left; display: none">-</a>
                                            <span class="product-quantity"><?php $totalPrice += $item['price'];
                                                                            echo $item['quantity'] ?></span>
                                            <a href="add-cart.php?id=p<?= $item['productid'] ?>" class="btn btn-outline-info" style="float: right; display: none">+</a>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount"><?php echo number_format($item['price']) ?> VND</span>
                                    </td>
                                    <td class="product-remove">
                                        <a title="Remove this item" class="remove" href="add-cart.php?id=r<?php echo $item['productid']; ?>">X</a>
                                    </td>
                                </tr>
                                <?php          } else {?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="product-details.php?id=<?php echo $product['id']; ?>"><img style="width:100%;height:auto;" alt="poster_1_up" class="shop_thumbnail" src="img/cake-feature/<?php echo $product['pro_image']; ?>"></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount"><?php echo number_format($product['price']); ?>
                                            đ</span>
                                    </td>
                                    <td class="product-quantity text-center">
                                        <div class="quantity buttons_added">
                                            <a href="add-cart.php?id=m<?= $item['productid'] ?>" class="btn btn-outline-info" style="float: left">-</a>
                                            <span class="product-quantity"><?php $totalPrice += $item['price'];
                                                                            echo $item['quantity'] ?></span>
                                            <a href="add-cart.php?id=p<?= $item['productid'] ?>" class="btn btn-outline-info" style="float: right">+</a>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount"><?php echo number_format($item['price']) ?> VND</span>
                                    </td>
                                    <td class="product-remove">
                                        <a title="Remove this item" class="remove" href="add-cart.php?id=r<?php echo $item['productid']; ?>">X</a>
                                    </td>
                                </tr>
                            }
                            }
                    <?php
                         } } }else {
                                echo "<h2 style='text-align: center;'><i>
                                <a href='./cake.php'>SHOPPING NOW !!!</a>
                                </i></h2>";
                            }
                    ?>
                     
                    </tbody>
                </table>
            </div>
            <div class="row cart_total_inner">
                <div class="col-lg-7"></div>
                <div class="col-lg-5">
                    <div class="cart_total_text">
                        <div class="cart_head">
                            Cart Total
                        </div>
                        <div class="total">
                            <h4>Total <strong><span class="amount">
                                        <?= number_format($totalPrice);
                                        ?>
                                        VND</span></strong></h4>
                        </div>
                        <div class="cart_footer">
                            <a class="pest_btn" href="./cake.php">Shopping</a>
                            <a class="pest_btn" href="add-cart.php">Remove All</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else {
                  echo "<h2 style='text-align: center;'><i>
                  <a href='./login/login.php'>Pls Login First !!!</a>
                  </i></h2>";
            }?>
        </div>
</section>
<!--================End Cart Table Area =================-->

<?php require_once 'contact.php' ?>