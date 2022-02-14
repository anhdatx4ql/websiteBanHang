<script>

    document.querySelectorAll('.main__products--right__center>table>tbody>tr').forEach(value => {

        value.onclick = function () {

            document.cookie = escape('handler_bill') + '=' + escape(value.getAttribute('id'));

            window.location.replace('bills.php');

        }

    });

    document.querySelector('.update__insert__bills>div>form>div:first-child>i').onclick = function () {

        document.querySelector('.update__insert__bills').style.display = "none";

    };

    document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(2)').onclick = function () {

        // thêm hóa đơn
        document.cookie = escape('insert_bill') + '=' + escape('true');
        window.location.replace('bills.php');


    }

    document.querySelector('.update__insert__bills>div>form>div:last-child>input[name="delete_bill"]').onclick = function (e) {

        e.preventDefault();

        let check = confirm('Bạn có muốn xóa');

        if (check == true) {
            let id = document.querySelector('.update__insert__bills>div>form input[name="bill_id"]').value;

            document.cookie = escape('check_delete_bill') + '=' + escape('true');
            document.cookie = escape('check_delete_bill_id') + '=' + escape(id);

            window.location.replace('bills.php');
        }

    }


    //    xử lý hiển thị form đơn hàng trong phần thêm đơn hàng
    let id_product = [];
    let dem=0;
    document.querySelectorAll('.insert_bills_user form .view_product>a').forEach(v => {

        v.onclick = function (e) {

            e.preventDefault();

            let id_product_new = v.querySelector('span:first-child').innerHTML;

            let ktra = true;

            if (id_product) {

                id_product.forEach(id => {

                    if (id == id_product_new)
                        ktra = false;

                })

            }

            if (ktra == true) {

                //    Hiển thị sản phẩm đã chọn xuống

                let div_detail_bill = document.createElement('div');

                let id_product = document.createElement('span');
                id_product.innerHTML = v.querySelector('.id_product').innerHTML;

                let name_product = document.createElement('span');
                name_product.innerHTML = v.querySelector('.name_product').innerHTML;

                let cost_price_product = document.createElement('span');
                cost_price_product.innerHTML = v.querySelector('.cost_price_product').innerHTML;

                let input_id_product = document.createElement('input');
                input_id_product.setAttribute('name', 'bill["'+dem+'"][id_product]');
                input_id_product.setAttribute('type', "text");
                input_id_product.setAttribute('readonly', "");
                input_id_product.setAttribute('value', id_product_new);

                let input_name_product = document.createElement('input');
                input_name_product.setAttribute('name', 'bill["'+dem+'"][name_product]');
                input_name_product.setAttribute('type', "text");
                input_name_product.setAttribute('readonly', "");
                input_name_product.setAttribute('value', v.querySelector('.name_product').innerHTML);

                let down_span_amount_product = document.createElement('span');
                down_span_amount_product.setAttribute('class','down_amount_product');
                down_span_amount_product.innerHTML = "<i class=\"fas fa-arrow-down\"></i>";

                // let span_amount_product = document.createElement('span');
                // span_amount_product.setAttribute('class','load_amount_product');
                // span_amount_product.innerHTML =  1;

                let input_amount_product = document.createElement('input');
                input_amount_product.setAttribute('name', 'bill[\"'+dem+'\"][amount_product]');
                input_amount_product.setAttribute('class', 'count_amount');
                input_amount_product.setAttribute('type', "number");
                input_amount_product.setAttribute('max', v.querySelector('.amount_product').innerHTML);
                input_amount_product.setAttribute('min', 0);
                input_amount_product.setAttribute('step', 1);
                input_amount_product.setAttribute('value', 1);
                input_amount_product.setAttribute('readonly', "");


                let up_span_amount_product = document.createElement('span');
                up_span_amount_product.setAttribute('class','up_amount_product');
                up_span_amount_product.innerHTML =  "<i class=\"fas fa-arrow-up\"></i>";



                let div_up_down = document.createElement('div');
                div_up_down.append(down_span_amount_product,input_amount_product,up_span_amount_product)


                let input_money_product = document.createElement('input');
                input_money_product.setAttribute('name', 'bill["'+dem+'"][money_product]');
                input_money_product.setAttribute('class', 'money_product');
                input_money_product.setAttribute('type', "text");
                input_money_product.setAttribute('readonly', "");
                input_money_product.setAttribute('value', cost_price_product.innerHTML);

                let input_sum_money_product = document.createElement('input');
                input_sum_money_product.setAttribute('name', 'bill["'+dem+'"][sum_money_product]');
                input_sum_money_product.setAttribute('class', 'sum_money_product');
                input_sum_money_product.setAttribute('type', "text");
                input_sum_money_product.setAttribute('readonly', "");
                input_sum_money_product.setAttribute('value', cost_price_product.innerHTML);

                div_detail_bill.append( input_id_product,input_name_product ,div_up_down,
                    input_money_product,input_sum_money_product);

                document.querySelector('.view_detail_product').append(div_detail_bill);

                // load lại tổng tiền hàng
                load_sum_amount_pay();

                dem++;
            }




            //    thay đổi giá trị của số lượng

            document.querySelectorAll('.down_amount_product').forEach(value=>{


                value.onclick = function(){

                    let current_value_product = parseInt(value.parentElement.querySelector('.count_amount').getAttribute('value'));

                    let min_amount_product = parseInt(value.parentElement.querySelector('.count_amount').getAttribute('min'));


                    if ( current_value_product > min_amount_product ){

                        current_value_product--;
                        value.parentElement.querySelector('.count_amount').setAttribute('value',current_value_product);

                        let amount = parseInt(value.parentElement.querySelector('.count_amount').getAttribute('value'));

                        let price = String(value.parentElement.parentElement.querySelector('.money_product').getAttribute('value'));

                        price = parseInt(price.split(',').join(''));


                        value.parentElement.parentElement.querySelector('.sum_money_product').setAttribute('value',amount*price);
                        load_sum_amount_pay();

                    }


                }

            });

            document.querySelectorAll('.up_amount_product').forEach(value=>{

                value.onclick = function(){

                    let current_value_product = parseInt(value.parentElement.querySelector('.count_amount').getAttribute('value'));

                    let max_amount_product = value.parentElement.querySelector('.count_amount').getAttribute('max');


                    if ( current_value_product < max_amount_product ){

                        current_value_product++;

                        value.parentElement.querySelector('.count_amount').setAttribute('value',current_value_product);

                        let amount = parseInt(value.parentElement.querySelector('.count_amount').getAttribute('value'));

                        let price = String(value.parentElement.parentElement.querySelector('.money_product').getAttribute('value'));

                        price = parseInt(price.split(',').join(''));

                        value.parentElement.parentElement.querySelector('.sum_money_product').setAttribute('value',amount*price);
                        load_sum_amount_pay();
                    }

                }

            });

        };

    });

    function load_sum_amount_pay(){

        let sum=0;
        let amount = 0;

        document.querySelectorAll('.view_detail_product div:not(first-child)>.sum_money_product').forEach(v=>{


            let price = String(v.getAttribute('value'));

            price = parseInt(price.split(',').join(''));

            sum = sum+price;


        });

        document.querySelector('.sum_pay_bill input[name="sum_price_bill"]').setAttribute('value',sum);


        document.querySelectorAll('.view_detail_product div:not(first-child)>.count_amount').forEach(v=>{


            let price = String(v.getAttribute('value'));

            price = parseInt(price.split(',').join(''));

            amount = amount+price;


        });

        document.querySelector('.sum_pay_bill input[name="sum_amount_bill"]').setAttribute('value',amount);

    }

    // click x để thoát khỏi thêm hóa đơn
    document.querySelector('.insert_bills_user form>div:first-child>i').onclick = function(){

        document.querySelector('.insert_bills_user').style.display="none";

    }

    // hiển thị form thêm hóa đơn
    document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(2)').onclick = function(){

        document.querySelector('.insert_bills_user').style.display="block";

    }

    document.querySelector('.update__insert__bills>div>form>div:first-child>i').onclick = function(){
        document.querySelector('.update__insert__bills').style.display = "none";
    }


</script>

<?php


// xử lý thêm đơn hàng
function handler_insert_bill(){
    if (isset($_COOKIE['insert_bill'])) {

        echo "<script>document.querySelector('.insert_bills').style.display = \"none\";</script>";

        // xóa cookie
        echo "<script>document.cookie = 'insert_bill' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }


    if ( isset($_POST['insert_bill_user'])){


      if( $_POST['sum_price_bill'] == 0 || $_POST['sum_price_bill'] == '') {
          echo "<script>alert('chưa chọn sản phẩm!')</script>";
      }else{

          $date = date('Y-m-d h:i:s', time());

          $insert_bill = new handler_database();

          $result = $insert_bill->insert_DB('bills',array(
            'user_id' => $_POST['name_user'],
              'money' => $_POST['sum_price_bill'],
              'created_at'=> $date
          ));

          if ( $result == false){

              die('Có lỗi xảy ra!');

          }

          // Thêm vào bills_product
          $new = new handler_database();
          $result = $new->get_list('select bill_id from bills where created_at = \''.$date.'\'');
          if ( $result){
              foreach ($result as $v){
                  $id_bill = $v['bill_id'];
              }
          }else die('Có lỗi xảy ra!');




          foreach ($_POST['bill'] as $v){
              $amount = (int)$v['amount_product'];

              // thêm sản phẩm và số lượng vào bills_products
              $insert_bill_product = new handler_database();
              if ( (int)$v['amount_product'] > 0)
                  $result = $insert_bill_product->insert_DB('bills_products',array(
                          'product_id' => $v['id_product'],
                      'user_id' => $_POST['name_user'],
                      'bill_id' => $id_bill,
                      'bill_product_amount' => $v['amount_product']
                  ));

              if ($result == false) die('Có lỗi xảy ra!');

              // lấy ra số lượng sản phẩm hiện tại
              $new = new handler_database();
              echo $v['id_product'];
              $row = $new->get_list('select product_amount from products where product_id = '.$v['id_product']);
              if ($row){
                  foreach ($row as $va){
                      $current_amount = (int)$va['product_amount'];
                  }

              }

              $new_amount_product = $current_amount - $amount;

              // sửa lại giá trị số lượng sản phẩm
              $update = new handler_database();
              $result = $update->update_DB('products',array(
                      'product_amount' => $new_amount_product
              ),'product_id = '.$v['id_product']);

              if ($result == false) die('Có lỗi');
              else echo "<script>alert('thanh cong!')</script>";

              echo "<script>window.location.replace('bills.php')</script>";

          }

      }

    }

}

handler_insert_bill();



// xóa đơn hàng
if (isset($_COOKIE['check_delete_bill']) && isset ($_COOKIE['check_delete_bill_id'])) {

    // trước tiên xóa dữ liệu ở bàng bills_products
    $delete_bill_product = new handler_database();
    $result = $delete_bill_product->delete_DB('bills_products','bill_id = ' . $_COOKIE['check_delete_bill_id']);

    if ( $result == false){
        die('Có lỗi xảy ra!');

    }

    // xóa dữ liệu trong bảng bills
    $delete_bill = new handler_database();
    $result = $delete_bill->delete_DB('bills', 'bill_id = ' . $_COOKIE['check_delete_bill_id']);

    if ($result == true) {

        echo "<script>alert('Xóa thành công');</script>";

        // xóa cookie
        echo "<script>document.cookie = 'check_delete_bill' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
        echo "<script>document.cookie = 'check_delete_bill_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

        echo "<script>window.location.replace('bills.php')</script>";

    } else die('Có lỗi xảy ra!');

    // xóa cookie
    echo "<script>document.cookie = 'check_delete_bill' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
    echo "<script>document.cookie = 'check_delete_bill_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

}





