<?php

/**
 * SAF_R1000_MVAMIN filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_R1000_MVAMINFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_evento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_EVENTO'), 'add_empty' => true)),
      'razon'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_evento' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_EVENTO'), 'column' => 'id')),
      'razon'     => new sfValidatorPass(array('required' => false)),
      'valor'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('saf_r1000_mvamin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_R1000_MVAMIN';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_evento' => 'ForeignKey',
      'razon'     => 'Text',
      'valor'     => 'Number',
    );
  }
}
