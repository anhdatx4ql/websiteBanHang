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
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style_admin.css">
    <LINK REL="SHORTCUT ICON"  HREF="../image/logo.png">
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
                    <a href="users.php" class="selected_nav">
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

<div class="main__products">
    <div class="container">
        <form action="users.php" method="post" name="form_select_users">
            <div class="main__products--left">

                <div class="main__products--left__header">
                    <b>Khách hàng</b>
                </div>

                <div class="main__products--left__navigation gender__users">
                    <ul>
                        <li><input type='radio' name='users_left' value="0" checked><a href="">Tất cả</a></li>
                        <li><input type='radio' name='users_left' value="1"><a href="">Đã mua hàng</a></li>
                        <li><input type='radio' name='users_left' value="2" ><a href="">Chưa mua hàng</a></li>
                    </ul>
                </div>

            </div>
        </form>

        <div class="main__products--right">

            <div class="main__products--right__header">

                <div>
                    <i class="fas fa-search"></i>
                    <form action="users.php" method="post">
                        <input type="text" placeholder="Tìm kiếm khách hàng theo tên" name="name">
                        <input type="submit" name="submit_search_user_header" style="display: none">
                    </form>
                </div>

                <div>
                    <i class="fas fa-plus"></i>
                    <p>Thêm khách hàng</p>
                </div>

            </div>

            <div class="main__products--right__center">

                <?php
                $users = new handler_database();
                $check_pay = false;

                if ( isset($_SESSION['users_left']) ){

                    echo "<script>document.querySelectorAll('.main__products--left__navigation.gender__users>ul>li>input[name=\"users_left\"]').forEach(v=>{

                                if ( v.value == ".$_SESSION['users_left']." ){
                    
                                    v.setAttribute('checked','true');
                    
                                }
                    
                            });</script>";

                    if( $_SESSION['users_left'] == 0 ){
                        $sql = "select * from users";
                        $check_pay = false;

                        if ( isset($_POST['submit_search_user_header']) ){

                            $_POST['name'] = str_replace('"' , '\\"', $_POST['name']);
                            $_POST['name'] = str_replace("'" , "\\'", $_POST['name']);

                            $sql = 'select * from users where name_user like \'%'.$_POST['name'].'%\' ';

                            echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = '".$_POST['name']."'</script>";

                        }

                    }

                    elseif ( $_SESSION['users_left']==1 ){
                        // da mua hang
                        $sql = 'select users.id_user, users.name_user, users.phone_user, users.date_birth_user, users.email_user, users.address_user, count(bills.bill_id) as \'bills_count\', sum(bills.money) as \'sum_money\' from users inner join bills on users.id_user = bills.user_id GROUP BY users.id_user, users.name_user, users.phone_user, users.date_birth_user, users.email_user, users.address_user';

                        $check_pay = true;

                        if ( isset($_POST['submit_search_user_header']) ){

                            $_POST['name'] = str_replace('"' , '\\"', $_POST['name']);
                            $_POST['name'] = str_replace("'" , "\\'", $_POST['name']);

                            $sql = 'select users.id_user, users.name_user, users.phone_user, users.date_birth_user, users.email_user, users.address_user, count(bills.bill_id) as \'bills_count\', sum(bills.money) as \'sum_money\'
                                        from users inner join bills on users.id_user = bills.user_id
                                        where users.name_user like \'%'.$_POST['name'].'%\'
                                        GROUP BY users.id_user, users.name_user, users.phone_user, users.date_birth_user, users.email_user, users.address_user';
                            echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = '".$_POST['name']."'</script>";
                        }


                    } else{

                        // chua mua hang
                        $sql = 'select * from users where users.id_user not in (select users.id_user from users inner join bills on users.id_user = bills.user_id)';

                        $check_pay = false;

                        if  ( isset( $_POST['submit_search_user_header'] ) ){

                            $_POST['name'] = str_replace('"' , '\\"', $_POST['name']);
                            $_POST['name'] = str_replace("'" , "\\'", $_POST['name']);

                            $sql = 'select * from users where users.name_user like \'%'.$_POST['name'].'%\' and  users.id_user not in (select users.id_user from users inner join bills on users.id_user = bills.user_id)';

                            echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = ".$_POST['name']."</script>";
                        }

                    }


                }else{

                    $sql = 'select * from users';

                    if ( isset($_POST['submit_search_user_header']) ){

                        $_POST['name'] = str_replace('"' , '\\"', $_POST['name']);
                        $_POST['name'] = str_replace("'" , "\\'", $_POST['name']);

                        $sql = 'select * from users where name_user like \'%'.$_POST['name'].'%\' ';

                        echo "<script>document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(1) input[name=\"name\"]').value = '".$_POST['name']."'</script>";

                    }

                }


                $row = $users->get_list($sql);

                if ( $check_pay == true) {
                    echo "<table cellpadding=\"5\" cellspacing=\"0\">
                                <thead>
                                <tr>
            
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoại</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th style='width: 30px;'>Số đơn mua</th>
                                    <th>Tổng bán</th>
                                </tr>
                                </thead>
                                <tbody>";
                    if ($row )
                        foreach ($row as $item) {
                            echo " <tr>
                                <td>".$item['id_user']."</td>
                                <td>".$item['name_user']."</td>
                                <td>".$item['phone_user']."</td>
                                <td>".$item['date_birth_user']."</td>
                                <td>".$item['email_user']."</td>
                                <td>".$item['address_user']."</td>
                                <td>".$item['bills_count']."</td>
                                <td>".number_format($item['sum_money'], 0, ',', ',')."</td>
                            </tr>";}
                    else echo " <tr>
                                <td colspan='6'> Không tìm thấy khách hàng </td>
                            </tr>";
                }else{
                    echo "<table cellpadding=\"5\" cellspacing=\"0\">
                                <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoại</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                </tr>
                                </thead>
                                <tbody>";
                    if ( $row)
                        foreach ($row as $item) {
                            echo " <tr>           
                                <td>".$item['id_user']."</td>
                                <td>".$item['name_user']."</td>
                                <td>".$item['phone_user']."</td>
                                <td>".$item['date_birth_user']."</td>
                                <td>".$item['email_user']."</td>
                                <td>".$item['address_user']."</td>
                            </tr>";}
                    else
                        echo " <tr>           
                                <td colspan='6'> Không tìm thấy khách hàng </td>
                            </tr>";
                }


                ?>
                </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<div class="parent_insert_update_user">

    <div class="insert_update_user">

        <div>
            <h3>Form Thêm khách hàng</h3>
            <i class="fas fa-times"></i>
        </div>

        <form action="users.php" method="post">

            <div>
                <span>Tên khách hàng</span>
                <input type="text" name="name" placeholder="Nhập tên">
            </div>

            <div>
                <div>
                    <span>Điện thoại</span>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại"  onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>

                <div>
                    <span>Ngày sinh</span>
                    <input type="date" name="date_birth" placeholder="Chọn ngày sinh">
                </div>
            </div>


            <div>
                <span>Địa chỉ</span>
                <input type="text" name="address" placeholder="Nhập địa chỉ">
            </div>

            <div>
                <span>Email</span>
                <input type="email" name="email" placeholder="Nhập email">
            </div>

            <div>
                <span>Nickname</span>
                <input type="text" name="nickname" placeholder="Nhập tên đăng nhập">
            </div>

            <div>
                <span>Password</span>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <div>
                <input type="submit" name="insert_user" value="Thêm">
                <input type="submit" name="update_user" value="Cập nhật" style="display:none;">
                <input type="submit" name="delete_user" value="Xóa" style="display: none">
            </div>

        </form>

    </div>

</div>


</body>
</html>

<!-- xử lý hiện form thông tin khách hàng-->
<script>

    document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(2)').onclick = function(){


        document.cookie = escape('insert_user') + '=' + escape('true');
        window.location.replace('users.php');

    }

    document.querySelector('.insert_update_user>div:first-child>i').onclick = function(){

        document.querySelector('.parent_insert_update_user').style.display = "none";

    }

    document.querySelectorAll('.main__products--right__center>table>tbody>tr').forEach(v=>{

        v.onclick = function(){

            let user_id = v.querySelector('.main__products--right__center>table>tbody>tr>td:first-child').innerHTML;

            document.cookie = escape('id_user_update') + '=' + escape(user_id);
            window.location.replace('users.php');

        }

    });


</script>

<?php require_once 'handler_users.php'?>


