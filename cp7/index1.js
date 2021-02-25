
// avant envoi du formulaire, on veut vérifier si les strings des 2 champs mot de passe sont bien identiques :

// 1) on branche un écouteur d'évènements au 1er formulaire de la page (index1.php)
document.getElementsByTagName('form')[0].addEventListener(
    'submit',
    function (evt) {
        // on empêche l'envoi direct du formulaire avant vérif 
        evt.preventDefault();
        // Teste si les mots de passe sont équivalents
        if (document.getElementById('pass').value === document.getElementById('check').value) {
            this.submit();
        } else {
            alert('Les mots de passe ne correspondent pas.');
        }
    },
    false
);