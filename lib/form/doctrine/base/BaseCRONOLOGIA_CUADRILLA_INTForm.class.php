<?php

/**
 * CRONOLOGIA_CUADRILLA_INT form base class.
 *
 * @method CRONOLOGIA_CUADRILLA_INT getObject() Returns the current form's model object
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCRONOLOGIA_CUADRILLA_INTForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_f328'      => new sfWidgetFormInputHidden(),
      'cod_cuad_cont' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'num_f328'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('num_f328')), 'empty_value' => $this->getObject()->get('num_f328'), 'required' => false)),
      'cod_cuad_cont' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cod_cuad_cont')), 'empty_value' => $this->getObject()->get('cod_cuad_cont'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cronologia_cuadrilla_int[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CRONOLOGIA_CUADRILLA_INT';
  }

}
