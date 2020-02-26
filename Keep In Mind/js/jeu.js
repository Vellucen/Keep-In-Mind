grid = new Array();
tabPhotosInfo = new Array();
tabPhotos = new Array();
tabPhotosPrises = new Array();
score = 0;
reste = 10;
nbPhotoM = 0;

$(document).ready(function(){
	chargerJson(infoTours);
})

function chargerJson (callBack){
	$.get("dataJeu.php", function(data_json){
		tabPhotos = JSON.parse(data_json);
		callBack();
	})
}

function lancement(){
	build();
}

function build (){
	var $board = $("#barre");
	for(var i = 0; i < 10; i++){
		var $cell = $("<div>");
		$board.append($cell);
		grid[i] = $cell;
	}
}

function infoTours(){
	for (var i = 0; i < 10; i++){
		tabPhotosInfo[i] = new Array();
		tabPhotosInfo[i][0] = choixPhotoEtRecupPrenomNom();
		tabPhotosPrises[i] = tabPhotosInfo[i][0];
		tabPhotosInfo[i][1] = choixMauvaisPrenomNom(tabPhotosInfo[i][0]);
		}
	lancement();
}

function choixPhotoEtRecupPrenomNom(){
	var random = entierAleatoire(0, tabPhotos.length - 1); 
	while (appartTab(tabPhotosPrises, random)){
		random = entierAleatoire(0, tabPhotos.length - 1); 
	}
	return random;
}

function choixMauvaisPrenomNom(id){
	var mauvaisId = null;
	while (mauvaisId == null){
		random = entierAleatoire(0, tabPhotos.length - 1);
		if (random != id && tabPhotos[id][4].indexOf(tabPhotos[random][4]) != -1){
			mauvaisId = random;
		}
	}
	return random;
}

function verifNom1(){
	if (nbPhotoM == 0){
		reste--;
		document.getElementById("nom1").style.marginLeft = "10px";
		document.getElementById("nom1").style.marginRight = "10px";
		document.getElementById("nom2").style.marginLeft = "10px";
		document.getElementById("nom2").style.marginRight = "10px";
		document.getElementById("nom2").style.visibility = "visible";
	} 
	else if (nbPhotoM <= 10){
		var bon = tabPhotos[tabPhotosInfo[nbPhotoM - 1][0]][2].concat(' ', tabPhotos[tabPhotosInfo[nbPhotoM - 1][0]][1]);
		if (document.getElementById("nom1").innerHTML.indexOf(bon) !== -1){
			score++;
			reste--;
			grid[nbPhotoM - 1].css("background-color", "green");
		}
		else{
			reste--;
			grid[nbPhotoM - 1].css("background-color", "red");
		}
	}   
	else if (nbPhotoM == 11){
		document.location.reload()
	}   
	else {
		if (document.getElementById("nom1").innerHTML.indexOf(bon) !== -1){
			score++;
			reste--;
			grid[nbPhotoM - 1].css("background-color", "green");
		}
		else{
			reste--;
			grid[nbPhotoM - 1].css("background-color", "red");
		}
	}
	changerPhoto();
}

function verifNom2(){
	if (nbPhotoM == 0){
		changerPhoto();
		reste--;
	} 
	else if (nbPhotoM <= 10){
		var bon = tabPhotos[tabPhotosInfo[nbPhotoM - 1][0]][2].concat(' ', tabPhotos[tabPhotosInfo[nbPhotoM - 1][0]][1]);
		if (document.getElementById("nom2").innerHTML.indexOf(bon) !== -1){
			score++;
			reste--;
			grid[nbPhotoM - 1].css("background-color", "green");

		}
		else{
			reste--;
			grid[nbPhotoM - 1].css("background-color", "red");
		}
	}
	else{
		if (document.getElementById("nom2").innerHTML.indexOf(bon) !== -1){
			score++;
			reste--;
			grid[nbPhotoM - 1].css("background-color", "green");
		}
		else{
			reste--;
			grid[nbPhotoM - 1].css("background-color", "red");
		}
	}
	changerPhoto();
}

function changerPhoto(){
	var x = document.getElementById("photo");
	if (nbPhotoM < 10){
		nomPhoto = "../photoEtu/".concat(tabPhotos[tabPhotosInfo[nbPhotoM][0]][3]);
		x.setAttribute("src", nomPhoto);
		if(entierAleatoire(0, 1) == 0){
			var nom1 = document.getElementById("nom1");
			nom1.innerHTML = tabPhotos[tabPhotosInfo[nbPhotoM][0]][2] + " " + tabPhotos[tabPhotosInfo[nbPhotoM][0]][1];
			var nom2 = document.getElementById("nom2");
			nom2.innerHTML = tabPhotos[tabPhotosInfo[nbPhotoM][1]][2] + " " + tabPhotos[tabPhotosInfo[nbPhotoM][1]][1];
		}
		else{
			var nom1 = document.getElementById("nom1");
			nom1.innerHTML = tabPhotos[tabPhotosInfo[nbPhotoM][1]][2] + " " + tabPhotos[tabPhotosInfo[nbPhotoM][1]][1];
			var nom2 = document.getElementById("nom2");
			nom2.innerHTML = tabPhotos[tabPhotosInfo[nbPhotoM][0]][2] + " " + tabPhotos[tabPhotosInfo[nbPhotoM][0]][1];
		}
		nbPhotoM++;
	}
	else {
		nbPhotoM++;
		chargerScore();
		x.setAttribute("src", "../image/imageFin.jpg");
		document.getElementById("nom1").style.marginLeft = "120px";
		document.getElementById("nom1").style.marginRight = "120px";
		document.getElementById("nom1").innerHTML = "Rejouer";
		document.getElementById("nom2").style.visibility = "hidden";
	}
}

function chargerScore(){
	$.post("enregistrerScore.php", { ma_variable: score }, function(data) { 
    });
}

function appartTab(tab, i){
	var bool = false;
	var j = 0;
	while (!bool && j != tab.length){
		if (tab[j] == i){
			bool = true;
		}
		j++;
	}
	return bool;
}

function entierAleatoire(min, max){
	return Math.floor(Math.random() * (max - min + 1)) + min;
}