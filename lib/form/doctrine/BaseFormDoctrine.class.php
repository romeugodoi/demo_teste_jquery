<?php

/**
 * Project form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{

	public function setup()
	{
	}
	
	/**
	 * @return array $errors  Messages
	 */
	public function renderAjaxErrorMessages()
	{
		$errors = array();
		
		foreach($this->getWidgetSchema()->getPositions() as $widgetName)
		{
			if ($this[$widgetName]->hasError())
			{
				$fieldName = sprintf($this->getWidgetSchema()->getNameFormat(), $widgetName);
				$errors[$fieldName] = $this[$widgetName]->renderLabelName() . ": " . $this[$widgetName]->getError();
			}
		}
		
		return $errors;
	}
}
