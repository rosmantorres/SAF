<?php

/**
 * SAF_MINUTA form base class.
 *
 * @method SAF_MINUTA getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSAF_MINUTAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cod_min'         => new sfWidgetFormInputHidden(),
      'id_convocatoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => false)),
      'dir_pdf'         => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'cod_min'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cod_min')), 'empty_value' => $this->getObject()->get('cod_min'), 'required' => false)),
      'id_convocatoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'))),
      'dir_pdf'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'SAF_MINUTA', 'column' => array('id_convocatoria')))
    );

    $this->widgetSchema->setNameFormat('saf_minuta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_MINUTA';
  }

}
