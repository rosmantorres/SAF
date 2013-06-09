<?php

/**
 * convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class convocatoriaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->convocatorias = Doctrine_Core::getTable('SAF_CONVOCATORIA_CAF')->getConvocatorias();
  }
}
