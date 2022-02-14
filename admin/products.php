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
                    <a disabled="disabled" class="selected_nav">
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

        <div class="main__products--left">

            <div class="main__products--left__header">
                <b>Nhóm hàng</b>
                <i class="fas fa-plus-circle"></i>
            </div>

            <div class="main__left--search">
                <i class="fas fa-search"></i>
                <form action="products.php" method="post">
                    <input type="text" placeholder="Tìm kiếm nhóm hàng" name="text">
                    <input type="submit" name="submit_search_products">
                </form>

            </div>

            <div class="main__products--left__navigation">
                <ul>
                    <li class="selected_nav" id="0"><a href="">Tất cả</a></li>
                    <?php
                    $category = new handler_database();

                    if (isset($_POST['submit_search_products'])) {

                        if (trim($_POST['text']) == "") {
                            $sql = 'select * from categories';
                            echo "<script>document.querySelector('.main__products--left>.main__products--left__navigation>ul>li:first-child').style.display=\"block\"</script>";
                        } else {

                            echo "<script>document.querySelector('.main__products--left>.main__left--search input[type=\"text\"]').value  = '" . $_POST['text'] . "'</script>";

                            $sql = str_replace('"', '\\"', $_POST["text"]);
                            $sql = str_replace("'", "\\'", $sql);

                            $sql = 'select * from categories where category_name like \'%' . $sql . '%\'';

                            echo "<script>document.querySelector('.main__products--left>.main__products--left__navigation>ul>li:first-child').style.display=\"none\"</script>";

                        }

                    } else {
                        echo "<script>document.querySelector('.main__products--left>.main__products--left__navigation>ul>li:first-child').style.display=\"block\"</script>";
                        $sql = 'select * from categories';
                    }


                    $row_cate = $category->get_list($sql);

                    if (isset($row_cate)) {
                        foreach ($row_cate as $v) {
                            echo "<li id='" . $v['catedory_id'] . "'>
                                    <a href=\"\">" . $v['category_name'] . "</a>
                                    <a href=''><i class=\"fas fa-pencil-alt\"></i></a>
                                </li>";
                        }
                    } else {
                        echo "<li>
                                    <p>Không tìm thấy kết quả</p>
                                </li>";
                    }

                    ?>

                </ul>
            </div>

        </div>

        <div class="main__products--right">

            <div class="main__products--right__header">

                <div>
                    <i class="fas fa-search"></i>

                    <form action="products.php" method="post">

                        <input type="text" placeholder="Tìm kiếm hàng theo tên" name="text">

                        <input type="submit" name="search_products" style="display: none;">

                    </form>


                </div>

                <div>
                    <i class="fas fa-plus"></i>
                    <p>Thêm hàng mới</p>
                </div>

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
                        <th>Tồn kho</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $products = new handler_database();

                    if (isset($_POST['search_products'])) {

                        if (trim($_POST['text']) == "") {
                            $sql = "select * from products inner join categories on products.category_id = categories.catedory_id";
                        } else {

                            $sql = str_replace('"', '\\"', $_POST["text"]);
                            $sql = str_replace("'", "\\'", $sql);

                            $sql = 'select * from products inner join categories on products.category_id = categories.catedory_id where product_name like \'%' . $sql . '%\'';

                            echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input').value = '" . $_POST["text"] . "'</script>";

                        }

                    } elseif (isset ($_COOKIE['category_id'])) {

                        if ($_COOKIE['category_id'] != 0) {
                            $sql = "select * from products inner join categories on products.category_id = categories.catedory_id where catedory_id = " . $_COOKIE['category_id'];

                        } else {

                            $sql = "select * from products inner join categories on products.category_id = categories.catedory_id";

                        }

                        echo "<script>document.querySelectorAll('.main__products--left__navigation>ul>li').forEach(v=>{
    
                                        v.classList.remove('selected_nav');
                                                                                                    
                                    })
                                    document.querySelectorAll('.main__products--left__navigation>ul>li').forEach(v=>{
    
                                        if ( v.getAttribute('id') == " . $_COOKIE["category_id"] . ")
                                            v.classList.add('selected_nav');
                                                                                      
                                    })
                                        
                                    </script>";

                        echo "<script>document.cookie = \"category_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC\";</script>";

                    } else
                        $sql = "select * from products inner join categories on products.category_id = categories.catedory_id";


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
                                        <td>" . $item['product_trademark'] . "</td>
                                        <td>" . $item['product_amount'] . "</td>
                                    </tr>";
                        }
                    } else echo "<tr><td colspan='8'>Không có sản phẩm nào</td></tr>"


                    ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<div class="parent_update_product">
    <div class="update_product">
        <div>
            <h3>Thêm hàng hóa</h3>
            <i class="fas fa-times"></i>
        </div>

        <form action="products.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="product_id"
                   value="<?php echo (isset($_SESSION['product_id'])) ? $_SESSION['product_id'] : "" ?>">

            <div>
                <span>Ảnh</span>
                <input type="file" name="product_image">
            </div>

            <div>
                <span>Mã hàng</span>
                <input type="text" placeholder="Nhập mã hàng" name="product_code">
            </div>

            <div>
                <span>Tên hàng</span>
                <input type="text" placeholder="Nhập tên hàng" name="product_name">
            </div>

            <div class="update_product_row">
                <span>Chọn nhóm hàng</span>
                <select name="category_id" id="">
                    <?php
                    foreach ($row_cate as $v) {
                        echo "<option value='" . $v['catedory_id'] . "'>" . $v['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="update_product_row">
                <span>Nhà sản xuất</span>
                <input type="text" placeholder="Nhập nhà sản xuất" name="product_trademark">
            </div>

            <div class="update_product_row">
                <span>Số lượng</span>
                <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="product_amount"
                       placeholder="Nhập số lượng">
            </div>

            <div class="update_product_row">
                <span>Giá vốn</span>
                <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="product_price"
                       placeholder="Nhập giá vốn">
            </div>

            <div class="update_product_row">
                <span>Giá bán</span>
                <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="product_cost_price"
                       placeholder="Nhập giá bán">
            </div>

            <div>
                <span>Thông tin</span>
                <textarea name="product_detail" id="" cols="30" rows="10"></textarea>
            </div>

            <div>
                <input type="submit" name="update_product" value="Sửa sản phẩm">
                <input type="submit" name="insert_product" value="Thêm sản phẩm">
                <input type="submit" name="delete_product" onclick="return confirm('Bạn có muốn xóa sản phẩm này?')" value="Xóa sản phẩm">
            </div>

        </form>
    </div>
</div>

<div class="parent_handler_categories">

    <div class="child_handler_categories">

        <div>
            <h3>Tên nhóm hàng</h3>
            <i class="fas fa-times"></i>
        </div>

        <form action="products.php" method="post">

            <input type="hidden" name="id_category" value="">

            <div>
                <span>Tên nhóm</span>
                <input type="text" placeholder="Nhập tên nhóm" name="category_name">
            </div>

            <div>
                <input type="submit" name="insert_category" value="Thêm nhóm">
                <input type="submit" name="update1_category" value="Sửa">
                <input type="submit" name="delete1_category" value="Xóa">
            </div>


        </form>
    </div>

</div>




</body>
</html>

<?php
require_once 'handler_products.php';
require_once  'handler_logout.php';
?>

<script src="../js/admin/js_products.js"></script>
<script src="handler_logout.php"></script>
<script src="../js/admin/js_all.js"></script>
<style>
    .main__products--left>.main__products--left__navigation>ul>li:not(:first-child)>a:last-child{
        display: none;
    }


    .main__products--left>.main__products--left__navigation>ul>li:not(:first-child):hover>a:last-child{
        display: block;
    }

    .child_handler_categories>form>div:last-child>input {
        margin-right: 2%;
    }
</style>



