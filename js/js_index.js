


//slider
let stt=1;
if(document.querySelector('.main__slide')){
    setInterval(function () {
        if(stt==1){
            stt+=1;
            document.querySelector('.main__slide').style.cssText = "transform: translateX(-50%);";
        }else{
            stt-=1;
            document.querySelector('.main__slide').style.cssText = "transform: translateX(0);";
        }
    },5000)

    document.querySelectorAll('.left').forEach(value => {

        value.onclick = function (){
            if(stt==1){
                stt+=1;
            }else{
                stt-=1;
                document.querySelector('.main__slide').style.cssText = "transform: translateX(0);";
            }
        }

    });

}

document.querySelectorAll('.right').forEach(value => {

    value.onclick = function (){
        if(stt==1){
            stt+=1;
            document.querySelector('.main__slide').style.cssText = "transform: translateX(-50%);";
        }else{
            stt-=1;
        }
    }

});





