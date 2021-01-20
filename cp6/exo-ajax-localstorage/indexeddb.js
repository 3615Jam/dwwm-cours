/*
Création d'une base de données locale IndexedDB 
*/

// lors du clic sur le bouton "saveIndexedDB", on récupèrera les infos du formulaire sous forme d'objets :

document.getElementById('saveIndexedDB').addEventListener(
    'click',
    function() {
        // si IndexedDB est supporté
        if(window.indexedDB) {
            // on ouvre la BDD 
            let oIDB = window.indexedDB;
            let oCnn = oIDB.open('darons-codeurs', 1);
            // définit la structure si besoin, 1er passage seulement 
            oCnn.addEventListener(
                'upgradeneeded',
                function() {
                    // connexion à la BDD
                    let oDb = oCnn.result;
                    // crée 'ObjectStore' si besoin 
                    if(!oDb.objectStoreNames.contains('repertoire')) {
                        let oStore = oDb.createObjectStore('repertoire', {autoIncrement:true});
                        let oIdx = oStore.createIndex('IndexZip', ['zip']);
                    }
                },
                false
            );
            // si connexion ok 
            oCnn.addEventListener(
                'success',
                function() {
                    // connexion à la BDD
                    let oDb = oCnn.result;
                    // on démarre une transaction 
                    let oTx = oDb.transaction(['repertoire'], 'readwrite');
                    // ouvre 'ObjecStore'
                    let oStore = oTx.objectStore('repertoire');
                    // on sauvegarde les données du formulaire en récupérant les éléments du formulaire qui contiennent un attribut 'name'
                    let aElements = document.querySelectorAll('form [name]');
                    let oData = {};
                    for(let i = 0; i < aElements.length; i++) {
                        oData[aElements[i].name] = aElements[i].value;
                    }
                    // on stocke l'objet 
                    let oReq = oStore.put(oData);
                    // si stockage OK 
                    oReq.addEventListener(
                        'success',
                        function() {
                            alert("Stockage IndexedDB réalisé avec succès");
                        },
                        false
                    );
                    // si stockage KO
                    oReq.addEventListener(
                        'error',
                        function(oErr) { 
                            alert("Erreur IDB : " + oErr); 
                        },
                        false
                    );
                    // si transaction finie 
                    oTx.addEventListener(
                        'complete',
                        function() {
                            oDb.close();
                        },
                        false
                    );
                },
                false
            );
            // si connexion KO
            oCnn.addEventListener(
                'error',
                function() {
                    alert("Erreur de connexion IDB");
                },
                false
            );
        } else {
            alert("IndexedDB n'est pas supporté sur ce navigateur");
        }
    },
    false
);
