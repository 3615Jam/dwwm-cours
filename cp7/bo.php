<?php
/*
// vérification si user est connecté ou pas, sinon redirige vers index1.php avec message pour éviter un accès manuel aux autres pages du site
session_start();
if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header('location:index1.php?c=2');
    exit();
}
*/
// la verif ci-dessus a été remplacée par le script 'session-active' qu'on invoque ci-dessous
include_once('session_active.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Back Office</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body class="container">

    <div class="jumbotron mt-3 mb-3">
        <h1>Back-Office</h1>
        <hr class="my-4">
        <div class="text-center d-flex justify-content-around">
            <a class="btn btn-info btn-lg" href="stats.php" role="button">Statistiques de ventes</a>
            <a class="btn btn-success btn-lg" href="calendar.php" role="button">Calendrier des commandes</a>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Back-Office</li>
        </ol>
    </nav>

    <section id="tables" class="mb-5 d-flex flex-wrap justify-content-between">

        <?php
        // on récupère les constantes 
        include_once('constants.php');

        try {
            // on se connecte à la BDD via PDO
            $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
            $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // on prépare la requête
            $sql = "
                    SELECT t.TABLE_NAME, t.TABLE_ROWS, c.COLUMN_NAME
                    FROM information_schema.tables t
                    JOIN information_schema.columns c
                    ON t.TABLE_SCHEMA = c.TABLE_SCHEMA
                    AND t.TABLE_NAME = c.TABLE_NAME
                    WHERE t.TABLE_SCHEMA = ?
                    AND c.COLUMN_KEY = ?
                    AND t.TABLE_ROWS < ?
                ";
            $qry = $cnn->prepare($sql);
            $vals = array(DB, 'PRI', 1000);
            $qry->execute($vals);

            // on parcours la requête 
            $html = '';
            foreach ($qry as $row) {
                $html .= '
                <div class="card my-3 text-center" style="width: 18rem;">
                <h3 class="card-header">' . $row['TABLE_NAME'] . '</h3>
                <div class="card-body">
                <p class="card-text"><strong>Clé primaire : </strong><br>' . $row['COLUMN_NAME'] . '</p>
                <p class="card-text"><strong>Lignes : </strong>' . $row['TABLE_ROWS'] . '</p>
                <a class="btn btn-primary m-2" href="list.php?t=' . $row['TABLE_NAME'] . '&k=' . $row['COLUMN_NAME'] . '">Détails</a>
                </div>
                </div>
                ';
            }
            echo $html;
            // déconnexion BDD 
            unset($cnn);
        } catch (Exception $e) {
            echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
        }
        ?>

    </section>

</body>

</html>