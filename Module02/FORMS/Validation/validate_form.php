<?php
// require_once 'functions.php';
/*
 * Rules:
 * - fullname: Phải nhập, lớn hơn 5 ký tự
 * - email: phải nhập, định dạng email
 * - age: phải nhập, là số, là số nguyên dương
 * */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Khai báo mảng $errors để chứa lỗi
    $errors = [];

    //Validate fullname
    if (empty(trim($_POST['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên không được để trống';
    } else {
        if (strlen(trim($_POST['fullname'])) < 5) {
            $errors['fullname']['min'] = 'Họ tên phải lớn hơn 5 ký tự';
        }
    }

    //Validate email
    if (empty(trim($_POST['email']))) {
        $errors['email']['required'] = 'Email không được để trống';
    } else {
        if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $errors['email']['invaild'] = 'Email không hợp lệ';
        }
    }

    //Validate age
    if (empty(trim($_POST['age']))) {
        $errors['age']['required'] = 'Tuổi không được để trống';
    } else {
        if (
            !filter_var(trim($_POST['age']), FILTER_VALIDATE_INT, options: [
                'options' => ['min_range' => 1]
            ])
        ) {
            $errors['age']['invaild'] = 'Tuổi không hợp lệ';
        }
    }

    if (empty($errors)) {
        redirect('list.php?message=1');
    } else {
        echo 'Validate không thành công<br/>';
    }
}
?>
<form method="post">
    <p>
        Họ và tên: <br />
        <input type="text" name="fullname" placeholder="Họ và tên..."
            value="<?php echo (!empty($_POST['fullname'])) ? $_POST['fullname'] : false; ?>" /><br />
        <?php
        echo (!empty($errors['fullname']['required'])) ? '<span style="color: red;">' . $errors['fullname']['required'] . '</span>' : false;

        echo (!empty($errors['fullname']['min'])) ? '<span style="color: red;">' . $errors['fullname']['min'] . '</span>' : false;
        ?>
    </p>

    <p>
        Email: <br />
        <input type="text" name="email" placeholder="Email..."
            value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : false; ?>" /><br />
        <?php
        echo (!empty($errors['email']['required'])) ? '<span style="color: red;">' . $errors['email']['required'] . '</span>' : false;

        echo (!empty($errors['email']['invaild'])) ? '<span style="color: red;">' . $errors['email']['invaild'] . '</span>' : false;
        ?>
    </p>

    <p>
        Tuổi: <br />
        <input type="text" name="age" placeholder="Tuổi..."
            value="<?php echo (!empty($_POST['age'])) ? $_POST['age'] : false; ?>" /><br />
        <?php
        echo (!empty($errors['age']['required'])) ? '<span style="color: red;">' . $errors['age']['required'] . '</span>' : false;

        echo (!empty($errors['age']['invaild'])) ? '<span style="color: red;">' . $errors['age']['invaild'] . '</span>' : false;
        ?>
    </p>
    <p>
        <button type="submit">Submit</button>
    </p>
</form>