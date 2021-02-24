<?php

// on veut faire un graphique fonction des ventes des employés de 'northwind' par mois 

include_once('session_active.php');
include_once('pdo_connect.php');

try {
    // vérif si présence de 'employé' ( = 'e') dans URL et si pas vide, sinon on fixe arbitrairement à 5
    if (isset($_GET['e']) && !empty($_GET['e'])) {
        $e = $_GET['e'];
    } else {
        $e = 5;
    }
    // vérif si présence de 'année' ( = 'a') dans URL et si pas vide, sinon on fixe arbitrairement à 2019
    if (isset($_GET['a']) && !empty($_GET['a'])) {
        $a = $_GET['a'];
    } else {
        $a = 2019;
    }

    // requête SQL 
    $sql = "SELECT e.NO_EMPLOYE, e.NOM, YEAR(c.DATE_COMMANDE) as annee, MONTH(c.DATE_COMMANDE) as mois, SUM((d.PRIX_UNITAIRE * d.QUANTITE) * (1 - d.REMISE)) as ca
    FROM employes e
    JOIN commandes c
    ON e.NO_EMPLOYE = c.NO_EMPLOYE
    JOIN details_commandes d
    ON c.NO_COMMANDE = d.NO_COMMANDE
    WHERE e.NO_EMPLOYE = ? 
    AND YEAR(c.DATE_COMMANDE) = ?
    GROUP BY e.NO_EMPLOYE, e.NOM, YEAR(c.DATE_COMMANDE), MONTH(c.DATE_COMMANDE)";

    // prépare requête 
    $qry = $cnn->prepare($sql);
    // execute requête 
    $qry->execute(array($e, $a));
    // parcours les données 
    $data = $qry->fetchAll();

    // définition de la zone de dession 
    $w = 800;
    $h = 600;
    // si on veut une image à fond noir : 
    // $img = imagecreatetruecolor($w, $h); 
    // sinon on importe une image existante : 
    $img = imagecreatefromjpeg('img/bg.jpg');

    // crayons de couleur 
    $black = imagecolorallocate($img, 0, 0, 0);
    $white = imagecolorallocate($img, 255, 255, 255);
    $alpha = imagecolorallocatealpha($img, 255, 255, 255, 63);
    // $alpha = imagecolortransparent($img, $white);

    // fond transparent 
    imagefilledrectangle($img, 0, 0, $w, $h, $alpha);

    // si data est vide (aucune donnée à afficher) on affiche un message d'alerte 
    if (!$data) {
        imagestring(
            $img,
            5,
            $w / 3,
            $h / 3,
            'Aucune donnee a afficher',
            $black
        );
    } else {

        // variable de calcul 
        $gap = 50;
        $wbar = ($w - ($gap * 2)) / count($data);   // on divise par le nb de colonnes pour que les barres soient correctement réparties
        $hmax = ($h - ($gap * 2));
        $val_max = 150000;                          // CA max pour avoir le "haut" du graphique 

        // dessine l'histogramme via requête 
        for ($i = 0; $i < count($data); $i++) {
            // on calcule la hauteur de chaque barre 
            $hbar = round(($data[$i]['ca'] * ($hmax - $gap)) / $val_max);
            // on remplit la barre avec une couleur aléatoire 
            $alea = imagecolorallocatealpha($img, rand(0, 255), rand(0, 255), rand(0, 255), 31);
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
            // imagestring($img, 5, $gap + ($i * $wbar) + 10, $h - $hbar - (3 * $gap), round($data[$i]['ca'] / 1000) . ' KE', $black);
            // on ne peut pas ajouter le symbole € avec la fonction précédente (pb de police), 
            // on utilise donc la fonction suivante qui gère les caractères spéciaux 
            imagettftext(
                $img,                                   // image 
                10,                                     // font size 
                0,                                      // angle 
                $gap + ($i * $wbar) + 10,               // x
                // alternative à tester pour centrer 
                // le texte par rapport à la colonne 
                // $str_ca = round($data[$i]['ca'] / 1000) . ' K€';
                // $wfont = imagefontwidth(10) * strlen($str_ca);
                // ($w / 2) - ($wfont / 2)
                $h - $hbar - (3 * $gap),                // y 
                $black,                                 // font color 
                'font/arial.ttf',                       // font file 
                round($data[$i]['ca'] / 1000) . ' K€'   // text 
            );
            // graduation bas de barres 
            imagestring(
                $img,
                5,
                $gap + ($i * $wbar) + $wbar / 2,
                $h - ($gap / 2),
                $data[$i]['mois'],
                $black
            );
        }

        // axe des abscisses 
        imageline(
            $img,
            $gap / 2,
            $h - ($gap / 2),
            $w - ($gap / 2),
            $h - ($gap / 2),
            $black
        );

        // axe des ordonnées 
        imageline(
            $img,
            $gap / 2,
            $h - ($gap / 2),
            ($gap / 2),
            ($gap / 2),
            $black
        );
    }

    // on définit le format de l'image 
    header('Content-Type: image/png');
    // on affiche le résultat 
    imagepng($img);
    // on supprime l'image générée 
    imagedestroy($img);
} catch (PDOException $e) {
    echo $e->getMessage();
}
