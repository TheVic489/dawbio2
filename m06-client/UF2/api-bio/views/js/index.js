/**
 * @file script.js
 * @version 1.1
 * @author Alumne DAW Bio2
 */

// -- Imports --
// import Account from "./Account"; //  no hace falta

// -- Main --
$(function () {
	$.ajax({
		type: "GET",
		url: "/api/login",

		success: function (data) {
			let users = [];
			data.resultats.forEach((elem) => {
				let myAccount = new Account(
					elem["DNI"],
					elem["Name"],
					elem["Account type"],
					elem["Amount"],
					elem["Client type"],
					elem["Entry date"]
				);
				users.push(myAccount);
			});


			users.forEach((user) => {
				let cleanAmount = parseFloat(user.amount.substring(0, user.amount.length - 1).replaceAll('.', '')); // Masteringjs.io
				if (cleanAmount <= 10000 ) {
					user.clientType = "Poor client"
				}
				if (cleanAmount > 10001 && cleanAmount <= 100000 ) {
					user.clientType = "Normal client"
				}
				if (cleanAmount > 100001 ) {
					user.clientType = "Very rich client"
				}
			});

			// Creation of the Table
			let tbody = $("tbody");
			tbody.html("");
			users.forEach((user) => {
				tbody.append(`
				<tr>
				<td id="dni">${user.dni}</td>
				<td><input type="text" value="${user.fullName}" id="name"> </td>
				<td><select><option type="select" value="${user.AccountType}" id="account-type">${user.AccountType}</option></select></td>
				<td><input value="${user.amount}" id="amount"> </td>
				<td><input value="${user.clientType}" id="client-type"> </td>
				<td><input type="text" value="${user.entryDate}" id="datepicker"> </td>
				<tr>
				`);
			});

			// Save array of accounts in localstorage
			localStorage.setItem('users', JSON.stringify(users));

			// Disable table inputs
			$("input").prop('disabled', true);
			$("select").prop('disabled', true);

			// Button for enable modifying
			$("#bt-modify-data").click(function() {
				$("input").prop('disabled', false);
				$("select").prop('disabled', false);
			})
			//Date picker
			//$( "#datepicker" ).datepicker();

			
		},

		error: function (xhr, status) {
			response = xhr + status;
			console.log(response);

			console.log("Problem detected");
		},

		// Sí la petición tiene success o error
		complete: function (xhr, status) {
			console.log("Petición realizada");
		},
	});
});
