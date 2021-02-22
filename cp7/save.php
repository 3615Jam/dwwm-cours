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

    // on prépare les tableaux de paramètres (1 pour le nom des colonnes, 1 pour la valeur des colonnes) pour les requêtes 
    $cols = [];
    $vals = [];

    // UPDATE ou INSERT
    if (empty($id_row)) {
        // si '$id_row' est vide = création de ligne (INSERT)
        // on prépare la requête SQL
        $sql = "INSERT INTO $table(%s) VALUES(%s)";
        // avec les données récupérées du formulaire, on remplit les 2 tableaux de paramètres pour les requêtes 
        foreach ($_POST as $key => $val) {
            $cols[] = $key;
            $vals[":$key"] = htmlspecialchars($val);
        }
        // on lie les paramètres à la requête préparée
        $sql = sprintf(
            $sql,
            implode(',', $cols),
            implode(',', array_keys($vals))
        );
    } else {
        // sinon, '$id_row' n'est pas vide = mise à jour de ligne (UPDATE)
        // on prépare la requête
        $sql = "UPDATE $table SET %s WHERE $primkey = :newid";
        // comme ci-dessus, on remplit les tableaux de paramètres 
        foreach ($_POST as $key => $val) {
            $cols[] = $key . '=:' . $key;
            $vals[":$key"] = htmlspecialchars($val);
        }
        // cas particulier de la modif de l'ID 
        $vals[':newid'] = $id_row;
        // on lie les paramètres à la requête préparée
        $sql = sprintf($sql, implode(',', $cols));
    }
    // prepare et execute la requête 
    $qry = $cnn->prepare($sql);
    $qry->execute($vals);

    // redirection vers list.php avec message de confirmation 
    header("location:list.php?t=$table&k=$primkey&c=6");

    // déconnexion BDD 
    unset($cnn);
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
