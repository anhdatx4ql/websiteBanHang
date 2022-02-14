<?php
session_start();
require_once '../handler_database.php';
require_once 'select_contact_shop.php';

// nếu chưa đăng nhập thì không thể xem được giỏ hàng

if ( isset($_COOKIE['selected_category_id'])){
    $_SESSION['selected_category_id'] = $_COOKIE['selected_category_id'];
}

if ( isset($_COOKIE['order_price_product']))
    $_SESSION['order_price_product'] = $_COOKIE['order_price_product'];


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
                    <input type="text" name="search_header_product" placeholder="Nhập tên sản phẩm">
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

            <div class="header__bottom--category" style="width: 242px">
                <div class="header__bottom--category__title">

                    <img src="../image/logo.png" alt="">

                </div>

            </div>

            <div class="header__bottom--menu">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="products.php" class="selected_menu">sản phẩm</a></li>
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

    <div class="main__banner">
        <div>
            <h3>Sản phẩm</h3>
            <a href="index.php">Trang chủ</a> /
            <a href="products.php">Sản phẩm</a>
        </div>

    </div>

    <div class="main__products">

        <div class="container">

            <div class="main__products--category">
                <div class="main__products--category__title">
                    <img src="../image/logo-child.png" alt="">
                    <h3>danh mục sản phẩm</h3>
                </div>
                <div class="main__products--category__content">
                    <ul>
                        <li><a href=\"\" id='0' class="selected_category_name">Tất cả</a></li>
                        <?php
                        if ($category) {

                            foreach ($category as $v) {
                                if ( isset($_POST['category_id']) &&  $_POST['category_id']== $v['catedory_id']){

                                    echo "<li><a href=\"\"  class='selected_category_name' id='" . $v['catedory_id'] . "'>" . $v['category_name'] . "</a></li>";
                                }
                                else
                                    echo "<li><a href=\"\" id='" . $v['catedory_id'] . "'>" . $v['category_name'] . "</a></li>";

                            }

                        }

                        ?>
                    </ul>
                </div>
            </div>

            <div class="main__products--center">

                <div class="main__products--center__header">
                    <h3>tất cả sản phẩm</h3>
                    <div>
                        <p>sắp xếp</p>
                        <select name="order_product_shop" id="" onchange="order_product_shop(this)">
                            <option value="" selected disabled>Sắp xếp theo giá tiền</option>
                            <option value="1">Từ thấp - cao</option>
                            <option value="2">Từ cao - thấp</option>
                        </select>
                    </div>
                </div>

                <div class="main__products--center__content">

                    <div class="container">
                        <div class="product">
                            <?php
                            $new = new handler_database();
                            // Xử lý tìm kiếm sản phẩm

                            if(isset($_POST['category_id'])){
                                $sql = 'select * from products inner join categories on categories.catedory_id = products.category_id where categories.catedory_id = ' . $_POST['category_id'];
                            }
                            elseif (isset( $_SESSION['selected_category_id']) ) {

                                if ( $_SESSION['selected_category_id'] == 0) {
                                    $sql = 'select * from products';
                                } else $sql = 'select * from products inner join categories on categories.catedory_id = products.category_id where categories.catedory_id = ' .  $_SESSION['selected_category_id'];
                                unset( $_SESSION['selected_category_id']);

                            } elseif (isset($_POST['submit_search_product'])) {

                                // thêm dấu \ trước kí tự ',"
                                $text = str_replace('"', '\\"', trim($_POST['search_header_product']));
                                $text = str_replace("'", "\\'", trim($text));

                                // lưu lại giá trị ô input
                                echo "<script>document.querySelector('.header__center--search>form>input[type=\"text\"]').value = '" . $text . "'</script>";


                                $sql = 'select * from products where product_name like \'%' . $text . '%\'';
                            } else
                                $sql = 'select * from products';

                            if (isset($_SESSION['order_price_product'])) {

                                if ($_SESSION['order_price_product'] == 1)
                                    $sql = $sql . ' order by product_cost_price ASC ';
                                else $sql = $sql . ' order by product_cost_price DESC ';

                            }


                            if ( $sql)
                                $result = $new->get_list($sql);

                            if ($result) {

                                foreach ($result as $v) {
                                    if ($v['product_amount'] > 0){
                                        echo "<div>
                                                <img src=\"../image/products/" . $v['product_image'] . "\" alt=\"\">
                                                <span>" . $v['product_name'] . "</span>
                                                <span>" . number_format($v['product_cost_price'], 0, ',', ',',) . "</span>
                                                <form action='products.php' method='post'>
                                                    <input type='hidden' name='product_id' value='" . $v['product_id'] . "'>
                                                    <input type='submit' name='product_detail' value='Xem chi tiết'>
                                                    <input type='submit' name='add_product_cart' value='Thêm vào giỏ hàng'>
                                                    
                                                </form>
                                            </div>";
                                    }

                                }

                            } else  echo "<div>
                                                <strong>Không tìm thấy sản phẩm</strong>
                                            </div>";

                            ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>

    <div class="back">
        <i class="fas fa-sort-up"></i>
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
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">sản phẩm</a></li>
                <li><a href="news.php">tin tức</a></li>
                <li><a href="contact.php">liên hệ</a></li>
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

</body>
</html>

<?php


require_once 'handler_product_shop.php';

require_once 'handler_login_logout.php';

require_once 'update_carts_mini.php';

// xử lý xem chi tiết sản phẩm
if (isset($_POST['product_detail'])) {

    $_SESSION['product_id'] = $_POST['product_id'];

    echo "<script>window.location.replace('product_detail.php')</script>";

}

// Xử lý thêm sản phẩm vào giỏ hàng
require_once 'handler_insert_carts.php';

?>

<script src="../js/js.js"></script>

<script>

    window.onscroll = function () {

        let header__bottom = document.querySelector('.header__bottom');
        let back = document.querySelector('.back');


        if (document.documentElement.scrollTop > 195) {

            document.querySelector('.header__bottom--category__title>img').style.display = "block";

            document.querySelector('.header__bottom--right>div:nth-child(1)').style.display = "none";

            document.querySelector('.header__center--miniCart.header__bottom--right__miniCart').style.display = "flex";

            header__bottom.style.cssText = "top: 0px;\n" +
                "    left: 0px;\n" +
                "    right: 0px;\n" +
                "    position: fixed;\n" +
                "    padding: 5px 1.5rem;\n" +
                "    background: whitesmoke;";


            back.style.display = "inline-block";
            back.style.transition = "1s all ease";

            //click trở về đầu trang
            document.querySelector('.back').onclick = function () {

                let back_time = setInterval(function () {
                    document.documentElement.scrollTop -= 10;

                    if (document.documentElement.scrollTop == 0)
                        clearInterval(back_time);

                }, 1);

            }

        } else {
            document.querySelector('.header__bottom--category__title>img').style.display = "none";
            document.querySelector('.header__bottom--right>div:nth-child(1)').style.display = "block";
            document.querySelector('.header__center--miniCart.header__bottom--right__miniCart').style.display = "none";
            header__bottom.style.cssText = "top: 0px;\n" +
                "    position: none;\n" +
                "    padding: 5px 0px;\n" +
                "    background: white;";

            back.style.display = "none";
        }
    }

    // show giỏ hàng
    // show giỏ hàng
    document.querySelectorAll('.header__center--miniCart').forEach(value => {

        value.onclick = function () {
            window.location.replace('carts.php');
        }

    });


</script>
