<?php

class CategoryPostController extends Controller{
    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new CategoryPost();
    }
    
    public function admin_index(){
        
    }
}

