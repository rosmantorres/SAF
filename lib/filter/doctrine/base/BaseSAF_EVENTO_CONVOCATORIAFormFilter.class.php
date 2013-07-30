<?php

/**
 * SAF_EVENTO_CONVOCATORIA filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_EVENTO_CONVOCATORIAFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'status'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_evento_convocatoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_EVENTO_CONVOCATORIA';
  }

  public function getFields()
  {
    return array(
      'id_evento'       => 'Number',
      'id_convocatoria' => 'Number',
      'status'          => 'Text',
    );
  }
}
