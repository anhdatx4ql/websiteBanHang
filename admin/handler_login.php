<?php

// xử lý admin đăng nhập


if ( isset($_POST['submit__manage']) ){

    $admin = new handler_database();

    $info_admin = $admin->get_list('select * from users inner join role on users.role_id = role.role_id');

    foreach ($info_admin as $item) {

        if ( $item['role_name'] == 'admin' ){

            if ( $item['nickname'] == $_POST['nickname'] && $item['password'] == $_POST['password'] ) {

                $_SESSION['user_admin_id'] = $item['id_user'];
                header('location: index.php');
            }
            else echo "<script>alert('Đăng nhập thất bại') </script>";

        }

    }


}