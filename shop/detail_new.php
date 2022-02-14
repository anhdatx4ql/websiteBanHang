<?php
session_start();

require_once '../handler_database.php';
require_once 'select_contact_shop.php';

if ( isset($_POST['new_id']))
    $_SESSION['new_id'] = $_POST['new_id'];


if (isset($_SESSION['new_id']) ) {

    $new = new handler_database();

        $result = $new->get_list('select * from news where new_id = ' .$_SESSION['new_id']);

    if ($result) {

        foreach ($result as $item) {
            $new_img = $item['new_image'];
            $new_title = $item['new_title'];
            $new_description = $item['new_description'];
        }

    } else die('Có lỗi');

} else {

    echo "<script>window.location.replace('news.php')</script>";

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
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="products.php">sản phẩm</a></li>
                    <li><a href="news.php" class="selected_menu">tin tức</a></li>
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
            <h3>Tin tức</h3>
            <a href="index.php">Trang chủ</a> /
            <a href="news.php">tin tức</a> /
            <a href="news.php"><p><?php echo isset($new_title) ? $new_title : "" ?></p></a>
        </div>

    </div>

    <div class="main__news">
        <div class="container">
            <div class="main__news--title">
                <h1>Tin tức</h1>
            </div>

            <div class="main__news--content">

                <div class="main__news--content__left">

                    <div class="new_description">

                            <?php

                            if (empty($new_img) || empty($new_title) || empty($new_description)) {
                                die('Có lỗi!');
                            } else {
                                echo "<h3>" . $new_title . "</h3>
                                        <img src=\"../image/news/" . $new_img . "\" alt=\"\">
                                        " . $new_description . " ";
                            }


                            ?>
                        </div>

                </div>

                <div class="main__news--content__right">

                    <div class="main__news--content__right--search">
                        <form action="news.php" method="post">

                            <input type="text" placeholder="Tìm bài viết theo tiêu đề" name="text">
                            <i class="fas fa-search"></i>
                            <input type="submit" name="submit_search_new_title" style="display: none;">

                        </form>
                    </div>

                    <div class="main__news--content__right--hot">

                        <div class="title">
                            <h3>Tin hot</h3>
                        </div>

                        <?php

                        $new = new handler_database();

                        $result = $new->get_list('select * from news ORDER by new_id DESC limit 3');

                        if ($result) {

                            foreach ($result as $item) {
                                echo "<div>

                                        <form action=\"detail_new.php\" method=\"post\" name='new_detail'>
                                            <input type=\"hidden\" name=\"new_id\" value=\"" . $item['new_id'] . "\">
                                            <img src=\"../image/news/" . $item['new_image'] . "\" alt=\"\">
                                            <div>
                                                <b>" . $item['new_title'] . "</b>
                                                <p>" . $item['new_short_description'] . "</p>
                                            </div>
            
                                        </form>
            
                                    </div>";
                            }

                        } else die('Có lỗi');

                        ?>

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
require_once 'handler_login_logout.php';
require_once 'update_carts_mini.php';
// xử lý select category form
require_once 'handler_select_category.php';
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

    document.querySelectorAll('.main__news--content__right--hot > div > form[name="new_detail"]').forEach(v=>{

        v.onclick = function(e){

            e.preventDefault();

            v.submit();

        }

    });



</script>

<script src="../js/js.js"></script>

<style>
    .main__news--content>.main__news--content__left img {
        flex: 0.3;
        max-width: 650px;
        box-sizing: initial;
    }

    .new_description {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .new_description p {
        display: block;
        width: 100%;
        text-align: justify;
        margin-top: 5px;
        box-sizing: border-box;
    }

</style>