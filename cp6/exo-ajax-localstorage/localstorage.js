/*
Stockage Local avec interface localStorage 
*/

// Ecriture des données : 

if(document.getElementById('saveLocal')) {
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
}



// Lecture des données :  

if(document.getElementById('readLocal')) {
    document.getElementById('readLocal').addEventListener(
        'click', 
        function() {
            document.getElementById('tblLocal').innerHTML = "";
            let oRow, oCell;
            for(let i = localStorage.length; i >= 0; i--) {
                oRow = document.createElement('tr');
                oCell = document.createElement('td');
                oCell.textContent = localStorage.key(i);
                oRow.appendChild(oCell);
                oCell = document.createElement('td'); 
                oCell.textContent = localStorage.getItem(localStorage.key(i)); 
                oRow.appendChild(oCell); 
                document.getElementById('tblLocal').appendChild(oRow);

            }
        },
        false
    );
}
