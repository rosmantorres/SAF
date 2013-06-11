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
    $this->agendas = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();
  }

  public function executeNew(sfWebRequest $request)
  {
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->agenda = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->find($request->getParameter('id'));

    $this->forward404Unless($this->agenda);

    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosAgenda($request->getParameter('id'));

    $this->forward404Unless($this->eventos);
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

  /**
   * Acción que realizar busqueda de eventos según el filtro que se indique
   *
   * @param sfWebRequest $request
   * @return type
   */
  public function executeFiltrar(sfWebRequest $request)
  {
    // Cada vez que se hace un filtro se inicializa la variable de sesión, para
    // no acumular eventos por cada filtro.
    $this->getUser()->setAttribute('hist_eventos_filtrados', array());

    $form = $request->getParameter('saf_agenda_convocatoria');

    if (($form['f_ini'] == '' || $form['f_fin'] == '') && $form['c_evento'] == '')
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        No se indicó ningún filtro para hacer la busqueda de los eventos.");
    }
    elseif ($form['f_ini'] != '' && $form['f_fin'] != '')
    {
      $this->eventos_imp = $this->filtrarPorFechas($form['f_ini'], $form['f_fin'], 'IMPREVISTAS');
      $this->eventos_pro = $this->filtrarPorFechas($form['f_ini'], $form['f_fin'], 'PROGRAMADAS');
      $this->eventos_500 = $this->filtrarPorFechas($form['f_ini'], $form['f_fin'], 'CAUSAS-500');
    }
    elseif ($form['c_evento'] != '')
    {
      $evento = $this->filtrarPorCodEvento($form['c_evento']);

      if (count($evento) > 0)
      {
        return $this->renderPartial('global/eventos', array('eventos' => $evento, 'yes_button' => true));
      }
      else
      {
        return $this->renderText("<i class='icon-info-sign'></i> Ningun resultado encontrado en la busqueda!");
      }
    }
  }

  /**
   * Acción que guarda la agenda con observaciones y los eventos confirmados 
   * por el usuario, a través de los checkbox.
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() - No tiene vista asociada
   */
  public function executeGuardarAgenda(sfWebRequest $request)
  {
    $eventos_a_guardar = $this->getUser()
            ->retornarEventosAGuardarEnAgendaConvocatoria($request, 'hist_eventos_agenda');

    if (count($eventos_a_guardar) > 0)
    {
      if ($this->commitAgenda($request->getParameter('observacion'), $eventos_a_guardar))
      {
        $this->getUser()->setAttribute('hist_eventos_agenda', array());
        $this->getUser()->setFlash('notice', 'LA AGENDA FUE GUARDADA CON EXITO!');
        $this->redirect('agenda_convocatoria/index');
      }
      else
      {
        $this->getUser()->setFlash('error', 'LA AGENDA NO FUE GUARDADA CON EXITO! 
          (Comuniquese con el analista de sistema si el problema persiste)');
        $this->redirect('agenda_convocatoria/verSesion');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'DEBE INDICAR AL MENOS UN EVENTO');
      $this->redirect('agenda_convocatoria/verSesion');
    }
  }

  /**
   * Acción que verifica cuales eventos fueron seleccionados despues del filtro 
   * (busqueda) para agregarlos a la variable de sesion hist_eventos_sesion
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  // CAMBIAR ESTE NOMBREEEEEEEEEEE
  public function executeAgregarEventosAMiSesion(sfWebRequest $request)
  {
    $resultado = $this->getUser()->agregarEventosCheckedAlHist($request, 'hist_eventos_agenda');

    if ($resultado != '')
    {
      return $this->renderText("<div class='alert alert-info'> 
        <strong><u>Eventos agregados a la agenda:</u></strong>
        <br>
        Leyenda: <i class='icon-remove'></i> Ya existía <i class='icon-ok'></i> Agregado
        <br><br>" . $resultado . "</div>");
    }
    else
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        No se seleccionaron eventos para guardar en la Agenda");
    }
  }

  /**
   * Acción que muestra los eventos que hasta el momento fueron seleccionados por
   * el usuario, permitiendo guardar la agenda con esos eventos y observaciones.
   * 
   * @param sfWebRequest $request
   */
  public function executeVerSesion(sfWebRequest $request)
  {
    $eventos = $this->getUser()->getAttribute('hist_eventos_agenda', array());
    $this->eventos = $eventos;
  }

  /**
   * Método que consulta y retorna todas las INTERRUPCIONES según un rango
   * fecha y el tipo de interrupción, convirtiendolas de modelo a SAF_EVENTOS 
   * y almacenandolos en hist_eventos_filtrados de la sesion del usuario.
   * 
   * @param string $fecha_inicial
   * @param string $fecha_final
   * @param string $consultar
   * @return array SAF_EVENTO
   */
  private function filtrarPorFechas($fecha_inicial, $fecha_final, $consultar)
  {
    if ($consultar == 'IMPREVISTAS')
    {
      $interrupciones = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupcionesImp($fecha_inicial, $fecha_final);
    }
    elseif ($consultar == 'PROGRAMADAS')
    {
      $interrupciones = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupcionesPro($fecha_inicial, $fecha_final);
    }
    elseif ($consultar == 'CAUSAS-500')
    {
      $interrupciones = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupciones500($fecha_inicial, $fecha_final);
    }

    if ($interrupciones)
    {
      $eventos = $this->conversionModelo($interrupciones);
      $this->getUser()->agregarEventosFiltradosAlHist($eventos);
      return $eventos;
    }

    return array();
  }

  /**
   * Método que consulta y retorna una INTERRUPCIONES segun c_evento 
   * o num_f328, convirtiendola de modelo a SAF_EVENTOS y almacenandolo
   * en hist_eventos_filtrados de la sesion del usuario.
   * 
   * @param integer $c_evento
   * @return array SAF_EVENTO
   */
  private function filtrarPorCodEvento($c_evento)
  {
    $evento = array();
    $interrupciones = array();

    $interrupcion = Doctrine_Core::getTable('INTERRUPCIONES')->find($c_evento);

    if ($interrupcion)
    {
      array_push($interrupciones, $interrupcion);
      $evento = $this->conversionModelo($interrupciones);
      $this->getUser()->agregarEventosFiltradosAlHist($evento);
    }

    return $evento;
  }
  
  /**
   * Método que convierte del modelo INTERRUPCIONES a SAF_EVENTO
   * 
   * @param Doctrine_Collection INTERRUPCIONES $interrupciones
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

  /**
   * Método que crea una agenda con las observaciones hechas y los eventos elegidos
   * por el usuario en el tiempo de su sesion.
   * 
   * @param string $obs_agenda
   * @param array $eventos_a_guardar
   * @return boolean
   */
  private function commitAgenda($obs_agenda, $eventos_a_guardar)
  {
    try
    {
      $agenda = new SAF_AGENDA_CONVOCATORIA();
      $agenda->setDepartamento('IOD');
      $agenda->setObservacion($obs_agenda);
      $agenda->save();

      foreach ($eventos_a_guardar as $evento)
      {
        $evento->setIdAgenda($agenda);
        $evento->save();
      }
    }
    catch (Exception $exc)
    {
      return false;
    }

    return true;
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $saf_agenda_convocatoria = $form->save();

      $this->redirect('agenda_convocatoria/edit?id=' . $saf_agenda_convocatoria->getId());
    }
  }

}
