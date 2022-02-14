// handler event products admin

function start(){

    // Sửa sản phẩm
    handlerUpdateProduct();

    // Thêm sản phẩm
    handlerInsertProduct();

    // Thêm danh mục
    handlerInsertCategories();

    // click navigation
    click_navigation();

    handler_update_category();

    delete_category();


}

start();



function handlerUpdateProduct(){


    document.querySelectorAll('.main__products--right__center>table>tbody>tr').forEach(value => {

        value.onclick = function () {
            document.cookie = escape('product_id') + '=' + escape(value.getAttribute('id'));
            document.cookie = escape('update_product') + '=' + escape('true');
            window.location.replace('products.php');
        }

    });

    document.querySelector('.update_product>div').onclick = function(){
        document.querySelector('.parent_update_product').style.display = "none";
    }


}

function handlerInsertProduct(){

    document.querySelector('.main__products--right>.main__products--right__header>div:nth-child(2)').onclick = function (){
        document.cookie = escape('insert_product') + '=' + escape('true');
        window.location.replace('products.php');
    }

    document.querySelector('.update_product>div').onclick = function(){
        document.querySelector('.parent_update_product').style.display = "none";
    }


}

function handlerInsertCategories(){

    // Hiển thị form thêm danh mục sản phẩm
    document.querySelector('.main__products--left>.main__products--left__header>i').onclick = function(){
        document.querySelector('.child_handler_categories>form>div:last-child>input:first-child').style.display = 'block';
        document.querySelectorAll('.child_handler_categories>form>div:last-child>input:not(:first-child)').forEach(v=>{
            v.style.display = 'none';
        })
        document.querySelector('.parent_handler_categories').style.display = "block";

    }
    //click tắt form thêm danh mục sản phẩm
    document.querySelector('.child_handler_categories>div:first-child>i').onclick = function(){

        document.querySelector('.parent_handler_categories').style.display = "none";

    }

}


function click_navigation(){

    // click navigation header
    document.querySelectorAll('.main__products--left__navigation>ul>li').forEach(value=>{

        value.querySelector('a').onclick = function(e){
            e.preventDefault();

            document.querySelectorAll('.main__products--left__navigation>ul>li').forEach(v=>{
                v.classList.remove('selected_nav');
            });

            value.classList.add('selected_nav');

            document.cookie = escape('category_id') + '=' + escape(value.getAttribute('id'));

            window.location.replace('products.php');

        }

    });
}

function handler_update_category(){

    document.querySelectorAll('.main__products--left>.main__products--left__navigation>ul>li:not(:first-child)').forEach(v=>{

        v.querySelector('a:last-child').onclick = function(e){

            e.preventDefault();


                document.cookie = escape('id_category_update') + '=' + escape(parseInt(v.getAttribute('id')));

                window.location.replace('products.php');
            }



    })

}

function delete_category(){

    document.querySelector('.child_handler_categories>form>div:last-child>input:last-child').onclick = function (e) {

        e.preventDefault();

        let check = confirm('Bạn có muốn xóa?');

        if (check == true){

            document.cookie = escape('delete_category_id') + '=' + escape(this.parentElement.parentElement.querySelector('input').value);

            window.location.replace('products.php');

        }

    }

}
