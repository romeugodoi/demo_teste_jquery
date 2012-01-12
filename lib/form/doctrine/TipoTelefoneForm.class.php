<?php

/**
 * TipoTelefone form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TipoTelefoneForm extends BaseTipoTelefoneForm
{

	public function configure()
	{
		$this->getWidgetSchema()->setLabels(array(
            'descricao' => 'Descrição'
        ));
	}
}
