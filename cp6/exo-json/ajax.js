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