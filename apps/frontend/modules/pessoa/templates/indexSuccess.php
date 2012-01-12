<div class="ui-widget ui-helper-hidden" id="infoBlock">
	<div class="ui-state-highlight ui-corner-all message"> 
		<p>
			<span class="ui-icon ui-icon-info"></span>
			<span class="info-message"></span>
		</p>
	</div>
</div>
<?php include_partial('global/confirm_dialog') ?>
<?php include_partial('global/alert_dialog') ?>

<table id="pessoasList" class="ui-helper-hidden"></table>

<div id="pessoaDialogForm" title="Cadastro de Pessoa" class="ui-widget-content ui-helper-hidden">
	<?php include_partial('pessoa/form', array('form' => $form)); ?>
</div>

<div id="enderecoDialogForm" title="Cadastro de Endereços" class="ui-widget-content ui-helper-hidden">
	<?php include_partial('endereco/form', array('form' => $enderecoForm)); ?>
</div>

<div id="telefoneDialogForm" title="Cadastro de Telefones" class="ui-widget-content ui-helper-hidden">
	<?php include_partial('telefone/form', array('form' => $telefoneForm)); ?>
</div>

<div id="tipoEnderecoDialogForm" title="Cadastro de Tipo" class="ui-widget-content ui-helper-hidden">
	<?php include_partial('tipo_endereco/form', array('form' => $tipoEnderecoForm)); ?>
</div>

<div id="tipoTelefoneDialogForm" title="Cadastro de Tipo" class="ui-widget-content ui-helper-hidden">
	<?php include_partial('tipo_telefone/form', array('form' => $tipoTelefoneForm)); ?>
</div>
