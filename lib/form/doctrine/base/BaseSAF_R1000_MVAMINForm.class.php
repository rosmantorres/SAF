<?php

/**
 * SAF_R1000_MVAMIN form base class.
 *
 * @method SAF_R1000_MVAMIN getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_R1000_MVAMINForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_evento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'add_empty' => false)),
      'razon'     => new sfWidgetFormInputText(),
      'valor'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_evento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'))),
      'razon'     => new sfValidatorString(array('max_length' => 50)),
      'valor'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('saf_r1000_mvamin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_R1000_MVAMIN';
  }

}
