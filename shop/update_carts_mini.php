<?php

if (isset($_SESSION['user_id'])){


    // cập nhật lại giỏ hàng
//                    Cập nhật số lượng giỏ hàng header
    $new = new handler_database();
    $result = $new->get_list('select carts.user_id, carts.product_id, products.product_cost_price,sum(carts.cart_amount) from carts  inner join products on products.product_id = carts.product_id where carts.user_id = '.$_SESSION['user_id'].' GROUP by carts.user_id, carts.product_id,products.product_cost_price');
    $dem = 0;
    $sum_price = 0;
    if ($result) {

        foreach ($result as $item) {

            $dem += $item['sum(carts.cart_amount)'];
            $dem_product = $item['sum(carts.cart_amount)'];
            $sum_price += $dem_product * $item['product_cost_price'];

        }



        // đổ dữ liệu ra
        echo "<script>document.querySelectorAll('.miniCart > span').forEach(v=>{ v.innerHTML = " . $dem . "})</script>";
        echo "<script>document.querySelectorAll('.total').forEach(v=>{v.innerHTML = '" . number_format($sum_price, 0, ',', '.'). " đ'})</script>";
    }

}

?>