<?php
// google
// yrcc lfjy spuv llns
// File chứa các hằng số cấu hình


const _MODULE_DEFAULT = 'home'; //module mặc định
const _ACTION_DEFAULT = 'lists'; // action mặc định
const _INCODE = true; // Ngăn chặn hành vi truy cập ngoài modules/index.php

//Thiết lập host (đường dẫn tuyệt đối absolute path)
define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST']
.'/php_doc/module05/users_manager'); //Địa chỉ trang chủ

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/templates'); //địa chỉ templates

// thiết lập path (đường dẫn tương đối relative path)
define('_WEB_PATH_ROOT',__DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');


//Thông tin kết nối databse
const _HOST = 'localhost';
const _USER = 'root';
const _PASS = ''; //Xampp => pass='';
const _DB = 'phponline';
const _DRIVER = 'mysql';

// Phân trang
const _PER_PAGE = 5;