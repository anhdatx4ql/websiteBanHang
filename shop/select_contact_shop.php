<?php


    $new = new handler_database();

    $result = $new->get_list('select phone_user,address_user,email_user from users inner join role on role.role_id = users.role_id where role_name = \'admin\' ');

    if ($result){

        foreach ($result as $value){

            $contact_phone = $value['phone_user'];
            $contact_address = $value['address_user'];
            $contact_email = $value['email_user'];
        }

    }else die('Có lỗi');


        $new = new handler_database();

        $category = $new->get_list('select * from categories');
        if ( !$category) die('Có lỗi');



?>