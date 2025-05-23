<?php
if (!defined('_INCODE')) die('Access Deined...');
layout('header-login', ['pageTitle' => 'Quên mật khẩu']);

// Kiểm tra có đang đăng nhập, nếu đang đăng nhập quay trở lại index users
removeSession();
if (isLogin()) {
    redirect('?module=users');
}

// xử lý đăng nhập
if (isPost()) {
    $body = getBody();
    // print_r($body);
    if (!empty($body['email']) && isEmail(trim($body['email']))) {

        $email = $body['email'];
        $queryUser = firstRaw("SELECT id FROM users WHERE email='$email'");
        print_r($queryUser);
        if (!empty($queryUser)) {
            $userId = $queryUser['id'];
            print_r($userId);
            // Tạo forgotToken
            $forgotToken = sha1(uniqid() . time());
            $dataUpdate = [
                'forgotToken' => $forgotToken
            ];
            $updateStatus = update('users', $dataUpdate, "id=$userId");
            if ($updateStatus) {
                //Tạo link khôi phục
                $linkReset = _WEB_HOST_ROOT . '?module=auth&action=reset&token=' . $forgotToken;
                //Thiết lập gửi email
                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn: ' . $email . '<br/>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để khôi phục: <br/>';
                $content .= $linkReset . '<br/>';
                $content .= 'Trân trọng!';

                //Tiến hành gửi email
                $sendStatus = sendMail($email, $subject, $content);
                if ($sendStatus) {
                    setFlashData('msg', 'Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Địa chỉ email không tồn tại trong hệ thống');
            setFlashData('msg_type', 'danger');
        }
    } else {
    }
    redirect('?module=auth&action=forgot');
}


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
print_r($msg);
print_r($msgType);

?>

<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đặt lại mật khẩu</h3>
        <?php getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email...">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Xác nhận</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php

layout('footer-login');
