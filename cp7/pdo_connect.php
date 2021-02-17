<?php
// on récupère les constantes 
include_once('constants.php');
// connexion BDD via PDO
try {
    $cnn = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8',
        USER,
        PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );
} catch (Exception $e) {
    echo $e->getMessage();
}
