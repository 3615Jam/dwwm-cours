/*
Création d'une base de données locale IndexedDB 
*/

// 1) Ecriture dans indexedDB : 

// lors du clic sur le bouton "saveIndexedDB", on récupèrera les infos du formulaire sous forme d'objets :

if(document.getElementById('saveIndexedDB')) {
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
                        // info : quand on ouvre une transaction, on peut intéragir avec plusieurs magasins d'objets,
                        // on utilise ici des crochets pour bien comprendre qu'on peut avoir plusieurs magasins à ce niveau 
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
}



// 2) Lecture de indexedDB : 

if(document.getElementById('readIndexedDB')) {
    document.getElementById('readIndexedDB').addEventListener(
        'click',
        function() {
            if(window.indexedDB) { 
                // let oIDB = window.indexedDB;
                // let oCnn = oIDB.open('darons-codeurs', 1); 
                // on peut factoriser les 2 lignes précédentes en 1 seule :
                let oCnn = window.indexedDB.open('darons-codeurs', 1);
                oCnn.addEventListener(
                    'error',
                    function(evt) {
                        alert("Erreur : "+ evt);
                    }
                );

                oCnn.addEventListener(
                    'success',
                    function() {
                        let oDb = oCnn.result; 
                        let oTx = oDb.transaction(['repertoire'], 'readonly');
                        let oStore = oTx.objectStore('repertoire');
                        // on utilise openCursor pour se placer sur les différents objets du magasin d'objets
                        let oReq = oStore.openCursor();
                        // si ouverture curseur KO 
                        oReq.addEventListener(
                            'error',
                            function(evt) {
                                alert("Erreur : "+ evt);
                            }
                        );
                        // si ouverture curseur OK 
                        oReq.addEventListener(
                            'success',
                            function(evt) {
                                let oRow, oCell;
                                let oCursor = evt.target.result; 
                                if(oCursor) {
                                    oRow = document.createElement('tr');
                                    oCell = document.createElement('td');
                                    oCell.textContent = oCursor.primaryKey;
                                    oRow.appendChild(oCell);
                                    oCell = document.createElement('td'); 
                                    oCell.textContent = JSON.stringify(oCursor.value); 
                                    oRow.appendChild(oCell); 
                                    document.getElementById('tblIndexedDB').appendChild(oRow); 
                                    oCursor.continue();
                                }
                            }
                        );
                        oTx.addEventListener(
                            'complete',
                            function() {
                                oDb.close();
                            }
                        );
                    }
                );
            } else {
                alert("IndexedDB n'est pas supporté sur ce navigateur");
            }
        }    
    );
}
