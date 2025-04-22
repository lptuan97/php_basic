<!-- PHP has three diferent variable scopes: -->
<!-- 
LOCAL
GLOBAL
STATIC    
-->
chúng ta là tất cả
<?php

// Local scope (inside a function)
function myTest(){
    $x = 5; //local scope
    echo $x;
}
myTest();
echo $x; // Nếu sử dụng $x ngoài hàm myTest bị ERROR
echo '<br/>';

// Global scope (outside a function)
$y = 10; // global scope
function myTest2(){
    global $y; // sử dụng từ khóa global để sử dụng
    $y = 11;
    echo $y.'<br/>'; // y là 11
}
echo $y; // y là 10 
myTest2(); // y là 11
echo $y; // y là 11 
echo '<br/>.............<br/>'; 

// Static scope (inside a function)

function myTest3(){
    static $x = 0;
    echo $x.'<br/>';
    $x++;
}

myTest3(); // 0
myTest3(); // 1
myTest3(); // 2
myTest3(); // 3

// Với hàm thường biến khai báo trong hàm sẽ về giá trị cũ
// static có tác dụng giữ lưu lại giá trị.