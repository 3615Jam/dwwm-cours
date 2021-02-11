<?php

// secu : step 2 
// protection contre les éventuelles injections 
$params = [];
foreach ($_POST as $key => $val) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $params[] = htmlspecialchars($_POST[$key]);
    } else {
        $params[] = null;
    }
}



// connexion à la BDD via MYSQLI (avec verif) 
$cnn = mysqli_connect('localhost', 'root', 'Midas2213', 'northwind');
if (mysqli_connect_errno()) {
    printf("Erreur de connexion : %s", mysqli_connect_error());
    exit();
}



// traitement des images 
// récupération de l'image à téléverser 
if (isset($_FILES['PHOTO']) && ($_FILES['PHOTO']['error'] !== UPLOAD_ERR_NO_FILE)) {
    // variables du fichier à stocker : 
    // variable tableau pour les extensions de fichiers autorisées 
    $authExts = ['jpeg', 'png', 'gif', 'webp'];
    // on récupère le type de fichier en extrayant la fin de la string du type MIME 
    $fileExt = strtolower(substr($_FILES['PHOTO']['type'], strpos($_FILES['PHOTO']['type'], "/") + 1));
    $fileSize = $_FILES['PHOTO']['size'];
    $fileTemp = $_FILES['PHOTO']['tmp_name'];
    // on teste si erreurs 
    $errors = [];
    if (!in_array($fileExt, $authExts)) {
        $errors[] = '<p> Extension du fichier non autorisée : ' . implode(',', $authExts);
    }

    if ($fileSize > (int)$_POST['MAX_FILE_SIZE']) {
        $errors[] = '<p>Fichier trop lourd : ' . ($_POST['MAX_FILE_SIZE'] / 1024) . 'Ko max.';
    }
    // si pas d'erreur 
    if (empty($errors)) {
        // on va récupère le contenu du fichier stocké 
        $bin = file_get_contents($fileTemp);
        // et on l'encode en base64 
        $base64 = 'data:' . $fileExt . ';base64,' . base64_encode($bin);
        $params[3] = $base64;
    } else {
        foreach ($errors as $error) {
            echo $error;
        }
        echo '<a href="edit_cat_form.php">Retour au formulaire</a>';
        exit();
    }
} else {
    $params[3] = $_POST['TEST_PHOTO'];
}



// on vérifie si on fait un UPDATE ou un INSERT 
if (isset($_GET['k']) && !empty($_GET['k'])) {
    $update = true;     // UPDATE
} else {
    $update = false;    // INSERT 
}



// secu : step 3 
// préparation de la requete SQL 
$stmt = mysqli_stmt_init($cnn);

if ($update) {
    $sql = "UPDATE categories SET CODE_CATEGORIE=?, NOM_CATEGORIE=?, DESCRIPTION=?, PHOTO=? WHERE CODE_CATEGORIE = ?";
} else {
    $sql = "INSERT INTO categories(CODE_CATEGORIE, NOM_CATEGORIE, DESCRIPTION, PHOTO) VALUES(?, ?, ?, ?)";
}

if (mysqli_stmt_prepare($stmt, $sql)) {
    // lie les paramètres à la requête préparée
    if ($update) {
        mysqli_stmt_bind_param($stmt, "isssi", $params[0], $params[1], $params[2], $params[3], $_GET['k']);
    } else {
        mysqli_stmt_bind_param($stmt, "isss", $params[0], $params[1], $params[2], $params[3]);
    }
    // execute la requête préparée 
    mysqli_stmt_execute($stmt);
    // ferme le statement 
    mysqli_stmt_close($stmt);
}
mysqli_close($cnn);

header('location: edit_cat_list.php');
