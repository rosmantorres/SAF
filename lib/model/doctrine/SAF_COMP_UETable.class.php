<?php

/**
 * SAF_COMP_UETable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SAF_COMP_UETable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object SAF_COMP_UETable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('SAF_COMP_UE');
  }

  /**
   * Método que obtiene con PDO todos los compromisos pendientes o terminados 
   * para una determinada unidad.
   * 
   * @param int $id_unidad
   * @param string $status
   * @return resultset
   */
  public function getIndicadorDeCompromisos($id_unidad, $status)
  {
    $conexion = Doctrine_Manager::getInstance()->getConnection("schema_saf");
    
    $consulta = "
      SELECT comp_ue.status AS STATUS, COUNT (comp_ue.status) AS CANT_COMPROMISO
      FROM SAF_COMP_UE comp_ue    
      WHERE comp_ue.id_ue = '$id_unidad' AND comp_ue.status = '$status'
      GROUP BY comp_ue.status";

    $sentencia = $conexion->execute($consulta);

    return $sentencia->fetchAll(PDO::FETCH_BOTH);
  }

  /**
   * Método que toma todas las unidades retornandolas con coma (,)
   * para las categorias del gráfico (indicador) que se genera con HighCharts.
   * 
   * @param Doctrine_Collection SAF_UNIDAD_EQUIPO $unidades
   * @return implode
   */
  public function getCategoriasDelIndicadorDeCompromisos($unidades)
  {
    $data = Array();
    foreach ($unidades as $unidad)
    {
      array_push($data, "'" . $unidad . "'");
    }
    return implode(',', $data);
  }

  /**
   * Método que toma todos los compromisos (cant) adquiridos por las unidades 
   * según el status que se desee, retornandolos con coma (,). 
   * 
   * @param Doctrine_Collection SAF_UNIDAD_EQUIPO $unidades
   * @param string $status
   * @return implode
   */
  public function getSeriesDelIndicadorDeCompromisos($unidades, $status)
  {
    $data_series = array();

    foreach ($unidades as $unidad)
    {
      $resultset = $this->getIndicadorDeCompromisos($unidad->getId(), $status);

      if ($resultset)
      {
        array_push($data_series, $resultset[0]['CANT_COMPROMISO']);
      }
      else
      {
        array_push($data_series, 0);
      }
    }

    return implode(',', $data_series);
  }

  /**
   * Método que obtiene todos los compromisos de una unidad detallados, incluyendo
   * un anexo a la consulta sobre el status del compromiso por ejempo.
   * 
   * @param int $id_unidad
   * @param string $agregar_a_consulta
   * @return resultset
   */
  public function getCompromisosDetalladosDeLaUnidad($id_unidad, $agregar_a_consulta)
  {
    $conexion = Doctrine_Manager::getInstance()->getConnection("schema_saf");
    
    $consulta = "
      SELECT 
        ue.nombre AS NOMBRE_UE,
        comp.descripcion AS DESC_COMP,
        comp.created_at AS F_COMP,
        comp.f_duracion_estimada AS F_DURACION_EST,
        comp_ue.id AS ID_COMP,
        comp_ue.status AS STATUS_COMP,
        comp_ue.acciones AS ACCIONES,
        minuta.cod_min AS COD_MIN,
        minuta.created_at AS F_MINUTA,
        evento.c_evento_d AS RI,
        evento.circuito AS CIRCUITO,
        evento.f_hora_ini AS FECHA_CASO
      FROM SAF_COMP_UE comp_ue
      INNER JOIN SAF_UNIDAD_EQUIPO ue ON ue.id = comp_ue.id_ue
      INNER JOIN SAF_VARIO comp ON comp.id = comp_ue.id_compromiso
      INNER JOIN SAF_EVENTO evento ON evento.id = comp.id_evento
      INNER JOIN SAF_CONVOCATORIA_CAF conv_caf ON conv_caf.id = evento.id_convocatoria
      INNER JOIN SAF_MINUTA minuta ON minuta.id_convocatoria = conv_caf.id
      WHERE comp.tipo = 'COMPROMISO' AND comp_ue.id_ue = $id_unidad AND minuta.id_convocatoria = evento.id_convocatoria
      ";
    
    $consulta = $consulta . $agregar_a_consulta;

    $sentencia = $conexion->execute($consulta);

    return $sentencia->fetchAll(PDO::FETCH_BOTH);
  }

}