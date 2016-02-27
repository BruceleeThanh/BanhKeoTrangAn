<html>
    <?php include VIEWS_PATH . '/_layout/link.php'; ?>
    <body>
        <?php include VIEWS_PATH . '/_layout/header.php'; ?>

        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Check out</li>
                    </ol>
                </div><!--/breadcrums-->

                <div class="step-one">
                    <h2 class="heading">Step1>Review</h2>
                </div>
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description">Description</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($this->data['cart'])) {
                                foreach ($this->data['cart'] as $key => $row) {
                                    $id = $row['IDProduct'];
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
                                            <p><?= number_format($product[0]['UnitPrice'], 0) ?> VND</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="text" name="quantity" value="<?= $row['Quantity'] ?>" autocomplete="off" size="2">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price"><?= number_format($product[0]['UnitPrice'] * $row['Quantity'], 0) ?> VND</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a type="button" onclick="return confirm('Do you want delete this cart?');" href="<?= ROOT_PATH ?>en/cart/deletecart/viewcart/<?= $row['id']; ?>" title="Remove" class="btn btn-danger btn-xs btn-delete">
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
                                            <td>Cart Sub Total</td>
                                            <td><?= isset($this->data['Price']) ? number_format($this->data['Price'], 0) : "0" ?> VND</td>
                                        </tr>
                                        <tr>
                                            <td>Exo Tax</td>
                                            <td><?= isset($this->data['Price']) ? number_format($tax = $this->data['Price'] * 5 / 100, 0) : "0" ?> VND</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Shipping Cost</td>
                                            <td>Free</td>

                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <?php if (isset($this->data['Price'])) { ?>
                                                <td><span><?php
                                                        $tax = 0;
                                                        if (isset($this->data['Price'])) {
                                                            $price = $this->data['Price'];
                                                            $tax = $this->data['Price'] * 5 / 100;
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
                    <h2 class="heading">Step2>Fill Information</h2>
                </div>
                <form method="get" name="input" >
                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="shopper-info">
                                    <p>Shopper Information</p>
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
                                    <a class="btn btn-primary" href="#">Get Quotes</a>
                                    <button class="btn-con" type="submit" name="continue" id="btn1"   value="continue"><a class="btn btn-primary" id="link" href="<?= ROOT_PATH ?>en/payment/creditcard_log">Continue</a></button>
                                </div>
                            </div>
                            <div class="col-sm-5 clearfix">
                                <div class="bill-to">
                                    <p>Bill To</p>
                                    <div class="form-one">
                                        <form method="get">
                                            <input type="text" placeholder="Company Name">
                                            <input type="text" onchange="changeFirstName()" name="firstname" required placeholder="First Name *">
                                            <input type="text" placeholder="Middle Name">
                                            <input type="text" onchange="changeLastName()" name="lastname" required placeholder="Last Name *">
                                            <input type="text" onchange="changeEmail()" name="email1" required placeholder="Email 1 *">
                                            <input type="text" placeholder="Email 2">
                                        </form>
                                    </div>
                                    <div class="form-two">
                                        <form>
                                            <input type="text" placeholder="Zip / Postal Code *">
                                            <select>
                                                <option>-- Country --</option>
                                                <option>United States</option>
                                                <option>Bangladesh</option>
                                                <option>UK</option>
                                                <option>India</option>
                                                <option>Pakistan</option>
                                                <option>Ucrane</option>
                                                <option>Canada</option>
                                                <option>Dubai</option>
                                            </select>
                                            <select>
                                                <option>-- State / Province / Region --</option>
                                                <option>United States</option>
                                                <option>Bangladesh</option>
                                                <option>UK</option>
                                                <option>India</option>
                                                <option>Pakistan</option>
                                                <option>Ucrane</option>
                                                <option>Canada</option>
                                                <option>Dubai</option>
                                            </select>
                                            <input type="text" onchange="changePhoneNumber()" name="phonenumber" placeholder="Phone *">
                                            <input type="text" placeholder="Mobile Phone">
                                            <input type="text" placeholder="Fax">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="order-message">
                                    <p>Shipping Order</p>
                                    <textarea name="message" id="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>

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
                var data = '<?= ROOT_PATH ?>en/payment/creditcard_log?firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&phonenumber=' + phonenumber + '&address=' + message;
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