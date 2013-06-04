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
  // BORRAR :: AHORITA ES SOLO PARA VER CUALES EVENTOS TENGO EN MI SESSION
  public function executePrueba(sfWebRequest $request)
  {
    $eventos = $this->getUser()->getAttribute('hist_eventos_checked', array());
    foreach ($eventos as $evento)
    {
      echo $evento->getCEventoD()."\n";
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->saf_agenda_convocatori_as =
            Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SAF_AGENDA_CONVOCATORIAForm();
  }

  /**
   * Método que convierte del modelo INTERRUPCIONES a SAF_EVENTO, retornando una 
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

  /**
   * Acción que verifica cuales eventos fueron seleccionados despues del filtro
   * y los mismos son guardados en hist_eventos_checked (historial) de la sesión  
   * 
   * @param sfWebRequest $request
   */
  public function executeGuardarHistEventosChecked(sfWebRequest $request)
  {
    $hist_eventos_filtrados = $this->getUser()->getAttribute('hist_eventos_filtrados', array());
    $checkbox_seleccionados = 0; // Cantidad de checkbox seleccionados

    // Verifica cuales checkbox fueron seleccionados
    foreach ($hist_eventos_filtrados as $evento)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox_name = $request->getParameter($evento->getCEventoD());

      if ($checkbox_name == true)
      {
        $checkbox_seleccionados = $checkbox_seleccionados + 1;
        $this->guardarEventoCheckedEnHist($evento);
      }
    }

    if ($checkbox_seleccionados > 0)
    {
      return $this->renderText("<div class='alert alert-info'>
        <strong>".$checkbox_seleccionados." EVENTOS FUERON AGREGADOS A MI SESIÓN!</strong></div>");
    } else
    {
      return $this->renderText("<div class='alert alert-error'>
        <strong>NINGÚN EVENTO FUE AGREGADO A MI SESIÓN!</strong></div>");
    }
  }

  /**
   * Método que guarda eventos en hist_eventos_checked (historial) de la sesion del usuario.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   */
  public function guardarEventoCheckedEnHist($evento_checked)
  {
    // Busca los eventos ya almacenados en la variable de sesion correspondiente
    // si el identificador no esta definido aun, entonces devuelve un array()
    $eventos = $this->getUser()->getAttribute('hist_eventos_checked', array());

    array_push($eventos, $evento_checked);

    // Almacena el nuevo historial a la sesion del usuario
    $this->getUser()->setAttribute('hist_eventos_checked', $eventos);
  }

  /**
   * Método que guarda en hist_eventos_filtrados de la sesion del usuario, 
   * aquellos eventos que fueron encontrados por la accion filtrar.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   */
  public function guardarHistEventosFiltrados($eventos_filtrados)
  {
    // Busca los eventos ya almacenados en la variable de sesion correspondiente
    // si el identificador no esta definido aun, entonces devuelve un array()
    $eventos = $this->getUser()->getAttribute('hist_eventos_filtrados', array());

    foreach ($eventos_filtrados as $evento_filtrado)
    {
      array_push($eventos, $evento_filtrado);
    }

    // Almacena el nuevo historial a la sesion del usuario
    $this->getUser()->setAttribute('hist_eventos_filtrados', $eventos);
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
    // Inicializamos la variable de sesion his_eventos_filtrados con array()
    $this->getUser()->setAttribute('hist_eventos_filtrados', array());

    $parametros_form = $request->getParameter('saf_agenda_convocatoria');

    if ($parametros_form['f_ini'] == '' || $parametros_form['f_fin'] == '')
    {
      return $this->renderText("<div class='alert alert-error'>
        <strong>NINGUNA FECHA FUE SELECCIONADA</strong></div>");
    } else
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

}
