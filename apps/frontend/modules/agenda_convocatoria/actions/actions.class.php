<?php

/**
 * agenda_convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage agenda_convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agenda_convocatoriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->saf_agenda_convocatori_as = 
            Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->getUser()->setFlash('notice', sprintf('Aqui iran los mensajes del usuario'));
    $this->form = new SAF_AGENDA_CONVOCATORIAForm();
  }

  /**
   * Método convierte del modelo INTERRUPCIONES a SAF_EVENTO, retornando una 
   * coleccion de objetos del módelo SAF_EVENTO
   * 
   * @param INTERRUPCIONES $interrupciones
   * @return Doctrine_Collection SAF_EVENTO
   */
  private function conversionModelo($interrupciones)
  {
    $eventos = array();

    foreach ($interrupciones as $interrupcion)
    {
      $evento = new Evento();
      $evento = $evento->crearEvento($interrupcion);
      array_push($eventos, $evento);
    }

    return $eventos;
  }
  
  public function executeAgregar(sfWebRequest $request)
  {
    $peticion = $request->getParameter('701463');
    if($peticion == true)
      echo 'seleccionado';
    else
      echo 'no seleccionado';
  }
  
  public function executeFiltrar(sfWebRequest $request)
  {
    $fechas = $request->getParameter('saf_agenda_convocatoria');
    
    if($interrupciones_imp = Doctrine::getTable('INTERRUPCIONES')
            ->getInterrupcionesImp($fechas['f_ini'],$fechas['f_fin']))
    {    
      $eventos_imp = $this->conversionModelo($interrupciones_imp);
    }
    
    if($interrupciones_pro = Doctrine::getTable('INTERRUPCIONES')
            ->getInterrupcionesPro($fechas['f_ini'],$fechas['f_fin']))
    {    
      $eventos_pro = $this->conversionModelo($interrupciones_pro);
    }
    
    if($interrupciones_500 = Doctrine::getTable('INTERRUPCIONES')
            ->getInterrupciones500($fechas['f_ini'],$fechas['f_fin']))
    {    
      $eventos_500 = $this->conversionModelo($interrupciones_500);
    }
    
    $this->eventos_imp = $eventos_imp;
    $this->eventos_pro = $eventos_pro;
    $this->eventos_500 = $eventos_500;
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->saf_agenda_convocatoria = 
            Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->find(array($request->getParameter('id')));
    $this->forward404Unless($this->saf_agenda_convocatoria);
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SAF_AGENDA_CONVOCATORIAForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('Object saf_agenda_convocatoria does not exist (%s).', $request->getParameter('id')));
    $this->form = new SAF_AGENDA_CONVOCATORIAForm($saf_agenda_convocatoria);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('La agenda con id (%s) no existe.', $request->getParameter('id')));
    $this->form = new SAF_AGENDA_CONVOCATORIAForm($saf_agenda_convocatoria);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('Object saf_agenda_convocatoria does not exist (%s).', $request->getParameter('id')));
    $saf_agenda_convocatoria->delete();

    $this->redirect('agenda_convocatoria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $saf_agenda_convocatoria = $form->save();

      $this->redirect('agenda_convocatoria/edit?id='.$saf_agenda_convocatoria->getId());
    }
  }
}
