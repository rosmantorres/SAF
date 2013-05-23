<?php

/**
 * CRONOLOGIA form base class.
 *
 * @method CRONOLOGIA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCRONOLOGIAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_f328'         => new sfWidgetFormInputHidden(),
      'fecha_reparacion' => new sfWidgetFormDateTime(),
      'resp_mesa_rep'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'num_f328'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('num_f328')), 'empty_value' => $this->getObject()->get('num_f328'), 'required' => false)),
      'fecha_reparacion' => new sfValidatorDateTime(),
      'resp_mesa_rep'    => new sfValidatorString(array('max_length' => 5)),
    ));

    $this->widgetSchema->setNameFormat('cronologia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CRONOLOGIA';
  }

}
