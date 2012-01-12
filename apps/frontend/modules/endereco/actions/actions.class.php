<?php

/**
 * endereco actions.
 *
 * @package    DemoJquery
 * @subpackage endereco
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class enderecoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->enderecos = Doctrine_Core::getTable('Endereco')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EnderecoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EnderecoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($endereco = Doctrine_Core::getTable('Endereco')->find(array($request->getParameter('id'))), sprintf('Object endereco does not exist (%s).', $request->getParameter('id')));
    $this->form = new EnderecoForm($endereco);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($endereco = Doctrine_Core::getTable('Endereco')->find(array($request->getParameter('id'))), sprintf('Object endereco does not exist (%s).', $request->getParameter('id')));
    $this->form = new EnderecoForm($endereco);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($endereco = Doctrine_Core::getTable('Endereco')->find(array($request->getParameter('id'))), sprintf('Object endereco does not exist (%s).', $request->getParameter('id')));
    $endereco->delete();

    $this->redirect('endereco/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $endereco = $form->save();

      $this->redirect('endereco/edit?id='.$endereco->getId());
    }
  }
}
