<?php include_partial("global/error_messages", array('modulo' => 'endereco')) ?>

<form id="enderecoForm" action="<?php echo url_for('endereco/create') ?>" method="POST">

	<?php echo $form['tipo_endereco_id']->renderLabel() ?>
	<?php echo $form['tipo_endereco_id'] ?>
	<a id="addTipoEndereco" class="" href="#">
		<img src="/css/images/add.png" />
	</a>
	
	<?php echo $form['endereco']->renderLabel() ?>
	<?php echo $form['endereco'] ?>

	<?php echo $form['cidade']->renderLabel() ?>
	<?php echo $form['cidade'] ?>

	<?php echo $form['uf']->renderLabel() ?>
	<?php echo $form['uf'] ?>

	<?php echo $form['cep']->renderLabel() ?>
	<?php echo $form['cep'] ?>
</form>
