<?php

/**
 * agenda_convocatoria module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage agenda_convocatoria
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAgenda_convocatoriaGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'saf_agenda_convocatoria' : 'saf_agenda_convocatoria_'.$action;
  }
}
