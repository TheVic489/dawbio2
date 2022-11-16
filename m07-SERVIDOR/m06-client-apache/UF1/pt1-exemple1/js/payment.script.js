/* PAYMENT.SCRIPT.JS
 * =====================================================
 * All the payment functionalities unique for the "payment.html" page.
 * */

import { getCookie } from "./session_handler.js";
import { activateLogOutButton } from "./session_handler.js";

// GENERAL FUNCTIONS
// ============================================================

/* Gets the field value on the given identifier.
 * @param inputID string => The ID of the <input> html element.
 * @return string  => Gets the input value from the queried input field.
**/
function getInputFieldValue(inputID){

    return document.querySelector(`#${inputID}`).value;
}

/* Activate blur event on all the input fields.
 * If out focus from the field. the corresponding validation 
 * function will be called.
 * @param inputID          => The ID of the <input> html element.
 * @param validateCallback => The callback validation function corresponding to the <input>.
 * @return  => On the blur event calls the validation function.
 */
function activateBlur(inputID, validateCallback){
    document.querySelector(`#${inputID}`).addEventListener("blur", function() {
        validateCallback(inputID);
    });
}

/* Fetches the first name and last name into the input fields from the sessionStorage.
 * @return Void
 * */
function fetchNames(){
    document.querySelector('#fullName').value = sessionStorage['fullName'];
}

// LAST NAME FUNCTIONS
// ============================================================

/* Validates the full name against any number or special char.
 * @return  => Boolean and displays validation message if correct => None, if incorrect => String.
 * */
function validateFullName(){

    let resultBool = true;

    const inputValue = getInputFieldValue('fullName');
    const errorField = document.querySelector('.fullName-error');

    if (inputValue == ''){
        errorField.textContent = "* Empty full name field.";
        resultBool = false;
    } else if(/^([A-zÁ-ú ]*)$/i.test(inputValue)){
        errorField.textContent = "";
    } else {
        errorField.textContent = "* Full name cannot contain special characters or numbers. Only letter. ";
        resultBool = false;
    }

    return resultBool;
}

// EMAIL FUNCTIONS
// ============================================================

/* Validates the email against any number or special char.
 * @return  => Boolean and displays validation message if correct => None, if incorrect => String.
 * */
function validateEmail(){

    let resultBool = true;

    const inputValue = getInputFieldValue('email');
    const errorField = document.querySelector('.email-error');

    var regexEmail = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
    if (inputValue == ''){
        errorField.textContent = "* Empty DNI field.";
        resultBool = false;

    } else if(regexEmail.test(inputValue)){
        errorField.textContent = "";
    } else {
        errorField.textContent = "* Invalid email format. Valid email example: \"name_name@gmail.com\"";
        resultBool = false;
    }

    return resultBool;
}

// DNI FUNCTIONS
// ============================================================

/* Validates the last digit of the DNI correspondingly to the spanish convention.
 * @inputDNI string
 * @return Bool
 * */
function validateDNIDigits(inputDNI){

    let DNIDigit  = parseInt(inputDNI.substr(0,8));
    let DNILetter = inputDNI.substr(inputDNI.length - 1);
    let residue   = DNIDigit % 23;

    let correspondingLetter = {'T': 0, 'R': 1, 'W': 2, 'A': 3, 
                               'G': 4, 'M': 5, 'Y': 6, 'F': 7, 
                               'P': 8, 'D': 9, 'X': 10, 'B': 11,
                               'N': 12, 'J': 13, 'Z': 14, 'S': 15,
                               'Q': 16, 'V': 17, 'H': 18, 'L': 19,
                               'C': 20, 'K': 21, 'E': 22};

    var result_bool = false;
    Object.keys(correspondingLetter).forEach(function(e){
        if (eval(`correspondingLetter.${e}`) == residue &&
            e == (DNILetter.toUpperCase())){
            result_bool = true;
        }
    })
    return result_bool;
}


/* Validates the DNI correspondingly to the spanish convention.
 * @return Boolean and displays validation message if correct => None, if incorrect => String.
 * */
function validateDNI(){

    let resultBool = true;

    const inputValue = getInputFieldValue('dni');
    const errorField = document.querySelector('.dni-error');

    let validDNIRegex = /^\d{8}[a-zA-Z]$/;

    if (inputValue == ''){
        errorField.textContent = "* Empty DNI field.";
        resultBool = false;
    } else if (inputValue.length != 9){
        errorField.textContent = "The length of the given DNI is incorrect.";
        resultBool = false;
    } else if (!validDNIRegex.test(inputValue)){
        errorField.textContent = "The DNI format is incorrect. See example: \"12345678Z\"";
        resultBool = false;
    } else if (!validateDNIDigits(inputValue)){
        errorField.textContent = "The last letter of the DNI is incorrect.";
        resultBool = false;
    } else {
        errorField.textContent = "";
    }

    return resultBool;
}


/* Validates the phone number against the most common phone number formats.
 * @return  => Boolean and displays validation message if correct => None, if incorrect => String.
 * */
// PHONE NUMBER FUNCTIONS
// ============================================================
function validatePhoneNumber(){
    let resultBool = true;

    const inputValue = document.getElementById('textarea');
    const errorField = document.querySelector('.textarea-error');

    const validPhoneNumberRegEx = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;

    if (inputValue == ''){
        errorField.textContent = "* Empty phone number field.";
        resultBool = false;
    } else if (!validPhoneNumberRegEx.test(inputValue)){
        errorField.textContent = "The phone number is incorrect.";
        resultBool = false;
    } else {
        errorField.textContent = "";
    }

    return resultBool;
}


// SUBMIT FUNCTION
// ============================================================



/* On submit event re-runs the validations for the last time.
 * @return boolean.
 */
function postValidateOnSubmit(){

    let resultBool = true;
    if(!validateFullName()  ||
       !validateEmail()     ||
       !validateDNI()       ||
       !validatePhoneNumber() 
       ){
    
        resultBool = false;
    }
    return resultBool;
}

/* Capitalizes all the words in a string.
 * @return string The capitalized string.
 * */
function capitalizeWords(str) {
// Capitalizes all the words in the string.
// Return <string> => All words capitalized.

    let strArr = str.split(" ");
    for (let i = 0; i < strArr.length; i++) {
        strArr[i] = strArr[i][0].toUpperCase() + strArr[i].substr(1);
    }

    return strArr.join(" ");
}


/* Is called on submit. 
 * Collect the datas of the input fields and saves them 
 * into the sessionStorage.
 * @return Void
 * */
function saveFieldsIntoSession(){
// Return => Display (pretty-prints) the results of the form.
    const inputFields = document.querySelectorAll('input');
    const resultField = document.querySelector('.result-wrapper');
    

    inputFields.forEach((e) => {
        
        if (e.attributes.id.value == 'fullName'){
            sessionStorage['fullName']= capitalizeWords(e.value);

        } else if (e.attributes.id.value == 'email'){
            sessionStorage['email']= capitalizeWords(e.value);

        } else if (e.attributes.id.value == 'dni'){
            sessionStorage['dni']= capitalizeWords(e.value);

        } else if (e.attributes.id.value == 'phone-number'){
            sessionStorage['phoneNumber']= capitalizeWords(e.value);
        }

        });

    sessionStorage['paymentDone'] = true;
    console.log(sessionStorage);
}


/* On click calls the "saveFieldsIntoSession" function and 
 * redirects the user to the "billing.html" page.
 * @return Void
 * */
function activateSubmitButton(){
// Activates the submit button's event.

    const submitButton = document.querySelector('#submitButton');

    submitButton.addEventListener('click', (event)=>{
        event.preventDefault();

        if (postValidateOnSubmit()){
            saveFieldsIntoSession();
            window.open('./billing.html', '_self');
        }
    })
}


/* Initializes the payment page functionality.
 * @return Void
 * */
function initPayment() {
  if (getCookie("loggedIn")) {

    document.body.style.display = "initial";

    activateLogOutButton();

    fetchNames();
    activateBlur('fullName',  validateFullName);
    activateBlur('email', validateEmail);
    activateBlur('dni', validateDNI);
    activateBlur('phone-number', validatePhoneNumber);
    activateSubmitButton();

  } else {
    // If not logged in, then throw the user back to index.html.
    window.open('./index.html', '_self');
  }
}

// Call main.
initPayment();
