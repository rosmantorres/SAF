<?php

/**
 * agenda_convocatoria actions.
 *
 * @package    Proyecto_SAF
 * @subpackage agenda_convocatoria
 * @author     Rosman_Torres
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agenda_convocatoriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->saf_agenda_convocatori_as = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->getAgendas();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->saf_agenda_convocatoria);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SAF_AGENDA_CONVOCATORIAForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SAF_AGENDA_CONVOCATORIAForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('Object saf_agenda_convocatoria does not exist (%s).', $request->getParameter('id')));
    $this->form = new SAF_AGENDA_CONVOCATORIAForm($saf_agenda_convocatoria);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('Object saf_agenda_convocatoria does not exist (%s).', $request->getParameter('id')));
    $this->form = new SAF_AGENDA_CONVOCATORIAForm($saf_agenda_convocatoria);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($saf_agenda_convocatoria = Doctrine_Core::getTable('SAF_AGENDA_CONVOCATORIA')->find(array($request->getParameter('id'))), sprintf('Object saf_agenda_convocatoria does not exist (%s).', $request->getParameter('id')));
    $saf_agenda_convocatoria->delete();

    $this->redirect('agenda_convocatoria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $saf_agenda_convocatoria = $form->save();

      $this->redirect('agenda_convocatoria/edit?id='.$saf_agenda_convocatoria->getId());
    }
  }
}
