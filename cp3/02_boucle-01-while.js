const resultat = Math.trunc(Math.random() * 10);
let reponse = Number(prompt("Choisis un chiffre entre 0 et 10 : "));
while(reponse !== resultat) {
	if(reponse > resultat) {
		reponse = Number(prompt("Trop grand :( Essaye encore :"));
	} else {
		reponse = Number(prompt("Trop petit :( Essaye encore :"));
	}
}
alert("Bingo ! Bien joué ;)");