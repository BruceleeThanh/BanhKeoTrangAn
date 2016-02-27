<?php

class CartController extends Controller {

    public $CartID;

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Cart();
        $this->CartID = null;
    }

    public function admin_index() {
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 10;
        $maxShowPaging = 10;
        $countRecord = intval($this->model->countAllRecord());
        $totalPage = ceil($countRecord / $maxSize);
        $paging = array();
        $i = 1;
        if ($currentPage >= $maxShowPaging) {
            do {
                $i = $i + $maxShowPaging - 1;
            } while ($i + $maxShowPaging - 1 <= $currentPage);
        }
        for (; $i <= $totalPage; $i++) {
            if (count($paging) >= $maxShowPaging) {
                break;
            }
            $paging[] = $i;
        }
        $this->data['totalPage'] = $totalPage;
        $this->data['paging'] = $paging;
        $this->data['item'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function addtocart() {

        $IDProduct = $this->params[0];
        $quantity = 0;
        $productModel = new Product();
        $product = $productModel->selectByIDProduct($IDProduct);

        //update wishlist to added to cart
        if (isset($this->params[1])) {
            $wishlistModel = new WishList();
            $data = array(
                'IDWishlist' => $this->params[1],
                'Status' => 1, // da them vao gio nhung chua thanh toan
            );
            $isUpdate = $wishlistModel->updateStatus($data, 1);
            Session::set('IDWishlist', $this->params[1]);
        }

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            $flag = FALSE;
            for ($i = 0; $i < $count; $i++) {
                if ($_SESSION['cart'][$i]['id'] == $IDProduct) {
                    $_SESSION['cart'][$i]['quantity'] += 1;
                    $flag = TRUE; // neu gio hang da co san pham
                    break;
                }
            }
            // gio hang chua cos san pham
            if ($flag == FALSE) {
                $_SESSION['cart'][$count]['id'] = $IDProduct;
                $_SESSION['cart'][$count]['quantity'] = 1;
                $_SESSION['cart'][$count]['price'] = $product[0]['UnitPrice'];
            }
        } else {
            $_SESSION['cart'] = array();
            $_SESSION['cart'][0]['id'] = $IDProduct;
            $_SESSION['cart'][0]['quantity'] = 1;
            $_SESSION['cart'][0]['price'] = $product[0]['UnitPrice'];
        }

        Router::redirect(ROOT_PATH);
        exit();
    }

    public function getPriceCart_Log() {
        $total = 0;
        if (isset($_SESSION['cart_log'])) {
            foreach ($_SESSION['cart_log'] as $key => $row) {
                $total += $row['quantity'] * $row['price'];
            }
        }
        return $total;
    }

    public function getPriceCart() {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $row) {
                $total += $row['quantity'] * $row['price'];
            }
        }
        return $total;
    }

    public function unsetsession() {
        Session::destroy();
        Router::redirect(ROOT_PATH);
    }

    public function deletecart() {
        $action = $this->params[0];
        $id = $this->params[1];

        foreach ($_SESSION['cart'] as $key => $row) {
            if ($_SESSION['cart'][$key]['id'] == $id) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['price'] = $this->getPriceCart();
            }
        }
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['price']);
        }
        if ($action == "index") {

            Router::redirect(ROOT_PATH);
        } else if ($action == "viewcart") {

            Router::redirect(ROOT_PATH . "en/cart/viewcart");
        }
    }

    public function deletecart_log() {
        $idCart_Log = $this->params[1];
        $data = array(
            'IDCart' => $idCart_Log,
        );
        $isDelete = $this->model->delete($data);
        if ($isDelete) {
            Router::redirect(ROOT_PATH . "en/cart/cart_log/userid/" . Session::get('UserID'));
        }
    }

    public function viewcart() {
        //code
    }

    public function checkout() {
        $data = array();
        if (!isset($_SESSION['UserName']) && !isset($_SESSION['UserRole'])) {
            // phai dang nhap moi su dung duoc chuc nang checkout
            Router::redirect(ROOT_PATH);
        } else {
            if (isset($_SESSION['cart'])) {
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    $id = $_SESSION['UserID'];
                    $product_id = $_SESSION['cart'][$i]['id'];
                    $quantity = $_SESSION['cart'][$i]['quantity'];
                    $status = 0;
                    $data = array(
                        'IDUser' => $id,
                        'IDProduct' => $product_id,
                        'Quantity' => $quantity,
                        'Status' => $status,
                    );
                    //add to cart table

                    $isInsert = $this->model->insert($data, 1);
                    //last id
                    $this->CartID[$i] = $isInsert[0]['LastID'];
                }
                $_SESSION['CartID'] = $this->getCartID();
//                var_dump($_SESSION['CartID']);
//                die;
                //payment
                Router::redirect(ROOT_PATH . "en/payment/payment");
            }
        }
    }

    public function getCartID() {
        return $this->CartID;
    }

    public function getByCartByIDUser() {
        if (isset($_SESSION['UserID'])) {
            return $this->model->countByIDUser($_SESSION['UserID']);
        } else {
            return null;
        }
    }

    // Cart at navbar 
    // Store cart of user ( cart is not paid )
    public function cart_log() {
        $currentUser = $this->params[1];
        $this->data['cart'] = $this->model->selectByIDUser($currentUser);
        Session::set('count-cart', count($this->data['cart']));
        if (Session::get('count-cart') == 0) {
            Session::delete('count-cart');
            Router::redirect(ROOT_PATH);
        }
        if (Session::get('UserID') == null) {
            Router::redirect(ROOT_PATH);
        }
        $productModel = new Product();
        $Price = array();
        foreach ($this->data['cart'] as $key => $value) {
            $UnitPrice = $productModel->selectByIDProduct($value['IDProduct']);
            $Price[] = $value['Quantity'] * $UnitPrice[0]['UnitPrice'];
        }
        $getPrice = array_sum($Price);
        $this->data['Price'] = $getPrice;
    }

}
