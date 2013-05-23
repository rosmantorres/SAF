<?php

/**
 * OPERADORES form base class.
 *
 * @method OPERADORES getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOPERADORESForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cod_operador'  => new sfWidgetFormInputHidden(),
      'desc_operador' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cod_operador'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cod_operador')), 'empty_value' => $this->getObject()->get('cod_operador'), 'required' => false)),
      'desc_operador' => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('operadores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OPERADORES';
  }

}
