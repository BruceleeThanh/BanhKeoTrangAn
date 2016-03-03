<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">đề xuất</h2>

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
                                    <h2><?= $this->data['recommend'][$i]['UnitPrice'] ?> VND</h2>
                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
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
                                    <h2><?= $this->data['recommend'][$i]['UnitPrice'] ?> VND</h2>
                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
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
                                    <h2><?= $this->data['recommend'][$i]['UnitPrice'] ?> VND</h2>
                                    <p><?= $this->data['recommend'][$i]['Name'] ?></p>
                                    <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $item['IDProduct'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
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