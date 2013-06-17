<?php

/**
 * minuta actions.
 *
 * @package    Proyecto_SAF
 * @subpackage minuta
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class minutaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->eventos = Doctrine_Core::getTable('SAF_EVENTO')->createQuery()->execute();
  }
  
  public function executeXxx(sfWebRequest $request)
  {
    echo $request->getParameter('titulo_foto1')." ";
    echo $request->getParameter('titulo_foto2');
  }
}
