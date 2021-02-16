<?php
include_once('constants.php');

try {
    // verif et sécurisation des variables 'mail' et 'pass' de $_POST 
    if (isset($_POST['mail']) && !empty($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
    }

    if (isset($_POST['pass']) && !empty($_POST['mail'])) {
        $pass = htmlspecialchars($_POST['pass']);
    }

    // si on a bien nos $mail et $pass, on peut les encrypter avant comparaison avec infos BDD 




    // connexion BDD via PDO 
    $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // query select count * = 1 







    // si user connu --> bo.php
    if ("user existe") {
        header('location:bo.php');
    }
    // sinon --> index.php?user=ko 
    else {
        header('location:index.php?user=ko');
    }
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
