<script>

    function start() {

        handler_editor();

        show_hidden();

        handler_delete_new();

    }


    start();

    // xử lý nhúng trình soạn thảo
    function handler_editor() {
        ClassicEditor
            .create(document.querySelector('#new_description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    }


    // xử lý show/hidden form handler news
    function show_hidden() {

        //hidden
        document.querySelector('.form_handler_news>div>div:first-child>i').onclick = function () {

            document.querySelector('.form_handler_news').style.display = "none";
            window.location.reload();

        }
        //    show insert
        document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(2)').onclick = function () {

            document.querySelector('.form_handler_news').style.display = "block";
            document.querySelector('.form_handler_news>div>form>div:last-child>input[name="detele_new"]').style.display = "none";
            document.querySelector('.form_handler_news>div>form>div:last-child>input[name="update_new"]').style.display = "none";

            // trả tất cả dữ liệu trong form về rổng

            // hiển thị dữ liệu lên form
            document.querySelector('.form_handler_news>div>form>div:not(:last-child)>input[name=\"new_title\"]').value = '';
            document.querySelector('.form_handler_news>div>form>div:not(:last-child)>input[name=\"new_short_description\"]').value = '';
            document.querySelector('.form_handler_news>div>form>div:not(:last-child)>textarea').value = '';



        }

        //    show handler update
        document.querySelectorAll('.main__products--right__center>table>tbody>tr').forEach(v => {

            v.onclick = function () {

                document.cookie = escape('new_id_handler') + '=' + escape(v.querySelector('.new_id').innerHTML);

                window.location.replace('news.php')
            }

        });


    }

    // xử lý trước khi xóa tin tức
    function handler_delete_new(){

        document.querySelector('.form_handler_news>div>form>div:last-child>input[name="detele_new"]').onclick = function(e){

            e.preventDefault();

            let check = confirm("Bạn có thật sự muốn xóa?");

            if ( check == true){
                document.cookie = escape('delete_new') + '=' + escape('true');
                window.location.replace('news.php');
            }

        }

    }

</script>


<?php

function start()
{

    // Thêm bản tin
    handler_insert_new();

    // xử lý sửa bản tin
    handler_update_new();

    // Cập nhật bản tin
    update_news();

    // xóa tin tức
    delete_new();

}

start();

// xử lý thêm bản tin => xong
function handler_insert_new()
{

    if (isset($_POST['insert_new'])) {

        // Xử lý thêm \' || \" để dữ liệu đưa vào database không bị lỗi
        if (empty($_POST['new_description']) || empty($_FILES['new_image']['name'])
            || empty($_POST['new_title']) || empty($_POST['new_short_description'])) {

            echo "<script>alert('Không được bỏ trống trường nào!')</script>";

        } else {

            $file = explode("/", $_FILES['new_image']['type']);

            if ( $file[0] == 'image' ){


                // lấy ra dữ liệu
                $new_title = str_replace('"', '\\"', trim($_POST['new_title']));
                $new_title = str_replace("'", "\\'", $new_title);

                // lấy ra dữ liệu
                $new_short_description = str_replace('"', '\\"', trim($_POST['new_short_description']));
                $new_short_description = str_replace("'", "\\'", $new_short_description);

                // lấy ra dữ liệu
                $new_description = str_replace('"', '\\"', trim($_POST['new_description']));
                $new_description = str_replace("'", "\\'", $new_description);


                // Xử lý lưu file ảnh vào thư mục
                $time = time();

                //Thư mục bạn sẽ lưu file upload
                $target_dir = "../image/news/";
                //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                $img_name = $time . '_' . basename($_FILES["new_image"]["name"]);
                $target_file = $target_dir . $img_name;

                // lấy thời gian hiện tại để lưu vào database
                $date = date_create('');

                // tin tức mới vào
                $news = new handler_database();
                $result = $news->insert_DB('news', array(
                    'new_title' => "$new_title",
                    'new_image' => "$img_name",
                    'new_description' => "$new_description",
                    'new_short_description' => "$new_short_description",
                    'created_at' => date_format($date, 'Y-m-d'),
                    'updated_at' => date_format($date, 'Y-m-d')
                ));

                if ($result == true) {
                    // nếu thêm tin tức thành công

                    // lưu ảnh vào thư mục
                    move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);

                    echo "<script>alert('Thêm sản phẩm thành công!')</script>";

                    // load lại trang
                    echo "<script>window.location.replace('news.php');</script>";

                } else die('Có lỗi!');

            }else echo "<script>alert('File upload phải là ảnh!')</script>";


        }

    }

}


// xử lý update bản tin=> xong
function handler_update_new()
{

    if (isset($_COOKIE['new_id_handler'])) {

        echo "<script>
            document.querySelector('.form_handler_news>div>form>div:last-child>input[name=\"detele_new\"]').style.display=\"inline-block\";
            document.querySelector('.form_handler_news>div>form>div:last-child>input[name=\"update_new\"]').style.display=\"inline-block\";
            document.querySelector('.form_handler_news>div>form>div:last-child>input[name=\"insert_new\"]').style.display=\"none\";
            </script>";

        // hiển thị form update sản phẩm
        echo "<script>document.querySelector('.form_handler_news').style.display=\"block\";</script>";

        // đã lấy được id, lấy dữ liệu cũ ra
        $select = new handler_database();
        $row = $select->get_list('select * from news where new_id = ' . $_COOKIE['new_id_handler']);
        if ($row) {
            foreach ($row as $value) {
                $new_title = $value['new_title'];
                $new_description = $value['new_description'];
                $new_short_description = $value['new_short_description'];
                $new_image = $value['new_image'];
            }


            // lấy ra dữ liệu
            $new_title = str_replace('"', '\\"', trim($new_title));
            $new_title = str_replace("'", "\\'", $new_title);

            // lấy ra dữ liệu
            $new_description = str_replace('"', '\\"', trim($new_description));
            $new_description = str_replace("'", "\\'", $new_description);

            // lấy ra dữ liệu
            $new_short_description = str_replace('"', '\\"', trim($new_short_description));
            $new_short_description = str_replace("'", "\\'", $new_short_description);

            // hiển thị dữ liệu lên form
            echo "<script>document.querySelector('.form_handler_news>div>form>div:not(:last-child)>input[name=\"new_title\"]').value = '" . $new_title . "';</script>";
            echo "<script>document.querySelector('.form_handler_news>div>form>div:not(:last-child)>input[name=\"new_short_description\"]').value = '" . $new_short_description . "';</script>";

            $_SESSION['new_id_handler'] = $_COOKIE['new_id_handler'];
            $_SESSION['new_image'] = $new_image;

        } else die('Có lỗi');

        // xóa cookie
        echo "<script>document.cookie = 'new_id_handler' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }

}


//  update tin tức => xong
function update_news(){

    if ( isset($_POST['update_new']) ){

        if ( empty($_POST['new_title']) || empty($_POST['new_short_description'])
            || empty($_POST['new_description']) )
            echo "<script>alert('Không được bỏ trống dữ liệu!')</script>";
        else{


            // lấy ra dữ liệu
            $title = str_replace('"', '\\"', trim($_POST['new_title']));
            $title = str_replace("'", "\\'", $title);

            // lấy ra dữ liệu
            $short_description = str_replace('"', '\\"', trim($_POST['new_short_description']));
            $short_description = str_replace("'", "\\'", $short_description);

            // lấy ra dữ liệu
            $description = str_replace('"', '\\"', trim($_POST['new_description']));
            $description = str_replace("'", "\\'", $description);

            // Nếu update có ảnh
            if ( !empty($_FILES['new_image']['name'])){

                $file = explode("/", $_FILES['new_image']['type']);

                if ( $file[0] == 'image' ){


                    // Xử lý lưu file ảnh vào thư mục
                    $time = time();

                    //Thư mục bạn sẽ lưu file upload
                    $target_dir = "../image/news/";
                    //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
                    $img_name = $time . '_' . basename($_FILES["new_image"]["name"]);
                    $target_file = $target_dir . $img_name;

                    // lấy thời gian hiện tại để lưu vào database
                    $date = date_create('');

                    // tin tức mới vào
                    $news = new handler_database();
                    $result = $news->update_DB('news',array(
                        'new_title' => "$title",
                        'new_short_description' => "$short_description",
                        'new_description' => "$description",
                        'updated_at' =>  date_format($date, 'Y-m-d'),
                        'new_image' => "$img_name"
                    ),'new_id = '.$_SESSION['new_id_handler']);

                    // kiểm tra đã update chưa
                    if ($result == true){

                        // lưu ảnh vào thư mục
                        move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);

                        echo "<script>alert('update tin tức thành công')</script>";
                        echo "<script>window.location.replace('news.php')</script>";
                    }else die('Có lỗi');

                }else echo "<script>alert('File upload phải là ảnh!')</script>";


            }else{

                // lấy thời gian hiện tại để lưu vào database
                $date = date_create('');

                // tin tức mới vào
                $news = new handler_database();
                $result = $news->update_DB('news',array(
                    'new_title' => "$title",
                    'new_short_description' => "$short_description",
                    'new_description' => "$description",
                    'updated_at' =>  date_format($date, 'Y-m-d'),
                    'new_image' => $_SESSION['new_image']
                ),'new_id = '.$_SESSION['new_id_handler']);
                unset($_SESSION['new_image']) ;

                // kiểm tra đã update chưa
                if ($result == true){

                    echo "<script>alert('update tin tức thành công')</script>";
                    echo "<script>window.location.replace('news.php')</script>";

                }else die('Có lỗi');

            }

        }

    }

}

// Xóa tin tức -> xong
function delete_new(){

    if ( isset($_COOKIE['delete_new']) ){

        $dlt = new handler_database();

        $result = $dlt->delete_DB('news','new_id = '.$_SESSION['new_id_handler']);

        if ( $result == true ){

            echo "<script>alert('Xóa tin tức thành công!')</script>";
            echo "<script>document.cookie = 'delete_new' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";
            echo "<script>window.location.replace('news.php')</script>";

        }else die('Có lỗi');

        echo "<script>document.cookie = 'delete_new' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

    }

}

