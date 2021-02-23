<?php
// script pour générer un fichier JSON

include_once('session_active.php');
include_once('pdo_connect.php');

try {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        // requête 
        $table = $_GET['t'];
        $sql = "SELECT * FROM $table";
        $qry = $cnn->query($sql);
        // lit et renvoie les datas
        $obj = $qry->fetchAll(PDO::FETCH_OBJ);
        header('Content-Type: application/json');
        echo json_encode($obj);
    } else {
        echo 'ERROR : Table not found';
    }
} catch (PDOException $e) {
    $e->getMessage();
}

// déconnexion BDD 
unset($cnn);
