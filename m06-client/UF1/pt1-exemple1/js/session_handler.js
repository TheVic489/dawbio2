/* SESSION_HANDLER.JS
 * ===========================
 * All the session and cookie handling functions for all the pages.
 * */

/* Get cookie by name.
 * @param cname string Name of the cookie.
 * */
export function getCookie(cname) {
  const name = cname + "=";
  const decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

/* Remove cookie by name.
 * @param cname string Name of the cookie.
 * */
function removeCookie(cname) {
  document.cookie = `${cname}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

/* Checks if there's a cookie about the login session. If yes, then logs in.
 * @return Void
 * */
export function observeCookie() {
  if (getCookie("loggedIn")) {
    window.open("./scheduleSearch.html", "_self");
  } else {
    document.querySelector(".login-register-container").style.display =
      "initial";
  }
}

/* When click happens on the logout button,
 * then destroys the cookies and redirects to the index page.
 * @return Void
 * */
export function activateLogOutButton() {
  if (getCookie("loggedIn")) {
    // Show the logout button.
    document.querySelector("#logout-button").style.display = "initial";

    // When click, then destroy cookie and return to the index page.
    document.querySelector("#logout-button").addEventListener("click", () => {
        sessionStorage.clear();
        removeCookie("loggedIn");
        window.open("./index.html", "_self");
    });
  }
}
