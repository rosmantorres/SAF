<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SAF_RAZON_MVAMIN', 'schema_saf');

/**
 * BaseSAF_RAZON_MVAMIN
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $razon
 * @property Doctrine_Collection $SAF_EVENTO_RAZON
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getRazon()            Returns the current record's "razon" value
 * @method Doctrine_Collection getSAFEVENTORAZON()   Returns the current record's "SAF_EVENTO_RAZON" collection
 * @method SAF_RAZON_MVAMIN    setId()               Sets the current record's "id" value
 * @method SAF_RAZON_MVAMIN    setRazon()            Sets the current record's "razon" value
 * @method SAF_RAZON_MVAMIN    setSAFEVENTORAZON()   Sets the current record's "SAF_EVENTO_RAZON" collection
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSAF_RAZON_MVAMIN extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SAF_RAZON_MVAMIN');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'sequence' => 'SAF_RAZON_MVAMIN',
             ));
        $this->hasColumn('razon', 'string', 50, array(
             'notnull' => true,
             'type' => 'string',
             'unique' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SAF_EVENTO_RAZON', array(
             'local' => 'id',
             'foreign' => 'id_razon'));
    }
}