<?php



if (isset ($_POST['submit_Contact']) ){

    if ( empty($_POST['name']) || empty($_POST['email']) || empty($_POST['title']) ){

        echo "<script>alert('Không được bỏ trống trường nào!')</script>";

    }else{

        GuiMail($_POST['email'],$_POST['name'],$_POST['title'],$_POST['content']);

    }

}


function GuiMail($email,$name,$title,$content){
    require "../PHPMailer-master/src/PHPMailer.php";
    require "../PHPMailer-master/src/SMTP.php";
    require '../PHPMailer-master/src/Exception.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug. khi chạy ngon thì chỉnh lại 0 nhé
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.mailtrap.io';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'cbfb45fdadc0f2'; // SMTP username
        $mail->Password = '279b27ccdb67bd';   // SMTP password
        $mail->SMTPSecure = 'tsl';  // encryption TLS/SSL
        $mail->Port = 587;  // port to connect to
        $mail->setFrom($email, $name );
        $mail->addAddress('phamvandatx4ql@gmail.com', 'Phạm Văn Đạt'); //mail và tên người nhận
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "$title";
        $noi_dung_thu = "$content";
        $mail->Body = $noi_dung_thu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        echo "<script>alert('Gửi mail thành công!')</script>";
    } catch (Exception $e) {

        echo "<script>alert('Gửi mail thất bại!')</script>";
    }
}//function GuiMail


?>