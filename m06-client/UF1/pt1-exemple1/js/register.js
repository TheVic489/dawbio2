/* REGISTER.JS
 * =====================================================
 * All the registration functionalities unique for the registration process.
 * */


/* Activates the blur event on the given inputID, then
/* calls the validateCallback function the get 
/* and check the value in the corresponding input field.
/* @param inputID          => The ID of the <input> html element.
/* @param validateCallback => The callback validation function corresponding to the <input>.
/* @return Void => On the blur event calls the validation function.
**/
function activateBlur(inputID, validateCallback) {
  document.querySelector(`#${inputID}`).addEventListener("blur", function () {
    validateCallback(inputID);
  });
}

/* Validates that the username only contains allowed characters.
/* @return  => Boolean 
 * (Displays validation message if correct => None, if incorrect => String.)
 */
function validateUsername() {
  let resultBool = true;

  const inputValue = document.querySelector(`#register-username`).value;
  const errorField = document.querySelector("#register-username-error");

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

/* Validates that the fullName only contains allowed characters.
/* @return  => Boolean 
 * (Displays validation message if correct => None, if incorrect => String.)
 */
function validateFullname() {
  let resultBool = true;

  const inputValue = document.querySelector(`#register-fullname`).value;
  const errorField = document.querySelector("#register-fullname-error");

  if (inputValue == "") {
    errorField.textContent = "* Empty fullname field.";
    resultBool = false;
  } else if (/^([A-zÁ-ú ]*)$/i.test(inputValue)) {
    errorField.textContent = "";
  } else {
    errorField.textContent = "* Fullname can contain only letters.";
    resultBool = false;
  }
  return resultBool;
}

/* Validates that the password. Min. 8 chars with min. 1x-1x letter and number.
 * @return  => Boolean
 * (Displays validation message if correct => None, if incorrect => String.)
 */
function validatePassword() {
  let resultBool = true;

  const inputValue = document.querySelector(`#register-password`).value;
  const errorField = document.querySelector("#register-password-error");

  const passwdRegEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

  if (inputValue == "") {
    errorField.textContent = "* Empty password field.";
    resultBool = false;
  } else if (passwdRegEx.test(inputValue)) {
    errorField.textContent = "";
  } else {
    errorField.textContent = `* Must be min. eight characters, 
                                    at least one letter and one number.`;
    resultBool = false;
  }
  return resultBool;
}

/* Validates the "repeat password" field.
 * Must match with the first password field.
 * return  => Boolean and displays validation message if correct => None, if incorrect => String.
 */
function validateRepeatedPassword() {
  let resultBool = true;

  const passwdValue = document.querySelector(`#register-password`).value;
  const inputValue = document.querySelector(`#register-repeat-password`).value;
  const errorField = document.querySelector("#register-repeat-password-error");

  if (inputValue == "") {
    errorField.textContent = "* Repeat password field cannot be empty. ";
    resultBool = false;
  } else if (inputValue != passwdValue) {
    errorField.textContent =
      "* Repeated password must match with the first one.";
    resultBool = false;
  } else {
    errorField.textContent = "";
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
  // Now send the object as json to the php server ("./php/server.php")
  let xhr = new XMLHttpRequest();

  // Open the connection. @param1 -> 'GET' / 'POST'.
  xhr.open("POST", "./php/models/register.php");

  // Sending the datas as converted string, not a object.
  xhr.send(JSON.stringify(objectToSend));

  xhr.onload = function () {
    if (xhr.status != 200) {
      alert(`Error ${xhr.status}: ${xhr.statusText}`);
    } else {
      // xhr.response is a JSON sent by the PHP server.
      let responseServer = JSON.parse(xhr.response);
        console.log(responseServer);
      document.querySelector(".register-response").innerHTML = responseServer;
    }
  };
}

/* Activates the event listener on the login button.
 * If event happens, gets the input from the form fields
 * and calls the "sendRequest" function with it.
 * @return Void
 * */
function activateRegisterButton() {
  document.querySelector("#register-button").addEventListener("click", () => {
    let fullName = document.getElementById("register-fullname").value;
    let userName = document.getElementById("register-username").value;
    let password = document.getElementById("register-password").value;

    let user = {
      option: "register",
      fullName: fullName,
      userName: userName,
      password: password
    };

    // Now send the object as json to the php server ("./php/server.php")
    sendRequest(user);
  });
}

/* Activates the register tab functionalities.
 * @return Void
 * */
export function activateRegisterTab() {
  activateBlur("register-fullname", validateFullname);
  activateBlur("register-username", validateUsername);
  activateBlur("register-password", validatePassword);
  activateBlur("register-repeat-password", validateRepeatedPassword);

  activateRegisterButton();
}
