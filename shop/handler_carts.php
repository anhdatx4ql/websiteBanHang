<!-- Xử lý thêm/ bớt số lượng sản phẩm-->
<script>

    document.querySelectorAll('.main__carts--info>table input[type="number"]').forEach(v => {

        v.onchange = function () {

            document.cookie = escape('onchange_amount') + '=' + escape(v.value);
            document.cookie = escape('onchange_amount_id') + '=' + escape(v.parentElement.parentElement.querySelector('input[type="hidden"]').value);

            window.location.replace('carts.php');

        }

    });

    // xử lý xóa sản phẩm trong giỏ hàng
    document.querySelectorAll('.main__carts--info table a').forEach(v => {

        v.onclick = function (e) {

            e.preventDefault();

            let check = confirm('Bạn có muốn xóa?');

            if (check == true) {

                document.cookie = escape('delete_product_cart') + '=' + escape(v.getAttribute('id'));

                window.location.reload();

            }

        }

    });

    // xử ý thanh toán giỏ hàng
    document.querySelector('.main__carts--pay input[type="submit"]').onclick = function (e) {

        e.preventDefault();

        let check = confirm('Bạn có muốn thanh toán!');

        if (check == true) {

            document.querySelector('.main__carts--info form').submit();

        }

    }

</script>


<?php

// Xử lý thanh toán
if (isset ($_POST['cart'])) {

    // lấy ra money để thêm vào bill mới
    $new = new handler_database();
    $date = date('Y-m-d h:i:s', time());
    $result = $new->insert_DB('bills',array(
        'user_id' => $_SESSION['user_id'],
        'money' => (int)$_POST['sum_price'],
        'created_at' => "$date"
    ));

    // THêm bill mới
    if ($result == true){

        $new = new handler_database();
        $sql = 'select bill_id from bills where user_id = '.$_SESSION['user_id'].' and money = '.(int)$_POST['sum_price'].' and created_at= \''.$date.'\'';
        $result = $new->get_list($sql);

        // bắt đầu lấy ra id của hóa đơn vừa thêm
        if ($result){

            foreach ($result as $value){
                $bill_id = $value['bill_id'];
            }

            // sau khi lấy ra được id của hóa đơn vừa thêm thì thêm vào chi tiết hóa đơn
            foreach ($_POST['cart'] as $value){

//                echo " product_id = ".$value['id']." |  amount =  ".$value['amount']." | sum_price = ".$value['price']."<br>";
                // bắt đầu thêm vào chi tiết hóa đơn
                $new = new handler_database();

                $insert = $new->insert_DB('bills_products',array(
                        'user_id' =>$_SESSION['user_id'],
                    'product_id'=> $value['id'],
                    'bill_product_amount' => $value['amount'],
                    'bill_id' => $bill_id
                ));
                // nếu như thêm thất bại
                if ($insert == false) die('Có lỗi!');

            }

            // sau khi thêm vào bills_products xong thì xóa sản phẩm ở giỏ hàng
            $new = new handler_database();
            $result = $new->delete_DB('carts','user_id = '.$_SESSION['user_id']);
            if ($result == true){

                echo "<script>alert('Thanh toán thành công!'); window.location.replace('index.php')</script>";

            }else die('Có lỗi!');


        }else die('Có lỗi!');
        // kết thúc lấy ra id của hóa đơn vừa thêm


    }else die('Có lỗi!');
    // kết thúc thêm bill mới



}

// Xử lý xóa sản phẩm trong giỏ hàng => Xử lý xong
if (isset($_COOKIE['delete_product_cart'])) {

    $product_id = $_COOKIE['delete_product_cart'];

    // lấy số lượng trong giỏ hàng
    $new = new handler_database();

    $result = $new->get_list('select carts.product_id, carts.user_id, sum(carts.cart_amount),product_amount from carts
                        inner join products on products.product_id = carts.product_id
                        where carts.product_id = ' . $product_id . ' and carts.user_id = ' . $_SESSION['user_id'] . ' GROUP by carts.product_id, carts.user_id');

    if ($result) {

        foreach ($result as $item) {

            $amount = $item['sum(carts.cart_amount)'];
            $product_amount = $item['product_amount'];

        }

        // trả lại số lượng sản phẩm đã đưa vào giỏ hàng về bảng sản phẩm
        $new = new handler_database();

        $result = $new->update_DB('products', array(
            'product_amount' => (int)$product_amount + (int)$amount
        ), 'product_id = ' . $product_id);

        if ($result == true) {

            // xóa sản phẩm trong cart
            $dlt = new handler_database();

            $result = $dlt->delete_DB('carts', 'product_id = ' . $product_id . ' and user_id = ' . $_SESSION['user_id']);

            if ($result == true) {

                echo "<script>document.cookie = 'delete_product_cart' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
                echo "<script>alert('Xóa thành công!'); window.location.reload();document.cookie = 'delete_product_cart' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

            } else die('Có lỗi!');

        } else die('Có lỗi!');


    } else die('Có lỗi!');

    echo "<script>document.cookie = 'delete_product_cart' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

}

if (isset($_POST['bill'])) {

// Thêm bills
    $date = date('Y-m-d h:i:s', time());
    $new = new handler_database();
    $result = $new->insert_DB('bills', array(
        'user_id' => $_SESSION['user_id'],
        'money' => $_POST['sum_price'],
        'created_at' => "$date"
    ));

    if ($result == true) {


        // Lấy ra id của bills vừa mới thêm
        $get = new handler_database();


        $sql = 'select * from bills where created_at = "' . (string)$date . '" and money = ' . $_POST['sum_price'] . ' and user_id = ' . $_SESSION['user_id'] . ' ';
        $r = $get->get_list($sql);
        if ($r) {

            foreach ($r as $v)
                $bill_id = $v['bill_id'];

            foreach ($_POST['cart'] as $value) {

//        Thêm sản phẩm vào bills
                $new1 = new handler_database();

                $result1 = $new1->insert_DB('bills_products', array(
                    'product_id' => (int)$value['id'],
                    'user_id' => (int)$_SESSION['user_id'],
                    'bill_id' => (int)$bill_id,
                    'bill_product_amount' => (int)$value['amount']
                ));

                if ($result1 == false) die('Có lỗi');

            }

//        Xóa thông tin trong giỏ hàng
            $new = new handler_database();

            $result = $new->delete_DB('carts', 'user_id = ' . $_SESSION['user_id']);

            if ($result == false) die('Có lỗi!');

            echo "<script>alert('Thanh toán thành công!');window.location.replace('index.php');</script>";

        } else die('Có lỗi!');


    } else die('Có lỗi!');


}

// chỉnh sửa số lượng đơn hàng
if (isset($_COOKIE['onchange_amount_id'])) {

    // trước khi update thì lấy ra dữ liệu đơn hàng cũ
    $new = new handler_database();
    $s = $new->get_list('select * from carts where user_id = ' . $_SESSION['user_id'] . ' and product_id = ' . $_COOKIE['onchange_amount_id']);
    if ($s) {
        foreach ($s as $value) {
            // số sản phẩm cũ trong giỏ hàng
            $cart_amount = $value['cart_amount'];
        }
    } else die('Có lỗi');


    // up date du lieu moi vao gio hang
    $new = new handler_database();

    $result = $new->update_DB('carts', array(
        'cart_amount' => $_COOKIE['onchange_amount'] // số sản phẩm mới trong giỏ hàng
    ), 'user_id = ' . $_SESSION['user_id'] . ' and product_id = ' . $_COOKIE['onchange_amount_id']);

    if ($result == true) {

        // nếu thành công thì update lại số lượng sản phẩm trong products
        $new = new handler_database();
        $r = $new->get_list('select * from products where product_id = ' . $_COOKIE['onchange_amount_id']);
        if ($r) {

            foreach ($r as $v)
                $current_amount = $v['product_amount']; // số lượng hiện tại của sản phẩm

            // cập nhật lại số lượng sản phẩm trong giỏ hàng
            $new_amount = $current_amount - ($_COOKIE['onchange_amount'] - $cart_amount);

            // update lại số lượng sản phẩm
            $update = new handler_database();
            $result = $update->update_DB('products', array(
                'product_amount' => $new_amount
            ), 'product_id = ' . $_COOKIE['onchange_amount_id']);

            if ($result == true) {

//        xóa cookie
                echo "<script>document.cookie = 'onchange_amount_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
                echo "<script>document.cookie = 'onchange_amount' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

                echo "<script>window.location.replace('carts.php')</script>";

            }

        }


    } else die('Có lỗi!');
//    xóa cookie
    echo "<script>document.cookie = 'onchange_amount_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
    echo "<script>document.cookie = 'onchange_amount' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";


}

?>