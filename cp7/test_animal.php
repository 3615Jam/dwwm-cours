<?php

include_once('animal.class.php');

echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal();
$obj1->name = "Milou";
// $obj1->color = "blanc"; remonte une erreur car la variable 'color' est privée
var_dump($obj1);
echo '<p>Méthode "move()" : ' . $obj1->move() . '</p>';

echo '<hr>';

echo '<h2>Test 2 : Accesseurs / mutateurs</h2>';
$obj2 = new Animal();
$obj2->name = "Snoopy";
$obj2->setType('Terrestre');
var_dump($obj2);
echo '<p>Type de Animal#2 : ' . $obj2->getType() . '</p>';

echo '<hr>';

echo '<h2>Test 3 : Constantes de classes</h2>';
echo '<p>' . Animal::TYPE_WATER . '</p>';

echo '<hr>';

echo '<h2>Test 4 : Verif poids</h2>';
$obj2->setWeight(5.3);
var_dump($obj2);
echo '<p>Poids de Animal#2 : ' . $obj2->getWeight() . '</p>';

echo '<hr>';

echo '<h2>Test 5 : Utilisation du constructeur</h2>';
$obj3 = new Animal("Garfield", Animal::TYPE_GROUND, "Orange", 7.8);
var_dump($obj3);
echo '<p>Méthode "move()" : ' . $obj3->move() . '</p>';

echo '<hr>';

echo '<h2>Test 6 : Méthode eat()</h2>';
$obj4 = new Animal("Titi", Animal::TYPE_AIR, "Jaune", 0.3);
$obj5 = new Animal("Sylvestre", Animal::TYPE_GROUND, "Noir et blanc", 5.7);

echo '<p>Sylvestre bouffe Titi : </p>';
$obj5->eat($obj4);
var_dump($obj4);

echo '<br>';
echo '<br>';

var_dump($obj5);

echo '<p>Titi bouffe Sylvestre (!) : </p>';
$obj4->eat($obj5);
var_dump($obj4);

echo '<br>';
echo '<br>';

var_dump($obj5);

echo '<hr>';
