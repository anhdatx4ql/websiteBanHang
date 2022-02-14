<!--Thiết kế lại index => hiển thị số lượng hàng hóa, hóa đơn, khách hàng, bản tin, tổng tiền đã bán.-->

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
                    <a href="index.php" class="selected_nav">
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


<div class="main_news">

    <div class="container">

        <div class="sum__price__bills">
            <p>Tổng số tiền hàng đã bán: </p>
            <?php
                $new = new handler_database();

                $re = $new->get_list('select sum(bills.money) from bills');

                if ($re){

                    foreach ($re as $v)
                        $sum = $v['sum(bills.money)'];

                    echo "<strong>".number_format($sum, 0, ',', '.') ."đ</strong>";

                }

            ?>
            <a href="report_bills.php">Chi tiết</a>
        </div>

        <div class="main__handler_product">

            <div>
                <?php
                $new = new handler_database();
                $re = $new->get_list('SELECT COUNT(product_id) FROM products');

                if($re){

                    foreach ($re as $r)
                        $count =$r['COUNT(product_id)'];

                    echo "<h2>Hàng hóa <p>(có ".$count." hàng hóa)</p> </h2>
                                <a href=\"products.php\">Quản lý</a>";

                }else{

                    echo "<h2>Hàng hóa <p>(không có hàng hóa)</p> </h2>
                                <a href=\"products.php\">Quản lý</a>";
                }


                ?>
            </div>

        </div>

        <div class="main__handler_bills">
            <div>
                <?php
                    $new = new handler_database();
                    $re = $new->get_list('SELECT COUNT(bill_id) FROM bills');

                    if($re){

                        foreach ($re as $r)
                            $count =$r['COUNT(bill_id)'];

                        echo "<h2>Hóa đơn <p>(có ".$count." hóa đơn)</p> </h2>
                                <a href=\"bills.php\">Quản lý</a>";

                    }else{

                        echo "<h2>Hóa đơn <p>(không có hóa đơn)</p> </h2>
                                <a href=\"bills.php\">Quản lý</a>";
                    }


                ?>

            </div>

        </div>

        <div class="main__handler_users">
            <div>
                <?php
                $new = new handler_database();
                $re = $new->get_list( "select COUNT(users.id_user) from users inner join role on role.role_id = users.role_id not in (select COUNT(users.id_user) from users inner join role on role.role_id = users.role_id where role_name = 'admin')" );

                if($re){

                    foreach ($re as $r)
                        $count =$r['COUNT(users.id_user)'];

                    echo "<h2>Khách hàng <p>(có ".$count." khách hàng)</p> </h2>
                                <a href=\"users.php\">Quản lý</a>";

                }else{

                    echo "<h2>Khách hàng <p>(không có khách hàng)</p> </h2>
                                <a href=\"users.php\">Quản lý</a>";
                }


                ?>
            </div>

        </div>

        <div class="main__handler_news">
            <div>
                <?php
                $new = new handler_database();
                $re = $new->get_list( "select COUNT(new_id) from news" );

                if($re){

                    foreach ($re as $r)
                        $count =$r['COUNT(new_id)'];

                    echo "<h2>Bản tin <p>(có ".$count." bản tin)</p> </h2>
                                <a href=\"news.php\">Quản lý</a>";

                }else{

                    echo "<h2>Bản tin <p>(không có bản tin)</p> </h2>
                                <a href=\"news.php\">Quản lý</a>";
                }


                ?>
            </div>
        </div>

    </div>


</div>

</body>
</html>

<style>
    .main_news>.container>div>div:first-child>h2>p {
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-style: italic;
    }
</style>
<script src="../js/admin/js_all.js"></script>
<?php require_once  'handler_logout.php'; ?>


