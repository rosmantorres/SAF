<?php

/**
 * SAF_PERSONAL filter form base class.
 *
 * @package    Proyecto_SAF
 * @subpackage filter
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSAF_PERSONALFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ue'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'add_empty' => true)),
      'nombre'   => new sfWidgetFormFilterInput(),
      'apellido' => new sfWidgetFormFilterInput(),
      'correo'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_ue'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_UNIDAD_EQUIPO'), 'column' => 'id')),
      'nombre'   => new sfValidatorPass(array('required' => false)),
      'apellido' => new sfValidatorPass(array('required' => false)),
      'correo'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('saf_personal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SAF_PERSONAL';
  }

  public function getFields()
  {
    return array(
      'ci'       => 'Number',
      'id_ue'    => 'ForeignKey',
      'nombre'   => 'Text',
      'apellido' => 'Text',
      'correo'   => 'Text',
    );
  }
}
