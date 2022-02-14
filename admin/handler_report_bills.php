<script>

    // start show form detail bill
    document.querySelector('.main__report-detail_bills>.container>div:first-child>i').onclick = function(){
            document.querySelector('.main__report-detail_bills').style.display="none";
    }
    // end show form detail bill


    // start click table
    document.querySelectorAll('.main__report-bills__right--full>table tbody>tr').forEach(v=>{

       v.onclick = function () {
            document.cookie = escape('info_detail_bill_id') + '=' + escape(parseInt(v.querySelector('td:first-child').innerHTML));
            window.location.reload();
       }

    });
    //end click table

</script>

<?php

if (isset($_COOKIE['info_detail_bill_id'])){

    echo "<script>document.querySelector('.main__report-detail_bills').style.display = \"block\";</script>";

    // Xóa cookie đi
    echo "<script>document.cookie = 'info_detail_bill_id' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';</script>";

}



?>
