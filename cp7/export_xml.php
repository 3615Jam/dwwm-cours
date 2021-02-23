<?php
// script pour générer un fichier pdf via l'extension 'fpdf' 

include_once('session_active.php');
include_once('pdo_connect.php');

try {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        // requête 
        $table = $_GET['t'];
        $sql = "SELECT * FROM $table";
        $qry = $cnn->query($sql);
        // lit et renvoie les datas 
        $root = new SimpleXMLElement("<$table/>");
        while ($row = $qry->fetch()) {
            $child = $root->addChild(substr($table, 0, strlen($table) - 1));
            foreach ($row as $key => $val) {
                $child->addChild(strtolower($key), $val);
            }
        }
        // déconnexion BDD 
        unset($cnn);
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment; filename="export.xml"');
        echo $root->asXML();
    } else {
        echo 'ERROR : Table not found';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
