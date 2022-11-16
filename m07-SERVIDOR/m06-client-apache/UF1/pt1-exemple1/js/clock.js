/* CLOCK.JS
 * =====================================================
 * All the clock functionalities unique for the "#current-date and #digital-clock" elements.
 * */

/* Gets the current date, then formats it as it's required in the announcment.
 * and intervally updates itself each second.
 * @return Void
 * @return Void => Mutates "#current-date" element.
 * */
function showDate() {

  let days = [
    "domingo",
    "lunes",
    "martes",
    "miércoles",
    "jueves",
    "viernes",
    "sábado",
  ];

  let months = [
    "enero ",
    "febrero",
    "marzo",
    "abril",
    "mayo",
    "junio",
    "julio",
    "agosto",
    "septiembre",
    "octubre",
    "noviembre",
    "diciembre",
  ];

  let date = new Date();
  let month = date.getMonth() + 1;
  let monthByName = months[month];

  let dayByNumber = date.getDate();
  let dayByName = days[date.getDay()];

  let currentDate = `${dayByName}, ${dayByNumber} de ${monthByName}`;

  document.getElementById("current-date").innerText = currentDate;
}

/* Gets the current time, formats it
 * and intervally updates itself each second.
 * @return Void => Mutates "#digital-clock" element.
 * */
function showTime() {
  let date = new Date();
  let hours = date.getHours();
  let minutes = date.getMinutes();
  let seconds = date.getSeconds();
  let session = "AM";

  if (hours == 0) {
    hours = 12;
  }

  if (hours > 12) {
    hours = hours - 12;
    session = "PM";
  }

  hours = hours < 10 ? "0" + hours : hours;
  minutes = minutes < 10 ? "0" + minutes : minutes;
  seconds = seconds < 10 ? "0" + seconds : seconds;

  let time = hours + ":" + minutes + ":" + seconds + " " + session;
  document.getElementById("digital-clock").innerText = time;

  setTimeout(showTime, 1000);
}

/* Initializes the billing page functionality.
 * @return Void
 * */
function initClock() {
  showDate();
  showTime();
}

// Calling main.
initClock();
