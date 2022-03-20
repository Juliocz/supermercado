function resetAnimation(element){
    element.style.animation = 'none';
    element.offsetHeight; /* trigger reflow */
    element.style.animation = null; 
}
//menu show
var navshowbottons= document.querySelectorAll('.navshowbotton');

for (var m of navshowbottons) {
    try {
    //alert(m.outerHTML);
    m.addEventListener("click", function(evento) {
        try {    


        //obtengo nav
        var nav=this.getAttribute('navid_show');
        nav=document.getElementById(nav);

        //guardo su medida original si no fue guardado
        if(typeof nav.t_width_origin === 'undefined') nav.t_width_origin=nav.style.width;
        


        
        

        //si esta en 0width, lo pongo a su tamaño original, sino lo oculto
        if(nav.style.width=='0px'){
            //muestro
            nav.addEventListener("animationend",function(){nav.style.width=nav.t_width_origin;});//remplazo evento al terminar animacion para que ya no se oculte
        
            nav.style.width=nav.t_width_origin; //asigno tamaño original   
            nav.style.animation = "scalehorizontal 0.8s";    //asigno animacion mostrar
             }
        else {
            nav.addEventListener("animationend",function(){nav.style.width='0px';});//al terminar ocultar, width se pone a 0
        nav.style.animation = "scalehorizontalhide 0.4s";//asigno animacion ocultar
        }
        //resetAnimation(nav);

        }catch (error) { 
        }
    });

} catch (error) { 
}
}    





//OBTENGO TODOS LOS MENUS VERTICALES
try { 
var menuvertical_array = document.querySelectorAll('.menu_vertical');
} catch (error) { 
}
//RECORRO LOS MENUVERTICALES
for (var m of menuvertical_array) {
    try {
    var padre = m;
    m = m.querySelectorAll('.menu_vertical_click')[0];

    //AÑADO EVENTO SEGUN SU ATRIBUTO SE HACE VISIBLE O NO SU hijo class desvisible
    m.addEventListener("click", function(evento) {
        try { 
        var isvisible = this.getAttribute('des_visible');
        // alert(isvisible);
        if (isvisible == "true")
            isvisible = false;
        else isvisible = true;

        this.setAttribute('des_visible', isvisible);


        var des = this.parentNode.querySelectorAll('.des_vertical')[0];
        if (isvisible) des.style.display = 'block';
        else des.style.display = 'none';

    } catch (error) { 
    }
        
    });

    var isvisible = m.getAttribute('des_visible');
    if (isvisible == "true") isvisible = true;
    else isvisible = false;

    var des = m.parentNode.querySelectorAll('.des_vertical')[0];
    if (isvisible) des.style.display = 'block';
    else des.style.display = 'none';
   
    
} catch (error) { 
}

}


//aqui obtengo todos los alerts para guardar su medida height inicial
var t_alerts = document.querySelectorAll('.message_alert');
for (var element of t_alerts) {
    try{


        prepareAlert(element);
    

}catch(error){}
}

function prepareAlert(element){

    if(typeof element.t_height_origin === 'undefined') element.t_height_origin=element.style.height;
    

    if(element.getAttribute('des_visible')=='false')
    element.style.height='0px';

    element.showAnimVertical=function(){showAnimVertical(this)};
    element.hideAnimVertical=function(){hideAnimVertical(this)};
}
function showAnimVertical(element){
    if(typeof element.t_height_origin === 'undefined') element.t_height_origin=element.style.height;
    
    if(element.style.height=='0px'){
        

     element.style.animation = "scaleverticalshow 6.4s";
     element.style.height=element.t_height_origin;

     console.log()
     //resetAnimation(element);
     element.addEventListener("animationend",function(){element.style.height=element.t_height_origin;});//remplazo evento al terminar animacion para que ya no se oculte
      
    }     
}
function hideAnimVertical(element){
    if(typeof element.t_height_origin === 'undefined') element.t_height_origin=element.style.height;
  
    if(element.style.height!='0px'){
            element.style.animation = "scaleverticalhide 0.8s"; 
            element.addEventListener("animationend",function(){
                this.style.height='0px';
            });//remplazo evento al terminar animacion para que ya no se oculte
    }
}


/*LOS OBJETOS CLASE class="message_alert" des_visible="false"*/
//segun ese atributo se oculta en vertical height y se guarda la variable para despues usarse
//pueden llamar a metodos como element.showAnimVertical() o element.hideAnimVertical() para ocultarse o mostrarse verticalmente
//los otros metodos tmb funcionan idependientemente de esa variable
//no es posible agregar programaticamente uno oculto ya que se pone su heigh a 0 y no se guarda su tamaño original
//con el prepare alert podemos prepara el elemento para que funcione como un alerta
