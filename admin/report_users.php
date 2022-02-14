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

            <form action="report_users.php" method="post">

                <div>
                    <h3>Tên khách hàng</h3>
                </div>

                <div>
                    <span>Nhập tên</span>
                    <input type="text" name="user_name"  placeholder="Nhập tên khách hàng"
                           value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : "" ?>">
                </div>

                <div>
                    <input type="submit" name="search_time" value="Tìm kiếm">
                </div>

            </form>


        </div>

        <div class="main__report-bills__right">
            <div>
                <h2>Báo cáo khách hàng</h2>
            </div>

            <div class="info_report_bills">

                <div>
                    <span>Tổng số khách hàng</span>
                    <?php
                    $u_amount = new handler_database();
                    $sql = 'select count(*) from users inner join role on role.role_id = users.role_id where role.role_name != \'admin\'';
                    $amount = $u_amount->get_list($sql);
                    foreach ($amount as $value)
                        $amount_s = $value['count(*)'];
                    echo('<span>' . $amount_s . '</span>')

                    ?>
                </div>

                <div>
                    <span>Số khách đã mua hàng</span>
                    <?php
                    $u_amount_pay = new handler_database();
                    $sql = 'select count(*) from users inner join role on role.role_id = users.role_id inner join bills on bills.user_id = users.id_user where role.role_name != \'admin\'';
                    $amount_pay = $u_amount_pay->get_list($sql);
                    foreach ($amount_pay as $value)
                        $amount_pay_sum = $value['count(*)'];
                    echo('<span>' . $amount_pay_sum . '</span>')

                    ?>
                </div>

                <div>
                    <span>Số khách chưa mua hàng</span>
                    <?php
                    $con_lai = $amount_s - $amount_pay_sum;
                    echo('<span>' . $con_lai . '</span>')
                    ?>


                </div>

            </div>
            <div class="main__report-bills__right--full">

                <div class="main__products--right__center">
                    <table cellpadding="5" border="1" cellspacing="0">
                        <colgroup>
                            <col width="80">
                            <col width="150">
                            <col width="150">
                            <col width="150">
                            <col width="80">
                            <col width="80">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th>Số sp mua</th>
                            <th>Số đơn</th>
                            <th>Số tiền</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $users = new handler_database();
                        $sql = 'select users.id_user,users.name_user,users.phone_user,users.email_user from users where users.role_id !=1';

                        if(isset($_POST['user_name'])){
                            $_POST['user_name'] = str_replace('"' , '\\"', $_POST['user_name']);
                            $user_name = str_replace("'" , "\\'", $_POST['user_name']);

                            $sql.=' and users.name_user like \'%'.$user_name.'%\'';
                        }

                        $user_result = $users->get_list($sql);

                        if ($user_result) {

                            foreach ($user_result as $value){
                                echo('<tr>
                                        <td>'.$value['id_user'].'</td>
                                        <td>'.$value['name_user'].'</td>
                                        <td>'.$value['phone_user'].'</td>
                                        <td>'.$value['email_user'].'</td>');

                                $user_bill_detail = new handler_database();
                                $amount_pro = $user_bill_detail->get_list('select sum(bills_products.bill_product_amount) as amount from users
                                        inner join bills_products on bills_products.user_id = users.id_user
                                        WHERE users.id_user = '.$value['id_user'].' ');
                                foreach ($amount_pro as $v_amount){
                                    if($v_amount['amount']>0)
                                        echo('<td>'.$v_amount['amount'].'</td>');
                                    else
                                        echo('<td>0</td>');
                                }

                                $u_bill = new handler_database();

                                $amount_bill = $u_bill->get_list('select users.id_user,count(bills.bill_id) as count_bill,sum(bills.money) as sum_money from users inner join bills on bills.user_id = users.id_user where users.id_user = '.$value['id_user'].' GROUP by users.id_user');

                                if(!$amount_bill){
                                    echo('<td>0</td>');
                                    echo('<td>0</td>');
                                }else
                                    foreach ($amount_bill as $v_amount){
                                        if($v_amount['count_bill']>0 && $v_amount['sum_money']>0 ) {
                                            echo('<td>' . $v_amount['count_bill'] . '</td>');
                                            echo('<td>' . number_format($v_amount['sum_money'], 0, ',', ',') . '</td>');
                                        }

                                    }


                            }

                        }else{
                            echo('<tr><td colspan="7">Không tìm thấy khách hàng!</td></tr>');
                        }

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


