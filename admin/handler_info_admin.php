<script>

    // Xử lý show/hidden
    document.querySelector('div#main__info-admin__pass form>div:first-child>i').onclick = function(){
        document.querySelector('div#main__info-admin__pass').style.display = "none";
    }

    document.querySelector('.main__info-admin>.container>form>div:last-child>a').onclick = function(e){

        e.preventDefault();
        document.querySelector('div#main__info-admin__pass').style.display = "block";
    }



</script>


<?php

function start(){

    handler_update_info();

    update_pass_admin();

};

start();

// update info admin => xong
function handler_update_info(){

    if ( isset($_POST['update_info']) ){

        // kiểm tra dữ liệu đầu vào
        if ( empty(trim($_POST['fullname'])) || empty(trim($_POST['nickname']))||
            empty(trim($_POST['phone'])) || empty(trim($_POST['date_birth'])) ||
            empty(trim($_POST['email'])) || empty(trim($_POST['address'])) )
            echo "<script>alert('Không được bỏ trống trường nào!')</script>";
        else{

            // Xử lý dữ liệu mới

            // thêm dấu \ trước kí tự ',"
            $new_name =  str_replace('"' , '\\"', trim($_POST['fullname']));
            $new_name =  str_replace("'" , "\\'", $new_name);

            $new_nickname =  str_replace('"' , '\\"', trim($_POST['nickname']));
            $new_nickname =  str_replace("'" , "\\'", $new_nickname);

            $new_phone =  str_replace('"' , '\\"', trim($_POST['phone']));
            $new_phone =  str_replace("'" , "\\'", $new_phone);

            $new_date_birth =  str_replace('"' , '\\"', trim($_POST['date_birth']));
            $new_date_birth =  str_replace("'" , "\\'", $new_date_birth);

            $new_email =  str_replace('"' , '\\"', trim($_POST['email']));
            $new_email =  str_replace("'" , "\\'", $new_email);

            $new_address =  str_replace('"' , '\\"', trim($_POST['address']));
            $new_address =  str_replace("'" , "\\'", $new_address);


            // lấy dữ liệu cữ ra
            $select= new handler_database();
            $row = $select-> get_list('select * from users inner join role on role.role_id = users.role_id where users.id_user = '.$_SESSION['user_admin_id']);

            if ( $row ){

                // lấy ra dữ liệu cữ
                foreach ($row as $item) {
                    $name = $item['name_user'];
                    $phone = $item['phone_user'];
                    $date_birth = $item['date_birth_user'];
                    $address = $item['address_user'];
                    $email = $item['email_user'];
                    $nickname = $item['nickname'];
                    $pass = $item['password'];
                    $role_id = $item['role_id'];
                }

                //kiểm tra dữ liệu vào phải khác dữ liệu cũ
                if ( $new_name == $name && $new_nickname == $nickname && $new_phone == $phone
                    &&  $new_date_birth == $date_birth && $new_email == $email && $new_address == $address ) {
                    echo "<script>alert('Dữ liệu nhập vào phải khác!')</script>";
                }else{

                    // update dữ liệu
                    $new = new handler_database();

                    $update = $new->update_DB('users',array(
                        'name_user' => "$new_name",
                        'nickname' => "$new_nickname",
                        'phone_user' => "$new_phone",
                        'date_birth_user' => "$new_date_birth",
                        'email_user' => "$new_email",
                        'password' => "$pass",
                        'role_id' => $role_id,
                        'address_user' => "$new_address"
                    ),'id_user = '.$_SESSION['user_id']);

                    if ($update == true){

                        echo "<script>alert('Cập nhật thông tin admin thành công!'); window.location.replace('info_admin.php')</script>";

                    }else die('Có lỗi');

                }


            }else die('Có lỗi!');


        }


    }

}


function update_pass_admin(){

    if ( isset($_POST['submit_pass']) ){

        // kiểm tra dữ liệu đầu vào
        if ( empty($_POST['current_pass']) || empty($_POST['pass']) || empty($_POST['confirm_pass']) )
            echo "<script>alert('Không được để trống trường nào!')</script>";
        else{

            // lấy ra mật khẩu hiện tại của admin
            $select = new handler_database();

            $row = $select->get_list('select * from users where id_user = '.$_SESSION['user_admin_id']);

            if ( $row){

                foreach($row as $item){
                    $name = $item['name_user'];
                    $phone = $item['phone_user'];
                    $date_birth = $item['date_birth_user'];
                    $address = $item['address_user'];
                    $email = $item['email_user'];
                    $nickname = $item['nickname'];
                    $password = $item['password'];
                    $role_id = $item['role_id'];
                }

            }

            if ( $_POST['current_pass'] != $password )
                echo "<script>alert('Nhập mật khẩu cũ không đúng!')</script>";
            elseif( $_POST['pass']!= $_POST['confirm_pass'])
                echo "<script>alert('Nhập lại mật khẩu không đúng!')</script>";
            else{


                // Xử lý dữ liệu mới

                // thêm dấu \ trước kí tự ',"
                $current_pass =  str_replace('"' , '\\"', trim($_POST['current_pass']));
                $current_pass =  str_replace("'" , "\\'", $current_pass);

                $pass =  str_replace('"' , '\\"', trim($_POST['pass']));
                $pass =  str_replace("'" , "\\'", $pass);

                $confirm_pass =  str_replace('"' , '\\"', trim($_POST['confirm_pass']));
                $confirm_pass =  str_replace("'" , "\\'", $confirm_pass);


                // update dữ liệu
                $new = new handler_database();

                $update = $new->update_DB('users',array(
                    'name_user' => "$name",
                    'nickname' => "$nickname",
                    'phone_user' => "$phone",
                    'date_birth_user' => "$date_birth",
                    'email_user' => "$email",
                    'password' => "$pass",
                    'role_id' => $role_id,
                    'address_user' => "$address"
                ),'id_user = '.$_SESSION['user_admin_id']);

                if ($update == true){

                    echo "<script>alert('Cập nhật mật khẩu thành công!'); window.location.replace('info_admin.php')</script>";

                }else die('Có lỗi');


            }

        }


    }

}
