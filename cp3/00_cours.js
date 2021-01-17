
/* 
	- JavaScript - 

	Résumé de cours 
	et 
	exercices pratiques 
*/ 





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
01 - SWAP 

*** 01_swap.js *** 

On a 2 variables dont on souhaite échanger les valeurs : 
*/

/* 
1) 
On déclare une 1ere variable qui s'appelle "jm1" et qui a comme valeur "1". 
Puis on déclare une 2eme variable qui s'appelle "jm2" et qui a comme valeur "10". 
*/

let jm1 = 1;
let jm2 = 10;

/* 
2) 
L'astuce consiste a créer une 3eme variable "tampon" qui servira de zone de transit pour l'échange.
On déclare donc une 3eme variable qui s'appelle "tampon" et qui a comme valeur "jm1". 
*/

let tampon = jm1;		// 1

/* 
3) 
On envoie la valeur de "jm1" à "jm2".
Puis on envoie la valeur de "jm2" à "tampon". 
*/

jm1 = jm2;			// 10 
jm2 = tampon;			// 1

/* 
4) 
On vient d'échanger les valeurs des variables "jm1" et "jm2".  
Maintenant on vérifie les valeurs de chaque variable. 
*/

console.log ("la valeur de la 1ere variable est" +jm1); // 10
console.log ("la valeur de la 2eme variable est" +jm2); // 1 





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
02 - BOUCLES WHILE ET DO-WHILE 

*** 02_boucle-01-while.js ***

On veut créer un jeu du type "Choisis un chiffre entre 0 et 10", 
on nous dit "trop grand" ou "trop petit" jusqu'a ce qu'on trouve :
*/

/* 
1) 
On a besoin d'un nombre aléatoire entre 0 et 10. 
La fonction 'Math.random()' renvoit un nombre aléatoire entre 0 et 1.
On multiplie donc 'Math.random()' par 10 pour obtenir un nombre entre 0 et 10.
Mais on obtient un nombre décimal.
La fonction 'Math.trunc()' retire la partie décimale d'un nombre. 
Enfin, on stocke le résultat de ces étapes dans une variable "resultat". 
*/ 

const resultat = Math.trunc(Math.random() * 10);

/* 
2) 
Maintenant on propose au joueur de choisir un nombre entre 0 et 10 avec la fonction 'prompt'.
On stocke le résultat dans une variable "reponse".
Mais la valeur de cette variable sera de type 'string' et pas 'number'.
Il faut donc la convertir en type 'number', grâce à la fonction 'Number'. 
*/

const reponse = Number(prompt("Choisis un chiffre entre 0 et 10 : "));

/* 
3) 
On compare "reponse" à "resultat" : 
	--> Si trop grand : message "Trop grand :(" 
	--> Si trop petit : message "Trop petit :(" 
	--> Sinon : message "Bingo ! Bien joué ;)"
On utilise donc un 'if/else', ainsi qu'un 'alert' pour afficher le message. 
*/

if(reponse > resultat) {
	alert("Trop grand :(");
} else if(reponse < resultat) {
	alert("Trop petit :(");
} else {
	alert("Bingo ! Bien joué ;)");
}

/* 
4)
On veut maintenant que le joueur retente sa chance s'il n'a pas trouvé au 1er coup. 
Il faut donc utiliser une boucle 'while'. 
Tant que "reponse" est différent de "resultat", on refait le 'if/else' de l'étape précédente.
On utilise aussi un 'prompt' au lieu d'un 'alert' pour que le joueur retape 
directement sa nouvelle réponse 
*/

while(reponse !== resultat) {
	if(reponse > resultat) {
		reponse = Number(prompt("Trop grand :( Essaye encore :"));
	} else if(reponse < resultat) {
		reponse = Number(prompt("Trop petit :( Essaye encore :"));
	} else {
	alert("Bingo ! Bien joué ;)");
	}
}

/* 
5) 
Mais il y a un souci à l'étape précédente : la boucle s'exécute tant que "reponse" !== "resultat". 
Donc elle ne s'exécute pas quand on a la bonne réponse, donc pas de message "Bingo ! Bien joué ;)". 
Il faut donc sortir cette dernière étape hors de la boucle. 
*/ 

while(reponse !== resultat) {
	if (reponse > resultat) {
		reponse = Number(prompt("Trop grand :( Essaye encore :")); 
	} else {
		reponse = Number(prompt("Trop petit :( Essaye encore :")); 
	}
}
alert("Bingo ! Bien joué ;)");

/* 
6) 

*** 02_boucle-02-do-while.js *** 

Notre jeu est maintenant fonctionnel ! Mais si on veut rejouer une partie ? 
Pour cela, on incorpore notre code précédent dans une boucle 'do-while' :
1- on commence par déclarer une variable "restart" qui sera fausse en début de partie ;
2- puis met notre jeu dans le 'do' de notre boucle 'do-while' ;
3- la fonction 'confirm' permet d'afficher une boîte de dialogue avec les boutons "ok" et "annuler" ;
cliquer sur "ok" renvoie le boolean 'true', "annuler" renvoie 'false' ;
on remplace donc le 'alert' de fin de partie par un 'confirm' dont on stocke la valeur dans "restart" ;
4- dans une boucle 'do-while', si l'évaluation de la condition est verifiée ('true'), la boucle redémarre. 
Sinon, elle passe à l'étape suivante. 
la condition de 'while' dans notre boucle 'do-while' est donc "restart" : 
	--> si le joueur clique sur "ok", "restart" = 'true' donc la boucle redémarre ( = nouvelle partie) ; 
	--> si le joueur clique sur "annuler", "restart" = 'false', fin de boucle ( = fin de partie) ; 
5- on affiche alors un message "Ok salut !". 
*/ 

let restart = false;			
do { 
	const resultat = Math.trunc(Math.random() * 10);
	let reponse = Number(prompt("Choisis un chiffre entre 0 et 10 : "));
	while(reponse !== resultat) {
		if(reponse > resultat) {
			reponse = Number(prompt("Trop grand :( Essaye encore :"));
		} else {
			reponse = Number(prompt("Trop petit :( Essaye encore :"));
		}
	}
	restart = confirm("Bingo ;) Rejouer ?"); 
}
while(restart);
alert("Ok salut !");

/* 
7) 

*** 02_boucle-03-jeremy.js *** 

Suite comparaison de code avec Jérémy, on rajoute un 'isNaN' pour éviter un bug 
si le joueur ne rentre pas un chiffre dans le 'prompt' 
*/ 

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





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
03 - SWITCH 

*** 03_switch.js ***

Propose une liste d'options ; le code continue à partir du choix sélectionné.
La partie au dessus est zappée, le reste est exécuté, SAUF s'il y a un 'break' à la fin de l'option.
'break' fait sortir brutalement d'une boucle, il ne faut généralement PAS 
l'utiliser ailleurs quand dans un switch. 
Toujours ajouter l'option finale 'default'. 
*/





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
0X - BOUCLE FOR 

On définit directement un compteur, une condition d'arrêt et une altération du compteur. 
*/

/* 
Exemple : on veut compter de 2 en 2 de 0 à 20, en affichant le résultat à chaque étape. 
*/

// Si boucle while = 

let i = 0; 
while(i <= 20) {
	console.log(i);
	i = i + 2;
}

// équivalent boucle for = 

for(let i = 0; i <= 20; i = i + 2) {
	console.log(i);
}





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
04 - FONCTION 

*** 04_fonction-01.js ***

On veut créer une fonction qui permet de multiplier x par y :
*/

/*
1) 
On définit une variable qui est une fonction, qui s'appelle "mult" et qui a 2 paramètres : 
*/

let mult = function(x,y) {
	return(x * y);
}

/* 
2) 
Si une seule instruction, on peut simplifier comme ceci : 
*/ 

let mult = (x,y) => x * y; 

/*
3)
Maintenant qu'on a une fonction "mult" qui permet de multiplier "x" par "y", 
on voudrait créer une fonction "puissance", 
qui permettra de multiplier "x" par lui-même, "y" fois : 
*/

let puissance = function(x,y) { 	// on peut définir à l'avance les valeurs de "x" et "y" : (x=1,y=0) 
	let resultat = 1; 
	for(let i=O; i < y; i++) {
		resultat = mult(resultat,x);
	}
	return resultat;
}

/* 
4) 

*** 04_fonction-02.js ***

On veut maintenant créer une fonction 'multiplieur' qui va nous permettre 
de créer d'autres d'autres sous-fonctions faisant varier le facteur 
de multiplication (double, triple, etc...)
*/ 

const creerMultiplieur = (facteur) => {
	const aRetourner = (x) => {
		return (x * facteur);
	}
	return aRetourner;
}

/*
5) 
Il ne reste plus qu'à créer une variable qui appelle la fonction "creerMultiplieur"
avec comme argument le facteur souhaité : 
*/
const doubleur = creerMultiplieur(2);
console.log(doubleur(7)); 	// 14 (7 * 2)

const tripleur = creerMultiplieur(3); 
console.log(tripleur(9)); 	// 27 (9 * 3)

/* 
6) 
Version simplifée : 
*/
const creerMultiplieur = facteur => x => x * facteur;





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
05 - TABLEAUX (ARRAY) 

*** 05_array-01.js ***

On a un tableau contenant 4 éléments, on veut afficher chaque élément un par un : 
*/

/*
1) 
On définit une variable constante qui est un tableau, qui s'appelle "t" 
et qui contient les éléments suivants : 
*/

const t = ["Hello", "chacun", "chacune", "!"]; 

/* 
2) 
On crée une boucle 'for' avec un compteur qui va compter tant qu'on n'arrive pas 
au dernier élément du tableau et qui va afficher chaque élément. 
*/ 

for(let i = 0; i < t.length; i++) {
	console.log(t[i]); 
}

/*
03) 
Variante en fonction flêchée : 
*/

const afficherChaqueCellule = (t) => {
	for (let i = 0; i < t.length; i++) {
		console.log(t[i]);
	}
}

/*
04) 

*** 05_array-02.js ***

On a un tableau "t2" qui contient les éléments suivants : 
*/

const t2 = [1, 2, 3, 4]; 

/* 
5) 
On veut créer une fontion qui créer un nouveau tableau avec les valeurs de "t2" multipliées par 2
*/

const multiplierChaqueCellule = (t2) => {
	const t3 = []; 
	for(let i = 0; i < t2.length; i++) {
		t3.push(t2[i] * 2);					// on prend chaque élément de t2 qu'on * 2 ...
	}										// ... puis qu'on push dans t3
	console.log(t3); 
}
multiplierChaqueCellule(t2); 

/*
6) 

*** 05_array-03.js ***

On a une fonction qui prend en argument un tableau, un élément et une position 
et qui retourne un nouveau tableau où l'élément a été inséré à la position donnée.

Si on fait 'insererDansTableau([3,1,7],11,1);' on veut obtenir '[3, 11, 1, 7]'. 
*/


// Solution complète by Jérémy !! 

const insererDansTableau = (tab, elem, pos) => {
	const aRetourner = []; 							// on crée un tab vide 
	for(i=0; i < tab.length; i++) {					// boucle pour chaque élément du tab
		if (i == pos) {								// si 'i' = 'pos' ...
			aRetourner.push(elem);					// ... on push 'element' 
		}
		aRetourner.push(tab[i]);					// sinon on push chaque élément du 1er tab 
	}
	return aRetourner; 								// on return le nouveau tab rempli 
}; 
insererDansTableau([3,1,7],11,1);					// on appelle la fonction avec comme arguments :
													// 1- un tableau contenant [3,1,7]
													// 2- la valeur 'elem' à push à la postion 'pos'
													// 3- la position 'pos' auquel on veut push 'elem'

/* 
7) 
On veut écrire une fonction qui, lorqu'on l'appelle en lui passant un tableau, 
nous renvoie un nouveau tableau contenant les éléments de celui qui a été passé, 
mais en ordre inverse. 

Si on fait 'inverser([6,3,9,90]);' on veut obtenir '[90,9,3,6]'. 
*/ 

const inverser = (tableau) => { 
	const aRetourner = []; 						// on crée un tab vide 
	for(i = 0; i < tableau.length; i++) {		// boucle pour chaque élément du tab
		aRetourner.unshift(tableau[i]); 		// on unshift (remplir par le début) le nouveau tab 
	}
	return aRetourner; 
};
inverser([6,3,9,90]);

/*
8) 
Exercice de recherche de fonction dans la doc officielle : 
On veut trouver la fonction qui retourne l'indice d'un élément donné dans un tableau.
Ex : on veut trouver l'indice de "hello" dans le tableau suivant : 
'[3, 5, 7, 9, "hello", "salut", "ola", "namaste"]'
*/ 

const tableauBonjour = [3, 5, 7, 9, "hello", "salut", "ola", "namaste"];
const posHello = tableauBonjour.indexOf("hello");
console.log(posHello); 														// index 4, soit 5eme pos





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
06 - OBJETS 

*** 06_objet.js ***

On veut définir une fonction 'askUser' qui *ne prend pas* d'argument, 
qui demande à l'utilisateur (avec des prompts successifs) son nom / prénom / âge / code postal, 
et qui retourne un objet contenant ces données. 

	{
		nom: "Berbiche",
		prenom: "Kamel",
		age: 37,
		codePostal: 75019
	}

A l'usage, elle donnerait : const userData = askUser();
*/

/* 
On commence par créer la fonction qui crée un objet vide. 
Puis on pose les questions à l'utilisateur via des prompts, 
dont on récupère les valeurs qu'on stocke dans des "membres" de notre objet vide,
créés à la volée grace à 'nomObjet.membre ='.
Enfin on retourne l'objet avec ses données. 
*/ 

const askUser = () => {
	const userData = {};
	userData.nom = prompt("Quel est ton nom ?");
	userData.prenom = prompt("Quel est ton prénom ?");
	userData.age = Number(prompt("Quel est ton âge ?"));
	userData.codePostal = Number(prompt("Quel est ton code postal ?"));
	return userData;
}
const userData = askUser();





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -





/* 
07 - Résumé cours du lundi 30/11 

*** 07-cours-30-11-vrac.js ***
*/





// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -




/* 
= = = = = = = = = = = = = = = = = = = = =
=										=
=	W O R K   I N   P R O G R E S S 	=
=										=
= = = = = = = = = = = = = = = = = = = = =
*/




