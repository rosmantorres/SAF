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

    $this->form = new sfForm();
  }

  public function executeXxx(sfWebRequest $request)
  {
    $cont = 1;

    while ($request->getParameter('titulo_foto' . $cont)) {
      echo "<br>". $titulo_foto = $request->getParameter('titulo_foto' . $cont);
      echo "<br>". $sub_titulo_foto = $request->getParameter('sub_titulo_foto' . $cont);
      echo "<br>". $nombre_foto = $_FILES["foto" . $cont]["name"];
      echo "<br>". $tipo_foto = $_FILES["foto" . $cont]["type"];
      echo "<br>". $tamano_foto = $_FILES["foto" . $cont]["size"] / 1024;
      echo "<br>". $lugar_foto = $_FILES["foto" . $cont]["tmp_name"];
      $cont++;
    }
    
    $cont = 1;

    while ($request->getParameter('razon' . $cont)) {
      echo "<br>". $razon = $request->getParameter('razon' . $cont);
      echo "<br>". $mva_razon = $request->getParameter('mva_razon' . $cont);
      $cont++;
    }
    
    if ($request->getParameter('bitacora') != "")
    {
      echo "<br>". $resumen_bitacora = $request->getParameter('bitacora');
    }
    
    if ($request->getParameter('acciones'))
    {
      echo "<br>". $acciones_y_recomendaciones = $request->getParameter('acciones');
    }
    
    $cont = 1;
    
    while ($request->getParameter('compromiso' . $cont)) {
      echo "<br>". $compromiso = $request->getParameter('compromiso' . $cont);
      
      $cont2 = 1;
      while ($request->getParameter('responsable_compromiso' . $cont . $cont2)){
        echo "<br>". $responsable_compromiso = $request->getParameter('responsable_compromiso' . $cont . $cont2);
        $cont2++;
      }
      
      $cont++;
    }
  }

  private function comprobarImagen($tipo_archivo, $tamano_archivo)
  {
    $formatos = array("gif", "jpeg", "jpg", "png");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    if ((($tipo_archivo == "image/gif") || ($tipo_archivo == "image/jpeg") || 
         ($tipo_archivo == "image/jpg") || ($tipo_archivo == "image/pjpeg") || 
         ($tipo_archivo == "image/x-png") || ($tipo_archivo == "image/png")) && 
         ($tamano_archivo < 50) && in_array($extension, $formatos))
    {
      return true;
    }
  }

  public function executePrueba(sfWebRequest $request)
  {
    $data_source = '"Alfredo","Rosman"';
    return $this->renderText($data_source);
  }

}
