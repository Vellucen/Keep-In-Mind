tabCheck = new Array();
interval = setInterval(verification, 300);


function verification(){
	check1 = document.getElementById("check1");
	check2 = document.getElementById("check2");
	check3 = document.getElementById("check3");
	check4 = document.getElementById("check4");
	check5 = document.getElementById("check5");
	check6 = document.getElementById("check6");
	check7 = document.getElementById("check7");
	check8 = document.getElementById("check8");
	check9 = document.getElementById("check9");

	tabCheck[0] = check1.checked;
	tabCheck[1] = check2.checked;
	tabCheck[2] = check3.checked;
	tabCheck[3] = check4.checked;
	tabCheck[4] = check5.checked;
	tabCheck[5] = check6.checked;
	tabCheck[6] = check7.checked;
	tabCheck[7] = check8.checked;
	tabCheck[8] = check9.checked;

	bool = false;
	var i = 0;
	while(!bool && i <9) {
		if(tabCheck[i]){
			bool =true;
		}
		i++;
	}
	document.getElementById("boutonFinalInscription").disabled= !bool;
}