<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CRONOLOGIA_CUADRILLA_INT', 'schema_siod');

/**
 * BaseCRONOLOGIA_CUADRILLA_INT
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $num_f328
 * @property string $cod_cuad_cont
 * 
 * @method integer                  getNumF328()       Returns the current record's "num_f328" value
 * @method string                   getCodCuadCont()   Returns the current record's "cod_cuad_cont" value
 * @method CRONOLOGIA_CUADRILLA_INT setNumF328()       Sets the current record's "num_f328" value
 * @method CRONOLOGIA_CUADRILLA_INT setCodCuadCont()   Sets the current record's "cod_cuad_cont" value
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCRONOLOGIA_CUADRILLA_INT extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('CRONOLOGIA_CUADRILLA_INT');
        $this->hasColumn('num_f328', 'integer', 7, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 7,
             ));
        $this->hasColumn('cod_cuad_cont', 'string', 11, array(
             'type' => 'string',
             'primary' => true,
             'length' => 11,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}