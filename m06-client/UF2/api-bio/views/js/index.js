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
				let tr = document.createElement('tr');
				
				let td1 = document.createElement('td');
				td1.textContent = user.dni;
				tr.appendChild(td1);
				
				let td2 = document.createElement('td');
				td2.textContent = user.fullName;
				tr.appendChild(td2);
				
				let td3 = document.createElement('td');
				td3.textContent = user.AccountType;
				tr.appendChild(td3);
				
				let td4 = document.createElement('td');
				td4.textContent = user.amount;
				tr.appendChild(td4);

				let td5 = document.createElement('td');
				td5.textContent = user.clientType;
				tr.appendChild(td5);

				let td6 = document.createElement('td');
				td6.textContent = user.entryDate;
				tr.appendChild(td6);
				
				table.appendChild(tr);
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
