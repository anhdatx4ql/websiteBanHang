<?php

    if ( isset($_POST['update_product']) ){

        $product_id =  $_POST['product_id'] ? (int)$_POST['product_id'] : "";

        $product_cost_price =  $_POST['cost_price'] ? $_POST['cost_price'] : "";

        $product_cost_price = str_replace("," , "", $product_cost_price);

        $product_cost_price= (int)$product_cost_price;

        $product_update = new handler_database();

        $row = $product_update->get_list('select * from products where product_id = '.$product_id);

        if( $row ){

            foreach ($row as $r){

                if ($r['product_cost_price'] != $product_cost_price){

                    $test = new handler_database();
                    $result = $test->update_DB("products",array(
                        'product_cost_price' => $product_cost_price
                    ),'product_id = '.$product_id);

                    if ($result == true){
                        echo "<script>alert('Cập nhật giá sản phẩm thành công')</script>";

                        // hiển thị lại giá trị mới lên màn hình
                        echo "<script>document.querySelector('.main__priceProducts--right__center>table>tbody #id$product_id').value = '".$product_cost_price."'.replace(/\B(?=(\d{3})+(?!\d))/g, ',')</script>";

                    }
                    else echo "<script>alert('Có lỗi')</script>";

                }else echo "<script>alert('Giá nhập giống giá cũ.')</script>";

            }

        }else echo "<script>alert('Có lỗi')</script>";


    }


?>