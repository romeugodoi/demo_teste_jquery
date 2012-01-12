<?php include_partial("global/error_messages", array('modulo' => 'pessoa')) ?>

<form id="pessoaForm" action="<?php echo url_for('pessoa/save') ?>" method="POST">
	<?php echo $form->renderHiddenFields(false) ?>
	
	<div id="tabs">
		<fieldset>
			<ul>
				<li><a href="#tabs-1">Pessoa</a></li>
				<li><a href="#tabs-2">Endereços</a></li>
				<li><a href="#tabs-3">Telefones</a></li>
			</ul>
			
			<div id="tabs-1">
			
				<?php echo $form['nome']->renderLabel() ?>
				<?php echo $form['nome'] ?>
				
				<?php echo $form['email']->renderLabel() ?>
				<?php echo $form['email'] ?>
			</div>
			
			<div id="tabs-2">
				<button id="btnAddEndereco" class="add">Adicionar</button>
				<div id="enderecos-contain" class="ui-widget">
					<?php include_partial('pessoa/list_enderecos'); ?>
				</div>			
			</div>
			
			<div id="tabs-3">
				<button id="btnAddTelefone" class="add">Adicionar</button>
				<div id="fones-contain" class="ui-widget">
					<?php include_partial('pessoa/list_fones'); ?>
				</div>
			</div>
		</fieldset>
	</div>
</form>

