<?php

class PaymentController extends Controller {

    public $cart_log;

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->cart_log = array();
    }

    //payment session
    //payment step 2
    public function payment() {
        // display information of customer
        $userModel = new User();
        $id = Session::get("UserID");
        $customer = $userModel->selectByID($id);
        $this->data['customer'] = $customer;
    }

    //payment cart offical
    public function payment_log() {
        $cartModel = new Cart();
        $id = Session::get("UserID");
        $userModel = new User();
        $customer = $userModel->selectByID($id);
        $this->data['customer'] = $customer;
        $this->data['cart'] = $cartModel->selectByIDUser($id);

        $productModel = new Product();
        $Price = array();
        foreach ($this->data['cart'] as $key => $value) {
            $UnitPrice = $productModel->selectByIDProduct($value['IDProduct']);
            $Price[] = $value['Quantity'] * $UnitPrice[0]['UnitPrice'];
        }
        $getPrice = array_sum($Price);
        $this->data['Price'] = $getPrice;
        $_SESSION['cart_log'] = $this->data['cart'];

        $_SESSION['Price_Log'] = $getPrice;
    }

    public function getCartLog() {
        return $this->cart_log;
    }

    // CART SESSION
    public function creditcard() {
        // payment step 3
        // config default credit card
//        $CARD_NUMBER = "123";
//        $CV_CODE = "123";
//        $COUPON_CODE = "123";
//        $CARD_EXPIRY = "05/07";
        $r = 1;
        ////
        $Config = array(
            'cardNumber' => CARD_NUMBER,
            'cardCVC' => CV_CODE,
            'cardExpiry' => CARD_EXPIRY,
            'couponCode' => COUPON_CODE
        );
        if ($_GET) {
            $first_name = $_GET['firstname'];
            $last_name = $_GET['lastname'];
            $email = $_GET['email'];
            $address = $_GET['address'];
            $phonenumber = $_GET['phonenumber'];
        }

        $data = array();

        if ($_POST && isset($_SESSION['cart'])) {

            $card_number = $_POST['cardNumber'];
            $cv_code = $_POST['cardCVC'];
            $cardExpiry = $_POST['cardExpiry'];
            $couponCode = $_POST['couponCode'];

            // validate infor
            ////
            if (in_array($card_number, $Config) && in_array($cv_code, $Config) && in_array($cardExpiry, $Config) && in_array($couponCode, $Config)) {
                // save receipt

                $id_user = "";
                $total = "";
                if (isset($_SESSION['UserID']) && isset($_SESSION['price'])) {
                    $id_user = $_SESSION['UserID'];
                    $total = $_SESSION['price'];
                    $r = 1; //success
                } else {
                    $r = 0; // error
                }
                $dataReceipt = array(
                    'IDUser' => $id_user,
                    'Fullname' => $first_name . " " . $last_name,
                    'Address' => $address,
                    'Email' => $email,
                    'Phonenumber' => $phonenumber,
                    'Total' => $total,
                    'r' => $r
                );
                $receiptModel = new Receipt();
                $isInserted = $receiptModel->insert($dataReceipt, $r);
                if ($isInserted) {
                    $lastIdreceipt = $receiptModel->getLastID();
                    // save receipt detail
                    $receiptDetailModel = new ReceiptDetail();
                    $cartModel = new Cart();
                    foreach ($_SESSION['CartID'] as $key => $value) {
                        $dataReceiptDetail = array(
                            'IDReceipt' => $lastIdreceipt,
                            'IDCart' => $value,
                            'SaleUnitPrice' => $_SESSION['cart'][$key]['price'],
                            'Quantity' => $_SESSION['cart'][$key]['quantity'],
                        );
                        $isInsertedRD = $receiptDetailModel->insert($dataReceiptDetail, $r);

                        if ($isInsertedRD) {

                            //update status wishlist
                            if (Session::get('IDWishlist') !== null) {
                                $wishlistModel = new WishList();
                                $data = array(
                                    'IDWishlist' => Session::get('IDWishlist'),
                                    'Status' => 2, // da thanh toan
                                );
                                $isUpdate = $wishlistModel->updateStatus($data, 1);
                            }

                            // send mail confirm
                            $to = $email;
                            $name = $first_name . " " . $last_name;
                            $subject = "Banh Keo Trang An Notie";
                            $message = "Congratulation you puschased successfully! Thank you for using our services.";

                            sendMail($to, $name, $subject, $message);
                            $r = 5; // sent mail successful
                            // update status cart = 1 <==> paid
                            $dataCart = array(
                                'IDCart' => $value,
                                'Status' => 1,
                            );
                            if ($cartModel->paid($dataCart, $r)) {
                                $r = 6; // paid success
                            } else {
                                $r = 7; // paid fail
                            }
                        } else {
                            $r = 2; // khong them duoc hoa don chi tiet
                        }
                    }
                    // message

                    unset($_SESSION['CartID']);
                    unset($_SESSION['cart']);
                    unset($_SESSION['price']);
                } else {
                    $r = 3; // khong them duoc hoa don
                }
            } else {
                $r = 4; // invail credit card
            }
        } else {
            $r = 9; // cart empty
        }
        // notify 
        $this->Notify($r);
    }

    // CART NAVBAR
    public function creditcard_log() {

//        $CARD_NUMBER = "123";
//        $CV_CODE = "123";
//        $COUPON_CODE = "123";
//        $CARD_EXPIRY = "05/07";
        $r = 1;
        ////
        $Config = array(
            'cardNumber' => CARD_NUMBER,
            'cardCVC' => CV_CODE,
            'cardExpiry' => CARD_EXPIRY,
            'couponCode' => COUPON_CODE
        );
        if ($_GET) {
            $first_name = $_GET['firstname'];
            $last_name = $_GET['lastname'];
            $email = $_GET['email'];
            $address = $_GET['address'];
            $phonenumber = $_GET['phonenumber'];
        }

        $data = array();

        if ($_POST && isset($_SESSION['cart_log'])) {

            $card_number = $_POST['cardNumber'];
            $cv_code = $_POST['cardCVC'];
            $cardExpiry = $_POST['cardExpiry'];
            $couponCode = $_POST['couponCode'];

            // validate infor
            ////
            if (in_array($card_number, $Config) && in_array($cv_code, $Config) && in_array($cardExpiry, $Config) && in_array($couponCode, $Config)) {
                // save receipt

                $id_user = "";
                $total = "";
                if (isset($_SESSION['UserID']) && isset($_SESSION['Price_Log'])) {
                    $id_user = $_SESSION['UserID'];
                    $total = $_SESSION['Price_Log'];
                    $r = 1; //success
                } else {
                    $r = 0; // error
                }
                $dataReceipt = array(
                    'IDUser' => $id_user,
                    'Fullname' => $first_name . " " . $last_name,
                    'Address' => $address,
                    'Email' => $email,
                    'Phonenumber' => $phonenumber,
                    'Total' => $total,
                    'r' => $r
                );

                $receiptModel = new Receipt();
                $isInserted = $receiptModel->insert($dataReceipt, $r);
                if ($isInserted) {
                    $lastIdreceipt = $receiptModel->getLastID();
                    // save receipt detail
                    $receiptDetailModel = new ReceiptDetail();
                    $cartModel = new Cart();
                    $productModel = new Product();

                    foreach ($_SESSION['CartID'] as $key => $value) {
                        $price = $productModel->selectByIDProduct($_SESSION['cart_log'][$key]['IDProduct']);

                        $dataReceiptDetail = array(
                            'IDReceipt' => $lastIdreceipt,
                            'IDCart' => $value,
                            'SaleUnitPrice' => $price[0]['UnitPrice'],
                            'Quantity' => $_SESSION['cart_log'][$key]['Quantity'],
                        );

                        $isInsertedRD = $receiptDetailModel->insert($dataReceiptDetail, $r);

                        if ($isInsertedRD) {
                            // send mail confirm
                            $to = $email;
                            $name = $first_name . " " . $last_name;
                            $subject = "Banh Keo Trang An Notie";
                            $message = "Congratulation you puschased successfully! Thank you for using our services.";

                            sendMail($to, $name, $subject, $message);
                            $r = 5; // sent mail successful
                            // update status cart = 1 <==> paid
                            $dataCart = array(
                                'IDCart' => $value,
                                'Status' => 1,
                            );
                            if ($cartModel->paid($dataCart, $r)) {
                                $r = 6; // paid success
                            } else {
                                $r = 7; // paid fail
                            }
                        } else {
                            $r = 2; // khong them duoc hoa don chi tiet
                        }
                    }
                    // message

                    unset($_SESSION['CartID']);
                    if (isset($_SESSION['cart'])) {
                        unset($_SESSION['cart']);
                    }
                    unset($_SESSION['cart_log']);
                    unset($_SESSION['price']);
                } else {
                    $r = 3; // khong them duoc hoa don
                }
            } else {
                $r = 4; // invail credit card
            }
        } else {
            $r = 9; // cart empty
        }
        // notify 
        $this->Notify($r);
    }

    public function Notify($r) {
        switch ($r) {
            case 0:
                $this->data['notify'] = "You need to sign in to use this feauture!.";
                break;
            case 1:
                $this->data['notify'] = "";
                break;
            case 2:
                $this->data['notify'] = "Invaild Information.";
                break;
            case 3:
                $this->data['notify'] = "Invaild Information!.";
                break;
            case 4:
                $this->data['notify'] = "Your information creditcard incorrect !.";
                break;
            case 5:
                $this->data['notify'] = "Sent email successfully !.";
                break;
            case 6:
                $this->data['notify'] = "Payment successed! .";
                break;
            case 7:
                $this->data['notify'] = "Payment failed!.";
                break;
            case 8:
                $this->data['notify'] = "Cart Empty.";
                break;
            default:
                $this->data['notify'] = "";
                break;
        }
    }

//    public function buy() {
//        //Tài khoản nhận tiền
//        $receiver = "loint20@gmail.com";
//        //Khai báo url trả về 
//        $return_url = ROOT_PATH . "/en/payment/getPaid";
//        //Giá của cả giỏ hàng 
//        $price = $_SESSION['price'];
//        //Mã giỏ hàng 
//        $order_code = "Hãy lập trình mã giỏ hàng của bạn vào đây";
//        //Thông tin giao dịch
//        $transaction_info = "Hãy lập trình thông tin giao dịch của bạn vào đây";
//        //Khai báo đối tượng của lớp NL_Checkout
//        $nl = new NL_Checkout();
//        //Tạo link thanh toán đến nganluong.vn
//        $url = $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);
//        Router::redirect($url);
//    }
//
//    public function getPaid() {
//        //Lấy thông tin giao dịch
//        $transaction_info = $_GET["transaction_info"];
//        //Lấy mã đơn hàng 
//        $order_code = $_GET["order_code"];
//        //Lấy tổng số tiền thanh toán tại ngân lượng 
//        $price = $_GET["price"];
//        //Lấy mã giao dịch thanh toán tại ngân lượng
//        $payment_id = $_GET["payment_id"];
//        //Lấy loại giao dịch tại ngân lượng (1=thanh toán ngay ,2=thanh toán tạm giữ)
//        $payment_type = $_GET["payment_type"];
//        //Lấy thông tin chi tiết về lỗi trong quá trình giao dịch
//        $error_text = $_GET["error_text"];
//        //Lấy mã kiểm tra tính hợp lệ của đầu vào 
//        $secure_code = $_GET["secure_code"];
//
//        //Xử lí đầu vào 
//
//        $nl = new NL_Checkout();
//        $check = $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
//        if ($check)
//            $html .="<div align=\"center\">Cám ơn quý khách, quá trình thanh toán đã được hoàn tất. Chúng tôi sẽ kiểm tra và chuyển hàng sớm!</div>";
//        else
//            $html.="Quá trình thanh toán không thành công bạn vui lòng thực hiện lại";
//
//        echo $html;
//    }
//
}
