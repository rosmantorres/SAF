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
  // Mensaje con todos los errores que se le muestra 
  // al usuario durante el desarrollo de un evento
  private $msj_error = '';

  /**
   * Acción que muestra la lista o todas las minutas creadas
   */
  public function executeListar()
  {
    
  }

  /**
   * Acción que muestra los eventos de la convocatoria a desarrollar, mostrando
   * el desarrollo que se le ha hecho a c/u y dando la opcion de poder editarlo.
   * 
   * @param sfWebRequest $request
   */
  public function executeInicioDesarrollo(sfWebRequest $request)
  {
    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')
            ->getEventosConvocatoria(1);
    
    $this->forward404Unless($this->eventos);
  }

  /**
   * Acción que comienza con el desarrollo de un evento (edición) y a su vez 
   * muestra pasadas ediciones ya desarrolladas por el usuario si fuese el caso.
   * 
   * @param sfWebRequest $request
   */
  public function executeDesarrollarEvento(sfWebRequest $request)
  {
    $id_evento = $request->getParameter('id');

    $this->evento = Doctrine_Core::getTable('SAF_EVENTO')->find($id_evento);

    $this->forward404Unless($this->evento);
    
    $this->fotos = $this->obtenerFotosDelEvento($id_evento);

    $this->razones = $this->obtenerRazonesDelEvento($id_evento);

    $this->data_razones = $this->obtenerRazonesMVAmin();

    $this->resumen_bitacora = $this->obtenerResumenBitacoraDelEvento($id_evento);

    $this->acciones_recomendaciones = $this->obtenerAccionesYRecomendacionesDelEvento($id_evento);

    $this->compromisos = $this->obtenerCompromisosDelEvento($id_evento);

    $this->data_ue = $this->obtenerUnidadesEquipos();
  }
  
  /**
   * Acción que procesa todo el desarrollo que se le hizo a un evento.
   * 
   * @param sfWebRequest $request
   */
  public function executeProcesarEvento(sfWebRequest $request)
  {
    $id_evento = $request->getParameter('id');

    $this->reiniciarFotosDelEvento($id_evento);
    $this->verificarFotosYGuardar($request);

    $this->reiniciarRazonesDelEvento($id_evento);
    $this->verificarRazonesMVAminYGuardar($request);

    $this->reiniciarResumenBitacoraDelEvento($id_evento);
    $this->verificarBitacoraYGuardar($request);

    $this->reiniciarAccionesYRecomendacionesDelEvento($id_evento);
    $this->verificarAccionesYRecomendacionesYGuardar($request);

    $this->reiniciarCompromisosDelEvento($id_evento);
    $this->verificarCompromisosYResponsablesYGuardar($request);

    if ($this->msj_error != '')
    {
      $this->getUser()->setFlash('error', $this->msj_error);      
    }
    else
    {
      $this->getUser()->setFlash('notice', 'Desarrollo procesado Exitosamente!');
    }  
    
    $this->redirect('minuta/desarrollarEvento?id=' . $request->getParameter('id'));
  }

  /**
   * Acción que retorna todas las razones disponibles por la que un evento supera
   * los 999MVAmin. Se necesita esta acción ya que se llama desde minuta.js
   * a través del método ajax. Los js pueden solo llamar acciones (execute).
   */
  public function executeRazonesMVAmin()
  {
    return $this->renderText($this->obtenerRazonesMVAmin());
  }

  /**
   * Acción que retorna todas las unidades que siempre asisten al CAF.  
   * Se necesita esta acción ya que se llama desde minuta.js a través 
   * del método ajax. Los js pueden solo llamar acciones (execute).
   * 
   * @param sfWebRequest $request
   * @return type
   */
  public function executeUnidadEquipo(sfWebRequest $request)
  {
    $unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')
            ->createQuery()
            ->orderBy('nombre')
            ->execute();

    $data_source = '';

    foreach ($unidades as $unidad)
    {
      $data_source = $data_source . "<option value='" . $unidad->getId() . "'>" . $unidad->getNombre() . "</option>";
    }

    // Enviamos todas las unidades sin la ultima coma (,). Ejem: "u1","u2","u3"
    return $this->renderText($data_source);
  }
  
  /**
   * Acción que retorna todo el personal agregado en la bd.
   * Se necesita esta acción ya que se llama desde minuta.js a través 
   * del método ajax. Los js pueden solo llamar acciones (execute).
   * 
   * @param sfWebRequest $request
   * @return type
   */
  public function executePersonal(sfWebRequest $request)
  {
    $personal = Doctrine_Core::getTable('SAF_PERSONAL')
            ->createQuery()
            ->execute();
    
    $data_source = '';

    foreach ($personal as $persona)
    {
      $data_source = $data_source . '"' . $persona->getCI() . '",';
    }

    // Enviamos todas las razones sin la ultima coma (,). Ejem: "r1","r2","r3"
    return $this->renderText(substr($data_source, 0, -1));
  }

  public function executeFinalizarMinuta(sfWebRequest $request)
  {
    
  }

  /**
   * Método que comienza con el proceso de verificación de las imagenes para
   * despues proceder a guardar en bd.
   * 
   * @param sfWebRequest $request
   */
  private function verificarFotosYGuardar($request)
  {
    $num_foto = 1;

    // Mientras existan fotos agregadas...
    while ($request->getParameter('titulo_foto' . $num_foto))
    { // Si se seleccionó una foto para subir al servidor
      if ($_FILES["foto" . $num_foto]["name"])
      { // Si el formato y el tamaño del archivo es correcto
        if ($this->verificarFormatoYTamahnoFoto($request, $num_foto))
        {
          $this->guardarFoto($request, $num_foto);
        }
      }
      else // Si no se seleccionó una foto para subir al servidor
      {
        $this->guardarFoto($request, $num_foto);
      }

      $num_foto++;
    }
  }

  /**
   * Método que verifica si el tamaño y formato del archivo de la imagen,
   * cumple con los requisitos del sistema.
   * 
   * @param sfWebRequest $request
   * @param integer $num_foto
   * @return boolean
   */
  public function verificarFormatoYTamahnoFoto($request, $num_foto)
  {
    $tipo = $_FILES["foto" . $num_foto]["type"];
    $tamano = $_FILES["foto" . $num_foto]["size"] / 1024;

    if ((($tipo == "image/gif") || ($tipo == "image/jpeg") ||
            ($tipo == "image/jpg") || ($tipo == "image/png")) && ($tamano < 50))
    {
      return true;
    }
    else
    {
      $this->msj_error = $this->msj_error . '° El formato o tamaño de la imagen ' .
              $request->getParameter('titulo_foto' . $num_foto) . ' no es valido. ';

      return false;
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
   * Método que verifica si fue agregada el resumen de la 
   * bitacora del evento para ser guardada en bd.
   * 
   * @param sfWebRequest $request
   */
  private function verificarBitacoraYGuardar($request)
  {
    if ($request->getParameter('bitacora') != "")
    {
      $this->guardarResumenBitacora($request);
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
      $this->guardarAccionesYRecomendaciones($request);
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
   * Método que obtiene todas las fotos que tiene un evento específico.
   * 
   * @param integer $id_evento
   * @return Doctrine_Collection SAF_FOTO
   */
  private function obtenerFotosDelEvento($id_evento)
  {
    return Doctrine_Core::getTable('SAF_FOTO')
                    ->createQuery()
                    ->where('id_evento = ?', $id_evento)
                    ->execute();
  }

  /**
   * Método que obtiene todas las razones de un evento específico por la que 
   * se supera los 999MVAmin.
   * 
   * @param integer $id_evento
   * @return Doctrine_Collection SAF_EVENTO_RAZON
   */
  private function obtenerRazonesDelEvento($id_evento)
  {
    return Doctrine_Core::getTable('SAF_EVENTO_RAZON')
                    ->createQuery()
                    ->where('id_evento = ?', $id_evento)
                    ->execute();
  }

  /**
   * Método que obtiene el resumen de la bitacora de un evento específico.
   * 
   * @param integer $id_evento
   * @return SAF_VARIO
   */
  private function obtenerResumenBitacoraDelEvento($id_evento)
  {
    return Doctrine_Core::getTable('SAF_VARIO')
                    ->createQuery()
                    ->where('id_evento = ?', $id_evento)
                    ->andWhere('tipo = ?', "BITACORA")
                    ->fetchOne();
  }

  /**
   * Método que obtiene las acciones y recomendaciones de un evento específico.
   * 
   * @param integer $id_evento
   * @return SAF_VARIO
   */
  private function obtenerAccionesYRecomendacionesDelEvento($id_evento)
  {
    return Doctrine_Core::getTable('SAF_VARIO')
                    ->createQuery()
                    ->where('id_evento = ?', $id_evento)
                    ->andWhere('tipo = ?', "ACCIONES_Y_RECOMENDACIONES")
                    ->fetchOne();
  }

  /**
   * Método que obtiene todos los compromisos de un evento específico
   * 
   * @param integer $id_evento
   * @return Doctrine_Collection SAF_VARIO
   */
  private function obtenerCompromisosDelEvento($id_evento)
  {
    return Doctrine_Core::getTable('SAF_VARIO')
                    ->createQuery()
                    ->where('id_evento = ?', $id_evento)
                    ->andWhere('tipo = ?', "COMPROMISO")
                    ->execute();
  }

  /**
   * Método que retorna string con formato específico de todas las razones 
   * disponibles por lo que un evento supera los 999MVAmin.
   * 
   * @return string
   */
  private function obtenerRazonesMVAmin()
  {
    $razones = Doctrine_Core::getTable('SAF_RAZON_MVAMIN')->createQuery()->execute();

    $data_source = '';

    foreach ($razones as $razon)
    {
      $data_source = $data_source . '"' . $razon->getRazon() . '",';
    }

    // Enviamos todas las razones sin la ultima coma (,). Ejem: "r1","r2","r3"
    return substr($data_source, 0, -1);
  }

  /**
   * Método que retorna todas las unidades que asisten a los comité
   * 
   * @return Doctrine_Collection SAF_UNIDAD_EQUIPO
   */
  private function obtenerUnidadesEquipos()
  {
    $unidades = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->createQuery()->execute();

    return $unidades;
  }

  /**
   * Método que reinicia o borra todos los registros SAF_FOTO de la BD
   * correspondientes a un evento.
   * 
   * @param integer $id_evento
   */
  private function reiniciarFotosDelEvento($id_evento)
  {
    $fotos = $this->obtenerFotosDelEvento($id_evento);

    foreach ($fotos as $foto)
    {
      // Borra el registro SAF_FOTO de la BD
      $foto->delete();
    }
  }

  /**
   * Método que reinicia o borra todos los registros SAF_EVENTO_RAZON de la BD
   * correspondientes a un evento. (Razones por la que supera los 999MVAmin).
   * 
   * @param integer $id_evento
   */
  private function reiniciarRazonesDelEvento($id_evento)
  {
    $razones = $this->obtenerRazonesDelEvento($id_evento);

    foreach ($razones as $razon)
    {
      // Borra el registro SAF_EVENTO_RAZON de la BD
      $razon->delete();
    }
  }

  /**
   * Método que reinicia o borra el registro SAF_VARIO (BITACORA) de la BD
   * correspondiente a un evento.
   * 
   * @param integer $id_evento
   */
  private function reiniciarResumenBitacoraDelEvento($id_evento)
  {
    if ($bitacora = $this->obtenerResumenBitacoraDelEvento($id_evento))
    {
      $bitacora->delete();
    }
  }

  /**
   * Método que reinicia o borra el registro SAF_VARIO (ACCIONES_Y_RECOMENDACIONES) 
   * de la BD correspondiente a un evento.
   * 
   * @param integer $id_evento
   */
  private function reiniciarAccionesYRecomendacionesDelEvento($id_evento)
  {
    if ($acciones_recomendaciones = $this->obtenerAccionesYRecomendacionesDelEvento($id_evento))
    {
      $acciones_recomendaciones->delete();
    }
  }

  /**
   * Método que reinicia o borra todos los registros SAF_VARIO (COMPROMISO) y
   * SAF_COMP_UE (RESPONSABLES) de la BD correspondientes a un evento.
   * 
   * @param integer $id_evento
   */
  private function reiniciarCompromisosDelEvento($id_evento)
  {
    $compromisos = $this->obtenerCompromisosDelEvento($id_evento);

    foreach ($compromisos as $compromiso)
    {
      $responsables = Doctrine_Core::getTable('SAF_COMP_UE')
              ->createQuery()
              ->where('id_compromiso = ?', $compromiso)
              ->execute();

      foreach ($responsables as $responsable)
      {
        // Borra el registro SAF_COMP_UE de la BD
        $responsable->delete();
      }

      // Borra el registro SAF_VARIO de la BD
      $compromiso->delete();
    }
  }

  /**
   * Método que suprime un archivo de foto del servidor. Cuando ya no se necesita.
   * 
   * @param string $dir
   */
  private function suprimirFotoServidor($dir)
  {
    // Si existe la foto en el servidor
    if (file_exists($dir))
    { // Se borra la foto
      unlink($dir);
    }
  }

  /**
   * Método que sube al servidor un archivo de foto y guarda la información en BD.
   * 
   * @param sfWebRequest $request
   * @param integer $num_foto
   */
  private function guardarFoto($request, $num_foto)
  {
    if ($_FILES["foto" . $num_foto]["name"])
    {
      $tipo_archivo = explode('.', $_FILES["foto" . $num_foto]["name"]);
      $nombre_foto = 'subidas/SAF' . mt_rand() . '.' . $tipo_archivo[1];
      if ($request->getParameter('id_foto' . $num_foto))
      {
        $this->suprimirFotoServidor($request->getParameter('id_foto' . $num_foto));
      }
    }
    else
    {
      $nombre_foto = $request->getParameter('id_foto' . $num_foto);
    }

    $foto = new SAF_FOTO();
    $foto->setTitulo($request->getParameter('titulo_foto' . $num_foto));
    $foto->setSubTitulo($request->getParameter('sub_titulo_foto' . $num_foto));
    $foto->setDir($nombre_foto);
    $foto->setIdEvento($request->getParameter('id'));

    $foto->save();

    move_uploaded_file($_FILES["foto" . $num_foto]["tmp_name"], $nombre_foto);
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
    $evento_razon->setIdEvento($request->getParameter('id'));
    $evento_razon->setIdRazon($id_razon);
    $evento_razon->setMvaMin($request->getParameter('mva_razon' . $num_razon));
    $evento_razon->save();
  }

  /**
   * Método que guarda el resumen de la bitácora correspondiente a un evento.
   * 
   * @param sfWebRequest $request
   */
  private function guardarResumenBitacora($request)
  {
    $bitacora = new SAF_VARIO();
    $bitacora->setIdEvento($request->getParameter('id'));
    $bitacora->setTipo('BITACORA');
    $bitacora->setDescripcion($request->getParameter('bitacora'));
    $bitacora->save();
  }

  /**
   * Método que guarda las acciones y recomendaciones correspondiente a un evento.
   * 
   * @param sfWebRequest $request
   */
  private function guardarAccionesYRecomendaciones($request)
  {
    $acciones_y_recomendaciones = new SAF_VARIO();
    $acciones_y_recomendaciones->setIdEvento($request->getParameter('id'));
    $acciones_y_recomendaciones->setTipo('ACCIONES_Y_RECOMENDACIONES');
    $acciones_y_recomendaciones->setDescripcion($request->getParameter('acciones'));
    $acciones_y_recomendaciones->save();
  }

  /**
   * Método que guarda un compromiso correspondiente a un evento si la fecha
   * de duración estimada es correcta. (Mayor a la hora actual).
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
      $compromiso->setIdEvento($request->getParameter('id'));
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
   * Método que guarda el o los responsables correspondiente a un compromiso y evento.
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