// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



// = = = = = = = = = = =
//   Retour sur 
//   l'asynchronicité 
// = = = = = = = = = = =



/*
Dans le développement web, la programmation asynchrone est connue pour être
 un sujet délicat.

Une opération asynchrone est une opération qui permet à l'ordinateur de "passer"
à d'autres tâches en attendant que l'opération asynchrone soit terminée.
La programmation asynchrone signifie que les opérations qui prennent beaucoup
de temps ne doivent pas interrompre tout le reste du programme.

Les Promise sont des objets qui représentent l'eventuel résultat final d'une opération
asynchrone.
Une Promise peut être dans un de ces trois états:
Pending: c'est l'état initial, on est en attente.
Fulfilled: L'opération s'est terminé avec succès et la Promise dispose maintenant
d'une valeur "résolue".
Rejected: L'opération s'est terminé mais a été rejetée, les infos sur la raison
se trouveront le plus souvent dans un objet Error
*/

// Créer une promesse:
const executorFunction = (resolve, reject) => {};
const myFirstPromise = new Promise(executorFunction);

/*
La fonction executorFunction a deux paramètres qui sont des fonctions, généralement
appelés fonction resolve() et fonction reject(). Les fonctions resolve() et reject()
ne sont pas définies par le programmeur. Lorsque le constructeur Promise s'exécute,
JavaScript passe ses propres fonctions resolve() et reject() à la fonction d'exécution.

resolve est une fonction à un argument, si invoquée, elle va provoquer le changement
d'état vers fulfilled, et la valeur résolue lui sera passée en argument.

reject prend aussi un seul argument, une erreur ou la "raison" de l'échec. Son appel
fera passer l'état de la Promise à rejected

*/

const executorFunction1 = (resolve, reject) => {
  if (someCondition) {
    resolve("I resolved!");
  } else {
    reject("I rejected!");
  }
};
const myFirstPromise1 = new Promise(executorFunction);

/*
 Dans notre exemple, myFirstPromise résout ou rejette sur la base d'une simple
 condition, mais, en pratique, les promesses s'établissent sur la base des résultats
 d'opérations asynchrones. Par exemple, une requête de base de données peut être
 satisfaite avec les données d'une requête ou rejetée avec une erreur lancée.
 Dans cet exemple, nous allons construire des promesses qui se résolvent de manière
 synchrone pour comprendre plus facilement leur fonctionnement.

  */

const inventory = {
  sunglasses: 1900,
  pants: 1088,
  bags: 1344,
};

const myExecutor = (resolve, reject) => {
  if (inventory.sunglasses > 0) {
    resolve("Sunglasses order processed.");
  } else {
    reject("That item is sold out.");
  }
};

function orderSunglasses() {
  return new Promise(myExecutor);
}

const orderPromise = orderSunglasses();

console.log(orderPromise);

// C'était la partie création de Promise

// Consommer des promesses:

/*
.then() est une fonction d'ordre supérieur qui prend deux fonctions comme arguments.
Nous appelons ces callbacks des "handlers". Lorsque la promesse est tenue,
le gestionnaire approprié sera invoqué la valeur appropriée fixée.

Le premier argument, que l'on pourra appeler onFulfilled, sera le code à exécuter si fulfilled,
le deuxième callback, que l'on pourra appeler onRejected, sera appelé si rejetée.

On peu appelet .then avec 0, 1 ou 2 arguments passés, le plus souvent on lui passera seulement
un argument, le onFulfilled.

.then retourne une Promise en plus d'appeler l'un des callback passés.
*/

// Exemple où l'on ne prend en compte que le cas fulfilled:

const prom = new Promise((resolve, reject) => {
  resolve("Yay!");
});

const onFulfilled = (resolvedValue) => {
  console.log(resolvedValue);
};

prom.then(onFulfilled);

// Exemple plus réaliste:
let prom2 = new Promise((resolve, reject) => {
  let num = Math.random();
  if (num < 0.5) {
    resolve("ça c'est bien passé!");
  } else {
    reject("Ohhh non, quelle poisse!");
  }
});

const handleSuccess2 = (resolvedValue) => {
  console.log(resolvedValue);
};

const handleFailure2 = (rejectionReason) => {
  console.log(rejectionReason);
};

prom.then(handleSuccess2, handleFailure2);

// On ne sait pas d'avance en général si la Promise se résoud par un succès ou un échec.
// Cependant mettre la logique de résolution et d'erreur dans le même appel peut être fouillu.
// .catch peut être utilisé à la place de cette façon:

prom
  .then((resolvedValue) => {
    console.log(resolvedValue);
  })
  .catch((rejectionReason) => {
    console.log(rejectionReason);
  });

// ou celle ci pour conserver les noms de call backs

prom.then(handleSuccess2).catch(handleFailure2);

/*
Remarque: la fonction passée au then, peut elle même retourner une Promise, ce sera très
utiles lorsque l'on voudra faire se succéder plusieurs traitements.
Si le callback passé au .then retourne une Promise, alors ce sera cette Promise qui sera
retournée par .then au lieu de ce qu'il retourne d'habitude: une nouvelle Promise avec
la même valeur fixée que celle de la première.
*/

/*
Deux erreurs communes avec les Promises:
- oublier de retourner une promise dans le then quand c'est ce qu'il faut faire pour enchainer.
- imbriquer au lieu d'enchainer
*/

// Promise.all()
/*
Prend un array de Promises en argument, et retourne une Promise.
si toutes passent à fulfill, la Promise retournée fulfill, avec une valeur qui sera un array
comprenant chaque valeur résolue de chacune des Promise passées en arg.
Si l'une au moins est rejected, la Promise retournée reject.
*/

let myPromises = Promise.all([
  returnsPromOne(),
  returnsPromTwo(),
  returnsPromThree(),
]);

myPromises
  .then((arrayOfValues) => {
    console.log(arrayOfValues);
  })
  .catch((rejectionReason) => {
    console.log(rejectionReason);
  });



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



// = = = = = = = = = = =
//   async ... await 
// = = = = = = = = = = =



/*
Une fonction javascript asynchrone peut être créée avec le mot clé async
avant le nom de la fonction ou avant les () pour les fonctions flêchées.
Une fonction async retourne toujours une Promis
*/

function helloWorld() {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("Hello World!");
    }, 2000);
  });
}

const msg = async function () {
  //Async Function Expression
  const msg = await helloWorld();
  console.log("Message:", msg);
};

const msg1 = async () => {
  //Async Arrow Function
  const msg = await helloWorld();
  console.log("Message:", msg);
};

msg(); // Message: Hello World! <-- after 2 seconds
msg1(); // Message: Hello World! <-- after 2 seconds

/*
Résoudre des Promises:
En utilisant async...await plusieur aopérations async peuvent s'exécuter
en "parallèle". Si la valeur résolue est requise pour chaque Promise initiée
Promise.all() peut être utilisé pour les combiner, cela permet d'éviter les
blocages non nécessaires.
*/

let promise1 = Promise.resolve(5);
let promise2 = 44;
let promise3 = new Promise(function (resolve, reject) {
  setTimeout(resolve, 100, "foo");
});

Promise.all([promise1, promise2, promise3]).then(function (values) {
  console.log(values);
});
// expected output: Array [5, 44, "foo"]

/*
La syntaxe async..await permet d'écrire du code plus lisible et scalable
pour manipuler des Promises, sous le capot, async await utilise du js
classique avec les Promises


Construire une ou plusieurs promesses ou appels sans await
peut permettre l'exécution simultanée de plusieurs fonctions async.
Grâce à cette approche, un programme peut tirer parti de la concurrence,
et des actions asynchrones peuvent être lancées au sein d'une fonction
async. Puisque l'utilisation du mot-clé await met en pause l'exécution
d'une fonction asynchrone, chaque fonction asynchrone peut être attendue (await)
une fois que sa valeur est requise par la logique du programme.

La syntaxe JavaScript async...await permet d'initier plusieurs promesses
puis de les résoudre pour des valeurs lorsque cela est nécessaire pendant
l'exécution du programme. En tant qu'alternative au chaînage
des fonctions .then(), elle offre une meilleure maintenabilité du
code et une ressemblance étroite avec le code synchrone.
*/

/*
Gestion d'erreur:
Les fonctions asynchrones de JavaScript utilisent des instructions
try...catch pour le traitement des erreurs. Cette méthode permet de
partager la gestion des erreurs pour le code synchrone et asynchrone.
*/

// Pour rapelle:
let json = '{ "age": 30 }'; // incomplete data

try {
  let user = JSON.parse(json); // <-- no errors
  alert(user.name); // no name!
} catch (e) {
  alert("Invalid JSON data!");
}

/*
La syntaxe JavaScript async...await dans l'ES6 offre une nouvelle
façon d'écrire du code plus lisible et plus scablable pour gérer les
promesses. Une fonction JavaScript async peut contenir des expressions
précédées d'un opérateur await. L'opérande de await est une promesse.
Lors d'une expression await, l'exécution de la fonction async est mise
en pause et attend la résolution de la Promise. L'opérateur
await renvoie la valeur résolue de la promesse.
L'opérateur await ne peut être utilisé qu'à l'intérieur d'une
fonction asynchrone.

*/


function helloWorld() {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve("Hello World!");
      }, 2000);
    });
  }
  
  async function msg() {
      
    const msg = await helloWorld();
    console.log("Message:", msg);
  }
  
  msg(); // Message: Hello World! <-- after 2 seconds
  


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



// = = = = = = = = = = =
//   JS et HTML
// = = = = = = = = = = =



// A suivre sur le fichier .html 



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
