<?php

/**
 * SAF_TAREA_REALIZADA_COMP form base class.
 *
 * @method SAF_TAREA_REALIZADA_COMP getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_TAREA_REALIZADA_COMPForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_comp_ue'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_COMP_UE'), 'add_empty' => false)),
      'descripcion' => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_comp_ue'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_COMP_UE'))),
      'descripcion' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('saf_tarea_realizada_comp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_TAREA_REALIZADA_COMP';
  }

}
