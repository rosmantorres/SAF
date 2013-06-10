<?php

/**
 * SAF_CONVOCATORIA_CAF filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_CONVOCATORIA_CAFFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'asunto'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_ini'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_fin'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lugar'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'motivo_suspencion' => new sfWidgetFormFilterInput(),
      'observacion'       => new sfWidgetFormFilterInput(),
      'c_caf'             => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'asunto'            => new sfValidatorPass(array('required' => false)),
      'fecha'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'hora_ini'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'hora_fin'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'lugar'             => new sfValidatorPass(array('required' => false)),
      'status'            => new sfValidatorPass(array('required' => false)),
      'motivo_suspencion' => new sfValidatorPass(array('required' => false)),
      'observacion'       => new sfValidatorPass(array('required' => false)),
      'c_caf'             => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('saf_convocatoria_caf_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_CONVOCATORIA_CAF';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'asunto'            => 'Text',
      'fecha'             => 'Date',
      'hora_ini'          => 'Date',
      'hora_fin'          => 'Date',
      'lugar'             => 'Text',
      'status'            => 'Text',
      'motivo_suspencion' => 'Text',
      'observacion'       => 'Text',
      'c_caf'             => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
