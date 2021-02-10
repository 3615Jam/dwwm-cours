<?php

include_once('animal.class.php');

echo '<hr>';
echo '<hr>';
echo '<p>* * * Début des tests * * * </p>';
echo '<hr>';
echo '<hr>';

echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal();
$obj1->name = "Milou";
// $obj1->color = "blanc"; remonte une erreur car la variable 'color' est privée
var_dump($obj1);
echo '<p>Méthode "move()" : ' . $obj1->move() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 2 : Accesseurs / mutateurs</h2>';
$obj2 = new Animal();
$obj2->name = "Snoopy";
$obj2->setType('Terrestre');
var_dump($obj2);
echo '<p>Type de Animal#2 : ' . $obj2->getType() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 3 : Constantes de classes</h2>';
echo '<p>' . Animal::TYPE_WATER . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 4 : Verif poids</h2>';
$obj2->setWeight(5.3);
var_dump($obj2);
echo '<p>Poids de Animal#2 : ' . $obj2->getWeight() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 5 : Utilisation du constructeur</h2>';
$obj3 = new Animal("Garfield", Animal::TYPE_GROUND, "Orange", 7.8);
var_dump($obj3);
echo '<p>Méthode "move()" de Garfield : ' . $obj3->move() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 6 : Méthode eat()</h2>';
$obj4 = new Animal("Titi", Animal::TYPE_AIR, "Jaune", 0.3);
var_dump($obj4);
echo '<p>Méthode "move()" de Titi : ' . $obj4->move() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

$obj5 = new Animal("Sylvestre", Animal::TYPE_GROUND, "Noir et blanc", 5.7);
var_dump($obj5);
echo '<p>Méthode "move()" de Sylvestre : ' . $obj5->move() . '</p>';
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<p>Sylvestre bouffe Titi : </p>';
$obj5->eat($obj4);
unset($obj4);
var_dump($obj5);
echo '<p>Nombre d\'instances : ' . Animal::getNb() . '</p>';

echo '<hr>';

echo '<h2>Test 6 : Date of Birth</h2>';
$obj6 = new Animal("Tigrou", Animal::TYPE_GROUND, "Orange et noir", 50000, "1882-02-13");
var_dump($obj6);
echo '<p>Age de Tigrou : ' . $obj6->getDob() . ' ans</p>';

echo '<hr>';
echo '<hr>';
echo '<p>* * * Fin des tests * * * </p>';
echo '<hr>';
echo '<hr>';
