<?php $nomeDivs = 'errorBlock' . (isset($modulo) ? ucfirst($modulo) : '') ?>

<div class="ui-widget ui-helper-hidden" id="<?php echo $nomeDivs ?>-div1">
	<div class="ui-state-error ui-corner-all message" id="<?php echo $nomeDivs ?>-div2"> 
		<p>
		   <span class="ui-icon ui-icon-alert"></span> 
		   <strong>Alerta:</strong> Erros detectados!
		</p>
		<ul></ul>
	</div>
</div>