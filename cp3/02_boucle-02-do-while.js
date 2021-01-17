let restart = false;			
do { 
	const resultat = Math.trunc(Math.random() * 10);
	let reponse = Number(prompt("Choisis un chiffre entre 0 et 10 : "));
	while(reponse !== resultat) {
		if(isNaN(reponse)) {
			reponse = prompt("Ceci n'est pas un chiffre, recommence :");
		} else if(reponse > resultat) {
			reponse = Number(prompt("Trop grand :( Essaye encore :"));
		} else {
			reponse = Number(prompt("Trop petit :( Essaye encore :"));
		}
	}
	restart = confirm("Bingo ;) Rejouer ?"); 
}
while(restart);
alert("Ok salut !");