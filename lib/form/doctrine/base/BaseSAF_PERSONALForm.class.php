<?php

/**
 * SAF_PERSONAL form base class.
 *
 * @method SAF_PERSONAL getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_PERSONALForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ci'       => new sfWidgetFormInputHidden(),
      'id_ue'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'add_empty' => false)),
      'nombre'   => new sfWidgetFormInputText(),
      'apellido' => new sfWidgetFormInputText(),
      'correo'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ci'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ci')), 'empty_value' => $this->getObject()->get('ci'), 'required' => false)),
      'id_ue'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'))),
      'nombre'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'apellido' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'correo'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_personal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_PERSONAL';
  }

}
