<?php

if (isset($_POST['add_product_cart'])) {

    if (isset($_SESSION['user_id'])) {

        //  Lấy ra id sản phẩm, số lượng auto bằng 1, thêm vào giỏ hàng
        $new = new handler_database();

        $result = $new->insert_DB('carts', array(
            'product_id' => $_POST['product_id'],
            'user_id' => $_SESSION['user_id'],
            'cart_amount' => 1
        ));

        if ($result == true) {

            // Cập nhật lại số lượng sản phẩm trong products
            $new = new handler_database();

            $result = $new->get_list('select * from products where product_id = ' . $_POST['product_id']);

            if ($result) {

                foreach ($result as $v) {
                    $name = $v['product_name'];
                    $trademark = $v['product_trademark'];
                    $cost_price = $v['product_cost_price'];
                    $price = $v['product_price'];
                    $detail = $v['product_detail'];
                    $image = $v['product_image'];
                    $category_id = $v['category_id'];
                    $code = $v['product_code'];
                    $created_at = $v['created_at'];
                    $updated_at = $v['updated_at'];
                    $current_amount = $v['product_amount'];
                }

                // Cập nhật lại số lượng
                $current_amount = (int)$current_amount - 1;

                // đưa số lượng mới vào database
                $new = new handler_database();
                $result = $new->update_DB('products', array(
                    'product_name' => "$name",
                    'product_trademark' => "$trademark",
                    'product_cost_price' => $cost_price,
                    'product_price' => $price,
                    'product_detail' => "$detail",
                    'product_image' => "$image",
                    'category_id' => $category_id,
                    'product_code' => "$code",
                    'created_at' => "$created_at",
                    'updated_at' => "$updated_at",
                    'product_amount' => $current_amount
                ), 'product_id = ' . $_POST['product_id']);

                echo "<script>alert('Thêm sản phẩm vào giỏ hàng thành công!')</script>";

            } else die('Có lỗi!');


        } else die('Có lỗi!');


    } else {

        echo "<script>alert('Bạn chưa đăng nhập!'); window.location.replace('login_register.php')</script>";

    }

}




?>