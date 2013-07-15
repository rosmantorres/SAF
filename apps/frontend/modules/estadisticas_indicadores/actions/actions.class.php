<?php

/**
 * estadisticas_indicadores actions.
 *
 * @package    Proyecto_SAF
 * @subpackage estadisticas_indicadores
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadisticas_indicadoresActions extends sfActions
{

  /**
   * Acción que manda a gráficar las estadisticas e indicadores correspondientes.
   */
  public function executeCharts()
  {
    $this->indicador =
            Doctrine_Core::getTable('SAF_ASISTENCIA')->getIndicadorAsistencia();

    $this->num_asistencias =
            $this->getCantidadDeAsistenciasHechas($this->indicador);

    $this->scala =
            $this->getScalaDelIndicadorDeAsistencia($this->num_asistencias);

    $this->unidades =
            Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findAll();
  }

  /**
   * Método que obtiene la cantidad de asistencias hechas hasta la fecha.
   * 
   * @param resultset $indicador_asistencia
   * @return int
   */
  private function getCantidadDeAsistenciasHechas($indicador_asistencia)
  {
    $cant_asistencias = 0;

    foreach ($indicador_asistencia as $indicador)
    {
      if ($cant_asistencias < $indicador['ASISTENCIA'])
      {
        $cant_asistencias = $indicador['ASISTENCIA'];
      }
    }
    return $cant_asistencias;
  }

  /**
   * Método que genera la scala según el número de asistencia para hacer la gráfica.
   * 
   * @param int $num_asistencias
   * @return int
   */
  private function getScalaDelIndicadorDeAsistencia($num_asistencias)
  {
    switch ($num_asistencias) {
      case $num_asistencias <= 8:
        $scala = 2;
        break;
      case $num_asistencias <= 16:
        $scala = 4;
        break;
      case $num_asistencias <= 24:
        $scala = 6;
        break;
      case $num_asistencias <= 32:
        $scala = 8;
        break;
      default:
        $scala = 10;
        break;
    }

    return $scala;
  }

}
