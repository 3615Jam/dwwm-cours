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
        $this->Image('img/dc_logo.png', 10, 5);
        $this->SetTextColor(255, 0, 0);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'Les Darons Codeurs', 0, 0, 'C');
        $this->Ln(20);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 20);
    }
}
