
var pasajeros;
//Timer
var hora = document.getElementById("hora");

//Atributos
var fecha_ida = new Date();
var fecha_vuelta = new Date();
var destino;
var origen;


//Flags
var nameok = false;
var usernameok = false;
var passwordok = false;
var confirm_passwordok = false;
var flag_allok = false;

//Flags reserva
var fecha_idaOK = false;
var fecha_vueltaOK = false;
var vuelo_diferente = false;
var num_pasajerosOK = false;
var round_tripOK = false;

//Button
const register_button = document.getElementById("register-button");
register_button.disabled = true;
var search_button = document.getElementById("search-button");
search_button.disabled = true;

//Login
var username = document.getElementById("login-username");
var password = document.getElementById("login-password");

//Register fields
var register_username = document.getElementById("register-username");
var register_password = document.getElementById("register-password");
var register_confirm_password = document.getElementById(
	"register-confirm-password"
);
var register_name = document.getElementById("register-name");

//Take message-register
var mensaje = document.getElementById("message");
var mensaje_registre_name = document.getElementById("register-message-name");
var mensaje_registre_username = document.getElementById(
	"register-message-username"
);
var mensaje_registre_password = document.getElementById(
	"register-message-password"
);
var mensaje_registre_confirm_password = document.getElementById(
	"register-message-confirm-password"
);
var mensaje_registre_name = document.getElementById("register-message-name");
var mensaje_registre = document.getElementById("register-message");

//Select doc
var origen_select = document.getElementById("origen");
var destino_select = document.getElementById("destino");

//Docs
var login_content = document.getElementById("login-pane");
var register_content = document.getElementById("register-pane");
var home_content = document.getElementById("home-pane");
var flight_going_pane = document.getElementById("fligth-going-pane");
var flight_return_pane = document.getElementById("fligth-return-pane");
var pasajeros_pane = document.getElementById("pasajeros_pane");
var policity_pane = document.getElementById("policity_pane");
var print_pane = document.getElementById("print-button-pane");
var print_info_pane = document.getElementById("print-info-pane");

print_pane.style.display="none";
policity_pane.style.display="none"
pasajeros_pane.style.display="none";
flight_return_pane.style.display="none";
flight_going_pane.style.display="none";
home_content.style.display = "none";
login_content.style.display = "block";
register_content.style.display = "none";



//------------------------DOM------------------------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {

	addingCountries(origen_select);
	addingCountries(destino_select);

	//_________________RESERVA______________________________
	document.getElementById("origen").addEventListener("change" , ()=>{
		vuelo_diferente = isDifferentFlight();
		able_search_button();
	});

	document.getElementById("destino").addEventListener("change" , ()=>{
		vuelo_diferente = isDifferentFlight();

		able_search_button();
	});
	
	document.getElementById("fecha-ida").addEventListener("change",()=>{
		fecha_idaOK = valid_date("fecha-ida","ida-mensaje");
		round_tripOK=valid_round_trip();
		able_search_button();
	});
	document.getElementById("fecha-vuelta").addEventListener("change",()=>{
		fecha_vueltaOK = valid_date("fecha-vuelta","vuelta-mensaje");
		round_tripOK=valid_round_trip();
		able_search_button();
	});
	
	document.getElementById("pasajeros").addEventListener("input",()=>{
		num_pasajerosOK = valid_num_pasajeros();
		able_search_button();
	});

	//_________________FIN_RESERVA__________________________

	setInterval(showTime, 1000);
	document.getElementById("login-button").addEventListener("click", () => {
		enviar();
	});
	document.getElementById("register-content").addEventListener("click", () => {
		intoRegister();
	});

	document.getElementById("register-button").addEventListener("click", () => {
		register();
	});
	document.getElementById("logout").addEventListener("click", () => {
		this.location.reload();
	});

	document.getElementById("register-name").addEventListener("blur", () => {
		nameok = valid_name();
		able_register_button();
	});
	document.getElementById("register-username").addEventListener("blur", () => {
		usernameok = valid_username();
		able_register_button();
	});
	document.getElementById("register-password").addEventListener("blur", () => {
		passwordok = valid_password();
		able_register_button();
	});
	document
		.getElementById("register-confirm-password")
		.addEventListener("blur", () => {
			confirm_passwordok = valid_confirm_password();
			able_register_button();
		});
});
//-------------------------------------------------------------END OF DOM--------------------------------------------------------
function able_search_button(){
	let flag = fecha_idaOK & fecha_vueltaOK & vuelo_diferente & num_pasajerosOK & round_tripOK;
	if(flag){
		search_button.disabled = false;
	}else{
		search_button.disabled = true;
	}
}

function isDifferentFlight(){
	origen = document.getElementById("origen").value;
	destino = document.getElementById("destino").value;
	let flag = false;
	let mensaje = document.getElementById("vuelo_info");

	if(origen != destino){
		mensaje.style.color="green";
		mensaje.innerHTML="";
		flag= true;
	}else{
		mensaje.style.color="red";
		mensaje.innerHTML="Vuelos de destino y origen iguales";
	}
	return flag;
}

function valid_num_pasajeros(){
	pasajeros = document.getElementById("pasajeros").value;
	let mensaje = document.getElementById("pasajeros-mensaje");
	let flag = false;

	if(pasajeros>3 || pasajeros<=0){
		console.log("error");
		mensaje.style.color="red";
		mensaje.innerHTML="Numero introducido invalido";
	}else{
		flag = true;
		mensaje.style.color="green";
		mensaje.innerHTML="";
	}
	return flag;
}

function valid_round_trip(){
	let ida = document.getElementById("fecha-ida").value;
	let vuelta = document.getElementById("fecha-vuelta").value;

	let info = document.getElementById("road-trip-mensaje");

	let parts1 =ida.split('-');
	let parts2 =vuelta.split('-');

	fecha_ida = new Date(parts1[0],parts1[1]-1,parts1[2]);
	fecha_vuelta = new Date(parts2[0],parts2[1]-1,parts2[2]);

	let diferencia =  fecha_vuelta.getTime()-fecha_ida.getTime();
	diferencia= diferencia/(1000 * 60 * 60 * 24 * 30);
	let flag = false;

	if(fecha_vuelta == null){
		info.style.color="red";
		info.innerHTML="No has introducido la fecha de vuelta";
	}
	if(diferencia<0){
		info.style.color="red";
		info.innerHTML="La vuelta es antes que la ida!";
	}
	else{
		info.style.color="green";
		info.innerHTML="";
		flag = true;
	}
	return flag;

}

function valid_date(id, id_info){
	const max_months_allowed=6;
	let actual_date = new Date();
	let given_date_string1 = document.getElementById(id).value;

	let parts =given_date_string1.split('-');

	let given_date = new Date(parts[0],parts[1]-1,parts[2]);

	let diferencia =  given_date.getTime()-actual_date.getTime();
	diferencia= diferencia/(1000 * 60 * 60 * 24 * 30);

	let flag = false;

	let info = document.getElementById(id_info);
	
	if(diferencia<0){
		info.style.color="red";
		info.innerHTML="Has puesto una fecha inferior a la actual";
	}
	else if(diferencia>max_months_allowed){
		info.style.color="red";
		info.innerHTML="Excede los 6 meses!";

	}else{
		info.style.color="green";
		info.innerHTML="";
		flag = true;
	}
	return flag;
}

function addingCountries(doc){
	let action = "countries"; 
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "./php/home.php");
	xhr.send(JSON.stringify(action));
	xhr.onload = function () {
		if (xhr.status != 200) {
			alert(`Error ${xhr.status}: ${xhr.statusText}`);
		} else {
			let countries = JSON.parse(xhr.response);
			for (let i = 0; i< countries.length; i++){
				let opt = document.createElement('option');
				opt.value = countries[i];
				opt.innerHTML = countries[i];
				doc.appendChild(opt);
			}
		}
	}
}

function able_register_button() {
	flag_allok = nameok & usernameok & passwordok & confirm_passwordok;
	if (flag_allok) {
		register_button.disabled = false;
	} else {
		register_button.disabled = true;
	}
}

function intoRegister() {
	login_content.style.display = "none";
	register_content.style.display = "block";
}
function valid_name() {
	let name = register_name.value;
	let flag = false;
	let pattern_name = /^[a-zA-Z ]+$/;

	if (!name.match(pattern_name)) {
		mensaje_registre_name.style.color = "red";
		mensaje_registre_name.innerHTML =
			"*El nombre completo introducido no puede contener numeros";
	} else {
		mensaje_registre_name.style.color = "green";
		mensaje_registre_name.innerHTML = "OK";
		flag = true;
	}
	return flag;
}
function valid_username() {
	let username = register_username.value;
	let flag = false;
	if (username.length <= 4) {
		mensaje_registre_username.style.color = "red";
		mensaje_registre_username.innerHTML =
			"*Su usuario debe contener minimo 5 caracteres <br>";
	} else {
		mensaje_registre_username.style.color = "green";
		mensaje_registre_username.innerHTML = "OK";
		flag = true;
	}
	return flag;
}
function valid_password() {
	let pass = register_password.value;
	let flag = false;
	if (pass.length < 8) {
		mensaje_registre_password.style.color = "red";
		mensaje_registre_password.innerHTML =
			"La contraseña tiene menos de 8 caracteres";
	} else {
		mensaje_registre_password.style.color = "green";
		mensaje_registre_password.innerHTML = "OK";
		flag = true;
	}
	return flag;
}

function valid_confirm_password() {
	let pass = register_password.value;
	let confirm_pass = register_confirm_password.value;
	let flag = false;
	if (pass != confirm_pass) {
		mensaje_registre_confirm_password.style.color = "red";
		mensaje_registre_confirm_password.innerHTML = "*La contraseña no coincide";
	} else {
		mensaje_registre_confirm_password.style.color = "green";
		mensaje_registre_confirm_password.innerHTML = "OK";
		flag = true;
	}
	return flag;
}
function register() {
	mensaje_registre.style.color = "green";
	mensaje_registre.innerHTML = "Registrando...";
	registring();
}

function registring() {
	let user = {
		u_name: register_username.value,
		u_password: register_password.value,
		u_rol: "cliente",
		action: "register",
	};

	let xhr = new XMLHttpRequest();

	xhr.open("POST", "./php/server.php");

	xhr.send(JSON.stringify(user));

	xhr.onload = function () {
		if (xhr.status != 200) {
			alert(`Error ${xhr.status}: ${xhr.statusText}`);
		} else {
			let respuesta = JSON.parse(xhr.response);
			if (respuesta == 0) {
				mensaje_registre.style.color = "red";
				mensaje_registre.innerHTML = "Tu nombre de usuario ya esta en uso";
			} else if (respuesta == -1) {
				mensaje_registre.style.color = "red";
				mensaje_registre.innerHTML = "No se ha podido registrar tu usuario";
			} else {
				alert(`Registrado`);
				mensaje_registre.style.color = "green";
				mensaje_registre.innerHTML = "Se ha registrado correctamente";
				login_content.style.display = "block";
				register_content.style.display = "none";
			}
		}
	}
}

function showTime() {
	let time = new Date();
	let time_to_string = time.toLocaleTimeString();
	let dias = [
		"Domingo",
		"Lunes",
		"Martes",
		"Miercoles",
		"Jueves",
		"Viernes",
		"Sabado",
	];

	let meses = [
		"enero",
		"febrero",
		"marzo",
		"abril",
		"mayo",
		"junio",
		"julio",
		"agosto",
		"septiembre",
		"octubre",
		"noviembre",
		"diciembre",
	];
	let index_day = time.getDay();
	let index_month = time.getMonth();
	let anyo = time.getFullYear();

	let num_dia = time.getDate();
	hora.innerHTML =
		dias[index_day] +
		" " +
		num_dia +
		" de " +
		meses[index_month] +
		" del " +
		anyo +
		"<br>" +
		time_to_string;
}

function enviar() {
	let user = {
		u_name: username.value,
		u_password: password.value,
		u_rol: "cliente",
		action: "login",
	};

	let xhr = new XMLHttpRequest();

	xhr.open("POST", "./php/server.php");

	xhr.send(JSON.stringify(user));

	xhr.onload = function () {
		if (xhr.status != 200) {
			alert(`Error ${xhr.status}: ${xhr.statusText}`);
		} else {
			let respuesta = JSON.parse(xhr.response);
			if (respuesta == false) {
				mensaje.style.color = "red";
				mensaje.innerHTML = "*El usuario o contraseña son invalidos.";
			} else {
				mensaje.style.color = "green";
				mensaje.innerHTML = "Iniciando session";

				home_content.style.display = "block";
				login_content.style.display = "none";
				register_content.style.display = "none";
                setCookie("rol",user.u_name+" es "+user.u_rol);
			}
		}
	};
}

function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue +";path=/";
}
