
<?php

    if ( isset($_COOKIE['logout'])){

        // Xóa session admin
        unset($_SESSION['user_id']);

        // Xóa cookie
        echo "<script>document.cookie = 'logout' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

        echo "<script>window.location.replace('login.php');</script>";

    }


?>


