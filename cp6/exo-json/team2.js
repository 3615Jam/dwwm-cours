/*
On veut que la fonction suivante se déclenche à chaque chargement de page : 
On branche l'évènement LOAD à WINDOW 
*/

window.addEventListener(
	'load',
	function(){
		fillTable();
	},
	false
);



/* alternative DOM-0 : 

window.onload = function(){
	fillTable();
};

*/



/*
Fonction pour remplir le tableau HTML avec un array :
*/

function fillTable() {
	// on déclare 2 variables, 1 pour les futures lignes, 1 pour les futures cellules
	let oRow, oCell;
	// boucle pour traiter chaque élément de l'array Members  
	for (let i = 0; i < members.length; i++) {
		// on crée une nouvelle ligne
		oRow = document.createElement('tr');
		// on crée une 1ere nouvelle cellule pour le prénom  
		oCell = document.createElement('td');
		// on remplit la cellule précédemment déclarée (oCell)
		// avec du texte (textContent) 
		// issu de la clé 'fname' 
		// de l'index [i] 
		// de l'array 'members'
		oCell.textContent = members[i].fname;
		oRow.appendChild(oCell); 
		// 2eme cellule pour l'age 
		oCell = document.createElement('td');
		oCell.textContent = members[i].age;
		oRow.appendChild(oCell);
		// 3eme cellule pour le statut 
		// on veut que le texte soit différent en fonction du sexe   
		oCell = document.createElement('td');
		if(members[i].married) {
			if(members[i].sex === "F") {
				oCell.textContent = "Mariée";
			} else {
				oCell.textContent = "Marié";
		 	}

			// variante ternaire : 
			// oCell.textContent = (members[i].sex === "F" ? "Mariée" : "Marié");
			}
			else {
				oCell.textContent = "Célibataire"
			}
		oRow.appendChild(oCell);
		// 
		document.getElementById('tblBody').appendChild(oRow);
	}
}
