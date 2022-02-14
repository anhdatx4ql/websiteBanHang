<script>

    document.querySelectorAll('.header__bottom--category__list ul>li').forEach(v=>{

       v.querySelector('a').onclick = function(e){

           e.preventDefault();

           document.querySelector('.header__bottom--category__list>ul>form>input').value = parseInt(v.querySelector('a').getAttribute('value'));

           document.querySelector('.header__bottom--category__list form[name="select_category"]').submit();

       }

    });

</script>

<?php
