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
            $img,                                              // image 
            5,                                                 // font size 
            $w / 3,                                            // x
            $h / 3,                                            // y 
            'Aucune donnee a afficher',                        // text 
            $black                                             // font color 
        );
    } else {

        // variable de calcul 
        // on crée un écart pour le positionnement 
        $gap = 50;
        // largeur des barres 
        // on divise par le nb de colonnes pour que les barres soient correctement réparties
        $wbar = ($w - ($gap * 2)) / count($data);
        // hauteur max des barres 
        $hmax = ($h - ($gap * 2));
        // CA max pour avoir le "haut" du graphique 
        $val_max = 150000;

        // dessine l'histogramme via requête 
        for ($i = 0; $i < count($data); $i++) {
            // on calcule la hauteur de chaque barre 
            $hbar = round(($data[$i]['ca'] * ($hmax - $gap)) / $val_max);
            // on remplit la barre avec une couleur aléatoire 
            $alea = imagecolorallocatealpha($img, rand(0, 255), rand(0, 255), rand(0, 255), 31);
            imagefilledrectangle(
                $img,                                          // image 
                $gap + ($i * $wbar),                           // x1
                $hmax - $hbar,                                 // y1
                $gap + ($i * $wbar) + $wbar,                   // x2 
                $h - $gap,                                     // y2
                $alea                                          // color 
            );
            // on fait un contour blanc autour de chaque barre
            imagerectangle(
                $img,                                          // image 
                $gap + ($i * $wbar),                           // x1
                $hmax - $hbar,                                 // y1
                $gap + ($i * $wbar) + $wbar,                   // x2
                $h - $gap,                                     // y2
                $white                                         // color
            );
            // on rajoute des labels 
            // imagestring($img, 5, $gap + ($i * $wbar) + 10, $h - $hbar - (3 * $gap), round($data[$i]['ca'] / 1000) . ' KE', $black);
            // on ne peut pas ajouter le symbole € avec la fonction précédente (pb de police), 
            // on utilise donc la fonction suivante qui gère les caractères spéciaux 
            imagettftext(
                $img,                                          // image 
                10,                                            // font size 
                0,                                             // angle 
                $gap + ($i * $wbar) + 10,                      // x
                $h - $hbar - (3 * $gap),                       // y 
                $black,                                        // font color 
                'font/arial.ttf',                              // font file 
                round($data[$i]['ca'] / 1000) . ' K€'          // text 
            );
            // graduation bas de barres 
            imagestring(
                $img,                                          // image 
                5,                                             // font size 
                $gap + ($i * $wbar) + $wbar / 2,               // x
                $h - ($gap / 2),                               // y
                $data[$i]['mois'],                             // text 
                $black                                         // font color 
            );
        }

        // axe des abscisses 
        imageline(
            $img,                                              // image 
            $gap / 2,                                          // x1 
            $h - ($gap / 2),                                   // y1
            $w - ($gap / 2),                                   // x2
            $h - ($gap / 2),                                   // y2
            $black                                             // font color 
        );

        // axe des ordonnées 
        imageline(
            $img,                                              // image 
            $gap / 2,                                          // x1 
            $h - ($gap / 2),                                   // y1
            ($gap / 2),                                        // x2
            ($gap / 2),                                        // y2
            $black                                             // font color 
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
