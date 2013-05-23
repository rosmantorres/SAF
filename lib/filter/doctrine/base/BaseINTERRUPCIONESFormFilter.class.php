<?php

/**
 * INTERRUPCIONES filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseINTERRUPCIONESFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nivel_sistema'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cod_sistema'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_hora_ini'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'kva_interrump'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mvamin'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cod_causa'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'distrito'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_proposicion'   => new sfWidgetFormFilterInput(),
      'trabajo_realizado' => new sfWidgetFormFilterInput(),
      'climatologia'      => new sfWidgetFormFilterInput(),
      'num_roe'           => new sfWidgetFormFilterInput(),
      'num_averia'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nivel_sistema'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cod_sistema'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_hora_ini'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'kva_interrump'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mvamin'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cod_causa'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'distrito'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_proposicion'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trabajo_realizado' => new sfValidatorPass(array('required' => false)),
      'climatologia'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_roe'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_averia'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('interrupciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'INTERRUPCIONES';
  }

  public function getFields()
  {
    return array(
      'num_f328'          => 'Number',
      'nivel_sistema'     => 'Number',
      'cod_sistema'       => 'Number',
      'fecha_hora_ini'    => 'Date',
      'kva_interrump'     => 'Number',
      'mvamin'            => 'Number',
      'cod_causa'         => 'Number',
      'distrito'          => 'Number',
      'num_proposicion'   => 'Number',
      'trabajo_realizado' => 'Text',
      'climatologia'      => 'Number',
      'num_roe'           => 'Number',
      'num_averia'        => 'Number',
    );
  }
}
