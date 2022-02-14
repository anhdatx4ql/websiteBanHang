window.onscroll = function(){

    let header__bottom = document.querySelector('.header__bottom');
    let back = document.querySelector('.back');


    if(document.documentElement.scrollTop > 195 ){

        document.querySelector('.header__bottom--right>div:nth-child(1)').style.display = "none";

        document.querySelector('.header__center--miniCart.header__bottom--right__miniCart').style.display = "flex";

        header__bottom.style.cssText = "top: 0px;\n" +
            "    left: 0px;\n" +
            "    right: 0px;\n" +
            "    position: fixed;\n" +
            "    padding: 5px 1.5rem;\n" +
            "    background: whitesmoke;";


        back.style.display = "inline-block";
        back.style.transition = "1s all ease";

        //click trở về đầu trang
        document.querySelector('.back').onclick = function(){

            let back_time = setInterval(function(){
                document.documentElement.scrollTop -=10;

                if( document.documentElement.scrollTop == 0 )
                    clearInterval(back_time);

            },1);

        }

    }else{
        document.querySelector('.header__bottom--right>div:nth-child(1)').style.display = "block";
        document.querySelector('.header__center--miniCart.header__bottom--right__miniCart').style.display = "none";
        header__bottom.style.cssText = "top: 0px;\n" +
            "    position: none;\n" +
            "    padding: 5px 0px;\n" +
            "    background: white;";

        back.style.display = "none";
    }
}

// show giỏ hàng
document.querySelectorAll('.header__center--miniCart').forEach(value => {

   value.onclick = function() {
       window.location.replace('carts.php');
   }

});



