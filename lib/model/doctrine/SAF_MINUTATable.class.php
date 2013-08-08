<?php

/**
 * SAF_MINUTATable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SAF_MINUTATable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SAF_MINUTATable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SAF_MINUTA');
    }
    
    /**
     * Misma definición del método sobrescrito (findAll). Solo se le agregó el 
     * order by y que solo traiga los pertenecientes a un departamento.
     */
    public function findAll($hydrationMode = null)
    {
      return $this->createQuery('dctrn_find minuta')
              ->innerJoin('minuta.SAF_CONVOCATORIA_CAF convocatoria')
              ->where('convocatoria.departamento = ?', 'IOD')
              ->orderBy('created_at desc')
              ->execute(array(), $hydrationMode);
    }
}