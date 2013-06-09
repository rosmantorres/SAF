<?php

/**
 * SAF_AGENDA_CONVOCATORIATable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SAF_AGENDA_CONVOCATORIATable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object SAF_AGENDA_CONVOCATORIATable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA');
  }

  /**
   * @return Doctrine_Collection SAF_AGENDA_CONVOCATORIA
   */
  public function getAgendas()
  {
    // $this = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')
    return $this->createQuery('a')->orderBy('created_at desc')->execute();
  }

}