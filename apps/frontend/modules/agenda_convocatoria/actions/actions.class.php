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

  /**
   * Acción que busca todas las INTERRUPCIONES segun un rango de  
   * fechas, convirtiendolas de modelo a SAF_EVENTOS y almacenandolos   
   * en hist_eventos_filtrados de la sesion del usuario.
   * 
   * @param sfWebRequest $request
   */
  public function executeFiltrar(sfWebRequest $request)
  {
    // Cada vez que se hace un filtro se inicializa la variable de sesión
    $this->getUser()->setAttribute('hist_eventos_filtrados', array());

    $parametros_form = $request->getParameter('saf_agenda_convocatoria');

    if ($parametros_form['f_ini'] == '' || $parametros_form['f_fin'] == '')
    {
      return $this->renderText("<i class='icon-ban-circle'></i> Ninguna fecha fue seleccionada");
    }
    else
    {
      if ($interrupciones_imp = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupcionesImp($parametros_form['f_ini'], $parametros_form['f_fin']))
      {
        $eventos_imp = $this->conversionModelo($interrupciones_imp);
        $this->guardarHistEventosFiltrados($eventos_imp);
      }

      if ($interrupciones_pro = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupcionesPro($parametros_form['f_ini'], $parametros_form['f_fin']))
      {
        $eventos_pro = $this->conversionModelo($interrupciones_pro);
        $this->guardarHistEventosFiltrados($eventos_pro);
      }

      if ($interrupciones_500 = Doctrine::getTable('INTERRUPCIONES')
              ->getInterrupciones500($parametros_form['f_ini'], $parametros_form['f_fin']))
      {
        $eventos_500 = $this->conversionModelo($interrupciones_500);
        $this->guardarHistEventosFiltrados($eventos_500);
      }

      $this->eventos_imp = $eventos_imp;
      $this->eventos_pro = $eventos_pro;
      $this->eventos_500 = $eventos_500;
    }
  }

  /**
   * Acción que guarda la agenda con observaciones y los eventos confirmados 
   * por el usuario, a través de los checkbox.
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  public function executeGuardarAgenda(sfWebRequest $request)
  {
    $eventos_a_guardar = array();
    $eventos_sesion = $this->getUser()->getAttribute('hist_eventos_sesion', array());
    foreach ($eventos_sesion as $evento_sesion)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox_name = $request->getParameter($evento_sesion->getCEventoD());

      if ($checkbox_name == true)
      {
        array_push($eventos_a_guardar, $evento_sesion);
      }
    }

    if (count($eventos_a_guardar) > 0)
    {
      if ($this->commitAgenda($request->getParameter('observacion'), $eventos_a_guardar))
      {
        $this->getUser()->setAttribute('hist_eventos_sesion', array());
        return $this->renderText("<div class='alert alert-success'><i class='icon-thumbs-up'>
          </i> <strong>LA AGENDA FUE GUARDADA CON EXITO!</strong></div>");
      }
      else
      {
        return $this->renderText("<div class='alert alert-error'>
          <i class='icon-thumbs-down'></i> <strong>LA AGENDA NO FUE GUARDADA CON 
          EXITO! (Comuniquese con el analista de sistema si el problema persiste)</strong></div>");
      }
    }
    else
    {
      return $this->renderText("<i class='icon-ban-circle'></i> No se 
        seleccionaron eventos para la agenda, vuelva a intentar");
    }
  }

  /**
   * Acción que verifica cuales eventos fueron seleccionados despues del filtro 
   * (busqueda) para agregarlos a la variable de sesion hist_eventos_sesion
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  public function executeAgregarEventosAMiSesion(sfWebRequest $request)
  {
    $decir = "";
    $checkbox_seleccionados = 0;
    $hist_eventos_filtrados = $this->getUser()->getAttribute('hist_eventos_filtrados', array());

    // Verifica cuales checkbox fueron seleccionados
    foreach ($hist_eventos_filtrados as $evento_filtrado)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox = $request->getParameter($evento_filtrado->getCEventoD());

      if ($checkbox == true)
      {
        $checkbox_seleccionados = $checkbox_seleccionados + 1;
        if ($this->guardarEventoCheckedEnHist($evento_filtrado))
        {
          $decir = $decir . "<i class='icon-ok'></i> " . $evento_filtrado->getCEventoD() . "<br>";
        }
        else
        {
          $decir = $decir . "<i class='icon-remove'></i> " . $evento_filtrado->getCEventoD() . "<br>";
        }
      }
    }

    if ($checkbox_seleccionados > 0)
    {
      return $this->renderText("<div class='alert alert-info'><strong><u>Eventos 
        agregados a mi sesión:</u></strong><br><br>" . $decir . "</div>");
    }
    else
    {
      return $this->renderText("<i class='icon-ban-circle'></i> 
        No se seleccionaron eventos para guardar en la sesión");
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
    $eventos = $this->getUser()->getAttribute('hist_eventos_sesion', array());
    $this->eventos = $eventos;
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

      $this->redirect('agenda_convocatoria/edit?id=' . $saf_agenda_convocatoria->getId());
    }
  }

  /**
   * Método que convierte del modelo INTERRUPCIONES a SAF_EVENTO
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

  /**
   * Método que guarda un evento checked o seleccionado por el usuario
   * en la variable de sesion hist_eventos_sesion.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   * @return boolean
   */
  private function guardarEventoCheckedEnHist($evento_checked)
  {
    // Busca los eventos ya almacenados en la variable de sesión correspondiente
    // si el identificador no esta definido aun, entonces devuelve un array()
    $eventos_sesion = $this->getUser()->getAttribute('hist_eventos_sesion', array());

    // Se verifica si el evento_checked no esta en la variable de sesión.
    foreach ($eventos_sesion as $evento_sesion)
    {
      if ($evento_sesion->getCEventoD() == $evento_checked->getCEventoD())
      {
        return false;
      }
    }

    array_push($eventos_sesion, $evento_checked);
    $this->getUser()->setAttribute('hist_eventos_sesion', $eventos_sesion);

    return true;
  }

  /**
   * Método que guarda en hist_eventos_filtrados de la sesion del usuario, 
   * aquellos eventos que fueron encontrados por la accion filtrar.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   */
  private function guardarHistEventosFiltrados($eventos_filtrados)
  {
    // Busca los eventos ya almacenados en la variable de sesion correspondiente
    // si el identificador no esta definido aun, entonces se setea con un array()
    $eventos = $this->getUser()->getAttribute('hist_eventos_filtrados', array());

    foreach ($eventos_filtrados as $evento_filtrado)
    {
      array_push($eventos, $evento_filtrado);
    }

    // Almacena el nuevo historial a la sesion del usuario
    $this->getUser()->setAttribute('hist_eventos_filtrados', $eventos);
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
}
