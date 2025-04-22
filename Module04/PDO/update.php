<?php
//Update table
require_once 'connect.php'; //Import connect.php

//SQL Query
$sql = 'UPDATE users SET email=:email, fullname=:fullname WHERE id=:id';

//Data
$email = 'info@unicode.vn';
$fullname = 'Unicode';
$id = 8;

try{
    $statement = $conn->prepare($sql);

    $statement->bindParam(':email', $email);
    $statement->bindParam(':fullname', $fullname);
    $statement->bindParam(':id', $id);

//    $data = [
//        'id' => $id,
//        'email' => $email,
//        'fullname' => $fullname
//    ];

    $updateStatus = $statement->execute();
    var_dump($updateStatus);

}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}