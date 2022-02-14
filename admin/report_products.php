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
                    <a disabled="disabled" class="selected_nav">
                        <i class="fas fa-users"></i>
                        <span>Báo cáo thống kê</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="report_bills.php">
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

<div class="main__report-bills">
    <div class="container">

        <div class="main__report-bills__left">

            <form action="report_products.php" method="post">

                <div>
                    <h3>Ngày nhập</h3>
                </div>

                <div>
                    <span>Từ ngày</span>
                    <input type="date" name="day_one"
                           value="<?php echo isset($_POST['day_one']) ? $_POST['day_one'] : "" ?>">
                </div>

                <div>
                    <span>Đến ngày</span>
                    <input type="date" name="day_two"
                           value="<?php echo isset($_POST['day_two']) ? $_POST['day_two'] : "" ?>">
                </div>

                <div>
                    <input type="submit" name="search_time" value="Tìm kiếm">
                </div>

            </form>


        </div>

        <div class="main__report-bills__right">
            <div>
                <h2>Báo cáo sản phẩm</h2>
            </div>

            <div class="info_report_bills">

                <div>
                    <span>Tổng tồn kho</span>
                    <?php
                    $sum=0;
                    $pro_amount = new handler_database();
                    $sql = 'SELECT sum(product_amount) FROM products';
                    $amount = $pro_amount->get_list($sql);
                    foreach ($amount as $value)
                        $sum+= $value['sum(product_amount)'] ;
                    echo('<span>'.$sum.'</span>')

                    ?>
                </div>

                <div>
                    <span>Đã bán</span>
                    <?php
                    $sum=0;
                    $bills_amount = new handler_database();
                    $sql = 'SELECT sum(bill_product_amount) FROM bills_products';
                    $pay_amount = $bills_amount->get_list($sql);
                    foreach ($pay_amount as $value)
                        $sum+= $value['sum(bill_product_amount)'] ;
                    echo('<span>'.$sum.'</span>')
                    ?>


                </div>

            </div>
            <div class="main__report-bills__right--full">

                <div class="main__products--right__header">

                    <div>
                        <i class="fas fa-search"></i>

                        <form action="report_products.php" method="post">

                            <input type="text" placeholder="Tìm kiếm hàng theo tên" name="text">

                            <input type="submit" name="search_products" style="display: none;">

                        </form>


                    </div>

                    <div></div>

                </div>

                <div class="main__products--right__center">
                    <table cellpadding="5" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Mã hàng</th>
                            <th>Tên hàng</th>
                            <th>Nhóm hàng</th>
                            <th>Giá bán</th>
                            <th>Giá vốn</th>
                            <th>Thương hiệu</th>
                            <th>Số lượng bán</th>
                            <th>Tồn kho</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $products = new handler_database();

                        if (isset($_POST['search_products'])) {

                            if (trim($_POST['text']) == "") {
                                $sql = "select * from products inner join categories on products.category_id = categories.catedory_id";
                                if(isset($_POST['search_time'])){
                                    if (empty($_POST['day_one']) && empty($_POST['day_two'])) {
                                    } else {

                                        if (!empty($_POST['day_one']) && !empty($_POST['day_two'])) {
                                            if ($_POST['day_one'] > $_POST['day_two']) {
                                                echo("<script>alert('Kiểm tra lại ngày nhập và ngày xuất.')</script>");
                                            } else {
                                                $sql .= ' where created_at BETWEEN \'' . $_POST['day_one'] . ' 0:0:0\' AND \'' . $_POST['day_two'] . ' 0:0:0\'';
                                            }
                                        } else {
                                            if (empty($_POST['day_one'])) {
                                                $sql .= ' where created_at <= \''. $_POST['day_two'] .' 12:59:59\'';
                                            }

                                            if (empty($_POST['day_two'])) {
                                                $sql .= ' created_at >= \''. $_POST['day_one'] .' 12:59:59\'';

                                            }
                                        }


                                    }
                                }
                            } else {

                                $sql = str_replace('"', '\\"', $_POST["text"]);
                                $sql = str_replace("'", "\\'", $sql);

                                $sql = 'select * from products inner join categories on products.category_id = categories.catedory_id where product_name like \'%' . $sql . '%\'';

                                if(isset($_POST['search_time'])){
                                    if (empty($_POST['day_one']) && empty($_POST['day_two'])) {

                                    } else {

                                        if (!empty($_POST['day_one']) && !empty($_POST['day_two'])) {
                                            if ($_POST['day_one'] > $_POST['day_two']) {
                                                echo("<script>alert('Kiểm tra lại ngày nhập và ngày xuất.')</script>");
                                            } else {
                                                $sql .= ' and created_at BETWEEN \'' . $_POST['day_one'] . ' 0:0:0\' AND \'' . $_POST['day_two'] . ' 0:0:0\'';
                                            }
                                        } else {
                                            if (empty($_POST['day_one'])) {
                                                $sql .= ' and bills.created_at <= \''. $_POST['day_two'] .' 12:59:59\'';
                                            }

                                            if (empty($_POST['day_two'])) {
                                                $sql .= ' and bills.created_at >= \''. $_POST['day_one'] .' 12:59:59\'';

                                            }
                                        }


                                    }
                                }

                                echo "<script>document.querySelector('.main__report-bills__right--full>.main__products--right__header>div input').value = '" . $_POST["text"] . "'</script>";

                            }

                        }  else{
                            $sql = "select * from products inner join categories on products.category_id = categories.catedory_id";
                            if(isset($_POST['search_time'])){
                                if (empty($_POST['day_one']) && empty($_POST['day_two'])) {
                                } else {

                                    if (!empty($_POST['day_one']) && !empty($_POST['day_two'])) {
                                        if ($_POST['day_one'] > $_POST['day_two']) {
                                            echo("<script>alert('Kiểm tra lại ngày nhập và ngày xuất.')</script>");
                                        } else {
                                            $sql .= ' where created_at BETWEEN \'' . $_POST['day_one'] . ' 0:0:0\' AND \'' . $_POST['day_two'] . ' 0:0:0\'';
                                        }
                                    } else {
                                        if (empty($_POST['day_one'])) {
                                            $sql .= ' where created_at <= \''. $_POST['day_two'] .' 12:59:59\'';
                                        }

                                        if (empty($_POST['day_two'])) {
                                            $sql .= ' where created_at >= \''. $_POST['day_one'] .' 12:59:59\'';

                                        }
                                    }


                                }
                            }
                        }

                        $row_products = $products->get_list($sql);


                        if ($row_products) {
                            foreach ($row_products as $item) {

                                echo " <tr id='" . $item['product_id'] . "'>
                                        <td><img src='../image/products/" . $item['product_image'] . "' alt='' width='48' height='48'></td>
                                        <td>" . $item['product_code'] . "</td>
                                        <td>" . $item['product_name'] . "</td>
                                        <td>" . $item['category_name'] . "</td>
                                        <td>" . $item['product_cost_price'] . "</td>
                                        <td>" . $item['product_price'] . "</td>
                                        <td>" . $item['product_trademark'] . "</td>";
                                $bills = new handler_database();
                                $sql = 'SELECT sum(bill_product_amount) FROM bills_products WHERE product_id = ' . $item['product_id'];
                                $pay_amount = $bills->get_list($sql);
                                foreach ($pay_amount as $value)
                                    $pay_amount_pro = $value['sum(bill_product_amount)'];
                                if (!$pay_amount_pro)
                                    $pay_amount_pro = 0;
                                echo("
                                        <td>" . $pay_amount_pro . "</td>
                                        <td>" . $item['product_amount'] . "</td>
                                    </tr>");

                            }
                        } else echo "<tr><td colspan='8'>Không có sản phẩm nào</td></tr>"


                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<?php

if (isset($_COOKIE['info_detail_bill_id'])) {

    $new = new handler_database();
    $sql = 'select bills.bill_id,bills.created_at,users.name_user from bills inner join users on users.id_user = bills.user_id where  bill_id = ' . $_COOKIE['info_detail_bill_id'];
    $result = $new->get_list($sql);

    if ($result) {

        foreach ($result as $value) {

            $bill_id = $value['bill_id'];
            $time = $value['created_at'];
            $user_name = $value['name_user'];

        }

    }

}

?>


<div class="main__report-detail_bills">

    <div class="container">
        <div>
            <h2>Thông tin chi tiết hóa đơn</h2>
            <i class="fas fa-times"></i>
        </div>

        <div class="main__report-detail_bills--info_bill">

            <div>
                <span>Mã hóa đơn:</span>
                <strong><?php echo isset($bill_id) ? $bill_id : "" ?></strong>
            </div>

            <div>
                <span>Tên khách hàng:</span>
                <strong><?php echo isset($user_name) ? $user_name : "" ?></strong>
            </div>

            <div>
                <span>Thời gian:</span>
                <strong><?php echo isset($time) ? $time : "" ?></strong>
            </div>

            <!--            Thông tin chi tiết các sản phẩm được mua trong hóa đơn-->
            <div>
                <table border="1" cellspacing="0" cellpadding="5">
                    <thead>
                    <tr>
                        <td>Mã hàng</td>
                        <td>Tên hàng</td>
                        <td>Số lượng</td>
                        <td>Đơn giá</td>
                        <td>Thành tiền</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($bill_id)) {
                        $sql = 'select bills_products.product_id,products.product_name,sum(bills_products.bill_product_amount) as \'sl\',
                                    products.product_cost_price from bills_products
                                    inner join products on bills_products.product_id = products.product_id
                                    where bills_products.bill_id = ' . $bill_id . '
                                    GROUP by bills_products.product_id,products.product_name, products.product_cost_price';

                        $new = new handler_database();
                        $result = $new->get_list($sql);
                        $sum_price = 0;
                        $sum_amount = 0;
                        if ($result) {
                            foreach ($result as $v) {

                                echo "<tr>
                                        <td>" . $v['product_id'] . "</td>
                                        <td>" . $v['product_name'] . "</td>
                                        <td>" . $v['sl'] . "</td>
                                        <td>" . number_format($v['product_cost_price'], 0, ',', ',') . "</td>
                                        <td>" . number_format((int)$v['sl'] * (int)$v['product_cost_price'], 0, ',', ',') . "</td>
                                    </tr>";

                                $sum_price += (int)$v['sl'] * (int)$v['product_cost_price'];
                                $sum_amount += (int)$v['sl'];

                            }
                            echo "<tr><td></td><td></td><td>Tổng số lượng: " . $sum_amount . "</td><td></td><td>Tổng tiền: " . number_format($sum_price, 0, ',', ',') . "</td></tr>";

                        }
                    }


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
require_once 'handler_logout.php';
require_once 'handler_report_bills.php';

?>


