<?php

// imports 
include_once('session_active.php');
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

// connexion BDD via Singleton 
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Statistiques des ventes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>

<body class="container">

    <div class="jumbotron my-3">
        <h1>Prise de commandes</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Prise de commandes</li>
        </ol>
    </nav>

    <form action="orders_save.php" method="post">

        <div class="form-group">
            <label for="NO_COMMANDE">N° de commande</label>
            <input type="number" name="NO_COMMANDE" id="NO_COMMANDE" class="form-control" value="12000">
        </div>

        <div class="form-group">
            <label for="CODE_CLIENT">Client</label>
            <?php echo Singleton::getHtmlSelect('cust', 'SELECT CODE_CLIENT FROM clients'); ?>
        </div>

        <div class="form-group">
            <label for="NO_EMPLOYE">Employé</label>
            <?php echo Singleton::getHtmlSelect('emp', 'SELECT NO_EMPLOYE, CONCAT(PRENOM,\' \', NOM) FROM employes'); ?>
        </div>

        <div class="form-group">
            <label for="DATE_COMMANDE">Date de commande</label>
            <input type="number" name="NO_COMMANDE" id="NO_COMMANDE" class="form-control" value="12000">
        </div>

        <div class="form-group">
            <label for="DATE_ENVOI">Date d'envoi</label>
            <?php echo Singleton::getHtmlSelect('cust', 'SELECT NO_CLIENT FROM clients'); ?>
        </div>

        <div class="form-group">
            <label for="PORT">Frais de port</label>
            <?php echo Singleton::getHtmlSelect('emp', 'SELECT NO_EMPLOYE, CONCAT(PRENOM,\' \', NOM) FROM employes'); ?>
        </div>

    </form>




    <script src="xxx.js"></script>

</body>

</html>