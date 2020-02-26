tabUsername = new Array();
var T0;
var T0bis;
var T1;
var T1bis;
var T2;
var T3;
var T4;

var I0;
var I0bis;
var I1;
var I2;
var I3;
var I4;


$(document).ready(function(){
	T0 = document.getElementById("tooltip0");
	T0bis = document.getElementById("tooltip0bis");
	T1 = document.getElementById("tooltip1");
	T1bis = document.getElementById("tooltip1bis");
	T2 = document.getElementById("tooltip2");
	T3 = document.getElementById("tooltip3");
	T4 = document.getElementById("tooltip4");

	I0 = document.getElementById("firstname");
	I0bis = document.getElementById("lastname");
	I1 = document.getElementById("username");
	I2 = document.getElementById("password");
	I3 = document.getElementById("confirmPassword");
	I4 = document.getElementById("mail");

	chargerJson(lancement);
})

function chargerJson (callBack){
		$.get("../php/dataIndex.php", function(data_json){
			tabUsername = JSON.parse(data_json);
			callBack();
		})
	}

function lancement(){
		interval = setInterval(verification, 300);

	}

	function verification(){
		if (!verifExistanceUsername() && verifFirstname() && verifLastname() && verifUtilisateur() && verifMotDePasse() && verifConfirMotDePasse() && verifMail()) {
			document.getElementById("boutonInscription").disabled=false;
		}
		else{
			document.getElementById("boutonInscription").disabled=true;
		}
	}

	function verifExistanceUsername(){
		bool = false;
		i = 0;
		while (!bool && i < tabUsername.length){
			if (username.value == tabUsername[i][0] && username.value != trueUsername.value) {
				bool = true;
			}
			i++;
		}
		if (bool) {
			I1.style.backgroundColor = "#E6E6E6";
			T1bis.style.visibility = "visible";
		}
		else{
			T1bis.style.visibility = "hidden";
		}
		return bool;
	}

	function verifUsernameConnex(){
		if (usernameConnex.value.length >= 4) {
			C1.style.backgroundColor = "#D5FADB";
			return true;
		}
		C1.style.backgroundColor = "#E6E6E6";		
		return false;
	}

	function verifPasswordConnex(){
		if (passwordConnex.value.length >= 6) {
			C2.style.backgroundColor = "#D5FADB";
			return true;
		}
		C2.style.backgroundColor = "#E6E6E6";		
		return false;
	}

	function verifFirstname(){
		if (firstname.value.length >= 1) {
			I0.style.backgroundColor = "#D5FADB";
			T0.style.visibility = "hidden";
			return true;
		}
		I0.style.backgroundColor = "#E6E6E6";
		T0.style.visibility = "visible";		
		return false;
	}

	function verifLastname(){
		if (lastname.value.length >= 1) {
			I0bis.style.backgroundColor = "#D5FADB";
			T0bis.style.visibility = "hidden";
			return true;
		}
		I0bis.style.backgroundColor = "#E6E6E6";
		T0bis.style.visibility = "visible";
		return false;
	}

	function verifUtilisateur(){
		if (username.value.length >= 4) {
			I1.style.backgroundColor = "#D5FADB";
			T1.style.visibility = "hidden";
			return true;
		}
		I1.style.backgroundColor = "#E6E6E6";
		if (username.value != "") {
			T1.style.visibility = "visible";
		}
		return false;
	}

	function verifMotDePasse(){
		if (password.value.length >= 6) {
			I2.style.backgroundColor = "#D5FADB";
			T2.style.visibility = "hidden";
			return true;
		}
		I2.style.backgroundColor = "#E6E6E6";
		if (password.value != "") {
			T2.style.visibility = "visible";
		}
		return false;
	}

	function verifConfirMotDePasse(){
		if (password.value === confirmPassword.value) {
			I3.style.backgroundColor = "#D5FADB";
			T3.style.visibility = "hidden";
			return true;
		}
		I3.style.backgroundColor = "#E6E6E6";
		T3.style.visibility = "visible";
		return false;
	}

	function verifMail(){
		if (mail.value.includes("@") && mail.value.includes(".")){
			I4.style.backgroundColor = "#D5FADB";
			T4.style.visibility = "hidden";
			return true;
		}
		I4.style.backgroundColor = "#E6E6E6";
		if (mail.value != "") {
			T4.style.visibility = "visible";
		}
		return false;
	}

	function affichSupp(){
		S1 = document.getElementById("confirmSupp");
		S1.style.visibility = "visible";
	}

	function cacheSupp(){
		S1 = document.getElementById("confirmSupp");
		S1.style.visibility = "hidden";
	}
