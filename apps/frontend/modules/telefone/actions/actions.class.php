<?php

/**
 * telefone actions.
 *
 * @package    DemoJquery
 * @subpackage telefone
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class telefoneActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->telefones = Doctrine_Core::getTable('Telefone')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TelefoneForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TelefoneForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($telefone = Doctrine_Core::getTable('Telefone')->find(array($request->getParameter('id'))), sprintf('Object telefone does not exist (%s).', $request->getParameter('id')));
    $this->form = new TelefoneForm($telefone);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($telefone = Doctrine_Core::getTable('Telefone')->find(array($request->getParameter('id'))), sprintf('Object telefone does not exist (%s).', $request->getParameter('id')));
    $this->form = new TelefoneForm($telefone);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($telefone = Doctrine_Core::getTable('Telefone')->find(array($request->getParameter('id'))), sprintf('Object telefone does not exist (%s).', $request->getParameter('id')));
    $telefone->delete();

    $this->redirect('telefone/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $telefone = $form->save();

      $this->redirect('telefone/edit?id='.$telefone->getId());
    }
  }
}
