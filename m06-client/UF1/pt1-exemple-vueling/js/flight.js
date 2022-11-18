//Botones
var botones_compra_ida = document.getElementsByClassName("boton-compra-ida");
var botones_compra_vuelta = document.getElementsByClassName("boton-compra-vuelta");
var prevButton_ida = null;
var prevButton_vuelta = null;
var search_button_flight = document.getElementById("search-button");
var botones_de_compra = document.getElementsByClassName("boton-compra");
var bt = document.getElementById("continue_button");
//Variables utiles
var vuelos_seleccionados = 0;

//info-vuelos-elegidos
var vuelo_ida_info;
var vuelo_vuelta_info;

//INFO TOTAL DE LOS VUELOS
origen;
destino;
fecha_ida;
fecha_vuelta;
var duracion_vuelo;

var info_vuelo_ida;
var info_vuelo_vuelta;

var nombre_pasajeros = [];
var apellidos_pasajeros = [];
var mail_pasajeros = [];
var numero_telefono_pasajeros = [];
var residencia_pasajero = [];

//Docs
var flight_going_pane = document.getElementById("fligth-going-pane");
var flight_return_pane = document.getElementById("fligth-return-pane");
const wrapper_ida = document.getElementById("flight-going-table");
const wrapper_vuelta = document.getElementById("flight-return-table");
const bt_continue = document.getElementById("continue_button");

pasajeros_pane.style.display="none";
flight_return_pane.style.display="none";
flight_going_pane.style.display="none";

document.addEventListener("DOMContentLoaded",function(){
	//-----------------------------------------------Buscando vuelos---------------------------------------------------------------------------------------
    search_button_flight.addEventListener("click",()=>{
        searchFlight();
    });
	//-----------------------------------------------Fin de busquedad de vuelos-----------------------------------------------------------------------------

	//-----------------------------------------------Seleccion de Vuelos------------------------------------------------------------------------------------
	wrapper_ida.addEventListener('click', (e) => {
		const isButton = e.target.nodeName === 'BUTTON'; 
		if (!isButton) {
		  return;
		}
		e.target.classList.add('active');
	  
		if(prevButton_ida !== null) {
			vuelos_seleccionados--;
		  prevButton_ida.classList.remove('active');
		}
		vuelos_seleccionados++;
		
		let td = e.target.parentElement.firstChild;
		let	salida = td.innerHTML;
		let llegada = td.nextSibling.innerHTML; ///////////////////////////////////////
		let precio = td.nextSibling.nextSibling.innerHTML;
		info_vuelo_ida = {
			salida : salida,
			llegada : llegada,
			precio : precio,
		}
		
		if(vuelos_seleccionados == 2){
			pasajeros_pane.style.display="block";
			flight_return_pane.style.display="none";
			flight_going_pane.style.display="none";
			createInfoPasajerosFields();
		}
		prevButton_ida = e.target;

	  });

	  wrapper_vuelta.addEventListener('click', (e) => {
		const isButton = e.target.nodeName === 'BUTTON'; 
		if (!isButton) {return;}
		e.target.classList.add('active');
		if(prevButton_vuelta !== null) {
			vuelos_seleccionados--;
		  prevButton_vuelta.classList.remove('active');
		}
		vuelos_seleccionados++;

		let td = e.target.parentElement.firstChild;
		let	salida = td.innerHTML;
		let llegada = td.nextSibling.innerHTML;
		let precio = td.nextSibling.nextSibling.innerHTML;
		info_vuelo_vuelta = {
			salida : salida,
			llegada : llegada,
			precio : precio,
		}
		if(vuelos_seleccionados == 2){
			pasajeros_pane.style.display="block";
			flight_return_pane.style.display="none";
			flight_going_pane.style.display="none";
			createInfoPasajerosFields();
		}
		prevButton_vuelta = e.target;
	  });
	  //-------------------------------------------Fin de seleccion de vuelo------------------------------------------------------------------------------
	  //-------------------------------------------VALIDACIONES INFO PERSONAL DE LOS PASAJEROS--------------------------------------------------------------
	  document.getElementById("continue_button").addEventListener("click",()=>{
			

			let nombreok = validateName();
			let apellidook = validateLastName();
			let telefonook = validatePhoneNumber();
			let correook = validateMail();
			let terminosok = validateTerms();
			residencia_pasajero = getResidences();
			let allok = nombreok & apellidook & telefonook & correook & terminosok;
			if(allok){
				pasajeros_pane.style.display="none";
				policity_pane.style.display="none";
				printInfoPane();
			}
	  });
});
//_________________________________PANEL_DE_INFO_RESERVAS_____________________________________________
function  printInfoPane(){
//TODO
	print_pane.style.display="block";
	print_info_pane.style.display="block";

	origen=capitalizarPrimeraLetra(origen);
	destino=capitalizarPrimeraLetra(destino);

	let header = document.createElement('h3');
	header.innerHTML="Informacion del vuelo";

	let info_origen_vuelo = document.createElement('pre');
	info_origen_vuelo.innerHTML=`Origen: ${origen}`;

	let info_destino_vuelo = document.createElement('pre');
	info_destino_vuelo.innerHTML=`Destino: ${destino}`;

	let info_fecha_ida_vuelo = document.createElement('pre');
	info_fecha_ida_vuelo.innerHTML =`Fecha de ida: ${fecha_ida.toISOString()}`;

	let info_fecha_vuelta_vuelo = document.createElement('pre');
	info_fecha_vuelta_vuelo.innerHTML=`Fecha de vuelta: ${fecha_vuelta.toISOString()}`;

	///////////////////////////////////////////////////////////////////////////////////////
	let header_vuelo_ida = document.createElement('h3');
	header_vuelo_ida.innerHTML="Vuelo ida";

	let info_salida_ida= document.createElement('pre');
	info_salida_ida.innerHTML=`Hora salida: ${info_vuelo_ida.salida}`;
	
	let info_llegada_ida = document.createElement('pre');
	info_llegada_ida.innerHTML=`Hora llegada: ${info_vuelo_ida.llegada}`;
	
	let info_precio_ida = document.createElement('pre');
	info_precio_ida.innerHTML=`Precio: ${info_vuelo_ida.precio}`;

	/////////////////////////////////////////////////////////////////////////////////////////
	let header_vuelo_vuelta = document.createElement('h3');
	header_vuelo_vuelta.innerHTML="Vuelo retorno";
	
	let info_salida_vuelta= document.createElement('pre');
	info_salida_vuelta.innerHTML=`Hora salida: ${info_vuelo_vuelta.salida}`;
	
	let info_llegada_vuelta = document.createElement('pre');
	info_llegada_vuelta.innerHTML=`Hora llegada: ${info_vuelo_vuelta.llegada}`;
	
	let info_precio_vuelta = document.createElement('pre');
	info_precio_vuelta.innerHTML=`Precio: ${info_vuelo_vuelta.precio}`;
	//////////////////////////////////////////////////////////////////////////////////////////

	//___________________________________APPENDCHILDS_________________________________________________
	print_info_pane.appendChild(header);
	print_info_pane.appendChild(info_origen_vuelo);
	print_info_pane.appendChild(info_destino_vuelo);
	print_info_pane.appendChild(info_fecha_ida_vuelo);
	print_info_pane.appendChild(info_fecha_vuelta_vuelo);
	print_info_pane.appendChild(header_vuelo_ida);
	print_info_pane.appendChild(info_salida_ida);
	print_info_pane.appendChild(info_llegada_ida);
	print_info_pane.appendChild(info_precio_ida);
	print_info_pane.appendChild(header_vuelo_vuelta);
	print_info_pane.appendChild(info_salida_vuelta);
	print_info_pane.appendChild(info_llegada_vuelta);
	print_info_pane.appendChild(info_precio_vuelta);


	//_________________________________________INFO_PASAJEROS_____________________________________________
	for (let index = 0; index < pasajeros; index++) {
		let header_pasajero= document.createElement('h3');
		header_pasajero.innerHTML="Pasajero "+(index+1);

		let nombre_pasajero= document.createElement('pre');
		nombre_pasajero.innerHTML=`Nombre: ${nombre_pasajeros[index]}`;

		let apellido_pasajero= document.createElement('pre');
		apellido_pasajero.innerHTML=`Apellido: ${apellidos_pasajeros[index]}`;

		let residencia = document.createElement('pre');
		residencia.innerHTML = `Residencia: ${residencia_pasajero[index]}`;

		let numero_telefono = document.createElement('pre');
		numero_telefono.innerHTML=`Numero de teléfono: ${numero_telefono_pasajeros[index]}`;

		let mail = document.createElement('pre');
		mail.innerHTML=`Email: ${mail_pasajeros[index]}`;

		print_info_pane.appendChild(header_pasajero);
		print_info_pane.appendChild(nombre_pasajero);
		print_info_pane.appendChild(apellido_pasajero);
		print_info_pane.appendChild(residencia);
		print_info_pane.appendChild(numero_telefono);
		print_info_pane.appendChild(mail);
	}


	//__________________________________________PRECIO_FINAL____________________________________________________

	let precio_ida = info_vuelo_ida.precio.slice(0,-1);
	let precio_vuelta = info_vuelo_vuelta.precio.slice(0,-1);
	let precio = (parseInt(precio_ida) + parseInt(precio_vuelta))*pasajeros;
	let precio_final = document.createElement('h3');
	precio_final.innerHTML=`Precio total: ${precio}€`;
	print_info_pane.appendChild(precio_final);


}

function capitalizarPrimeraLetra(str) {
	return str.charAt(0).toUpperCase() + str.slice(1);
}

//_________________________________VALIDACIONES_______________________________________________________
function getResidences(){
	let residences = [];
	for (let index = 0; index < pasajeros; index++) {
		let residencia = document.getElementById("residencia_pasajero"+(index+1)).value;
		residences.push(residencia);
	}
	return residences;
}
function validateTerms(){
	let flag = false;
	let terms_checked = document.getElementById("terminos").checked;
	flag = terms_checked;
	if(!flag){
		let message = document.getElementById("terms_message");
		message.style.color="red";
		message.innerHTML="No has aceptado los terminos.";
	}
	return flag;
}
function validateName(){
	let flag = false;
	let pattern = "^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$";

	for (let index = 0; index < pasajeros; index++) {
		let mensaje = document.getElementById("info_nombre"+(index+1));
		let nombre_pasajero = document.getElementById("nombre_pasajero"+(index+1)).value;
		
		if(nombre_pasajero.match(pattern)){
			mensaje.style.color="green"
			mensaje.innerHTML="OK";
			nombre_pasajeros.push(nombre_pasajero);
			flag = true;
		}else{
			mensaje.style.color="red"
			mensaje.innerHTML="Nombre invalido";
		}
	}

	return flag;
}
function validateLastName(){
	let flag = false;
	let pattern = "^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$";

	for (let index = 0; index < pasajeros; index++) {
		let mensaje = document.getElementById("info_apellido"+(index+1));
		let apellido = document.getElementById("apellido_pasajero"+(index+1)).value;
		if(apellido.match(pattern)){
			mensaje.style.color="green"
			mensaje.innerHTML="OK";
			apellidos_pasajeros.push(apellido);
			flag = true;
		}else{
			mensaje.style.color="red"
			mensaje.innerHTML="Apellido invalido";
		}
	}

	return flag;
}
function validatePhoneNumber(){
	let flag = false;
	let pattern = /^\d{9}$/;

	for (let index = 0; index < pasajeros; index++) {
		let mensaje = document.getElementById("info_telefono"+(index+1));
		let tel = document.getElementById("telefono_pasajero"+(index+1)).value;

		if(tel.match(pattern)){
			mensaje.style.color="green";
			mensaje.innerHTML="OK";
			numero_telefono_pasajeros.push(tel);
			flag = true;
		}else{
			mensaje.style.color="red"
			mensaje.innerHTML="Numero de telefono invalido";
		}
	}
	return flag;
}
function validateMail(){
	let flag = false;
	let pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	for (let index = 0; index < pasajeros; index++) {
		let mensaje = document.getElementById("info_correo"+(index+1));
		let correo = document.getElementById("correo_pasajero"+(index+1)).value;

		if(correo.match(pattern)){
			mensaje.style.color="green"
			mensaje.innerHTML="OK";
			mail_pasajeros.push(correo);
			flag = true;
		}else{
			mensaje.style.color="red"
			mensaje.innerHTML="Correo invalido";
		}
	}

	return flag;
}

//_________________________________FIN_VALIDACIONES__________________________________________


function createInfoPasajerosFields(){
	let h1 = document.createElement("h1");
		h1.innerHTML="Informacion personal de pasajeros";
	pasajeros_pane.appendChild(h1);

	for (let index = 0; index < pasajeros; index++) {
		//Creacion del div
		let div = document.createElement('div');
		div.id="pasajero"+(index+1);
		//Fin div

	//TITULO
		let h3 = document.createElement("h3");
		h3.innerHTML="Pasajero "+(index+1);	
	//INPUT NOMBRE
		let input_nombre = document.createElement("input");
		input_nombre.type="text";
		input_nombre.id="nombre_pasajero"+(index+1);
		input_nombre.classList="user-input";
		input_nombre.name="nombre_pasajero"
		input_nombre.placeholder="Jhon";
		//MENSAJE
		let mensaje_nombre = document.createElement("p");
		mensaje_nombre.id="info_nombre"+(index+1);

	//INPUT APELLIDO
		let input_apellido = document.createElement("input");
		input_apellido.type="text";
		input_apellido.id="apellido_pasajero"+(index+1);
		input_apellido.classList="user-input";
		input_apellido.name="apellido_pasajero"
		input_apellido.placeholder="Jhonson";
		//MENSAJE
		let mensaje_apellido = document.createElement("p");
		mensaje_apellido.id="info_apellido"+(index+1);

	//SELECT PAIS DE RESIDENCIA
		let select_pais_residencia = document.createElement("select");
		select_pais_residencia.id="residencia_pasajero"+(index+1);

		let option1 = document.createElement("option");
		option1.setAttribute("value", "españa");
		let option1Texto = document.createTextNode("España");
		option1.appendChild(option1Texto);
	
		let option2 = document.createElement("option");
		option2.setAttribute("value", "francia");
		let option2Texto = document.createTextNode("Francia");
		option2.appendChild(option2Texto);
	
		let option3 = document.createElement("option");
		option3.setAttribute("value", "alemania");
		let option3Texto = document.createTextNode("Alemania");
		option3.appendChild(option3Texto);
		select_pais_residencia.appendChild(option1);
		select_pais_residencia.appendChild(option2);
		select_pais_residencia.appendChild(option3);

	//INPUT TELEFONO
		let input_telefono = document.createElement("input");
		input_telefono.type="tel";
		input_telefono.id="telefono_pasajero"+(index+1);
		input_telefono.classList="user-input";
		input_telefono.name="telefono_pasajero"
		input_telefono.placeholder="608010233";
		input_telefono.maxLength="9";
		//MENSAJE
		let mensaje_telefono= document.createElement("p");
		mensaje_telefono.id="info_telefono"+(index+1);
	//INPUT CORREO
		let input_correo = document.createElement("input");
		input_correo.type="mail";
		input_correo.id="correo_pasajero"+(index+1);
		input_correo.classList="user-input";
		input_correo.name="correo_pasajero"
		input_correo.placeholder="example@gmail.com";
		//MENSAJE
		let mensaje_correo= document.createElement("p");
		mensaje_correo.id="info_correo"+(index+1);
	//NEXT LINES
		let br2 = document.createElement("br");
		div.appendChild(h3);
		div.appendChild(input_nombre);
		div.appendChild(mensaje_nombre);
		div.appendChild(input_apellido);
		div.appendChild(mensaje_apellido);
		div.appendChild(select_pais_residencia);
		div.appendChild(input_telefono);
		div.appendChild(mensaje_telefono);
		div.appendChild(input_correo);
		div.appendChild(mensaje_correo);
		div.appendChild(br2);
		pasajeros_pane.appendChild(div);		
	}
	policity_pane.style.display="block";
	

}

function searchFlight(){
	home_content.style.display = "none";
    flight_going_pane.style.display="block";
    flight_return_pane.style.display="block";
    let dias = [
		"domingo",
		"lunes",
		"martes",
		"miercoles",
		"jueves",
		"viernes",
		"sabado",
	];
    let dia_ida =   dias[fecha_ida.getDay()];
    let dia_vuelta = dias[fecha_vuelta.getDay()];
	origen = origen.toLowerCase();
	destino = destino.toLowerCase();
	dia_ida = dia_ida.toLowerCase();
	dia_vuelta = dia_vuelta.toLowerCase();

    ajax(origen,destino,dia_ida,dia_vuelta,"ida","tbody-ida","boton-compra-ida");
	ajax(origen,destino,dia_ida,dia_vuelta,"vuelta","tbody-vuelta","boton-compra-vuelta");

}

function ajax(origen,destino,dia_ida,dia_vuelta,action,tbody,bt){
    let vuelo = {
		"origen":origen,
		"destino":destino,
		"dia_ida":dia_ida,
		"dia_vuelta":dia_vuelta,
		"action":action,
    }

	let xhr = new XMLHttpRequest();
	xhr.open("POST", "./php/flights.php");
	xhr.send(JSON.stringify(vuelo));
	xhr.onload = function () {
		if (xhr.status != 200) {
			alert(`Error ${xhr.status}: ${xhr.statusText}`);
		} else {
			let vuelos = JSON.parse(xhr.response);
			let body = document.getElementById(tbody);

			for (let index = 0; index < vuelos.salidas.length; index++) {
				let row = document.createElement('tr');
				let salida = document.createElement('td');
				salida.innerHTML = vuelos.salidas[index];
				let hora_minuto = vuelos.salidas[index].split(":");
				let hora = parseInt(hora_minuto[0]);
				let minutos = parseInt(hora_minuto[1]);
				let duracion = vuelos.duracion;
				duracion_vuelo = duracion;
				if(duracion >60){
					let restos = duracion-60;
					hora++;
					minutos +=restos;
				}else{
					minutos +=duracion;
					if(minutos>60){
						hora++;
						minutos = minutos -60;
					}
				}

				let llegada_data;

				if(minutos>9){
					llegada_data= hora+":"+minutos;
				}else{
					llegada_data = hora+":0"+minutos;
				}

				let llegada = document.createElement('td');
				llegada.innerHTML = llegada_data;
				
				let precio = document.createElement('td');
				precio.innerHTML = vuelos.precio+"€";

				let boton_compra = document.createElement("button");
				boton_compra.classList.add(bt);
				boton_compra.innerHTML="Comprar";

				row.appendChild(salida);
				row.appendChild(llegada);
				row.appendChild(precio);
				row.appendChild(boton_compra);
				body.appendChild(row);		
			}
		}
	}
}