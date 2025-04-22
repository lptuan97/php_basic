<?php
if (!defined('_INCODE'))
    die('Access Deined...');

if (!isLogin()) {
    redirect('?module=auth&action=login');
} else {
    $userId = isLogin()['userId'];
    $userDetail = getUserInfo($userId);
}

saveActivity(); //Lưu lại hoạt động cuối cùng của user

autoRemoveTokenLogin();
?>
<html>

<head>
    <title>Quản lý người dùng</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style.css?ver=<?php echo rand(); ?>" />
</head>

<body>
    <header>
        <div class="container">
            <a class="navbar-brand" href="<?php echo _WEB_HOST_ROOT . '?module=users'; ?>">Unicode Academy</a>
            <div class="row d-flex">
                <div class="col-3">
                    <a class="nav-link" href="<?php echo _WEB_HOST_ROOT . '?module=users'; ?>">Tổng quan</a>
                </div>
                <div class="col-9">
                    <a class="m-3">
                        Hi, <?php echo $userDetail['fullname']; ?>
                    </a>
                    <a class="m-3">Đổi mật khẩu</a>
                    <a class="m-3" href="<?php echo _WEB_HOST_ROOT . '?module=auth&action=logout'; ?>">Đăng xuất</a>
                </div>
            </div>
        </div>

    </header>