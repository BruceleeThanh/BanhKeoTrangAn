<?php

define('ROOT_PATH', 'http://localhost:8080/BanhKeoTrangAn/');

define('DS', DIRECTORY_SEPARATOR); // dau ' / '
define('ROOT', dirname(dirname(__FILE__))); // thu muc cha

define('VIEWS_PATH', ROOT . DS . 'views');
define('WEBROOT_PATH', ROOT_PATH . 'webroot');
define('ADMIN_ROOT', ROOT_PATH . 'admin');
define('DEFAULT_ROOT', ROOT_PATH . 'default');
define('INDEX', ROOT_PATH . 'en/index');

define('SLIDEBAR_MENU', dirname(dirname(__FILE__)) . DS . "views\_layout_admin\sidebar_menu.php");
define('LAYOUT_ADMIN', dirname(dirname(__FILE__)) . DS . "views\_layout_admin");

require_once (ROOT . DS . 'lib' . DS . 'init.php');

session_start();
App::run($_SERVER['REQUEST_URI']);

