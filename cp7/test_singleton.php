<?php

// imports 
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

// - - - - - - - - - - - - - - - - - - - 
// tests classe 'Singleton' (parent)
// - - - - - - - - - - - - - - - - - - - 

echo '<h2>test 1 : connection</h2>';
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

echo '<h2>test 2 : HTML select</h2>';
echo Singleton::getHtmlSelect('prod', 'SELECT * FROM produits');
echo '<hr>';

echo '<h2>test 3 : HTML table</h2>';
// echo Singleton::getHtmlTable('SELECT * FROM commandes WHERE DATE_COMMANDE < ?', array('2019-01-01'));
echo "Ce test ramène une longue liste, il est commenté pour alléger la page";
echo '<hr>';

// - - - - - - - - - - - - - - - - - - - 
// tests classe 'Model' (enfant de 'Singleton')
// - - - - - - - - - - - - - - - - - - - 

echo '<h2>test 4 : instanciation</h2>';
$produits = new Model(HOST, 3306, DB, USER, PASS, 'produits');
echo '<hr>';

echo '<h2>test 5 : getRowS (toutes les lignes)</h2>';
// var_dump($produits->getRows());
echo "Ce test ramène une longue liste, il est commenté pour alléger la page";
echo '<hr>';

echo '<h2>test 6 : getRow (une seule ligne)</h2>';
var_dump($produits->getRow('REF_PRODUIT', '11'));
echo '<hr>';

echo '<h2>test 7 : insert</h2>';
$cat = new Model(HOST, 3306, DB, USER, PASS, 'categories');
$cat->insert(array(
    'CODE_CATEGORIE' => 777,
    'NOM_CATEGORIE' => 'Model Test 7',
    'DESCRIPTION' => 'Test INSERT dans table categories via class Model'
));
var_dump($cat->getRows());
echo "Ce test insère toujours la même valeur, il est commenté pour ne pas générer d'erreurs";
echo '<hr>';

echo '<h2>test 8 : update</h2>';
$cat->update(
    array(
        'CODE_CATEGORIE' => 888,
        'NOM_CATEGORIE' => 'Model Test 8',
        'DESCRIPTION' => 'Test Update Test 7 => Test 8',
    ),
    'CODE_CATEGORIE',
    '777'
);
var_dump($cat->getRows());
echo '<hr>';

echo '<h2>test 9 : delete</h2>';
$cat->delete('CODE_CATEGORIE', 567587);
var_dump($cat->getRows());
echo '<hr>';
