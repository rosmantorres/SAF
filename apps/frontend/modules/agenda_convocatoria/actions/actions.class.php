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
    $this->saf_agenda_convocatori_as = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SAF_AGENDA_CONVOCATORIAForm();
  }

  public function executeFiltrar(sfWebRequest $request)
  {
    $fechas_filtro = $request->getParameter('saf_agenda_convocatoria');
    $f_ini_filtro = $fechas_filtro['f_ini'];
    $f_fin_filtro = $fechas_filtro['f_fin'];
    $interrupciones = Doctrine::getTable('INTERRUPCIONES')->getInterrupciones($f_ini_filtro,$f_fin_filtro);    
    $array_eventos = array();
    if($interrupciones)
    {      
      foreach ($interrupciones as $interrupcion)
      {
        $mi_averia = Doctrine_Core::getTable('AVERIA')->find($interrupcion->getNumAveria());
        $mi_cronologia = Doctrine_Core::getTable('CRONOLOGIA')->find($interrupcion->getNumF328());
        //$mi_cronologia_cuadrilla_int = Doctrine_Core::getTable('CRONOLOGIA_CUADRILLA_INT')->find($interrupcion->getNumF328());
        
        $evento = new SAF_EVENTO();

        $evento->setCEventoD($interrupcion->getNumF328());
        $evento->setFHoraIni($interrupcion->getFechaHoraIni());
        $evento->setRegion($interrupcion->getDistrito());
        $evento->setCircuito($interrupcion->getCodSistema());
        $evento->setCodNivel($interrupcion->getNivelSistema());
        $evento->setKvaInt($interrupcion->getKvaInterrump());
        $evento->setMvaMin($interrupcion->getMvamin());
        $evento->setNumAveria($interrupcion->getNumAveria());
        $evento->setTipoFalla($interrupcion->getCodCausa());
        $evento->setClimatologia($interrupcion->getClimatologia());
        $evento->setTrabajoRealizado($interrupcion->getTrabajoRealizado());
        $evento->setNumRoe($interrupcion->getNumRoe());
        
        if ($mi_cronologia)
        {
          $evento->setFHoraRep($mi_cronologia->getFechaReparacion());
          $evento->setOperador($mi_cronologia->getRespMesaRep());
        }
        else
        {
          $evento->setFHoraRep();
          $evento->setOperador();
        }
        
        $evento->setDescAveria($mi_averia->getDescripcion());        
        //$evento->setCuadrilla($mi_cronologia_cuadrilla_int->getCodCuadCont()); 
        //$evento->setProgramador() = ;
        //$evento->setOperadorResp() = ;
        array_push($array_eventos,$evento);
      }
    }
    
    $this->array_eventos = $array_eventos;
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id')));
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
