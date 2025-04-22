<?php
define("_WEB_HOST_ROOT", 'http://hoangan.net');

echo _WEB_HOST_ROOT;

echo '<br/>';

const _WEB_PATH_ROOT = 'C:/xampp/htdocs';
echo _WEB_PATH_ROOT;

echo '<br/>';

$checkDefine = defined('_WEB_PATH_ROOT');
var_dump($checkDefine);
