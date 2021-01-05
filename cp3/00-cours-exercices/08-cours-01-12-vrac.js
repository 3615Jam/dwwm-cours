/*
Litéraux d'objet:
commence par une '{' et se termine par '}'
Pour différencier d'un bloc de code classique, se rappeler que
les litéraux d'objet se trouveront à des endroits du code
où l'on attend une valeur, typiquement:
const o = ICI
uneFonction(ICI)
Et à l'intérieur de ces accolades, on trouvera une succession
de paires clé/valeur sous cette forme:
cle: valeur
ces paires seront séparées par des virgules.
Ces paires sont aussi appelées membres ou dans certains cas entrées.
Un membre sera appelé méthode si sa valeur est une fonction et
attribut sinon.
S'il n'y a rien entre les accolades, l'objet est vide.

Les valeurs associées à une clé peuvent être de n'importe quel
type: une valeur de type primitif (string, number etc) ou de
type fonction (litéral d'une fonction ou le nom d'une fonction
connue) et aussi array ou d'autres objets.
*/
// Exemple:

const clientObj = {
  name: "Michu",
  firstName: "Pierre",
  age: 27,
  phoneNumbers: [06666666, 09999999, 077877777],
  adresse: {
    streetNumber: "16 rue du Temple",
    postCode: 75003,
    city: "Paris",
  },
};

/*
On remarque que même un objet vide dispose de membres par défaut
hérités de son prototype.
À chaque objet est associé un prototype, le prototype est l'objet
dans lequel l'interpréteur ira chercher un membre si il ne le trouve
pas directement dans l'objet.
Si rien n'est trouvé dans le prototype de clientObj, alors l'interpréteur
ira chercher dans le prototype du prototype.

Ce lien où l'on a un objet ayant un prototype p1 par exemple (le nom p1 est
juste un exemple), p1 ayant lui même un prototype p2 etc; s'appelle la
chaîne de prototypes.
*/

// Pour retrouver le prototype d'un objet:
Object.getPrototypeOf(clientObj);

// Au début de la chaîne de prototypes,
// on dira aussi à la racine, il y a
// l'ancêtre commun: Object.prototype

/*
Si à la création d'un objet on ne précise pas de prototype, ce sera
l'ancêtre commun qui sera mis comme prototype de l'objet créé. Ici par
exemple:
*/

console.log(Object.prototype === Object.getPrototypeOf(clientObj));
// s'évalue à true

/*
Object.prototype étant très générique et généraliste, le langage définit
des prototype mieux spécialisés pour certains types de valeurs, par exemple:
Function.prototype est le prototype de toutes les fonctions.
Array.prototype qui est le prototype commun de tous les arrays.

*/

const clientPrototype = {
  name: "",
  firstName: "",
  age: 0,
  phoneNumbers: [],
  adresse: {
    streetNumber: "",
    postCode: 0,
    city: "",
  },
  creerMessageBienvenue: () => `Bonjour ${this.name}!`,
}; // ici le this n'est pas associé comme dans le cas d'une méthode
// définie avec le mot clé function

/*
Pour créer un objet, d'une manière qui me permet de choisir son prototype:
Object.create(ici on met le prototype voulu)
*/

const client2 = Object.create(clientPrototype);

/*
À propos du this:
- c'est nom, comme tout nom de variable, sa valeur est prédéfinie pour
nous par JavaScript.
- Intuitivement elle correspond à l'objet en cours.
- Dans les fonctions flêchées, le this contiendra une référence
à l'objet dans lequel la fonction est définie.

*/

const clientPrototypeAvecThis = {
  name: "",
  firstName: "",
  age: 0,
  phoneNumbers: [],
  adresse: {
    streetNumber: "",
    postCode: 0,
    city: "",
  },
  creerMessageBienvenue: function () {
    return `Hello ${this.name}!`;
  },
};

const cliente = Object.create(clientPrototypeAvecThis);
cliente.name = "Martine";
cliente.creerMessageBienvenue();

/*
Grosse partie sur le "this" et sa liaison.
(on pourra voir le terme anglais "bind" pour parler de liaison)
En javascript, il est possible d'associer une méthode à un objet de plusieurs
manières:
*/

const person = {
  account: 10000,
  work: function () {
    this.account += 1000;
  },
  printAccount() {
    console.log(this.account);
  },
};
// remarquer ici les deux manières de définir une méthode
person.work();
person.printAccount();
// Le this, quand on est à l'intérieur d'un objet nous permet de faire référence
// à l'objet dans lequel on est.

const goWork = person.work;
goWork();
// Malheureusement l'attribut account n'aura pas changé
// car en javascript, en faisant cette assignation le this perd son lien
// avec l'objet person. Ce qui a fait perdre le lien c'est le fait que
// la valeur de fonction a été assigné, c'est goWork qui a perdu le lien.
// On pourra tout à fait continuer à faire person.work() sans problème.

// Pour forcer le lien entre la fonction et l'objet, et ce sera à faire à chaque
// fois qu'on veut passer une méthode qui n'a pas été définie comme fonction flêchée:
const work2 = person.work.bind(person);

/*
Il nous sera aussi possible de déclarer d'abord une fonction puis de la lier explicitement
à un objet, comme dans:
*/
function afficherAge() {
  console.log(this.age);
}

const martin = {
  age: 18,
};

const afficherAgeMartin = afficherAge.bind(martin);
afficherAge();
afficherAgeMartin();

/*
Pour construire un objet avec des méthodes et afin qu'il soit réutilisable, il
est possible d'utiliser Object.create() à laquelle on passe un prototype
*/
const evennement = {
  getDate: function () {
    console.log(`${this.name} aura lieu en ${this.date}`);
  },
};

const coupeDuMonde = Object.create(evennement);
coupeDuMonde.name = "Coupe du monde";
coupeDuMonde.date = 2022;
coupeDuMonde.getDate();
// Le this aura accès aux champs de l'objet sur lequelle la méthode a été appelé.

// this: celui présent dans le corps de définition de la méthode getDate dans le
//  prototype nommé evennement
// objet sur lequelle la méthode a été appelé: l'objet à gauche du "." dans
//  la ligne de code précédente

/*
On disposera d'un point centralisé pour apporter des modification au comportement
de getDate dans tous les objets ayant été définis avec evennement comme prototype.
Le fait de modifier dans le prototype permettra d'avoir une modification qui se
répercutera partout dans les objets créés avec le prototype!
*/
// Exemple:
evennement.getDate = function () {
  console.log(`The ${this.name} will happen in ${this.date}`);
};

/*
Usage du mot clé "new"

1- On va créer une fonction constructeur, ces fonction ont un nom
qui commence par une majuscule par convention.
*/
// Ceci est un premier exemple de constructeur
function Evenn(n, d) {
  this.name = n;
  this.date = d;
  this.getDate = () =>
    console.log(`Le ${this.name} se produira en ${this.date}`);
}
const deconfinement = new Evenn("Déconfinement total et définitif", 2023);
deconfinement.getDate();

/*
Ce que fait new dans le détail:
*/
//il crée un objet vide
const unEnevenement = {};
// il lui crée un prototype
const prototypeEvennement = {
  getDate() {
    console.log(`Le ${this.name} se produira en ${this.date}`);
  },
};
// il associe le prototype à l'objet:
Object.setPrototypeOf(unEnevenement, prototypeEvennement);

// création des champs
unEnevenement.name = "Fête";
unEnevenement.date = 2021;

// Tous ça est fait par seulement
// const deconfinement = new Evenn("Fête", 2021);

/* Exercice:
1- Créer un objet qui fait sens pour vous dans un scénario imaginaire, en créant d'abord
son prototype puis avec Object.create()
2- Créer un autre objet (autre structure) en créant d'abord un constructeur puis avec new
*/

const basket = {
  getModel: function () {
    console.log(
      `Le modèle ${this.nom} de couleur ${this.couleur} en taille ${this.taille}`
    );
  },
};

const airForceOne = Object.create(basket);
airForceOne.nom = "Air Force One";
airForceOne.couleur = "Bleu";
airForceOne.taille = 43;
airForceOne.getModel();

// Façon constructeur maison

function Basket(nom, couleur, taille) {
  this.nom = nom;
  this.couleur = couleur;
  this.taille = taille;
  this.getModel = () =>
    console.log(
      `Le modèle ${this.nom} de couleur ${this.couleur} en taille ${this.taille}`
    );
}

const airMax90 = new Basket("Air Max 90", "Rouge", 39);
airMax90.getModel();

const armoireChaussures = {
  mesBaskets: [],
  ajouterBasket(basket) {
    if (this.pasDeBoue(basket)) {
      this.mesBaskets.push(basket);
    }
  },
  pasDeBoue = (basket) => true,
};

armoireChaussures.ajouterBasket(airMax90);


/*
Relations entre objets:
- Prototypage: si les deux sont dans la même chaîne de prototype.
- Compostion: lorsque pour constituer un objet A on a besoin d'un certain
nombre d'objets B, on dit qu'il y a composition. Souvent les objets B seront
dans une collection (souvent array), lui même assigné à un attribut de A.

*/

/*
Classes: En javascript, le mot clé class est utilisé surtout comme raccourci.
Cela n'ajoute pas de fonctionalités, et les mécanismes internes restent basés sur
les prototypes.
En définissant une classe en javascript, on définit une fonction constructeur.
*/

class Pokemon {
    constructor(name, type) {
        this.name = name;
        this.type = type;
    }
    useAttack(attack = 'Charge'){
        console.log(`${this.name} utilise ${this.type} pour attaquer!`)
    }
}

const pikachu = new Pokemon('Pikachu', 'électrique');

const mesPokemons = [['Pikatchu', 'électrique'],
            ['Salameche', 'feu'],
            ['Tortank','Hydrocanon'],
            ['Fatal','Foudre']];

// Exemple de transformation d'un tableau de tableaux de strings
// en objet d'une classe voulue
mesPokemons.map(([nom, attaque]) => new Pokemon(nom, attaque))


/*

Opérateur rest:
Ce sont les ... que l'on retrouve à l'intérieur des parenthèses
où on met les arguments à la définition de la fonction!!

Mettre les trois petits poins devant un nom d'argument fait en sorte que dans
le corps de la fonction, cet argument sera un array contenant tout le reste des paramètre
qui lui seront passés lors des appels de fonctions

*/

function sumAll(...lesNombres){
    let resultat = 0;
    for (let nombre of lesNombres){
        resultat += nombre;
    }
    return resultat;
}

const total = sumAll(82, 87 ,25 , 66, 888 , 8888);

/*
Si j'ai quand même besoin d'avoir des paramètres hors du tableau, mais de quand même
pouvoir récupérer tous les paramètres passés en plus, je devrai mettre
mon opérateur rest à la fin de la liste des arguments.
*/

const envoieLienClasseVirtuelle = (nomSession,
     heureDebut,
     prof,
     coordinateurPédagogique,
     ...invités) => {
    // constituer le message en incluant nomSession et heureDebut
    // créer lien mode modérateur et l'envoyer au prof et coordinateurPédagogique
    // créer lien invité et l'envoyer aux invités
}


/*
Exercice: Ecrire une fonction qui prend n paramètres, et vérifie si les n-1 derniers
paramètres sont des multiples du premier.
Elle renvoie true si c'est le cas, et false sinon.


a est multiple de b si:
a % b == 0
*/

// option 1, elle est très bien
const verifyMultiply = (...lesnombres) => {
    const permierelem = lesnombres[0];
    for (let n of lesnombres) {
        if( (n % permierelem) !== 0 ){
            return false;
        }
    }
    return true;
}

// Option 2 fonctionne mais doit parcours tout le tableau
// même si on trouve vite des éléments pas multiples du premier
function functionMultiple(...lesNombres){
    let resultat = true;
    for (let nombre of lesNombres){
        if(nombre % lesNombres[0] !== 0){
            resultat = false;
        }
    }
    return resultat;
}

// Option 3 un peu fouillue
function testMulti(...arguments) {
    let combienDeMultiplesDuPremier = 0;
    for (let i = 1; i <= arguments.length; i++) {
        if (arguments[i] % arguments[0] == 0) {
            combienDeMultiplesDuPremier++;
        }
    }
    if (combienDeMultiplesDuPremier == (arguments.length - 1)) {
        return true;
    }else{
        return false;
    }
}

// Comme l'option 1, en plus lisible pour d'autres devs
const verifyMultiply2 = (diviseur, ...lesnombres) => {
    for (let elem of lesnombres) {
        if(elem % diviseur !== 0 ){
            return false;
        }
    }
    return true;
}




// Suppose que je dispose d'un diviseur,
// Et d'un tableau de nombres
// comment je fais pour envoyer les deux à la fonction ?

const d = 7;
const data = [21, 70, 147, 161, 42, 43];

/*
L'opérateur spread, c'est les ... ailleurs que dans la liste des
paramètres à la définition d'une fonction. À la droite desquels on mettra
un array. Utile pour éclater un array en autant de valeurs qu'il a d'éléments
*/

// On pourra l'utiliser pour passer plein de valeurs différentes d'un coup
// lors de l'appel d'une fonction
verifyMultiply2(d, ...data);
console.log(...data);

// voir même pour copier un tableau de façon:
const copieData = [...data];


// pour fusionner des tableaux
const data2 = [9,8,7];

const dataTotale = [...data, ...data2];



