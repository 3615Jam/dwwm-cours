<?php

// si dans l'URL, on trouve une query string ( "?k=xx" ) 
//on récupère les infos de la table à éditer pour préremplir les inputs du formulaire 

$row = [];
if (isset($_GET['k']) && !empty($_GET['k'])) {
    // connexion à la BDD via MYSQLI (avec verif) 
    $cnn = mysqli_connect('localhost', 'root', 'Midas2213', 'northwind');
    if (mysqli_connect_errno()) {
        printf("Erreur de connexion : %s", mysqli_connect_error());
        exit();
    }
    // on récupère la liste des catégories de la BDD 'Northwind' dont le code cat = $_GET['k]
    $res = mysqli_query($cnn, "SELECT * FROM categories WHERE CODE_CATEGORIE =" . $_GET['k']);
    // on remplit les champs 'values' des inputs 
    $row = mysqli_fetch_assoc($res);
}

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

    <h1>Edition des catégories</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index1.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="edit_cat_list.php">Catégories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edition</li>
        </ol>
    </nav>

    <form action="edit_cat_proc.php<?php echo ($_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ""); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="CODE_CATEGORIE">Code Catégorie :</label>
            <input type="number" name="CODE_CATEGORIE" id="CODE_CATEGORIE" class="form-control" pattern="[0-9]{1,6}" value="<?php echo (!empty($row) ? $row['CODE_CATEGORIE'] : "") ?>" required>
        </div>
        <div class="form-group">
            <label for="NOM_CATEGORIE">Nom Catégorie :</label>
            <input type="text" name="NOM_CATEGORIE" id="NOM_CATEGORIE" class="form-control" pattern="[0-9a-zA-Z\u00C0-\u00FF '\-]{1,25}" value="<?php echo (!empty($row) ? $row['NOM_CATEGORIE'] : "") ?>" required>
        </div>
        <div class="form-group">
            <label for="DESCRIPTION">Description :</label>
            <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control" cols="30" rows="3" required><?php echo (!empty($row) ? $row['DESCRIPTION'] : "") ?></textarea>
        </div>
        <div class="custom-file mb-5">
            <label class="custom-file-label" for="PHOTO">Ajouter une image</label>
            <input type="file" name="PHOTO" id="PHOTO" class="custom-file-input" accept=".jpg, .jpeg, .png, .gif, .webp">
            <input type="hidden" name="MAX_FILE_SIZE" value="512000">
            <input type="hidden" name="TEST_PHOTO" value="<?php echo (!empty($row) ? $row['PHOTO'] : "") ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer" class="btn btn-primary">
        </div>
    </form>

</body>

</html>