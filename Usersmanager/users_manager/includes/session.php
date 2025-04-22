<?php
if (!defined('_INCODE')) die('Access Denied...');


// Hàm gán session
function setSession($key, $value)
{
    if (!empty(session_id())) {
        $_SESSION[$key] = $value;
        return true;
    }
    return false;
}

// Hàm lấy session
function getSession($key = '')
{
    if (empty($key)) {
        return $_SESSION;
    } else {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } 
    }
    return false;
}

// Hàm xóa session
function removeSession($key = '')
{
    if (empty($key)) {
        session_destroy(); // Xóa toàn bộ session (lan reload tiep theo se mat)
        return true;
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }
    return false;
}


// Hàm gán flash data
function setFlashData($key, $value)
{
    $key = 'flash_' . $key;
    return setSession($key, $value);
}

// Hàm lấy flash data
function getFlashData($key)
{
    $key = 'flash_'.$key;
    $data = getSession($key);

    removeSession($key); // Xóa flash data sau khi đã lấy ra
    return $data;
}