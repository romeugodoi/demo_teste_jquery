<?php include_partial("global/error_messages", array('modulo' => 'tipoTelefone')) ?>

<form id="tipoTelefoneForm" action="<?php echo url_for('tipo_telefone/create') ?>" method="POST">
	
	<?php echo $form->renderHiddenFields(false) ?>
	
	<?php echo $form['nome']->renderLabel() ?>
	<?php echo $form['nome'] ?>

	<?php echo $form['descricao']->renderLabel() ?>
	<?php echo $form['descricao'] ?>
</form>