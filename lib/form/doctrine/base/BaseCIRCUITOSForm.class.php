<?php

/**
 * CIRCUITOS form base class.
 *
 * @method CIRCUITOS getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCIRCUITOSForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cod_cto'       => new sfWidgetFormInputHidden(),
      'bar_cod_barra' => new sfWidgetFormInputText(),
      'desc_cto'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cod_cto'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cod_cto')), 'empty_value' => $this->getObject()->get('cod_cto'), 'required' => false)),
      'bar_cod_barra' => new sfValidatorInteger(),
      'desc_cto'      => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('circuitos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CIRCUITOS';
  }

}
