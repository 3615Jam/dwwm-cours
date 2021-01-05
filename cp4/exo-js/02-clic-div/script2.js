let myCompteur = 0; 

let myNomElement = ""; 

let myConteneurHtml = document.getElementById("conteneur");

let myTabClique = Array.from(document.querySelectorAll(".myDiv"));

for(myCompteur = 0; myCompteur < myTabClique.length; myCompteur++) {
	myTabClique[myCompteur].addEventListener('click', myOnClick);
}

function myOnClick(event) {
	let myIndice = myTabClique.indexOf(event.currentTarget);
	if(myIndice != -1) {
		myNomElement = myTabClique[myIndice].textContent;
		alert('Element cliqué : ' + myNomElement);
	}
}