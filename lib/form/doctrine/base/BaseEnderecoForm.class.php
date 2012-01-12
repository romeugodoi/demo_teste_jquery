<?php

/**
 * Endereco form base class.
 *
 * @method Endereco getObject() Returns the current form's model object
 *
 * @package    DemoJquery
 * @subpackage form
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEnderecoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'tipo_endereco_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoEndereco'), 'add_empty' => false)),
      'endereco'         => new sfWidgetFormInputText(),
      'cidade'           => new sfWidgetFormInputText(),
      'uf'               => new sfWidgetFormInputText(),
      'cep'              => new sfWidgetFormInputText(),
      'pessoa_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Pessoa')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tipo_endereco_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoEndereco'))),
      'endereco'         => new sfValidatorString(array('max_length' => 150)),
      'cidade'           => new sfValidatorString(array('max_length' => 60)),
      'uf'               => new sfValidatorString(array('max_length' => 2)),
      'cep'              => new sfValidatorString(array('max_length' => 9)),
      'pessoa_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Pessoa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('endereco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Endereco';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pessoa_list']))
    {
      $this->setDefault('pessoa_list', $this->object->Pessoa->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePessoaList($con);

    parent::doSave($con);
  }

  public function savePessoaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pessoa_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Pessoa->getPrimaryKeys();
    $values = $this->getValue('pessoa_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Pessoa', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Pessoa', array_values($link));
    }
  }

}
