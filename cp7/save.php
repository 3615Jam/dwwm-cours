<?php

// script de verif connexion user 
include_once('session_active.php');
// script de connexion BDD 
include_once('pdo_connect.php');
// import constantes 
include_once('constants.php');

// script de modification des tables (INSERT ou UPDATE) : 

try {
    // on vérifie si 't', 'k', 'id' existent, 
    // si 't' et 'k' ne sont pas vides
    if (!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) || empty($_GET['k']) || !isset($_GET['id'])) {
        echo C5;
        exit();
    }
    // si existent, on les variabilise 
    $table = $_GET['t'];
    $primkey = $_GET['k'];
    $id_row = $_GET['id'];

    // avec les données récupérées du formulaire, on prépare un tableau de paramètres pour les requêtes 
    $params = [];
    foreach ($_POST as $key => $val) {
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
            $params[] = htmlspecialchars($_POST[$key]);
        } else {
            $params[] = null;
        }
    }

    // préparation de la requête

    if (empty($_GET['id'])) {
        // si 'id' est vide = création de ligne (INSERT) 
        $update = true;
    } else {
        // sinon, 'id' n'est pas vide = mise à jour de ligne (UPDATE)
        $update = false;
    }

    // on lie les paramètres à la requête préparée 
    if (update) {
        // requete update 
    } else {
        // requete insert 
    }

    // on execute la requête préparée 

    // déconnexion BDD 
    unset($cnn);
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
