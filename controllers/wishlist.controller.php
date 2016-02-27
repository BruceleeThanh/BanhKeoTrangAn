<?php

class WishlistController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new WishList();
    }

    public function index() {
        $UserID = $this->params[1];
        $this->data['item'] = $this->model->selectByIDUser($UserID);
        Session::set('count-wishlist', $this->model->countByIDUser($UserID));
        if (Session::get('count-wishlist') == 0) {
            Session::delete('count-wishlist');
            Router::redirect(ROOT_PATH);
        }
//        checkData(Session::get('count-wishlist'));
    }

    public function additem() {
        $productModel = new Product();
        $IDProduct = $this->params[0];
        $aProduct = $productModel->selectByIDProduct($IDProduct);
        if (!empty(Session::get('UserID'))) {
            // member
            $data = array(
                'IDUser' => Session::get('UserID'),
                'IDProduct' => $IDProduct,
                'Status' => 0,
            );
            $isAdded = $this->model->insert($data, 1);
            if ($isAdded) {
                Router::redirect(ROOT_PATH);
            }
        } else {
            // guest
            Router::redirect(ROOT_PATH);
        }
    }

    public function delete() {
        $id = $this->params[0];
        $data = array(
            'IDWishlist' => $id,
        );
        $isDelete = $this->model->delete($data);
        if ($isDelete) {
            Router::redirect(ROOT_PATH . "en/wishlist/index/userid/" . Session::get('UserID'));
        }
    }

}
