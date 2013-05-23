<?php

/**
 * CIRCUITOS filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCIRCUITOSFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bar_cod_barra' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'desc_cto'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'bar_cod_barra' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'desc_cto'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('circuitos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CIRCUITOS';
  }

  public function getFields()
  {
    return array(
      'cod_cto'       => 'Number',
      'bar_cod_barra' => 'Number',
      'desc_cto'      => 'Text',
    );
  }
}
