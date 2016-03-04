<?php

class HomeController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Home();
    }

    public function index() {
        $this->register();
        $this->login();
        // slider
        $this->data['sliderShow'] = $this->sliderShow();
        // category
        $this->data['categoryLeftbar'] = $this->categoryLeftbar();
        $this->data['kindofproductLeftbar'] = $this->kindofproductLeftbar();
        if (isset($_GET['search'])) {
            $data = $this->search();
            $data = json_decode($data, true);
            $this->data['product'] = $data;
        } else {
            // list product
            $this->data['product'] = $this->showProduct_Limit();
        }
        //recommend
        $this->data['recommend'] = $this->showProduct();

        // kind of product
        $this->data['kindofproduct'] = $this->model->showKindOfProduct();
        // cart
        $cartController = new CartController();
        if (isset($_SESSION['cart'])) {
            $price = $cartController->getPriceCart();
            if (isset($price)) {
                $_SESSION['price'] = $price;
            }
        }
        $this->data['test'] = $this->register();
        if (isset($_SESSION['cart_log'])) {
            $price = $cartController->getPriceCart_Log();
            if (isset($price)) {
                $_SESSION['price'] = $price;
            }
        }

        // count cart by id
        $this->data['countCart'] = $cartController->getByCartByIDUser();

        if ($this->data['countCart'] == 0) {
            $this->data['countCart'] = "";
        }
    }

    function sliderShow() {
        $slider = new Slider();
        return $slider->selectByStatus(1);
    }

    public function categoryLeftbar() {
        $category = new Category();
        $data = $category->selectByStatus(1);
        $result = $this->createCategoryNested($data);
        return $result;
    }

    /* tree view */

    function createCategoryNested($categories, $parentId = null) {
        $results = [];
        foreach ($categories as $category) {
            if ($parentId == $category['IDCategoryParent']) {
                $nextParentId = $category['IDCategory'];
                $category['children'] = $this->createCategoryNested($categories, $nextParentId);
                $results[] = $category;
            }
        }
        return $results;
    }

    public function kindofproductLeftbar() {
        $kindofproduct = new KindOfProduct();
        $data = $kindofproduct->selectByStatus(1);
        $result = $this->createKindOfProductNested($data);
        return $result;
    }

    function createKindOfProductNested($kindofproduct, $parentID = null) {
        $results = [];
        foreach ($kindofproduct as $item) {
            if ($parentID == $item['IDKindOfProductParent']) {
                $nextParentID = $item['IDKindOfProduct'];
                $item['children'] = $this->createKindOfProductNested($kindofproduct, $nextParentID);
                $results[] = $item;
            }
        }
        return $results;
    }

    public function showProduct_Limit() {
        $product = new Product();
        return $product->selectAll_Limit(6);
    }

    public function showProduct() {
        $product = new Product();
        return $product->selectByStatus(1);
    }

    public function register() {
        if ($_POST) {
            $username = test_input($_POST['username']);
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);
            $hash = md5(Config::get('salt') . $password);
            $r = 1;
            $data = array(
                'Name' => $username,
                'Password' => $hash,
                'Fullname' => '',
                'Gender' => -1,
                'Birthday' => '',
                'Address' => '',
                'Email' => $email,
                'PhoneNumber' => '',
                'Status' => 0,
            );
            $userController = new UserController();
            $isAdded = $userController->register($data, $r);
            
            if ($isAdded) {
                Router::redirect(ROOT_PATH);
            }
        }
    }

    public function login() {
        if ($_POST && isset($_POST['username']) && isset($_POST['password'])) {
            $data = array();
            $userController = new UserController();
            $user = $userController->login($_POST['username']);
            $hash = md5(Config::get('salt') . $_POST['password']);
            if ($user && $user['Status'] == 0 && $hash == $user['Password']) {
                Session::set('UserName', $user['Name']);
                Session::set('UserRole', $user['Status']);
                Session::set('UserID', $user['IDUser']);
                $data = array(
                    'id' => $user['IDUser'],
                    'username' => $user['Name'],
                    'status' => 'success',
                );
                // role = 1 : admin
                // role = 0 : member 
                Router::redirect(ROOT_PATH);
            }
            echo json_encode($data);
        }
    }

    public function search() {
        if ($_GET) {
            $data = trim($_GET['search']);
            $productModel = new Product();
            $product = $productModel->search($data);

            return json_encode($product);
        }
    }

    public function admin_index() {
        
    }

    public function admin_statistic() {
        $productModel = new Product();
        $this->data['product'] = $productModel->countAllRecordEnable();

        $userModel = new User();
        $this->data['user'] = $userModel->countAllUser();

        $postModel = new Post();
        $this->data['post'] = $postModel->countAllPostEnable();

        $cartModel = new Cart();
        $this->data['cart'] = $cartModel->countAllRecordEnable();
    }

}
