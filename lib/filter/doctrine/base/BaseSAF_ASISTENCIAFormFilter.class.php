<?php

/**
 * SAF_ASISTENCIA filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_ASISTENCIAFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('saf_asistencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_ASISTENCIA';
  }

  public function getFields()
  {
    return array(
      'id_convocatoria' => 'Number',
      'id_personal'     => 'Number',
    );
  }
}
