<style>
    .imgProduct{
        width: 180px !important;
        height: 180px !important;
    }
    .center{
        text-align: center;
    }
</style>
<?php include VIEWS_PATH . '/_layout/link.php'; ?>
<body>
    <?php include VIEWS_PATH . '/_layout/header.php'; ?>

    <div class="container">
        <div class="row">
            <?php include VIEWS_PATH . '/_layout/leftbar.php'; ?>
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Sản phẩm</h2>
                <?php foreach ($this->data['item'] as $key => $item) {
                    ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img class="imgProduct" src="<?= WEBROOT_PATH ?>/img/upload/<?= $item['Image'] ?>" alt="" />
                                    <h2><?= $item['UnitPrice'] ?></h2>
                                    <p><?= $item['Name'] ?></p>
                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2><?= $item['UnitPrice'] ?></h2>
                                        <p><?= $item['Name'] ?></p>
                                        <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="<?= ROOT_PATH ?>vn/product/detail/<?=$item['Slug']?>"><i class="fa fa-info-circle"></i>Chi tiết</a></li>
                                    <li><a href="<?= ROOT_PATH ?>vn/wishlist/additem/<?= $item['IDProduct'] ?>"><i class="fa fa-plus-square"></i>Quan tâm</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div><!--features_items-->

            <div class="c-gray-box center">
                <ul class="pagination">
                    <li class="<?= $this->data['currentPage'] < 2 ? "hide" : "" ?>"><a href="<?= ROOT_PATH . "vn/product/kindofproduct/".$this->data['slugPage']."/page/" . ($this->data['currentPage'] - 1); ?> ">&laquo;</a></li>
                    <?php
                    foreach ($this->data['paging'] as $page) {
                        echo "<li class='" . ($this->data['currentPage'] == $page ? "active" : "") . "'><a href='" . ROOT_PATH . "vn/product/kindofproduct/".$this->data['slugPage']."/page/$page" . "'>$page</a></li>";
                    }
                    ?>
                    <li class="<?= $this->data['currentPage'] > $this->data['currentPage'] - 1 ? "hide" : "" ?>"><a href="<?= ROOT_PATH . "vn/product/kindofproduct/".$this->data['slugPage']."/page/" . ($this->data['currentPage'] + 1); ?>">&raquo;</a></li>
                </ul>
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

