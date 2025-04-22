<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    echo 'Username: ' . $username . '<br/>';
    echo 'Email: ' . $email . '<br/>';
} else {
    echo 'Not allow method';
}

