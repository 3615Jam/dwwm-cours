const creerMultiplieur = (facteur) => {
	const aRetourner = (x) => {
		return (x * facteur);
	}
	return aRetourner;
}

/* version simplifée : 
const creerMultiplieur = facteur => x => x * facteur;
*/ 

const doubleur = creerMultiplieur(2);
console.log(doubleur(7));

const tripleur = creerMultiplieur(3); 
console.log(tripleur(9));