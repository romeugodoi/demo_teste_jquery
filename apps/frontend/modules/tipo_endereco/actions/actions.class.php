<?php

/**
 * tipo_endereco actions.
 *
 * @package    DemoJquery
 * @subpackage tipo_endereco
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tipo_enderecoActions extends sfActions
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

		$this->form = new TipoEnderecoForm();

		$this->processForm($request);
		
		return $this->returnJson($this->jsonData);		
	}

	protected function processForm(sfWebRequest $request)
	{
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		$this->jsonData['success']  = $this->form->isValid();
		
		if ($this->form->isValid())
		{
			$this->tipo_endereco = $this->form->save();
			
			$this->jsonData['obj']	= $this->tipo_endereco->toArray();
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
