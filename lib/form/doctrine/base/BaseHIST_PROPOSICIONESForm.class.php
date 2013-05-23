<?php

/**
 * HIST_PROPOSICIONES form base class.
 *
 * @method HIST_PROPOSICIONES getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHIST_PROPOSICIONESForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'cod_proposicion'        => new sfWidgetFormInputText(),
      'oper_cod_operador_resp' => new sfWidgetFormInputText(),
      'oper_cod_operador_asig' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cod_proposicion'        => new sfValidatorInteger(),
      'oper_cod_operador_resp' => new sfValidatorInteger(),
      'oper_cod_operador_asig' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('hist_proposiciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HIST_PROPOSICIONES';
  }

}
