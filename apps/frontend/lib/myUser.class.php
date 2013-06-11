<?php

class myUser extends sfBasicSecurityUser
{
 
  /**
   * Método que guarda en hist_eventos_filtrados de la sesion del usuario, 
   * aquellos eventos que fueron encontrados por la accion filtrar del modulo de
   * agenda_convocatoria y por la accion xxxxx de convocatoria.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   */
  public function guardarHistEventosFiltrados($eventos_filtrados)
  {        
    // Busca los eventos ya almacenados en la variable de sesion correspondiente.
    // si el identificador no esta definido aun, entonces se setea con un array()
    $eventos = $this->getAttribute('hist_eventos_filtrados', array());

    foreach ($eventos_filtrados as $evento_filtrado)
    {
      array_push($eventos, $evento_filtrado);
    }

    // Almacena el nuevo historial a la sesion del usuario
    $this->setAttribute('hist_eventos_filtrados', $eventos);
  }
  
  /**
   * Acción que verifica cuales eventos fueron seleccionados despues del filtro 
   * (busqueda) para agregarlos a la variable de sesion hist_eventos_sesion
   * 
   * @param sfWebRequest $request
   * @return $this->renderText() No tiene vista asociada
   */
  public function agregarEventosAMiSesion($request, $sesion)
  {
    $decir = "";        
    $checkbox_seleccionados = 0;
    $hist_eventos_filtrados = $this->getAttribute('hist_eventos_filtrados', array());

    // Verifica cuales checkbox fueron seleccionados
    foreach ($hist_eventos_filtrados as $evento_filtrado)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox = $request->getParameter($evento_filtrado->getCEventoD());

      if ($checkbox == true)
      {
        $checkbox_seleccionados = $checkbox_seleccionados + 1;
        
        if ($this->guardarEventoCheckedEnHist($evento_filtrado, $sesion))
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
      return "<div class='alert alert-info'><strong><u>Eventos agregados a la
        agenda:</u></strong><br>Leyenda: <i class='icon-remove'></i> Ya existía
        <i class='icon-ok'></i> Agregado<br><br>" . $decir . "</div>";
    }
    else
    {
      return "<i class='icon-ban-circle'></i> No se seleccionaron eventos para guardar en la agenda";
    }
  }
  
  /**
   * Método que guarda un evento checked o seleccionado por el usuario
   * en la variable de sesion hist_eventos_sesion.
   * 
   * @param array SAF_EVENTOS $eventos_filtrados
   * @return boolean
   */
  public function guardarEventoCheckedEnHist($evento_checked, $sesion)
  {
    // Busca los eventos ya almacenados en la variable de sesión correspondiente
    // si el identificador no esta definido aun, entonces devuelve un array()
    
    $eventos_sesion = $this->getAttribute($sesion, array());

    // Se verifica si el evento_checked no esta en la variable de sesión.
    foreach ($eventos_sesion as $evento_sesion)
    {
      if ($evento_sesion->getCEventoD() == $evento_checked->getCEventoD())
      {
        return false;
      }
    }

    array_push($eventos_sesion, $evento_checked);
    $this->setAttribute($sesion, $eventos_sesion);

    return true;
  }
  
  public function confirmarEventosChecked($request, $sesion)
  {
    $eventos_a_guardar = array();
    
    $eventos_sesion = $this->getAttribute($sesion, array());
    
    foreach ($eventos_sesion as $evento_sesion)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox_name = $request->getParameter($evento_sesion->getCEventoD());

      if ($checkbox_name == true)
      {
        array_push($eventos_a_guardar, $evento_sesion);
      }
    }
    
    return $eventos_a_guardar;
  }
  
}
