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
      'id'                => new sfWidgetFormInputHidden(),
      'descripcion'       => new sfWidgetFormTextarea(),
      'id_agenda'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'add_empty' => true)),
      'c_evento_t'        => new sfWidgetFormInputText(),
      'c_evento_d'        => new sfWidgetFormInputText(),
      'f_hora_ini'        => new sfWidgetFormDateTime(),
      'f_hora_rep'        => new sfWidgetFormDateTime(),
      'region'            => new sfWidgetFormInputText(),
      'circuito'          => new sfWidgetFormInputText(),
      'cod_nivel'         => new sfWidgetFormInputText(),
      'kva_int'           => new sfWidgetFormInputText(),
      'mva_min'           => new sfWidgetFormInputText(),
      'num_averia'        => new sfWidgetFormInputText(),
      'desc_averia'       => new sfWidgetFormTextarea(),
      'tipo_falla'        => new sfWidgetFormInputText(),
      'operador'          => new sfWidgetFormInputText(),
      'cuadrilla'         => new sfWidgetFormInputText(),
      'climatologia'      => new sfWidgetFormInputText(),
      'trabajo_realizado' => new sfWidgetFormTextarea(),
      'num_roe'           => new sfWidgetFormInputText(),
      'programador'       => new sfWidgetFormInputText(),
      'operador_resp'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'descripcion'       => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'id_agenda'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'required' => false)),
      'c_evento_t'        => new sfValidatorInteger(array('required' => false)),
      'c_evento_d'        => new sfValidatorInteger(array('required' => false)),
      'f_hora_ini'        => new sfValidatorDateTime(array('required' => false)),
      'f_hora_rep'        => new sfValidatorDateTime(array('required' => false)),
      'region'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'circuito'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'cod_nivel'         => new sfValidatorInteger(array('required' => false)),
      'kva_int'           => new sfValidatorInteger(array('required' => false)),
      'mva_min'           => new sfValidatorInteger(array('required' => false)),
      'num_averia'        => new sfValidatorInteger(array('required' => false)),
      'desc_averia'       => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'tipo_falla'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'operador'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cuadrilla'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'climatologia'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'trabajo_realizado' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'num_roe'           => new sfValidatorInteger(array('required' => false)),
      'programador'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'operador_resp'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
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
