/* LOGIN.JS
 * =====================================================
 * All the login functionalities unique for the login process.
 * */


/* Activates the blur event on the given inputID, then
/* calls the validateCallback function the get 
/* and check the value in the corresponding input field.
/* @param  inputID          => The ID of the <input> html element.
/* @param  validateCallback => The callback validation function corresponding to the <input>.
/* @return Void => On the blur event calls the validation function. 
 * */
function activateBlur(inputID, validateCallback) {
  document.querySelector(`#${inputID}`).addEventListener("blur", function () {
    validateCallback(inputID);
  });
}

/* Validates that the username only contains allowed characters.
/* @return Bool
 * (Displays validation message if correct => None, if incorrect => String.)
/**/
function validateUsername() {
  let resultBool = true;

  const inputValue = document.querySelector(`#login-username`).value;
  const errorField = document.querySelector("#login-username-error");

  if (inputValue == "") {
    errorField.textContent = "* Empty username field.";
    resultBool = false;
  } else if (/^([A-zÁ-ú ]*)$/i.test(inputValue)) {
    errorField.textContent = "";
  } else {
    errorField.textContent = "* Username can contain only letters. ";
    resultBool = false;
  }

  return resultBool;
}

/* Validates that the username only contains allowed characters.
/* @return Bool
 * (Displays validation message if correct => None, if incorrect => String.)
/**/
function checkIfEmptyPassword() {
  let resultBool = true;

  const inputValue = document.querySelector(`#login-password`).value;
  const errorField = document.querySelector("#login-password-error");

  if (inputValue == "") {
    errorField.textContent = "* Empty password field.";
    resultBool = false;
  }

  return resultBool;
}

/* Sends POST request to the login model on the back-end.
 * If server returns "responseServer.responseBool" true,
 * then the page logs in. If not error message.
 * @param objectToSend object The prepared json with the credentials obtained from the user.
 * @return Void (Initializes log in.)
 **/
function sendRequest(objectToSend) {
  // Now send the object as json to the php server.
  const xhr = new XMLHttpRequest();

  xhr.open("POST", "./php/models/login.php");
  xhr.send(JSON.stringify(objectToSend));

  xhr.onload = function () {
    if (xhr.status != 200) {
      alert(`Error ${xhr.status}: ${xhr.statusText}`);
    } else {
      const responseServer = JSON.parse(xhr.response);

      if (responseServer["responseBool"] == true) {
        sessionStorage['username'] = responseServer['username'];
        sessionStorage['fullName'] = responseServer['fullName'];
        initAfterLogin();
      }
    }
  };
}

// Extended setCookie function for later, if needed. Don't delete.
/* function setCookie(cname, cvalue, exdays) {

  const date= new Date();
  date.setTime(date.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ date.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
} */

/* Sets cookie on the client, if logged in.
 * @param cname  string Name of the cookie.
 * @param cvalue string Value for the cookie.
 * @return Void
 * */
function setSessionCookie(cname, cvalue) {
  document.cookie = cname + "=" + cvalue + "; path=/";
}

/* Activates the event listener on the login button.
 * If event happens, gets the input from the form fields
 * and calls the "sendRequest" function with it.
 * @return Void
 * */
function activateLoginButton() {
  document
    .querySelector("#login-button")
    .addEventListener("click", async () => {
      let userName = document.getElementById("login-username").value;
      let password = document.getElementById("login-password").value;

      let user = {
        option: "login",
        userName: userName,
        password: password,
      };

      // Now send the object as json to the php server ("./php/server.php")
      sendRequest(user);
    });
}

/* Set the login cookie on the client
 * and redirect the client to "./scheduleSearch.html".
 * @return Void
 * */
export function initAfterLogin() {
  setSessionCookie("loggedIn", "true");
  window.open("./scheduleSearch.html", "_self");
}

/* Activates the login tab functionalities.
 * @return Void
 * */
export function activateLoginTab() {
  activateBlur("login-username", validateUsername);
  activateBlur("login-password", checkIfEmptyPassword);
  activateLoginButton();
}
