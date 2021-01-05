let ficheIndividu = function(lePrenom, leNom, leGenre, lAge, laProfession) {
	this.prenom     = lePrenom;
	this.nom        = leNom;
	this.genre      = leGenre;
	this.age        = lAge;
	this.profession = laProfession;
}

function nouvelleFiche(Prenom, Nom, Genre, Age, Profession) {
	let myFiche = new ficheIndividu(Prenom, Nom, Genre, Age, Profession);
	myFiche.afficheDonnees(); 
}

ficheIndividu.prototype.afficheDonnees = function() {
	if(this.genre == "F") {
		document.getElementById('myPrenom').className     = "ficheFille";
		document.getElementById('myNom').className        = "ficheFille";
		document.getElementById('myGenre').className      = "ficheFille";
		document.getElementById('myAge').className        = "ficheFille";
		document.getElementById('myProfession').className = "ficheFille"; 
	} else {
		document.getElementById('myPrenom').className     = "ficheGarcon";
		document.getElementById('myNom').className        = "ficheGarcon";
		document.getElementById('myGenre').className      = "ficheGarcon";
		document.getElementById('myAge').className        = "ficheGarcon";
		document.getElementById('myProfession').className = "ficheGarcon";
	}

	document.getElementById('myPrenom').innerHTML     = this.prenom;
	document.getElementById('myNom').innerHTML        = this.nom;
	document.getElementById('myGenre').innerHTML      = this.genre;
	document.getElementById('myAge').innerHTML        = this.age;
	document.getElementById('myProfession').innerHTML = this.profession;
}
