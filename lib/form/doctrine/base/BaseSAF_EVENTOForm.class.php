<?php

/**
 * SAF_EVENTO form base class.
 *
 * @method SAF_EVENTO getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_EVENTOForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'descripcion'     => new sfWidgetFormTextarea(),
      'clasificado_en'  => new sfWidgetFormInputText(),
      'id_agenda'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'add_empty' => true)),
      'id_convocatoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => true)),
      'c_eveno_t'       => new sfWidgetFormInputText(),
      'c_evento_d'      => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'descripcion'     => new sfValidatorString(array('max_length' => 500)),
      'clasificado_en'  => new sfValidatorString(array('max_length' => 50)),
      'id_agenda'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'required' => false)),
      'id_convocatoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'required' => false)),
      'c_eveno_t'       => new sfValidatorInteger(array('required' => false)),
      'c_evento_d'      => new sfValidatorInteger(array('required' => false)),
      'status'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_EVENTO';
  }

}
