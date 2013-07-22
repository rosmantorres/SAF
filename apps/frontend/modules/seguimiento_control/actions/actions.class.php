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

  /**
   * Acción para el index del módulo
   */
  public function executeInicio()
  {
    $this->unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findAll();
  }

  /**
   * Acción que filtra lo buscado por el usuario para los compromisos.
   * 
   * @param sfWebRequest $request
   */
  public function executeFiltrar(sfWebRequest $request)
  {
    $this->array_resultset = array();
    $agregar_a_consulta = '';

    if ($request->getParameter('status') != 'TODOS')
    {
      $agregar_a_consulta = " AND comp_ue.status = '" . $request->getParameter('status') . "'";
    }

    if ($request->getParameter('unidad') != 'TODAS')
    {
      if ($resultset = Doctrine_Core::getTable('SAF_COMP_UE')
              ->getCompromisosDetalladosDeLaUnidad($request->getParameter('unidad'), $agregar_a_consulta))
      {
        array_push($this->array_resultset, $resultset);
      }
    }
    elseif ($request->getParameter('unidad') == 'TODAS')
    {
      $unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findAll();

      foreach ($unidades as $unidad)
      {
        if ($resultset = Doctrine_Core::getTable('SAF_COMP_UE')
                ->getCompromisosDetalladosDeLaUnidad($unidad->getId(),$agregar_a_consulta))
        {
          array_push($this->array_resultset, $resultset);
        }
      }
    }
  }

  /**
   * Acción que registra las acciones realizadas para cumplir con los compromisos
   * adquiridos en el comité. Pudiendo pedirse la confirmación de un compromiso
   * por IO para ser cambiado a terminado.
   * 
   * @param sfWebRequest $request
   */
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

    $this->getUser()->setFlash('notice', 'Compromiso modificado satisfactoriamente.');
    
    $this->redirect('seguimiento_control/inicio');
  }

}
