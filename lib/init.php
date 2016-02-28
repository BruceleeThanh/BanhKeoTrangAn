<?php

require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'lib' . DS . 'common.class.php');

function __autoload($class_name) {
    $lib_path = ROOT . DS . 'lib' . DS . strtolower($class_name) . '.class.php';
    $controllers_path = ROOT . DS . 'controllers' . DS . str_replace('controller', '', strtolower($class_name)) . '.controller.php';
    $model_path = ROOT . DS . 'models' . DS . str_replace('controller', '', strtolower($class_name)) . '.php';

    if (file_exists($model_path)) {
        require_once ($model_path);
    }

    if (file_exists($lib_path)) {
        require_once ($lib_path);
    } else if (file_exists($controllers_path)) {
        require_once ($controllers_path);
    } else {
        Router::redirect(ROOT_PATH . "views/Error404/index");
    }
}

function __($key, $default_value = '') {
    return Lang::get($key, $default_value);
}
