
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Thanh toán</title>

        <?php include VIEWS_PATH . '/_layout/link.php'; ?>
        <link rel="stylesheet" href="<?= WEBROOT_PATH ?>/css/resetcreditcard.css">

        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>

        <link rel="stylesheet" href="<?= WEBROOT_PATH ?>/css/stylecreditcard.css">
        <style>
            .creditcard{
                max-width: 350px;
                max-height: 550px;
                margin-left: 500px;         
            }
            
        </style>
    </head>
    <body >
        <?php include VIEWS_PATH . '/_layout/header.php'; ?>
        <div class="step-one">
            <h2 class="heading">Bước 3 > Thanh toán</h2>
        </div>
        <!-- message notification -->
        <div class="message-alert">
            <div class="alert alert-info"  role="alert">
                <?= isset($this->data['notify']) ? $this->data['notify'] : "" ?>
            </div>
        </div>
        <div class="creditcard">
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Chi tiết hoá đơn</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form" id="" method="post">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">MÃ THẺ</label>
                                    <div class="input-group">
                                        <input 
                                            type="tel"
                                            class="form-control"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required autofocus 
                                            />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">HẠN THẺ</span><span class="visible-xs-inline">EXP</span> NGÀY</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required 
                                        />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">MÃ CV</label><br/>
                                    <input 
                                        type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                        />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode">MÃ GIẢM GIÁ</label>
                                    <input type="text" class="form-control" name="couponCode" />
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" href="" name="submit" type="submit">Xác nhận</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>

        <!-- CREDIT CARD FORM ENDS HERE -->
        <?php include VIEWS_PATH . '/_layout/footer.php'; ?> 

        <script src="<?= WEBROOT_PATH ?>/js/jquery.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/bootstrap.min.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/jquery.scrollUp.min.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/price-range.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/jquery.prettyPhoto.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/main.js"></script>
        <script src="<?= WEBROOT_PATH ?>/js/main1.js"></script> <!-- Gem jQuery -->
        <script src="<?= WEBROOT_PATH ?>/js/indexcreditcard.js"></script>
    </body>
</html>
