/*
Quelques fonctions utiles sur les strings
*/

// Petit rappel:
// Ayant une string comme celle ci
const message = "Bonjour les loulous!";

// On peut acéder à un caractère en particulier
// avec la même que pour les tableau

console.log(message[9]);

// Sur les tableaux on avait vu indexOf;
// cette méthode est disponible pour les string
// retourne l'indice de la première occurence de la chaîne
// passée en argument
message.indexOf("o");
// à la différence des array, sur les string on peut rechercher
// un motif avec indexOf
message.indexOf("loulous");

// trim permet de se débarasser des caractères blanc
// autours des caractères alphabétiques et symboles
const message2 = "   Bonjour les loulous!   ";
const message2SansEspacesAutours = message2.trim();

// une autre fonction commune avec les arrays: slice
const uneTranche = message.slice(2, 10);

// Si je veux éclater une string en plusieurs morceaux,
// en précisant un séparateur:
const messageEclaté = message.split(" ");
// donne: ["Bonjour", "les", "loulous!"]

/*
On a passé une chaine de caractères en argument, ici la chaîne est simple
c'est un espace " ", mais ça aurait pu être n'importe quelle chaîne
*/
message.split("ou");
// donne: ["Bonj", "r les l", "l", "s!"]
// la valeur retournée est un array.

/*
Inversement si je dispose d'un array contenant des strings, et que je veux
générer une "phrase" (une grosse string), en précisant mon séparateur,
la méthode join sera utile. C'est une méthode disponible dans les arrays
*/
const lesMots = ["Bonjour", "chacun", "chacune", "ça", "va?"];

const laPhraseGénérée = lesMots.join(",");
// on obtient "Bonjour,chacun,chacune,ça,va?"

/*
Si je veux générer une string en répétant un certain nombre de fois une autre
string, je peux utiliser la méthode repeat
*/
"Hello toi ".repeat(5);

/*
En javascript, toutes les valeurs mis à part undefined et null, sont "équipées"
d'un prototype qui les enrichit avec des méthodes utiles.
Attention, pour certains types comme les number, on ne peux pas accéder à
ses méthodes en partant d'une valeur litérale.
*/

/*
Exercice 1:
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
Ecrire une fonction qui fait la même chose que slice, mais sans utiliser split ou
les autres méthodes utilitaires des strings. On pourra accéder aux différents caractères
via la syntaxe message[i]
*/

const commaSeparatedValues = `dzdzd,dzdzdz,dzdzd,zddzdz\nvrvfrv,vzvrrz,vrzvr,vrvrv\nfddf,gdgf,ggger,gggjj`;

// version function
function lineSplitterFunction(uneString) {
  return uneString.split("\n");
}

// version const truc = function(){}
const lineSplitterFunctionValue = function (uneString) {
  return uneString.split("\n");
};

//  exo 1: version =>
const lineSplitterFlêché = (uneString) => uneString.split("\n");

// exo 2: version => et paradigme fonctionnel
const csvSplitter = (uneString) =>
  uneString.split("\n").map((ligne) => ligne.split(","));

// Exo 2: version paradigme imperatif:
function csvSplitterImperatif(uneString) {
  let tab = uneString.split("\n");
  let tab2 = [];

  for (let ligne of tab) {
    tab2.push(ligne.split(","));
  }

  return tab2;
}

/*
------------------------------------------------------------
Nom       | Num Client | Somme dépensée | Date d'inscription
------------------------------------------------------------
Martin    | 295396792  | 254.22         | 22/02/2018
Martin    | 295396792  | 254.22         | 22/02/2018
Martin    | 295396792  | 254.22         | 22/02/2018
Martin    | 295396792  | 254.22         | 01/02/2020

const csv = "Martin,295396792,254.22,22/02/2018\nMartin,295396792,254.22,22/02/2018\nMartin,295396792,254.22,22/02/2018\nMartin,295396792,254.22,22/02/2018"
const csvSplitter = (uneString) =>
  uneString.split("\n").map((ligne) => ligne.split(","));
const r = csvSplitter(csv);

r[2][3] //-> 01/02/2020
Pour la petite histoire, ce type de tableau est un tableau multi-dimensionnel.
Ici il est de dimension 2.


*/

/*
Exercice 3:
Ecrire une fonction qui fait la même chose que slice, mais sans utiliser split ou
les autres méthodes utilitaires des strings. On pourra accéder aux différents caractères
via la syntaxe message[i]


const message = "Une string pour l'exemple, encore une";
message.slice(2, 8);
Une fois créée je voudrais pouvoir l'appeler comme ça:
monSlice(message, 2, 8) // -> "e stri"
*/

function monSlice(uneString, indiceDébut, indiceFin) {
  let resultatIntermediaire = [];
  for (let i = indiceDébut; i < indiceFin; i++) {
    resultatIntermediaire.push(uneString[i]);
  }
  return resultatIntermediaire.join("");
}

/*
Exercice 4:
Ecrire une fonction qui fait la même chose que split, mais sans utiliser split ou
les autres méthodes utilitaires des strings. On pourra accéder aux différents caractères
via la syntaxe message[i]
Le cas que nous voulons traiter ici est le cas d'un séparateur à un seul caractère!


const message = "Une string pour l'exemple, encore une";

Une fois créée je voudrais pouvoir l'appeler comme ça:
monSplit(message, " ") // -> ["Une", "string", "pour", "l'exemple,", "encore", "une"]
*/

function monSplit(myString, separator) {
  let mot = [];
  let tab = [];
  for (elem of myString) {
    if (elem !== separator) {
      mot.push(elem);
    } else {
      tab.push(mot.join(""));
      mot = [];
    }
  }
  tab.push(mot.join(""));
  return tab;
}

/*
Challenge: faire l'exo, en mode impératif (à la Samir), pour des séparateur comprenant
un nombre quelconque de caractères.
*/

// Une solution possible
const fnconcat = (start, end, value) => {
  let res = "";
  for (let l = start; l < end; l++) {
    res += value[l];
  }
  return res;
};

const spliterUserDefined = (stringToSplit, divider) => {
  let finres = [];
  let mot = "";
  let lengthToCheck = divider.length;
  for (let i = 0; i < stringToSplit.length; i++) {
    mot += stringToSplit[i];
    if (fnconcat(i, i + lengthToCheck, stringToSplit) == divider) {
      finres.push(fnconcat(0, mot.length - 1, mot));
      i = i + lengthToCheck - 1;
      mot = "";
    }
  }
  finres.push(mot);
  return finres;
};

console.log(spliterUserDefined("asfsas,fsffasa,fadsf,asasasa", ","));

/*
Manipulation d'objets

*/

class Pokemon {
  constructor(name, type) {
    this.name = name;
    this.type = type;
  }
}

const pikachu = new Pokemon("Pikachu", "électrique");

const mesPokemonsTab = [
  ["Pikachu", "électrique"],
  ["Salameche", "feu"],
  ["Tortank", "Hydrocanon"],
  ["Fatal", "Foudre"],
];

// Exemple de transformation d'un tableau de tableaux de strings
// en objet d'une classe voulue
const mesPokemons = mesPokemonsTab.map(
  ([nom, attaque]) => new Pokemon(nom, attaque)
);

const unObjetPokemon = {
  name: "Pikachu",
  attaque: "électrique",
};
// suppose que je veuille permettre à l'utilisatrice de saisir elle même le nom
// d'un pokemon et son attaque

const name = prompt("Veuillez saisir le nom du pokemon:");
const attaque = prompt("Veuillez saisir l'attaque' du pokemon:");

const unObjetPokemonSaisiUtilisatrice = {
  name: name,
  attaque: attaque,
};

// raccourci:
const unObjetPokemonSaisiUtilisatrice2 = { name, attaque };
/*
ça dit à JS stp crée moi un champ qui s'appelle name, et mets y comme valeur
la valeur que tu trouvera dans la variable name à l'extérieur de l'objet
stp crée moi un champ qui s'appelle attaque, et mets y comme valeur
la valeur que tu trouvera dans la variable attaque à l'extérieur de l'objet
*/
console.log({ name, attaque });


/*
Pour accéder à la liste de tous les noms de champs d'un objet:
*/
const tabKeys = Object.keys(unObjetPokemonSaisiUtilisatrice);

/*
Pour accéder à la liste de toutes les valeurs de champs d'un objet:
*/
const tabValues = Object.values(unObjetPokemonSaisiUtilisatrice);

/*
Pour accéder à la liste de toutes les paires nom/valeur d'un objet:
*/
const tabEntries = Object.entries(unObjetPokemonSaisiUtilisatrice);



