<?php

/**
 * SAF_VARIO form base class.
 *
 * @method SAF_VARIO getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_VARIOForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'id_evento'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'add_empty' => false)),
      'tipo'                => new sfWidgetFormInputText(),
      'descripcion'         => new sfWidgetFormTextarea(),
      'f_duracion_estimada' => new sfWidgetFormDateTime(),
      'titulo'              => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_evento'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'))),
      'tipo'                => new sfValidatorString(array('max_length' => 50)),
      'descripcion'         => new sfValidatorString(array('max_length' => 4000)),
      'f_duracion_estimada' => new sfValidatorDateTime(array('required' => false)),
      'titulo'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('saf_vario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_VARIO';
  }

}
