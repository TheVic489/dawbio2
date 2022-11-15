/* SCHEDULESEARCH.SCRIPT.JS
 * =====================================================
 * All the scheduleSearch page functionalities unique for the "scheduleSearch .html" page.
 * */
import { activateLogOutButton } from "./session_handler.js";

/* Fetches the current date into the date fields as a placeholder.
 * @return Void => Mutates the ".origin-date / .destination-date" elements.
 * */
function fetchCurrentDate() {
  const today = new Date();
  const todayString = new Date().toISOString().slice(0, 10).replace(/-/g, "/");
  const todayByName = today.toLocaleDateString("en-EN", { weekday: "long" });

  document.querySelector(
    ".origin-date"
  ).attributes.placeholder.value = `✈ ${todayByName} ${todayString}`;
  document.querySelector(
    ".destination-date"
  ).attributes.placeholder.value = `✈ ${todayByName} ${todayString}`;
}

/* Gets the available flights from the server.
 * @return promise object
 * */
async function getFlights() {
  return fetch("http://localhost/4-login/php/models/getFlights.php").then(
    (res) => res.json()
  );
}

/* Re-shows all the '.destination' elements.
 * @return Void.
 * */
function resetAllDestinations() {
  const destinationCities = document.querySelector(".destination");
  Array.from(destinationCities).forEach((e) => (e.style.display = "initial"));
}

/* Changes the default selection in the .destination element,
 * for other than the selectedValue.
 * (There are no flight to the same city at the same time..)
 * @param selectedValue string
 * @return Void
 * */
function changeDestinationSelection(selectedValue) {
  let destinationCities = document.querySelector(".destination");

  Array.from(destinationCities).forEach((e) => {
    if (e.attributes.value.value != selectedValue) {
      destinationCities.value = e.attributes.value.value;
    }
  });
}

/* Fetches the available cities returned by the server into the "select" element.
 * @param res promise object
 * @return Void
 * */
function fetchCities(res) {
  const originCities = document.querySelector(".origin");
  const destinationCities = document.querySelector(".destination");

  for (const key in res.routes) {
    originCities.innerHTML += `<option value="${key}" > ${key} </option>`;
    destinationCities.innerHTML += `<option value="${key}" > ${key} </option>`;
  }

  // Whenever the user changes the selection in the form.
  originCities.addEventListener("change", () => {
    const selectedValue =
      originCities.selectedOptions[0].attributes.value.value;

    Array.from(destinationCities).forEach((e) => {
      const destinationValue = e.attributes.value.value;

      // Hides from the .destination element the selectedValue.
      // (There are no flight to the same city at the same time..)
      if (destinationValue == selectedValue) {
        resetAllDestinations();
        e.style.display = "none";

        changeDestinationSelection(selectedValue);
      }
    });
  });
}

/* Gets the selected city values from the form.
 * @return object
 * */
function getSelectedCities() {
  return {
    origin: document.querySelector(".origin").value,
    destination: document.querySelector(".destination").value,
  };
}

/* Gets the number of passengers stated in the form.
 * @return string
 * */
function getPassengerNumber() {
  return document.querySelector(".passngr-num").value;
}

/* Gets the selected date values from the form.
 * As well, checks if the default "placeholder date" was used.
 * If yes, returns the today's date.
 * @return object
 * */
function getSelectedDates() {
  const originDate = document.querySelector(".origin-date");
  const destinationDate = document.querySelector(".destination-date");

  const today = new Date().toISOString().slice(0, 10);

  return {
    originDate: originDate.value == "" ? today : originDate.value,
    destinationDate:
      destinationDate.value == "" ? today : destinationDate.value,
  };
}

/* Tests the date string value from the parameter element,
 * if it's earlier than current date or not.
 * @param identifier string The identifier of the element.
 * @return Bool (True if OK, False if not..)
 * */
function testDate(identifier) {
  const originDate = document.querySelector(identifier).value;
  const toDate = new Date().setHours(0, 0, 0, 0);

  if (new Date(originDate).getTime() < toDate) {
    return false;
  }

  return true;
}

/* Calculates the month difference between two dates.
 * @param startDate string
 * @param endDate string
 * @return int => Nº of months between the two dates.
 * */
function getMonthDifference(startDate, endDate) {
  const startDateObject = new Date(startDate);
  const endDateObject = new Date(endDate);

  return (
    endDateObject.getMonth() -
    startDateObject.getMonth() +
    12 * (endDateObject.getFullYear() - startDateObject.getFullYear())
  );
}

/* Checks through various conditions,
 * and correspondingly returns an array <array>
 * with the time pairs for each available flight combination.
 * @param selectedDates object
 * @param originDateDay string
 * @param originAvailableHours array<string>
 * @param destinationAvailableHours array<string>
 * @return array<array<string>> => Combitanations of the hours.
 * */
function getDateCombinations(
  selectedDates,
  originDateDay,
  originAvailableHours,
  destinationAvailableHours
) {
  let allGood = true;
  let timePairs = [["not available"]];

  const isSameDay =
    selectedDates.originDate == selectedDates.destinationDate ? true : false;

  if (isSameDay && originDateDay == "Saturday") {
    allGood = false;
  }

  if (
    originAvailableHours.length == 0 &&
    destinationAvailableHours.length == 0
  ) {
    allGood = false;
  }

  if (
    new Date(selectedDates.originDate) > new Date(selectedDates.destinationDate)
  ) {
    allGood = false;
  }

  if (allGood) {
    timePairs = originAvailableHours
      .map((date1) => destinationAvailableHours.map((date2) => [date1, date2]))
      .flat(1);

    // If the dates are the some day,
    // then can't have the same departure time for both.
    if (isSameDay) {
      timePairs = timePairs.filter((arr) => {
        return arr[0] != arr[1];
      });
    }
  }
  return timePairs;
}

/* Removes all the search results from the result container.
 * @return Void
 * */
function resetSearchResultContainer() {
  document.querySelectorAll(".result-values-wrapper").forEach((e) => {
    e.remove();
  });
}

/* Calculates the arrival time by adding the minutes to the departure times.
 * @param departureTime string
 * @param flightTime string (Minutes.)
 * */
function getArrivalTime(departureTime, flightTime) {
  return new Date(
    new Date("1970/01/01 " + departureTime).getTime() + flightTime * 60000
  ).toLocaleTimeString("en-UK", {
    hour: "2-digit",
    minute: "2-digit",
    hour12: false,
  });
}

/* Fetches the found flight results into a table,
 * correspondingly to the received inputs from the user
 * @param selectedCities object
 * @param selectedDates object
 * @return Void
 * */
async function fetchScheduleTable(selectedCities, selectedDates) {
  const searchResultWrapper = document.querySelector(".search-result-wrapper");

  const flightsPromise = await fetch(
    "http://localhost/4-login/php/models/getFlights.php"
  );
  const flightsJSON = await flightsPromise.json();

  const originDateDay = new Date(selectedDates.originDate).toLocaleDateString(
    "en-EN",
    { weekday: "long" }
  );

  const destinationDateDay = new Date(
    selectedDates.destinationDate
  ).toLocaleDateString("en-EN", { weekday: "long" });

  const originAvailableHours = flightsJSON["schedules"][originDateDay];
  const destinationAvailableHours =
    flightsJSON["schedules"][destinationDateDay];

  const datePairs = getDateCombinations(
    selectedDates,
    originDateDay,
    originAvailableHours,
    destinationAvailableHours
  );

  const flightTime =
    flightsJSON.routes[selectedCities.origin][selectedCities.destination][
      "time"
    ];
  const flightPrice =
    flightsJSON.routes[selectedCities.origin][selectedCities.destination][
      "price"
    ];
  const numOfPassengers = getPassengerNumber();
  sessionStorage['passngrNum'] = numOfPassengers;
  document.querySelector(".search-result-container").style.display = "initial";

  resetSearchResultContainer();

  // Init and empty string variable,
  // to be appended during the iteration.
  let dataToFetch = "";

  if (datePairs[0] != "not available") {
    datePairs.forEach((datePair) => {
      dataToFetch = `
                    <div class="result-values-wrapper">
                        <div class="result-values" >
                        <p><u>${flightTime} min.</u></p>
                        <div class="there">
                            <p class="dep-time-1" >${datePair[0]}</p>
                            <p class="city-1">${selectedCities.origin}</p>
                            <i class='fa fa-long-arrow-left'></i>
                            <p>${selectedCities.destination}</p>
                            <p class="date-1">${selectedDates.originDate}</p>
                            <p class="arriv-time-1">${getArrivalTime(
                              datePair[0],
                              flightTime
                            )}</p>
                        </div>

                        <p><u>${flightTime} min.</u></p>
                        <div class="back">
                                <p class="dep-time-2" >${datePair[1]}</p>
                                <p class="city-2">${
                                  selectedCities.destination
                                }</p>
                                <i class='fa fa-long-arrow-right'></i>
                                <p>${selectedCities.origin}</p>
                                <p class="date-2">${
                                  selectedDates.destinationDate
                                }</p>
                                <p class="arriv-time-2">${getArrivalTime(
                                  datePair[1],
                                  flightTime
                                )}</p>
                            </div>
                        </div>

                        <div class="buy-btn-container">
                            <div class="buy-btn-wrapper">
                                <p class="flight-price">${
                                  flightPrice * parseInt(numOfPassengers)
                                }€</p>
                                <button class="buy-btn" type="button">BUY</button>
                            </div>
                        </div>
                    </div> `;

      searchResultWrapper.innerHTML += dataToFetch;
    });
  } else {
    dataToFetch = `<div class="result-values-wrapper" >
                            <p style="margin: 0 auto;"> 
                                Could not find any flights available. 
                            </p>
                       </div>`;

    searchResultWrapper.innerHTML += dataToFetch;
  }
  activateBuyButtons();
}

/* On click to the search button, checks through the input fields,
 * and if all good with them, then calls the "fetchScheduleTable" function.
 * @return Void
 * */
function activateSearchButton() {
  document.querySelector(".search-btn").addEventListener("click", () => {
    // DATE SELECTIONS.
    // =======================================================
    const selectedDates = getSelectedDates();
    const areEmptyDates = Object.values(selectedDates).some(
      (x) => x === null || x === ""
    );
    const originDateOK = testDate(".origin-date");
    const destinationDateOK = testDate(".destination-date");
    // =======================================================
    // Check city selections.
    // =======================================================
    const selectedCities = getSelectedCities();
    // NUMBER OF PASSENGERS
    // =======================================================
    const passengerNum = getPassengerNumber();
    // =======================================================

    let allGood = true;

    // Check city selections.
    // =======================================================
    if (selectedCities.origin == selectedCities.destination) {
      alert("The origin and destination cannot be the same!");
      allGood = false;
    }
    // =======================================================

    // Check date selections.
    // =======================================================
    if (areEmptyDates) {
      alert("The date fields are empty.");
      allGood = false;
    }

    if (!originDateOK) {
      alert("The origin date cannot be earlier than the current date.");
      allGood = false;
    }

    if (!destinationDateOK) {
      alert("The return date cannot be earlier than the current date.");
      allGood = false;
    }

    if (
      new Date(selectedDates.originDate) >
      new Date(selectedDates.destinationDate)
    ) {
      alert("The return date cannot be earlier than the origin date.");
      allGood = false;
    }

    if (
      getMonthDifference(
        selectedDates.originDate,
        selectedDates.destinationDate
      ) > 6
    ) {
      alert("Cannot reserve flights later than 6 months.");
      allGood = false;
    }
    // =======================================================

    // Check the number of passengers
    // =======================================================
    if (passengerNum < 1 || passengerNum > 3) {
      alert("Number of passengers cannot be less than 1 or more than 3.");
      allGood = false;
    }
    // =======================================================

    if (allGood == true) {
      fetchScheduleTable(selectedCities, selectedDates);
    }
  });
}

/* Activates the "BUY" button.
 * If click event happens,
 * then saves the selected flight offer datas
 * into the sessionStorage for further calls, and
 * redirect the user for the payment page.
 * @return Void
 * */
function activateBuyButtons() {
  document.querySelectorAll(".buy-btn").forEach((e) => {
    e.addEventListener("click", () => {

      sessionStorage["depTime1"] =
        document.querySelector(".dep-time-1").textContent;

      sessionStorage["depTime2"] =
        document.querySelector(".dep-time-2").textContent;

      sessionStorage["city1"] = document.querySelector(".city-1").textContent;
      sessionStorage["city2"] = document.querySelector(".city-2").textContent;
      sessionStorage["date1"] = document.querySelector(".date-1").textContent;
      sessionStorage["date2"] = document.querySelector(".date-2").textContent;

      sessionStorage["arrivTime1"] =
        document.querySelector(".arriv-time-1").textContent;

      sessionStorage["arrivTime2"] =
        document.querySelector(".arriv-time-2").textContent;

      sessionStorage["flightPrice"] = 
        document.querySelector(".flight-price").textContent;

      window.open("./payment.html", "_self");
    });
  });
}

/* Initializes the schedules search page functionalities.
 * @return Void
 * */
function initScheduleSearch() {
  activateLogOutButton();
  fetchCurrentDate();
  const data = getFlights();
  data.then((res) => fetchCities(res));
  activateSearchButton();
}

// Call main.
initScheduleSearch();
