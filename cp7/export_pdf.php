<?php
// script pour générer un fichier pdf via l'extension 'fpdf' 

include_once('session_active.php');
include_once('pdo_connect.php');
include_once('fpdf/fpdf.php'); // http://www.fpdf.org/ 

// classe qui étend 'fpdf' 
class MyPDF extends FPDF
{
    public function Header()
    {
        $this->Image('img/dc_logo.png', 10, 10, 15);
        $this->SetTextColor(0, 0, 255);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'Les Darons Codeurs', 0, 0, 'C');
        $this->Ln(20);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'page ' . $this->PageNo() . ' sur {nb}', 0, 0, 'C');
    }
}

$pdf = new MyPDF();

$pdf->AliasNbPages();

$pdf->AddPage('L', 'A4', 0);

$pdf->SetFont('Arial', '', 10);

// impression contenu table 
try {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        $table = $_GET['t'];
        $sql = "SELECT * FROM $table";
        $qry = $cnn->query($sql);
        $nb = $qry->columnCount();
        $width = 277 / $nb;     // 277 = largeur en mm --> 29.7 cm - 2 marges de 1 cm = 27.7 cm = 277 mm
        $pdf->SetTextColor(255, 255, 255);
        for ($i = 0; $i < $nb; $i++) {
            $meta = $qry->getColumnMeta($i);
            $pdf->Cell($width, 5, utf8_decode($meta['name']), 1, 0, 'C', true);
        }
        // passe à la ligne 
        $pdf->Ln(5);

        $pdf->SetTextColor(0, 0, 0);
        // lit et écrit les datas 
        while ($row = $qry->fetch(PDO::FETCH_NUM)) {
            for ($i = 0; $i < $nb; $i++) {
                $pdf->Cell($width, 5, utf8_decode($row[$i]), 1, 0);
            }
            // passe à la ligne
            $pdf->Ln(5);
        }
    } else {
        $pdf->MultiCell(0, 30, 'ERROR : Table not found', 1, 'C');
    }
} catch (PDOException $e) {
    $pdf->MultiCell(0, 30, $e->getMessage(), 1, 'C');
}

// déconnexion BDD 
unset($cnn);

$pdf->Output('I', 'export.pdf');
