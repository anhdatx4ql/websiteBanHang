<!-- Xử lý hiển thị thông tin chi tiết hóa đơn-->
<script>

    document.querySelector('div#detail_bills > div > div:first-child > i').onclick = function () {
        document.querySelector('div#detail_bills').style.display = "none";
    }

    document.querySelectorAll('.main>.container>.main__left>ul>li:not(:last-child)').forEach(v => {

        v.querySelector('a').onclick = function (e) {

            e.preventDefault();

            document.querySelectorAll('.main>.container>.main__left>ul>li:not(:last-child)').forEach(v => {

                document.querySelector(v.querySelector('a').getAttribute('href')).style.display = "none";
            })

            document.querySelector(v.querySelector('a').getAttribute('href')).style.display = "block";

        }

    })

    document.querySelector('.main__right>div>div>form>div:last-child>a').onclick = function (e) {

        e.preventDefault();

        document.querySelector(this.getAttribute('href')).style.display = "block";

    }

    document.querySelectorAll('.main__right--bills table tr').forEach(v => {

        if (v.querySelector('input') != null) {

            v.onclick = function () {

                document.cookie = escape('bill_id_detail') + '=' + escape(v.querySelector('input').value);

                window.location.replace('info_user.php');

            }

        }

    })


</script>

<script>
    document.querySelector('.main>.container>.main__left>ul>li:last-child>a').onclick = function (e) {

        e.preventDefault();

        let check = confirm('Bạn có muốn đăng xuất');

        if (check == true) {

            window.location.replace('login_register.php');

        }

    }
</script>
<script src="../js/js.js"></script>
<style>
    .main > .container {
        display: flex;
        justify-content: start;
        background: white;
        border-top: 1px solid #ccc;
    }

    .main > .container > .main__left {
        flex: 0.2;
        display: flex;
        flex-direction: column;
        margin-right: 2%;
        border-right: 1px solid #ccc;
        padding-right: 1%;
        min-height: 300px;
    }

    .main > .container > .main__right {
        flex: 0.8;
    }

    .main > .container > .main__left > ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .main > .container > .main__left > ul > li > a {
        text-decoration: none;
        color: black;
        border-bottom: 1px solid #ccc;
        width: 100%;
        text-align: start;
        padding: 2% 0;
        transition: 0.5s all ease;
    }

    .main > .container > .main__left > ul > li > a:hover {
        color: green;
        border-bottom: 1px solid green;
    }

    .main__right > div > div > form {
        display: flex;
        flex-direction: column;
        justify-content: start;
    }

    .main__right > div > div > form > div {
        padding: 1% 0;
        padding-bottom: 0.5%;
    }

    .main__right > div > div > form > div > strong {
        width: 12%;
        display: inline-block;
    }

    .main__right > div > div > form > div:not(:last-child) > input {
        padding: 0.5% 1%;
        width: 42%;
        background: whitesmoke;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .main__right > div > div > form > div:not(:last-child) > input:focus {
        box-shadow: 0px 4px 6px green;
    }

    .main__right > div > div > form > div:last-child > input {
        border: none;
        padding: 0.5% 2%;
        border-radius: 4px;
        background: #B7DA2C;
        color: white;
        transition: 0.5s all ease;
        font-weight: 600;
    }

    .main__right > div > div > form > div:last-child > input:hover {
        cursor: pointer;
        background: green;
    }

    .main__right--bills table {
        background: whitesmoke;
        width: 80%;
        text-align: start;
    }

    .main__right--bills table tr:not(:first-child):hover {
        cursor: pointer;
        background: #ccc;
    }

    .main__right--bills table tr {
        transition: 0.5s all ease;
    }

    .main__right > div {
        display: none;
    }

    body {
        padding: 0;
        margin: 0;
        font-family: sans-serif;
        position: relative;
    }


    .main__right > div > div > form > div:last-child > a {
        background: #B4D82B;
        text-decoration: none;
        padding: 0.5% 1%;
        margin: 0;
        font-size: 13px;
        font-weight: 600;
        border-radius: 4px;
        color: white;
        transition: 0.5s all ease;
    }

    .main__right > div > div > form > div:last-child > a:hover {
        cursor: pointer;
        background: green;
    }

    .main__right > div > div:last-child {
        display: none;
    }

    div#detail_bills > div {
        width: 60%;
        margin: 2% auto;
        background: white;
        padding: 1%;
        border-radius: 4px;
    }

    div#detail_bills > div > div:first-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    div#detail_bills > div > div:first-child > i {
        padding: 1%;
        font-size: 24px;
        border-radius: 4px;
        transition: 0.5s all ease;
    }

    div#detail_bills > div > div:first-child > i:hover {
        background: whitesmoke;
        cursor: pointer;
    }

    div#detail_bills > div > div > form {
        width: 100%;
    }

    div#detail_bills > div > div > form > div {
        display: flex;
        align-items: center;
        margin: 1% 0;
    }

    div#detail_bills > div > div > form > div > span {
        width: 12%;
    }

    div#detail_bills > div > div > form > div > input {
        background: none;
        border: none;
        border-bottom: 1px solid #ccc;
        outline: none;
        cursor: unset;
    }

    div#detail_bills > div > div > form table {
        width: 100%;
    }

    div#detail_bills {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(2, 2, 2, 0.4);
        display: none;
    }

</style>


<?php
handler_info_user();
handler_pass();
// kiem tra neu ton tai
if (isset($_COOKIE['bill_id_detail'])) {

    echo "<script>document.querySelector('div#detail_bills').style.display = \"block\";</script>";
    echo "<script> document.cookie = 'bill_id_detail' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";



}

//Xử lý thay đổi thông tin user
function handler_info_user(){

    if ( isset($_POST['submit_acocunt'])){

        if (empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['address'])
            || empty($_POST['birth_date']) || empty($_POST['name']) ){
            echo "<script>alert('Không được bỏ trống');</script>";
        }else{

            $new = new handler_database();

            $get = $new->get_list('select * from users where id_user = '.$_SESSION['user_id']);

            if ($get){

                // lấy ra thông tin cũ
                foreach($get as $v){

                    $name = $v['name_user'];
                    $phone = $v['phone_user'];
                    $email = $v['email_user'];
                    $address = $v['address_user'];
                    $birth = $v['date_birth_user'];

                }

                // so sánh nếu giống nhau thi đưa ra thông báo, Nếu khác nhau thì mới thay đổi được
                if ( trim($_POST['name']) != $name || trim($_POST['address']) != $address
                    || $_POST['phone'] != $phone || trim($_POST['email']) != $email
                    || $_POST['birth_date'] != $birth ){

                    // thêm / trước dấu ' " trong dữ liệu nhập vào
                    $new_name = str_replace('"', '\\"', trim($_POST['name']));
                    $new_name = str_replace("'", "\\'", $new_name);

                    $new_add = str_replace('"', '\\"', trim($_POST['address']));
                    $new_add = str_replace("'", "\\'", $new_add);

                    // update du lieu
                    $new = new handler_database();

                    $result = $new->update_DB('users',array(
                            'name_user' => "$new_name",
                        'phone_user' => $_POST['phone'],
                        'address_user' => "$new_add",
                        'email_user' => trim($_POST['email']),
                        'date_birth_user' => $_POST['birth_date']
                    ),'id_user = '.$_SESSION['user_id']);

                    if ($result== true) {

                        echo "<script>alert('Cập nhật thành công!');window.location.replace('info_user.php')</script>";

                    }else die('Có lỗi!');


                } else echo "<script>alert('Dữ liệu nhập vào phải khác');</script>";


            }else die('Có lỗi!');

        }


    }

}

// thay doi mat khau
function handler_pass(){

    if ( isset($_POST['submit_new_pass']) ){

        if ( empty($_POST['pass']) || empty($_POST['new_password']) || empty($_POST['new_confirm_password'])  ){

            echo "<script>alert('Không được bỏ trống trường nào!')</script>";
        }else{

            // lấy ra mật khẩu hiện tại của người dùng

            $new = new handler_database();

            $get = $new->get_list('select password from users where id_user = '.$_SESSION['user_id']);

            if ($get){

                foreach ($get as $v)
                    $pass = $v['password'];

                if ($_POST['pass'] != $pass)
                    echo "<script>alert('Nhập mật khẩu cũ không đúng!')</script>";
                elseif($pass == $_POST['new_confirm_password'] )
                    echo "<script>alert('Mật khẩu mới phải khác mật khẩu cũ!')</script>";
                elseif ($_POST['new_password'] != $_POST['new_confirm_password'] )
                    echo "<script>alert('Nhập lại mật khẩu mới không khớp!')</script>";
                else{

                    // cập nhật mật khẩu
                    $new = new handler_database();

                    $update = $new->update_DB('users',array(
                            'password' => $_POST['new_password']
                    ),'id_user = '.$_SESSION['user_id']);

                    if ($update == true)
                        echo "<script>alert('Cập nhật thành công!');window.location.replace('info_user.php')</script>";
                    else die('Có lỗi!');


                }

            }else die('Có lỗi!');


        }

    }

}

?>