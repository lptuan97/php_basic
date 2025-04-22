<?php
// query string: ?username=tuanle&email=lephamtuan97@gmail.com&age=45

$data = [
    'Tin tức',
    'Sản phẩm'
];

foreach ($data as $item) {
    // $url = $item;
    $url = '?module=' . $item;
    echo '<a href = "' . $url . '">' . $item . '</a>';
    echo " ";
}

if (!empty($_GET)) {

    foreach ($_GET as $value) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}

echo '<pre>';
print_r($_SERVER);
echo '</pre>';