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
    document.cookie = name + "=" + value + ";expires=" + dToday.toLocaleString() + ";path=" // pour Firefox : ;SameSite=None;Secure"; 
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


