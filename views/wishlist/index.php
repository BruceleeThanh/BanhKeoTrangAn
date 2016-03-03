<html>

    <?php include VIEWS_PATH . '/_layout/link.php'; ?>
    <body>
        <?php include VIEWS_PATH . '/_layout/header.php'; ?>

        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Quan tâm</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Ảnh</td>
                                <td class="description">Tên</td>
                                <td class="price">Model</td>
                                <td class="price">Đơn giá</td>
                                <td>Thêm vào giỏ</td>
                                <td>Trạng thái</td>
                                <td>Hành động</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            if (isset($this->data['item'])) {
                                foreach ($this->data['item'] as $key => $row) {
                                    $id = $row['IDProduct'];
                                    $productModel = new Product();
                                    $product = $productModel->selectByIDProduct($id);
                                    ?>
                                    <tr class="items">
                                        <td class="cart_product">
                                            <img  class="img-products" src="<?= ROOT_PATH ?>img/upload/<?= $product[0]['Image'] ?>" alt="<?= $product[0]['Name'] ?>">
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="#"><?= substr($product[0]['Name'], 0, 20) ?></a></h4>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="#"><?= substr($product[0]['Model'], 0, 20) ?></a></h4>
                                        </td>
                                        <td class="cart_price">
                                            <p><?= number_format($product[0]['UnitPrice'], 0) ?> VND</p>
                                        </td>
                                        <td class="cart_price">
                                            <?php if ($row['Status'] !== 1 || $row['Status'] !== 2) { ?>
                                                <a href="<?= ROOT_PATH ?>vn/cart/addtocart/<?= $row['IDProduct'] ?>/<?= $row['IDWishlist'] ?>" title="Thêm vào giỏ" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i></a>
                                            <?php
                                            } elseif($row['Status'] == 0) {
                                                echo "<i class='fa fa-check'></i>";
                                            }
                                            ?>
                                        </td>
                                        <td class="cart_status">
                                            <p><?php
                                                if ($row['Status'] == 0 | $row['Status'] == null)
                                                    echo "<span class='label label-default'>Chưa thanh toán</span>";
                                                elseif ($row['Status'] == 1)
                                                    echo "<span class='label label-primary'>Trong giỏ</span>";
                                                elseif ($row['Status'] == 2)
                                                    echo "<span class='label label-success'>Đã thanh toán</span>";
                                                ?></p>
                                        </td>
                                        <td class="cart_delete">
                                            <a type="button" onclick="return confirm('Bạn có muốn bỏ quan tâm sản phẩm này?');" href="<?= ROOT_PATH ?>vn/wishlist/delete/<?= $row['IDWishlist']; ?>" title="Xoá" class="btn btn-danger btn-xs btn-delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section> 

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
    #do_action{
        margin-bottom: -20px;
    }
    .items{
        max-height: 120px;
    }
    td.cart_product{
        width: 150px;
        height: 60px;
    }
    .cart_product img{
        width: 80px !important;
        height: 65px !important;
    }
    img.img-products{

    }

</style>