<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SAF_VARIO', 'schema_saf');

/**
 * BaseSAF_VARIO
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_evento
 * @property string $tipo
 * @property string $descripcion
 * @property timestamp $f_duracion_estimada
 * @property string $titulo
 * @property SAF_EVENTO $SAF_EVENTO
 * @property Doctrine_Collection $SAF_COMP_UE
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method integer             getIdEvento()            Returns the current record's "id_evento" value
 * @method string              getTipo()                Returns the current record's "tipo" value
 * @method string              getDescripcion()         Returns the current record's "descripcion" value
 * @method timestamp           getFDuracionEstimada()   Returns the current record's "f_duracion_estimada" value
 * @method string              getTitulo()              Returns the current record's "titulo" value
 * @method SAF_EVENTO          getSAFEVENTO()           Returns the current record's "SAF_EVENTO" value
 * @method Doctrine_Collection getSAFCOMPUE()           Returns the current record's "SAF_COMP_UE" collection
 * @method SAF_VARIO           setId()                  Sets the current record's "id" value
 * @method SAF_VARIO           setIdEvento()            Sets the current record's "id_evento" value
 * @method SAF_VARIO           setTipo()                Sets the current record's "tipo" value
 * @method SAF_VARIO           setDescripcion()         Sets the current record's "descripcion" value
 * @method SAF_VARIO           setFDuracionEstimada()   Sets the current record's "f_duracion_estimada" value
 * @method SAF_VARIO           setTitulo()              Sets the current record's "titulo" value
 * @method SAF_VARIO           setSAFEVENTO()           Sets the current record's "SAF_EVENTO" value
 * @method SAF_VARIO           setSAFCOMPUE()           Sets the current record's "SAF_COMP_UE" collection
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSAF_VARIO extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SAF_VARIO');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'sequence' => 'SAF_VARIO',
             ));
        $this->hasColumn('id_evento', 'integer', null, array(
             'notnull' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('tipo', 'string', 50, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('descripcion', 'string', 4000, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 4000,
             ));
        $this->hasColumn('f_duracion_estimada', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'length' => 7,
             ));
        $this->hasColumn('titulo', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('SAF_EVENTO', array(
             'local' => 'id_evento',
             'foreign' => 'id'));

        $this->hasMany('SAF_COMP_UE', array(
             'local' => 'id',
             'foreign' => 'id_compromiso'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}