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
                    <p></p>

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
                                    echo "<li><a href=\"\" value='".$v['catedory_id']."' >" . $v['category_name'] . "</a></li>";

                            }

                            ?>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="header__bottom--menu">
                <ul>
                    <li><a href="index.php" class="selected_menu">Trang chủ</a></li>
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

    <div class="main__slide">
        <div class="main__slide--1" sttt="1">

            <div>
                <h3>Thực phẩm đảm bảo chất lượng vệ sinh</h3>
                <p>Miễn phí giao hàng trong phạm vi 3km</p>
                <a href="">xem ngay</a>

            </div>

            <div class="main__slide--transfer">
                <i class="fas fa-chevron-left left"></i>
                <i class="fas fa-chevron-right right"></i>
            </div>

        </div>

        <div class="main__slide--2" sttt="2">
            <div>
                <h3>thực phẩm từ thiên nhiên</h3>
                <p>Bảo vệ sức khỏe - Cuộc sống luôn đẹp</p>
                <a href="">xem ngay</a>
            </div>

            <div class="main__slide--transfer">
                <i class="fas fa-chevron-left left"></i>
                <i class="fas fa-chevron-right right"></i>
            </div>
        </div>


    </div>

    <div class="main__introduce">
        <div class="container">

            <ul>
                <li>
                    <i class="fas fa-dolly"></i>
                    <h3>Miễn phí giao hàng</h3>
                    <p>trong phạm vi 3km</p>
                </li>
                <li>
                    <i class="fas fa-percent"></i>
                    <h3>Chiết khấu lên đến 5% đơn hàng</h3>
                    <p>cho khách hàng đã có đơn hàng lớn hơn 5 triệu đồng</p>
                </li>
                <li>
                    <i class="fas fa-headset"></i>
                    <h3>Hỗ trợ</h3>
                    <p>từ 8:00 đến 21:00 mỗi ngày</p>
                </li>
                <li>
                    <i class="fas fa-user-shield"></i>
                    <h3>Bảo mật</h3>
                    <p>tất cả thông tin của khách hàng</p>
                </li>
            </ul>

        </div>
    </div>

    <div id="main__product_new" class="main__newProduct main__product">

        <div class="container">
            <div class="main__product--header">

                <div>
                    <img src="../image/logo-child.png" alt="">
                    <h4>sản phẩm mới</h4>
                </div>
                <div>
                    <a href="products.php">xem tất cả</a>
                </div>
            </div>

            <div class="main__product--center">

                <div>
                    <div class="product">

                        <?php
                        $new = new handler_database();

                        // lấy ra 10 sản phẩm mới nhất
                        $row = $new->get_list('SELECT * FROM products where product_amount >0 ORDER BY products.product_id  DESC limit 10');

                        if ($row) {

                            foreach ($row as $v)
                                echo "<div>
                                                <img src=\"../image/products/" . $v['product_image'] . "\" alt=\"\">
                                                <span>" . $v['product_name'] . "</span>
                                                <span>" . number_format($v['product_cost_price'], 0, ',', ',') . "</span>
                                                <form action='products.php' method='post'>
                                                    <input type='hidden' name='product_id' value='" . $v['product_id'] . "'>
                                                    <input type='submit' name='product_detail' value='Xem chi tiết'>
                                                    <input type='submit' name='add_product_cart' value='Thêm vào giỏ hàng'>
                                                    
                                                </form>
                                            </div>";

                        } else die('Có lỗi!');
                        ?>


                    </div>
                </div>

            </div>

            <div class="main__product--next_pre next_pre">
                <a href="#"><i class="fas fa-chevron-left left"></i></a>
                <a href="#"><i class="fas fa-chevron-right right"></i></a>
            </div>
        </div>

    </div>

    <div id="main_product" class="main__product">

        <div class="container">
            <div class="main__product--header">

                <div>
                    <img src="../image/logo-child.png" alt="">
                    <h4>sản phẩm</h4>
                </div>
                <div>
                    <a href="products.php">xem tất cả</a>
                </div>
            </div>

            <div class="main__product--center">

                <div>
                    <div class="product">
                        <?php
                        $new = new handler_database();

                        // lấy ra 10 sản phẩm mới nhất
                        $row = $new->get_list('SELECT * FROM products where product_amount > 0');

                        if ($row) {

                            foreach ($row as $v) {
                                echo "<div>
                                                <img src=\"../image/products/" . $v['product_image'] . "\" alt=\"\">
                                                <span>" . $v['product_name'] . "</span>
                                                <span>" . number_format($v['product_cost_price'], 0, ',', ',') . "</span>
                                                <form action='products.php' method='post'>
                                                    <input type='hidden' name='product_id' value='" . $v['product_id'] . "'>
                                                    <input type='submit' name='product_detail' value='Xem chi tiết'>
                                                    <input type='submit' name='add_product_cart' value='Thêm vào giỏ hàng'>
                                                    
                                                </form>
                                            </div>";
                            }


                        } else die('Có lỗi!');
                        ?>
                    </div>
                </div>

            </div>

            <div class="main__product--next_pre next_pre">
                <a href=""><i class="fas fa-chevron-left left"></i></a>
                <a href=""><i class="fas fa-chevron-right right"></i></a>
            </div>
        </div>


    </div>

    <div class="back">
        <i class="fas fa-sort-up"></i>
    </div>

<!--    Phần news -->
    <div class="main__news-update">
        <div class="container">

            <div class="main__new-update--title">
                <h3><a href="">tin cập nhật</a></h3>
                <p>Tin tức vệ sinh an toàn thực phẩm cập nhật mới nhất mỗi ngày cho bạn</p>
            </div>

            <div class="main__new-update--center">
                <?php

                    $new = new handler_database();

                    $result = $new->get_list('select * from news ORDER by news.new_id DESC limit 3');

                    if ( $result ){

                        foreach ($result  as $item){

                            echo "<div>
                                    <img src=\"../image/news/".$item['new_image']."\" alt=\"\">
                                    <h5>".$item['new_title']."</h5>
                                    <p>".$item['new_short_description']."</p>
                                    <form action='index.php' method='post'>
                                        <input type='hidden' name='new_id' value='".$item['new_id']."'>
                                        <input type=\"submit\" name='submit_select_new' value='Chi tiết' >
                                    </form>
                                </div>";

                        }

                    }else die('Có lỗi!');

                ?>

            </div>

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

</body>
</html>
<?php

require_once 'handler_login_logout.php';

require_once 'update_carts_mini.php';

// Xử lý thêm sản phẩm vào giỏ hàng
require_once 'handler_insert_carts.php';

// xử lý select category form
require_once 'handler_select_category.php';

// xử lý xem chi tiết sản phẩm
if (isset($_POST['product_detail'])) {

    $_SESSION['product_id'] = $_POST['product_id'];

    echo "<script>window.location.replace('product_detail.php')</script>";

}

if ( isset($_POST['submit_select_new'])){

    $_SESSION['new_id'] = $_POST['new_id'];
    echo "<script>window.location.replace('detail_new.php')</script>";
}



?>

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
<script src="../js/js_index.js"></script>
<script src="../js/js.js"></script>
<script>

    // đếm số lượng sản phẩm
    let dem = 0;
    document.querySelectorAll('div#main_product>.container .product>div').forEach(v => {

        dem++;

    });

    let dem_new = 0;
    document.querySelectorAll('div#main__product_new>.container .product>div').forEach(v => {

        dem_new++;

    });

    let product_width = document.querySelector('.main__product>.container>.main__product--center .product>div').clientWidth + 2 + 8;

    // xét độ rộng của mỗi div
    document.querySelector('div#main_product> .container > .main__product--center .product').style.width = (product_width * dem) + "px";
    document.querySelector('div#main__product_new>.container .product').style.width = (product_width * dem_new) + "px";

    // xử lý animation cho sản phầm
    let current_width = document.querySelector('.main__product--center>div').clientWidth;
    let width_product = parseInt(document.querySelector('div#main_product>.container .product').style.width);
    let width_new_product = parseInt(document.querySelector('div#main__product_new>.container .product').style.width);

    let max_transform = width_product - current_width;
    let max_new_transform = width_new_product - current_width;

    let dem_load = 0;
    let dem_load_new = 0;
    setInterval(() => {

        // start load product new
        dem_load_new = dem_load_new + product_width;

        if (dem_load_new > max_new_transform) {
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + max_new_transform + "px);";
            dem_load_new = 0;
        } else
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + dem_load_new + "px) ";
        // end load product new


        // start load product
        dem_load = dem_load + product_width;

        if (dem_load > max_transform) {
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + max_transform + "px);";
            dem_load = 0;
        } else
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + dem_load + "px) ";
        // end load product

    }, 6000);


    // click new product
    document.querySelector('div#main__product_new .next_pre>a:last-child').onclick = function (e) {

        e.preventDefault();

        dem_load_new = dem_load_new + product_width;

        if (dem_load_new > max_new_transform) {
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + dem_load_new + "px);";
            dem_load_new = 0;
        } else
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + dem_load_new + "px) ";


    }
    document.querySelector('div#main__product_new .next_pre>a:first-child').onclick = function (e) {

        e.preventDefault();

        dem_load_new = dem_load_new - product_width;

        if (dem_load_new <= 0) {
            dem_load_new = 0;
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + dem_load_new + "px);";
        } else
            document.querySelector('div#main__product_new>.container .product').style.cssText = "transform:translateX(-" + dem_load_new + "px) ";

    }
    // end new product


    // click product
    document.querySelector('div#main_product .next_pre>a:last-child').onclick = function (e) {

        e.preventDefault();

        dem_load = dem_load + product_width;

        if (dem_load > max_transform) {
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + max_transform + "px);";
            dem_load = 0;
        } else
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + dem_load + "px) ";


    }

    document.querySelector('div#main_product .next_pre>a:first-child').onclick = function (e) {

        e.preventDefault();

        dem_load = dem_load - product_width;

        if (dem_load <= 0) {
            dem_load = 0;
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + dem_load + "px);";
        } else
            document.querySelector('div#main_product>.container .product').style.cssText = "transform:translateX(-" + dem_load + "px) ";

    }
    // end product


</script>

