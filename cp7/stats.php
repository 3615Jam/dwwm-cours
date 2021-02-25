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
        <h1>Statistiques des ventes</h1>
        <hr class="my-4">
        <div class="d-flex justify-content-between text-center">

            <div class="card bg-light mb-3" style="width: 25rem;">
                <div class="card-body">
                    <p class="card-text"><strong>Année</strong></p>
                </div>
                <div class="card-footer">
                    <?php echo Singleton::getHtmlSelect('year', 'SELECT DISTINCT YEAR(DATE_COMMANDE) FROM commandes'); ?>
                </div>
            </div>

            <div class="card bg-light mb-3" style="width: 25rem;">
                <div class="card-body">
                    <p class="card-text"><strong>Employé.e</strong></p>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <?php echo Singleton::getHtmlSelect('emp', 'SELECT NO_EMPLOYE, CONCAT(PRENOM,\' \', NOM) FROM employes'); ?>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Statistiques des ventes</li>
        </ol>
    </nav>

    <div class="text-center">
        <img src="chart.php" id="chart">
    </div>

    <script src="stats.js"></script>

</body>

</html>