<?php

/**
 * SAF_EVENTO filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_EVENTOFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'clasificado_en'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_agenda'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'add_empty' => true)),
      'id_convocatoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => true)),
      'c_eveno_t'       => new sfWidgetFormFilterInput(),
      'c_evento_d'      => new sfWidgetFormFilterInput(),
      'status'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'descripcion'     => new sfValidatorPass(array('required' => false)),
      'clasificado_en'  => new sfValidatorPass(array('required' => false)),
      'id_agenda'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'column' => 'id')),
      'id_convocatoria' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'column' => 'id')),
      'c_eveno_t'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'c_evento_d'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_evento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_EVENTO';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'descripcion'     => 'Text',
      'clasificado_en'  => 'Text',
      'id_agenda'       => 'ForeignKey',
      'id_convocatoria' => 'ForeignKey',
      'c_eveno_t'       => 'Number',
      'c_evento_d'      => 'Number',
      'status'          => 'Text',
    );
  }
}
