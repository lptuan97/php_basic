<?php
session_start();

$_SESSION ['username'] = 'LPTuan';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';