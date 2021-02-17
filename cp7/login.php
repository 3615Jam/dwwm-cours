<?php
include_once('constants.php');

try {
    // verif et sécurisation des variables 'mail' et 'pass' de $_POST 
    if (isset($_POST['mail']) && !empty($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
    }

    if (isset($_POST['pass']) && !empty($_POST['mail'])) {
        $pass = htmlspecialchars($_POST['pass']);
    }

    // si on a bien $mail et $pass, on les encrypte avant comparaison avec infos BDD 
    $mail = MD5($mail);
    $pass = hash('sha512', sha1($pass) . $mail);

    // connexion BDD via PDO 
    $cnn = new PDO(
        'mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8',
        USER,
        PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );

    // on prépare de la requête 
    $sql = "SELECT * FROM users WHERE mail=? AND pass=?";
    $qry = $cnn->prepare($sql);
    $vals = array($mail, $pass);
    // on execute la requête
    $qry->execute($vals);
    // si 1 ligne est retournée --> match ok ! on se connecte
    if ($qry->rowCount() === 1) {
        // démarrage (ou récupération si existe) de session 
        session_start();
        $_SESSION['connected'] = true;
        $_SESSION['session_id'] = session_id();
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['mail'] = $_POST['mail'];
        // routage vers bo.php
        header('location:bo.php');
    } else {
        // routage vers index1.php avec infos 
        header('location:index1.php?c=1');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
