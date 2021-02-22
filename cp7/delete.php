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

    // on prépare la requête SQL 
    $sql = "DELETE FROM $table WHERE $primkey = ?";

    // prepare et execute la requête 
    $qry = $cnn->prepare($sql);
    $qry->execute(array($id_row));
    header("location:list.php?t=$table&k=$primkey&c=6");

    // déconnexion BDD 
    unset($cnn);
} catch (Exception $e) {
    echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
}
