<?php

// imports 
include_once('session_active.php');
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Calendrier des commandes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="cal/main.min.css" />
</head>

<body class="container">
    <div class="jumbotron my-3">
        <h1>Calendrier des commandes</h1>
        <hr class="my-4">
        <div class="text-center d-flex justify-content-around">
            <a class="btn btn-info btn-lg" href="new_order.php" role="button">Prendre une commande</a>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calendrier des commandes</li>
        </ol>
    </nav>

    <div id='calendar'></div>

    <!-- ----------[ scripts JS ]---------- -->
    <script src="calendar.js"></script>
    <script src='cal/main.min.js'></script>
</body>

</html>