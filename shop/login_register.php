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
                        <li><a href="">Tài khoản</a></li>
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
                            <?php
                            if ($category) {

                                foreach ($category as $v)
                                    echo "<li><a href=\"\">" . $v['category_name'] . "</a></li>";

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
        <div><h3>Đăng nhập & đăng ký</h3> <a href="index.php">Trang chủ</a> / <a href="login_register.php">Đăng nhập &
                đăng ký</a></div>
    </div>
    <div class="main__center">
        <div class="container">
            <div class="main__center--login"><h2>Đăng nhập</h2>
                <form action="login_register.php" method="post">
                    <div>
                        <p>Tên đăng nhập</p>
                        <input type="text" name="nickname" placeholder="Nhập tên đăng nhập"></div>
                    <div><p>Mật khẩu</p>
                        <input type="password" name="password" placeholder="Nhập mật khẩu"></div>
                    <div><input type="submit" name="submit_login" value="Đăng nhập"></div>
                </form>
            </div>
            <div class="main__center--register"><h2>Bạn chưa có tài khoản?</h2>
                <form action="login_register.php" method="post">
                    <div><p>Họ tên khách hàng</p> <input type="text" name="fullname" placeholder="Nhập họ tên đầy đủ">
                    </div>
                    <div>
                        <p>Ngày sinh</p>
                        <input type="date" name="date_birth">
                    </div>
                    <div class="register-width">
                        <p>Email</p>
                        <input type="email" name="email" placeholder="Nhập email">
                    </div>
                    <div class="register-width"><p>Số điện thoại</p>
                        <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="phone" placeholder="Nhập số điện thoại"></div>
                    <div>
                        <p>Địa chỉ</p> <input type="text" name="address" placeholder="Nhập địa chỉ"></div>
                    <div><p>Tên đăng nhập</p> <input type="text" name="nickname" placeholder="Nhập tên đăng nhập"></div>
                    <div class="register-width"><p>Mật khẩu</p> <input type="password" name="password"
                                                                       placeholder="Nhập mật khẩu"></div>
                    <div class="register-width"><p>Nhập lại mật khẩu</p> <input type="password" name="confirm_password"
                                                                                placeholder="Nhập lại mật khẩu"></div>
                    <div><input type="submit" name="register" value="Đăng ký"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="back"><i class="fas fa-sort-up"></i></div>
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

require_once 'handler_login_register.php'

?>

<script src="../js/js.js"></script>
