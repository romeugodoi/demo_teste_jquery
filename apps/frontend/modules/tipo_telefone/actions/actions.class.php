<?php

/**
 * tipo_telefone actions.
 *
 * @package    DemoJquery
 * @subpackage tipo_telefone
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipo_telefoneActions extends sfActions
{
	private $jsonData = array(
		'success' => null, 
		'message' => "", 
		'obj'	  => array()
	);

	public function executeCreate(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new TipoTelefoneForm();

		$this->processForm($request);
		
		return $this->returnJson($this->jsonData);		
	}

	protected function processForm(sfWebRequest $request)
	{
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		$this->jsonData['success']  = $this->form->isValid();
		
		if ($this->form->isValid())
		{
			$this->tipo_telefone = $this->form->save();
			
			$this->jsonData['obj']	= $this->tipo_telefone->toArray();
		}
		else
		{
			$this->jsonData['message'] = $this->form->renderAjaxErrorMessages();
			
			$this->jsonData['obj'] = $this->form->getObject()->toArray();
		}
	}

    /**
     * @param array $array 
     * @return json
     */
    protected function returnJson($array)
    {
        return $this->renderText(
			json_encode($array)
		);
    }
}
