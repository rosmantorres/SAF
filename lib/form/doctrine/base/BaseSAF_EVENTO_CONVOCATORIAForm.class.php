<?php

/**
 * SAF_EVENTO_CONVOCATORIA form base class.
 *
 * @method SAF_EVENTO_CONVOCATORIA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_EVENTO_CONVOCATORIAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_evento'       => new sfWidgetFormInputHidden(),
      'id_convocatoria' => new sfWidgetFormInputHidden(),
      'status'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_evento'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_evento')), 'empty_value' => $this->getObject()->get('id_evento'), 'required' => false)),
      'id_convocatoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_convocatoria')), 'empty_value' => $this->getObject()->get('id_convocatoria'), 'required' => false)),
      'status'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_evento_convocatoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_EVENTO_CONVOCATORIA';
  }

}
