<?php

/**
 * Pessoa form base class.
 *
 * @method Pessoa getObject() Returns the current form's model object
 *
 * @package    DemoJquery
 * @subpackage form
 * @author     Romeu Godoi <romeu.godoi@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePessoaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nome'           => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'enderecos_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Endereco')),
      'telefones_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Telefone')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'           => new sfValidatorString(array('max_length' => 100)),
      'email'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'enderecos_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Endereco', 'required' => false)),
      'telefones_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Telefone', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pessoa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pessoa';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['enderecos_list']))
    {
      $this->setDefault('enderecos_list', $this->object->Enderecos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['telefones_list']))
    {
      $this->setDefault('telefones_list', $this->object->Telefones->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveEnderecosList($con);
    $this->saveTelefonesList($con);

    parent::doSave($con);
  }

  public function saveEnderecosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['enderecos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Enderecos->getPrimaryKeys();
    $values = $this->getValue('enderecos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Enderecos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Enderecos', array_values($link));
    }
  }

  public function saveTelefonesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['telefones_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Telefones->getPrimaryKeys();
    $values = $this->getValue('telefones_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Telefones', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Telefones', array_values($link));
    }
  }

}
