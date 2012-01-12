<?php

/**
 * Telefone form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TelefoneForm extends BaseTelefoneForm
{

	public function configure()
	{
		unset($this['pessoa_list']);
		
		$this->getWidgetSchema()->setLabels(array(
            'tipo_telefone_id' => 'Tipo de Telefone',
        	'ddd'			   => 'DDD',
            'numero'		   => 'Número'
        ));
		
		$this->getWidget('tipo_telefone_id')->addOption('add_empty', '< Selecione >'); 

		$this->getWidget('tipo_telefone_id')->setAttributes(array(
			'class' => 'comboTipoTelefone'
		));
		
		$this->getWidget('ddd')->setAttributes(array(
			'width' => 2, 
			'maxlength' => 2, 
			'class' => 'ddd'
		));
		
		$this->getWidget('numero')->setAttributes(array('class' => 'fone'));
	}
}
