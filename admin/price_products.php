<?php session_start();

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
                    <a href="index.php">
                        <i class="fas fa-eye"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>

                <li class="menu">
                    <a disabled="disabled" class="selected_nav">
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

<div class="main__products">
    <div class="container">

        <!--        <div class="main__products--left">-->
        <!---->
        <!--            <div class="main__products--left__header">-->
        <!--                <b>Nhóm hàng</b>-->
        <!--                <i class="fas fa-plus-circle"></i>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="main__left--search">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--                <input type="text" placeholder="Tìm kiếm nhóm hàng">-->
        <!--            </div>-->
        <!---->
        <!--            <div class="main__products--left__navigation">-->
        <!--                <ul>-->
        <!--                    <li><a href="">Tất cả</a></li>-->
        <!--                    --><?php
        //                    $category = new handler_database();
        //                    $row_cate= $category ->get_list("select * from categories");
        //                    foreach ($row_cate as $v){
        //                        echo "<li>
        //                                    <a href=\"\">".$v['category_name']."</a>
        //                                </li>";
        //                    }
        //                    ?>
        <!---->
        <!--                </ul>-->
        <!--            </div>-->
        <!---->
        <!--        </div>-->

        <div class="main__priceProducts--right">

            <!--            <div class="main__priceProducts--right__header">-->
            <!---->
            <!--                <div>-->
            <!--                    <i class="fas fa-search"></i>-->
            <!---->
            <!--                    <input type="text" placeholder="Tìm kiếm hàng theo mã, tên hàng">-->
            <!---->
            <!--                </div>-->
            <!---->
            <!--                <div>-->
            <!--                    <i class="fas fa-plus"></i>-->
            <!--                    <p>Thêm hàng mới</p>-->
            <!--                </div>-->
            <!---->
            <!--            </div>-->

            <div class="main__priceProducts--right__center">
                <table cellpadding="5" cellspacing="0">
                    <colgroup>
                        <col width="50" span="1">
                        <col width="250" span="1">
                        <col width="150" span="3">
                        <col width="80" span="1">
                        <col width="200" span="1">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>Mã hàng</th>
                        <th>Tên hàng</th>
                        <th>Tồn kho</th>
                        <th>Giá vốn</th>
                        <th>Giá nhập cuối</th>
                        <th>Giá chung</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">
                            <form action="price_products.php" method="post">
                                <input type="text" name="text" placeholder="Tìm kiếm tên hàng">
                                <input type="submit" name="search_price_product" style="display: none">
                            </form>
                        </td>
                    </tr>
                    <?php
                    $price_product = new handler_database();


                    if (isset($_POST['search_price_product'])) {

                        if ($_POST['text'] == "")
                            $sql = "select * from products";
                        else {

                            $sql = str_replace('"', '\\"', $_POST["text"]);

                            $sql = str_replace("'", "\\'", $sql);

                            $sql = ' select * from products where product_name like \'%' . $sql . '%\' ';

                            echo "<script>document.querySelector('.main__priceProducts--right__center>table>tbody input[name=\"text\"]').value = '" . $_POST["text"] . "'</script>";

                        }

                    } else
                        $sql = "select * from products";

                    $row = $price_product->get_list($sql);

                    if ($row) {
                        foreach ($row as $item) {
                            if ((int)$item['product_amount'] > 0)
                                echo "<tr>
                                    <form action='price_products.php' method='post'>
                                    <input type='text' name='product_id' value='" . $item['product_id'] . "' style='display: none;'>
                                    <td>" . $item['product_code'] . "</td>
                                    <td>" . $item['product_name'] . "</td>
                                    <td>" . $item['product_amount'] . "</td>
                                    <td>" . number_format($item['product_price'], 0, ',', ',') . "</td>
                                    <td>" . number_format($item['product_price'], 0, ',', ',') . "</td>
                                    <td><input type=\"text\" id='id" . $item['product_id'] . "' name='cost_price' onkeyup=\"this.value=this.value.replace(/[^\d]/,'')\" 
                                    value='" . number_format($item['product_cost_price'], 0, ',', ',') . "'></td>
                                    <td><input type='submit' name='update_product' value='Cập nhật'></td>
                                    </form>
                                </tr>";

                        }
                    } else echo "<tr> <td colspan='7' style='opacity: 0.5'>Không tìm thấy kết quả</td></tr>"

                    ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

</body>
</html>
<script src="../js/admin/js_all.js"></script>
<?php
require_once 'handler_price_product.php';
require_once  'handler_logout.php';
?>
