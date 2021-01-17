const ttt = [5, 2, 3, 9];
const f = (t) => {
  for (let i = 0; i < t.length; i++) {
    console.log(t[i]);
  }
};

f(ttt);

// for ... of
const f2 = (t) => {
  for (element of ttt) {
    console.log(element);
  }
};

// taille du tableau
ttt.length;

// ajouter un élément à la fin:
const element = 11;
ttt.push(element);

// enlever un élément à la fin en le récupérant:
const elem = ttt.pop();

// ajouter un élément au début du tableau:
ttt.unshift(elem);

// enlever un élément du début du tableau:
const elem2 = ttt.shift();

// accès à un élément:
const elem3 = ttt[0];
ttt[0] = 62;

// rq: deux syntaxes d'accès au membre d'un objet:
// 1- L'opérateur d'indirection '.'
// 2- Les []
// la différence étant que les crochets permettes d'avoir
// des noms qui ne seraient pas des noms de variable valide.

ttt["length"];
// et :
ttt.length;
// sont équivalents!
/*
Exercice:
Ecrire le corps de la fonction, qui prend en argument un tableau,
un élement et une position et qui retourne un nouveau tableau
où l'élément a été inséré à la position donnée

const insererDansTableau = (tab, elem, pos) => {
    const aRetourner = [];
    // Mettre ici le code répondant à l'exercice!

    return aRetourner;
};

si je fais insererDansTableau([3,1,7],11,1)
je veux obtenir: [3,11,1,7]
*/

const insertdata = (arr, elem, pos) => {
  const retourner = [];
  let ins = false;
  for (let index = 0; index < arr.length; index++) {
    if (index == pos) {
      retourner[pos] = elem;
      ins = true;
    }
    ins == true
      ? (retourner[index + 1] = arr[index])
      : (retourner[index] = arr[index]);
  }
  return retourner;
};
const ttttt = [3, 1, 7];
insertdata(ttttt, 11, 2);

// au début
//[]  [3] [3,1, 11] [3,1,11,7]

const insererDansTableau = (tab, elem, pos) => {
  const aRetourner = [];
  // Mettre ici le code répondant à l'exercice!
  for (let i = 0; i < tab.length; i++) {
    if (i == pos) {
      aRetourner.push(elem);
    }
    aRetourner.push(tab[i]);
  }
  return aRetourner;
};

/*
Ecrire une fonction, qui lorsqu'on l'appelle on lui passant
un tableau, nous renvoi un nouveau tableau, contenant
les éléments de celui qui nous a été passé, mais en ordre inverse
(à l'envers)

si je fais inverser([6,3,9,90]);
je veux obtenir: [90,9,3,6]
*/

const desString = ["hello", "salut", "ola", "hola", "namaste"];
const inverseur = (tableau) => {
  const aRetourner = [];
  for (let i = 0; i < tableau.length; i++) {
    aRetourner.unshift(tableau[i]);
    //aRetourner.push(tableau.pop())
  }
  return aRetourner;
};

const desStringInversé = inverseur(desString);

/*
0 est une valeur litérale de type number
[0] est une valeur litérale représantant un tableau avec un seul élément (0 en l'occurence)
t[0] là c'est l'accès au premier élément du tableau "t"

const element = ["hello", "salut", "ola", "hola", "namaste"][2];
console.log(element);


*/

/*
partir de [3,5,7,9]
on veut [6,10,14,18]

La fonction map, prend en argument une fonction qui effectue un traitement
pour un seul élément, et retourne un nouveau tableau, ayant pour valeurs
les résultats obtenus en passant chaque élément du tableau à gauche du "."
à la fonction passée en argument à map.
*/

const desNumber = [3, 5, 7, 9];

const résultat = desNumber.map((x) => {
  return x * 2;
});

/* map est une fonction qui permet d'obtenir un nouveau tableu en transformant
une à une les valeur de l'ancien tableau,
par une fonction qu'on passe en argument à map */

const inverserSigne = (x) => {
  return -x;
};
const desNumberInversés = desNumber.map(inverserSigne);

// remarque: map est à utiliser avec des fonctions sans effet de bord
// Si on voulait, pour chaque élément, exécuter une fonction avec effet de bord
// (comme console.log) on aurrait à appeler forEach
// Exemple:
desNumber.forEach(console.log);

/*
Si l'on veut filtrer les valeurs d'un tableau selon un certain critère:
1- on définit une fonction qui retroune true quand le critère est vérifié et false sinon
2- j'utilise la fonction filter en lui passant ma fonction de test/critère
*/

const supA5 = (x) => x > 5;

desNumber.filter(supA5);

/*
Si j'ai deux tableau, et que je veux les concaténer
par exemple avec:
const desNumber = [3, 5, 7, 9];
const desString = ["hello", "salut", "ola", "hola", "namaste"];
je veux obtenir :
 [3, 5, 7, 9, "hello", "salut", "ola", "hola", "namaste"]
*/

const lesDeuxTableauxSoudés = desNumber.concat(desString);

/*
Si je veux avoir une tranche de tableau, la fonction "slice" est bien pratique
exemple d'usage:
nomTableau.slice(indiceDebutTrancheInclus, indiceFinTrancheExclu)
*/

const premièreMoitié = desNumber.slice(0, 2);

// [3, 5]

lesDeuxTableauxSoudés.slice(3, 5);

// remque: si on ne passe qu'un seul argument, alors
// le tableau retourné ira de l'indice que constitue le premier argument
// jusqu'à la fin du tableau

lesDeuxTableauxSoudés.slice(5);

// Exemple d'usage, réécriture de la fonction insererDansTableau
// vue précédemment

const insererDansTableau = (tab, elem, position) => {
  return tab.slice(0, position).concat([elem]).concat(tab.slice(position));
};

// remarque: en enchainant l'éxécution de fonctions, on fera attention à n'utiliser
// que des fonction qui rendent ici dans notre cas un array

// Les string ont des points communs avec les array
const message = "hello";
const caractère = message[2];

// Exercice d'autonomie:
// trouver la fonction javascript qui retourne l'indice (index en anglais)
// d'un élément donnée, dans un tableau
// Enstuite la licge de code qui me trouve l'indice de "hello" dans
// [3, 5, 7, 9, "hello", "salut", "ola", "hola", "namaste"]

lesDeuxTableauxSoudés.indexOf("hello");

// Destructuration de tableau:
// on dispose de desNumber, tableau avec 4 éléments
/* au lieu d'écrire ceci:
const a = desNumber[0];
const b = desNumber[1];
const c = desNumber[2];
const d = desNumber[3];
*/

const [a1, b1, c1, d1] = desNumber;

// si je ne veux récupérer que les 2ème et 4ème éléments!

const [, b2, , d2] = desNumber;

const [, , c3] = desNumber;

// Les objets
/*
Pour l'instant on a vu quelques types d'objets:
- tableau
- fonctions

*/

// Syntaxe pour un litéral d'objet:

// vide:
const emptyObj = {};

// Exemple de litéral d'objet

const literalObj = {
  attribut1: 273273,
  attribut2: false,
  attribut3: desNumber,
  méthode1: insererDansTableau,
};
// Un objet est une collection données, où chaque donnée est nommée.
// ici la deuxième donnée est nommée attribut2 et a pour valeur false
// chaque "donnée" est appelée membre.
// Si le memebre est une fonction on parlera de méthode (ça veut dire fonction
// contenue dans objet)

//Syntaxe d'accès aux membres:
literalObj.attribut1;

// Stntaxe moins commune, utilisé surtout dans les cas où
// le nom de la propriété ne pas être un nom valide de variable
literalObj["attribut2"];

// modifier la valeur d'un membre:
literalObj.attribut2 = true;

// créer un nouveau membre et lui donner une valeur
// à la volée:
literalObj.attribut4 = "merci";
literalObj.méthode2 = (x, y) => (x > y ? x : y);

// ou syntaxe moins commune:
literalObj[3] = "troisième choix";

/*
On fera attention à garder l'esprit "orienté objet" et à minima
essayer de ne mettre dans un même objet que des données et fonctions
qui ont "quelque chose" à voir les uns avec les autres
*/

/*
Ecrire une fonction (qu'on nommera askUser) qui ne prend pas d'argument et qui demande
à l'utilisateur avec des pompts successifs son nom, prénom, age, code postal,et qui
retourne un objet contenant ces données.
Exemple d'objet retourné:
{
  nom : "Berbiche",
  prenom : "Kamel",
  age : 37,
  codePostale : 75019
}

à l'usage elle donnerait:
const userData = askUser();
*/
//Methode1
function askUser() {
  const literalObj = {
    nom: prompt("Donnez votre nom"),
    prenom: prompt("Donnez votre prenom"),
    age: Number(prompt("Donnez votre age")),
    codePostale: Number(prompt("Donnez votre Code postale")),
  };
  return literalObj;
}

///Methode2
function askUser2() {
  return {
    nom: prompt("Donnez votre nom"),
    prenom: prompt("Donnez votre prenom"),
    age: Number(prompt("Donnez votre age")),
    codePostale: Number(prompt("Donnez votre Code postale")),
  };
}

//Methode3
function askUser3() {
  const aRetourner = {};
  aRetourner.nom = prompt("Donnez votre nom");
  aRetourner.prenom = prompt("Donnez votre prenom");
  aRetourner.age = Number(prompt("Donnez votre age"));
  aRetourner.codePostale = Number(prompt("Donnez votre Code postale"));
  return aRetourner;
}

//Méthode 4
function askUser4() {
  const aRetourner = {
    nom: "",
    prenom: "",
    age: 0,
    codePostale: 0
  };
  aRetourner.nom = prompt("Donnez votre nom");
  aRetourner.prenom = prompt("Donnez votre prenom");
  aRetourner.age = Number(prompt("Donnez votre age"));
  aRetourner.codePostale = Number(prompt("Donnez votre Code postale"));
  return aRetourner;
}

