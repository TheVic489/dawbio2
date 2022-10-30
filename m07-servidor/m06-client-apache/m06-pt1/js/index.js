// FUNCTIONS //

// Function to validate if str only letter      
function onlyLetters(str) {
  return /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/.test(str);
}
// Function to validate password
function onlyLettersAndNumbers(str) {
  return /^[A-Za-z0-9]*$/.test(str);
}
function checkPassword(password, rPassword) {
  pswMatch = (password == rPassword)
  return (pswMatch && password.length >= 8)
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
  const year  = new Date().getFullYear();
  const month = new Date().getMonth() + 1;
  const day   = new Date().getUTCDate();
  document.getElementById("dia").innerHTML = year + "-" + month + "-" + day;
}

function currentDateToFormat(date) {
  const year  = date.getFullYear();
  const month = date.getMonth() + 1;
  const day   = date.getUTCDate();

  return year + "-" + month + "-" + day;
}

function volsOutput() {
  // New request
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./php/buscar_vols.php");// obrir connexio, method=GET
  xhr.send();//enviament de dades: objeto a JSON antes del envio
  xhr.onload = function () {//esperar a rebre dades
    let responseServer = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS

    for (let i = 0; i < responseServer.length; i++) {
      var node = document.createElement("option");
      node.innerHTML = responseServer[i];
      node.value     = responseServer[i];
      document.getElementById("origen").appendChild(node);
    }

    for (let i = 0; i < responseServer.length; i++) {
      var node = document.createElement("option");
      node.innerHTML = responseServer[i];
      node.value     = responseServer[i];
      document.getElementById("destino").appendChild(node);
    }
  }

}
// Gets de array of the arrive time of selected fly
// NO funcoin
function getBcnMdz() {


  // New request
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./php/bcn_mdz.php");// obrir connexio, method=GET
  xhr.send();//enviament de dades: objeto a JSON antes del envio
  xhr.onload = function () {//esperar a rebre dades
    let responseServerArray = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
    console.log(responseServerArray[0][1]);
  
  }
}
// Main code
document.addEventListener('DOMContentLoaded', function () {

  //Desaparecer al cargar
  document.getElementById("formRegister").style.display = "None"
  document.getElementById("logout").style.display = "None"
  document.getElementById("divBuscarVols").style.display = "None";
  document.getElementById("seleccioVolsDiv").style.display = "None";

  // Al cliclar al login, fer desapereixar el register
  document.getElementById("btLogin").addEventListener("click", function () {
    document.getElementById("formLogin").style.display = "block";
    document.getElementById("formRegister").style.display = "None";
  })
  // Al clicar al register, fer desapareixer el login
  document.getElementById("btRegister").addEventListener("click", function () {
    document.getElementById("formRegister").style.display = "block";
    document.getElementById("formLogin").style.display = "None";
  })


  // Funcio per aconseguir la data actual
  const dia = currentDate();


  // Funció per aconseguir la hora actual
  setInterval(myTimer);
  function myTimer() {
    const now = new Date();
    document.getElementById("timer").innerHTML = now.toLocaleTimeString();
  }


  ///////Comunicació amb el servidor

  /// Login
  document.getElementById("login").addEventListener("click", function () {
    var name = document.getElementById("myUsername").value;
    var psw = document.getElementById("myPassword").value;

    let user = { //objecte
      username: name,
      password: psw,
      action: "login"
    };
    //enviar aquest objecte al servidor:
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/server.php");//obrir connexio
    xhr.send(JSON.stringify(user));//enviament de dades: objeto a JSON antes del envio
    xhr.onload = function () {//esperar a rebre dades
      let responseServer = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
      document.getElementById("response").innerHTML = responseServer; //Mostrem resposta del servidor

      // If login success. (response server gives "client")
      if (responseServer[1].includes("client")) {
        document.cookie = `username = ${user.username}`;  // Creates the cookie
        document.getElementById("ButtonsLoginRegister").style.display = "None";
        document.getElementById("formLogin").style.display = "None";
        document.getElementById("logout").style.display = "block";
        document.getElementById("divBuscarVols").style.display = "block";

      }
      // Al clickar logout, aparece de nuevo, el login, registro, vols y borra la cookie.
      document.getElementById("logout").addEventListener("click", function () {
        document.getElementById("ButtonsLoginRegister").style.display = "block";
        document.getElementById("logout").style.display = "None";
        document.getElementById("divBuscarVols").style.display = "None";
        document.cookie = "username = notexist;expires=Thu, 01 Jan 1970 00:00:00 UTC;";
      })

    }
  }
  );

  //// Register
  document.getElementById("register").addEventListener("click", function () {
    var fullName  = document.getElementById("myFullName").value;
    var userName  = document.getElementById("myNewUsername").value;
    var password  = document.getElementById("myNewPassword").value;
    var rPassword = document.getElementById("myNewPasswordRepeat").value;

    // check correct format for register form
    if (onlyLetters(fullName) && onlyLetters(userName) && onlyLettersAndNumbers(password) && checkPassword(password, rPassword)) {
      document.getElementById("registerResponse").innerHTML = "Success"

      let newUser = {         //objecte NewUser
        nomComplet: fullName,
        newUserName: userName,
        newPsw: password,
        action: "register"
      };

      //enviar aquest objecte al servidor:
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./php/server.php");//obrir connexio
      xhr.send(JSON.stringify(newUser));//enviament de dades: objeto a JSON antes del envio
      xhr.onload = function () {//esperar a rebre dades
        let responseServer = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
        document.getElementById("registerResponse").innerHTML = responseServer;
      }
    } else {
      document.getElementById("registerResponse").innerHTML = "Wrong"
    }


  });
  /// Buscar vols ///

  // Function that get destinations from php
  volsOutput()
  
  // Validate fly form

  ////////////////  Validar destino origen  //////////////////////
  document.getElementById("btBuscarVols").disabled = false;

  var origenOption   = document.getElementById('origen').value;
  var destinoOption  = document.getElementById('destino').value;
  
  if (origenOption == destinoOption) {
    document.getElementById("btBuscarVols").disabled = true
  } else {
  document.getElementById("btBuscarVols").disabled = false;
  }
  document.getElementById("btBuscarVols").disabled = true;

  // Alternativa
  destino = document.getElementById('destino').addEventListener('change', function handleChange(event) {
    var destino_value = (event.target.value); // 👉️ get selected VALUE
    document.getElementById("btBuscarVols").disabled = false;


    origen = document.getElementById('origen').addEventListener('change', function handleChange(event) {
      origen_value = (event.target.value); // 👉️ get selected VALUE
    });

    if (origen_value != destino_value) {
      document.getElementById("btBuscarVols").disabled = false;
    } else {
      document.getElementById("btBuscarVols").disabled = true;
    }

  });

  origen = document.getElementById('origen').addEventListener('change', function handleChange(event) {
    origen_value = (event.target.value); // 👉️ get selected VALUE
    document.getElementById("btBuscarVols").disabled = false;

  });
  ////////////////////////////////////////////////////////////////

  // Validar fecha ida / fecha vuelta

  // Get date plus 6 months
  maxDate = currentDateToFormat(addMonths(new Date(), 6));
  nowDate = currentDateToFormat(new Date());

  // Set max date atributes to "ida" and "vuelta"
  document.getElementById("ida").setAttribute("max", maxDate);    // L'atribut s'fageix correctament amb el format, pero no funciona en el meu cas
  document.getElementById("vuelta").setAttribute("max", maxDate); // L'atribut s'fageix correctament amb el format, pero no funciona en el meu cas

  // Set min date attribute (current date)
  document.getElementById("ida").setAttribute("min", nowDate);
  document.getElementById("vuelta").setAttribute("min", nowDate);

  ////////////////////////////////////////////////////////////////
  
  ///////////////////////  SELECCIO DE VOLS  /////////////////////
  document.getElementById("btBuscarVols").addEventListener("click", function () {
    document.getElementById("divBuscarVols").display = "None";
    document.getElementById("seleccioVolsDiv").display = "block";

    var origenOption   = document.getElementById('origen').value;
    var destinoOption  = document.getElementById('destino').value;

  if (origenOption == 'Barcelona' && destinoOption == 'Madrid') {
    getBcnMdz()
  }
  
} );

});