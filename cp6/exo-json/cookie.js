/*
Création et gestion des cookies 
*/



/**
 * Ecrit un cookie dans le domaine en cours
 * 
 * @param {string} name - nom du cookie
 * @param {string} value - valeur du cookie
 * @param {number} duration - durée de vie du cookie (en jours)
 */

function writeCookie(name, value, duration) {
    // on commence par tester si 'duration' est un nombre 
    if(isNaN(duration)) {
        throw "La durée doit un nombre de jours";
    } else {
        // date du jour 
        var dToday = new Date(); 
        // ajoute la durée à aujourd'hui
        dToday.setTime(dToday.getTime() + duration * 24 * 60 * 60 * 1000)       
    }
    // écrit le cookie
    document.cookie = name + "=" + value + ";expires=" + dToday.toLocaleString() + ";path=/"; // pour Firefox : ;SameSite=None;Secure"; 
}



/**
 * Lit un cookie dans le domaine en cours
 * 
 * @param {string} name - nom du cookie
 * @return {string} 
 */

function readCookie(name) {
    let aCookies = document.cookie.split(";");
    for (let i = 0; i < aCookies.length; i++) {
        if(aCookies[i].trim().indexOf(name + "=") === 0) {
            // attention, à la prochaine ligne : 'aCookies' != 'aCookies' 
            let aCookie = aCookies[i].split("=");
            return aCookie[1];
        }
    }
}



/**
 * Supprime un cookie dans le domaine en cours
 * 
 * @param {string} name - nom du cookie 
 */

function eraseCookie(name) {
    // pour effacer un cookie, on le crée avec une valeur vide et une durée négative
    writeCookie(name, "", -1);
}



// association des fonctions lors du clic sur le bouton 'Cookie' : 

// chacune de nos 2 pages html "local storage" contient un bouton "Cookie" ("saveCookie" et "readCookie") 
// on rajoute donc un 'if' pour ne brancher l'écouteur d'évènement que s'il trouve le bouton en question 

// pour le bouton "saveCookie" :

if(document.getElementById('saveCookie')) {
    document.getElementById('saveCookie').addEventListener(
        'click',
        function() {
            // on vérifie que l'input 'prénom' ne soit pas vide :
            // 1) on met la valeur de 'prénom' dans une variable
            // 2) puis on compare si cette variable n'est pas une string vide 
            let sName = document.getElementById('fname').value; 
            if(sName !== "") {
                // si 'prénom' n'est pas vide, on continue normalement 
                // on récupère les éléments du formulaire qui ont un attribut 'name', 
                // sauf le 1er, pour éviter que notre cookie s'appelle "prénom=prénom..."
                let aElements = document.querySelectorAll('form [name]:not([name=fname])');
                // on crée un tableau vide dans lequel on pushera les éléments récupérés
                let aValues = [];
                // boucle : pour chaque élément de 'aElements', on push sa valeur dans 'aValues' 
                for(let i=0; i < aElements.length; i++) {
                    aValues.push(aElements[i].value);
                }
                // on joint ensemble les valeurs avec le séparateur ',' 
                let sValues = aValues.join(',');
                // on appelle notre fonction d'écriture du cookie 
                writeCookie(
                    // 1er paramètre : 'name' = la valeur de l'input 'prénom' 
                    document.getElementById('fname').value,
                    // 2eme paramètre : 'value' = les valeurs jointes précédémment ('sValues')
                    sValues,
                    // 3eme paramètre : 'duration' = 7, valeur choisie manuellement 
                    7
                );
                alert("Cookie créé avec succès ;)");
            } else {
                // message d'alerte si input 'prénom' est vide 
                alert("Prénom obligatoire !");
            }
        },
        false
    );
}



// pour le bouton "readCookie" :

if(document.getElementById('readCookie')) {
    document.getElementById('readCookie').addEventListener(
        'click',
        function() {
            let aCookies = document.cookie.split(';');
            let oRow, oCell;
            document.getElementById('tblCookie').innerHTML = "";
            for(let i = 0; xxxxxxxx ; i++) {

            }
        },
        false
    );
}


