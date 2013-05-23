<?php

/**
 * HIST_PROPOSICIONES filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHIST_PROPOSICIONESFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cod_proposicion'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'oper_cod_operador_resp' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'oper_cod_operador_asig' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'cod_proposicion'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'oper_cod_operador_resp' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'oper_cod_operador_asig' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('hist_proposiciones_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HIST_PROPOSICIONES';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'cod_proposicion'        => 'Number',
      'oper_cod_operador_resp' => 'Number',
      'oper_cod_operador_asig' => 'Number',
    );
  }
}
