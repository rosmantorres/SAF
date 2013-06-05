<?php

/**
 * SAF_AGENDA_CONVOCATORIA form.
 *
 * @package    Proyecto_SAF
 * @subpackage form
 * @author     Rosman_Torres
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SAF_AGENDA_CONVOCATORIAForm extends BaseSAF_AGENDA_CONVOCATORIAForm
{
  public function configure()
  {    
    unset(
      $this['created_at'], 
      $this['updated_at'], 
      $this['departamento']
    );
    
  }
}
