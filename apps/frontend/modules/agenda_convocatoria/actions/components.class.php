<?php

/**
 * agenda_convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage agenda_convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agenda_convocatoriaComponents extends sfComponents
{

  public function executeEventos()
  {
    $this->eventos = Doctrine::getTable('INTERRUPCIONES')->getInterrupciones();        
  }

}

