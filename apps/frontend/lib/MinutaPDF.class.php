<?php

class MinutaPDF extends FPDF
{

  // Propiedades
  private $convocatoria;
  private $asistentes;
  private $eventos;
  private $minuta;

  // Constructor
  function MinutaPDF($minuta, $orientation = 'P', $unit = 'mm', $size = 'Letter')
  {
    parent::FPDF($orientation, $unit, $size);

    $this->minuta = $minuta;

    $this->convocatoria = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')
            ->find($this->minuta->getIdConvocatoria());

    $this->asistentes = Doctrine_Core::getTable('SAF_ASISTENCIA')
            ->findByIdConvocatoria($this->convocatoria->getId());

    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosConvocatoria($this->convocatoria->getId());
  }

  // Cabecera de página
  function Header()
  {
    $this->SetY(20);
  }

  // Pié de pagina
  function Footer()
  {
    $this->SetY(-15);

    $this->SetFont('Arial', 'I', 8);

    $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo(), 0, 0, 'C');
  }

  // Comienza con el proceso de rellenar toda la minuta con toda sus secciones
  function RellenarMinuta()
  {
    $this->AddPage();

    $this->RellenarTitulo();

    $this->RellenarAsistentes();

    $this->RellenarStatusCompromisosYAsistencias();

    $this->RellenarIndice();

    $this->RellenarDesarrolloReunion();
  }

  // Rellena el titulo de la minuta
  function RellenarTitulo()
  {
    $this->Imprimir('ANÁLSIS DE FALLAS DE DISTRIBUCIÓN');

    $this->Imprimir($this->convocatoria->getLugar(), 93, 10);

    $this->Imprimir(strftime("%A %d de %B de %Y", strtotime($this->convocatoria->getFecha())) .
            ' - Hora: ' . $this->convocatoria->getHoraIni() . ' a ' .
            $this->convocatoria->getHoraFin(), 95, 10, 16);
  }

  // Rellena los asistentes de la reunión
  function RellenarAsistentes()
  {
    $i = 0;

    $this->Imprimir('ASISTENTES', 10, 12, 12);

    foreach ($this->asistentes as $asistente)
    {
      $i++;
      $asist = $asistente->getSAFPERSONAL();
      $this->Imprimir($i . ') ' . $asist->getSAFUNIDADEQUIPO(), 10, 9, 0);
      $this->Imprimir($asist->getName(), 80, 9);
    }

    $this->Ln(8);
  }

  // Rellena el status de los compromisos adquiridos y las asistencias a los comité (Imagenes)
  function RellenarStatusCompromisosYAsistencias()
  {
    $this->Imprimir('AGENDA DE REUNIÓN', 10, 12, 12);

    if ($this->minuta->getImgCompromisos())
    {
      $this->RellenarImagenesDeLaMinuta('1. Revisión del status de los compromisos:', $this->minuta->getImgCompromisos());
      $this->Ln(100);
    }

    if ($this->minuta->getImgAsistencias())
    {
      $this->RellenarImagenesDeLaMinuta('2. Revisión del status de las asistencias:', $this->minuta->getImgAsistencias());
    }
  }

  // Rellena o pinta las imagenes correspondientes a la minuta (Compromisos y Asistencias)
  function RellenarImagenesDeLaMinuta($texto, $dir_img)
  {
    $this->Imprimir($texto, 20, 10, 12);

    $this->Cell(22);

    $this->Cell(155, 98, '', 1, 0, 'C');

    $this->Image(sfConfig::get('sf_web_dir') . '/' . $dir_img, 33, $this->GetY() + 1, 153, 95);
  }

  // Rellena el indice de las interrupciones que se analizaran
  function RellenarIndice()
  {
    $this->AddPage();

    $this->Imprimir('2. Revisión y Análisis de las siguientes interrupciones:', 20, 10);

    $cont_causa500 = 1;
    $cont_imp = 1;
    $cont_pro = 1;

    foreach ($this->eventos as $evento)
    {
      if (Doctrine_Core::getTable('SAF_EVENTO_CONVOCATORIA')->getEventoConvocatoria($evento, $this->convocatoria)->getStatus() == 'analizado')
      {
        $this->ImprimirSubtituloIndice($evento, $cont_causa500, $cont_imp, $cont_pro);

        $fecha_evento = strftime("%A, %d/%m/%Y", strtotime($evento->getFHoraIni()));
        $text = "RI. " . $evento->getCEventoD() . " - Circuito " . $evento->getCircuito() . ". " . $fecha_evento . '. MVAmin: ' . $evento->getMvaMin();
        $this->Imprimir($text, 40, 10);
      }
    }
  }

  // Imprimi el subtitulo del bloque de los tipos de fallas.
  function ImprimirSubtituloIndice($evento, &$cont_causa500, &$cont_imp, &$cont_pro)
  {
    if ($evento->getTipoFalla() == 'CAUSA-500' && $cont_causa500 == 1)
    {
      $this->Ln(10);
      $this->Imprimir('INTERRUPCIONES CON ERROR DE OPERACIONES:', 30, 10, 8);
      $cont_causa500++;
    }
    elseif ($evento->getTipoFalla() == 'IMPREVISTA' && $cont_imp == 1)
    {
      $this->Ln(10);
      $this->Imprimir('INTERRUPCIONES IMPREVISTAS:', 30, 10, 8);
      $cont_imp++;
    }
    elseif ($evento->getTipoFalla() == 'PROGRAMADA' && $cont_pro == 1)
    {
      $this->Ln(10);
      $this->Imprimir('INTERRUPCIONES PROGRAMADAS:', 30, 10, 8);
      $cont_pro++;
    }
  }

  // Rellena el desarrollo de la reunion sobre los eventos
  function RellenarDesarrolloReunion()
  {
    $i = 1;

    foreach ($this->eventos as $evento)
    {
      if (Doctrine_Core::getTable('SAF_EVENTO_CONVOCATORIA')->getEventoConvocatoria($evento, $this->convocatoria)->getStatus() == 'analizado')
      {
        $this->AddPage();

        if ($i == 1)
        {
          $i++;
          $this->Imprimir('DESARROLLO DE LA REUNIÓN', 10, 12, 18);
        }

        $this->RellenarDescripcionDelEvento($evento);

        $this->RellenarFotosDelEvento($evento);

        $this->RellenarRazonesDelEvento($evento);

        $varios = Doctrine_Core::getTable('SAF_VARIO')->findByIdEvento($evento->getID());

        $this->RellenarBitacoraDelEvento($varios);

        $this->RellenarAccionesYRecomendacionesDelEvento($varios);

        $this->RellenarCompromisosDelEvento($varios);
      }
    }
  }

  // Rellena la descripción del evento en la sección "Desarrollo de la reunión"
  function RellenarDescripcionDelEvento($evento)
  {
    $fecha_evento = strftime("%A, %d/%m/%Y", strtotime($evento->getFHoraIni()));

    $text = "RI. " . $evento->getCEventoD() . " - Circuito " . $evento->getCircuito() .
            ". " . $fecha_evento . '. MVAmin: ' . $evento->getMvaMin();

    $this->Imprimir($text, 20, 11, 12);

    $this->Cell(30);

    $this->SetFont('Times', '', 8);

    $this->MultiCell(145, 4, utf8_decode($evento->getTrabajoRealizado()));

    $this->Ln(2);

    $this->Imprimir('Núm Averia / Prop: ' . $evento->getNumAveria(), 135, 10, 0);
    $this->Imprimir('Operador: ' . $evento->getOperador(), 30, 10);
    $this->Imprimir('Núm ROE: ' . $evento->getNumRoe(), 135, 10, 0);
    $this->Imprimir('Cuadrilla: ' . $evento->getCuadrilla(), 30, 10);
    $this->Imprimir('KVA Interrumpidos: ' . $evento->getKvaInt(), 135, 10, 0);
    $this->Imprimir('Programador: ' . $evento->getProgramador(), 30, 10);
    $this->Imprimir('Región: ' . $evento->getRegion(), 135, 10, 0);
    $this->Imprimir('Operador Responsable: ' . $evento->getOperadorResp(), 30, 10);

    $this->Ln(10);
  }

  // Rellena las fotos del evento en la sección "Desarrollo de la reunión"
  function RellenarFotosDelEvento($evento)
  {
    $fotos = Doctrine_Core::getTable('SAF_FOTO')->findByIdEvento($evento->getId());

    foreach ($fotos as $foto)
    {
      $this->Imprimir($foto->getTitulo(), 30, 10, 5);

      $this->Imprimir($foto->getSubTitulo(), 30, 10, 10);

      $this->Cell(38);

      $this->Image(sfConfig::get('sf_web_dir') . '/' . $foto->getDir(), $this->GetX(), $this->GetY(), 135, 70);

      $this->Ln(73);
    }
  }

  // Rellena las razones del evento en la sección "Desarrollo de la reunión"
  function RellenarRazonesDelEvento($evento)
  {
    $razones = Doctrine_Core::getTable('SAF_EVENTO_RAZON')->findByIdEvento($evento->getId());

    if (count($razones) > 0)
    {
      $this->Imprimir('RAZONES POR LAS QUE PASA DE 999MVAmin:', 30, 10, 10);

      foreach ($razones as $razon)
      {
        $this->Imprimir('- ' . $razon->getSAFRAZONMVAMIN() . ': ' . $razon->getMvaMin() . ' MVAmin', 40, 10, 5);
      }
    }

    $this->Ln(9);
  }

  // Rellena la bitácora del evento en la sección "Desarrollo de la reunión"
  function RellenarBitacoraDelEvento($registros_varios)
  {
    foreach ($registros_varios as $registro)
    {
      if ($registro->getTipo() == 'BITACORA')
      {
        $this->Imprimir('RESUMEN DE LA BITÁCORA DEL EVENTO:', 30, 10, 12);
        $this->Cell(40);
        $this->MultiCell(140, 6, utf8_decode($registro->getDescripcion()));
        $this->Ln(8);
        break;
      }
    }
  }

  // Rellena las acciones y recomendaciones del evento en la sección "Desarrollo de la reunión"
  function RellenarAccionesYRecomendacionesDelEvento($registros_varios)
  {
    foreach ($registros_varios as $registro)
    {
      if ($registro->getTipo() == 'ACCIONES_Y_RECOMENDACIONES')
      {
        $this->Imprimir('ACCIONES Y RECOMENDACIONES:', 30, 10, 12);
        $this->Cell(40);
        $this->MultiCell(140, 6, utf8_decode($registro->getDescripcion()));
        $this->Ln(8);
        break;
      }
    }
  }

  // Rellena los compromisos del evento en la sección "Desarrollo de la reunión"
  function RellenarCompromisosDelEvento($registros_varios)
  {
    $cont_comp = 1;

    foreach ($registros_varios as $registro)
    {
      if ($registro->getTipo() == 'COMPROMISO')
      {
        if ($cont_comp == 1)
        {
          $this->Imprimir('COMPROMISOS:', 30, 10, 12);
          $cont_comp++;
        }

        $this->Imprimir('Fecha duración estimada: ' . $registro->getFDuracionEstimada(), 40, 10);
        $this->Imprimir('Resp(s): ', 40, 10, 0);

        foreach ($registro->getResponsables() as $responsable)
        {
          $this->Imprimir($responsable, 55, 10);
        }

        $this->Ln(2);
        $this->Cell(40);
        $this->MultiCell(140, 6, utf8_decode($registro->getDescripcion()));
        $this->Ln(8);
      }
    }
  }

  // Imprime un texto en una posicion determinada con un tamaño de letra y salto de linea específica.
  function Imprimir($text_cell, $posX_cell = 90, $tamahno_font = 12, $ln = 6)
  {
    $this->SetFont('Times', '', $tamahno_font);
    $this->Cell($posX_cell);
    $this->Cell(20, 10, utf8_decode($text_cell));
    $this->Ln($ln);
  }

}
