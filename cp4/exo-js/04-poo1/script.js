let Individu = function(leNom) {
	// le mot-clé THIS désigne le constructeur 'Individu'
	// équivalent à 'Individu.nom = leNom'
	this.nom = leNom;
}

Individu.prototype.direBonjour = function() {
	alert("Bonjour, je suis la méthode de "+this.nom);
}

function declareInstance() {
	let personne01 = new Individu();
	alert('Instance personne01');
	let personne02 = new Individu();
	alert('Instance personne02'); 
}

function declarePropriete() {
	let personne01 = new Individu('Alice'); 
	alert('Propriété de : '+personne01.nom);
	let personne02 = new Individu('Martin'); 
	alert('Propriété de : '+personne02.nom);
}

function declareMethode() {
	let personne01 = new Individu('Charlotte');
	personne01.direBonjour();
	let personne02 = new Individu('Valentin');
	personne02.direBonjour();
}
