
    <!--================Main Header Area =================-->
    <?php 
    require_once "navbar_header.php";
    
    ?>
    <!--================End Main Header Area =================-->

    <!--================End Main Header Area =================-->
    <section class="banner_area">
        <div class="container">
            <div class="banner_text">
                <h3>Our Cakes</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </div>
        </div>  
    </section>
    <!--================End Main Header Area =================-->

    <!--================Blog Main Area =================-->
    <section class="our_cakes_area p_100">
        <div class="container">
            <div class="main_title">
                <h2>Our Cakes</h2>
                <h5>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                    dicta sunt explicabo.</h5>
            </div>
            <div class="cake_feature_row row">
            <?php
                    $page = 1;
                    if(isset($_GET['page'])==TRUE) {
                        $page = $_GET['page'];
                    }
                    $resultsPerPage = 4;
                    $list_of_products = Product::getAllProducts_andCreatePagination($page, $resultsPerPage);
                    $totalResults = count(Product::getAllProducts());
                    if (isset($_GET['keyword'])) {
                        $list_of_products = Product::searchProduct_andCreatePagination($_GET['keyword'], $page, $resultsPerPage);
                        $totalResults = count(Product::searchProduct($_GET['keyword']));
                    } 
                    if (isset($_GET['manu_id'])) {
                        $list_of_products = Product::getProducts_ByManuIdAndCreatePagination($_GET['manu_id'], $page, $resultsPerPage);
                        $totalResults = count(Product::getProducts_ByManuID($_GET['manu_id']));
                    } 
                    if (isset($_GET['type_id'])) {
                        $list_of_products = Product::getProducts_ByTypeID_andCreatePagination($_GET['type_id'], $page, $resultsPerPage);
                        $totalResults = count(Product::getProducts_ByTypeID($_GET['type_id']));
                    } 

                    // Output:
                  
                    foreach($list_of_products as $key => $value) {
                ?>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">
                            <img src="img/cake-feature/<?php echo $value['pro_image'];?>" alt="" width="270px" height="224px">
                        </div>
                        <div class="cake_text">
                            <h4><?php echo number_format($value['price']);?></h4>
                            <h3><a href="product-details.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></h3>
                            <a class="pest_btn" href="add-cart.php?id=<?php echo $value['id'];?>">Add to cart</a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <div style="text-align:center;">
        <?php
        $paginate = Product::paginate("cake.php?", $page, $totalResults, $resultsPerPage, 1);
        if (isset($_GET['keyword'])) {
            $paginate = Product::paginate("cake.php?keyword=" . $_GET['keyword'] . "&", $page, $totalResults, $resultsPerPage, 2);
        }
        if (isset($_GET['manu_id'])) {
            $paginate = Product::paginate("cake.php?manu_id=" . $_GET['manu_id'] . "&", $page, $totalResults, $resultsPerPage, 2);
        }
        if (isset($_GET['type_id'])) {
            $paginate = Product::paginate("cake.php?type_id=" . $_GET['type_id'] . "&", $page, $totalResults, $resultsPerPage, 2);
        }
        echo $paginate;
        ?>
    </div>
    </section>
    <!--================End Blog Main Area =================-->

    <!--================Special Recipe Area =================-->
    <section class="special_recipe_area">
        <div class="container">
            <div class="special_recipe_slider owl-carousel">
                <div class="item">
                    <div class="media">
                        <div class="d-flex">
                            <img src="img/recipe/recipe-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h4>Special Recipe</h4>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi equatur uis autem vel eum.</p>
                            <a class="w_view_btn" href="#">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="media">
                        <div class="d-flex">
                            <img src="img/recipe/recipe-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h4>Special Recipe</h4>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi equatur uis autem vel eum.</p>
                            <a class="w_view_btn" href="#">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="media">
                        <div class="d-flex">
                            <img src="img/recipe/recipe-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h4>Special Recipe</h4>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi equatur uis autem vel eum.</p>
                            <a class="w_view_btn" href="#">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="media">
                        <div class="d-flex">
                            <img src="img/recipe/recipe-1.png" alt="">
                        </div>
                        <div class="media-body">
                            <h4>Special Recipe</h4>
                            <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                                nisi ut aliquid ex ea commodi equatur uis autem vel eum.</p>
                            <a class="w_view_btn" href="#">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Special Recipe Area =================-->

    <?php require_once 'contact.php'?>