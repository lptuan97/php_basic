<?php
if (!defined('_INCODE')) die('Access Deined...');
/*File này chứa chức năng đăng ký*/
// $data = [
//     'pageTitle' => 'Đăng ký tài khoản'
// ];
layout('header-login', 'Đăng ký tài khoản');

// print_r($_POST);
// echo "<br>";

if (isPost()) {
    $body = getBody(); // Lấy dữ liệu từ form
    $errors = []; // Khởi tạo mảng lưu lỗi

    // VALIDATE DỮ LIỆU
    // 1. Kiểm tra họ tên >= 5 ký tự & Bắt buộc nhập
    if (empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
    } else {
        if (strlen(trim($body['fullname'])) < 5) {
            $errors['fullname']['min'] = 'Họ tên phải nhiều hơn 5 ký tự';
        }
    }

    // 2. Kiểm tra điện thoại: Bắt buộc nhập & Định dạng số điện thoại
    if (empty(trim($body['phone']))) {
        $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập';
    } else {
        if (!isPhone(trim($body['phone']))) {
            $errors['phone']['isPhone'] = 'Số điện thoại không đúng định dạng';
        }
    }

    // 3. Kiểm tra định dạng email:
    // 3.1 Bắt buộc nhập
    // 3.2 Đúng định dạng email (isEmail in function.php)
    // 3.3 Email chưa tồn tại trong database 
    if (empty(trim($body['email']))) {
        $errors['email']['require'] = 'Email không được để trống';
    } else {
        if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không đúng định dạng';
        } else {
            //Kiểm tra email có tồn tại trong database
            $email = trim($body['email']);
            $sql = "SELECT id FROM users WHERE email = '$email'";
            // ****** "$email" --> giá trị biến $email tuale@gmai.com || '$email' --> chuỗi $email 
            if (getRows($sql) > 0) {
                $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
            }
        }
    }

    // 4. Kiểm tra mật khẩu:
    // 4.1 Bắt buộc nhập
    // 4.2 >= 8 ký tự
    if (empty(trim($body['password']))) {
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    } else {
        if (strlen(trim($body['password'])) < 8) {
            $errors['password']['min'] = 'Mật khẩu ít nhất 8 ký tự';
        }
    }

    // 5. Kiểm tra mật khẩu nhập lại:
    // 5.1 Bắt buộc nhập
    // 5.2 Trùng khớp với trường mật khẩu
    if (empty(trim($body['confirm_password']))) {
        $errors['confirm_password']['required'] = 'Xác nhận mật khẩu không được để trống';
    } else {
        if (trim($body['password']) != trim($body['confirm_password'])) {
            $errors['confirm_password']['match'] = 'Hai mật khẩu không trùng khớp';
        }
    }

    //THỰC THI INSERT DỮ LIỆU
    // 1. Kiểm tra mảng $errors (Nếu rỗng tiếp tục)
    if (empty($errors)) {
        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'email' => $body['email'],
            'fullname' => $body['fullname'],
            'phone' => $body['phone'],
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'createAt' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('users', $dataInsert);

        // Kiểm tra $insertStatus thành công thì tiến hành gửi mail
        if ($insertStatus) {
            //Tạo link kích hoạt
            $linkActive = _WEB_HOST_ROOT . '?module=auth&action=active&token=' . $activeToken;

            // Thiết lập gửi mail
            $subject = $body['fullname'] . 'vui lòng kích hoạt tài khoản';
            $content = 'Chào bạn: ' . $body['fullname'] . '<br/>';
            $content .= 'Vui lòng truy cập vào đường dẫn bên dưới để kích hoạt tải khoản: <br/>';
            $content .= $linkActive . '<br/>';
            $content .= 'Trân trọng!';

            //Tiến hành gửi mail
            $sendStatus = sendMail($body['email'], $subject, $content);
            if ($sendStatus) {
                setFlashData('msg', 'Đăng ký tài khoản thành công. Vui lòng kiểm tra email để kích hoạt tài khoản');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
        redirect('?module=auth&action=register');
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=auth&action=register'); //Load lại trang đăng ký
    }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// echo '<pre> đây là $msg';
// print_r($msg);
// echo '</pre>';
// echo '<pre>';
// print_r($msgType);
// echo '</pre>';
// echo '<pre>';
// print_r($errors);
// echo '</pre>';
// echo '<pre>';
// print_r($old);
// echo '</pre>';

?>
<div class="row">
    <div class="col-6" style="margin: 20px auto;">

        <h3 class="text-center text-uppercase">Đăng ký tài khoản</h3>
        <?php
        getMsg($msg, $msgType);
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Họ tên..." value="<?php echo old('fullname', $old); ?>">
                <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="Điện thoại..." value="<?php echo old('phone', $old); ?>">
                <?php echo form_error('phone', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Địa chỉ email..." value="<?php echo old('email', $old); ?>">
                <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu...">
                <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập hệ thống</a></p>
        </form>
    </div>
</div>

<?php
layout('footer-login');
