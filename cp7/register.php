<?php
// Tester avec MYSQLI si le user est reconnu ou pas :

// 1. connexion à bdd
$cnn = mysqli_connect('localhost', 'root', 'root', 'northwind');
if (mysqli_connect_errno()) {
    printf('Erreur de connexion : %s', mysqli_connect_error());
    exit();
}

// 2. requête préparée pour vérifier si mail trouvé
$qry = mysqli_stmt_init($cnn);
$sql = 'SELECT COUNT(*) AS nb FROM users WHERE mail=?';
if (mysqli_stmt_prepare($qry, $sql)) {
    $hash = MD5(htmlspecialchars($_POST['mail']));
    mysqli_stmt_bind_param($qry, 's', $hash);
    mysqli_stmt_execute($qry);
    mysqli_stmt_bind_result($qry, $nb);
    mysqli_stmt_fetch($qry);
    mysqli_stmt_close($qry);
}

if ($nb === 1) {
    // 2a. si oui alors afficher message d'erreur
    echo 'Ce compte existe déjà : ' . $_POST['mail'];
} else {
    // 2b. si non alors créer un nouvel user avec role app_read
    // 2b1 create user
    // 2b2 grant role
    // 2b3 set default role
    // 2b4 tester sur Workbench
}

mysqli_close($cnn);
