<?php

/**
 * TipoTelefone form base class.
 *
 * @method TipoTelefone getObject() Returns the current form's model object
 *
 * @package    DemoJquery
 * @subpackage form
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoTelefoneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'nome'      => new sfWidgetFormInputText(),
      'descricao' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'      => new sfValidatorString(array('max_length' => 45)),
      'descricao' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_telefone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoTelefone';
  }

}
