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
  
  public function executeCargarEventosDeAgenda(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('hist_eventos_agenda', array());
    
    $agenda = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->find($request->getParameter('id_agenda'));
    
    if ($agenda)
    {
      $eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosAgenda($request->getParameter('id_agenda'));
      $this->guardarHistEventosAgenda($eventos);
      $this->eventos = $eventos;
      $this->agenda = $agenda;
    }
    else
    {
      return $this->renderText("<i class='icon-info-sign'></i> 
        Ningun resultado encontrado en la busqueda!");
    }    
  }
  
  private function guardarHistEventosAgenda($eventos_agenda)
  {
    // Busca los eventos ya almacenados en la variable de sesion correspondiente
    // si el identificador no esta definido aun, entonces se setea con un array()
    $eventos = $this->getUser()->getAttribute('hist_eventos_agenda', array());

    foreach ($eventos_agenda as $evento_agenda)
    {
      array_push($eventos, $evento_agenda);
    }

    // Almacena el nuevo historial a la sesion del usuario
    $this->getUser()->setAttribute('hist_eventos_agenda', $eventos);
  }
    
  public function executePrueba()
  {
    $hist_eventos_agenda = $this->getUser()->getAttribute('hist_eventos_agenda', array());
    foreach ($hist_eventos_agenda as $value)
    {
      echo $value->getCEventoD()."\n";
    }
  }
  
  public function executeAgregarEventosConvocatoria(sfWebRequest $request)
  {
    $decir = "";
    $checkbox_seleccionados = 0;
    $hist_eventos_agenda = $this->getUser()->getAttribute('hist_eventos_agenda', array());

    // Verifica cuales checkbox fueron seleccionados
    foreach ($hist_eventos_agenda as $evento_agenda)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox = $request->getParameter($evento_agenda->getCEventoD());

      if ($checkbox == true)
      {
        $checkbox_seleccionados = $checkbox_seleccionados + 1;
//        if ($this->guardarEventoCheckedEnHist($evento_agenda))
//        {
//          $decir = $decir . "<i class='icon-ok'></i> " . $evento_agenda->getCEventoD() . "<br>";
//        }
//        else
//        {
//          $decir = $decir . "<i class='icon-remove'></i> " . $evento_agenda->getCEventoD() . "<br>";
//        }
      }
    }

    if ($checkbox_seleccionados > 0)
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        si se seleccionaron eventos para guardar en la agenda");
      return $this->renderText("<div class='alert alert-info'><strong><u>Eventos 
        agregados a la agenda:</u></strong><br>Leyenda: <i class='icon-remove'></i> Ya existía
        <i class='icon-ok'></i> Agregado<br><br>" . $decir . "</div>");
    }
    else
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        No se seleccionaron eventos para guardar en la agenda");
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
