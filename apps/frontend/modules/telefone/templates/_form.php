<?php include_partial("global/error_messages", array('modulo' => 'telefone')) ?>

<form id="telefoneForm" action="<?php echo url_for('telefone/create') ?>" method="POST">
	
	<?php echo $form->renderHiddenFields(false) ?>
	
	<?php echo $form['tipo_telefone_id']->renderLabel() ?>
	<?php echo $form['tipo_telefone_id'] ?>
	<a id="addTipoTelefone" class="" href="#">
		<img src="/css/images/add.png" />
	</a>

	<?php echo $form['ddd']->renderLabel() ?>
	<?php echo $form['ddd'] ?>

	<?php echo $form['numero']->renderLabel() ?>
	<?php echo $form['numero'] ?>
</form>