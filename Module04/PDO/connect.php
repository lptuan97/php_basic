<?php
//Thông tin kết nối
const _HOST = 'localhost';
const _USER = 'root';
const _PASS = ''; //Xampp => pass='';
const _DB = 'login_system';
const _DRIVER = 'mysql';

try{
    if (class_exists('PDO')){

        $dsn = _DRIVER.':dbname='._DB.';host='._HOST;

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Đẩy lỗi vào ngoại lệ khi truy vấn
        ];
        $conn = new PDO($dsn, _USER, _PASS, $options);
    }
}catch (Exception $exception){
    echo '<div style="color: red; border: 1px solid red; padding: 5px 15px;">';
    echo $exception->getMessage().'<br/>';
    echo '</div>';
    die();
}

$dsn = _DRIVER.':dbname='._DB.';host='._HOST;
$conn = new PDO($dsn, _USER, _PASS);
print_r($conn);