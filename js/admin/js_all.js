if ( document.querySelector('.header__top--right>ul>li:last-child>a')){
    document.querySelector('.header__top--right>ul>li:last-child>a').onclick = function(){

        let check = confirm('Bạn có muốn đăng xuất');

        if ( check == true){

            document.cookie = escape('logout') + '=' + escape('true');

            window.location.reload();

        }

    }
}