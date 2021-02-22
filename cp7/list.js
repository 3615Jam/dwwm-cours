// pour éviter la suppression directe d'une ligne dans la BDD 
// on branche un écouteur d'évènement au bouton 'supprimer'

window.addEventListener(
    'load', 
    function() {
        let aBtns = document.querySelectorAll('table a.delete');
        for (let i = 0; i < aBtns.length; i++) {
            aBtns[i].addEventListener(
                'click',
                function (evt) {
                    evt.preventDefault();
                    let bChoice = confirm('Etes-vous vraiment sûr de vouloir supprimer cette ligne ?');
                    if (bChoice) {
                        window.location = this.href; // OU evt.target.href
                    }
                }
            );
        }
    }
);