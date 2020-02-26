tab = new Array();

$(document).ready(function(){
	chargerJson(lancement);
})

function chargerJson (callBack){
	$.get("../php/dataVerrou.php", function(data_json){
		tab = JSON.parse(data_json);
		callBack();
	})
}

function lancement(){
	verrou();
}

function verrou(){
	var nbEtu = tab[0];
	if (nbEtu < 10) {
		$('a.verrou').click(function(){
		return false;
		});
	}
}