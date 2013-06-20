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

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->evento = Doctrine_Core::getTable('SAF_EVENTO')->find(4);
  }

  public function executeProcesarEvento(sfWebRequest $request)
  {
    $this->verificarFotosYGuardar($request);
    $this->verificarRazonesMVAminYGuardar($request);
    $this->verificarBitacoraYGuardar($request);
    $this->verificarAccionesYRecomendacionesYGuardar($request);
    $this->verificarCompromisosYResponsablesYGuardar($request);
  }

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
  
  private function verificarRazonesMVAminYGuardar($request)
  {
    $cont = 1;
    $razones = Doctrine_Core::getTable('SAF_RAZON_MVAMIN')->createQuery()->execute();

    while ($request->getParameter('razon' . $cont))
    {
      foreach ($razones as $razon_de_razones)
      {
        if ($request->getParameter('razon' . $cont) == $razon_de_razones->getRazon())
        {
          $this->guardarEventoRazon($request, $cont, $razon_de_razones->getId());
          break;          
        }
      }   
      
      $cont++;
    }
  }
  
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

  private function verificarCompromisosYResponsablesYGuardar($request)
  {
    $cont = 1;

    while ($request->getParameter('compromiso' . $cont))
    {
      $cont2 = 1;
      
      $compromiso = new SAF_VARIO();
      $compromiso->setIdEvento(4);
      $compromiso->setTipo('COMPROMISO');
      $compromiso->setDescripcion($request->getParameter('compromiso' . $cont));
      $compromiso->setFDuracionEstimada('2012-05-20');
      $compromiso->setStatus('PENDIENTE');
      $compromiso->save();

      while ($request->getParameter('responsable_compromiso' . $cont . $cont2))
      {
        $responsable_compromiso = $request->getParameter('responsable_compromiso' . $cont . $cont2);
        
        $comp_ue = new SAF_COMP_UE();
        $comp_ue->setIdCompromiso($compromiso);
        $comp_ue->setIdUe($responsable_compromiso);
        $comp_ue->save();
        
        $cont2++;
      }

      $cont++;
    }
  }
  
  private function guardarFoto($request, $num_foto)
  {
    $foto = new SAF_FOTO();
    $foto->setTitulo($request->getParameter('titulo_foto' . $num_foto));
    $foto->setSubTitulo($request->getParameter('sub_titulo_foto' . $num_foto));
    $foto->setDir("subidas/" . $_FILES["foto" . $num_foto]["name"]);
    $foto->setIdEvento(4);  // ACOMODAR

    if (!file_exists($foto->getDir()))
    {
      move_uploaded_file($_FILES["foto" . $num_foto]["tmp_name"], $foto->getDir());
    }

    $foto->save();
  }

  private function guardarEventoRazon($request, $num_razon, $id_razon)
  {
    $evento_razon = new SAF_EVENTO_RAZON();
    $evento_razon->setIdEvento(4);
    $evento_razon->setIdRazon($id_razon);
    $evento_razon->setMvaMin($request->getParameter('mva_razon' . $num_razon));
    $evento_razon->save();
  }
  
  private function guardarCompromiso()
  {
    
  }

}