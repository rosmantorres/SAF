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
  /**
   * Acción que muestra la lista o todas las agendas creadas
   * 
   * @param sfWebRequest $request
   */
  public function executeListar(sfWebRequest $request)
  {
    $this->agendas = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();
  }

  /**
   * Acción que comienza con el proceso de una nueva agenda
   * 
   * @param sfWebRequest $request
   */
  public function executeNueva(sfWebRequest $request)
  {
    
  }

  /**
   * Acción que muestra una agenda
   * 
   * @param sfWebRequest $request
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->agenda = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->find($request->getParameter('id'));

    $this->forward404Unless($this->agenda);

    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosAgenda($request->getParameter('id'));

    $this->forward404Unless($this->eventos);
  }

  /**
   * Acción que coloca una agenda como pendiente.
   * 
   * @param sfWebRequest $request
   */
  public function executeColocarPendiente(sfWebRequest $request)
  {
     $this->forward404Unless(
             $agenda = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
             ->find($request->getParameter('id')));
     
     if ($agenda->getPendiente() == 1)
     {
       $agenda->setPendiente(0);
     }
     elseif ($agenda->getPendiente() == 0)
     {
       $agenda->setPendiente(1);
     }
     
     $agenda->save();
     $this->getUser()->setFlash('notice', 'LA AGENDA FUE CAMBIADA DE ESTADO CON EXITO!');
     $this->redirect('@mostrar_agenda?id='.$request->getParameter('id'));
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
   * Acción que agrega eventos a la agenda enviandolos a la sesion del usuario
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  public function executeAgregarEventosALaAgenda(sfWebRequest $request)
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
  public function executeVistaPreliminar(sfWebRequest $request)
  {
    $eventos = $this->getUser()->getAttribute('hist_eventos_agenda', array());
    $this->eventos = $eventos;
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
        $this->redirect('@index_agenda');
      }
      else
      {
        $this->getUser()->setFlash('error', 'LA AGENDA NO FUE GUARDADA CON EXITO! 
          (Comuniquese con el analista de sistema si el problema persiste)');
        $this->redirect('@vista_preliminar_agenda');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'DEBE INDICAR AL MENOS UN EVENTO');
      $this->redirect('@vista_preliminar_agenda');
    }
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
   * Método que crea y guarda una agenda con las observaciones hechas 
   * y los eventos elegidos por el usuario en el tiempo de su sesion.
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
      $agenda->setPendiente(1);
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
}
