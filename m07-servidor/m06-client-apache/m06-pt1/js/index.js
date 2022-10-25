// FUNCTIONS //

// Function to validate if str only letter      
function onlyLetters(str) {
  return /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/.test(str);
}
// Function to validate password
function onlyLettersAndNumbers(str) {
  return /^[A-Za-z0-9]*$/.test(str);
}
function checkPassword (password, rPassword) {
  pswMatch = (password == rPassword) 
  return (pswMatch && password.length >= 8)
}


document.addEventListener('DOMContentLoaded', function () {

  //Desaparecer al cargar
  document.getElementById("formRegister").style.display = "None" 
  document.getElementById("logout").style.display = "None" 

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
  const dia = myDia();
  function myDia() {
    const year  = new Date().getFullYear();
    const month = new Date().getMonth()+1;
    const day   = new Date().getUTCDate();    
    document.getElementById("dia").innerHTML = day +"-"+  month +"-"+year;
    console.log(day);
  }
  
  // Funció per aconseguir la hora actual
  setInterval(myTimer);
  function myTimer() {
    const d = new Date();
    document.getElementById("timer").innerHTML = d.toLocaleTimeString();
  }

  
  ///////Comunicació amb el servidor
  
  /// Login
  document.getElementById("login").addEventListener("click", function () {
    var name = document.getElementById("myUsername").value;
    var psw  = document.getElementById("myPassword").value;

    let user = { //objecte
      username: name,
      password: psw,
      action  : "login"
    };
    //enviar aquest objecte al servidor:
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/server.php");//obrir connexio
    xhr.send(JSON.stringify(user));//enviament de dades: objeto a JSON antes del envio
    xhr.onload = function () {//esperar a rebre dades
      let responseServer = JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
      document.getElementById("response").innerHTML = responseServer; //Mostrem resposta del servidor

      // If login success. (response server gives "client")
      if ( responseServer[1].includes("client") ) {
        document.cookie = `username = ${user.username}, rol = client`;  // Creates the cookie
        document.getElementById("BtsAndLogin").style.display = "None";
        document.getElementById("logout").style.display   = "block";



        }

    }
  }

  );


  //// Register
  document.getElementById("register").addEventListener("click" , function() {
    var fullName  = document.getElementById("myFullName").value;
    var userName  = document.getElementById("myNewUsername").value;
    var password  = document.getElementById("myNewPassword").value;
    var rPassword = document.getElementById("myNewPasswordRepeat").value;

    // check correct format for register form
    if (onlyLetters(fullName) && onlyLetters(userName) && onlyLettersAndNumbers(password) && checkPassword(password, rPassword)) {  
      document.getElementById("registerResponse").innerHTML = "Success"
      
      let newUser = {         //objecte NewUser
        nomComplet : fullName,
        newUserName : userName,
        newPsw : password,
        action : "register"
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

});