<?php

/**
 * SAF_F_CONVOCATORIA_CAF filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_F_CONVOCATORIA_CAFFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_convocatoria'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => true)),
      'status'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'motivo_suspencion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_convocatoria'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'column' => 'id')),
      'status'            => new sfValidatorPass(array('required' => false)),
      'motivo_suspencion' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_f_convocatoria_caf_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_F_CONVOCATORIA_CAF';
  }

  public function getFields()
  {
    return array(
      'fecha'             => 'Date',
      'id_convocatoria'   => 'ForeignKey',
      'status'            => 'Text',
      'motivo_suspencion' => 'Text',
    );
  }
}
