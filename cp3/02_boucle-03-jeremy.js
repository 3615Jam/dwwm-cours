// bingo Jeremy 


let rejouer = true; 
while (rejouer) {
	const resultat = Math.trunc(Math.random() * 10);
	let saisie = prompt("Choisis un chiffre entre 1 et 10");
	while (resultat != saisie && saisie != null) {
		if (saisie > 10) {
			saisie = prompt("Tu n'as pas choisi un chiffre entre 1 et 10 !");
		} else if (isNaN (saisie)) {
			saisie = prompt ("Tu n'as pas tapé un chiffre !");
		} else if (saisie > resultat) {
			saisie = prompt ("Trop grand !");
		} else if (saisie < resultat) {
			saisie = prompt ("Trop petit !"); 
		}
	}
	if (saisie == null) {
		rejouer = false;
		alert ("Quitté");
	} else if (!confirm ("Bravo ! \n Veux-tu rejouer ?")) {
		rejouer = false;
		alert ("Au revoir !") 
	}
}
