<?php
require_once 'connect.php';

$id = 7;

$sql = "DELETE FROM users WHERE id=?";

try{
    $statement = $conn->prepare($sql);

    $data = [$id];

    $deleteStatus = $statement->execute($data);
    var_dump($deleteStatus);

}catch (Exception $exception){
    echo $exception->getMessage().'<br/>';
    echo 'File: '.$exception->getFile().' - Line: '.$exception->getLine().'<br/>';
}
