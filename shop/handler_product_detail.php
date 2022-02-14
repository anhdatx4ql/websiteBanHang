<?php

if ( isset($_POST['insert_cart']) ){

//    Xử lý thêm sản phẩm

//    Lấy ra số lượng cũ của sản phẩm
    $new = new handler_database();

    $result = $new->get_list('select * from products where product_id = '.$_SESSION['product_id']);

    if ( $result ){

        foreach ($result as $value){

            $current_amount = $value['product_amount'];

        }

//        thêm sản phẩm và số lượng mới thêm vào carts
        $new = new handler_database();
        $re = $new->insert_DB('carts',array(
            'product_id' => $_SESSION['product_id'],
            'user_id' => $_SESSION['user_id'],
            'cart_amount' => $_POST['amount']
        ));

        if ( $re == true){

//            cập nhật lại số lượng sản phẩm
            $new = new handler_database();
            $r = $new->update_DB('products',array(
                'product_amount' => $current_amount - $_POST['amount']
            ),'product_id = '.$_SESSION['product_id']);

            if ( $r == true){
                echo "<script>alert('Thêm sản phẩm vào giỏ hàng thành công!'); window.location.replace('products.php')</script>";
            }

        }else die('Có lỗi!');


    }else die('Có lỗi!');

}
