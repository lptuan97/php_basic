<?php
require_once 'connect.php'; //Import connect.php

$email = 'hoangan.web@gmail.com';
$fullname = 'Hoàng An';
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO users(email, fullname, createAt) VALUES (?, ?, ?)";
try{
    $statement = $conn->prepare($sql);

//    $statement->bindParam(':email', $email);
//    $statement->bindParam(':fullname',$fullname);
//    $statement->bindParam(':createAt', date('Y-m-d H:i:s'));

//    $data = [
//        'email' => $email,
//        'fullname' => $fullname,
//        'createAt' => $date
//    ];

    $data = [
        $email,
        $fullname,
        $date
    ];

    $insertStatus = $statement->execute($data);

    var_dump($insertStatus);
    echo '<br/>';

    echo 'Id vừa insert: '.$conn->lastInsertId();

}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}

echo 'Chương trình chạy tiếp';

