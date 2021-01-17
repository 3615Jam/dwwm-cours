


const message = "Bonjour les loulou!"; 

message.split(" "); 	// ["Bonjour", "les", "loulou!"] 
message.split("ou"); 	// ["Bonj", "r les l", "l", "!"]





const desMots = ["Bonjour", "chacun", "chacune", "ça", "va?"]; 

const bigString = desMots.join(" "); 	// "Bonjour chacun chacune ça va?" 






// exercice 01 : 

/*
Exercice: 
Ecrire une fonction, qui prend une chaîne de caractère en argument, et qui va
créer et retourner un tableau où chaque élément correspond à une ligne de la chaîne.
*/

/*
Exercice (version) 2:
ecrire une fonction qui prend une chaîne de caractères en argument au format csv, et qui 
retourne un tableau de tableaux t, où pour accéder au troisième mot de la deuxième ligne
il suffirait de faire t[1][2].
*/

/*
Exercice 3:
Ecrire une fonction qui fait la même chose que slice, mais sans utiliser slice ou split ou
les autres méthodes utilitaires des strings. On pourra accéder aux différents caractères
via la syntaxe message[i]
*/

const commaSeparatedValues = `dzdzd,dzdzdz,dzdzd,zddzdz\nvrvfrv,vzvrrz,vrzvr,vrvrv\nfddf,gdgf,ggger,gggjj`;



// version 01 avec .split : 

function tableauChaqueLigne(maString) {
	let resultat = maString.split("\n");
	return resultat;
};

// simplification 1 : 

function tableauChaqueLigne(maString) {
	return maString.split("\n");
}

// simplification 2 : 
const tableauChaqueLigne = (maString) => maString.split("\n");







// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -








// version 02 - 

function tableauChaqueLigne2(cvs) {
	let t = cvs.split("\n");
	let t1 = [];
	for (let elem of t) {
		t1.push(elem.split(","));
	}
//	console.log(t);
//	console.log(t1);
	return t1;
};
const commaSeparatedValues = `dzdzd,dzdzdz,dzdzd,zddzdz\nvrvfrv,vzvrrz,vrzvr,vrvrv\nfddf,gdgf,ggger,gggjj`;



						// *** test ***

						function testTest (xyz) {
							test[0].split(",");
							return resul
						}

						const test = ["a,b,c", "d,e,f", "ghi", "jkl"];

						test[0].split(","); 

						// *** fin de test ***



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -




// version 03 - 



function monSlice(uneString, indiceDebut, indiceFin) {
	let sliceDeString = "";

	return sliceDeString;
}








// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -








// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// HORS PROGRAMME, à titre informatif uniquement !!! 
// Gros disclaimer! ne lis surtout pas si ça t'embrouille
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



// Exemple de fonction à plusieurs listes d'arguments:
// une fonction generique qui permet de gérer les accès d'un client selon
// une configation réseau (ip serveurs, num port etc) particulière 
const dataTransfertConfigurer =  (infoNetwork1, infNet2, inf3) => ( userId, amdinRights, superAdmin, mood)  => {
    const uneFonctionEnvoi = "";
    const uneFonctionRequête = "";
    // usage de infoNetwork1, infNet2, inf3
    // et aussi usage de userId, amdinRights, superAdmin  
    
    return [ uneFonctionEnvoi, uneFonctionRequête]
}

const networkConfigured = dataTransfertConfigurer(65467,876,9876);

/*
A ce stade, networkConfigured c'est le même truc que dataTransfertConfigurer
mais où on a finit de fixer/spécifier la configuration réseau
*/

const [send, request] = networkConfigured("hgfg", "uiuhy","hghj","happy");

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

























