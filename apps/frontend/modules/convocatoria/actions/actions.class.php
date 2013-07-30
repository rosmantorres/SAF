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

  /**
   * Acción que lista todas las convocatorias creadas
   * 
   * @param sfWebRequest $request
   */
  public function executeListar()
  {
    $this->convocatorias = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->getConvocatorias();

    $this->crear_convocatorias = !$this->verificarSiHayConvocatoriasSinTerminar($this->convocatorias);
  }

  /**
   * Acción que comienza con el proceso de una nueva convocatoria
   * 
   * @param sfWebRequest $request
   */
  public function executeNueva()
  {
    if ($this->verificarSiHayConvocatoriasSinTerminar(Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->getConvocatorias()))
    {
      $this->redirect('@index_convocatoria');
    }

    $this->agendas_pendientes = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
            ->getAgendasPendientes();

    $eventos_pendientes = Doctrine_Core::getTable('SAF_EVENTO_CONVOCATORIA')->getEventosPendientes();

    $this->eventos_pendientes = array();

    foreach ($eventos_pendientes as $evento_pendiente)
    {
      array_push($this->eventos_pendientes, Doctrine_Core::getTable('SAF_EVENTO')->find($evento_pendiente['ID_EVENTO']));
    }
  }

  /**
   * Acción que muestra una convocatoria
   * 
   * @param sfWebRequest $request
   */
  public function executeMostrar(sfWebRequest $request)
  {
    $this->convocatoria = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')
            ->find($request->getParameter('id'));

    $this->forward404Unless($this->convocatoria);

    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosConvocatoria($request->getParameter('id'));

    $this->forward404Unless($this->eventos);
  }

  /**
   * Acción que cambia el status de una convocatoria 
   * 
   * @param sfWebRequest $request
   */
  public function executeCambiarStatus(sfWebRequest $request)
  {
    $convocatoria = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')
            ->find($request->getParameter('id'));

    $convocatoria->setStatus($request->getParameter('status'));

    if ($request->getParameter('status') == 'EJECUCION')
    {
      $convocatoria->save();

      // ENVIANDO EL CORREO DE AVISO
      $correo = new Correo('AVISO SAF: Convocatoria en ejecución', 'http://' . sfConfig::get('app_servidor_web') . '/convocatoria/mostrar/' . $convocatoria);
      $correo->enviarATodos();
      $this->getMailer()->send($correo);

      $this->redirect('@nueva_minuta?id=' . $request->getParameter('id'));
    }
    elseif ($request->getParameter('status') == 'SUSPENDIDA')
    {
      $convocatoria->setMotivoSuspencion($request->getParameter('motivo'));
      $convocatoria->save();

      // ENVIANDO EL CORREO DE AVISO
      $correo = new Correo('AVISO SAF: Convocatoria Suspendida', 'Motivo: ' . $convocatoria->getMotivoSuspencion() . ' http://' . sfConfig::get('app_servidor_web') . '/convocatoria/mostrar/' . $convocatoria);
      $correo->enviarATodos();
      $this->getMailer()->send($correo);

      $this->redirect('@mostrar_convocatoria?id=' . $request->getParameter('id'));
    }
  }

  /**
   * Acción que carga todos los eventos de una agenda para despues 
   * tener la posibilidad de agregarlos a la convocatoria
   * 
   * @param sfWebRequest $request
   * @return type
   */
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

  /**
   * Acción que agrega eventos a la convocatoria enviandolos a la sesion del usuario
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
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

  /**
   * Acción que muestra los eventos que estan agregados en la convocatoria,
   * permitiendo guardarlos con toda la descripción de la misma.
   * 
   * @param sfWebRequest $request
   */
  public function executeVistaPreliminar()
  {
    $eventos = $this->getUser()->getAttribute('hist_eventos_convocatoria', array());
    $this->eventos = $eventos;
  }

  /**
   * Acción que guarda una convocatoria con los eventos seleccionados por el
   * usuario a traves de los checkbox.
   * 
   * @param sfWebRequest $request
   */
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

  /**
   * Método que verifica una lista de convocatorias y retorna true si existe al 
   * menos una que este en ejecución o activa para así poder quitar la opción de 
   * seguir creando convocatorías.
   * 
   * @param Doctrine_Collection SAF_CONVOCATORIA_CAF $convocatorias
   * @return boolean
   */
  private function verificarSiHayConvocatoriasSinTerminar($convocatorias)
  {
    foreach ($convocatorias as $convocatoria)
    {
      if ($convocatoria->getStatus() == 'EJECUCION' || $convocatoria->getStatus() == 'ACTIVA')
      {
        return true;
      }
    }

    return false;
  }

  /**
   * Método que crea y guarda una convocatoria con toda sus descripciones hecha
   * por el usuario y los eventos elegidos en el tiempo de su sesion.
   * 
   * @param sfWebRequest $request
   * @param array $eventos_a_guardar
   * @return boolean
   */
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
        $evento_convocatoria = new SAF_EVENTO_CONVOCATORIA();
        $evento_convocatoria->setIdEvento($evento);
        $evento_convocatoria->setIdConvocatoria($convocatoria);
        $evento_convocatoria->save();
      }

      // ENVIANDO EL CORREO DE AVISO
      $correo = new Correo('AVISO SAF: Nueva Convocatoria Creada con fecha ' . $request->getParameter('f_convoca'), 'http://' . sfConfig::get('app_servidor_web') . '/convocatoria/mostrar/' . $convocatoria);
      $correo->enviarATodos();
      $this->getMailer()->send($correo);
    }
    catch (Exception $exc)
    {
      return false;
    }

    return true;
  }

}
