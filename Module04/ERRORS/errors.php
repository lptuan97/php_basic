<?php

/*
 * PHP Errors
 * - PARSE: Lỗi cú pháp, chương trình sẽ dừng khi gặp lỗi này
   - FATAL: Lỗi do không biên dịch được, chương trình sẽ dừng khi gặp lỗi
   - WARNING: Lỗi cảnh báo không nghiêm trọng, chương trình vẫn chạy
   - NOTICE: Lỗi không nghiêm trọng giống warning
 *
 * */

ini_set('display_errors', 1);
error_reporting(E_ERROR | E_PARSE); // 

//1. Lỗi cú pháp
echo 'Học lập trình PHP <br/>';
echo 'Unicode';
echo '<br/>';

//2. Lỗi biên dịch
//unicode();
echo 'Chương trình chạy tiếp <br/>';

//3. Lỗi cảnh báo (WARNING)
include_once 'header.php'; 
echo 'Chương trình chạy tiếp <br/>';

//4. Lỗi cảnh báo (NOTICE)
$str1 = 'Unicode';
echo $str1.'<br/>';
echo $str2;
echo '<br/>';

$arr = [];
echo $arr[0];