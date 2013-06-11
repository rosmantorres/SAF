<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * Método que agrega en la sesion del usuario (hist_eventos_filtrados), todos 
   * los eventos que fueron arrojados por el sistema durando el filtro.
   * 
   * @param array $eventos_filtrados
   */  
  public function agregarEventosFiltradosAlHist($eventos_filtrados)
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
   * Método que verifica los eventos que fueron checked para ser agregados a la
   * agenda (hist_eventos_agenda) o a la convocatoria (hist_eventos_convocatoria)
   *
   * @param sfWebRequest $request  - petición del usuario sfWebRequest
   * @param string $sesion  - variable de sesion donde se quiere guardar los eventos
   * @return string  - Indica los eventos que fueron agregados
   */
  public function agregarEventosCheckedAlHist($request, $sesion)
  {
    $resultado = "";

    $hist_eventos_filtrados = $this->getAttribute('hist_eventos_filtrados', array());

    // Verifica cuales checkbox fueron seleccionados
    foreach ($hist_eventos_filtrados as $evento_filtrado)
    {
      // Se procesan los checkbox de la petición del formulario
      $checkbox = $request->getParameter($evento_filtrado->getCEventoD());

      if ($checkbox == true)
      {
        if ($this->agregarSiNoExiste($evento_filtrado, $sesion))
        {
          $resultado = $resultado . "<i class='icon-ok'></i> " . $evento_filtrado->getCEventoD() . "<br>";
        }
        else
        {
          $resultado = $resultado . "<i class='icon-remove'></i> " . $evento_filtrado->getCEventoD() . "<br>";
        }
      }
    }

    return $resultado;
  }

  /**
   * Método que verifica los eventos que fueron elegidos para ser guardados
   * directamente en la agenda o en la convocatoria, comparandolos con los que
   * estan en su hist de la sesion (hist_eventos_agenda o hist_eventos_convocatoria).
   * 
   * @param sfWebRequest $request
   * @param string $sesion
   * @return array
   */
  public function retornarEventosAGuardarEnAgendaConvocatoria($request, $sesion)
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

  /**
   * Método que agrega en la variable de sesion, un evento checked si el mismo
   * no existe en la sesion (para no repetirlo).
   * 
   * @param SAF_EVENTO $evento_checked - Evento a guardar
   * @param string $sesion - Donde se guardará
   * @return boolean - True si fue guardado
   */
  private function agregarSiNoExiste($evento_checked, $sesion)
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
}
