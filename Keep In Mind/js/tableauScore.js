tabScores = new Array();
tab = new Array();
tabV = new Array();

$(document).ready(function(){
	chargerJson1(chargerJson2);
})
/*Il y a plusieurs fonction avec callBack pour bien attendre que tous les fichiers Json sont bien chargés*/
function chargerJson1 (callBack){
	$.get("dataTableauScore.php", function(data_json){
		tabScores = JSON.parse(data_json);
		callBack(chargerJson3);
	})
}

function chargerJson2 (callBack){
	$.get("../php/dataVerrou.php", function(data_json){
		tabV = JSON.parse(data_json);
		callBack(lancement);
	})
}

function chargerJson3 (callBack){
	$.get("dataUtilisateur.php", function(data_json){
		tab = JSON.parse(data_json);
		callBack();
	})
}

function lancement(){
	chargerTableauScores();
	verrou();
}

function chargerTableauScores(){
	infoDiv = document.getElementById("score");
	var i = 0;
	while (i < tabScores.length && i < 15){
		prenom = tabScores[i][1];
		nom = tabScores[i][0];
		score = tabScores[i][2];
		if (i == 0){
			content = "<div id='first' class='divScore'>"+tabScores[i][1]+ " " +tabScores[i][0]+" : "+tabScores[i][2]+" points"+"</div>";
		}
		else if (tabScores[i][1]==tab[0] && tabScores[i][0]==tab[1]){
			content = "<div class='divScore me'>"+tabScores[i][1]+ " " +tabScores[i][0]+" : "+tabScores[i][2]+" points"+"</div>";
		}
		else {
			content = "<div class='divScore'>"+tabScores[i][1]+ " " +tabScores[i][0]+" : "+tabScores[i][2]+" points"+"</div>";
		}
		infoDiv.innerHTML += content;
		i++;
	}
}

function verrou(){
	var nbEtu = tabV[0];
	if (nbEtu < 10) {
		$('a.verrou').click(function(){
		return false;
		});
	}
}