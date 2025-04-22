<?php
//Kiểm tra phương thức post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = []; //Lưu trữ lỗi khi upload

    $allowedArr = ['mp4', 'jpg', 'png', 'gif', 'mov', 'jpeg']; //Mảng lưu trữ các định đạng file cho phép

    $maxFileSize = 41205; //Kích thước tối đa được phép upload

    $pathUpload = './uploads';


    //Lấy thông tin file
    if (!empty($_FILES['file_upload'])) {

        //Lấy tên file
        $fileName = $_FILES['file_upload']['name'];

        //Đổi tên file
        $fileNameArr = explode('.', trim($fileName));

        $fileExt = end($fileNameArr);

        $fileBefore = sha1(uniqid());
        //        $fileBefore = str_replace('.'.$fileExt, '', $fileName);
//        $fileBefore = $fileBefore.'_'.uniqid();

        $fileName = $fileBefore . '.' . $fileExt;

        //Kiểm tra xem file đã được chọn chưa
        if ($_FILES['file_upload']['error'] == 4) {
            $errors['choose_file'] = 'Vui lòng chọn file';
        } else {

            //Kiểm tra định dạng được phép
            if (!in_array($fileExt, $allowedArr)) {
                $errors['allow_ext'] = 'Định dạng không được phép, chỉ chấp nhận: ' . implode(', ', $allowedArr);
            }

            //Kiểm tra size
            if (!empty($_FILES['file_upload']['size'])) {
                $size = $_FILES['file_upload']['size'];
                if ($size > $maxFileSize) {
                    $errors['max_size'] = 'Dung lượng vượt quá cho phép, chỉ được upload <= ' . number_format($maxFileSize) . ' byte';
                }
            } else {
                $errors['file_error'] = 'File bị lỗi, vui lòng kiểm tra lại';
            }

        }

        //Kiểm tra mảng $errors để thực hiện upload
        if (empty($errors)) {
            $upload = move_uploaded_file($_FILES['file_upload']['tmp_name'], $pathUpload . '/' . $fileName);

            if ($upload) {
                echo 'Upload thành công';
            } else {
                echo 'Upload không thành công';
            }
        } else {
            foreach ($errors as $item) {
                echo $item . '<br/>';
            }
        }
    }
}