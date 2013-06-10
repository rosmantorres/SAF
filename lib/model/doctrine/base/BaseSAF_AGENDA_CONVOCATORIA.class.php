<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SAF_AGENDA_CONVOCATORIA', 'schema_saf');

/**
 * BaseSAF_AGENDA_CONVOCATORIA
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $departamento
 * @property string $observacion
 * @property Doctrine_Collection $SAF_EVENTO
 * 
 * @method integer                 getId()           Returns the current record's "id" value
 * @method string                  getDepartamento() Returns the current record's "departamento" value
 * @method string                  getObservacion()  Returns the current record's "observacion" value
 * @method Doctrine_Collection     getSAFEVENTO()    Returns the current record's "SAF_EVENTO" collection
 * @method SAF_AGENDA_CONVOCATORIA setId()           Sets the current record's "id" value
 * @method SAF_AGENDA_CONVOCATORIA setDepartamento() Sets the current record's "departamento" value
 * @method SAF_AGENDA_CONVOCATORIA setObservacion()  Sets the current record's "observacion" value
 * @method SAF_AGENDA_CONVOCATORIA setSAFEVENTO()    Sets the current record's "SAF_EVENTO" collection
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSAF_AGENDA_CONVOCATORIA extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SAF_AGENDA_CONVOCATORIA');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'sequence' => 'SAF_AGENDA_CONVOCATORIA',
             ));
        $this->hasColumn('departamento', 'string', 50, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('observacion', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 1000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SAF_EVENTO', array(
             'local' => 'id',
             'foreign' => 'id_agenda'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}