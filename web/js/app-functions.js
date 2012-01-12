$(document).ready(function() {

	showInfoMessage = function(msg) {
		$('#infoBlock .info-message').html(msg);
		$('#infoBlock').show();
	}
	
	showErrorMessagesPessoaForm = function(arrMsg) {
		$.each(arrMsg, function(index, msg) {
			$('#errorBlockPessoa-div1 .message ul').append("<li>" + msg + "</li>");
		});
		
		$('#errorBlockPessoa-div1').show();
		$('#errorBlockPessoa-div1 *').show();
	}
	
	confirmDialog = function(strTitle, callback) {
		$('#dialog-confirm').dialog({
			title: strTitle,
			resizable: false,
			height: 160,
			modal: true,
			buttons: {
				"OK": function() {
					$( this ).dialog( "close" );
					callback();
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	}
	
	alertDialog = function(msg) {
		$('#dialog-alert .alert-message').html(msg);
		
		$('#dialog-alert').dialog({
			resizable: true,
			modal: true,
			buttons: {
				"OK": function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	}
	
	loadForm = function(idForm, prefixName, obj) {
							
		for (var i in obj) 
		{
			var selector = '#' + idForm + ' input[name="' + prefixName + '[' + i + ']"]';
			
			if ($(selector).length > 0) {
				$(selector).val(obj[i]);
			}
		}

	}
});

