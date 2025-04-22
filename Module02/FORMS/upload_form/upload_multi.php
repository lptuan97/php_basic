<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    print_r($_FILES['file_upload']);
    echo '</pre>';

    $allowedArr = ['mp4', 'jpg', 'png', 'gif', 'mov', 'jpeg']; //Mảng lưu trữ các định đạng file cho phép

    $maxFileSize = 41205;

    if (!empty($_FILES['file_upload'])) {
        foreach ($_FILES['file_upload']['name'] as $key => $fileName) {
            $fileOr = $fileName;
            //Đổi tên file
            $fileNameArr = explode('.', trim($fileName));

            $fileExt = end($fileNameArr);

            $fileBefore = sha1(uniqid());

            $fileName = $fileBefore . '.' . $fileExt;

            if (in_array($fileExt, $allowedArr)) {
                if ($_FILES['file_upload']['size'][$key] <= $maxFileSize) {
                    $upload = move_uploaded_file($_FILES['file_upload']['tmp_name'][$key], './uploads/' . $fileName);
                    if ($upload) {
                        echo 'Upload file: ' . $fileOr . ' thành công. <a href="./uploads/' . $fileName . '">' . $fileOr . '</a><br/>';
                    } else {
                        echo 'Upload file: ' . $fileOr . ' không thành công<br/>';
                    }
                } else {
                    echo 'File ' . $fileOr . ' vượt quá dung lượng cho phép<br/>';
                }
            } else {
                echo 'File ' . $fileOr . ' không đúng định dạng cho phép<br/>';
            }
        }
    }
}
?>