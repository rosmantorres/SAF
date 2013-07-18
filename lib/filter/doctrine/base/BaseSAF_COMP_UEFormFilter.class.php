<?php

/**
 * SAF_COMP_UE filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_COMP_UEFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_compromiso' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'), 'add_empty' => true)),
      'id_ue'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'add_empty' => true)),
      'status'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'acciones'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_compromiso' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_VARIO'), 'column' => 'id')),
      'id_ue'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'column' => 'id')),
      'status'        => new sfValidatorPass(array('required' => false)),
      'acciones'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_comp_ue_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_COMP_UE';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_compromiso' => 'ForeignKey',
      'id_ue'         => 'ForeignKey',
      'status'        => 'Text',
      'acciones'      => 'Text',
    );
  }
}
