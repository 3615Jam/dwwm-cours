/*



// 1er jet, avant correction : 



// je crée mon compteur : 
let compteur = 0; 

// je crée ma fonction ++ : 
incrementer = () => compteur++; 

// je crée ma fonction -- : 
decrementer = () => compteur--; 

// quand je clic sur le bouton "+1", je déclenche ma fonction 'incrementer' :
document.getElementById('boutonPlus').onclick = incrementer(); 

// quand je clic sur le bouton "-1", je déclenche ma fonction 'decrementer' :
document.getElementById('boutonMoins').onclick = decrementer(); 



// après relecture du cours, le soir : 



// je capte le contenu de mon paragraphe à modifier : 
// let paragraph = document.querySelector('p');

// ou bien encore :
let paragraph = document.getElementById('resultatCompteur');

// je modifie le paragraphe avec mon compteur actualisé : 
paragraph = `Le compteur est actuellement à : '${compteur}'`; 

*/



// code final - NON fonctionnel 
// a cette étape j'ai pas encore bien compris l'usage de .textContent : 



/*

let compteur = 0; 
let paragraph = document.getElementById('resultatCompteur').textContent;
paragraph = `Le compteur est actuellement à : '${compteur}'`; 
incrementer = () => compteur++; 
decrementer = () => compteur--; 
document.getElementById('boutonPlus').onclick = incrementer(); 
document.getElementById('boutonMoins').onclick = decrementer(); 

*/




// Code final fonctionnel - avec aide solution Nathan : 

/* 

let compteur = 0; 
let paragraph = document.getElementById('resultatCompteur');
paragraph.textContent = `Le compteur est actuellement à : ${compteur}`; 
const boutonPlus = document.getElementById('boutonPlus'); 
const boutonMoins = document.getElementById('boutonMoins'); 
boutonPlus.onclick = function () {
	compteur++;
	paragraph.textContent = `Le compteur est actuellement à : ${compteur}`; 
};
boutonMoins.onclick = function () {
	compteur--;
	paragraph.textContent = `Le compteur est actuellement à : ${compteur}`; 
};

*/ 



// Code final aveec simplifications - avec aide solution Mohamed : 



let compteur = 0; 
const afficherCompteur = () => document.getElementById('resultatCompteur').textContent = `Le compteur est actuellement à : ${compteur}`;
afficherCompteur();
document.getElementById('boutonPlus').onclick = () => {
	compteur++; 
	afficherCompteur();
};
document.getElementById('boutonMoins').onclick = () => {
	compteur--; 
	afficherCompteur();
};