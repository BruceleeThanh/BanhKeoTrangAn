<?php

Config::set('site_name', 'Bánh Kẹo Tràng An');

Config::set('languages', array('en', 'vn'));

Config::set('routes',array(
    'default' => '',
    'admin' => 'admin_',
));

Config::set('admin_route', 'admin');
Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'home');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'banhkeotrangan');

Config::set('salt', 'jd7sj3sdkd964he7e');


//card account
define('CARD_NUMBER', '123');
define('CV_CODE', '123');
define('COUPON_CODE', '123');
define('CARD_EXPIRY', '05/07');
