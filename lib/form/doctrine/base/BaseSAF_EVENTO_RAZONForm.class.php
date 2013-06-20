<?php

/**
 * SAF_EVENTO_RAZON form base class.
 *
 * @method SAF_EVENTO_RAZON getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_EVENTO_RAZONForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_evento' => new sfWidgetFormInputHidden(),
      'id_razon'  => new sfWidgetFormInputHidden(),
      'mva_min'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_evento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_evento')), 'empty_value' => $this->getObject()->get('id_evento'), 'required' => false)),
      'id_razon'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_razon')), 'empty_value' => $this->getObject()->get('id_razon'), 'required' => false)),
      'mva_min'   => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('saf_evento_razon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_EVENTO_RAZON';
  }

}
