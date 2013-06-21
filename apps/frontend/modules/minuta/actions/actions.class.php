<?php

/**
 * minuta actions.
 *
 * @package    Proyecto_SAF
 * @subpackage minuta
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class minutaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->evento = Doctrine_Core::getTable('SAF_EVENTO')->find(4);
  }

  /**
   * Acción que manda a procesar todo el desarrollo que se le hizo a un evento
   * 
   * @param sfWebRequest $request
   */
  public function executeProcesarEvento(sfWebRequest $request)
  {
    $this->verificarFotosYGuardar($request);
    $this->verificarRazonesMVAminYGuardar($request);
    $this->verificarBitacoraYGuardar($request);
    $this->verificarAccionesYRecomendacionesYGuardar($request);
    $this->verificarCompromisosYResponsablesYGuardar($request);
  }

  /**
   * Acción que retorna todas las razones disponibles por la que un evento supera los 999MVAmin
   * 
   * @param sfWebRequest $request
   * @return string
   */
  public function executeRazonesMVAmin(sfWebRequest $request)
  {
    $razones = Doctrine_Core::getTable('SAF_RAZON_MVAMIN')->createQuery()->execute();

    $data_source = '';

    foreach ($razones as $razon)
    {
      $data_source = $data_source . '"' . $razon->getRazon() . '",';
    }

    // Enviamos todas las razones sin la ultima coma (,). Ejem: "r1","r2","r3"
    return $this->renderText(substr($data_source, 0, -1));
  }

  /**
   * Acción que retorna todas las unidades que siempre asisten al CAF
   * 
   * @param sfWebRequest $request
   * @return string
   */
  public function executeUnidadEquipo(sfWebRequest $request)
  {
    $unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->createQuery()->execute();

    $data_source = '';

    foreach ($unidades as $unidad)
    {
      $data_source = $data_source . "<option value='" . $unidad->getId() . "'>" . $unidad->getNombre() . "</option>";
    }

    // Enviamos todas las unidades sin la ultima coma (,). Ejem: "u1","u2","u3"
    return $this->renderText($data_source);
  }

  /**
   * Método que verifica si existen fotos agregadas y que las mismas cumplan con 
   * el tipo de formato y con el tamaño, para despues mandarlas a guardar en bd.
   * 
   * @param sfWebRequest $request
   */
  private function verificarFotosYGuardar($request)
  {
    $num_foto = 1;

    while ($request->getParameter('titulo_foto' . $num_foto))
    {
      $tipo = $_FILES["foto" . $num_foto]["type"];
      $tamano = $_FILES["foto" . $num_foto]["size"] / 1024;

      if ((($tipo == "image/gif") || ($tipo == "image/jpeg") ||
              ($tipo == "image/jpg") || ($tipo == "image/png")) && ($tamano < 50))
      {
        $this->guardarFoto($request, $num_foto);
      }

      $num_foto++;
    }
  }

  /**
   * Método que verifica si existen razones agregadas por la que un evento pueda 
   * superar los 999MVAmin y que las mismas correspondan con las de la bd. 
   * También manda verificar que la misma razon no sea agregada mas de una vez
   * 
   * @param sfWebRequest $request
   */
  private function verificarRazonesMVAminYGuardar($request)
  {
    $num_razon = 1;
    $razones = Doctrine_Core::getTable('SAF_RAZON_MVAMIN')->createQuery()->execute();

    // Mientras existan razones agregadas...
    while ($request->getParameter('razon' . $num_razon))
    {
      foreach ($razones as $razon_de_razones)
      { // Se verifica que la razon agregada sea una correcta comparandola con las de la BD
        if ($request->getParameter('razon' . $num_razon) == $razon_de_razones->getRazon())
        {
          // Si no fue agregada mas de una vez procedemos a guardarla
          if (!$this->verificarSiLaRazonYaFueAgregada($num_razon, $request))
          {
            $this->guardarEventoRazon($request, $num_razon, $razon_de_razones->getId());
          }

          break;
        }
      }

      $num_razon++;
    }
  }

  /**
   * Método que verifica si una razon fue agregada mas de una vez al mismo evento.
   * 
   * @param integer $num_razon_a_verificar
   * @param sfWebRequest $request
   * @return boolean
   */
  private function verificarSiLaRazonYaFueAgregada($num_razon_a_verificar, $request)
  {
    $num_razon = $num_razon_a_verificar + 1;

    // Mientras existan razones agregadas siguientes a la razon a verificar...
    while ($request->getParameter('razon' . $num_razon))
    {// si la razon fue agregada mas de una vez
      if ($request->getParameter('razon' . $num_razon_a_verificar) == $request->getParameter('razon' . $num_razon))
      {
        return true;
      }

      $num_razon++;
    }

    return false;
  }

  /**
   * Método que verifica si fue agregada el resumen de la bitacora del evento 
   * para ser guardada en bd.
   * 
   * @param sfWebRequest $request
   */
  private function verificarBitacoraYGuardar($request)
  {
    if ($request->getParameter('bitacora') != "")
    {
      $bitacora = new SAF_VARIO();
      $bitacora->setIdEvento(4);
      $bitacora->setTipo('BITACORA');
      $bitacora->setDescripcion($request->getParameter('bitacora'));
      $bitacora->save();
    }
  }

  /**
   * Método que verifica si fue agregada acciones y recomendaciones al evento 
   * para ser guardada en bd.
   * 
   * @param sfWebRequest $request
   */
  private function verificarAccionesYRecomendacionesYGuardar($request)
  {
    if ($request->getParameter('acciones'))
    {
      $acciones_y_recomendaciones = new SAF_VARIO();
      $acciones_y_recomendaciones->setIdEvento(4);
      $acciones_y_recomendaciones->setTipo('ACCIONES_Y_RECOMENDACIONES');
      $acciones_y_recomendaciones->setDescripcion($request->getParameter('acciones'));
      $acciones_y_recomendaciones->save();
    }
  }

  /**
   * Método que verifica si fueron agregados compromisos con sus respectivos
   * responsables, mandando a verificar que los mismo no se repitan para dicho
   * compromiso.
   * 
   * @param sfWebRequest $request
   */
  private function verificarCompromisosYResponsablesYGuardar($request)
  {
    $num_comp = 1;

    // Mientras existan compromisos agregados...
    while ($request->getParameter('compromiso' . $num_comp))
    {
      $num_resp = 1;

      if ($compromiso = $this->guardarCompromiso($request, $num_comp))
      {
        // Mientras existan responsables para ese compromiso
        while ($id_resp_comp = $request->getParameter('responsable_compromiso' . $num_comp . $num_resp))
        {
          // Si no has sido agregado, se guarda.
          if (!$this->verificarSiElResponsableYaFueAgregado($num_resp, $num_comp, $request))
          {
            $this->guardarResponsableCompromiso($id_resp_comp, $compromiso);
          }

          $num_resp++;
        }        
      }
      
      $num_comp++;
    }
  }

  /**
   * Método que verifica si un responsable fue agregado para un mismo compromiso
   * y evento mas de una vez.
   * 
   * @param integer $num_resp_a_verificar
   * @param integer $num_comp
   * @param sfWebRequest $request
   * @return boolean
   */
  private function verificarSiElResponsableYaFueAgregado($num_resp_a_verificar, $num_comp, $request)
  {
    $num_resp = $num_resp_a_verificar + 1;

    // Mientras existan responsables siguientes al responsable a verificar...
    while ($id_resp_comp = $request->getParameter('responsable_compromiso' . $num_comp . $num_resp))
    {
      // Si el responsable se repite (fue agregado mas de una vez)
      if ($id_resp_comp == $request->getParameter('responsable_compromiso' . $num_comp . $num_resp_a_verificar))
      {
        return true;
      }

      $num_resp++;
    }

    return false;
  }

  /**
   * Método que sube al servidor un archivo de foto y guarda la información 
   * en bd, si la misma no se encuentra subida o repetida.
   * 
   * @param sfWebRequest $request
   * @param type $num_foto
   */
  private function guardarFoto($request, $num_foto)
  {
    // Si no existe el archivo en la carpeta "subidas" entonces guardamos.
    if (!file_exists("subidas/" . $_FILES["foto" . $num_foto]["name"]))
    {
      $foto = new SAF_FOTO();

      $foto->setTitulo($request->getParameter('titulo_foto' . $num_foto));
      $foto->setSubTitulo($request->getParameter('sub_titulo_foto' . $num_foto));
      $foto->setDir("subidas/" . $_FILES["foto" . $num_foto]["name"]);
      $foto->setIdEvento(4);  // ACOMODAR

      $foto->save();

      // Subimos la foto al servidor
      move_uploaded_file($_FILES["foto" . $num_foto]["tmp_name"], $foto->getDir());
    }
  }

  /**
   * Método que guarda la razon y los MVAmin correspondiente a un evento
   * 
   * @param sfWebRequest $request
   * @param integer $num_razon
   * @param integer $id_razon
   */
  private function guardarEventoRazon($request, $num_razon, $id_razon)
  {
    $evento_razon = new SAF_EVENTO_RAZON();
    $evento_razon->setIdEvento(4);
    $evento_razon->setIdRazon($id_razon);
    $evento_razon->setMvaMin($request->getParameter('mva_razon' . $num_razon));
    $evento_razon->save();
  }

  /**
   * Método que guarda un compromiso correspondiente a un evento si la fecha
   * de duración estimada es correcta. (Mayor a la hora actual)
   * 
   * @param sfWebRequest $request
   * @param integer $num_comp
   * @return SAF_VARIO | boolean
   */
  private function guardarCompromiso($request, $num_comp)
  {
    $f_compuesta = explode('T', $request->getParameter('f_duracion_estimada_comp' . $num_comp));
    $f_duracion_estimada = $f_compuesta[0] . ' ' . $f_compuesta[1];

    // Si la fecha de estimación elegida es mayor a la fecha del sistema
    if (strtotime($f_duracion_estimada) > time())
    {
      $compromiso = new SAF_VARIO();
      $compromiso->setIdEvento(4);
      $compromiso->setTipo('COMPROMISO');
      $compromiso->setDescripcion($request->getParameter('compromiso' . $num_comp));
      $compromiso->setFDuracionEstimada($f_duracion_estimada);
      $compromiso->setStatus('PENDIENTE');
      $compromiso->save();

      return $compromiso;
    }

    return false;
  }

  /**
   * Método que guarda el o los responsables correspondiente a un compromiso y evento
   * 
   * @param type $responsable
   * @param type $compromiso
   */
  private function guardarResponsableCompromiso($responsable, $compromiso)
  {
    $comp_ue = new SAF_COMP_UE();
    $comp_ue->setIdCompromiso($compromiso);
    $comp_ue->setIdUe($responsable);
    $comp_ue->save();
  }

}