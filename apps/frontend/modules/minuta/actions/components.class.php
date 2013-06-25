<?php

/**
 * agenda_convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage agenda_convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class minutaComponents extends sfComponents
{
  public function executeMostrarDesarrolloEvento()
  {
    $this->fotos = Doctrine_Core::getTable('SAF_FOTO')
            ->createQuery()
            ->where('id_evento = ?', $this->evento)
            ->execute();

    $this->razones = Doctrine_Core::getTable('SAF_EVENTO_RAZON')
            ->createQuery('e_r')
            ->where('e_r.id_evento = ?', $this->evento)
            ->innerJoin('e_r.SAF_RAZON_MVAMIN r')
            ->execute();

    $varios = Doctrine_Core::getTable('SAF_VARIO')
            ->createQuery()
            ->where('id_evento = ?', $this->evento)
            ->orderBy('tipo')
            ->execute();
    
    foreach ($varios as $vario)
    {
      if ($vario->getTipo() == 'BITACORA')
      {
        $this->resumen_bitacora = $vario->getDescripcion();
      }
      elseif ($vario->getTipo() == 'ACCIONES_Y_RECOMENDACIONES')
      {
        $this->acciones_recomendaciones = $vario->getDescripcion();
      }
    }    
    
    $this->compromisos = $varios;
    
  }

}

