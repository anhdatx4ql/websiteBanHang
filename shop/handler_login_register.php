<?php
// xóa session
if ( isset($_SESSION['user_id'])){

    // xóa hết sản phẩm ở giỏ hàng.
    $new = new handler_database();

    $result = $new->get_list('select * from carts where user_id = '.$_SESSION['user_id']);

    if ($result){

        foreach ($result as $value){

            $product_id = $value['product_id'];
            $cart_amount = $value['cart_amount'];


            // trả số lượng đó vệ products
            $new = new handler_database();
            $select = $new->get_list('select * from products where product_id = '.$product_id);

            if ($select){

                foreach ($select as $item){
                    $current_amount = $item['product_amount'];

                    // cập nhật lại só lượng của sản phẩm đó

                    $update_amount = new handler_database();

                    $up = $update_amount->update_DB('products',array(
                        'product_amount' => (int)$current_amount + (int)$cart_amount
                    ),'product_id = '.$product_id);

                    if ($up == false) die('Có lỗi!');

                }

            }

        }

        // xóa toàn bộ dữ liệu trong carts
        $new = new handler_database();

        $re = $new->delete_DB('carts','user_id = '.$_SESSION['user_id']);

    }



    unset($_SESSION['user_id']);
}

//đăng ký
if ( isset($_POST['register'])){


    if ( empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone'])
    || empty($_POST['address']) || empty($_POST['nickname']) || empty($_POST['password'])
    || empty($_POST['confirm_password']) || empty ($_POST['date_birth'])){

        echo "<script>alert('Không được bỏ trống trường nào trong form đăng ký!')</script>";

    }else{

        if ( !is_numeric($_POST['phone']) )
            echo "<script>alert('Số điện thoại phải là số!')</script>";
        elseif ( $_POST['password'] != $_POST['confirm_password'] )
            echo "<script>alert('Mật khẩu phải giống nhau!')</script>";
        else{

            // kiểm tra xem nickname đã trùng hay chưa
            $new = new handler_database();
            $result = $new->get_list('select nickname from users');

            $check = false;

            if ( $result){
                foreach ($result as $v){

                    if ( $_POST['nickname'] == $v['nickname']){
                        $check = true;
                        echo "<script>alert('Tên đăng nhập này đã có người sử dụng')</script>";
                    }

                }
            }

            if ( $check == false){


                // thêm dấu \ trước kí tự ',"
                $fullname=  str_replace('"' , '\\"', trim($_POST['fullname']));
                $fullname =  str_replace("'" , "\\'", $fullname);

                $date_birth =  str_replace('"' , '\\"', trim($_POST['date_birth']));

                $email=  str_replace('"' , '\\"', trim($_POST['email']));
                $email =  str_replace("'" , "\\'", $email);

                $phone=  str_replace('"' , '\\"', trim($_POST['phone']));
                $phone =  str_replace("'" , "\\'", $phone);

                $address=  str_replace('"' , '\\"', trim($_POST['address']));
                $address =  str_replace("'" , "\\'", $address);

                $nickname=  str_replace('"' , '\\"', trim($_POST['nickname']));
                $nickname =  str_replace("'" , "\\'", $nickname);

                $password =  str_replace('"' , '\\"', trim($_POST['password']));
                $password =  str_replace("'" , "\\'", $password);

                $confirm_password =  str_replace('"' , '\\"', trim($_POST['confirm_password']));
                $confirm_password =  str_replace("'" , "\\'", $confirm_password);


                // xử lý đăng ký
                $new = new handler_database();

                $result = $new->insert_DB('users',array(
                    'name_user' => "$fullname",
                    'phone_user' => $phone,
                    'date_birth_user' => "$date_birth",
                    'address_user' => "$address",
                    'email_user' => "$email",
                    'nickname' => "$nickname",
                    'password' => "$password",
                    'role_id' => 2
                ));

                if ($result == true){

                    echo "<script>alert('Đăng ký thành công!')</script>";

                }else die('Có lỗi!');

            }


        }
    }

}

//        Đăng nhập
if ( isset($_POST['submit_login'])){

    if ( empty ($_POST['nickname']) || empty($_POST['password']) ){

        echo "<script>alert('Không được bỏ trống trường nào trong đăng nhập!')</script>";

    }else{

        // lấy ra thông tin đăng nhập của tất cả các khách hàng trừ admin
        $new = new handler_database();

        $result = $new->get_list('select id_user,nickname,password from users inner join role on role.role_id = users.role_id where role.role_name not in(select role.role_name from users inner join role on role.role_id = users.role_id where role_name = \'admin\')');

        if ( $result ){


            foreach ($result as $item) {

                if ( $item['nickname'] == $_POST['nickname'] && $item['password'] == $_POST['password'] ){

//                    Nếu đăng nhập thành công thì lấy id của người dùng lưu dưới dạng session rồi load đến trang index.php
                    $_SESSION['user_id'] = $item['id_user'];

                    echo "<script>alert('Đăng nhập thành công!')</script>";
                    echo "<script>window.location.replace('index.php')</script>";

                }

            } echo "<script>alert('Sai thông tin đăng nhập!')</script>";

        }else die('Có lỗi!');


    }

}

?>