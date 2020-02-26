tabPhotos = new Array();
tab = new Array();

var C1;
var C2;
var C3;
var C4;


var T1;
var T2;

$(document).ready(function(){
	C1 = document.getElementById("prenomEtu");
	C2 = document.getElementById("nomEtu");

	C3 = document.getElementById("prenomEtuSupp");
	C4 = document.getElementById("nomEtuSupp");

	T1 = document.getElementById("toolUp");
	T2 = document.getElementById("toolUp2");
	chargerJsonA(chargerVerrou);
})

function toChange(){
	change = document.getElementById("change");
	if (change.innerHTML == "Afficher par ordre alphabétique"){
		change.innerHTML = "Afficher par ordre de promotion";
		chargerJsonA(chargerVerrou);
		chargerPhotoHTML();
	}
	else {
		change.innerHTML = "Afficher par ordre alphabétique";
		chargerJsonB(chargerVerrou);
		chargerPhotoHTML();
	}
}
/*Il y a plusieurs fonction avec callBack pour bien attendre que tous les fichiers Json sont bien chargés*/
function chargerJsonA (callBack){
	$.get("dataImportationA.php", function(data_json){
		tabPhotos = JSON.parse(data_json);
		callBack(lancement);
	})
}

function chargerJsonB (callBack){
	$.get("dataImportationB.php", function(data_json){
		tabPhotos = JSON.parse(data_json);
		callBack(lancement);
	})
}

function chargerVerrou (callBack){
	$.get("../php/dataVerrou.php", function(data_json){
		tab = JSON.parse(data_json);
		callBack();
	})
}

function lancement(){
	chargerPhotoHTML();
	verrou();
	interval = setInterval(verification, 300);
}

function chargerPhotoHTML(){
	infoDiv = document.getElementById("showPhoto");
	infoDiv.innerHTML = "";
	for (var i = 0; i < tabPhotos.length; i++){
		promo = tabPhotos[i][5];
		lienPhoto = "../photoEtu/".concat(tabPhotos[i][3]);
		prénom = tabPhotos[i][2];
		nom = tabPhotos[i][1];
		content = "<div class='photoEtu'>\
					<p>"+promo+"</p>\
					<img src='" + lienPhoto + "'/>\
					<p>" + prénom + "</p>\
					<p>" + nom + "</p>\
					</div>";
		infoDiv.innerHTML += content;
	}
}

function verrou(){
	var nbEtu = tab[0];
	if (nbEtu < 10) {
		$('a.verrou').click(function(){
		return false;
		});
	}
}

function verification(){
	if (verifPrenom() && verifNom() && verifExistanceEtu()) {
		document.getElementById("boutonImport").disabled=false;
		C1.style.backgroundColor = "#D5FADB";
		C2.style.backgroundColor = "#D5FADB";
		T1.style.visibility = "hidden"
	}
	else if (prenomEtu.value.length == 0 || nomEtu.value.length == 0){
		document.getElementById("boutonImport").disabled=true;
		C1.style.backgroundColor = "#E6E6E6";
		C2.style.backgroundColor = "#E6E6E6";
		T1.style.visibility = "hidden"
	}
	else{
		document.getElementById("boutonImport").disabled=true;
		C1.style.backgroundColor = "#E6E6E6";
		C2.style.backgroundColor = "#E6E6E6";
		T1.style.visibility = "visible"
	}



	if (verifPrenomSupp() && verifNomSupp() && verifExistanceEtuSupp()) {
		document.getElementById("boutonSupp").disabled=false;
		C3.style.backgroundColor = "#D5FADB";
		C4.style.backgroundColor = "#D5FADB";
		T2.style.visibility = "hidden"
	}
	else if (prenomEtuSupp.value.length == 0 || nomEtuSupp.value.length == 0){
		document.getElementById("boutonSupp").disabled=true;
		C3.style.backgroundColor = "#E6E6E6";
		C4.style.backgroundColor = "#E6E6E6";
		T2.style.visibility = "hidden"
	}
	else{
		document.getElementById("boutonSupp").disabled=true;
		C3.style.backgroundColor = "#E6E6E6";
		C4.style.backgroundColor = "#E6E6E6";
		T2.style.visibility = "visible"
	}

}

function verifPrenom(){
	if (prenomEtu.value.length >= 1) {
		return true;
	}		
	return false;
}

function verifNom(){
	if (nomEtu.value.length >= 1) {
		return true;
	}		
	return false;
}

function verifExistanceEtu(){
	bool = true;
	i = 0;
	while (bool && i < tabPhotos.length){
		if (prenomEtu.value == tabPhotos[i][2] && nomEtu.value == tabPhotos[i][1]) {
			bool = false;
		}
		i++;
	}
	return bool;
}



function verifPrenomSupp(){
	if (prenomEtuSupp.value.length >= 1) {
		return true;
	}		
	return false;
}

function verifNomSupp(){
	if (nomEtuSupp.value.length >= 1) {
		return true;
	}		
	return false;
}

function verifExistanceEtuSupp(){
	bool = false;
	i = 0;
	while (!bool && i < tabPhotos.length){
		if (prenomEtuSupp.value == tabPhotos[i][2] && nomEtuSupp.value == tabPhotos[i][1]) {
			bool = true;
		}
		i++;
	}
	return bool;
}

