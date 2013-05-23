<?php

/**
 * SAF_F_CONVOCATORIA_CAF form base class.
 *
 * @method SAF_F_CONVOCATORIA_CAF getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_F_CONVOCATORIA_CAFForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'             => new sfWidgetFormInputHidden(),
      'id_convocatoria'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => false)),
      'status'            => new sfWidgetFormInputText(),
      'motivo_suspencion' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'fecha'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('fecha')), 'empty_value' => $this->getObject()->get('fecha'), 'required' => false)),
      'id_convocatoria'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'))),
      'status'            => new sfValidatorString(array('max_length' => 50)),
      'motivo_suspencion' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_f_convocatoria_caf[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_F_CONVOCATORIA_CAF';
  }

}
