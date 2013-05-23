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
      'id'          => new sfWidgetFormInputHidden(),
      'id_agenda'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'add_empty' => false)),
      'asunto'      => new sfWidgetFormInputText(),
      'hora_ini'    => new sfWidgetFormDateTime(),
      'hora_fin'    => new sfWidgetFormDateTime(),
      'lugar'       => new sfWidgetFormInputText(),
      'observacion' => new sfWidgetFormTextarea(),
      'c_caf'       => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agenda'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'))),
      'asunto'      => new sfValidatorString(array('max_length' => 100)),
      'hora_ini'    => new sfValidatorDateTime(),
      'hora_fin'    => new sfValidatorDateTime(),
      'lugar'       => new sfValidatorString(array('max_length' => 100)),
      'observacion' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'c_caf'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
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
