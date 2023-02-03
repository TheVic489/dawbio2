/* BILLING.SCRIPT.JS
 * =====================================================
 * All the billing functionalities unique for the "billing.html" page.
 * */
import { getCookie } from "./session_handler.js";
import { activateLogOutButton } from "./session_handler.js";


/* Fetches the billing information into the ".bill-wrapper" element.
 * @return Void
 * */
function fetchBillingInfo() {
    
    const billWrapper = document.querySelector('.bill-wrapper');
    const usrData     = document.querySelector('.usr-data');

    usrData.innerHTML += `<p><u><b>Billing informations<b></u></p>`;
    usrData.innerHTML += `<p><u>Full name:</u> ${sessionStorage["fullName"]}</p>`;
    usrData.innerHTML += `<p><u>DNI:</u> ${sessionStorage["dni"]}</p>`;
    usrData.innerHTML += `<p><u>Phone number:</u> ${sessionStorage["phoneNumber"]}</p>`;
    usrData.innerHTML += `<hr>`
    usrData.innerHTML += `<p><u><b>Flight 1<b></u></p>`;
    usrData.innerHTML += `<p><u>On date:</u> ${sessionStorage["date1"]}</p>`;
    usrData.innerHTML += `<p><u>From:</u> ${sessionStorage["city1"]}</p>`;
    usrData.innerHTML += `<p><u>To:</u> ${sessionStorage["city2"]}</p>`;
    usrData.innerHTML += `<p><u>Number of passengers:</u> ${sessionStorage["passngrNum"]}</p>`;
    usrData.innerHTML += `<p><u>Departure:</u> ${sessionStorage["depTime1"]}</p>`;
    usrData.innerHTML += `<p><u>Arrival:</u> ${sessionStorage["arrivTime1"]}</p>`;
    usrData.innerHTML += `<hr>`
    usrData.innerHTML += `<p><u><b>Flight 2<b></u></p>`;
    usrData.innerHTML += `<p><u>On date:</u> ${sessionStorage["date2"]}</p>`;
    usrData.innerHTML += `<p><u>From:</u> ${sessionStorage["city2"]}</p>`;
    usrData.innerHTML += `<p><u>To:</u> ${sessionStorage["city1"]}</p>`;
    usrData.innerHTML += `<p><u>Number of passengers:</u> ${sessionStorage["passngrNum"]}</p>`;
    usrData.innerHTML += `<p><u>Departure:</u> ${sessionStorage["depTime2"]}</p>`;
    usrData.innerHTML += `<p><u>Arrival:</u> ${sessionStorage["arrivTime2"]}</p>`;
    usrData.innerHTML += `<hr>`
    usrData.innerHTML += `<p><u><b>Total price:</b></u> ${sessionStorage["flightPrice"]}</p>`;

    billWrapper.innerHTML += `<button class="button print-btn">Print document</button>`

}


/* Formats the document and brings up the print option in the browser
 * @return Void
 * */
function printDiv() {
    const divContents = document.querySelector('.usr-data').innerHTML;
    const a = window.open('', '', 'height=500, width=500');
    a.document.write(`<html><head>
                                <link rel="stylesheet" href="./css/general.style.css">
                                <link rel="stylesheet" href="./css/billing.style.css">
                            </head>`);

    a.document.write('<body style="font-size: 9pt;">');

    a.document.write(`<div style="display: flex;">
                        <div style="margin: 0 auto;">
                            ${divContents}
                        </div>
                     </div>`);

    a.document.write('</body></html>');
    a.document.close();
    a.print();
}


/* Initializes the billing page functionality.
 * @return Void
 * */
function initShowBilling() {
  if (getCookie("loggedIn") &&
    sessionStorage['paymentDone'] == "true") {

    document.body.style.display = "initial";
    activateLogOutButton();
    fetchBillingInfo();
    
    document.querySelector('.print-btn').addEventListener('click', () => {
        printDiv();
    })

  } else {
    // If not logged in, then throw the user back to index.html.
    window.open("./index.html", "_self");
  }
}

// Call main.
initShowBilling();
