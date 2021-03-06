<?php

/**
 * SAF_CONVOCATORIA_CAFTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SAF_CONVOCATORIA_CAFTable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object SAF_CONVOCATORIA_CAFTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF');
  }

  /**
   * @return Doctrine_Colletion SAF_CONVOCATORIA_CAF
   */
  public function getConvocatorias()
  {
    return $this->createQuery('c')
            ->where('DEPARTAMENTO = ?', 'IOD')
            ->orderBy('created_at desc')
            ->execute();
  }

}