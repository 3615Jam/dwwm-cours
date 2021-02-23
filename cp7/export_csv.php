<?php
// script pour générer un fichier pdf via l'extension 'fpdf' 

include_once('session_active.php');
include_once('pdo_connect.php');

try {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        // ouvre un flux 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');
        $stream = fopen('php://output', 'W');
        // requête 
        $table = $_GET['t'];
        $sql = "SELECT * FROM $table";
        $qry = $cnn->query($sql);
        // nb de colonnes 
        $nb = $qry->columnCount();
        $row = [];
        for ($i = 0; $i < $nb; $i++) {
            $meta = $qry->getColumnMeta($i);
            $row[] = $meta['name'];
        }

        // lit et renvoie les datas 
        while ($row = $qry->fetch()) {
            for ($i = 0; $i < $nb; $i++) {
                $pdf->Cell($width, 5, utf8_decode($row[$i]), 1, 0);
            }
        }
    } else {
        'ERROR : Table not found';
    }
} catch (PDOException $e) {
    $pdf->MultiCell(0, 30, $e->getMessage(), 1, 'C');
}

// déconnexion BDD 
unset($cnn);

$pdf->Output('I', 'export.pdf');
