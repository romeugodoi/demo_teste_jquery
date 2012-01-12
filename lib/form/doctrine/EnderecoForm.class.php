<?php

/**
 * Endereco form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EnderecoForm extends BaseEnderecoForm
{

	public function configure()
	{
		$this->getWidgetSchema()->setLabels(array(
            'tipo_endereco_id' => 'Tipo de Endereço',
        	'uf'			   => 'UF',
        ));
		
		$this->getWidget('tipo_endereco_id')->addOption('add_empty', '< Selecione >'); 

		$this->getWidget('tipo_endereco_id')->setAttributes(array(
			'class' => 'comboTipoEndereco'
		));
		
		$this->getWidget('uf')->setAttributes(array(
			'width' => 2, 
			'maxlength' => 2
		));
		
		$this->getWidget('cep')->setAttributes(array(
			'width' => 9, 
			'maxlength' => 9, 
			'class' => 'cep'
		));
	}
}
