/*
Stockage Local avec interface localStorage 
*/

document.getElementById('saveLocal').addEventListener(
    "click",
    function() {
        // purge les données
        localStorage.clear();
        // stocke chaque donnée des input / select 
        let aElements = document.querySelectorAll('form [name]');
        for(let i = 0; i < aElements.length; i++) {
            localStorage.setItem(aElements[i].name, aElements[i].value);
        }
        alert("localStorage effectué avec succès !")
    },
    false
);
