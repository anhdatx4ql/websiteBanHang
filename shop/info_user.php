<?php
session_start();

require_once '../handler_database.php';

require_once 'select_contact_shop.php';


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

    <LINK REL="SHORTCUT ICON" HREF="../image/logo.png">

    <link rel="stylesheet" href="../css/style_shop.css">

    <title>Đạt Phạm Shop</title>
</head>
<body>

<div class="header">
    <div class="container">

        <div class="header__top">

            <div class="header__top--list">
                <ul>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <?php echo (isset($contact_phone)) ? $contact_phone : ""; ?>
                    </li>

                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo (isset($contact_address)) ? $contact_address : ""; ?>
                    </li>
                </ul>
            </div>

            <div class="header__top--user">
                <a href="login_register.php">
                    <i class="fas fa-user"></i>
                    Đăng ký & đăng nhập
                </a>

                <div>

                    <i class="fas fa-user"></i>
                    <p>Tên người dùng</p>

                    <ul>
                        <li><a href="info_user.php">Tài khoản</a></li>
                        <li><a href="">Đăng xuất</a></li>

                    </ul>
                </div>

            </div>

        </div>

        <div class="header__center">
            <div class="header__center--logo">
                <img src="../image/logo.png" alt="">
            </div>
            <div class="header__center--search">

                <form action="products.php" method="post">
                    <input type="text" name="search_header_product" placeholder="Nhập tên sản phẩm"">
                    <input type="submit" name="submit_search_product" style="display: none">
                </form>

                <i class="fas fa-search"></i>
            </div>

            <div class="header__center--miniCart">
                <div class="miniCart">
                    <i class="fas fa-shopping-cart"></i>
                    <span>0</span>
                </div>
                <div class="total">
                    0đ
                </div>

            </div>
        </div>

        <div class="header__bottom">

            <div class="header__bottom--category">
                <div class="header__bottom--category__title">
                            <span>
                                <i class="fas fa-bars"></i>
                                <p>
                                    Danh mục sản phẩm
                                    <i class="fas fa-chevron-down"></i>
                                </p>
                            </span>
                    <div class="header__bottom--category__list">
                        <ul>
                            <form action="products.php" name="select_category" method="post">
                                <input type="hidden" name="category_id" value="">
                            </form>
                            <?php
                            if ($category) {

                                foreach ($category as $v)
                                    echo "<li><a href=\"\" value='" . $v['catedory_id'] . "' >" . $v['category_name'] . "</a></li>";

                            }

                            ?>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="header__bottom--menu">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="products.php">sản phẩm</a></li>
                    <li><a href="news.php">tin tức</a></li>
                    <li><a href="contact.php">liên hệ</a></li>
                </ul>
            </div>

            <div class="header__bottom--right">
                <div>
                    <i class="fas fa-shipping-fast"></i>
                    Miễn phí ship cho đơn hàng < 3km
                </div>
                <div class="header__center--miniCart header__bottom--right__miniCart">
                    <div class="miniCart">
                        <i class="fas fa-shopping-cart"></i>
                        <span>0</span>
                    </div>
                    <div class="total">
                        0đ
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<div class="main">

    <div class="container">

        <div class="main__left">

            <h3>Tên</h3>

            <ul>
                <li><a href="#main__right--bills">Đơn hàng đã mua</a></li>
                <li><a href="#main__right--account">Tài khoản</a></li>
                <li><a href="">Thoát</a></li>
            </ul>


        </div>


        <div class="main__right">

            <div class="main__right--bills" id="main__right--bills">
                <h3>Thông tin đơn hàng đã mua</h3>
                <div>
                    <table border="1" cellpadding="3" cellspacing="0">

                        <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Thời gian</th>
                            <th>Tổng tiền</th>
                        </tr>
                        </thead>

                        <tbody>
                        <form action="info_user.php" method="post" name="show_bills_products"></form>
                        <?php
                        $new = new handler_database();

                        $result = $new->get_list('select * from bills where user_id = ' . $_SESSION['user_id']);

                        if ($result) {

                            foreach ($result as $v) {

                                echo "<tr>
                                            <input type='hidden' name='bill_id' value='" . $v['bill_id'] . "'>
                                            <th>" . $v['bill_id'] . "</th>
                                            <th>" . $v['created_at'] . "</th>
                                            <th>" . number_format($v['money'], 0, ',', ',') . "</th>
                                          </tr>";

                            }

                        } else echo "<tr><th colspan='3'>Bạn chưa mua sản phẩm nào.</th></tr>";

                        ?>
                        </tbody>

                    </table>
                </div>
                <div></div>
            </div>

            <div class="main__right--account" id="main__right--account">
                <!--                Hiển thị thông tin tài khoản-->
                <div>
                    <h3>Thông tin tài khoản</h3>
                    <form action="info_user.php" method="post">

                        <!--                        Lấy ra thông tin tài khoản-->
                        <?php

                        $new = new handler_database();

                        $result = $new->get_list('select * from users where id_user = ' . $_SESSION['user_id']);

                        if ($result) {

                            foreach ($result as $item) {

                                echo "
                                        <div>
                                            <strong>Tên đăng nhập</strong>
                                            <input type=\"text\" name=\"name\" readonly value='" . $item['nickname'] . "'>
                                        </div>
                
                                        <div>
                                            <strong>Tên</strong>
                                            <input type=\"text\" name=\"name\" value='" . $item['name_user'] . "'>
                                        </div>
                
                                        <div>
                                            <strong>Số điện thoại</strong>
                                            <input type=\"text\" name=\"phone\" onkeyup=\"this.value=this.value.replace(/[^\d]/,'')\" value='" . $item['phone_user'] . "'>
                                        </div>
                
                                        <div>
                                            <strong>Email</strong>
                                            <input type=\"text\" name=\"email\" value='" . $item['email_user'] . "'>
                                        </div>
                
                                        <div>
                                            <strong>Địa chỉ</strong>
                                            <input type=\"text\" name=\"address\" value='" . $item['address_user'] . "'>
                                        </div>
                
                                        <div>
                                            <strong>Ngày sinh</strong>
                                            <input type=\"date\" name=\"birth_date\" value='" . $item['date_birth_user'] . "'>
                                        </div>
                
                                        <div>
                                            <input type=\"submit\" name=\"submit_acocunt\" value=\"Thay đổi\">
                                            <a href='#change_pass'>Đổi mật khẩu</a>                                       
                                        </div>";

                            }

                        } else die('Có lỗi!');

                        ?>

                    </form>
                </div>
                <!--                Thay đổi mật khẩu-->
                <div id="change_pass">
                    <h3>Thay đổi mật khẩu</h3>
                    <form action="info_user.php" method="post">

                        <div>
                            <strong>Mật khẩu hiện tại</strong>
                            <input type="password" name="pass" >
                        </div>

                        <div>
                            <strong>Mật khẩu mới</strong>
                            <input type="password" name="new_password">
                        </div>

                        <div>
                            <strong>Nhập lại mật khẩu mới</strong>
                            <input type="password" name="new_confirm_password">
                        </div>

                        <div>
                            <input type="submit" name="submit_new_pass" value="Thay đổi">
                        </div>

                    </form>
                </div>

            </div>


        </div>
        <div class="back">
            <i class="fas fa-sort-up"></i>
        </div>
    </div>

</div>

<div class="footer">
    <div class="container">
        <div>
            <h3>liên hệ</h3>
            <ul>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo (isset($contact_address)) ? $contact_address : ""; ?>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <?php echo (isset($contact_phone)) ? $contact_phone : ""; ?>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <?php echo (isset($contact_email)) ? $contact_email : ""; ?>
                </li>
            </ul>
        </div>
        <div>
            <h3>Danh mục sản phẩm</h3>
            <ul>
                <?php
                if ($category) {

                    foreach ($category as $v)
                        echo "<li><a href=\"\">" . $v['category_name'] . "</a></li>";

                }

                ?>

            </ul>
        </div>

        <div>
            <h3>menu</h3>
            <ul>
                <li><a href="">trang chủ</a></li>
                <li><a href="">sản phẩm</a></li>
                <li><a href="">về chúng tôi</a></li>
                <li><a href="">liên hệ</a></li>
            </ul>
        </div>

        <div>
            <h3>hỗ trợ khách hàng</h3>
            <ul>
                <li><a href="">trang chủ</a></li>
                <li><a href="">sản phẩm</a></li>
                <li><a href="">về chúng tôi</a></li>
                <li><a href="">liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="detail_bills">
    <div>
        <div>
            <h2>Chi tiết hóa đơn</h2>
            <i class="fas fa-times"></i>
        </div>
        <div>
            <form action="info_user.php" method="post">
                <div>
                    <span>Mã hóa đơn</span>
                    <input type="text" readonly name="bill_id" value="<?php echo isset($_COOKIE['bill_id_detail'])?$_COOKIE['bill_id_detail']:"" ?>">
                </div>
                <div>
                    <span>thời gian</span>
                    <?php
                    if(isset($_COOKIE['bill_id_detail'])){
                        $new = new handler_database();
                        $result = $new->get_list('select created_at from bills where bill_id = '.$_COOKIE['bill_id_detail']);
                        if($result){
                            foreach ($result as $value)
                                $date = $value['created_at'];
                        }
                    }

                    ?>
                    <input type="datetime" readonly name="created_at" value="<?php echo isset($date)?$date :"" ?>">
                </div>

                <table border="1" cellspacing="0" cellpadding="4">
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

                    if (isset($_COOKIE['bill_id_detail'])) {
                        $new = new handler_database();

                        $re = $new->get_list('select bills_products.product_id, products.product_name,bills_products.bill_product_amount,
                                            products.product_cost_price, bills_products.bill_product_amount*products.product_cost_price as \'tien\' 
                                            from bills 
                                            inner join bills_products on bills.bill_id = bills_products.bill_id
                                            inner join products on products.product_id = bills_products.product_id
                                            where bills.bill_id= '.$_COOKIE['bill_id_detail']);

                        if ($re) {
                            $sum_price = 0;
                            $sum_amount=0;
                            foreach ($re as $v) {
                                $sum_price += $v['tien'];
                                $sum_amount += $v['bill_product_amount'];

                                echo "<tr>
                                        <td>" . $v['product_id'] . "</td>
                                        <td>" . $v['product_name'] . "</td>
                                        <td>" . $v['bill_product_amount'] . "</td>
                                        <td>" . $v['product_cost_price'] . "</td>
                                        <td>" . number_format($v['tien'], 0, ',', ',') . "</td>
                                    </tr>";

                            }
                            echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td>Tổng số lượng: " . $sum_amount . "</td>
                                        <td></td>
                                        <td>Tổng tiền: " . number_format($sum_price, 0, ',', ',') . "</td>
                                    </tr>";

                        } else die('Có lỗi');
                    }


                    ?>

                    </tbody>
                </table>


            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php

require_once 'handler_login_logout.php';
require_once 'update_carts_mini.php';
// xử lý select category form
require_once 'handler_select_category.php';

require_once 'handler_info_user.php';



?>


