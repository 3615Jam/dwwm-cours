<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body class="container">


    <div class="jumbotron mt-3 mb-5" id="bo">
        <h2>Back-Office</h2>
        <section id="tables" class="mb-5 d-flex flex-wrap justify-content-between">

            <?php
            // on récupère les constantes 
            include_once('constants.php');

            // on se connecte à la BDD via PDO
            try {
                $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS);
                $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // on prépare la requête 
                $res = $cnn->query("SELECT table_name, table_rows FROM information_schema.tables WHERE table_schema = 'northwind'");
                // on parcours la requête 
                $res->setFetchMode(PDO::FETCH_ASSOC);
                $html = '';
                foreach ($res as $row) {
                    $html .= '<div class="card m-3 text-center" style="width: 18rem;"><div class="card-body"><h5 class="card-title">' . $row['TABLE_NAME'] . '</h5>';
                    // $html .= '<p class="card-text">Clé primaire : ' . $row['COLUMN_NAME'] . '</p>';
                    $html .= '<p class="card-text">Lignes : ' . $row['TABLE_ROWS'] . '</p>';
                    $html .= '<a class="btn btn-secondary m-1" href="list.php?t=' . $row['TABLE_NAME'] . '&k=' . $row['COLUMN_NAME'] . '.php">Détails</a>';
                    $html .= '</div></div>';
                }
                echo $html;
                // déconnexion BDD 
                unset($cnn);
            } catch (Exception $e) {
                echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
            }
            ?>

        </section>
    </div>

</body>

</html>