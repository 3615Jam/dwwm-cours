/* 
On branche l'évènement LOAD à WINDOW
*/

window.addEventListener(
	'load',
	function(){
		// requete AJAX
		// step 1 : instanciation de la requête AJAX 
		let oXHR = new XMLHttpRequest; 
		// step 2 : ouverture requête AJAX 
		oXHR.open('get', 'https://restcountries.eu/rest/v2/all', true);
		// step 3 : envoi de la requête AJAX
		oXHR.send();
		// step 4 : traitement retour du serveur
		oXHR.addEventListener(
			'readystatechange',
			function(){
				if(oXHR.status === 200 && oXHR.readyState === 4){
					// on transforme la réponse texte en objet JSON 
					let oData = JSON.parse(oXHR.responseText);
					// on déclare une variable dans laquelle on stockera les options récupérées dans la réponse renvoyée par le serveur
					let oOption;
					// pour chaque pays de l'objet réponse, on récupère les infos dont on a besoin
					for (let i = 0; i < oData.length; i++){
						oOption = document.createElement('option');
						// on récupère le code pays qu'on mettra dans 'oOption' 
						oOption.value = oData[i].alpha2Code;
						// on sélectionne "FR" par défaut :
						if(oOption.value === "FR") {
							oOption.selected = true;
						}
						// on affiche le nom du pays 
						// oOption.textContent = oData[i].name;
						// variante en récupérant le nom français du pays au lieu du nom du pays
						oOption.textContent = oData[i].translations['fr'];
						document.getElementById('land').appendChild(oOption);
					}
				}
			},
			false
		);
	},
	false
);


/*
On créé une fonction qui récupère le pays et le code postal 
pour afficher automatiquement le nom de la ville
*/

function getCity() {
	document.getElementById('city').value = "";
	let sLand = document.getElementById('land').value;
	let sZip = document.getElementById('zip').value;
	let oXHR = new XMLHttpRequest;
	oXHR.open('get', 'https://api.zippopotam.us/' + sLand + '/' + sZip, true);
	oXHR.send();
	oXHR.addEventListener(
		'readystatechange',
		function(){
			if(oXHR.status === 200 && oXHR.readyState === 4){ 
				let oData = JSON.parse(oXHR.responseText);
				document.getElementById('city').value = oData.places[0]['place name'];
			}
		},
		false
	);
}

// puis on branche des écouteurs d'évènements sur "pays" et sur "code postal" :

/* 
quand on utilise 'addEventListener()', il y a 3 paramètres.
pour le second, on peut utiliser une fonction nominative SANS les parenthèses (2eme partie, ci-dessous)
OU bien mettre celle-ci à l'intérieur d'une fonction anonyme (1ere partie, ci-dessous)
*/

document.getElementById('land').addEventListener(
	'change',
	function() {
		getCity();
	},
	false
);

document.getElementById('zip').addEventListener(
	'change',
	getCity,
	false
);
