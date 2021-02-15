<?php
// Tester avec MYSQLI si le user est reconnu ou pas :
include_once('constants.php');

// 1. connexion à bdd
$cnn = mysqli_connect(HOST, USER, PASS, DB);
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
    $qry = mysqli_stmt_init($cnn);
    $sql = 'INSERT INTO users(mail, fname, pass, land, active) VALUES(?, ?, ?, ?, ?)';
    if (mysqli_stmt_prepare($qry, $sql)) {
        $mail = MD5(htmlspecialchars($_POST['mail']));
        $fname = strtolower(htmlspecialchars($_POST['fname']));
        $pass = hash(
            'sha512',
            sha1(htmlspecialchars($_POST['pass']), false) . $mail,
            false
        );
        $land = htmlspecialchars($_POST['land']);
        $active = 0;
        mysqli_stmt_bind_param($qry, 'ssssi', $mail, $fname, $pass, $land, $active);
        $res = mysqli_stmt_execute($qry);
        mysqli_stmt_close($qry);

        // Envoi d'un mail pour confirmation si succès
        if ($res) {
            // Corps du mail
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/jam-web/cp7/register2.php?m=' . $mail;
            $html = '';
            $html .= '<h1>Inscription Darons Codeurs</h1>';
            $html .= '<p>Bonjour ' . $_POST['fname'] . ' ! Bienvenue chez les Darons Codeurs.';
            $html .= '<p>Clique sur le lien suivant pour valider ton inscription : <a href="' . $url . '">' . $url . '</a>';
            $html .= '<p>A très bientôt';
            // En-tête du mail
            $header = "MIME-Version: 1.0 \n"; // Version MIME
            $header .= "Content-type: text/html; charset=utf-8 \n"; // Format du mail
            $header .= "From: contact@daronscodeurs.fr \n"; // Expéditeur
            $header .= "Reply-to: daronscodeurs@gmail.com \n"; // Destinataire de la réponse
            $header .= "Disposition-Notification-To: daronscodeurs@gmail.com \n"; // Accusé de réception
            $header .= "X-Priority: 1 \n"; // Activation importance
            $header .= "X-MSMail-Priority: High \n"; // MS
            // Envoi du mail
            $res2 = mail($_POST['mail'], 'Darons Codeurs', $html, $header);
            echo ($res2 ? 'Succès' : 'Echec');
        } else {
            echo 'Echec dans l\'ajout du user.';
        }
    }
}

mysqli_close($cnn);
