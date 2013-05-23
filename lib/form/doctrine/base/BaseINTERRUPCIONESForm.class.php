<?php

/**
 * INTERRUPCIONES form base class.
 *
 * @method INTERRUPCIONES getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseINTERRUPCIONESForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_f328'          => new sfWidgetFormInputHidden(),
      'nivel_sistema'     => new sfWidgetFormInputText(),
      'cod_sistema'       => new sfWidgetFormInputText(),
      'fecha_hora_ini'    => new sfWidgetFormDateTime(),
      'kva_interrump'     => new sfWidgetFormInputText(),
      'mvamin'            => new sfWidgetFormInputText(),
      'cod_causa'         => new sfWidgetFormInputText(),
      'distrito'          => new sfWidgetFormInputText(),
      'num_proposicion'   => new sfWidgetFormInputText(),
      'trabajo_realizado' => new sfWidgetFormTextarea(),
      'climatologia'      => new sfWidgetFormInputText(),
      'num_roe'           => new sfWidgetFormInputText(),
      'num_averia'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'num_f328'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('num_f328')), 'empty_value' => $this->getObject()->get('num_f328'), 'required' => false)),
      'nivel_sistema'     => new sfValidatorInteger(),
      'cod_sistema'       => new sfValidatorInteger(),
      'fecha_hora_ini'    => new sfValidatorDateTime(),
      'kva_interrump'     => new sfValidatorInteger(),
      'mvamin'            => new sfValidatorNumber(),
      'cod_causa'         => new sfValidatorInteger(),
      'distrito'          => new sfValidatorInteger(),
      'num_proposicion'   => new sfValidatorInteger(array('required' => false)),
      'trabajo_realizado' => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'climatologia'      => new sfValidatorInteger(array('required' => false)),
      'num_roe'           => new sfValidatorInteger(array('required' => false)),
      'num_averia'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('interrupciones[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'INTERRUPCIONES';
  }

}
