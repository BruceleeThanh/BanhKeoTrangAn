<?php include VIEWS_PATH . '/_layout/link.php'; ?>

<body>
    <?php include VIEWS_PATH . '/_layout/header.php'; ?>
    <div class="container">
        <div class="row">
            <?php include VIEWS_PATH . '/_layout/leftbar.php'; ?>

            <?php
            $item = $this->data['item'];
            ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img class="photoView" src="<?= WEBROOT_PATH ?>/img/upload/<?= $this->data['item'][0]['Image'] ?>" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][0]['Image']) ? $this->data['item'][0]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][1]['Image']) ? $this->data['item'][1]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][2]['Image']) ? $this->data['item'][2]['Image'] : "default.jpg" ?>" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][2]['Image']) ? $this->data['item'][2]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][0]['Image']) ? $this->data['item'][0]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][1]['Image']) ? $this->data['item'][1]['Image'] : "default.jpg" ?>" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][1]['Image']) ? $this->data['item'][1]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][0]['Image']) ? $this->data['item'][0]['Image'] : "default.jpg" ?>" alt=""></a>
                                    <a href=""><img class="icon-slider" src="<?= WEBROOT_PATH ?>/img/upload/<?= isset($this->data['item'][2]['Image']) ? $this->data['item'][2]['Image'] : "default.jpg" ?>" alt=""></a>
                                </div>

                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="<?= WEBROOT_PATH . DS ?>images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2><?= $this->data['product'][0]['Name'] ?></h2>
                            <br/>
                            <p>Web ID: <?= $this->data['product'][0]['IDProduct'] ?></p>
                            <img src="<?= WEBROOT_PATH . DS ?>images/product-details/rating.png" alt="" /><br/>
                            <span>
                                <span><?= number_format($this->data['product'][0]['UnitPrice'], 0) ?> VND</span>
                                <br/>
                                <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $this->data['product'][0]['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                            </span>
                            <p><b>Sẵn có:</b> Còn trong kho</p>
                            <p><b>Tình trạng:</b> Mới</p>
                            <p><b>Thương hiệu:</b> Bánh Kẹo Tràng An</p>
                            <a href=""><img src="<?= WEBROOT_PATH . DS ?>images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <div class="tab-pane fade" id="tag"  >
                            <?php if (isset($this->data['tag'])) { ?>
                                <?php foreach ($this->data['tag'] as $key => $value) {
                                    ?>
                                    <span class="label label-default" style=" padding: 10px;">#<?= $value['Name'] ?></span>
                                <?php } ?>
                            <?php } ?>
                        </div>

                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>12 Feb 2016</a></li>
                                </ul>
                                <p><?= $this->data['product'][0]['Description'] ?></p> <br/>
                                <p><b>Bình luận</b></p> <br/>

                                <form action="#">
                                    <span>
                                        <input style="background-color: white;" type="text" placeholder="Tên"/>
                                        <input style="background-color: white;" type="email" placeholder="Địa chỉ email"/>
                                    </span>
                                    <textarea name="text-comment" style="background-color: white;"></textarea>
                                    <b>Đánh giá: </b> <img src="<?= WEBROOT_PATH . DS ?>images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Gửi
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Đề xuất</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <?php for ($i = 0; $i < count($this->data['recommend']); $i++) {
                                ?>
                                <div <?php
                                if ($i == 0)
                                    echo "class='item active' ";
                                else
                                    echo "class='item '";
                                ?>>	

                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img class="recommend-img" src="<?= WEBROOT_PATH ?>/img/upload/<?= $this->data['recommend'][$i]['Image'] ?>" alt="" />
                                                    <h2>$<?= $this->data['recommend'][$i]['UnitPrice'] ?></h2>
                                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $this->data['recommend'][$i]['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img class="recommend-img" src="<?= WEBROOT_PATH ?>/img/upload/<?= $this->data['recommend'][$i]['Image'] ?>" alt="" />
                                                    <h2>$<?= $this->data['recommend'][$i]['UnitPrice'] ?></h2>
                                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $this->data['recommend'][$i]['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php $i++; ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img class="recommend-img" src="<?= WEBROOT_PATH ?>/img/upload/<?= $this->data['recommend'][$i]['Image'] ?>" alt="" />
                                                    <h2>$<?= $this->data['recommend'][$i]['UnitPrice'] ?></h2>
                                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $this->data['recommend'][$i]['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            <?php } ?>
                        </div>

                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->
            </div>
        </div>
    </div>



    <?php include VIEWS_PATH . '/_layout/footer.php'; ?> 

    <script src="<?= WEBROOT_PATH ?>/js/jquery.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/bootstrap.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.scrollUp.min.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/price-range.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main.js"></script>
    <script src="<?= WEBROOT_PATH ?>/js/main1.js"></script> <!-- Gem jQuery -->
</body>
</html>


<style>
    .imgProduct{
        width: 180px !important;
        height: 180px !important;
    }
    .center{
        text-align: center;
    }
    .icon-slider {
        width: 89px !important;
        height: 89px !important;
    }
    .recommend-img{
        width: 209px !important;
        height: 185px !important;
    }
    .photoView{
        width: 400px !important;
        height: 320px !important;
    }
    .left-sidebar h2, .brands_products h2{
        margin-top: 20px !important;
    }
</style>