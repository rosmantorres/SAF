<?php

/**
 * SAF_ASISTENCIA form base class.
 *
 * @method SAF_ASISTENCIA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_ASISTENCIAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_convocatoria' => new sfWidgetFormInputHidden(),
      'id_personal'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_convocatoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_convocatoria')), 'empty_value' => $this->getObject()->get('id_convocatoria'), 'required' => false)),
      'id_personal'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_personal')), 'empty_value' => $this->getObject()->get('id_personal'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_asistencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_ASISTENCIA';
  }

}
