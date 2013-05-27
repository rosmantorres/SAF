<?php

/**
 * Description of Evento
 *
 * @author rt999
 */
class Evento
{

  /**
   * Método que crea un SAF_EVENTO con los valores encontrados en los modelos
   * INTERRUPCIONES, AVERIA, CRONOLOGIA y CRONOLOGIA_CUADRILLA_INT, correspondiente
   * al schema SIOD.
   * 
   * @param INTERRUPCIONES $interrupcion Misma documentacion BaseINTERRUPCIONES.class.php
   * @return SAF_EVENTO
   */
  public function crearEvento($interrupcion)
  {
    $mi_averia = Doctrine_Core::getTable('AVERIA')
            ->find($interrupcion->getNumAveria());

    $mi_cronologia = Doctrine_Core::getTable('CRONOLOGIA')
            ->find($interrupcion->getNumF328());

    $mi_cronologia_cuadrilla_int = Doctrine_Core::getTable('CRONOLOGIA_CUADRILLA_INT')
            ->getCuadrilla($interrupcion->getNumF328());

    $mi_circuito = Doctrine_Core::getTable('CIRCUITOS')
            ->find($interrupcion->getCodSistema());

    $evento = new SAF_EVENTO();

    $evento->setCEventoD($interrupcion->getNumF328());
    $evento->setFHoraIni($interrupcion->getFechaHoraIni());
    $evento->setRegion($this->getRegion($interrupcion->getDistrito()));
    $evento->setCircuito($mi_circuito->getDescCto());
    $evento->setCodNivel($interrupcion->getNivelSistema());
    $evento->setKvaInt($interrupcion->getKvaInterrump());
    $evento->setMvaMin($interrupcion->getMvamin());
    $evento->setNumAveria($interrupcion->getNumAveria());
    $evento->setDescAveria($mi_averia->getDescripcion());
    $evento->setTipoFalla($interrupcion->getCodCausa());
    $evento->setClimatologia($interrupcion->getClimatologia());
    $evento->setTrabajoRealizado($interrupcion->getTrabajoRealizado());
    $evento->setNumRoe($interrupcion->getNumRoe());

    if ($mi_cronologia) {
      $evento->setFHoraRep($mi_cronologia->getFechaReparacion());
      $evento->setOperador($mi_cronologia->getRespMesaRep());
    }

    if ($mi_cronologia_cuadrilla_int) {
      $evento->setCuadrilla($mi_cronologia_cuadrilla_int->getCodCuadCont());
    }

    //$evento->setProgramador() = ;
    //$evento->setOperadorResp() = ;
    
    return $evento;
  }

  /**
   * Método que retorna el nombre de la region segun su id del distrito.
   * 
   * @param Integer $num_distrito Disrito que aparece en la Interrupcion
   * @return string
   */
  public function getRegion($num_distrito)
  {
    $region = '';
    
    switch ($num_distrito) {
      case 1: 
        $region = 'Este';        
        break;
      case 2:
        $region = 'Oeste';        
        break;
      case 3:
        $region = 'Vargas';        
        break;
      case 4:
        $region = 'Los Teques';        
        break;
      case 5:
        $region = 'Guarenas-Guatire';        
        break;
      case 7:
        $region = 'Centro';        
        break;
      default:
        break;
    }
    
    return $region;
  }

}

