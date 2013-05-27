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
    $evento->setTipoFalla($this->getTipoFalla($interrupcion->getCodCausa()));
    $evento->setClimatologia($this->getClimatologia($interrupcion->getClimatologia()));
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
   * @param integer $num_distrito Disrito que aparece en la Interrupcion
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

  /**
   * Método que retorna el tipo de falla segun su cod de cuasa de la interrupción
   * 
   * @param integer $cod_cuasa El cod_cuasa de la interrupcion
   * @return string
   */
  public function getTipoFalla($cod_cuasa)
  {
    $tipo_falla = 'IMPREVISTA';
    
    switch ($cod_cuasa) {
      case ($cod_cuasa >=900 and $cod_cuasa <= 903):
        $tipo_falla = 'PROGRAMADA';
        break;
      default:        
        break;
    }
    
    return $tipo_falla;
  }
  
  /**
   * Método que retorna la climatologia segun el cod_clima de la interrupcion
   * 
   * @param integer $cod_clima
   * @return string
   */
  public function getClimatologia($cod_clima)
  {
    $climatologia = '';
    
    switch ($cod_clima) {
      case 1:
        $climatologia = 'Seco';
        break;
      case 2:
        $climatologia = 'Lluvia';
        break;
      case 3:
        $climatologia = 'Tormenta - Viento fuerte';
        break;
      case 4:
        $climatologia = 'Neblina';
        break;
      default:
        break;
    }
    
    return $climatologia;
  }

}

