<?php
if (!defined('_INCODE')) die('Access Deined...');
/*
 * File này hiển thị danh sách người dùng
 * */

layout('header',  'Quản lý người dùng');

//Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    //Xử lý lọc status
    if (!empty($body['status'])) {
        $status = $body['status'];

        if ($status == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $status;
        }

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= "WHERE status=$statusSql";
    }

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator fullname LIKE '%$keyword%'";
    }
}




// Xử lý phân trang
$allUserNum = getRows("SELECT id FROM users $filter");


// Thuật toán phân trang
// 1. Xác định được số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; //Mỗi trang có 3 bản ghi
// 2. Tính số trang
$maxPage = ceil($allUserNum / $perPage); //ceil() làm tròn 5.1 = 6
//3. Xử lý số trang dựa vào phương thức GET
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}
// Tính toán offset trong limit dự vào biến $page
/*
$page = 1 => offset = 0 -> ($page-1)*$perPage = (1-1)*3 = 0 
$page = 2 => offset = 3 -> ($page-1)*$perPage = (2-1)*3 = 0 
$page = 3 => offset = 6 -> ($page-1)*$perPage = (3-1)*3 = 0 
*/
// $offset = 0;
$offset = ($page - 1) * $perPage;


//Truy vấn lấy tất cả bản ghi sử dụng LIMIT (giới hạn số lượng) & OFFSET (Vị trí phần tử bắt đầu lấy)
$listAllUser = getRaw("SELECT * FROM users $filter LIMIT $offset, $perPage");


// Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');


?>


<!-- Hiển thị giao diện html -->
<div class="container">
    <?php
    getMsg($msg, $msgType);
    ?>
    <hr />
    <div class="row">
        <p class="col-3">
            <a href="?module=users&action=add" class="btn btn-success ">Thêm người dùng <i class="fa fa-plus"></i> </a>
        </p>
        <form class="col-9" action="" method="get">
            <input type="hidden" name="module" value="users">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="0">Chọn trạng thái</option>
                            <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : false; ?>>Kích hoạt</option>
                            <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..." value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>

    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Trạng thái</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xoá</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($listAllUser)):
                $count = $offset + 1;
                foreach ($listAllUser as $item):
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $item['fullname']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo $item['phone']; ?></td>
                        <td><?php echo $item['status'] == 1 ? '<button type="button" class="btn btn-success btn-sm">Kích hoạt</button>' : '<button type="button" class="btn btn-warning btn-sm">Chưa kích hoạt</button>'; ?></td>
                        <td><a href="<?php echo _WEB_HOST_ROOT . '?module=users&action=edit&id=' . $item['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-trash-o"></i>sửa</a></td>
                        <td><a href="<?php echo _WEB_HOST_ROOT . '?module=users&action=delete&id=' . $item['id']; ?>" onclick="return confirm('Are you sure delete <?php echo $item['fullname']; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>xóa</a></td>

                    </tr>

                <?php
                    $count++;
                endforeach;
            else: ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không có người dùng</div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">


            <!-- trước -->
            <?php
            if ($page <= 1) {
                $classPrev = 'disabled';
                $adressPrev = 1;
            } else {
                $adressPrev = $page - 1;
                $classPrev = '';
            }
            $linkPrev = _WEB_HOST_ROOT . "?module=users" . $queryString . "&page=" . $adressPrev;
            ?>
            <li class="page-item <?php echo $classPrev; ?>">
                <a class="page-link " href="<?php echo $linkPrev; ?>" tabindex="-1">Previous</a>
            </li>
            <!-- số trang ở giữa -->

            <!-- giới hạn số lượng 5 -->
            <?php
            // Thiết lập số trang bắt đầu
            $begin = $page - 2;
            if ($begin < 1) {
                $begin = 1;
            }
            // Thiết lập số trang kết thúc
            $end = $page + 2;
            if ($end > $maxPage) {
                $end = $maxPage;
            }
            ?>
            <?php for ($i = $begin; $i <= $end; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : false; ?> ">
                    <a class="page-link" href="<?php echo _WEB_HOST_ROOT . "?module=users" . $queryString . "&page=" . $i; ?>"><?php echo $i; ?>
                        <span class="sr-only"></span>
                    </a>
                </li>
            <?php endfor ?>

            <!-- sau -->
            <?php
            if ($page == $maxPage) {
                $classNext = 'disabled';
                $adressNext = $page;
            } else {
                $classNext = '';
                $adressNext = $page + 1;
            }
            $linkNext = _WEB_HOST_ROOT . "?module=users" . $queryString . "&page=" . $adressNext;
            ?>
            <li class="page-item <?php echo $classNext; ?>">
                <a class="page-link" href="<?php echo $linkNext; ?>">Next</a>
            </li>
        </ul>
    </nav>
    <hr />

</div>

<?php
layout('footer');
