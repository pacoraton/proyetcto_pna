
var api_google='AIzaSyB7UmiwOl-LKZo0b2aohNNcJTnTA02q43o';


      function initMap() {
        
        var latlng={
        	lat:20.6414217,
        	lng:-103.351598
        } 

        var  map = new google.maps.Map(document.getElementById('mapa'), {
          'center':latlng,
          'zoom': 14,
          'mapTypeId':google.maps.MapTypeId.ROADMAP
        });

        /*'mapTypeId':google.maps.MapTypeId.HYBRID
        									SATELLITE
        									TERRAIN
        									ROADMAP
        */
 	    
        var contenido= '<h2>GDLWEBCAM</h2>'+
        			   '<p>Del 10 al 12 de Diciembre</p>'+
        			   '<p>Visitanos</p>';

 		var informacion= new google.maps.InfoWindow({
 			content:contenido	
 		});

        var marker =new google.maps.Marker({
          position:latlng,
          map:map,
          title:'GDLWEBCAM'
        });

        marker.addListener('click',function(){
           informacion.open(map,marker);

        });

      }


(function(){
    'use strict';

     document.addEventListener('DOMContentLoaded',function(){
   
      var regalo=document.getElementById('regalo');   

      //campos usuarios
      var nombre = document.getElementById('nombre');
      var apellido=document.getElementById('apellido');
      var email =document.getElementById('email');

       //Campos pases
       var pase_dia=document.getElementById('pase_dia');
       var pase_completo=document.getElementById('pase_completo');
       var pase_dosdias= document.getElementById('pase_dosdias');

       //botones y divs

       var calcular = document.getElementById('calcular');
       var errorDiv = document.getElementById('error');
       var botonRegistro = document.getElementById('btnPagar');
       var lista_productos = document.getElementById('lista-productos');
       var Suma_Total=document.getElementById('suma-total');
       
		//extras
        var etiquetas=document.getElementById('etiquetas');                 
        var camisas=document.getElementById('camisa_evento');

       //Agregando evento click al boton calcular 
       if(calcular !== null) {
       calcular.addEventListener('click',calcularMontos);

       //Agregamos Evento para conocer cual pase elige el usuario agregando la funcion mostrarDias
       pase_dia.addEventListener('blur',mostrarDias);
       pase_completo.addEventListener('blur',mostrarDias); 
       pase_dosdias.addEventListener('blur',mostrarDias);

      }
      //Validacion de los campos de informacion del usuario (nombre,apellido,email) por ejemplo cuando mandan nombre vacio (lo dejamos en required en html5).
     /* nombre.addEventListener('blur',ValidarCampos);
      apellido.addEventListener('blur',ValidarCampos);
      email.addEventListener('blur',ValidarCampos);
      email.addEventListener('blur',Validar_mail);
      
      function ValidarCampos(){
      	if(this.value==''){
          	errorDiv.style.display = 'block';
          	errorDiv.innerHTML="Este campo es Obligatorio";
          	this.style.border="1px solid red";
          	errorDiv.style.border='1px solid red';
          }else{
          	errorDiv.style.display='none';
          	this.style.border='1px solid #cccccc';
          }
      }

      function Validar_mail(){
      	if(this.value.indexOf("@") > -1){
      		errorDiv.style.display='none';
          	this.style.border='1px solid #cccccc';
      	}else{
      		errorDiv.style.display = 'block';
          	errorDiv.innerHTML="Debe tener un correo valido @";
          	this.style.border="1px solid red";
          	errorDiv.style.border='1px solid red';

      	}
      }*/


       //Funcion del a la escucha del evento click en el boton calcular
       function calcularMontos(e){
       	e.preventDefault();
       	if(regalo.value===''){
       		alert('Debes agregar un Regalo');
       		regalo.focus();
       	}else{
       		var boletos=parseInt(pase_dia.value,10) || 0;
       		var boletos_dosdias=parseInt(pase_dosdias.value,10) || 0;
       		var boletos_completo=parseInt(pase_completo.value,10) || 0;

       		var cantidadEti=parseInt(etiquetas.value,10) || 0;
       		var cantidadCam=parseInt(camisas.value,10) || 0;

            //Variable para calcular el total a pagar de acuerdo a los procuctos que el usuario ha seleccionado
       		var total_pagar=(boletos*30)+ (boletos_dosdias*45)+(boletos_completo*50)+((cantidadCam*10)*0.93)+(cantidadEti*2);
       		
       		//Creamos un array para ir agregando la lista de productos que el usuario a seleccionado
            var listadoProductos= [];

            	if(boletos>=1){
            		listadoProductos.push(boletos+ ' Pases por dia');
                 }

                 if(boletos_dosdias>=1){
            		listadoProductos.push(boletos_dosdias+ ' Pases por 2 dias');
            	}
            	if(boletos_completo>=1){	
            		listadoProductos.push(boletos_completo+ ' Pase completo');
                }  

                if(cantidadCam>=1){	
            		listadoProductos.push(cantidadCam+ ' Camisas');
                }  

                if(cantidadEti>=1){	
            		listadoProductos.push(cantidadEti+ ' Etiquetas');
                }  
                  //mostramos el listado	
                  lista_productos.style.display = 'block';
                  lista_productos.innerHTML='';

                 //ciclo for para imprimir el listado completo de productos en el div correspondiente 	
                 for(var i=0;i<listadoProductos.length; i++){

                   lista_productos.innerHTML+=listadoProductos[i]+'<br>';
                 }


                 Suma_Total.innerHTML="";
                 Suma_Total.innerHTML='$ '+ total_pagar.toFixed(2);
  
            console.log(listadoProductos);
       	}//else

      }//funcion_calcularMontos

     
     //Funcion que se ejecutara cuando el usuario seleccione el pase que desea comprar
     function mostrarDias(){
        
        //variables que indican los tres tipos de pases que hay 
        var boletos=parseInt(pase_dia.value,10) || 0;
       	var boletos_dosdias=parseInt(pase_dosdias.value,10) || 0;
       	var boletos_completo=parseInt(pase_completo.value,10) || 0;


        //Array que guarda los dias de acuerdo al pase que el usuario eligio 
       	var Dia_Elegido=[];

       	if(boletos>0){
       		Dia_Elegido.push('viernes');
       	}
       	if(boletos_dosdias>0){
       		Dia_Elegido.push('viernes','sabado');
       	}
       	if(boletos_completo>0){
       		Dia_Elegido.push('viernes','sabado','domingo');
       	}
        
        //ciclo for para mostrar los divs de los talleres de acuerdo los dias que se guardan en el array
       	for(var i=0;i<Dia_Elegido.length; i++){
       		document.getElementById(Dia_Elegido[i]).style.display = 'block';
       	}

     }



     });//DOM CONTENT LOADED

})();