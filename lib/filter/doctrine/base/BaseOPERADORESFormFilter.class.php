<?php

/**
 * OPERADORES filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOPERADORESFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'desc_operador' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'desc_operador' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('operadores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OPERADORES';
  }

  public function getFields()
  {
    return array(
      'cod_operador'  => 'Number',
      'desc_operador' => 'Text',
    );
  }
}
