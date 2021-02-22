<?php
include_once('session_active.php');
include_once('pdo_connect.php');

// on vérifie si 't', 'k' et 'id' sont présents et définis dans l'URL, sinon message d'erreur 
if (!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) || empty($_GET['k']) || !isset($_GET['id'])) {
    echo C5;
    exit();
}

$table = $_GET['t'];
$primkey = $_GET['k'];
$id_row = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darons Codeurs | Modifications des Tables</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class="container">

    <div class="jumbotron mt-3 mb-3">
        <h1>Modification des tables</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item"><a href="<?php echo 'list.php?t=' . $table . '&k=' . $primkey; ?>">Consultation des tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modification des tables</li>
        </ol>
    </nav>

    <form class="mb-5" action="" method="POST">

        <?php
        try {
            // on prépare la requête en fonction de la présence de '$id_row'
            // si présente, on récupère le contenu de la ligne 
            if (!empty($id_row)) {
                $sql = "SELECT * FROM $table WHERE $primkey = ?";
                $qry = $cnn->prepare($sql);
                $vals = array($id_row);
                $qry->execute($vals);
                $row = $qry->fetch();
            } else {
                // sinon, on ne récupère que les colonnes vides 
                $sql = "SELECT * FROM $table WHERE 1 = 2";  // on lui passe une égalité fausse pour être sûr qu'il ne trouve aucune ligne, et qu'il ne ramène que la structure du tableau 
                $qry = $cnn->prepare($sql);
                $qry->execute();
                for ($i = 0; $i < $qry->columnCount(); $i++) {
                    $row[$qry->getColumnMeta($i)['name']] = '';
                }
            }

            // on rempli le formulaire avec le résultat de la requête
            $type = 'text';
            $html = '';
            foreach ($row as $key => $val) {
                $html .= '<div class="form-group"><label for="' . $key . '">' . $key . '</label>';
                $html .= '<input type="' . $type . '" name="' . $key . '" id="' . $key . '" class="form-control" value="' . $val . '"></div>';
            }
            // bouton SUBMIT
            $html .= '<input type="submit" value="Mettre à jour" class="btn btn-primary"/>';
            // affiche formulaire 
            echo $html;
        } catch (Exception $e) {
            echo '<p class="alert alert-danger">ERREUR : ' . $e->getMessage() . '</p>';
        }
        ?>

    </form>

</body>

</html>