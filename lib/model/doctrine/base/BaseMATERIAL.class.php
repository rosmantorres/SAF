<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MATERIAL', 'schema_siod');

/**
 * BaseMATERIAL
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_material
 * @property string $desc_material
 * 
 * @method integer  getCodMaterial()   Returns the current record's "cod_material" value
 * @method string   getDescMaterial()  Returns the current record's "desc_material" value
 * @method MATERIAL setCodMaterial()   Sets the current record's "cod_material" value
 * @method MATERIAL setDescMaterial()  Sets the current record's "desc_material" value
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMATERIAL extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('MATERIAL');
        $this->hasColumn('cod_material', 'integer', 3, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 3,
             ));
        $this->hasColumn('desc_material', 'string', 50, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}