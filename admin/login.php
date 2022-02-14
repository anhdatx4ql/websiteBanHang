<?php
require_once '../handler_database.php';
session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style_admin.css">
    <LINK REL="SHORTCUT ICON"  HREF="../image/logo.png">
    <title>Admin</title>
</head>
<body>

    <div class="login">
        <div>
            <div class="login__header">
                <p>Đăng nhập</p>
                <img src="../image/logo.png" alt="">
            </div>

            <div class="login__center">

                <form action="login.php" method="post">
                    <div>
                        <input type="text" name="nickname" placeholder="Tên đăng nhập">
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Mật khẩu">
                    </div>

                    <div>
                        <input type="submit" name="submit__manage" value="Quản lý">

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>

<?php  require_once 'handler_login.php'?>
