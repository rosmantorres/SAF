<?php

/**
 * SAF_VARIO
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class SAF_VARIO extends BaseSAF_VARIO
{
  public function getResponsables()
  {
    return Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')
            ->createQuery('ue')
            ->innerJoin('ue.SAF_COMP_UE cue')
            ->where('cue.id_compromiso = ?', $this->getId())
            ->execute();
  }
}