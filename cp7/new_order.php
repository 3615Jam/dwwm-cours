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
    <title>Darons Codeurs | Prise de commandes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <div class="jumbotron my-3">
        <h1>Prise de commandes</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item"><a href="calendar.php">Calendrier des commandes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Prise de commandes</li>
        </ol>
    </nav>

    <form action="new_order_save.php" method="post">

        <div class="form-group">
            <label for="NO_COMMANDE">N° de commande</label>
            <input type="number" id="NO_COMMANDE" name="NO_COMMANDE" class="form-control" value="12000">
        </div>

        <div class="form-group">
            <label for="CODE_CLIENT">Client</label>
            <?php echo Singleton::getHtmlSelect('CODE_CLIENT', 'SELECT CODE_CLIENT, SOCIETE FROM clients'); ?>
        </div>

        <div class="form-group">
            <label for="NO_EMPLOYE">Employé(e)</label>
            <?php echo Singleton::getHtmlSelect('NO_EMPLOYE', 'SELECT NO_EMPLOYE, CONCAT(PRENOM,\' \', NOM) FROM employes'); ?>
        </div>

        <div class="form-group">
            <label for="DATE_COMMANDE">Date de commande</label>
            <input type="date" id="DATE_COMMANDE" name="DATE_COMMANDE" class="form-control">
        </div>

        <div class="form-group">
            <label for="DATE_ENVOI">Date d'envoi</label>
            <input type="date" id="DATE_ENVOI" name="DATE_ENVOI" class="form-control">
        </div>

        <div class="form-group">
            <label for="PORT">Frais de port</label>
            <input type="text" id="PORT" name="PORT" class="form-control">
        </div>

        <input type="submit" value="Valider la commande" class="btn btn-primary">

    </form>

</body>

</html>