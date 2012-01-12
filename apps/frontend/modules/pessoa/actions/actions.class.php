<?php

/**
 * pessoa actions.
 * 
 * @property Pessoa $pessoa
 *
 * @package    DemoJquery
 * @subpackage pessoa
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pessoaActions extends sfActions
{
	private $jsonData = array(
		'success' => null, 
		'message' => "", 
		'obj'	  => array()
	);

	public function executeList(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$data      = array();		
		$page	   = $request->hasParameter('page')  ? $request->getParameter('page') : 1; 
		$sortName  = $request->hasParameter('sortname')  ? $request->getParameter('sortname') : 'nome'; 
		$sortOrder = $request->hasParameter('sortorder')  ? $request->getParameter('sortorder') : 'ASC'; 
		$limit	   = $request->getParameter('rp'); 
		$param     = $request->getParameter("query");
		$qtype     = $request->getParameter("qtype");
		
		$data['page']  = $page;
		$data['rows']  = array();

		// Paginação
		$start = ($page - 1) * $limit;

		$query = Doctrine_Core::getTable('Pessoa')->createQuery('a')->orderBy("$sortName $sortOrder");
		
		if (!empty($qtype) && !empty($param) && PessoaTable::getInstance()->hasColumn($qtype))
		{
			$query->addWhere("$qtype LIKE ?", "%$param%");
		}
		
		$data['total'] = $query->count();

		if ($start !== null && $start !== '' && $limit !== null && $limit !== '') 
		{
			$query->limit($limit);
			$query->offset($start);
        }
		
		$pessoas = $query->execute();
		
		foreach ($pessoas as $pessoa)
		{
			$data['rows'][] = array(
				'id'	=> $pessoa->getId(),
				'cell'	=> array_values($pessoa->toArrayJSON())
			);
		}
				
		return $this->returnJson($data);
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->form				= new PessoaForm();
		$this->telefoneForm		= new TelefoneForm();
		$this->enderecoForm		= new EnderecoForm();
		$this->tipoEnderecoForm = new TipoEnderecoForm();
		$this->tipoTelefoneForm = new TipoTelefoneForm();
	}
	
	public function executeRetrieve(sfWebRequest $request)
	{
		$pessoa = Doctrine_Core::getTable('Pessoa')->createQuery('p')
				->leftJoin('p.Enderecos')
				->leftJoin('p.Telefones')
				->addWhere('p.id = ?', array($request->getParameter('id')))
				->fetchOne();
		
		return $this->returnJson($pessoa->toArrayJSON());
	}

	public function executeSave(sfWebRequest $request)
	{
		$values = $request->getParameter('pessoa');
		
		return ($values['id'] > 0) ? $this->executeUpdate($request) : $this->executeCreate($request);
	}
	
	public function executeCreate(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new PessoaForm();

		$this->processForm($request);
		
		return $this->returnJson($this->jsonData);		
	}
	
	public function executeUpdate(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$values = $request->getParameter('pessoa');
		
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		
		$this->forward404Unless(
			$pessoa = Doctrine_Core::getTable('Pessoa')->find(array($values['id'])), 
			sprintf('Object pessoa does not exist (%s).', $values['id'])
		);
		
		$this->form = new PessoaForm($pessoa);

		$this->processForm($request, $this->form);

		return $this->returnJson($this->jsonData);	
	}

	public function executeDelete(sfWebRequest $request)
	{
		$this->setLayout(false);

		$request->checkCSRFProtection();
		
		$this->forward404Unless(
			$pessoa = Doctrine_Core::getTable('Pessoa')->find(array($request->getParameter('id'))), 
			sprintf('Object endereco does not exist (%s).', $request->getParameter('id'))
		);
		
		
		if (!$pessoa instanceof Pessoa)
		{
			$this->get404Message(sprintf('Object pessoa does not exist (%s).', $request->getParameter('id')));
		}
		
		if ($pessoa->delete())
		{
			$this->jsonData['success'] = true;
			$this->jsonData['message'] = "Registro excluído com sucesso.";
		}
		else
		{
			$this->jsonData['success'] = false;
			$this->jsonData['message'] = "Erro ao excluir registro. Por favor, contate o administrador.";
		}

		return $this->returnJson($this->jsonData);
	}

	protected function processForm(sfWebRequest $request)
	{
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		$this->jsonData['success']  = $this->form->isValid();
		
		if ($this->form->isValid())
		{
			$this->jsonData['message'] = $this->form->getObject()->isNew() ? 
					'Pessoa cadastrada com sucesso.' : 
					'Cadastro de pessoa atualizado com sucesso.';

			$this->pessoa = $this->form->save();
			
			$resEnderecos = $resTelefones = $enderecoIds = $telefoneIds = array();
			
			// Faz o link de Enderecos com pessoa.
			if ($request->hasParameter('enderecos'))
			{
				$resEnderecos = $this->saveRelationM2M("Enderecos", $request->getParameter('enderecos'));
				$enderecoIds  = $resEnderecos['ids'];
				
				$this->jsonData['enderecoMessage'] = $resEnderecos['errors'];
			}
			
			// Faz o link de Telefones com pessoa.
			if ($request->hasParameter('telefones'))
			{
				$resTelefones = $this->saveRelationM2M("Telefones", $request->getParameter('telefones'));
				$telefoneIds  = $resTelefones['ids'];
				
				$this->jsonData['telefoneMessage'] = $resTelefones['errors'];
			}
			
			if (count($enderecoIds) > 0 || count($telefoneIds) > 0)
			{
				if (count($enderecoIds) > 0)
				{
					$this->pessoa->unlink('Enderecos');
					$this->pessoa->link('Enderecos', $enderecoIds);
				}
				if (count($telefoneIds) > 0)
				{
					$this->pessoa->unlink('Telefones');
					$this->pessoa->link('Telefones', $telefoneIds);
				}
				
				$this->pessoa->save();
			}
			
			$this->jsonData['obj']	= $this->pessoa->toArrayJSON();
		}
		else
		{
			$this->jsonData['message'] = $this->form->renderAjaxErrorMessages();
			
			$this->jsonData['obj'] = $this->form->getObject()->toArrayJSON();
		}
	}
	
	/**
	 * @param string $relation
	 * @param array $taintedValues
	 * @return array('ids' => $relationIds, 'errors' => $errors); 
	 */
	protected function saveRelationM2M($relation, array $taintedValues)
	{
		$relationIds = $errors = array();		
		
		$pessoa = new Pessoa();
		
		/* @var $relationForm sfForm */
		$relationFormClass = $pessoa->getTable()->getRelation($relation)->getClass() . "Form";
		
		if (class_exists($relationFormClass))
		{
			foreach ($taintedValues as $values)
			{
				$relationForm = new $relationFormClass();
				$relationForm->bind($values);

				if ($relationForm->isValid())
				{
					$relationIds[] = $relationForm->save()->getId();
				}
				else 
				{
					$errors = $relationForm->renderAjaxErrorMessages();
				}
			}
		}
		
		if (count($errors) > 0)
		{
			$this->jsonData['success'] = false;

			// Altera a mensagem de retorno
			$this->jsonData['message'] = $this->form->getObject()->isNew() ? 
				'A pessoa foi cadastrada com sucesso, mas houveram alguns erros descritos abaixo:' : 
				'O cadastro da pessoa foi atualizado com sucesso, mas houveram alguns erros descritos abaixo:';			
		}
		
		return array('ids' => $relationIds, 'errors' => $errors);
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
