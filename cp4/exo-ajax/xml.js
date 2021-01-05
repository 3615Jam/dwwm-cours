// Méthode d'utilisation de l'objet XMLHttpRequest de JS 

function AfficherCourriel() {
	let xmlHTTP;
	try {
		xmlHTTP = new XMLHttpRequest();
	} catch(error) {
		alert('Votre navigateur ne gère pas AJAX : '+error);
	}

	xmlHTTP.open("GET", "courriel.xml", false);
	xmlHTTP.send();
	let xmlDoc = xmlHTTP.responseXML;
	document.getElementById('De').innerHTML=xmlDoc.getElementsByTagName('De')[0].childNodes[0].nodeValue;
	document.getElementById('Dest').innerHTML=xmlDoc.getElementsByTagName('Dest')[0].childNodes[0].nodeValue;
	document.getElementById('Sujet').innerHTML=xmlDoc.getElementsByTagName('Sujet')[0].childNodes[0].nodeValue;
	document.getElementById('Message').innerHTML=xmlDoc.getElementsByTagName('Message')[0].childNodes[0].nodeValue;
}
