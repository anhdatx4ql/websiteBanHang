<script>

    // xử lý click danh mục
    document.querySelectorAll('.main__products--category .main__products--category__content>ul>li').forEach(v => {

        v.querySelector('a').onclick = function (e) {

            e.preventDefault();

            document.cookie = escape('selected_category_id') + '=' + escape(this.getAttribute('id'));

            window.location.replace('products.php');

        }

    });

    function order_product_shop(v) {

        document.cookie = escape('order_price_product') + '=' + escape(v.value);

        window.location.reload();

    }

</script>

<?php

if (isset( $_SESSION['selected_category_id'])){

    echo "<script>document.querySelectorAll('.main__products--category > .main__products--category__content ul>li').forEach(v=>{
            v.querySelector('a').classList.remove('selected_category_name');   
    })
    document.querySelectorAll('.main__products--category > .main__products--category__content ul>li').forEach(v=>{
        if ( parseInt(".$_SESSION['selected_category_id'].") == parseInt(v.querySelector('a').getAttribute('id'))){
                        v.querySelector('a').classList.add('selected_category_name');   
        }
    })
    </script>";
    unset($_SESSION['selected_category_id']);


}

if ( isset($_POST['category_id'])){

    echo "<script>document.querySelectorAll('.main__products--category > .main__products--category__content ul>li').forEach(v=>{
            v.querySelector('a').classList.remove('selected_category_name');   
    })
    document.querySelectorAll('.main__products--category > .main__products--category__content ul>li').forEach(v=>{
        if ( parseInt(".$_POST['category_id'].") == parseInt(v.querySelector('a').getAttribute('id'))){
                        v.querySelector('a').classList.add('selected_category_name');   
        }
    })

    </script>";
    unset($_SESSION['category_id']);

}


// xử lý tìm kiếm theo giá tiền
if (isset($_COOKIE['order_price_product'])) {

    echo "<script>
            document.querySelector('.main__products--center__header>div>select').value = '" . $_COOKIE['order_price_product'] . "';
            //            xóa cookie đi
             document.cookie = 'order_price_product' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
            </script>";

}

// xử lý tìm kiếm theo danh mục
if (isset($_COOKIE['selected_category_id'])) {

    echo "<script> document.querySelectorAll('.main__products--category .main__products--category__content>ul>li').forEach(v=>{

            v.querySelector('a').classList.remove('selected_category_name');
            
            if (v.querySelector('a').getAttribute('id') == '" . $_COOKIE['selected_category_id'] . "')
                v.querySelector('a').classList.add('selected_category_name');
            
//            xóa cookie đi
            document.cookie = 'selected_category_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
        })</script>";

}




?>
