// FUNCTIONS //

// Function to validate if str only letter
function onlyLetters(str) {
	return /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/.test(str);
}
// Function to validate password
function onlyNumbers(str) {
	return /^[0-9]*$/.test(str);
}
function checkPassword(password, rPassword) {
	pswMatch = password == rPassword;
	return pswMatch && password.length >= 8;
}

// Add x months into the date
function addMonths(date, months) {
	var d = date.getDate();
	date.setMonth(date.getMonth() + +months);
	if (date.getDate() != d) {
		date.setDate(0);
	}
	return date;
}

function currentDate() {
	const year = new Date().getFullYear();
	const month = new Date().getMonth() + 1;
	const day = new Date().getUTCDate();
	const date= year + "-" + month + "-" + day;
  return date
}

function currentDateToFormat(date) {
	const year = date.getFullYear();
	const month = date.getMonth() + 1;
	const day = date.getUTCDate();

	return year + "-" + month + "-" + day;
}

function ubicacioOutput() {
	// New request
	let xhr = new XMLHttpRequest();
	xhr.open("GET", "./php/get_ubi.php"); // obrir connexio, method=GET
	xhr.send(); //enviament de dades: objeto a JSON antes del envio
	xhr.onload = function () {
		//esperar a rebre dades
		let responseServer = JSON.parse(xhr.response); //reconvertirlo/parsearlo a variable JS

		for (let i = 0; i < responseServer.length; i++) {
			var node = document.createElement("option");
			node.innerHTML = responseServer[i];
			node.value = responseServer[i];
			document.getElementById("ubi").appendChild(node);
		}
	};
}

function espaiOutput() {
	// New request
	let xhr = new XMLHttpRequest();
	xhr.open("GET", "./php/get_espai.php"); // obrir connexio, method=GET
	xhr.send(); //enviament de dades: objeto a JSON antes del envio
	xhr.onload = function () {
		//esperar a rebre dades
		let responseServer = JSON.parse(xhr.response); //reconvertirlo/parsearlo a variable JS

		for (let i = 0; i < responseServer.length; i++) {
			var node = document.createElement("option");
			node.innerHTML = responseServer[i];
			node.value = responseServer[i];
			document.getElementById("espai").appendChild(node);
		}
	};
}
// cecck on blur
function checkIdInventory(identifier) {
  var validation1 = false;
  var validation2 = false;
  var validation3 = false;

  var first4letters = identifier.substr(0, 4);
  var dosPunts      = identifier.charAt(4);
  console.log(dosPunts)
  var last3chars    = identifier.charAt(6, 8);

  if (onlyLetters(first4letters)) {
     validation1 = true;
  } else {
    document.getElementById("errorID").innerHTML = "Els primers 4 valors han de ser lletres"
  }

  if (dosPunts == ":") {
    validation2 = true;
  } else {
    document.getElementById("errorIDdospunts").innerHTML = "El cinquè valor han de ser dos punts"
  }


  if (onlyNumbers(last3chars)) {
    validation3 = true;
  } else {
    document.getElementById("errorID3last").innerHTML = "Els tres ultims valors han de ser numeros"
  }

  if (validation1 && validation2 && validation3) {
    document.getElementById("IDok").innerHTML = "Ok"
    return true
  } else {
    return false
  }
}

function validatePhoneNumber(){
  let resultBool = true;

  const inputValue = document.getElementById('telefon').value;
  const errorField = document.getElementById('tel-error');

  const validPhoneNumberRegEx = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;

  if (inputValue == ''){
      errorField.innerHTML = "* Empty phone number field.";
      resultBool = false;
  } else if (!validPhoneNumberRegEx.test(inputValue)){
      errorField.innerHTML = "The phone number is incorrect.";
      resultBool = false;
  } else {
      errorField.innerHTML = "";
  }

  return resultBool;
}

function validateEmail(){

  let resultBool = true;

  const inputValue = document.getElementById('email').value;
  const errorField = document.getElementById('email-error');

  var regexEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
  if (inputValue == ''){
      errorField.innerHTML = "* Empty Mail field.";
      resultBool = false;

  } else if(regexEmail.test(inputValue)){
      errorField.innerHTML = "";
  } else {
      errorField.innerHTML = "* Invalid email format. Valid email example: \"name_name@gmail.com\"";
      resultBool = false;
  }

  return resultBool;
}

function validateTextArea() {
  resultBool = true;

  const inputValue = document.getElementById('textarea').value;
  const errorField = document.getElementById('textarea-error');

  if (inputValue == '') {
    errorField.innerHTML= "* Empty Description.";
    resultBool = false;
  }

  return resultBool
}

// Main code
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("form2").style.display = "None"
  document.getElementById("btNotifica").disabled = true;
  //Peticions al servidor (ubicacio y espai)//
  ubicacioOutput()
  espaiOutput()

  // Validar ID on blur, si es correcte, activa el boto de notificar
  document.getElementById("myId").addEventListener("blur", function () {
    var myID = document.getElementById("myId").value;
    validate = checkIdInventory(myID);
    if (validate) {
      document.getElementById("btNotifica").disabled = false;
    }
  });

  //Desaparecer al cargar
	document.getElementById("btNotifica").addEventListener("click", function () {
    document.getElementById("form1").style.display = "None"
    document.getElementById("form2").style.display = "block"

  });

	document.getElementById("btEnvia").addEventListener("click", function () {

  });

  
  
  document.getElementById("textarea").addEventListener("blur", function () {
    validateTextArea()
  });

  document.getElementById("telefon").addEventListener("blur", function () {
    validatePhoneNumber()
  });

  document.getElementById("email").addEventListener("blur", function () {
    validateEmail()
  });

  // Max date for input date
  var currentDay = currentDate();
  console.log(currentDay);
  document.getElementById("data").max = currentDay;
});
