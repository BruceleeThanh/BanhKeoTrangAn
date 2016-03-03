<style>
    .cart-o{

       margin-top: -45px !important;  

        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        color: #666;
        font-size: 12px;
        line-height: 20px;

    }
    .text-center{

    }
    #cart .dropdown-menu li p {
        margin: 20px 40px;
    }
    .img-thumbnail{
        width: 30px;
        height:30px;
    }
    .btn-delete{
        background-color: red;
        padding: 0px 2px;

    }
    .btn-delete i{

    }
    .dm{
        padding: 0px 0px;
        min-width: 350px;
        min-height:  200px;
    }
    .drp{
        min-width:  70px !important; 
    }
    .tx{
        margin-left: 100px !important;
    }
</style>
<div class="col-sm-3 col-sm-offset-9 cart-o">
    <div id="cart" class="btn-group btn-block" style="margin-left: 6%">
        <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle drp">
            <i class="fa fa-shopping-cart"></i>
            <span id="cart-total">
                <?php
                if (isset($_SESSION['cart']))
                    echo count($_SESSION['cart']);
                else
                    echo "0";
                ?> sản phẩm - <?= isset($_SESSION['price']) ? number_format($_SESSION['price'],0) : 0 ?> VND
            </span>
        </button>
        <ul class="dropdown-menu pull-right dm">
            <?php
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "<li>
                        <p class='text-center'>Giỏ hàng đang trống!</p>
                     </li>";
                ?>
            <?php } else { ?> 
                <!--form dropdown -->
                <li>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($_SESSION['cart'] as $key => $row) {
                                $id = $row['id'];
                                $productModel = new Product();
                                $product = $productModel->selectByIDProduct($id);
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="#">
                                            <img src="<?= WEBROOT_PATH ?>/img/upload/<?= $product[0]['Image'] ?>" alt="<?= $product[0]['Name'] ?>" title="<?= $product[0]['Name'] ?>" class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td class="text-left">
                                        <a href="#"><?= $product[0]['Name'] ?></a>
                                    </td>
                                    <td class="text-right"><?= $row['quantity'] ?></td>
                                    <td class="text-right"><?= number_format($row['quantity'] * $row['price'],0) ?> VND</td>
                                    <td class="text-center">
                                        <a type="button" onclick="return confirm('Bạn có muốn xoá sản phẩm này khỏi giỏ hàng?');" href="<?= ROOT_PATH ?>vn/cart/deletecart/index/<?= $row['id']; ?>" title="Remove" class="btn btn-danger btn-xs btn-delete">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </li>
             
                <li>
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-right"><strong>Tổng</strong></td>
                                    <td class="text-right"><?= number_format($_SESSION['price'],0) ?> VND</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="tx">
                            <a href="<?= ROOT_PATH ?>vn/cart/viewcart">
                                <strong><i class="fa fa-shopping-cart"></i> Xem giỏ</strong>
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?= ROOT_PATH ?>vn/cart/checkout">
                                <strong><i class="fa fa-share"></i> Đặt hàng</strong>
                            </a>
                        </p>
                    </div>
                </li>
                <?php
            }
            ?>   

        </ul>
    </div>
</div>
