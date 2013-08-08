<?php

/**
 * SAF_CONVOCATORIA_CAF form base class.
 *
 * @method SAF_CONVOCATORIA_CAF getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_CONVOCATORIA_CAFForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'departamento'      => new sfWidgetFormInputText(),
      'asunto'            => new sfWidgetFormInputText(),
      'fecha'             => new sfWidgetFormDateTime(),
      'hora_ini'          => new sfWidgetFormInputText(),
      'hora_fin'          => new sfWidgetFormInputText(),
      'lugar'             => new sfWidgetFormInputText(),
      'status'            => new sfWidgetFormInputText(),
      'motivo_suspencion' => new sfWidgetFormTextarea(),
      'observacion'       => new sfWidgetFormTextarea(),
      'c_caf'             => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'departamento'      => new sfValidatorString(array('max_length' => 10)),
      'asunto'            => new sfValidatorString(array('max_length' => 100)),
      'fecha'             => new sfValidatorDateTime(),
      'hora_ini'          => new sfValidatorString(array('max_length' => 7)),
      'hora_fin'          => new sfValidatorString(array('max_length' => 7)),
      'lugar'             => new sfValidatorString(array('max_length' => 100)),
      'status'            => new sfValidatorString(array('max_length' => 50)),
      'motivo_suspencion' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'observacion'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'c_caf'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('saf_convocatoria_caf[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_CONVOCATORIA_CAF';
  }

}
