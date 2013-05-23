<?php

/**
 * CRONOLOGIA filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCRONOLOGIAFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha_reparacion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'resp_mesa_rep'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'fecha_reparacion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'resp_mesa_rep'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cronologia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CRONOLOGIA';
  }

  public function getFields()
  {
    return array(
      'num_f328'         => 'Number',
      'fecha_reparacion' => 'Date',
      'resp_mesa_rep'    => 'Text',
    );
  }
}
