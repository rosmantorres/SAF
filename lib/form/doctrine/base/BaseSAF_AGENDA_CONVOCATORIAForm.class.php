<?php

/**
 * SAF_AGENDA_CONVOCATORIA form base class.
 *
 * @method SAF_AGENDA_CONVOCATORIA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_AGENDA_CONVOCATORIAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'departamento'      => new sfWidgetFormInputText(),
      'f_inicio_consulta' => new sfWidgetFormDateTime(),
      'f_fin_consulta'    => new sfWidgetFormDateTime(),
      'observacion'       => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'departamento'      => new sfValidatorString(array('max_length' => 50)),
      'f_inicio_consulta' => new sfValidatorDateTime(),
      'f_fin_consulta'    => new sfValidatorDateTime(),
      'observacion'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('saf_agenda_convocatoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_AGENDA_CONVOCATORIA';
  }

}
