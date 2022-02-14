<script>
    document.querySelector('.header__top--user > div > ul>li:last-child>a').onclick = function(e){

        e.preventDefault();

        let check = confirm('Bạn có muốn đăng xuất?');

        if ( check == true){

            window.location.replace('login_register.php');

        }

    }
</script>

<?php

    if ( isset($_SESSION['user_id']) ){

        $new = new handler_database();

        $result = $new->get_list('select * from users where id_user = '.$_SESSION['user_id']);

        if ($result){

            foreach ($result as $item) {
                echo "<script>document.querySelector('.header__top--user > div>p').innerHTML= '".$item['name_user']."'</script>";
            }

        }else die('Có lỗi!');

        echo "<script>document.querySelector('.header__top--user > a').style.display = \"none\"</script>";
        echo "<script>document.querySelector('.header__top--user > div').style.display = \"block\"</script>";


    }