const insererDansTableau = (tab, elem, pos) => {
	const aRetourner = []; 
	for(i=0; i < tab.length; i++) {
		if (i == pos) {
			aRetourner.push(elem);
		}
		aRetourner.push(tab[i]);
	}
	return aRetourner; 
}; 
insererDansTableau([3,1,7],11,1);



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



const inverser = (tableau) => { 
	const aRetourner = []; 
	for(i = 0; i < tableau.length; i++) {
		aRetourner.unshift(tableau[i]); 
	}
	return aRetourner; 
};
inverser([6,3,9,90]);



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 



const tableauBonjour = [3, 5, 7, 9, "hello", "salut", "ola", "namaste"];
const posHello = tableauBonjour.indexOf("hello");
console.log(posHello); 