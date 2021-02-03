<?php
// connexion à la BDD via MYSQLI (avec verif) 
$cnn = mysqli_connect('localhost', 'root', 'greta', 'northwind');
if (mysqli_connect_errno()) {
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}
// on récupère la liste des catégories de la BDD 'Northwind'
$res = mysqli_query($cnn, 'SELECT * FROM categories');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders | Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <h1>Liste des catégories</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Catégories</a></li>
        </ol>
    </nav>

    <table class="table table-dark table-striped">
        <thead>
            <tr>

                <?php
                // on affiche la liste des colonnes
                $html = "";
                while ($col = mysqli_fetch_field($res)) {
                    $html .= "<th>{$col->name}</th>";
                }
                echo $html;
                ?>

            </tr>
        </thead>
        <tbody>

            <?php
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
                // var_dump($row);
                // $html .= "<th>{$col->name}</th>";
            }
            echo $html;
            ?>

        </tbody>
    </table>

</body>

</html>