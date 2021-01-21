/*
page des scripts JS globaux, pour toutes les pages
*/

// Fonction de calcul de l'âge par rapport à une date donnée 

/**
 * Renvoie l'âge en années entre 2 dates passées en paramètres 
 * @param {string} d1 - 1ere date 
 * @param {string} d2 - 2eme date 
 * @return {number}
*/

function datediff(d1, d2) {
    // on initialise iResult pour stocker et renvoyer le résultat 
    let iResult = 0;
    // on instancie l'objet 'Date' ("= new Date") avec le paramètre 'd1'
    let date1 = new Date(d1);
    let date2 = new Date(d2);
    if(date2 > date1) {
        iResult = date2 - date1;
    } else {
        iResult = date1 - date2;
    }
    iResult = iResult / 1000 / 60 / 60 / 24 / 365.25;
    return Math.floor(iResult);
}



// application de la fonction précédente dans notre formulaire : 

document.getElementById('dob').addEventListener(
        'change',
        function() {
            let iDob = document.getElementById('dob').value;
            let iAge = datediff(iDob, new Date());
            console.log(iAge);
            document.getElementById('age').value = iAge;
        }
);

/*
Lesly's version : 

document.getElementById('dob').addEventListener(
    'change',
    function () {
        document.getElementById('age').value = datediff(this.value, new Date());
    },
    false
);

*/



// message d'alerte pour les cookies : 

// si on clique sur "stay", on ferme le message d'alerte des cookies 
// et on empêche la redirection vers google (preventDefault)
document.getElementById('stay').addEventListener(
    'click',
    function(evt) {
        evt.preventDefault();
        document.getElementById('cookieAlert').style.display = 'none';
    }
);

// pareil si on clique sur l'icone "X" pour fermer 
document.getElementById('close').addEventListener(
    'click',
    function(evt) {
        evt.preventDefault();
        document.getElementById('cookieAlert').style.display = 'none';
    }
);
