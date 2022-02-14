<?php
session_start();
require_once '../handler_database.php';

require_once 'select_contact_shop.php';

// nếu chưa đăng nhập thì không thể xem được giỏ hàng
if ( !isset($_SESSION['user_id']) ){

    echo "<script>alert('Bạn phải đăng nhập mới truy cập vào được giỏ hàng!');  window.location.replace('login_register.php')</script>";


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
            <h3>Giỏ hàng</h3>
            <a href="index.php">Trang chủ</a> /
            <a href="carts.php">giỏ hàng</a>
        </div>

    </div>

    <div class="main__carts">

        <div class="container">

            <div class="main__carts--info">
                <table cellspacing="0" cellpadding="10" border="1">
                    <colgroup>
                        <col width="200" span="1">
                        <col width="150" span="1">
                        <col width="80" span="1">
                        <col width="100" span="1">
                        <col width="80" span="1">
                        <col width="60" span="1">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>

                    </thead>

                    <tbody>
                    <form action="carts.php" method="post">
                    <?php
                    // xử lý hiển thị giỏ hàng của mỗi người dùng ở đây
                        $new = new handler_database();

                        $result = $new->get_list('select carts.user_id, carts.product_id, products.product_cost_price,sum(carts.cart_amount), products.product_name, products.product_image, products.product_amount from carts inner join products on products.product_id = carts.product_id where carts.user_id = '.$_SESSION['user_id'].' GROUP by carts.user_id, carts.product_id,products.product_cost_price,products.product_name, products.product_image, products.product_amount
');
                        if ( $result){
                            $dem=0;
                            foreach ($result as $item){

                                $max = (int)$item['product_amount'] + (int)$item['sum(carts.cart_amount)'];
                                $price = (int)$item['sum(carts.cart_amount)'] * $item['product_cost_price'];

                                echo " <tr><input type='hidden' name='cart[".$dem."][id]' value='".$item['product_id']."'>
                                            <td><img src=\"../image/products/".$item['product_image']."\" alt=\"\"></td>
                                            <td>".$item['product_name']."</td>
                                            <td class='price'>".$item['product_cost_price']."</td>
                                            <td><input type='number' max='".$max."' min='0' step='1' name='cart[".$dem."][amount]' value='".$item['sum(carts.cart_amount)']."'></td>
                                            <td><input type='text' readonly name='cart[".$dem."][price]' value='".$price."'></td>
                                            <td><a href='' id='".$item['product_id']."'>xóa</a></td>
                                        </tr>";

                                $dem++;

                            }

                        }else echo "<tr><td colspan='6'>Chưa có sản phẩm trong giỏ hàng</td></tr>";



                    ?>
                    </tbody>


                </table>
            </div>

            <div class="main__carts--pay">

                <div class="sum__price">
                    <span>tổng tiền: </span>
                    <input type="text" readonly name="sum_price" value="0">
                </div>

                <div class="pay">
                    <a href="products.php">Tiếp tục mua hàng</a>
                    <input type="submit" name="bill" value="Thanh toán">
                </div>

            </div>
            </form>

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
require_once 'handler_carts.php';
// xử lý select category form
require_once 'handler_select_category.php';
?>
<script src="../js/js.js"></script>
<script>
    let dem=0;
    document.querySelectorAll('.main__carts--info input[type=\"text\"]').forEach(v=>{
        dem = dem + parseInt(v.value)
    });

    document.querySelector('.main__carts--pay input[type="text"]').value = dem;
</script>
