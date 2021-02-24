<?php

// imports 
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

// - - - - - - - - - - - - - - - - - - - 
// tests classe 'Singleton' (parent)
// - - - - - - - - - - - - - - - - - - - 

// test 1 : connection 
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

// test 2 : HTML select 
echo Singleton::getHtmlSelect('prod', 'SELECT * FROM produits');
echo '<hr>';

// test 3 : HTML table
// echo Singleton::getHtmlTable('SELECT * FROM commandes WHERE DATE_COMMANDE < ?', array('2019-01-01'));
echo '<hr>';

// - - - - - - - - - - - - - - - - - - - 
// tests classe 'Model' (enfant de 'Singleton')
// - - - - - - - - - - - - - - - - - - - 

// test 4 : instanciation 
$produits = new Model(HOST, 3306, DB, USER, PASS, 'produits');
echo '<hr>';

// test 5 
var_dump($produits->getRows());
echo '<hr>';

// test 6
var_dump($produits->getRow('REF_PRODUIT', '11'));
echo '<hr>';
