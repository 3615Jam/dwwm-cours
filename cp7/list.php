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
            if (isset($_GET['t']) && !empty($_GET['t'])) {
                $table = $_GET['t'];

                // on prépare la requête
                $sql = 'SELECT * FROM ' . $table;
                $qry = $cnn->prepare($sql);
                $qry->execute();

                // on parcours la requête 

                $html = '';
                $html .= '<table class="table table-dark table-striped"><thead><tr>';
                // on compte le nb de colonnes 
                for ($i = 0; $i < $qry->columnCount(); $i++) {
                    // on récupère la structure des colonnes dans un tableau associatif 
                    $meta = $qry->getColumnMeta($i);
                    // puis on va chercher l'élément 'name' du tableau associatif pour le mettre dans les th générées dynamiquement 
                    $html .= '<th>' . $meta['name'] . '</th>';
                }
                $html .= '</tr></thead><tbody>';

                // on compte le nb de lignes
                while ($row = $qry->fetch()) {
                    $html .= '<tr>';
                    foreach ($row as $key => $val) {
                        $html .= '<td>' . $val . '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody></table>';

                // 3) contenu row

                echo $html;

                // déconnexion BDD 
                unset($cnn);
            } else {
                echo "Cette table ne contient aucune ligne";
            }
        } catch (Exception $e) {
            echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
        }
        ?>

    </section>
</body>

</html>




<?php

/*

            
            // on affiche la liste des colonnes
            $html = "";
            while ($col = mysqli_fetch_field($res)) {
                $html .= "<th>{$col->name}</th>";
            }
            echo $html;
            

        </tr>
    </thead>
    <tbody>

        
        // on affiche les datas de chaque colonne 
        $html = "";
        while ($row = mysqli_fetch_row($res)) {
            $html .= '<tr>';
            foreach ($row as $key => $val) {
                if ($key === 0) {
                    $html .= '<td><a href="edit_cat_form.php?k=' . $val . '">' . $val . '</a></td>';
                }
                // si c'est du BLOB 
                elseif (strpos($val, ";base64,")) {
                    $html .= '<td><img src="' . $val . '" width="150px" /></td>';
                } else {
                    $html .= "<td>{$val}</td>";
                }
            }
            $html .= '</tr>';
        }
        echo $html;
        

    </tbody>
</table>





    // * * * * * * * * * * 

/*

    $html = '';
    foreach ($qry as $row) {
        $html .= '<div class="card m-3 text-center" style="width: 18rem;"><div class="card-body"><h5 class="card-title">' . $row['TABLE_NAME'] . '</h5>';
        $html .= '<p class="card-text">Clé primaire : </p>';
        $html .= '<p class="card-text">' . $row['COLUMN_NAME'] . '</p>';
        $html .= '<p class="card-text">Lignes : ' . $row['TABLE_ROWS'] . '</p>';
        $html .= '<a class="btn btn-secondary m-1" href="list.php?t=' . $row['TABLE_NAME'] . '&k=' . $row['COLUMN_NAME'] . '.php">Détails</a>';
        $html .= '</div></div>';
    }

*/

?>