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
      'cod_proposicion'        => new sfWidgetFormInputHidden(),
      'oper_cod_operador_resp' => new sfWidgetFormInputText(),
      'oper_cod_operador_asig' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cod_proposicion'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cod_proposicion')), 'empty_value' => $this->getObject()->get('cod_proposicion'), 'required' => false)),
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
