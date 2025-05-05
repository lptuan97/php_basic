<?php
/*
 * Xử lý ngoại lệ là quá trình xử lý các lỗi giúp chương trình vẫn hoạt động bình thường
 * Cú pháp:
 * try{
 *
 * }catch()
 * */

echo 'Học lập trình PHP <br/>';
$age = 31;
try{
    //Tất cả code thực thi sẽ viết ở đây
    // unicode()
    if ($age<30){
        throw new Exception('Tuổi phải nhỏ hơn 30');
    }
    else if ($age>30){
        throw new Error('Tuổi phải lớn hơn 30');
    }
}catch (Error $exception){ // Error: class  || $exception: Biến
    echo $exception->getMessage().'<br/>';
    echo 'File: Error '.$exception->getFile().' - Line: '.$exception->getLine();
    echo '<br/>';
}
catch (Exception $exception){ //Exceeption: Lỗi liên quan đến logic
    echo $exception->getMessage().'<br/>';
    echo 'File: Exception '.$exception->getFile().' - Line: '.$exception->getLine();
    echo '<br/>';
}

echo 'Chương trình vẫn chạy';