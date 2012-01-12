<?php

class frontendConfiguration extends sfApplicationConfiguration
{

	public function configure()
	{
		sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
		sfValidatorBase::setDefaultMessage('invalid', 'O valor informado é inválido.');
		sfValidatorBase::setDefaultMessage('max_length', '"%value%" é muito grande (insira no máximo %max_length% caracteres).');
	}

}
