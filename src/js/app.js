document.addEventListener('DOMContentLoaded',function(){
   eventListener();
});

//PARA CREAR LA ANIMACION DEL MENU DE HAMBURGUESA
function eventListener(){
    const mobileMenu =document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click',navegacionRes)
}

function navegacionRes(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
}