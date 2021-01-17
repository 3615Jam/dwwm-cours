const resultat = Math.trunc(Math.random() * 10);
let reponse = "";
const bouton = document.getElementById('boutonReponse');
let incrInputId = 0;																// MERCI Mohamed !!! incrémentera l'id des futures nouvelles <input> 
// alert(resultat);																	// juste pour les tests de fonctionnement


// fonction qui génère tous les nouveaux éléments en cas de tour suivant : 
function newElement(phrase) {
	incrInputId++;																	// incrémente compteur des ID des nouvelles <input>
	let newParagraph = document.createElement('p');									// on créé un nouveau <p> 
	newParagraph.textContent=phrase;												// on rempli le <p> précédent avec la phrase des fonctions de chaque cas de figure 
	document.getElementById('main').appendChild(newParagraph);						// on push le nouveau <p> rempli dans le DOM 
	let newInput = document.createElement('input');									// on créé une nouvelle <input> 
	newInput.setAttribute("id","champReponse"+incrInputId+"");						// MERCI Mohamed !!! on lui donne l'attribut "id" dont la valeur est l'id de l'<input> d'origine incrémentée de 1
	document.getElementById('main').appendChild(newInput);							// on push la nouvelle <input> dans le DOM 
	document.getElementById("champReponse"+(incrInputId-1)+"").disabled = true;		// BONUS : on rend 'disabled' l'<input> précédente (id = compteur -1)
};

// quand le joueur ne remplit rien : 
function coquinVide() { 
	newElement("Ta réponse est vide, petit coquin ! Essaye encore :");
};

// quand le joueur tape autre chose qu'un chiffre : 
function coquinNan() {
	newElement(`"${reponse}" n'est pas un chiffre, petit coquin ! Essaye encore :`);
};

// quand le joueur a bien tapé un chiffre mais pas le bon : 
function tourSuivant(arg) {
	newElement(`${reponse} est trop ${arg} ! Essaye encore :`);						// (arg) sera "petit" ou "grand" selon 
};

// quand le joueur a gagné : 
function win() {
	document.getElementById('boutonReponse').disabled = true;						// on désactive le bouton "jouer" pour ne pas relancer un nouveau résultat 
	let newParagraph = document.createElement('p');									// on créé un nouveau <p> 
	newParagraph.textContent = "Bingo ! Tu as trouvé ;)";							// on rempli le <p> précédent avec la phrase de victoire 
	document.getElementById('main').appendChild(newParagraph);						// on push le nouveau <p> rempli dans le DOM 
	let newBouton = document.createElement('button');								// on crée un nouveau 'button' pour relancer une nouvelle partie 
	newBouton.setAttribute("onclick", "location.reload(true)");						// on lui donne l'attribut 'onclick' et la valeur 'location.reload(true)' pour recharger la page en cas de clic ('location.reload()' = simple reload / 'location.reload(true)' = hard reload)
	newBouton.innerHTML = "Rejouer ?";												// on modifie le HTML du bouton pour le renommer "Rejouer ?"
	document.getElementById('second').appendChild(newBouton);						// on push le 'button' "Rejouer ?" dans le DOM 
};


// quand le joueur clique sur le bouton "jouer" : 
bouton.onclick = function() {
	reponse = document.getElementById("champReponse"+incrInputId+"").value;			// MERCI Mohamed !!! on récupère la valeur de l'<input> "champReponseX", 'X' étant égal à 'incrInputId', qui représente le nombre du tour actuel
//	alert(reponse);																	// juste pour les tests de fonctionnement
//	alert(resultat);																// juste pour les tests de fonctionnement
	if(isNaN(reponse)) {
		coquinNan();
	} else if(reponse === "") {
		coquinVide();
	} else if(reponse > resultat) {
		tourSuivant("grand");
	} else if(reponse < resultat) {
		tourSuivant("petit");
	} else {
		win();
	}
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - -



/*

// - - - - 1ere version (presque) fonctionnelle mais (à peine) redondante - - - -

const resultat = Math.trunc(Math.random() * 10);
let reponse = "";
const bouton = document.getElementById('boutonReponse');

alert(resultat);

const coquinNan = function() {
	let newParagraph = document.createElement('p');
	newParagraph.textContent = `"${reponse}" n'est pas un chiffre, petit coquin ! Essaye encore :`;
	document.getElementById('main').insertBefore(newParagraph, document.getElementById('champReponse'));
	let newInput = document.createElement('input');
	document.getElementById('main').insertBefore(newInput, document.getElementById('champReponse'));
};

const coquinVide = function() {
	let newParagraph = document.createElement('p');
	newParagraph.textContent = "Ta réponse est vide, petit coquin ! Essaye encore :";
	document.getElementById('main').appendChild(newParagraph);
	let newInput = document.createElement('input');
	document.getElementById('main').appendChild(newInput);
};

const tropGrand = function() {
	let newParagraph = document.createElement('p');
	newParagraph.textContent = `${reponse} est trop grand ! Essaye encore :`;
	document.getElementById('main').appendChild(newParagraph);
	let newInput = document.createElement('input');
	document.getElementById('main').appendChild(newInput);
};

const tropPetit = function() {
	let newParagraph = document.createElement('p');
	newParagraph.textContent = `${reponse} est trop petit ! Essaye encore :`;
	document.getElementById('main').appendChild(newParagraph);
	let newInput = document.createElement('input');
	document.getElementById('main').appendChild(newInput);
};

const win = function() {
	let newParagraph = document.createElement('p');
	newParagraph.textContent = "Bingo ! Tu as trouvé ;)";
	document.getElementById('main').appendChild(newParagraph);
};

bouton.onclick = function() {
	reponse = document.getElementsByTagName('input').value;			// a modif !!!!!
	alert(reponse);
	alert(resultat);
	if(isNaN(reponse)) {
		coquinNan();
	} else if(reponse === "") {
		coquinVide();
	} else if(reponse > resultat) {
		tropGrand();
	} else if(reponse < resultat) {
		tropPetit();
	} else {
		win();
	}
};

// - - - - - - - - - - - - - - - - - - - - - - - - - - - -

*/



/*

// - - - - test option "disabled" - - - - 

const bouton = document.getElementById('boutonReponse');

let test = document.querySelector('input');

bouton.onclick = function() {
	let newInput = document.createElement('input');
	document.getElementById('main').insertBefore(newInput, document.getElementById('champReponse'));
	let test = newInput.previousSibling;
	test.disabled = true;

//	test.disabled = true;
};

let lastInput = document.getElementsByTagName('input').previousSibling;

// - - - - - - - - - - - - - - - - - - - - - - - - - - - -

*/



/* 

// - - - - exo d'origine - - - -

let restart = false;			
do { 
	const resultat = Math.trunc(Math.random() * 10);							// ok
	let reponse = Number(prompt("Choisis un chiffre entre 0 et 10 : "));		// ok
	while(reponse !== resultat) {
		if(isNaN(reponse)) {
			reponse = prompt("Ceci n'est pas un chiffre, recommence :");		// ok
		} else if(reponse > resultat) {
			reponse = Number(prompt("Trop grand :( Essaye encore :"));			// ok
		} else {																
			reponse = Number(prompt("Trop petit :( Essaye encore :"));			// ok
		}
	}
	restart = confirm("Bingo ;) Rejouer ?"); 									// ok 
}
while(restart);
alert("Ok salut !");

// - - - - - - - - - - - - - - - - - - - - - - - - - - - -

*/ 
