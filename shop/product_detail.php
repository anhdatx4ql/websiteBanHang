<?php
session_start();
require_once '../handler_database.php';
require_once 'select_contact_shop.php';

if ( !isset($_SESSION['user_id']) ){

    echo "<script>alert('Bạn phải đăng nhập!');  
    window.location.replace('login_register.php')</script>";

}

if ( isset($_SESSION['product_id'])){

   $new = new handler_database();

   $result = $new->get_list('select * from products inner join categories on categories.catedory_id = products.category_id where product_id = '.$_SESSION['product_id']);

   if ( $result){

       foreach ($result as $v){

           $name = $v['product_name'];
           $trademark = $v['product_trademark'];
           $price = $v['product_cost_price'];
           $amount = $v['product_amount'];
           $detail = $v['product_detail'];
           $image = $v['product_image'];
           $category_name = $v['category_name'];

       }

   }else die('Có lỗi!');

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

    <div class="main__banner">
        <div>
            <h3>Sản phẩm</h3>
            <a href="index.php">Trang chủ</a> /
            <a href="products.php">Sản phẩm</a> /
            <a href=""><?php echo isset($name)? $name : "" ?></a>
        </div>

    </div>

    <div class="main__product_detail">

        <div class="container">

            <div>
                <?php
                    echo (isset($image))? "<img src=\"../image/products/".$image."\" alt=\"\">" :"";
                ?>

            </div>

            <div>
                <form action="product_detail.php" method="post">
                <?php
                    if ( empty($name) || empty($price) || empty($trademark)
                        || empty($amount) || empty($detail) || empty($category_name) )
                        die('Có lỗi!');
                    else{

                        echo "<input type=\"hidden\" name=\"product_id\" value='".$_SESSION['product_id']."'>";
                        echo "<h2>".$name."</h2>";
                        echo "<p>Giá bán: <strong>".number_format($price, 0, ',', ',')."</strong></p>";
                        echo "<p>Hãng sản xuất: <strong>".$trademark."</strong></p>";
                        echo "<p>Nhóm hàng: <strong>".$category_name."</strong></p>";
                        echo "<p>Thông tin chi tiết: ".$detail."</p>";
                        echo "<div>
                                <p>Số lượng:</p>
                                <input type='number' name='amount' value='1' max='".$amount."' min='0'step='1'>
                                </div>";

                    }

                ?>
                <div>

                        <input type="submit" name="insert_cart" value="Thêm vào giỏ hàng">

                </div>
            </form>
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

require_once 'handler_product_detail.php';

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
<script src="../js/js.js"></script>
