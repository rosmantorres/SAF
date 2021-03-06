<?php

/**
 * SAF_COMP_UE form base class.
 *
 * @method SAF_COMP_UE getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_COMP_UEForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_compromiso' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'), 'add_empty' => false)),
      'id_ue'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'add_empty' => false)),
      'status'        => new sfWidgetFormInputText(),
      'acciones'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_compromiso' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'))),
      'id_ue'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'))),
      'status'        => new sfValidatorString(array('max_length' => 50)),
      'acciones'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_comp_ue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_COMP_UE';
  }

}
