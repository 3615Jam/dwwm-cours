<?php
// imports 
include_once('session_active.php');
include_once('constants.php');
include_once('model.class.php');

// connexion BDD via Singleton 
$order = new Model(HOST, 3306, DB, USER, PASS, 'commandes');

$order->insert($_POST);

header('location:calendar.php');
