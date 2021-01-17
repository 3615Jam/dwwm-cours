let mult = function(x,y) {
	return(x * y);
}

/* équivalent de "mult" fonction fléchée :
const mult = (x,y) => x * y;
*/

let puissance = function(x,y) { 
	let resultat = 1;
	for(let i=0 ; i < y ; i++) {
		resultat = mult(resultat,x);
	}
	return resultat;
}