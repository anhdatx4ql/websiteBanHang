<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');


function start()
{

    loaf_form();

    view_insert_product();

    handler_update_product();

    handler_delete_product();

    handler_categories();

    update_ctgr();

    delete_category();

}

start();

// Xử lý update product
function get_info_product($id)
{
    $product = new handler_database();
    $result = $product->get_list('select * from products where product_id = ' . $id);
    return $result;
}

function load_info_form($row_info_product)
{
    foreach ($row_info_product as $info) {
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_code\"]')
                    .value = '" . $info['product_code'] . "'</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_name\"]')
                    .value = '" . $info['product_name'] . "'</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_trademark\"]')
                    .value = '" . $info['product_trademark'] . "'</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>select[name=\"category_id\"]')
                    .value = '" . $info['category_id'] . "'</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_amount\"]')
                    .value = " . $info['product_amount'] . "</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_price\"]')
                       .value = " . $info['product_price'] . "</script>";
        echo "<script>document.querySelector('.update_product>form>div:not(:last-child)>input[name=\"product_cost_price\"]')
                    .value = " . $info['product_cost_price'] . "</script>";
        echo "<script>document.querySelector('.update_product>form>div>textarea').value = '"
            . $info['product_detail'] . "'</script>";
    }
}

// xử lý load dữ liệu để update
function loaf_form()
{
    if (isset($_COOKIE['product_id']) && isset($_COOKIE['update_product'])) {

        echo "<script>document.querySelector('.parent_update_product').style.display = \"block\";</script>";
        echo "<script>document.querySelector('.update_product>form>div:last-child>input[name=\"insert_product\"]').style.display = \"none\";</script>";
        echo "<script>document.querySelector('.update_product>form>div:last-child>input[name=\"update_product\"]').style.display = \"block\";</script>";
        echo "<script>document.querySelector('.update_product>div>h3').innerHTML = \"Sửa sản phẩm\";</script>";
        $row_info_product = get_info_product($_COOKIE['product_id']);

        //đưa dữ liệu lên form
        if ($row_info_product) {
            load_info_form($row_info_product);

        }

        $_SESSION['product_id'] = $_COOKIE['product_id'];

        echo "<script>document.cookie = 'product_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
        echo "<script>document.cookie = 'update_product' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }
}


// Xử lý insert product
function view_insert_product()
{

    if (isset($_COOKIE['insert_product'])) {

        echo "<script>document.querySelector('.parent_update_product').style.display = \"block\";</script>";
        echo "<script>document.querySelector('.update_product>form>div:last-child>input[name=\"insert_product\"]').style.display = \"block\";</script>";
        echo "<script>document.querySelector('.update_product>form>div:last-child>input[name=\"update_product\"]').style.display = \"none\";</script>";
        echo "<script>document.querySelector('.update_product>form>div:last-child>input[name=\"delete_product\"]').style.display = \"none\";</script>";
        echo "<script>document.querySelector('.update_product>div>h3').innerHTML = \"Thêm sản phẩm\";</script>";
        $_SESSION['insert_product'] = $_COOKIE['insert_product'];
        echo "<script>document.cookie = 'insert_product' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }

    if (isset($_POST['insert_product'])) {

        if (empty($_POST['product_code']) || empty($_POST['product_name']) || empty($_POST['product_trademark'])
            || empty($_POST['product_amount']) || empty($_POST['product_price']) || empty($_POST['product_cost_price'])
            || empty($_POST['product_detail']) || empty($_FILES['product_image']['name']))
            echo "<script>alert('Không được để trống trường nào')</script>";
        else {

            $file = explode("/", $_FILES['product_image']['type']);

            if ($file[0] == 'image') {


                $code = str_replace('"', '\\"', trim($_POST['product_code']));

                // thêm dấu \ trước kí tự ',"
                $name = str_replace('"', '\\"', trim($_POST['product_name']));
                $name = str_replace("'", "\\'", trim($_POST['product_name']));

                $category_id = (int)$_POST['category_id'];
                $amount = (int)$_POST['product_amount'];
                $price = (int)$_POST['product_price'];
                $cost_price = (int)$_POST['product_cost_price'];

                // thêm dấu \ trước kí tự ',"
                $trademark = str_replace('"', '\\"', trim($_POST['product_trademark']));
                $trademark = str_replace("'", "\\'", trim($_POST['product_trademark']));

                // thêm dấu \ trước kí tự ',"
                $detail = str_replace('"', '\\"', trim($_POST['product_detail']));
                $detail = str_replace("'", "\\'", trim($_POST['product_detail']));

                // Xử lý lưu file ảnh vào thư mục
                $time = time();

                //Thư mục bạn sẽ lưu file upload
                $target_dir = "../image/products/";
                //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                $img_name = $time . '_' . basename($_FILES["product_image"]["name"]);
                $target_file = $target_dir . $img_name;

                $date = date_create('');

                // kiểm tra nếu tên sản phẩm và nhóm hàng trùng thì không cho thêm
                $re1 = new handler_database();

                $re = $re1->get_list('select * from products');
                $check = true;
                if ($re){

                    foreach ($re as $v){

                        if ( strtolower($v['product_name']) == strtolower($name) && $v['category_id'] == $category_id)
                            $check = false;

                    }

                }

                if ($check == true){

                    $product_update = new handler_database();
                    $result = $product_update->insert_DB("products", array(
                        'product_name' => "$name",
                        'product_trademark' => "$trademark",
                        'product_cost_price' => $cost_price,
                        'product_price' => $price,
                        'product_amount' => $amount,
                        'product_detail' => "$detail",
                        'category_id' => $category_id,
                        'product_code' => "$code",
                        'product_image' => "$img_name",
                        'updated_at' => (string)date_format($date, 'Y-m-d H:i:s'),
                        'created_at' => (string)date_format($date, 'Y-m-d H:i:s')
                    ));


                    if ($result == true) {

                        // lưu vào thư mục
                        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

                        echo "<script>alert('Thêm sản phẩm thành công!')</script>";

                        // load lại trang
                        echo "<script>window.location.replace('products.php');</script>";

                    } else echo "<script>alert('Có lỗi')</script>";

                }else echo "<script>alert('Sản phẩm đã tồn tại!')</script>";



            } else
                echo "<script>alert('File upload phải là ảnh!')</script>";


        }

    }

}


// hanlder update product ( đã xong update )
function handler_update_product()
{

    if (isset($_POST['update_product'])) {

        // sửa thông tin sản phẩm
        $product_info = new handler_database();

        $sql = 'select * from products inner join categories on products.category_id = categories.catedory_id where product_id = ' . $_SESSION['product_id'];

        // Thông tin của sản phẩm đang được thao tác update
        $product_info = $product_info->get_list($sql);

        foreach ($product_info as $info) {

            $img = $info['product_image'];
            $code = $info['product_code'];
            $name = $info['product_name'];
            $category_id = $info['category_id'];
            $trademark = $info['product_trademark'];
            $amount = $info['product_amount'];
            $price = $info['product_price'];
            $cost_price = $info['product_cost_price'];
            $detail = $info['product_detail'];

        }


        // so sánh giá trị mới sau khi nhập vào có khác giá trị cũ hay không. Nếu khác thì update

        if ($_FILES['product_image']['name'] == "") {

            if (trim($_POST['product_code']) != $code || trim($_POST['product_name']) != $name
                || trim($_POST['category_id']) != $category_id || trim($_POST['product_trademark']) != $trademark
                || trim($_POST['product_amount']) != $amount || trim($_POST['product_price']) != $price ||
                trim($_POST['product_cost_price']) != $cost_price || trim($_POST['product_detail']) != $detail) {

                // thêm dấu \ trước kí tự ',"
                $code = str_replace('"', '\\"', trim($_POST['product_code']));
                $code = str_replace("'", "\\'", trim($_POST['product_code']));

                // thêm dấu \ trước kí tự ',"
                $name = str_replace('"', '\\"', trim($_POST['product_name']));
                $name = str_replace("'", "\\'", trim($_POST['product_name']));

                $category_id = (int)$_POST['category_id'];
                $amount = (int)$_POST['product_amount'];
                $price = (int)$_POST['product_price'];
                $cost_price = (int)$_POST['product_cost_price'];

                // thêm dấu \ trước kí tự ',"
                $trademark = str_replace('"', '\\"', trim($_POST['product_trademark']));
                $trademark = str_replace("'", "\\'", trim($_POST['product_trademark']));

                // thêm dấu \ trước kí tự ',"
                $detail = str_replace('"', '\\"', trim($_POST['product_detail']));
                $detail = str_replace("'", "\\'", trim($_POST['product_detail']));

                $date = date_create('');

                $product_update = new handler_database();
                $result = $product_update->update_DB("products", array(
                    'product_name' => "$name",
                    'product_trademark' => "$trademark",
                    'product_cost_price' => $cost_price,
                    'product_price' => $price,
                    'product_amount' => $amount,
                    'product_detail' => "$detail",
                    'category_id' => "$category_id",
                    'product_code' => "$code",
                    'updated_at' => (string)date_format($date, 'Y-m-d H:i:s')
                ), 'product_id = ' . $_SESSION['product_id']);

                if ($result == true) {

                    echo "<script>alert('Cập nhật sản phẩm thành công')</script>";

                    echo "<script>window.location.replace('products.php');</script>";

                } else echo "<script>alert('Cập nhật sản phẩm thất bại')</script>";

            }

        } else {


            if ($_FILES['product_image']['name'] != $img || trim($_POST['product_code']) != $code || trim($_POST['product_name']) != $name
                || trim($_POST['category_id']) != $category_id || trim($_POST['product_trademark']) != $trademark
                || trim($_POST['product_amount']) != $amount || trim($_POST['product_price']) != $price ||
                trim($_POST['product_cost_price']) != $cost_price || trim($_POST['product_detail']) != $detail) {

                $file = explode("/", $_FILES['product_image']['type']);

                if ($file[0] == 'image') {


                    // thêm dấu \ trước kí tự ',"
                    $code = str_replace('"', '\\"', trim($_POST['product_code']));
                    $code = str_replace("'", "\\'", trim($_POST['product_code']));

                    // thêm dấu \ trước kí tự ',"
                    $name = str_replace('"', '\\"', trim($_POST['product_name']));
                    $name = str_replace("'", "\\'", trim($_POST['product_name']));

                    $category_id = (int)$_POST['category_id'];
                    $amount = (int)$_POST['product_amount'];
                    $price = (int)$_POST['product_price'];
                    $cost_price = (int)$_POST['product_cost_price'];

                    // thêm dấu \ trước kí tự ',"
                    $trademark = str_replace('"', '\\"', trim($_POST['product_trademark']));
                    $trademark = str_replace("'", "\\'", trim($_POST['product_trademark']));

                    // thêm dấu \ trước kí tự ',"
                    $detail = str_replace('"', '\\"', trim($_POST['product_detail']));
                    $detail = str_replace("'", "\\'", trim($_POST['product_detail']));

                    // Xử lý lưu file ảnh vào thư mục
                    $time = time();

                    //Thư mục bạn sẽ lưu file upload
                    $target_dir = "../image/products/";
                    //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                    $img_name = $time . '_' . basename($_FILES["product_image"]["name"]);
                    $target_file = $target_dir . $img_name;

                    $date = date_create('');

                    $product_update = new handler_database();
                    $result = $product_update->update_DB("products", array(
                        'product_name' => "$name",
                        'product_trademark' => "$trademark",
                        'product_cost_price' => $cost_price,
                        'product_price' => $price,
                        'product_amount' => $amount,
                        'product_detail' => "$detail",
                        'category_id' => $category_id,
                        'product_code' => "$code",
                        'product_image' => "$img_name",
                        'updated_at' => (string)date_format($date, 'Y-m-d H:i:s')
                    ), 'product_id = ' . $_SESSION['product_id']);

                    if ($result == true) {

                        // lưu vào thư mục
                        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

                        echo "<script>alert('Cập nhật sản phẩm thành công!')</script>";

                        // load lại trang
                        echo "<script>window.location.replace('products.php');</script>";

                    } else echo "<script>alert('Có lỗi')</script>";

                } else
                    echo "<script>alert('file update phải là ảnh!')</script>";

            }

        }


    }


}

// đã làm xong xóa sản phẩm
function handler_delete_product()
{

    if (isset($_POST['delete_product']) && $_COOKIE['delete_product'] == 'true') {

        // kiểm tra sản phẩm có trong carts và bills_products hay không. Nếu không có thì mới được xóa

        $new = new handler_database();

        $result = $new->get_list('select * from carts where product_id = '.$_POST['product_id']);

        if ($result ){

            echo "<script>alert('Không thể xóa sản phẩm này!')</script>";

        }else{

            $new = new handler_database();

            $result2 = $new->get_list('select * from bills_products where product_id = '.$_POST['product_id']);

            if($result2){
                echo "<script>alert('Không thể xóa sản phẩm này!')</script>";
            }else{

               $dlt = new handler_database();
               $re = $dlt->delete_DB('products','product_id = '.$_POST['product_id']);

               if ($re == true){

                   echo "<script>alert('Xóa sản phẩm thành công!'); 
                    location.replace('products.php')</script>";
               }else die('Có lỗi!');

            }


        }

//        echo $_POST['product_id'];
//
//        $delete_product = new handler_database();
//        $result = $delete_product->delete_DB('products', 'product_id = ' . $_SESSION['product_id']);
//
//        echo $result;
//
//        // xóa cookie kiểm tra
//        echo "<script>document.cookie = 'delete_product' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
//        echo "<script>window.location.replace('products.php');</script>";
    }

}

function handler_categories()
{

    // Theem
    if (isset($_POST['insert_category'])) {

        if (empty($_POST['category_name'])) {

            echo "<script>alert('Không được bỏ trống')</script>";

        } else {

            $_POST['category_name'] = trim($_POST['category_name']);

            // lấy ra tên danh mục cũ
            $new = new handler_database();

            $result = $new->get_list('select * from categories');

            $check = true;

            if ($result) {

                foreach ($result as $v) {

                    if (strtolower($v['category_name']) == strtolower($_POST['category_name'])) {
                        $check = false;
                    }

                }

                if ($check == true) {

                    $new = new handler_database();

                    $re = $new->insert_DB('categories', array(
                        'category_name' => $_POST['category_name']
                    ));

                    if ($re == true) {
                        echo "<script>alert('Thêm thành công!')</script>";
                        echo "<script>window.location.replace('products.php')</script>";
                    } else
                        die('Có lỗi!');

                }else echo "<script>alert('Danh mục đã tồn tại!')</script>";

            } else die('Có lỗi!');

        }

    }


    // sua
    if (isset($_COOKIE['id_category_update'])) {

        echo "<script>document.querySelector('.parent_handler_categories').style.display = 'block'</script>";
        echo "<script>document.querySelector('.child_handler_categories>form>div:last-child>input:first-child').style.display = 'none'</script>";
        echo "<script> document.querySelectorAll('.child_handler_categories>form>div:last-child>input:not(:first-child)').forEach(v=>{
            v.style.display = 'block';
        })</script>";

        // load du lieu len
        $new = new handler_database();

        $result = $new->get_list('select * from categories where catedory_id = ' . $_COOKIE['id_category_update']);

        if ($result) {

            foreach ($result as $item) {

                $name = $item['category_name'];

            }

            echo "<script>document.querySelector('.child_handler_categories>form>div>input[type=\"text\"]').value = '" . ucwords($name) . "'</script>";
            echo "<script>document.querySelector('.child_handler_categories>form>input').value = " . $_COOKIE['id_category_update'] . "</script>";


        } else die('Có lỗi!');


        // xoa cookie
        echo "<script>document.cookie = 'id_category_update' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }


}

function update_ctgr()
{

    if (isset($_POST['update1_category'])) {

        if (empty(trim($_POST['category_name']))) {
            echo "<script>alert('Không được bỏ trống')</script>";
        } else {

            // lấy ra tên cũ
            $new = new handler_database();

            $result = $new->get_list('select * from categories where catedory_id = ' . $_POST['id_category']);

            if ($result) {

                foreach ($result as $v) {

                    $name = $v['category_name'];

                }

                if (strtolower($name) == strtolower(trim($_POST['category_name']))) {

                    echo "<script>alert('Tên danh mục đã tồn tại!')</script>";

                } else {

                    $new = new handler_database();

                    $re = $new->update_DB('categories', array(
                        'category_name' => strtolower(trim($_POST['category_name']))
                    ), 'catedory_id = ' . $_POST['id_category']);

                    if ($re == true) {

                        echo "<script>alert('Sửa danh mục thành công!'); window.location.replace('products.php')</script>";

                    } else die('Có lỗi!');

                }

            } else die('Có lỗi!');

        }

    }

}

function delete_category()
{

    if (isset($_COOKIE['delete_category_id'])) {

        // kiem tra



        // lay ra cac id san pham nằm trong danh mục
        $new = new handler_database();
        $result = $new->get_list('select * from products where category_id = ' . $_COOKIE['delete_category_id']);

        if ($result) {

            echo "<script>alert('Không thể xóa danh mục!')</script>";
        }else{
            $new = new handler_database();

            $re = $new->delete_DB('categories', 'catedory_id = ' . (int)$_COOKIE['delete_category_id']);

            if ($re == true) {

                echo "<script>alert('Xóa danh mục thành công!')</script>";
                echo "<script>document.cookie = 'delete_category_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
                echo "<script>window.location.replace('products.php')</script>";

            } else die('Có lỗi!');
        }

        echo "<script>document.cookie = 'delete_category_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";


    }

    echo "<script>document.cookie = 'delete_category_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";


}


?>


