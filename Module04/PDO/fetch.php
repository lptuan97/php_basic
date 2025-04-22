<?php
require_once 'connect.php';

//1. Truy vấn tất cả dữ liệu

$sql = "SELECT * FROM users";


try{
    $statement = $conn->prepare($sql);

    $statement->execute();

    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo '<pre>';
    print_r($data);
    echo '</pre>';


}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}

//2. Truy vấn 1 hàng dữ liệu
$sql = "SELECT * FROM users WHERE id=?";

try{
    $statement = $conn->prepare($sql);

    $statement->execute([8]);

    $data = $statement->fetch(PDO::FETCH_ASSOC);

    echo '<pre>';
    print_r($data);
    echo '</pre>';


}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}

//3. Lấy số hàng của câu lệnh truy vấn
$sql = "SELECT * FROM users";


try{
    $statement = $conn->prepare($sql);

    $statement->execute();

//    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//    echo '<pre>';
//    print_r($data);
//    echo '</pre>';

    $countUser = $statement->rowCount();
    
    echo 'Số hàng: '.$countUser;

}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}