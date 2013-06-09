<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('SAF_CONVOCATORIA_CAF', 'schema_saf');

/**
 * BaseSAF_CONVOCATORIA_CAF
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agenda
 * @property string $asunto
 * @property timestamp $fecha
 * @property timestamp $hora_ini
 * @property timestamp $hora_fin
 * @property string $lugar
 * @property string $status
 * @property string $motivo_suspencion
 * @property string $observacion
 * @property string $c_caf
 * @property SAF_AGENDA_CONVOCATORIA $SAF_AGENDA_CONVOCATORIA
 * @property Doctrine_Collection $SAF_EVENTO
 * @property Doctrine_Collection $SAF_FOTO
 * @property Doctrine_Collection $SAF_ASISTENCIA
 * 
 * @method integer                 getId()                      Returns the current record's "id" value
 * @method integer                 getIdAgenda()                Returns the current record's "id_agenda" value
 * @method string                  getAsunto()                  Returns the current record's "asunto" value
 * @method timestamp               getFecha()                   Returns the current record's "fecha" value
 * @method timestamp               getHoraIni()                 Returns the current record's "hora_ini" value
 * @method timestamp               getHoraFin()                 Returns the current record's "hora_fin" value
 * @method string                  getLugar()                   Returns the current record's "lugar" value
 * @method string                  getStatus()                  Returns the current record's "status" value
 * @method string                  getMotivoSuspencion()        Returns the current record's "motivo_suspencion" value
 * @method string                  getObservacion()             Returns the current record's "observacion" value
 * @method string                  getCCaf()                    Returns the current record's "c_caf" value
 * @method SAF_AGENDA_CONVOCATORIA getSAFAGENDACONVOCATORIA()   Returns the current record's "SAF_AGENDA_CONVOCATORIA" value
 * @method Doctrine_Collection     getSAFEVENTO()               Returns the current record's "SAF_EVENTO" collection
 * @method Doctrine_Collection     getSAFFOTO()                 Returns the current record's "SAF_FOTO" collection
 * @method Doctrine_Collection     getSAFASISTENCIA()           Returns the current record's "SAF_ASISTENCIA" collection
 * @method SAF_CONVOCATORIA_CAF    setId()                      Sets the current record's "id" value
 * @method SAF_CONVOCATORIA_CAF    setIdAgenda()                Sets the current record's "id_agenda" value
 * @method SAF_CONVOCATORIA_CAF    setAsunto()                  Sets the current record's "asunto" value
 * @method SAF_CONVOCATORIA_CAF    setFecha()                   Sets the current record's "fecha" value
 * @method SAF_CONVOCATORIA_CAF    setHoraIni()                 Sets the current record's "hora_ini" value
 * @method SAF_CONVOCATORIA_CAF    setHoraFin()                 Sets the current record's "hora_fin" value
 * @method SAF_CONVOCATORIA_CAF    setLugar()                   Sets the current record's "lugar" value
 * @method SAF_CONVOCATORIA_CAF    setStatus()                  Sets the current record's "status" value
 * @method SAF_CONVOCATORIA_CAF    setMotivoSuspencion()        Sets the current record's "motivo_suspencion" value
 * @method SAF_CONVOCATORIA_CAF    setObservacion()             Sets the current record's "observacion" value
 * @method SAF_CONVOCATORIA_CAF    setCCaf()                    Sets the current record's "c_caf" value
 * @method SAF_CONVOCATORIA_CAF    setSAFAGENDACONVOCATORIA()   Sets the current record's "SAF_AGENDA_CONVOCATORIA" value
 * @method SAF_CONVOCATORIA_CAF    setSAFEVENTO()               Sets the current record's "SAF_EVENTO" collection
 * @method SAF_CONVOCATORIA_CAF    setSAFFOTO()                 Sets the current record's "SAF_FOTO" collection
 * @method SAF_CONVOCATORIA_CAF    setSAFASISTENCIA()           Sets the current record's "SAF_ASISTENCIA" collection
 * 
 * @package    Proyecto_SAF
 * @subpackage model
 * @author     Rosman_Torres
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSAF_CONVOCATORIA_CAF extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('SAF_CONVOCATORIA_CAF');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'sequence' => 'SAF_CONVOCATORIA_CAF',
             ));
        $this->hasColumn('id_agenda', 'integer', null, array(
             'notnull' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('asunto', 'string', 100, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('fecha', 'timestamp', 7, array(
             'notnull' => true,
             'type' => 'timestamp',
             'length' => 7,
             ));
        $this->hasColumn('hora_ini', 'timestamp', 7, array(
             'notnull' => true,
             'type' => 'timestamp',
             'length' => 7,
             ));
        $this->hasColumn('hora_fin', 'timestamp', 7, array(
             'notnull' => true,
             'type' => 'timestamp',
             'length' => 7,
             ));
        $this->hasColumn('lugar', 'string', 100, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('status', 'string', 50, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('motivo_suspencion', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('observacion', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('c_caf', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('SAF_AGENDA_CONVOCATORIA', array(
             'local' => 'id_agenda',
             'foreign' => 'id'));

        $this->hasMany('SAF_EVENTO', array(
             'local' => 'id',
             'foreign' => 'id_convocatoria'));

        $this->hasMany('SAF_FOTO', array(
             'local' => 'id',
             'foreign' => 'id_convocatoria'));

        $this->hasMany('SAF_ASISTENCIA', array(
             'local' => 'id',
             'foreign' => 'id_convocatoria'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}