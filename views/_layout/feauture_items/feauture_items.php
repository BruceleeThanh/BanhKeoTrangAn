
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    <?php foreach ($this->data['product'] as $key => $item) {
        ?>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img class="imgProduct" src="<?= WEBROOT_PATH ?>/img/upload/<?= $item['Image'] ?>" alt="" />
                        <h2><?= $item['UnitPrice'] ?></h2>
                        <p><?= $item['Name'] ?></p>
                        <a href="<?= ROOT_PATH ?>en/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2><?= $item['UnitPrice'] ?></h2>
                            <p><?= $item['Name'] ?></p>
                            <a href="<?= ROOT_PATH ?>en/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="<?= ROOT_PATH ?>en/product/detail/<?=$item['Slug']?>"><i class="fa fa-info-circle"></i>View Detail</a></li>
                        <li><a href="<?= ROOT_PATH ?>en/wishlist/additem/<?= $item['IDProduct'] ?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</div><!--features_items-->
