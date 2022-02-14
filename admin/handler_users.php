<script>

    document.querySelectorAll('.main__products--left__navigation.gender__users>ul>li>input[name="users_left"]').forEach(v=>{

        v.onchange = function(){

            document.querySelector('form[name="form_select_users"]').submit();

        }

    });


    // kiểm tra có muốn xóa user hay không
    document.querySelector('.insert_update_user>form>div:last-child>input[name="delete_user"]').onclick = function(e){

        e.preventDefault();
        let check = confirm('Bạn có muốn xóa?');

        if (check == true){
            document.cookie = escape('check_delete_user') + '=' + escape('true');
            window.location.replace('users.php');
        }

    }


</script>



<?php

function start(){

    if ( isset( $_POST['users_left'] )){

        echo "<script>document.querySelectorAll('.main__products--left__navigation.gender__users>ul>li>input[name=\"users_left\"]').forEach(v=>{

        if ( v.value == '".$_POST['users_left']."' ){
            
             v.setAttribute('checked','true');
            
        }

    });</script>";

        $_SESSION['users_left'] = $_POST['users_left'];

        echo "<script>window.location.replace('users.php')</script>";

    }

    handler_insert_user();

    handler_update_user();

    handler_delete_users();

}

start();


// đã xong phần insert users
function handler_insert_user(){

    if ( isset($_COOKIE['insert_user']) ){

        echo "<script>document.querySelector('.parent_insert_update_user').style.display = \"block\";</script>";
        echo "<script>document.querySelector('.insert_update_user>form input[name=\"nickname\"]').removeAttribute('disabled');</script>";


        // xoa cookie
        echo "<script>document.cookie = 'insert_user' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }

    if ( isset( $_POST['insert_user'] ) ){

        if ( empty(trim($_POST['name'])) || empty(trim($_POST['phone'])) || empty(trim($_POST['date_birth']))
            || empty(trim($_POST['address'])) || empty(trim($_POST['email'])) || empty(trim($_POST['nickname']))
            || empty(trim($_POST['password']))   ){
            echo "<script>alert('Không được bỏ trống trường nào')</script>";
        }else{

            $date_birth = $_POST['date_birth'];

            // thêm dấu \ trước kí tự ',"
            $name=  str_replace('"' , '\\"', trim($_POST['name']));
            $name =  str_replace("'" , "\\'", trim($_POST['name']));

            $phone=  str_replace('"' , '\\"', trim($_POST['phone']));
            $phone =  str_replace("'" , "\\'", trim($_POST['phone']));

            $address=  str_replace('"' , '\\"', trim($_POST['address']));
            $address =  str_replace("'" , "\\'", trim($_POST['address']));

            $email=  str_replace('"' , '\\"', trim($_POST['email']));
            $email =  str_replace("'" , "\\'", trim($_POST['email']));

            $nickname=  str_replace('"' , '\\"', trim($_POST['nickname']));
            $nickname =  str_replace("'" , "\\'", trim($_POST['nickname']));

            $password =  str_replace('"' , '\\"', trim($_POST['password']));
            $password =  str_replace("'" , "\\'", trim($_POST['password']));

            // kiểm tra xem tên đăng nhập đã tồn tại hay chưa
            $select= new handler_database();

            $r = $select->get_list('select * from users');

            $check = true;

            if ($r){

                foreach ($r as $value){

                    if ($value['nickname'] == $nickname)
                        $check = false;
                }

            }

            if ($check == true){
                $insert_user = new handler_database();

                $result = $insert_user->insert_DB('users',array(
                    'name_user'=> "$name",
                    'phone_user' => "$phone",
                    'date_birth_user' => "$date_birth",
                    'address_user' => "$address",
                    'email_user' => "$email",
                    'nickname' => "$nickname",
                    'password' => $password,
                    'role_id' => 2
                ));

                if ( $result == true){

                    echo "<script>alert('Thêm thành công')</script>";

                    echo "<script>window.location.replace('users.php')</script>";


                }
                else  die('Có lỗi!');
            }else echo "<script>alert('nickname đã tồn tại!')</script>";


        }

    }

}


function handler_update_user(){

    if ( isset($_COOKIE['id_user_update']) ){


        echo "<script>document.querySelector('.parent_insert_update_user').style.display = \"block\";
        document.querySelector('.insert_update_user>form>div:last-child>input[name=\"insert_user\"]').style.display = \"none\";
        document.querySelector('.insert_update_user>form>div:last-child>input[name=\"update_user\"]').style.display = \"inline-block\";
        document.querySelector('.insert_update_user>form>div:last-child>input[name=\"delete_user\"]').style.display = \"inline-block\";
        document.querySelector('.insert_update_user>form input[name=\"nickname\"]').setAttribute('disabled','true');
            </script>";


        // hiển thị thông tin user lên form update
        $user = new handler_database();

        $row = $user->get_list('select * from users where id_user = '.(int)$_COOKIE['id_user_update']);

        if ($row){

            foreach ($row as $v){

                // thêm dấu \ trước kí tự ',"
                $v['name_user'] =  str_replace('"' , '\\"', trim($v['name_user']));
                $v['name_user'] =  str_replace("'" , "\\'", trim($v['name_user']));

                // thêm dấu \ trước kí tự ',"
                $v['address_user'] =  str_replace('"' , '\\"', trim($v['address_user']));
                $v['address_user'] =  str_replace("'" , "\\'", trim($v['address_user']));

                // thêm dấu \ trước kí tự ',"
                $v['email_user'] =  str_replace('"' , '\\"', trim($v['email_user']));
                $v['email_user'] =  str_replace("'" , "\\'", trim($v['email_user']));

                // thêm dấu \ trước kí tự ',"
                $v['nickname'] =  str_replace('"' , '\\"', trim($v['nickname']));
                $v['nickname'] =  str_replace("'" , "\\'", trim($v['nickname']));

                // thêm dấu \ trước kí tự ',"
                $v['password'] =  str_replace('"' , '\\"', trim($v['password']));
                $v['password'] =  str_replace("'" , "\\'", trim($v['password']));

                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"name\"]').value = '".$v['name_user']."'</script>";
                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"phone\"]').value = '".$v['phone_user']."'</script>";
                echo "<script>document.querySelector('.insert_update_user>form>div>div:last-child>input[name=\"date_birth\"]').value = '".$v['date_birth_user']."'</script>";
                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"address\"]').value = '".$v['address_user']."'</script>";
                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"email\"]').value = '".$v['email_user']."'</script>";
                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"nickname\"]').value = '".$v['nickname']."'</script>";
                echo "<script>document.querySelector('.insert_update_user div:not(:last-child)>input[name=\"password\"]').value = '".$v['password']."'</script>";

            }

        }

        $_SESSION['id_user_update'] = $_COOKIE['id_user_update'];

        // xoa cookie
        echo "<script>document.cookie = 'id_user_update' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }

    if ( isset($_POST['update_user']) ){

        // Lấy thông tin cũ để so sánh với thông tin mới
        $user = new handler_database();

        $row = $user->get_list('select * from users where id_user = '.(int)$_SESSION['id_user_update']);

        foreach ($row as $v){
            $name  = $v['name_user'];
            $phone = $v['phone_user'];
            $date_birth = $v['date_birth_user'];
            $address = $v['address_user'];
            $email  = $v['email_user'];
            $nickname  = $v['nickname'];
            $password  = $v['password'];
        }

        if ( trim($_POST['name']) != $name || $_POST['phone'] != $phone || $_POST['date_birth'] !=  $date_birth
           || trim($_POST['address']) != $address || trim($_POST['email']) != $email ||
            trim($_POST['nickname']) != $nickname || $_POST['password'] != $password ){

              $date_birth_new = $_POST['date_birth'];
            $phone_new = trim($_POST['phone']);

            // thêm dấu \ trước kí tự ',"
            $name_new =  str_replace('"' , '\\"', trim($_POST['name']));
            $name_new =  str_replace("'" , "\\'", trim($_POST['name']));

            // thêm dấu \ trước kí tự ',"
            $address_new =  str_replace('"' , '\\"', trim($_POST['address']));
            $address_new =  str_replace("'" , "\\'", trim($_POST['address']));

            // thêm dấu \ trước kí tự ',"
            $email_new =  str_replace('"' , '\\"', trim($_POST['email']));
            $email_new =  str_replace("'" , "\\'", trim($_POST['email']));

            // thêm dấu \ trước kí tự ',"
            $nickname_new =  str_replace('"' , '\\"', trim($_POST['nickname']));
            $nickname_new =  str_replace("'" , "\\'", trim($_POST['nickname']));

            // thêm dấu \ trước kí tự ',"
            $password_new =  str_replace('"' , '\\"', trim($_POST['password']));
            $password_new =  str_replace("'" , "\\'", trim($_POST['password']));

            $update_user = new handler_database();

            $result = $update_user->update_DB('users',array(
                    'name_user'=> (string)$name_new,
                'phone_user' => (string)$phone_new,
                'date_birth_user' => $date_birth_new,
                'address_user' => (string)$address_new,
                'email_user' => (string)$email_new,
                'password' => (string)$password_new
            ),'id_user = '.$_SESSION['id_user_update']);

            if ( $result == true){
                echo "<script>alert('Cập nhật thành công!')</script>";
                echo "<script>window.location.replace('users.php')</script>";
            }
            else  echo "<script>alert('Cập nhật thất bại!')</script>";

        }


    }

}


function handler_delete_users(){

    if ( isset($_COOKIE['check_delete_user']) ){

        $user = new handler_database();
        $row = $user->get_list('select * from users where id_user = '.(int)$_SESSION['id_user_update'] .' and role_id = 1');
        if(count($row) > 0){
            echo('<script>alert("Không thể xóa admin")</script>');
            exit();
        }else{
            //        muốn xóa khách hàng, trước hết phải xóa dữ liệu ở bảng bills_products, bills, carts

            // n

//      Xóa dữ liệu liên quan đến user ở bảng bills_products
            $delete_bills_products_user = new handler_database();
            $result = $delete_bills_products_user->delete_DB('bills_products','user_id = '.$_SESSION['id_user_update']);
            if ( $result== false) die('Có lỗi');

//        Xóa dữ liệu liên quan đến user ở bảng bills
            $delete_bills_user = new handler_database();
            $result = $delete_bills_user->delete_DB('bills','user_id = '.$_SESSION['id_user_update']);
            if ($result == false)die('Có lỗi');

//        Xóa dữ liệu liên quan đến user ở bảng carts (giỏ hàng)
            $delete_cart_user = new handler_database();
            $result = $delete_cart_user->delete_DB('carts','user_id = '.$_SESSION['id_user_update']);
            if( $result == false )die('Có lỗi');

//        Xóa user ở bảng users
            $delete_user = new handler_database();

            $result = $delete_user->delete_DB('users','id_user = '.$_SESSION['id_user_update']);

            if ( $result == true){

                echo "<script>alert('Xóa thành công!')</script>";

                // xóa cookie trước khi load lại trang
                echo "<script>document.cookie = 'check_delete_user' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

                echo "<script>window.location.replace('users.php')</script>";

            }else
                echo "<script>alert('Có lỗi!')</script>";

            // xoa cookie
            echo "<script>document.cookie = 'check_delete_user' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";


        }


    }

}




