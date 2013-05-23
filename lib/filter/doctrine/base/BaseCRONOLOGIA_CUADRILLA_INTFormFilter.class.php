<?php

/**
 * CRONOLOGIA_CUADRILLA_INT filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCRONOLOGIA_CUADRILLA_INTFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('cronologia_cuadrilla_int_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CRONOLOGIA_CUADRILLA_INT';
  }

  public function getFields()
  {
    return array(
      'num_f328'      => 'Number',
      'cod_cuad_cont' => 'Text',
    );
  }
}
