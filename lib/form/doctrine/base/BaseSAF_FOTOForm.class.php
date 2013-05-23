<?php

/**
 * SAF_FOTO form base class.
 *
 * @method SAF_FOTO getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_FOTOForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'tipo'            => new sfWidgetFormInputText(),
      'titulo'          => new sfWidgetFormInputText(),
      'dir'             => new sfWidgetFormInputText(),
      'id_convocatoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => true)),
      'id_evento'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'add_empty' => true)),
      'id_vario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'), 'add_empty' => true)),
      'sub_titulo'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipo'            => new sfValidatorString(array('max_length' => 50)),
      'titulo'          => new sfValidatorString(array('max_length' => 100)),
      'dir'             => new sfValidatorString(array('max_length' => 100)),
      'id_convocatoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'required' => false)),
      'id_evento'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'required' => false)),
      'id_vario'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'), 'required' => false)),
      'sub_titulo'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_foto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_FOTO';
  }

}
