<?php
session_start();

require_once '../handler_database.php';

if (empty($_SESSION['user_admin_id']))
    header('location: login.php');

$admin_header = new handler_database();

$admin_name = $admin_header->get_list('select * from users');

foreach ($admin_name as $v) {
    if ($v['id_user'] == $_SESSION['user_admin_id']) {
        $name = $v['name_user'];
    }
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../css/style_admin.css">
    <LINK REL="SHORTCUT ICON" HREF="../image/logo.png">

    <!--    nhúng trình soạn thảo văn bản-->
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <title>Admin</title>
</head>
<body>

<div class="header">

    <div class="header__top">
        <div class="container">

            <div class="header__top--left">
                <img src="../image/logo.png" alt="">
            </div>

            <div class="header__top--right">

                <a href="#" disabled="disabled">
                    <p><?php echo $name; ?></p>
                    <i class="fas fa-user"></i>
                </a>

                <ul>
                    <li>
                        <a href="info_admin.php">
                            <i class="fas fa-user"></i>
                            Tài khoản
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <i class="fas fa-sign-out-alt"></i>
                            Đăng xuất
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </div>

    <div class="header__center">
        <div class="container">
            <ul>
                <li>
                    <a href="index.php">
                        <i class="fas fa-eye"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>

                <li class="menu">
                    <a disabled="disabled">
                        <i class="fas fa-cube"></i>
                        <span>Hàng hóa</span>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="products.php">
                                <i class="fas fa-bars"></i>
                                <span>Danh mục</span>
                            </a>
                        </li>
                        <li>
                            <a href="price_products.php">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span>Thiết lập giá</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="bills.php">
                        <i class="fas fa-journal-whills"></i>
                        <span>Hóa đơn</span>
                    </a>
                </li>

                <li>
                    <a href="users.php">
                        <i class="fas fa-users"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>

                <li>
                    <a href="news.php" class="selected_nav">
                        <i class="fas fa-users"></i>
                        <span>Tin tức</span>
                    </a>
                </li>

                <li class="menu">
                    <a disabled="disabled">
                        <i class="fas fa-users"></i>
                        <span>Báo cáo thống kê</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a  href="report_bills.php" >
                                <i class="fas fa-bars"></i>
                                <span>Báo cáo doanh thu</span>
                            </a>
                        </li>
                        <li>
                            <a href="report_products.php">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span>Báo cáo sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="report_users.php">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span>Báo cáo khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


</div>

<div class="main__products">
    <div class="container">


        <div class="main__products--right">

            <div class="main__products--right__header">

                <div>
                    <i class="fas fa-search"></i>
                    <form action="news.php" method="post">
                        <input type="text" name="name" placeholder="Tìm tin tức theo tiêu đề">
                        <input type="submit" name="search_news" style="display: none;">
                    </form>


                </div>

                <div>
                    <i class="fas fa-plus"></i>
                    <p>Thêm tin mới</p>
                </div>

            </div>

            <div class="main__products--right__center bills--center">
                <table cellpadding="5" cellspacing="0">
                    <colgroup>
                        <col width="150" span="1">
                        <col width="80" span="1">
                        <col width="150" span="1">
                        <col width="80" span="1">
                        <col width="80" span="1">
                        <col width="150" span="1">
                        <col width="400" span="1">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>Ảnh minh họa</th>
                        <th>Mã tin</th>
                        <th>Tiêu đề</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>
                        <th>Mô tả tóm tắt</th>
                        <th>Mô tả chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $select_news = new handler_database();
                    if (isset ($_POST['search_news'])) {

                        $search = $_POST['name'];

                        $search = str_replace('"', '\\"', trim($search));
                        $search = str_replace("'", "\\'", trim($search));

                        echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = '" . $_POST['name'] . "' </script>";


                    }

                    if (isset($search) && $search != '') {

                        $result = $select_news->get_list('select * from news where new_title like\'%' . $search . '%\'');

                    } else $result = $select_news->get_list('select * from news');

                    if ($result)
                        foreach ($result as $v) {
                            echo "<tr>
                                        <td><img src='../image/news/" . $v['new_image'] . "' alt='' width='128'></td>
                                        <td class='new_id'>" . $v['new_id'] . "</td>
                                        <td>" . $v['new_title'] . "</td>
                                        <td>" . $v['created_at'] . "</td>
                                        <td>" . $v['updated_at'] . "</td>
                                        <td>" . $v['new_short_description'] . "</td>
                                        <td class='short'>" . $v['new_description'] . "</td>
                                    </tr>";
                        }
                    else echo "<tr>
                                            <td colspan='7'>Không tìm thấy dữ liệu</td>
                                            </tr>";
                    ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>


<!--đang có lỗi phần hiển thị textarea. 16/10 xử lý -->
<div class="form_handler_news">

    <div>

        <div>
            <h3>Form thêm tin tức</h3>
            <i class="fas fa-times"></i>
        </div>

        <form action="news.php" method="post" enctype="multipart/form-data">

            <div>
                <strong>Ảnh minh họa:</strong>
                <input type="file" name="new_image">
            </div>

            <div>
                <strong>Tiêu đề:</strong>
                <input type="text" name="new_title">
            </div>

            <div>
                <strong>Mô tả tóm tắt:</strong>
                <input type="text" name="new_short_description">
            </div>

            <div>
                <strong>Mô tả chi tiết:</strong>
                <textarea name="new_description" id="new_description" cols="30" rows="10">
                    <?php
                        if ( isset($_COOKIE['new_id_handler'])){

                            $description = new handler_database();

                            $row = $description->get_list('select new_description from news where new_id = '.$_COOKIE['new_id_handler']);

                            if ($row){

                                foreach ($row as $v)
                                    echo $v['new_description'];

                            }else die('Có lỗi!');

                        }
//                    ?>
                </textarea>
            </div>

            <div>
                <input type="submit" value="Thêm" name="insert_new">
                <input type="submit" value="Xóa" name="detele_new">
                <input type="submit" value="Sửa" name="update_new">
            </div>

        </form>

    </div>

</div>

</body>
</html>
<script src="../js/admin/js_all.js"></script>
<?php
require_once 'handler_news.php';
require_once  'handler_logout.php';
?>
<style>
    td.short img {
        width: 64px;
        height: 64px;
    }

    td.short {
        height: 150px;
        overflow-y: scroll;
        display: inline-block;
        width: 95%;
    }
</style>





