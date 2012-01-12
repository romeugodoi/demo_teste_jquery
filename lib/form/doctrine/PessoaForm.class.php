<?php

/**
 * Pessoa form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PessoaForm extends BasePessoaForm
{
	public function configure()
	{
		$this->getWidget('email')->setAttributes(array('class' => 'email'));
		
		unset($this['enderecos_list'], $this['telefones_list']);
	}
}
