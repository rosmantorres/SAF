<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SAF_EVENTO_CONVOCATORIA', 'schema_saf');

/**
 * BaseSAF_EVENTO_CONVOCATORIA
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_evento
 * @property integer $id_convocatoria
 * @property SAF_EVENTO $SAF_EVENTO
 * @property SAF_CONVOCATORIA_CAF $SAF_CONVOCATORIA_CAF
 * 
 * @method integer                 getIdEvento()             Returns the current record's "id_evento" value
 * @method integer                 getIdConvocatoria()       Returns the current record's "id_convocatoria" value
 * @method SAF_EVENTO              getSAFEVENTO()            Returns the current record's "SAF_EVENTO" value
 * @method SAF_CONVOCATORIA_CAF    getSAFCONVOCATORIACAF()   Returns the current record's "SAF_CONVOCATORIA_CAF" value
 * @method SAF_EVENTO_CONVOCATORIA setIdEvento()             Sets the current record's "id_evento" value
 * @method SAF_EVENTO_CONVOCATORIA setIdConvocatoria()       Sets the current record's "id_convocatoria" value
 * @method SAF_EVENTO_CONVOCATORIA setSAFEVENTO()            Sets the current record's "SAF_EVENTO" value
 * @method SAF_EVENTO_CONVOCATORIA setSAFCONVOCATORIACAF()   Sets the current record's "SAF_CONVOCATORIA_CAF" value
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSAF_EVENTO_CONVOCATORIA extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SAF_EVENTO_CONVOCATORIA');
        $this->hasColumn('id_evento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('id_convocatoria', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('SAF_EVENTO', array(
             'local' => 'id_evento',
             'foreign' => 'id'));

        $this->hasOne('SAF_CONVOCATORIA_CAF', array(
             'local' => 'id_convocatoria',
             'foreign' => 'id'));
    }
}