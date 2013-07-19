<?php

/**
 * seguimiento_control actions.
 *
 * @package    Proyecto_SAF
 * @subpackage seguimiento_control
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seguimiento_controlActions extends sfActions
{

  public function executeInicio()
  {
    
  }

  public function executeFiltrar(sfWebRequest $request)
  {
    $unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findAll();
    $this->array_resultset = array();

    foreach ($unidades as $unidad)
    {
      if ($resultset = Doctrine_Core::getTable('SAF_COMP_UE')
              ->getCompromisosDetalladosDeLaUnidad($unidad->getId()))
      {
        array_push($this->array_resultset, $resultset);
      }
    }
  }

  public function executeRegistrarAccionesComprimiso(sfWebRequest $request)
  {
    $this->forward404Unless($comp_ue = Doctrine_Core::getTable('SAF_COMP_UE')
            ->find($request->getParameter('id_comp')));

    $comp_ue->setAcciones($request->getParameter('acciones'));

    if ($request->getParameter('confirmar_comp') == true)
    {
      $comp_ue->setStatus('CONFIRMACION');
    }

    $comp_ue->save();

    $this->redirect('seguimiento_control/listarCompromisosDeLaUnidad');
  }

}
