<html>
    <?php include VIEWS_PATH . '/_layout/link.php'; ?>
    <body>
        <?php include VIEWS_PATH . '/_layout/header.php'; ?>

        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Đặt hàng</li>
                    </ol>
                </div><!--/breadcrums-->

                <div class="step-one">
                    <h2 class="heading">Bước 1 > Xem giỏ</h2>
                </div>
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Sản phẩm</td>
                                <td class="description">Mô tả</td>
                                <td class="price">Đơn giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
                                <td>Hành động</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $row) {
                                    $id = $row['id'];
                                    $productModel = new Product();
                                    $product = $productModel->selectByIDProduct($id);
                                    ?>
                                    <tr>
                                        <td class="cart_product">
                                            <a href="#"><img src="<?= ROOT_PATH ?>img/upload/<?= $product[0]['Image'] ?>" alt="<?= $product[0]['Name'] ?>"></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="#"><?= substr($product[0]['Description'], 0, 20) ?></a></h4>
                                            <p>Web ID: <?= rand(100, 10000) ?></p>
                                        </td>
                                        <td class="cart_price">
                                            <p><?= number_format($row['price'], 0) ?> VND</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="text" name="quantity" value="<?= $row['quantity'] ?>" autocomplete="off" size="2">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price"><?= number_format($row['price'] * $row['quantity'], 0) ?> VND</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a type="button" onclick="return confirm('Bạn có muốn xoá sản phẩm này khỏi giỏ hàng?');" href="<?= ROOT_PATH ?>vn/cart/deletecart/viewcart/<?= $row['id']; ?>" title="Xoá" class="btn btn-danger btn-xs btn-delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?> 
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                    <table class="table table-condensed total-result">
                                        <tr>
                                            <td>Trước thuế</td>
                                            <td><?= isset($_SESSION['price']) ? number_format($_SESSION['price'], 0) : "0" ?> VND</td>
                                        </tr>
                                        <tr>
                                            <td>Thuế</td>
                                            <td><?= isset($_SESSION['price']) ? number_format($tax = $_SESSION['price'] * 5 / 100, 0) : "0" ?> VND</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Phí giao hàng</td>
                                            <td>Miễn phí</td>

                                        </tr>
                                        <tr>
                                            <td>Tổng</td>
                                            <?php if (isset($_SESSION['price'])) { ?>
                                                <td><span><?php
                                                        $tax = 0;
                                                        if (isset($_SESSION['price'])) {
                                                            $price = $_SESSION['price'];
                                                            $tax = $_SESSION['price'] * 5 / 100;
                                                        } else {
                                                            $price = 0;
                                                        }
                                                        $total = $tax + $price;
                                                        echo number_format($total, 0) . " VND";
                                                        ?></span></td>
                                            <?php } ?>

                                        </tr>
                                    </table>
                                </td>
                            </tr>          
                        </tbody>
                    </table>
                </div>
                <div class="step-one">
                    <h2 class="heading">Bước 2 > Thông tin giao nhận</h2>
                </div>
                <form method="get" name="input" >
                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="shopper-info">
                                    <p>Thông tin người nhận</p>
                                    <form>
                                        <?php $customer = $this->data['customer']; ?>
                                        <input type="text" readonly placeholder="<?php
                                        if ($customer[0]['Name'] != '')
                                            echo $customer[0]['Name'];
                                        else
                                            echo 'Name';
                                        ?>">
                                        <input type="text" readonly placeholder="<?php
                                        if ($customer[0]['Address'] != '')
                                            echo $customer[0]['Address'];
                                        else
                                            echo 'Address';
                                        ?>">
                                        <input type="text" readonly placeholder="<?php
                                        if ($customer[0]['Email'] != '')
                                            echo $customer[0]['Email'];
                                        else
                                            echo 'Email';
                                        ?>">
                                        <input type="text" readonly placeholder="<?php
                                        if ($customer[0]['PhoneNumber'] != '')
                                            echo $customer[0]['PhoneNumber'];
                                        else
                                            echo 'PhoneNumber';
                                        ?>">
                                    </form>
                                      
                                    <button class="btn-con" type="submit" name="continue" id="btn1"   value="continue"><a class="btn btn-primary" id="link" href="<?= ROOT_PATH ?>vn/payment/creditcard">Thanh toán</a></button>
                                </div>
                            </div>
                            <div class="col-sm-5 clearfix">
                                <div class="bill-to">
                                    <p>Nơi nhận</p>
                                    <div class="form-one">
                                        <form method="get">
                                            <input type="text" placeholder="Tên công ty">
                                            <input type="text" onchange="changeFirstName()" name="firstname" required placeholder="Họ *">
                                            <input type="text" placeholder="Tên đệm">
                                            <input type="text" onchange="changeLastName()" name="lastname" required placeholder="Tên *">
                                            <input type="text" onchange="changeEmail()" name="email1" required placeholder="Email 1 *">
                                            <input type="text" placeholder="Email 2">
                                        </form>
                                    </div>
                                    <div class="form-two">
                                        <form>
                                            <input type="text" placeholder="Mã bưu chính *">
                                            <select>
                                                <option>-- Quốc gia --</option>
                                                <option>United States</option>
                                                <option>UK</option>
                                                <option>VietNam</option>
                                            </select>
                                            <select>
                                                <option>-- Tỉnh thành --</option>
                                                <option>Las vegas</option>
                                                <option>Washington</option>
                                                <option>New York</option>
                                                <option>Lon don</option>
                                                <option>Manchester</option>
                                                <option>Edinburgh</option>
                                                <option>Hà Nội</option>
                                                <option>Đà Nắng</option>
                                                <option>TP. HCM</option>
                                            </select>
                                            <input type="text" onchange="changePhoneNumber()" name="phonenumber" placeholder="Số điện thoại *">
                                            <input type="text" placeholder="Di động">
                                            <input type="text" placeholder="Fax">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="order-message">
                                    <p>Ghi chú</p>
                                    <textarea name="message" id="message"  placeholder="Ghi chú khi giao hàng!" rows="16"></textarea>

                                </div>	
                            </div>

                        </div>
                    </div>
                </form>    

            </div>

        </section> <!--/#cart_items-->

        <?php include VIEWS_PATH . '/_layout/footer.php'; ?> 
        <script>
            $("#btn1").click(function () {
                var firstname = $('input[name="firstname"]').val();
                var lastname = $('input[name="lastname"]').val();
                var email = $('input[name="email1"]').val();
                var phonenumber = $('input[name="phonenumber"]').val();
                var message = $('textarea#message').val();
                var data = '<?= ROOT_PATH ?>vn/payment/creditcard?firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&phonenumber=' + phonenumber + '&address=' + message;
                $('#link').attr('href', data);
            });
        </script>
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
    .btn-con{
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }

</style>
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