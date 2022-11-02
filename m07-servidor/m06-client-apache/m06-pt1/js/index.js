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

function validaEmail(value){
  const expRegEmail=/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
  if (expRegEmail.test(value) == true)  {
      return true; // Correcto
  }else{
      return false;// Error
  }
}

function validaDni(rawDni){
     
  dni = rawDni.toUpperCase();
  // Separte numbers and letter
  numberDni  = dni.substr(0, dni.length -1);
  letterDni  = dni.substr(dni.length -1, dni.length);

  // Get module from numbers, and gets the letter 
  resto   = numberDni % 23;
  letters = 'TRWAGMYFPDXBNJZSQVHLCKET';
  letter  = letters.charAt(resto)
  //letter  = letters[resto]
  
  // Check if number is number and letter is letter
  if (isNaN(numberDni) && !isNaN(letterDni)) {
      document.getElementById("errorD").innerHTML = 'formato de DNI erroneo';
  } else {
      // Check if the letter introduced match with calculated one
      if (letterDni != letter || dni.length != 9) {
          document.getElementById("errorD").innerHTML = 'formato de DNI erroneo';
      } else {
          return true;
     }
  }
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
var HORAS_DE_SALIDA = {
  "dilluns" : ["8:00", "17:00"],
  "divendres" : ["7:00", "19:30"],
  "dissapte" : ["14:00"],
};
// Gets de array of the arrive time of selected fly
// NO funcoin
function getBcnMdz() {

  // New request
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./php/bcn_mdz.php");// obrir connexio, method=GET
  xhr.send();//enviament de dades: objeto a JSON antes del envio
  xhr.onload = function () {//esperar a rebre dades
    let responseServerArray = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
    var dilluns_arribada   = responseServerArray[0];
    var divendres_arribada = responseServerArray[1];
    var dissapte_arribada  = responseServerArray[2];
    
    var preu  = responseServerArray['Preu'];

    var dilluns_sortida   = HORAS_DE_SALIDA["dilluns"];
    var divendres_sortida = HORAS_DE_SALIDA["divendres"];
    var dissapte_sortida  = HORAS_DE_SALIDA["dissapte"];
    
    document.getElementById("vueloTitulo").innerHTML = "Barcelona - Madrid";

    document.getElementById("bmdilluns1").innerHTML = "Hora de sortida: " + dilluns_sortida[0] + " -  Hora de arribada: " +  dilluns_arribada[0] + "<br>"; 
    document.getElementById("bmdilluns2").innerHTML = "Hora de sortida: " + dilluns_sortida[1] + " -  Hora de arribada: " +  dilluns_arribada[1] + "<br>"; 

    document.getElementById("bmdivendres1").innerHTML = "Hora de sortida: " + divendres_sortida[0] + " -  Hora de arribada: " +  divendres_arribada[0] + "<br>"; 
    document.getElementById("bmdivendres2").innerHTML = "Hora de sortida: " + divendres_sortida[1] + " -  Hora de arribada: " +  divendres_arribada[1] + "<br>";  

    document.getElementById("bmdissapte").innerHTML = "Hora de sortida: " + dissapte_sortida[0] + " -  Hora de arribada: " +  dissapte_arribada[0] + "<br>"; 
    document.getElementById("preu").innerHTML = "Preu: " + preu + "€";

  }
}   

function getBcnVlc() {

  // New request
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./php/bcn_vlc.php");// obrir connexio, method=GET
  xhr.send();//enviament de dades: objeto a JSON antes del envio
  xhr.onload = function () {//esperar a rebre dades
    let responseServerArray = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
    var dilluns_arribada   = responseServerArray[0];
    var divendres_arribada = responseServerArray[1];
    var dissapte_arribada  = responseServerArray[2];
    
    var preu  = responseServerArray['Preu'];

    var dilluns_sortida   = HORAS_DE_SALIDA["dilluns"];
    var divendres_sortida = HORAS_DE_SALIDA["divendres"];
    var dissapte_sortida  = HORAS_DE_SALIDA["dissapte"];
    
    document.getElementById("vueloTitulo").innerHTML = "Barcelona - Valencia";

    document.getElementById("bmdilluns1").innerHTML = "Hora de sortida: " + dilluns_sortida[0] + " -  Hora de arribada: " +  dilluns_arribada[0] + "<br>"; 
    document.getElementById("bmdilluns2").innerHTML = "Hora de sortida: " + dilluns_sortida[1] + " -  Hora de arribada: " +  dilluns_arribada[1] + "<br>"; 

    document.getElementById("bmdivendres1").innerHTML = "Hora de sortida: " + divendres_sortida[0] + " -  Hora de arribada: " +  divendres_arribada[0] + "<br>"; 
    document.getElementById("bmdivendres2").innerHTML = "Hora de sortida: " + divendres_sortida[1] + " -  Hora de arribada: " +  divendres_arribada[1] + "<br>";  

    document.getElementById("bmdissapte").innerHTML = "Hora de sortida: " + dissapte_sortida[0] + " -  Hora de arribada: " +  dissapte_arribada[0] + "<br>"; 
    document.getElementById("preu").innerHTML = "Preu: " + preu + "€";

  }
}  

function getMdzVlc() {

  // New request
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "./php/mdz_vlc.php");// obrir connexio, method=GET
  xhr.send();//enviament de dades: objeto a JSON antes del envio
  xhr.onload = function () {//esperar a rebre dades
    let responseServerArray = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
    var dilluns_arribada   = responseServerArray[0];
    var divendres_arribada = responseServerArray[1];
    var dissapte_arribada  = responseServerArray[2];
    
    var preu  = responseServerArray['Preu'];

    var dilluns_sortida   = HORAS_DE_SALIDA["dilluns"];
    var divendres_sortida = HORAS_DE_SALIDA["divendres"];
    var dissapte_sortida  = HORAS_DE_SALIDA["dissapte"];
    
    document.getElementById("vueloTitulo").innerHTML = "Madrid - València";

    document.getElementById("bmdilluns1").innerHTML = "Hora de sortida: " + dilluns_sortida[0] + " -  Hora de arribada: " +  dilluns_arribada[0] + "<br>"; 
    document.getElementById("bmdilluns2").innerHTML = "Hora de sortida: " + dilluns_sortida[1] + " -  Hora de arribada: " +  dilluns_arribada[1] + "<br>"; 

    document.getElementById("bmdivendres1").innerHTML = "Hora de sortida: " + divendres_sortida[0] + " -  Hora de arribada: " +  divendres_arribada[0] + "<br>"; 
    document.getElementById("bmdivendres2").innerHTML = "Hora de sortida: " + divendres_sortida[1] + " -  Hora de arribada: " +  divendres_arribada[1] + "<br>";  

    document.getElementById("bmdissapte").innerHTML = "Hora de sortida: " + dissapte_sortida[0] + " -  Hora de arribada: " +  dissapte_arribada[0] + "<br>"; 
    document.getElementById("preu").innerHTML = "Preu: " + preu + "€";

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
        document.getElementById("seleccioVolsDiv").style.display = "None";
        document.getElementById("dades").style.display = "None";
        
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

    var origenOption   = document.getElementById('origen').value;
    var destinoOption  = document.getElementById('destino').value;

  if (origenOption == 'Barcelona' && destinoOption == 'Madrid') {
    document.getElementById("divBuscarVols").style.display = "None";
    document.getElementById("seleccioVolsDiv").style.display = "block";

    getBcnMdz()
  }else if (origenOption == 'Barcelona' && destinoOption == 'València') {
    document.getElementById("divBuscarVols").style.display = "None";
    document.getElementById("seleccioVolsDiv").style.display = "block";

    getBcnVlc()
  }else if (origenOption == 'Madrid' && destinoOption == 'València') {
    document.getElementById("divBuscarVols").style.display = "None";
    document.getElementById("seleccioVolsDiv").style.display = "block";

    getMdzVlc()
  }else {
    document.getElementById("error").innerHTML = "No hi han vols disponibles per als destins seleccionats";
  }
} );

  ///////////////////////  RESERVA - DADES PERSONALS /////////////////////
  document.getElementById("dades").style.display = "None";

  document.getElementById("preu").addEventListener("click", function () {
    document.getElementById("seleccioVolsDiv").style.display = "None";
    document.getElementById("dades").style.display = "block";

     // Validar email on blur
     document.getElementById("tuEmail").addEventListener("blur", function () {
        
      myEmail = document.getElementById("tuEmail").value;
      
      var validateEmail = validaEmail(myEmail); // Valido

      if (validateEmail == false) {
          document.getElementById("errorE").innerHTML = "Email inválido"
      }
   })
   document.getElementById("tuEmail").addEventListener("focus", function () {

      document.getElementById("errorE").innerHTML = "";
   })


   //Validar dni on blur
   document.getElementById("tuDni").addEventListener("blur", function () {
      
      myDni = d.getElementById("tuDni").value;
      
      var validateDni = validaDni(myDni); // Valido

      if (validateDni == false) {
          document.getElementById("errorD").innerHTML = "Dni inválido"
      }
   })
   document.getElementById("tuDni").addEventListener("focus", function () {

      document.getElementById("errorD").innerHTML = "";
   })
    
    
   document.getElementById("form").addEventListener("mouseover", function() {
    var errorE  = document.getElementById("errorE").innerHTML;
    var errorD  = document.getElementById("errorD").innerHTML;

    if (errorD === "" && errorE === "") {
        document.getElementById("btContinuar").disabled = false;
    }else{
        document.getElementById("btContinuar").disabled = true;
    }
    })
     // Pagina final 
    document.getElementById("btContinuar").addEventListener("click", function () {
    location.href="./final.html";

    // No he acoseguit que magafi les ids del altre fitcher html
    var name = document.getElementById("myUsername").value;
     document.getElementById("tuNombre").innerHTML = name;

    var myDni = document.getElementById("tuDni").value;
     document.getElementById("tuDNI").innerHTML = myDni;

    var myEmail = document.getElementById("tuEmail").value;
     document.getElementById("tuCorreo").innerHTML = myEmail;

    var myNum = document.getElementById("tuNum").value;
     document.getElementById("tuNumero").innerHTML = myNum;

    var volSeleccionat = document.getElementById("vueloTitulo").value;
     document.getElementById("volSeleccionat").innerHTML = volSeleccionat;

    var preu = document.getElementById("preu").value;
     document.getElementById("aPagar").innerHTML = preu;
    });



})



});