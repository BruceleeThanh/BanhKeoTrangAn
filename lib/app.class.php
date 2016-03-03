<?php

class App {

    protected static $router;
    public static $db;

    public static function getRouter() {
        return self::$router;
    }

    public static function run($uri) {
        self::$router = new Router($uri);

        Lang::load(self::$router->getLanguage());


        self::$db = new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));

        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());

        $layout = self::$router->getRoute();

        if ($layout == 'admin' && Session::get('role') != 1) {
            if ($controller_method != 'admin_login') {
                Router::redirect("admin/user/login");
            }
        }
        
        // Calling controller method

        $controller_object = new $controller_class();

        if (method_exists($controller_object, $controller_method)) {
            // Controller's action may return a view path
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();
            
        } else {
            Router::redirect(ROOT_PATH . "views/Error404/index");
        }
        if ($layout == null) {
            $layout = 'default';
        }
        // $layout se load len trang chinh trong view
        $layout_path = VIEWS_PATH . DS . $layout . '.php';
        $layout_view_object = new View(compact('content'), $layout_path);
//        var_dump($view_object);
//        die;
        echo $layout_view_object->render();
    }

}
