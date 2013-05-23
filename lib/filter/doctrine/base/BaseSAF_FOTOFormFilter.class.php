<?php

/**
 * SAF_FOTO filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_FOTOFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titulo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dir'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_convocatoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'add_empty' => true)),
      'id_evento'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'add_empty' => true)),
      'id_vario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_VARIO'), 'add_empty' => true)),
      'sub_titulo'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tipo'            => new sfValidatorPass(array('required' => false)),
      'titulo'          => new sfValidatorPass(array('required' => false)),
      'dir'             => new sfValidatorPass(array('required' => false)),
      'id_convocatoria' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_CONVOCATORIA_CAF'), 'column' => 'id')),
      'id_evento'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_EVENTO'), 'column' => 'id')),
      'id_vario'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_VARIO'), 'column' => 'id')),
      'sub_titulo'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_foto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_FOTO';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'tipo'            => 'Text',
      'titulo'          => 'Text',
      'dir'             => 'Text',
      'id_convocatoria' => 'ForeignKey',
      'id_evento'       => 'ForeignKey',
      'id_vario'        => 'ForeignKey',
      'sub_titulo'      => 'Text',
    );
  }
}
