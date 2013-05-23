<?php

/**
 * AVERIA form base class.
 *
 * @method AVERIA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAVERIAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_averia'  => new sfWidgetFormInputHidden(),
      'descripcion' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'num_averia'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('num_averia')), 'empty_value' => $this->getObject()->get('num_averia'), 'required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('averia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AVERIA';
  }

}
