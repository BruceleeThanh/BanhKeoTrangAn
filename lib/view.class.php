<?php

class View {

    protected $data;
    protected $path;

    public function __construct($data = array(), $path = null) {
        if (!$path) {
            $path = self::getDefaultViewPath();
        }
        if (!file_exists($path)) {
            throw new Exception('Template file is not found in path: ' . $path);
        }
        $this->path = $path;
        $this->data = $data;
      
    }
    // include view
    protected static function getDefaultViewPath() {
        $router = App::getRouter();
        
        if (!$router) {
            return false;
        }
        $controller_dir = $router->getController();
        
        $template_name = $router->getMethodPrefix() . $router->getAction() . '.php';
//        var_dump($template_name);
//        die;
        return VIEWS_PATH . DS . $controller_dir . DS . $template_name;
    }

    public function render() {
        $data = $this->data;
        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }

}