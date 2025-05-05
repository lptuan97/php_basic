<?php
// Cấu hình lỗi (Ẩn hiện lỗi)
// Cách 1. php.ini Thay đổi file để cấu hình
// Cách 2. Sử dụng các hàm php
// Cách 3. htaccess

//Show error php

// ini_set('display_errors', 1);

// Report simple running errors // Báo cáo lỗi chạy đơn giản
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//Báo cáo e_notice cũng có thể tốt 
//(để báo cáo các biến không được chỉ định hoặc bắt lỗi chính tả tên biến ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE //Báo cáo tất cả các lỗi ngoại trừ e_notice
error_reporting(E_ALL & ~E_NOTICE);

// Report all PHP errors (see changelog) //Báo cáo tất cả các lỗi PHP (xem Changelog)
error_reporting(E_ALL);

// Report all PHP errors //Báo cáo tất cả các lỗi PHP
error_reporting(-1);

//Hide error php //Ẩn lỗi PHP
ini_set('display_errors', 0);
error_reporting(0);