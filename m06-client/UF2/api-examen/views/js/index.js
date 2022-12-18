/**
 * @file script.js
 * @version 1.1
 * @author Alumne DAW Bio2
 */

// -- Imports --
// import Account from "./Account"; //  no hace falta

// -- Main --
$(function () {
	// Al carrega, amagar divs
	$("#myProjects").hide();
	$("#intranet").hide();
	$("#fromProject").hide();

	$("#BtAboutMe").click(function () {
		$("#aboutMe").show();
		$("#myProjects").hide();
		$("#intranet").hide();
	});
	$("#BtMyProjects").click(function () {
		$("#myProjects").show();
		$("#aboutMe").hide();
		$("#intranet").hide();
	});
	$("#BtIntranet").click(function () {
		$("#intranet").show();
		$("#myProjects").hide();
		$("#aboutMe").hide();
	});

	dologin();
	setDatePicker();
	let logged = localStorage.getItem("session");

	if (logged) {
		$("#formLogin").hide();
		$("#formProject").show();
	}

	// Select Option Form
	let programLangArray = ["Python", "PHP", "Jquery"];
	let selectElement = $("#tuSelect");
	programLangArray.forEach((item) => {
		selectElement.append(
			'<option value="' + item + '">' + item + "</option>"
		);
	});

	// Validate Project Form //
	$("#tuNombre").change(function () {
		validateName($(this));
	});
	$("#tuDescripcion").change(function () {
		validateTextArea($(this));
	});
	$("#tuDatePicker").change(function () {
		validateDate($(this));
	});


	//-----------BUTTON EVENT------------//
	$("#btProject").click(function () {
		let name = $("#tuNombre");
		console.log(name);
		let descripcion = $("#tuDescripcion");
		let entry_dates = $("#tuDatePicker");
	
		is_valid_name = name.hasClass("error");
		is_valid_description = descripcion.hasClass("error");
		is_valid_date = entry_dates.hasClass("error");
	
		if (!is_valid_name && !is_valid_amount && !is_valid_date) {

			$('#errorProject').html("")
			$("#btProject").prop('disabled', false);

		} else {
			$('#errorProject').html("Revisa el formulario, hay un error")
			$("#btProject").prop('disabled', true);

		  }
		});	
	//-----------------FUNCTIONS---------------//
	function dologin() {
		$("#btLogin").click(function () {
			let username = $("#tuUsername").val();
			let password = $("#tuPassword").val();

			if (username == "projecte" && password == "dawbio") {
				localStorage.setItem("session", "logged");
				$("#errorLogin").html("");
			} else {
				$("#errorLogin").html("Credencials Incorrectes");
			}
		});
	}

	/**
	 * Function that validates client's full name by a regExp
	 * @param {*} name client name
	 * @returns true or false
	 */
	function validateName(name) {
		let name_value = $(name).val();
		const regExp =
			/(^[a-zA-Z \u00C0-\u017F]{3,16})([ ]{0,1})([a-zA-Z\u00C0-\u017F]{3,16})?([ ]{0,1})?([a-zA-Z\u00C0-\u017F]{3,16})?([ ]{0,1})?([a-zA-Z\u00C0-\u017F]{3,16})/;

		if (regExp.test(name_value)) {
			$(name).removeClass("error");
			$(name).css("border-color", "green");
			$(name).addClass("success");

			return true;
		} else {
			//border: 2px solid red;
			$(name).removeClass("success");
			$(name).css("border", "4px solid red");
			$(name).addClass("error");
			return false;
		}
	}

	function validateTextArea(descripcion) {
		let description_value = $(descripcion).val();
		if (description_value.length >= 1 && description_value.length < 100) {
			$(descripcion).css("border-color", "green");
			$(descripcion).addClass("success");
			$(descripcion).removeClass("error");

			return true;
		} else {
			//border: 2px solid red;
			$(descripcion).css("border", "4px solid red");
			$(descripcion).addClass("error");
			$(descripcion).removeClass("success");
			return false;
		}
	}

	/**
	 * Function that valisdate if date picked by user to modify it it is a valid date or not
	 * @param {*} date new date to modify
	 * @returns true or false
	 */
	function validateDate(date) {
		let bd_date = $(date).val();
		let new_date = new Date(bd_date);
		let today = new Date();
		//? To solve the problem when user put today date compared to today
		//? Reset the time to solve miliseconds bug
		today.setHours(0, 0, 0, 0);
		new_date.setHours(0, 0, 0, 0);

		let correct_date = new_date.getTime() < today.getTime();

		if (correct_date) {
			$(date).removeClass("error");
			$(date).addClass("success");
			$(date).css("border-color", "green");
			return true;
		} else {
			$(date).addClass("error");
			$(date).removeClass("success");
			$(date).css("border", "4px solid red");
			return false;
		}
	}
	/**
	 * Function to set datePicker
	 */
	function setDatePicker() {
		$.datepicker.regional["ca"] = {
			closeText: "Tanca",
			prevText: "< Anterior",
			nextText: "Següent >",
			currentText: "Avui",
			monthNames: [
				"Gener",
				"Febrer",
				"Març",
				"Abril",
				"Maig",
				"Juny",
				"Juliol",
				"Agost",
				"Setembre",
				"Octubre",
				"Novembre",
				"Decembre",
			],
			monthNamesShort: [
				"Gen",
				"Feb",
				"Març",
				"Abr",
				"Maig",
				"Juny",
				"Jul",
				"Ago",
				"Sep",
				"Oct",
				"Nov",
				"Des",
			],
			dayNames: [
				"Diumenge",
				"Dilluns",
				"Dimarts",
				"Dimecres",
				"Dijuous",
				"Divendres",
				"Disabte",
			],
			dayNamesShort: ["Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"],
			dayNamesMin: ["Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"],
			weekHeader: "Sm",
			dateFormat: "mm/dd/yy",
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: "",
		};
		$.datepicker.setDefaults($.datepicker.regional["ca"]);
		$(function () {
			$("#tuDatepicker").datepicker();
		});
	}
});
