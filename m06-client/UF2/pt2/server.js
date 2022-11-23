"use strict";
// Agafem en constants totes les llibreries
const express = require("express");
const bodyParse = require("body-parser");
const mysql = require("mysql");
const app = express();
const connection = mysql.createConnection({
	host: "localhost",
	database: "testm06",
	user: "vic",
	password: "123qwe",
});

app.use(bodyParse.urlencoded({ extended: false }));
app.use(bodyParse.json());

app.post("/api/login", function (req, res) {
	console.log("estem a login");

	//provem de connectar-nos i capturar possibles errors
	connection.connect(function (err) {
		console.log(err);
		if (err) {
			console.error("Error connecting: " + err.stack);
			return;
		}
		console.log("Connected as id " + connection.threadId);
	});

	connection.query("SELECT * FROM users", function (error, results, field) {
		if (error) {
			res.status(400).send({ resultats: null, error: error.stack });
		} else {
			/*COMPROVACIÓ DE DADES PER CONSOLA DE NODE*/
			//   console.log(results);
			//   results.forEach(result => {
			//     console.log(result.user);
			//   })

			res.status(200).send({ resultats: results });
		}
	});
	connection.end();
});
// Error Displayer
process.on("uncaughtException", function (err) {
	console.log(err);
});

app.listen(3306, () => {
	console.log(
		"Aquesta és la nostra API-REST que corre en http://localhost:3306"
	);
});

// Codificació del

// Esperant verbs
// // GET
// app.get("/hello", (request, response) => {
// 	response.send({ message: "Hola mon! (GET)" });
// });
// app.get("/hello/:name", (name, response) => {
// 	var nom = name.params.name;
// 	response.send({ message: `Hola ${nom} (GET)` });
// });

// // POST
// app.post("/hello", (request, response) => {
// 	response.send({ message: "Hola mon! (POST)" });
// });
// app.post("/address", (request, response) => {
// 	// Recollim els valors que venen des d'un post (xhr.send)
// 	var recollida = request.body;
// 	var ciutat = request.body.ciutat;
// 	console.log(recollida, "\n", ciutat);

// 	response.send({ message: "Tot ok" });
// });
