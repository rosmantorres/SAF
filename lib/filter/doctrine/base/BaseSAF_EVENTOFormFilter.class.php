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
      'descripcion'       => new sfWidgetFormFilterInput(),
      'id_agenda'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'add_empty' => true)),
      'c_evento_t'        => new sfWidgetFormFilterInput(),
      'c_evento_d'        => new sfWidgetFormFilterInput(),
      'f_hora_ini'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'f_hora_rep'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'region'            => new sfWidgetFormFilterInput(),
      'circuito'          => new sfWidgetFormFilterInput(),
      'cod_nivel'         => new sfWidgetFormFilterInput(),
      'kva_int'           => new sfWidgetFormFilterInput(),
      'mva_min'           => new sfWidgetFormFilterInput(),
      'num_averia'        => new sfWidgetFormFilterInput(),
      'desc_averia'       => new sfWidgetFormFilterInput(),
      'tipo_falla'        => new sfWidgetFormFilterInput(),
      'operador'          => new sfWidgetFormFilterInput(),
      'cuadrilla'         => new sfWidgetFormFilterInput(),
      'climatologia'      => new sfWidgetFormFilterInput(),
      'trabajo_realizado' => new sfWidgetFormFilterInput(),
      'num_roe'           => new sfWidgetFormFilterInput(),
      'programador'       => new sfWidgetFormFilterInput(),
      'operador_resp'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'id_agenda'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SAF_AGENDA_CONVOCATORIA'), 'column' => 'id')),
      'c_evento_t'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'c_evento_d'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'f_hora_ini'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'f_hora_rep'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'region'            => new sfValidatorPass(array('required' => false)),
      'circuito'          => new sfValidatorPass(array('required' => false)),
      'cod_nivel'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kva_int'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mva_min'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_averia'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'desc_averia'       => new sfValidatorPass(array('required' => false)),
      'tipo_falla'        => new sfValidatorPass(array('required' => false)),
      'operador'          => new sfValidatorPass(array('required' => false)),
      'cuadrilla'         => new sfValidatorPass(array('required' => false)),
      'climatologia'      => new sfValidatorPass(array('required' => false)),
      'trabajo_realizado' => new sfValidatorPass(array('required' => false)),
      'num_roe'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'programador'       => new sfValidatorPass(array('required' => false)),
      'operador_resp'     => new sfValidatorPass(array('required' => false)),
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
      'id'                => 'Number',
      'descripcion'       => 'Text',
      'id_agenda'         => 'ForeignKey',
      'c_evento_t'        => 'Number',
      'c_evento_d'        => 'Number',
      'f_hora_ini'        => 'Date',
      'f_hora_rep'        => 'Date',
      'region'            => 'Text',
      'circuito'          => 'Text',
      'cod_nivel'         => 'Number',
      'kva_int'           => 'Number',
      'mva_min'           => 'Number',
      'num_averia'        => 'Number',
      'desc_averia'       => 'Text',
      'tipo_falla'        => 'Text',
      'operador'          => 'Text',
      'cuadrilla'         => 'Text',
      'climatologia'      => 'Text',
      'trabajo_realizado' => 'Text',
      'num_roe'           => 'Number',
      'programador'       => 'Text',
      'operador_resp'     => 'Text',
    );
  }
}
