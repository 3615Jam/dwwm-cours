<?php

// imports 
include_once('session_active.php');
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

// connexion BDD via Singleton 
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

// requête SQL 
$sql = "SELECT CONCAT(co.NO_COMMANDE, ' - ',cl.SOCIETE) AS title,
co.DATE_COMMANDE AS start, 
IFNULL(co.DATE_ENVOI, co.DATE_COMMANDE) AS end
FROM commandes co
JOIN clients cl
ON co.CODE_CLIENT = cl.CODE_CLIENT";

echo Singleton::getJson($sql);
