<?php
include_once('session_active.php');
include_once('pdo_connect.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Tables</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <div class="jumbotron mt-3 mb-3">
        <h1>Consultation des tables</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Consultation de table</li>
        </ol>
    </nav>

    <section>

        <?php
        try {
            // cette page est appelée via 'bo.php' avec 't' (= le nom de la table) 
            // et 'k' (= clé primaire de la table) dans la query string de l'URL
            // donc on vérifie si on a bien un 't' et un 'k' et s'ils sont bien définis
            // sinon on affiche un message et un bouton de redirection 
            if (!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) || empty($_GET['k'])) {
                echo '
                <div class="text-center">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oups !</strong> Il n\'y a rien à afficher ici.
                </div>
                <a class="justify-content-center btn btn-info" href="bo.php">Retour au back-office</a>
                </div>
                ';
            }
            // si 'k' existe et qu'il est défini, on attribue sa valeur (= la clé primaire de la table) à la variable '$primkey'
            if (isset($_GET['k']) && !empty($_GET['k'])) {
                $primkey = $_GET['k'];
            }
            // pareil pour 't' (= la table)
            if (isset($_GET['t']) && !empty($_GET['t'])) {
                $table = $_GET['t'];
            }

            // pagination : on récupère la page active, s'il y en a une (sinon on le fixe à 1) 
            if (isset($_GET['pg']) && !empty($_GET['pg'])) {
                $pg = (int) $_GET['pg'];
            } else {
                $pg = 1;
            }

            // pagination #2 : on récupère le nb de lignes "visibles", si existe
            if (isset($_GET['nb']) && !empty($_GET['nb'])) {
                $nb = (int) $_GET['nb'];
            } else {
                $nb = 5;
            }

            // connexion à la BDD via MYSQLI (avec verif)
            $start = ($pg - 1) * $nb;

            // on récupère la liste des catégories de la BDD 'Northwind'
            $sql = "SELECT * FROM $table LIMIT {$start}, {$nb}";
            $qry = $cnn->prepare($sql);
            $qry->execute();

            /*
                // on prépare la requête
                $sql = 'SELECT * FROM ' . $table;
                $qry = $cnn->prepare($sql);
                $qry->execute();
                */

            // on parcours la requête 
            $html = '';
            $types = [];
            $html .= '<table class="table table-dark table-striped"><thead><tr>';
            // on compte le nb de colonnes 
            for ($i = 0; $i < $qry->columnCount(); $i++) {
                // on récupère les infos des colonnes dans un tableau associatif 
                $meta = $qry->getColumnMeta($i);
                // on récupère les types des colonnes
                $types[$meta['name']] = $meta['native_type'];
                // puis on va chercher l'élément 'name' du tableau associatif pour le mettre dans les 'th' générées dynamiquement 
                $html .= '<th>' . $meta['name'] . '</th>';
            }

            // var_dump($types);
            // exit();

            $html .= '</tr></thead><tbody>';

            // on parcours chaque ligne
            while ($row = $qry->fetch()) {
                $html .= '<tr>';
                foreach ($row as $key => $val) {

                    switch ($types[$key]) {
                        case 'LONG':
                        case 'NEWDECIMAL':
                            $align = 'right';
                            break;
                        case 'DATE':
                            $align = 'center';
                            break;
                        default:
                            $align = 'left';
                    }
                    if ($types[$key] == 'BLOB') {
                        $html .= '<td><img src="' . $val . '" width="150px" /></td>';
                    } else {
                        $html .= '<td>' . $val . '</td>';
                    }
                }
                $html .= '</tr>';
            }
            // on ferme le tableau
            $html .= '</tbody></table>';
            // puis on l'affiche
            echo $html;
        } catch (Exception $e) {
            echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
        }
        ?>

    </section>

    <!-- pagination  -->
    <nav>
        <ul class="pagination justify-content-center">

            <?php

            try {
                // calcul du nb de pages de la pagination 
                $res = $cnn->query("SELECT COUNT(*) AS total FROM $table");

                $row = $res->fetch();
                $pgs = ceil($row['total'] / $nb);

                // affichage de la pagination calculée
                $html = "";

                // bouton page précédente
                $href = $_SERVER['PHP_SELF'] . '?t=' . $table . '&k=' . $primkey . '&pg=' . ($pg - 1) . '&nb=' . $nb;
                $html .= '<li class="page-item ' . ($pg === 1 ? 'disabled' : '') . '"><a class="page-link" href="' . $href . '" aria-label="Next"><span aria-hidden="true">&laquo;</span></a></li>';

                // boutons de pagination 
                for ($i = 1; $i <= $pgs; $i++) {
                    $href = $_SERVER['PHP_SELF'] . '?t=' . $table . '&k=' . $primkey . '&pg=' . $i  . '&nb=' . $nb;
                    $html .= '<li class="page-item ' . ($pg === $i ? 'active' : '') . '"><a class="page-link" href="' . $href . '">' . $i . '</a></li>';
                }

                // bouton page suivante 
                $href = $_SERVER['PHP_SELF'] . '?t=' . $table . '&k=' . $primkey . '&pg=' . ($pg + 1) . '&nb=' . $nb;
                $html .= '<li class="page-item ' . ($pg == $pgs ? 'disabled' : '') . '"><a class="page-link" href="' . $href . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';

                echo $html;
                // déconnexion BDD 
                unset($cnn);
            } catch (Exception $e) {
                echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
            }
            ?>

        </ul>
    </nav>

</body>

</html>