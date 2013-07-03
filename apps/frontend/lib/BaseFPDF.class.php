<?php

class BaseFPDF extends FPDF
{

  function BaseFPDF($orientation = 'P', $unit = 'mm', $size = 'Letter')
  {
    parent::FPDF($orientation, $unit, $size);
  }

  // Cabecera de página
  function Header()
  {
    // Logo
    //$this->Image(sfConfig::get('sf_web_dir') . '/images/SAF.png',15,10,30);
    $this->SetY(20);
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo(), 0, 0, 'C');
  }
  
  function Imprimir($text_cell, $posX_cell = 90, $tamahno_font = 12, $ln = 6)
  {
    $this->SetFont('Times', '', $tamahno_font);
    $this->Cell($posX_cell);
    $this->Cell(20, 10, utf8_decode($text_cell));
    $this->Ln($ln);
  }
}
