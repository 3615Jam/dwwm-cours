<?php
include_once('session_active.php');
include_once('pdo_connect.php');

try {
    if (isset($_GET['e']) && !empty($_GET['e'])) {
        $e = $_GET['e'];
    } else {
        $e = 5;
    }

    if (isset($_GET['a']) && !empty($_GET['a'])) {
        $a = $_GET['a'];
    } else {
        $a = 2019;
    }

    $sql = "
    SELECT e.NO_EMPLOYE, e.NOM, YEAR(c.DATE_COMMANDE) as annee, MONTH(c.DATE_COMMANDE) as mois, SUM(d.PRIX_UNITAIRE * d.QUANTITE) * (1 - d.REMISE)) as ca
    FROM employes e
    JOIN commandes c
    ON e.NO_EMPLOYE = c.NO_EMPLOYE
    JOIN details_commandes d
    ON c.NO_COMMANDE = d.NO_COMMANDE
    WHERE e.NO_EMPLOYE = ? 
    AND YEAR(c.DATE_COMMANDE) = ?
    GROUP BY e.NO_EMPLOYE, e.NOM, YEAR(c.DATE_COMMANDE), MONTH(c.DATE_COMMANDE)
    ";

    $qry = $cnn->prepare($sql);

    $qry->execute(array($e, $a));

    $data = $qry->fetchAll();



    // définition de la zone de dession 
    $w = 800;
    $h = 600;
    // 
    // $img = imagecreatetruecolor($w, $h);
    $img = imagecreatefromjpeg('img/bg.jpg');

    // crayons de couleur 
    $black = imagecolorallocate($img, 0, 0, 0);
    $white = imagecolorallocate($img, 255, 255, 255);
    $alpha = imagecolorallocatealpha($img, 255, 255, 255, 63);
    $alea = imagecolorallocatealpha($img, rand(0, 255), rand(0, 255), rand(0, 255), 31);

    // $alpha = imagecolortransparent($img, $white);

    // fond transparent 
    imagefilledrectangle($img, 0, 0, $w, $h, $alpha);

    // variable de calcul 
    $gap = 20;
    $wbar = ($w - ($gap * 2)) / count($data);   // on divise par le nb de colonnes pour que les barres soient correctement réparties
    $hmax = ($h - ($gap * 2));
    $val_max = 150000;                          // CA max pour avoir le "haut" du graphique 

    // dessine l'histogramme via requête 
    for ($i = 0; $i < count($data); $i++) {
        // on calcule la hauteur de chaque barre 
        $hbar = round(($data[$i]['ca'] * ($hmax - $gap)) / $val_max);
        // on remplit la barre avec une couleur aléatoire 
        imagefilledrectangle(
            $img,
            $gap + ($i * $wbar),
            $hmax - $hbar,
            $gap + ($i * $wbar) + $wbar,
            $h - $gap,
            $alea
        );
        // on fait un contour blanc autour de chaque barre
        imagerectangle(
            $img,
            $gap + ($i * $wbar),
            $hmax - $hbar,
            $gap + ($i * $wbar) + $wbar,
            $h - $gap,
            $white
        );
        // on rajoute des labels 
        imagestring($img, 5, $gap + ($i * $wbar) + $wbar / 2, $h - $hbar, round($data[$i]['ca'] / 1000) . ' K Euros', $black);
        // graduation bas de barres 
        imagestring($img, 5, $gap + ($i * $wbar) + $wbar / 2, $h - $hbar, $data[$i]['mois'], $black);
    }

    // on définit le format de l'image 
    header('Content-Type: image/png');
    // on affiche le résultat 
    imagepng($img);
    // on supprime l'image générée 
    imagedestroy($img);
} catch (PDOException $e) {
    $e->getMessage();
}
