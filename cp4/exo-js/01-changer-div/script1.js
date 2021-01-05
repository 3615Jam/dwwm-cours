let etatDiv1 = false;
let etatDiv2 = false;

document.getElementById('bloc02').addEventListener('click', div02); 

function div02(evenement) {
	if(etatDiv2 == false) {
		evenement.target.className = "divNoire";
		etatDiv2 = true;
	} else {
		evenement.target.className = "myDiv";
		etatDiv2 = false;
	}
}

function div01(moiMeme) {
	if(etatDiv1 == false) {
		moiMeme.className = "divNoire";
		etatDiv1 = true;
	} else {
		moiMeme.className = "myDiv";
		etatDiv1 = false;
	}
}