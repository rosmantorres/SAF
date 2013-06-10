<?php

class myUser extends sfBasicSecurityUser
{
  
  /**
   * Acción que verifica cuales eventos fueron seleccionados despues del filtro 
   * (busqueda) para agregarlos a la variable de sesion hist_eventos_sesion
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  public function agregarEventosAMiSesion($request, $sesion, $sesion_consulta)
  {
    $decir = "";
    $checkbox_seleccionados = 0;
    // hist_eventos_filtrados
    $eventos_sesion_consulta = $this->getUser()->getAttribute($sesion_consulta, array());

    // Verifica cuales checkbox fueron seleccionados
    foreach ($eventos_sesion_consulta as $evento)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox = $request->getParameter($evento->getCEventoD());

      if ($checkbox == true)
      {
        $checkbox_seleccionados = $checkbox_seleccionados + 1;
        
        if ($this->guardarEventoCheckedEnHist($evento, $sesion))
        {
          $decir = $decir . "<i class='icon-ok'></i> " . $evento->getCEventoD() . "<br>";
        }
        else
        {
          $decir = $decir . "<i class='icon-remove'></i> " . $evento->getCEventoD() . "<br>";
        }
      }
    }

    if ($checkbox_seleccionados > 0)
    {
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
  
  /**
   * Método que guarda un evento checked o seleccionado por el usuario
   * en la variable de sesion hist_eventos_sesion.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   * @return boolean
   */
  private function guardarEventoCheckedEnHist($evento_checked, $sesion)
  {
    // Busca los eventos ya almacenados en la variable de sesión correspondiente
    // si el identificador no esta definido aun, entonces devuelve un array()
    
    // hist_eventos_sesion
    $eventos_sesion = $this->getUser()->getAttribute($sesion, array());

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
}
