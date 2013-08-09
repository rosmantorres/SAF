<?php

/**
 * SAF_ASISTENCIATable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SAF_ASISTENCIATable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object SAF_ASISTENCIATable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('SAF_ASISTENCIA');
  }

  /**
   * Método que obtiene con PDO las unidades con sus respectivas asistencia (cant).
   * 
   * @return resultset
   */
  public function getIndicadorAsistencia()
  {
    $conexion = Doctrine_Manager::getInstance()->getConnection("schema_saf");

    $consulta = "
      SELECT SAF_RESULT.UNIDAD_EQUIPO AS UNIDAD_EQUIPO, COUNT (SAF_RESULT.UNIDAD_EQUIPO) AS ASISTENCIA
      FROM
        (
          SELECT conv.id AS CONVOCATORIA, ue.nombre AS UNIDAD_EQUIPO
          FROM SAF_CONVOCATORIA_CAF conv
          INNER JOIN SAF_ASISTENCIA asis ON conv.id = asis.id_convocatoria
          INNER JOIN SAF_PERSONAL pers ON asis.id_personal = pers.ci
          INNER JOIN SAF_UNIDAD_EQUIPO ue ON pers.id_ue = ue.id 
          WHERE ue.departamento = 'IOD'
          GROUP BY (conv.id, ue.nombre)
        ) SAF_RESULT
      GROUP BY SAF_RESULT.UNIDAD_EQUIPO ";

    $sentencia = $conexion->execute($consulta);

    return $sentencia->fetchAll(PDO::FETCH_BOTH);
  }

  /**
   * Método que toma todas las unidades del resulset retornandolas con coma (,)
   * para las categorias del gráfico (indicador) que se genera con HighCharts.
   * 
   * @param type $resultset
   * @return implode
   */
  public function getCategoriasDelIndicadorAsistencia($resultset)
  {
    $data = Array();
    foreach ($resultset as $value)
    {
      array_push($data, "'" . $value['UNIDAD_EQUIPO'] . "'");
    }
    return implode(',', $data);
  }

  /**
   * Método que toda la cantidad de asistencia de cada unidad retornandolas con
   * coma(,) para las series del gráfico (indicador) que se genera con HighCharts.
   * 
   * @param type $resultset
   * @return implode
   */
  public function getSeriesDelIndicadorAsistencia($resultset)
  {
    $data = Array();
    foreach ($resultset as $value)
    {
      array_push($data, $value['ASISTENCIA']);
    }
    return implode(',', $data);
  }

}