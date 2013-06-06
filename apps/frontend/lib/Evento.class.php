<?php

/**
 * Description of Evento
 *
 * @author rt999
 */
class Evento
{

  private $_interrupcion;
  private $_evento;

  /**
   * Método que retorna el tipo de falla segun su cod de cuasa de la interrupción
   * 
   * @param integer $cod_cuasa El cod_cuasa de la interrupcion
   * @return string
   */
  public static function getTipoFalla($cod_causa)
  {
    $tipo_falla = '';

    switch ($cod_causa) {
      case ($cod_causa >= 900):
        $tipo_falla = 'PROGRAMADA';
        break;
      case ($cod_causa >= 500 && $cod_causa <= 599):
        $tipo_falla = 'CAUSA-500';
        break;
      default:
        $tipo_falla = 'IMPREVISTA';
        break;
    }

    return $tipo_falla;
  }
  
  /**
   * Método que retorna un objeto del modelo SAF_EVENTO con sus valores ya seteados
   * 
   * @param INTERRUPCIONES $interrupcion Misma documentacion BaseINTERRUPCIONES.class.php
   * @return SAF_EVENTO
   */
  public function crearEvento($interrupcion)
  {
    $this->inicializar($interrupcion);

    $this->setEventoFtInterrupcion();
    $this->setEventoFtAveria();
    $this->setEventoFtCronologias();
    $this->setEventoFtCircuito();
    $this->setEventoFtOperadores();

    return $this->_evento;
  }

  /**
   * Método que inicializa las variables privada de la clase Evento
   * 
   * @param INTERRUPCIONES $interrupcion
   */
  private function inicializar($interrupcion)
  {
    $this->_evento = new SAF_EVENTO();
    $this->_interrupcion = $interrupcion;
  }

  /**
   * Método que setea al objeto SAF_EVENTO con los valores de la interrupcion.
   */
  private function setEventoFtInterrupcion()
  {
    $this->_evento->setCEventoD($this->_interrupcion->getNumF328());
    $this->_evento->setFHoraIni($this->_interrupcion->getFechaHoraIni());
    $this->_evento->setRegion($this->getRegion($this->_interrupcion->getDistrito()));
    $this->_evento->setCodNivel($this->_interrupcion->getNivelSistema());
    $this->_evento->setKvaInt($this->_interrupcion->getKvaInterrump());
    $this->_evento->setMvaMin($this->_interrupcion->getMvamin());
    $this->_evento->setNumAveria($this->_interrupcion->getNumAveria());
    $this->_evento->setTipoFalla($this->getTipoFalla($this->_interrupcion->getCodCausa()));
    $this->_evento->setClimatologia($this->getClimatologia($this->_interrupcion->getClimatologia()));
    $this->_evento->setTrabajoRealizado($this->_interrupcion->getTrabajoRealizado());
    $this->_evento->setNumRoe($this->_interrupcion->getNumRoe());
  }

  /**
   * Método que setea al objeto SAF_EVENTO con los valores de la averia, sí esta existe.
   */
  private function setEventoFtAveria()
  {
    $averia = Doctrine_Core::getTable('AVERIA')
            ->find($this->_interrupcion->getNumAveria());

    if ($averia)
    {
      $this->_evento->setDescAveria($averia->getDescripcion());
    }
  }

  /**
   * Método que setea al objeto SAF_EVENTO con los valores de la cronologia 
   * y cronologia_cuadrilla_int, sí los mismos existen
   */
  private function setEventoFtCronologias()
  {
    $cronologia = Doctrine_Core::getTable('CRONOLOGIA')
            ->find($this->_interrupcion->getNumF328());

    $cronologia_cuadrilla = Doctrine_Core::getTable('CRONOLOGIA_CUADRILLA_INT')
            ->getCuadrilla($this->_interrupcion->getNumF328());

    if ($cronologia)
    {
      $this->_evento->setFHoraRep($cronologia->getFechaReparacion());
      $this->_evento->setOperador($cronologia->getRespMesaRep());
    }

    if ($cronologia_cuadrilla)
    {
      $this->_evento->setCuadrilla($cronologia_cuadrilla->getCodCuadCont());
    }
  }

  /**
   * Método que setea al objeto SAF_EVENTO con los valores del circuito sí existe.
   */
  private function setEventoFtCircuito()
  {
    $circuito = Doctrine_Core::getTable('CIRCUITOS')
            ->find($this->_interrupcion->getCodSistema());

    if ($circuito)
    {
      $this->_evento->setCircuito($circuito->getDescCto());
    }
  }

  /**
   * Método que setea al objeto SAF_EVENTO con los valores de los operadores, sí 
   * el tipo de interrupcion es programada y si tiene número de proposición.
   */
  private function setEventoFtOperadores()
  {
    if ($this->getTipoFalla($this->_interrupcion->getCodCausa()) == 'PROGRAMADA')
    {
      if ($this->_interrupcion->getNumProposicion() > 0)
      {
        $operadores = Doctrine_Core::getTable('OPERADORES')
                ->getOperadores($this->_interrupcion->getNumProposicion());

        if ($operadores)
        {
          $this->_evento->setProgramador($operadores[0]->getDescOperador());
          $this->_evento->setOperadorResp($operadores[1]->getDescOperador());
        }
      }
    }
  }

  /**
   * Método que retorna el nombre de la region segun su id del distrito.
   * 
   * @param integer $num_distrito Disrito que aparece en la Interrupcion
   * @return string
   */
  private function getRegion($num_distrito)
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
   * Método que retorna la climatologia segun el cod_clima de la interrupcion
   * 
   * @param integer $cod_clima
   * @return string
   */
  private function getClimatologia($cod_clima)
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

