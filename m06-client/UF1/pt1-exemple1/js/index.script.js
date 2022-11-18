/* INDEX.SCRIPT.JS
 * =====================================================
 * All the index page functionalities unique for the "index.html" page.
 * */
import { activateLoginTab } from "./login.js";
import { activateRegisterTab } from "./register.js";
import { observeCookie } from "./session_handler.js";

/* Removes from all the forms the '.active-tab' class, so they stay hidden.
 * @return Void => Mutates the ".tab-button" element.
 * */
function removeActiveTabClass() {
  let tabButtons = document.querySelectorAll(".tab-button");
  Array.from(tabButtons).forEach((btn) => {
    btn.classList.remove("selected-tab-button");
  });

  let forms = document.querySelectorAll(".form");

  Array.from(forms).forEach((e) => {
    e.classList.remove("active-tab");
  });
}

/* Activates the event listeners on the option buttons (login or register).
 * @return Void => Mutates the ".login-form / .register-form" elements.
 * */
function activateOptionButtons() {
  let loginButton = document.querySelector("#login-option");
  let registerButton = document.querySelector("#register-option");

  let loginForm = document.querySelector(".login-form");
  let registerForm = document.querySelector(".register-form");

  // Event listener for the login button.
  loginButton.addEventListener("click", () => {
    removeActiveTabClass();
    loginButton.classList.add("selected-tab-button");
    loginForm.classList.add("active-tab");
  });

  // Event listener for the register button.
  registerButton.addEventListener("click", () => {
    removeActiveTabClass();
    registerButton.classList.add("selected-tab-button");
    registerForm.classList.add("active-tab");
  });
}

/* Main function.
 * Initializes all the functionality of the index page.
 * @return Void
 * */
function main() {
  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form").forEach((f) => f.reset());
    observeCookie();
    activateOptionButtons();

    activateLoginTab();
    activateRegisterTab();
  });
}

console.log(document.querySelector('#login-button'));

// Calling main.
main();
