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

			// $.each(users, function (index, client) {
			// 	$("#table").append(`<tr><td> ${client.dni}</td>`);
			// 	$("#table").append(`<td> ${client.fullName}</td>`);
			// 	$("#table").append(`<td> ${client.AccountType}</td>`);
			// 	$("#table").append(`<td> ${client.amount}</td>`);
			// 	$("#table").append(`<td> ${client.clientType}</td>`);
			// 	$("#table").append(`<td> ${client.entryDate}</td></tr>`);

			// 	console.log(client.dni);
			// });
			console.log(data);

			for (let user of users) {
				$("#table").append(
					'<tr> <td> <input disabled value="' +
						user.dni +
						'"></input> </td> <td> <input disabled value="' +
						user.fullName +
						'"></input> </td> <td> <input disabled value="' +
						user.AccountType +
						'"></input> </td> <td> <input disabled value="' +
						user.amount +
						'"></input> </td> <td> <input type="select" disabled value="' +
						user.clientType +
						'"></input> </td> <td> <input disabled value="' +
						user.entryDate +
						'"></input> </td> </tr>'
				);
			}
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
