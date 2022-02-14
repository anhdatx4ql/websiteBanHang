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
                    <a href="news.php">
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

<div class="main__info-admin">

    <div class="container">

        <form action="info_admin.php" method="post">

<!--            load info admin-->

            <?php

                $new = new handler_database();

                $info_admin = $new->get_list('select * from users inner join role on role.role_id =users.role_id
                        where users.role_id = '.$_SESSION['user_admin_id']);

                if ( $info_admin){

                    foreach ($info_admin as $item) {
                        if ( $item['role_name'] =="admin")
                            echo "
                                <div>
                                    <strong>Tên người dùng</strong>
                                    <input type=\"text\" name=\"fullname\" value='".$item['name_user']."'>
                                </div>
                    
                                <div>
                                    <strong>Tên đăng nhập</strong>
                                    <input type=\"text\" name=\"nickname\" disabled value='".$item['nickname']."'>
                                </div>
                    
                                <div>
                                    <strong>Vai trò</strong>
                                    <input type=\"text\" disabled name=\"role_name\" value='".$item['role_name']."'>
                                </div>
                    
                                <div>
                                    <strong>Điện thoại</strong>
                                    <input type=\"tel\" name=\"phone\" value='".$item['phone_user']."' onkeyup=\"this.value=this.value.replace(/[^\d]/,'')\">
                                </div>
                    
                                <div>
                                    <strong>Ngày sinh</strong>
                                    <input type=\"date\" name=\"date_birth\" value='".$item['date_birth_user']."'>
                                </div>
                    
                                <div>
                                    <strong>Email:</strong>
                                    <input type=\"email\" name=\"email\" value='".$item['email_user']."'>
                                </div>
                    
                                <div>
                                    <strong>Địa chỉ:</strong>
                                    <input type=\"text\" name=\"address\" value='".$item['address_user']."'>
                                </div>
                    
                                <div>
                                    <input type=\"submit\" name=\"update_info\" value=\"Lưu\">
                                    <a href=\"\">Đổi mật khẩu</a>
                                </div>";

                    }

                }

            ?>

        </form>

    </div>

    <div id="main__info-admin__pass">

        <div>
            <form action="info_admin.php" method="post">

                <div>
                    <h2>Form đổi mật khẩu</h2>
                    <i class="fas fa-times"></i>
                </div>

                <div>
                    <strong>Nhập mật khẩu hiện tại</strong>
                    <input type="password" name="current_pass">
                </div>

                <div>
                    <strong>Nhập mật khẩu mới</strong>
                    <input type="password" name="pass">
                </div>

                <div>
                    <strong>Nhập lại mật khẩu mới</strong>
                    <input type="password" name="confirm_pass">
                </div>

                <div>
                    <input type="submit" name="submit_pass" value="Xác nhận">
                </div>

            </form>
        </div>

    </div>

</div>



</body>
</html>
<script src="../js/admin/js_all.js"></script>
<?php
    require_once  'handler_logout.php';
    require_once  'handler_info_admin.php'
?>

