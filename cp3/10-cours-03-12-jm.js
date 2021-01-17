/* --- ex 1 : 

Implémenter une fonction qui additionne 2 nombres. 
Cette fonction devra tester les valeurs reçues en paramètre
et déclenchera une exception si un de ses paramètres n'est pas un 'number'.

A la suite de ça, on fera passer la fonction dans un try catch, en gérant la survenue d'erreur. 

On fera un 1er try catch sans erreur (en passant des nombres)
et un 2eme en passant autre chose que des 'number'. 

*/





function testTryCatch(num1, num2) {
	if (typeof num1 != "number" || typeof num2 != "number") {
		throw TypeError ("Un des paramètres n'est pas un nombre"); 
	}
	let result = num1 + num2;
	return result;
};

try {
	testTryCatch(3,5);		// version sans erreur 
//	testTryCatch(3,"b");	// version avec erreur 
} catch(error) {
	console.log(error);
} finally {
	console.log("Finally.");
}
	

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



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

console.log(getUsers);



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



fetch('https://randomuser.me/api/')
	.then(reponse => reponse.json())
	.then(result => setUser(result))
	.catch() 


