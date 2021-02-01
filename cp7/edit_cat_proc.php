<?php
var_dump($_POST);

// connexion à la BDD via MYSQLI
$sql = "INSERT INTO categories(CODE_CATEGORIE, NOM_CATEGORIE, DESCRIPTION) VALUES({$_POST['CODE_CATEGORIE']}, '{$_POST['NOM_CATEGORIE']}', '{$_POST['DESCRIPTION']}')";
echo $sql;
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
$res = mysqli_query($cnn, $sql);
var_dump($res);
