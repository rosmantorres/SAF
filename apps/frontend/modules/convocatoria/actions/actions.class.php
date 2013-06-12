<?php

/**
 * convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class convocatoriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->convocatorias = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->getConvocatorias();
  }

  public function executeNew(sfWebRequest $request)
  {
    
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->convocatoria = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')
            ->find($request->getParameter('id'));

    $this->forward404Unless($this->convocatoria);

    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosConvocatoria($request->getParameter('id'));

    $this->forward404Unless($this->eventos);
  }
  
  public function executeCargarEventosDeAgenda(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('hist_eventos_filtrados', array());
    
    $agenda = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->find($request->getParameter('id_agenda'));
    
    if ($agenda)
    {
      $eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosAgenda($request->getParameter('id_agenda'));
      $this->getUser()->agregarEventosFiltradosAlHist($eventos);
      $this->eventos = $eventos;
      $this->agenda = $agenda;
    }
    else
    {
      return $this->renderText("<i class='icon-info-sign'></i> 
        Ningun resultado encontrado en la busqueda!");
    }    
  }
    
  public function executeVistaPreliminar(sfWebRequest $request)
  {
    $eventos = $this->getUser()->getAttribute('hist_eventos_convocatoria', array());
    $this->eventos = $eventos;
  }
  
  public function executeGuardarConvocatoria(sfWebRequest $request)
  {
    $eventos_a_guardar = $this->getUser()
            ->retornarEventosAGuardarEnAgendaConvocatoria($request, 'hist_eventos_convocatoria');

    if (count($eventos_a_guardar) > 0)
    {
      if ($this->commitConvocatoria($request, $eventos_a_guardar))
      {
        $this->getUser()->setAttribute('hist_eventos_convocatoria', array());
        $this->getUser()->setFlash('notice', 'LA CONVOCATORIA FUE GUARDADA CON EXITO!');
        $this->redirect('@index_convocatoria');
      }
      else
      {
        $this->getUser()->setFlash('error', 'LA CONVOCATORIA NO FUE GUARDADA CON EXITO! 
          (Comuniquese con el analista de sistema si el problema persiste)');
        $this->redirect('@vista_preliminar_convocatoria');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'DEBE INDICAR AL MENOS UN EVENTO');
      $this->redirect('@vista_preliminar_convocatoria');
    }
  }
  
  private function commitConvocatoria($request, $eventos_a_guardar)
  {
    try
    {
      $convocatoria = new SAF_CONVOCATORIA_CAF();
      $convocatoria->setAsunto($request->getParameter('asunto_convoca'));
      $convocatoria->setFecha($request->getParameter('f_convoca'));
      $convocatoria->setHoraIni($request->getParameter('h_ini_convoca'));
      $convocatoria->setHoraFin($request->getParameter('h_fin_convoca'));
      $convocatoria->setLugar($request->getParameter('lugar_convoca'));
      $convocatoria->setStatus('ACTIVA');
      $convocatoria->setObservacion($request->getParameter('observacion_convoca'));
      $convocatoria->save();

      foreach ($eventos_a_guardar as $evento)
      {
        $evento->setIdConvocatoria($convocatoria);
        $evento->save();
      }
    }
    catch (Exception $exc)
    {
      return false;
    }

    return true;
  }
  
  public function executeAgregarEventosALaConvocatoria(sfWebRequest $request)
  {
    $resultado = $this->getUser()->agregarEventosCheckedAlHist($request, 'hist_eventos_convocatoria');

    if ($resultado != '')
    {
      return $this->renderText("<div class='alert alert-info'> 
        <strong><u>Eventos agregados a la convocatoria:</u></strong>
        <br>
        Leyenda: <i class='icon-remove'></i> Ya existía <i class='icon-ok'></i> Agregado
        <br><br>" . $resultado . "</div>");
    }
    else
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        No se seleccionaron eventos para guardar en la Convocatoria");
    }
  }
   
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SAF_CONVOCATORIA_CAFForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($saf_convocatoria_caf = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->find(array($request->getParameter('id'))), sprintf('Object saf_convocatoria_caf does not exist (%s).', $request->getParameter('id')));
    $this->form = new SAF_CONVOCATORIA_CAFForm($saf_convocatoria_caf);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($saf_convocatoria_caf = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->find(array($request->getParameter('id'))), sprintf('Object saf_convocatoria_caf does not exist (%s).', $request->getParameter('id')));
    $this->form = new SAF_CONVOCATORIA_CAFForm($saf_convocatoria_caf);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($saf_convocatoria_caf = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->find(array($request->getParameter('id'))), sprintf('Object saf_convocatoria_caf does not exist (%s).', $request->getParameter('id')));
    $saf_convocatoria_caf->delete();

    $this->redirect('convocatoria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $saf_convocatoria_caf = $form->save();

      $this->redirect('convocatoria/edit?id='.$saf_convocatoria_caf->getId());
    }
  }
}
