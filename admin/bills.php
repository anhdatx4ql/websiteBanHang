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
                    <a href="bills.php" class="selected_nav">
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


        <div class="main__products--right">

            <div class="main__products--right__header">

                <div>
                    <i class="fas fa-search"></i>
                    <form action="bills.php" method="post">
                        <input type="text" name="name" placeholder="Tìm kiếm hàng theo mã hóa đơn">
                        <input type="submit" name="search_bills" style="display: none;">
                    </form>


                </div>

                <div style="display: none">
                    <i class="fas fa-plus"></i>
                    <p>Thêm hóa đơn mới</p>
                </div>

            </div>

            <div class="main__products--right__center bills--center">
                <table cellpadding="5" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Thời gian</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $bills = new handler_database();

                    if (isset ($_POST['search_bills'])) {

                        $search = $_POST['name'];

                        $search = str_replace('"', '\\"', trim($search));
                        $search = str_replace("'", "\\'", trim($search));

                        echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = '" . $_POST['name'] . "' </script>";


                    }

                    if (isset($search) && $search != '') {

                        $row = $bills->get_list('select * from bills inner join users on bills.user_id = users.id_user where bill_id like\'%' . $search . '%\'');

                    } else $row = $bills->get_list('select * from bills inner join users on bills.user_id = users.id_user');

                    if ($row)
                        foreach ($row as $v) {

                            echo "<tr id='" . $v['bill_id'] . "'>
                                            <td>" . $v['bill_id'] . "</td>
                                            <td>" . $v['created_at'] . "</td>
                                            <td>" . $v['name_user'] . "</td>
                                            <td>" . number_format($v['money'], 0, ',', ',') . "</td>
                                        </tr>";
                        }
                    else echo "<tr>
                                            <td colspan='4'>Không tìm thấy dữ liệu</td>
                                        </tr>";

                    ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>


<div class="update__insert__bills">

    <div>

        <form action="bills.php" method="post">

            <div>
                <h1>Hóa đơn</h1>
                <i class="fas fa-times"></i>
            </div>

            <?php

            if (isset($_COOKIE['handler_bill'])) {

                echo "<script>document.querySelector('.update__insert__bills').style.display = \"block\";</script>";


                // lấy mã hóa đơn, time, tên khách hàng ra
                $select1 = new handler_database();

                $result = $select1->get_list('select bills.bill_id,bills.created_at,users.name_user from bills
                            inner join users on users.id_user = bills.user_id
                            where bills.bill_id =
                            ' . $_COOKIE['handler_bill']);

                if ($result) {

                    foreach ($result as $v) {

                        $bill_id = $v['bill_id'];
                        $created_at = $v['created_at'];
                        $user_name = $v['name_user'];

                    }

                }

                $bill_id = isset($bill_id) ? $bill_id : "";
                $created_at = isset($created_at) ? $created_at : "";
                $user_name = isset($user_name) ? $user_name : "";

                echo "
                        <div>
                            <span>Mã hóa đơn</span>
                            <input type=\"text\" name=\"bill_id\" value='" . $bill_id . "'>
                        </div>
            
                        <div>
                            <span>Thời gian</span>
                            <input type=\"datetime\" name=\"created_at\" value='" . $created_at . "'>
                        </div>
            
                        <div>
                            <span>Khách hàng</span>
                            <input type=\"text\" name=\"user_name\" value='" . $user_name . "'>
                        </div>";

                // lấy ra thông tin chi tiết đơn hàng, gồm sản phẩm và giá tiền
                $select2 = new handler_database();

                $result1 = $select2->get_list('select bills_products.product_id, products.product_name,
                            bills_products.bill_product_amount,products.product_cost_price,
                            bills_products.bill_product_amount*products.product_cost_price as \'thanh tien\'
                            from bills 
                            inner join bills_products on bills_products.bill_id = bills.bill_id
                            inner join products on products.product_id = bills_products.product_id
                            where bills.bill_id = ' . $_COOKIE['handler_bill']);

                echo "<div class=\"detail_bill\">
                        <div>
                            <table border=\"1\" cellspacing=\"0\" cellpadding=\"5\">
                                <thead>
                                <tr>
                                    <th>Mã hàng</th>
                                    <th>Tên hàng</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
        
                                <tbody>";

                $sum_money = 0;
                $sum_amount = 0;
                if (isset($result1)) {

                    foreach ($result1 as $value) {
                        $sum_money += (int)$value['thanh tien'];
                        $sum_amount += (int)$value['bill_product_amount'];

                        echo "
                               <tr>
                                    <td>" . $value['product_id'] . "</td>
                                    <td>" . $value['product_name'] . "<br>" . "</td>
                                    <td>" . $value['bill_product_amount'] . "</td>
                                    <td>" . $value['product_cost_price'] . "</td>
                                    <td>" . $value['thanh tien'] . "</td>
                                    
                                </tr>";

                    }

                }

                echo "
                            </tbody>
    
                        </table>
                    </div>
    
    
                    <div class=\"pay_bills\">
                        <div>
                            <span>Tổng số lượng</span>
                            <span>" . $sum_amount . "</span>
                        </div>
    
                        <div>
                            <span>Tổng tiền hàng</span>
                            <span>" . $sum_money . "</span>
                        </div>
    
                        <div>
                            <span>Khách đã trả</span>
                            <span>" . $sum_money . "</span>
                        </div>
                    </div>
    
                </div>";

                // xóa cookie
                echo "<script>document.cookie = 'handler_bill' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

            } ?>


            <div>
                <input type="submit" name="delete_bill" value="Xóa">
            </div>

        </form>
    </div>


</div>

<div class="insert_bills">
    <!--    form thêm đơn hàng ( có cả sản phẩm, khách hàng, số lượng sản phẩm, tổng tiền )-->

    <div class="insert_bills_user">
        <div class="container">
            <form action="bills.php" method="post">

                <div>
                    <h2>Form thêm hóa đơn</h2>
                    <i class="fas fa-times"></i>
                </div>
                <div>
                    <span>Chọn khách hàng</span>
                    <select name="name_user" id="">
                        <?php

                        $users = new handler_database();

                        $sql = 'select * from users where role_id = 2';

                        $result = $users->get_list($sql);

                        if ($result) {
                            foreach ($result as $value) {
                                echo "<option value='" . $value['id_user'] . "'>" . $value['name_user'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div>

                    <span>Chọn sản phẩm</span>
                    <!--                Hiển thị ra tất cả sản phẩm-->

                    <div class="view_product">
                        <?php
                        $products = new handler_database();

                        $sql = 'select * from products';

                        $result = $products->get_list($sql);

                        if ($result) {

                            foreach ($result as $value) {

                                if ((int)$value['product_amount']>0)
                                    echo "<a href=''>
                                        <span class='id_product' style='display: none'>" . $value['product_id'] . "</span>
                                        <img src='../image/products/" . $value['product_image'] . "' width='128' height='128' alt=\"\">
                                        <span class='name_product'>" . $value['product_name'] . "</span>
                                        <span class='cost_price_product'>" . number_format($value['product_cost_price'], 0, ',', ',') . "</span>
                                        <span class='amount_product' style='display: none'>" . $value['product_amount']. "</span>
                                    </a>";

                            }

                        }

                        ?>
                    </div>

                </div>

                <!--                Hiển thị sản phẩm, số lượng đã chọn ở trên-->
                <div class="view_detail_product">
                    <div>
                        <span>Mã sản phẩm</span>
                        <span>Tên sản phẩm</span>
                        <span>Số lượng</span>
                        <span>Đơn giá</span>
                        <span>Thành tiền</span>
                    </div>
                    <!--                    gồm: tên sản phẩm, số lượng, đơn giá, thành tiền-->


                </div>

                <!--                Tính tiền hóa đơn-->
                <div class="sum_pay_bill">
                    <!--                    Số lượng sản phẩm-->
                    <div>
                        <span>Tổng tiền hàng (<input type="text" readonly name="sum_amount_bill">) </span>
                        <input type="text" readonly name="sum_price_bill">
                    </div>
                </div>

                <!--                tạo hóa đơn-->
                <div>
                    <input type="submit" name="insert_bill_user" value="Tạo hóa đơn">
                </div>

            </form>
        </div>

    </div>

</div>


</body>
</html>
<script src="handler_logout.php"></script>
<script src="../js/admin/js_all.js"></script>
<?php
require_once 'handler_bills.php';
require_once  'handler_logout.php';
?>




