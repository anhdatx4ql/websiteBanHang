<?php

date_default_timezone_set("Asia/Ho_Chi_Minh");

class handler_database{

    // biến lưu trữ kết nối
   private $__conn;


    //kết nối dữ liệu
    public function connect_DB(){

        // kiểm tra nếu chưa kết nối
        if(!$this->__conn){

            //kết nối
            $this->__conn = mysqli_connect("localhost","root","","datpham_shop");

            // xử lý font chữ
            mysqli_query($this->__conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', 
            character_set_database = 'utf8', character_set_server = 'utf8'");
        }
    }

    //ngắt kết nối
    public function dis_connect(){

        // kiểm tra nếu đang kết nối thì ngắt
        if($this->__conn) mysqli_close($this->__conn);

    }

    // hàm lấy danh sách dữ liệu
    public function get_list($sql){

        // kết nối
        $this->connect_DB();

        $result = mysqli_query($this->__conn,$sql);

        if(!$result) die('gặp lỗi hệ thống');

        if( $result->num_rows >0 ){
            $return = array();

            // lặp để đưa kết quả vào mảng vừa tạo
            while($row = $result->fetch_assoc() ){
                $return[] = $row;
            }

            // xóa kết quả khỏi bộ nhớ
            mysqli_free_result($result);

            // Đóng kết nối
            $this->dis_connect();

            return $return;

        }

    }

    // hàm insert
    public function insert_DB($table,$data){

        // ket noi du lieu
        $this->connect_DB();

        // vì $data đưa vào là mảng 2 chiều => tạo 2 biến để lưu lại các giá trị của $data
        $name_list = '';
        $value_list = '';

        foreach ($data as $key => $value) {
            $name_list .=",$key";
            if(is_string($value))
                $value_list .= ",'".$value."'";
            else $value_list .= ",".$value."";
        }
        $sql = 'insert into '.$table. ' ('.trim($name_list, ',').') values('.trim($value_list, ',').')';

        $result = ( mysqli_query($this->__conn,$sql) ) ? true : false;
        $this->dis_connect();

        return $result;
    }

    public function update_DB($table,$data,$where){

        // kết nối
        $this->connect_DB();

        $sql = '';

        //lặp qua để lấy dữ liệu từ data
        foreach ($data as $key => $value) {
            $sql .= "$key = '".$value."',";
        }

        $sql = 'update '.$table.' set '.trim($sql,',').' where '.$where;

        $result = ( mysqli_query($this->__conn,$sql) ) ? true  : false;

        $this->dis_connect();

        return $result;

    }

    public function delete_DB($table,$where){

        // kết nối
        $this->connect_DB();

        $sql= 'delete from '.$table.' where '.$where;

        $result = ( mysqli_query($this->__conn, $sql) ) ? true : false;

        $this->dis_connect();

        return $result;

    }

}

//$test = new handler_database();
//
//$value =  $test ->get_list("select * from categories");
//
//    foreach($value as $v) echo $v['id'];




// thêm thử dữ liệu vào products
//$result = $test->insert_DB("products",array(
//    'image' => "1",
//    'name' => "1",
//    "code" => "1",
//    "price" => 1,
//    "made" => "1",
//    "created_at" => "2021-08-20",
//    "updated_at" => "2021-08-20",
//    "category_id" => 2,
//    "amount" => 1
//));

//var_dump($result);

// test thử update với bảng products
//$result = $test->update_DB("products",array(
//    'product_name' => "quả mới"
//),'product_id = 2');

//var_dump($result);

// test thử xóa sản phẩm có id = 1 trong products
//$test = new handler_database();
//$result = $test->delete_DB('products','product_id =3');
//
//var_dump($result);



?>
