/*
Gestion des erreurs en JavaScrpt:
Trois grosses familles d'erreurs auxquelles on peut être confrontés:
1- Les erreurs de syntaxe: On en est assez protégés avec les éditeurs moderne.
2- Les erreurs compilation: surviennent lors de la traduction du code. (on les aime bien)
3- Les erreurs à l'exécution: les pires! difficile à prédire, difficile à deviner, peuvent
arriver alors qu'on pense que tout fonctionne bien depuis des mois!
Comment s'en protéger en les gérant?
*/

/*
Les objets Error
*/

// Créer lancer une Error:
throw Error("Quelque chose s'est mal passé!");

/*
Le mot clé throw permet de lever (ou lancer) une exception (exception = erreur),
Error() permet d'envoyer un message donnant des infos sur l'endroit où l'erreur s'est produite
Error() est une exception générique (générique = généraliste) mais il existe des Error plus
spécifique:
*/
/*
Quelques exemples d'Error plus spécifique
SyntaxeError();
TypeError();
ReferenceError();
RangeError();
*/

// Exemple, avec :
class Pokemon {
  constructor(name, type) {
    this.name = name;
    this.type = type;
  }
}

// je peux :
const pikachu = new Pokemon("Pikachu", "électrique");
// mais aussi:
const pikachuChelou = new Pokemon({ machin: false }, [1, 6, 1]);
// Sans qu'aucune erreur ne se produise!!!!

// Mais si je décide de tester le type des arguments passés au constructeur,
// et de lancer une exception:
class Pokemon2 {
  constructor(n, type) {
    if (typeof n != "string" || typeof type != "string") {
      throw TypeError("Les arguments passés doivent être du type 'string'");
    }
    //
    const name = n.toUpperCase();
    this.name = name;
    this.type = type;
  }
  attaque() {
    console.log(`Pikachu lance l'attaque ${this.type}`);
  }
}

// Alors on pourra:
const pikachu2 = new Pokemon2("Pikachu", "électrique");

// Mais pas faire ceci sans qu'une erreur se déclenche:
const pikachuChelou2 = new Pokemon2({ machin: false }, [1, 6, 1]);
// Une exception est lancée et ma variable pikachuChelou2 n'est même pas créée!!!
// Le code s'arrête de s'exécuter! Aucune autre instruction suivante ne sera
// exécutée si l'erreur n'a pas été gérée.
// Et il vaut mieux ça plutôt que (par exemple) se retrouver avec une base de donnée
// compromise!!!!

/*
Dans d'autres langages, si on appelle une fonction ou méthode qui peut déclencher des erreurs,
le langage nous oblige à gérer explicitement un éventuel cas d'erreur, mais pas en javascript!
On n'est pas oobligés!!! Cependant, on a tout intérêt à le faire systématiquement.
*/

/*
TRY CATCH FINALLY
Nous permet d'exécuter le bloc suivant 'try', si jamais une exception est levée dans le bloc
'try', alors l'exécution de ce bloc s'arrête et le bloc 'catch' s'exécute.
Et peut importe si une erreur est survenue ou pas, le bloc 'finally' s'exécutera de toute façon!
Le bloc 'finally' est optionnel.

*/

try {
  // code pouvant potentiellement lancer une exception
  const pikachuChelou2 = new Pokemon2({ machin: false }, [1, 6, 1]);
  console.log(
    "Ce message ne s'affiche que si aucune exception levée plus haut."
  );
} catch (error) {
  // code sensé gérer le cas de survenue d'une erreur
  console.log(error);
} finally {
  // souvent code de nettoyage ou de libération de ressources
  // fermeture de connxion par exemple.
  console.log("La fermeture des connexion a bien été effectuée!");
}

/*
Quelque soit le type d'erreur déclenchée dans le bloc 'try', que ce soit une exception levée
par du code js avec 'throw' ou que ce soit un autre type d'exception (assignation à une const
par exemple), l'exécution du bloc 'try' s'arrête, et le bloc 'catch' est exécuté.
*/

/*
Exercice:
Implémenter une fonction qui additionne deux nombres. Cette fonction devra tester
les valeurs reçues en paramètre et déclenchera une exception si un de ses paramètres
n'est pas un number.
À la suite de ça, faite appel à la fonction dans un try catch, en gérant la survenue d'erreur.
On fera un prmier try catch sans erreur (en passant des nombres), et un deuxième en passant
autre chose que des numbers à votre fonction.
*/

function somme(x, y) {
  if (typeof x !== "number" || typeof y !== "number") {
    throw TypeError("Les arguments passés doivent être des nombres");
  }
  return x + y;
}

// Premier try catch, sans erreur
try {
  // code pouvant potentiellement lancer une exception
  const res = somme(5, 9);
  console.log(
    "Ce message ne s'affiche que si aucune exception levée plus haut."
  );
} catch (error) {
  // code sensé gérer le cas de survenue d'une erreur
  console.log(error);
} finally {
  // souvent code de nettoyage ou de libération de ressources
  // fermeture de connxion par exemple.
  console.log("La fermeture des connexion a bien été effectuée!");
}

// deuxième try catch, avec erreurs
try {
  // code pouvant potentiellement lancer une exception
  const res = somme(null, 9);
  console.log(
    "Ce message ne s'affiche que si aucune exception levée plus haut."
  );
} catch (error) {
  // code sensé gérer le cas de survenue d'une erreur
  console.log(error);
} finally {
  // souvent code de nettoyage ou de libération de ressources
  // fermeture de connxion par exemple.
  console.log("La fermeture des connexion a bien été effectuée!");
}

/*
Remarque en passant:
Pour savoir si un objet est un array, sachant que:
typeof([]) donne "object"
On utilisera sans souci la méthode Array.isArray()

*/

/*
Retour sur des bases POO:
Si on dispose d'une classe, et que l'on veut en créer une autre en prenant
la première comme modèle, pour rajouter des fonctionnalités ou des attributs,
on peux penser à l'étendre.
Quelques expressions synonymes:
- étendre une classe
- créer une classe fille
- créer une sous classe
Dans l'autre sens on dira:
- Classe mère
- Classe parent
- super classe
- classe (de) base

*/

class PokemonVéhiculé extends Pokemon2 {
  constructor(name, type, véhicule) {
    // on commence toujours par appeler le constructeur de la super classe
    super(name, type);
    // ici je fais ce que j'ai de spécifique à la classe fille
    this.véhicule = véhicule;
  }

  fuir() {
    console.log(`${this.name} se barre en ${this.véhicule}`);
  }
}

const monPikachuEnScoot = new PokemonVéhiculé("Pikachu", "éclaire", "Piaggio");

// Et je pourrai profiter de la vérification de types implémentée dans la
// classe mère Pokemon2

/*
super() sert à désigner le constructeur de la classe mère.
Il est à appeler en premièr dans le constructeur de la classe fille.
On lui passera en paramètre toutes les données nécessaires au constructeur de
la classe mère pour faire sa part de travail.
Après cet appel à super dans le constru de la classe fille, on fait le travail
spécifique (en plus) à la construction de l'objet voulu.
*/

// ATTENTION: les classe ont été introduite en JS en 2015 dans la version ES6
// si le navigateur ou le truc qui va t'exécuter ton code ne comprend ES6, alors
// il faudra passer par une 'traduction' vers du JS plus ancien, et c'est la version
// traduite qu'on exécutera.
// Cette traduction s'appelle la transpilation.
// On utilisera en pratique un logiciel spécifique pour ça, Babel est le plus répondu.
// Un logiciel comme Babel ne fera que transpiler, il sera bien d'autres chose comme:
// - générer un seul fichier js à partir de mes fichiers de code
// - minifier la le code pour diminuer sa taille











/*
JS Asynchrone
*/

// Mettre en place un timeout:
/*
En premier argument on passe un callback (callback est mot qui s'utilise
pour dire "fonction que je passe à une autre fonction ou à un autre endroit
afin qu'elle soit exécuté ailleurs que dans le contexte exact où l'on est.").
En deuxième argument, on passe le délai en millisecondes.
Puis on passe à timeout les arguments qu'on veux passer au callback lors de son
exécution.

setTimeout renvoi un identifiant utile pour par exemple annuler l'exécution
callback.
*/
const timeoutId = setTimeout(alert, 13000, "Coucou en retard de 13s!");

// Annuler l'exécution du callback:
window.clearTimeout(timeoutId);

/*
Promise
Une promesse est un objet qui encapsule la complétion ou l'échec d'une
opération asynchrone sans prononcer directement.
*/

// Créer une promesse

const getUsers = new Promise((resolve, reject) => {
  setTimeout(() => {
    const users = ["Martin", "Marie"];
    if (Math.random() > 0.5) {
      resolve(users);
    } else {
      reject("Failure");
    }
  }, 1000);
});

// à ce stade la Promise est en attente (pending)
console.log(getUsers);

getUsers
  .then((users) => console.log(users[0]))
  .catch((err) => console.log("Pas de chance!"));
  
/*
Ce qu'il faut absolument retenir est que:
- Lors de sa création, une Promise n'est qu'une promesse, elle contient ""rien""
d'intéressant tout de suite, ce n'est que lors de sa résolution 
qu'on obtiendra quelque chose. (informellement c'est une promesse 
de réponse future à une demande qu'on formule tout de suite )
- Puis à moment la demande est rejetée ou satisfaite.
- Pour récupérer la donnée utile en cas de demande satisfaite on utilisera
 .then sur la Promise.
- Pour réagir au cas où notre demande à été rejeté on utilisera .catch

Aussi bien dans le 'then' que dans le 'catch', on passera une fonction
en argument, fonction qui fera le travail que l'on voudra voir effectué
en cas de succès ou d'échec respectivement.
*/

/*
Depuis ES6, on dispose d'un autre moyen pour rendre le flot d'exécution fluide
(sans attentes) même avec une Promise, il suffira de déclarer sa fonction 
comme étant asynchrone avec le mot clé async
*/

// Cas fonction flêchée:
const getFirstUser = async () => { 
    // faire le taf asynchrone voulu
    return "";
}

// cas de fonctions classiques:
async function getSecondUser() {
    // faire le taf asynchrone voulu
    return "";
}

// À retenir:
// La forme générale d'une fonction qui va exécuter un travail
// asynchrone (BDD, réseau, etc)
const getFirstUser = async () => { 
    try {
        let userArray = await getUsers;// un truc asynchrone qui retourne une Promise
        console.log(usersArray[0]);
    } catch (err) {
        console.log("Oupss!", err);
    }
}



// exemple pratique d'usage d'une Promise
// reçue après un fetch:

// cette fonction setUser n'a rien à voir avec le coté
// asynchrone, c'est sulement pour alléger le code plus bas
const setUser = (resultat) => {
  const user = resultat.results[0];
  console.log(`${user.name.first} vient de se connecter!!!`);
};

fetch("https://randomuser.me/api/")
  .then((response) => response.json())
  .then(setUser)
  .catch((error) => {
    console.log(error);
  });
  
/*
Deux fonctions utiles pour manipuler du JSON:
JSON.stringify() on lui pass un objet, array ou n'importe quelle valeur JS
et elle rend un string sous format JSON

JSON.parse() on lui passe une string au format JSON et elle nous rend un 
objet JS avec la structure qui correspond

JSON.stringify sert à serialiser des données (transformer une entité vivante dans la mémoire
    à l'exécution en string pour pouvoir soit la sauvegarder dans un fichier 
    ou la transmettre via réseau)
    
JSON.parse sert à déserialiser.  

sérialiser est un angliscisme!!
*/


