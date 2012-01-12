
$(document).ready(function() {
	
	/**
	 * ##############################################################
	 * #################| VALIDAÇÃO DE FORMULÁRIOS |################# 
	 * ##############################################################
	 */
	
	$.validator.setDefaults({

		wrapper: "li", 
	
		highlight: function(input) {
			$(input).addClass("ui-state-highlight");
		},
		unhighlight: function(input) {
			$(input).removeClass("ui-state-highlight");
		}
	});
	
	/*****| PESSOA FORM - VALIDATE |***********************************/
	$( "#pessoaForm" ).validate({
		
		errorContainer: "#errorBlockPessoa-div1, #errorBlockPessoa-div2",
		errorLabelContainer: "#errorBlockPessoa-div2 ul",
		
		rules: {
			"pessoa[nome]": "required",
			"pessoa[email]": "email"
		},
		
		messages: {
			"pessoa[nome]": getMsgErrorField('required', 'Nome'), 
			"pessoa[email]": getMsgErrorField('email', 'Email')
		}, 
		
		submitHandler: function(form) {
			$("#pessoaDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('disable');
			
			$(form).ajaxSubmit({
				dataType: 'json', 
				success: function(responseText, statusText, xhr, $form) {

					var obj = responseText.obj;
					
					if (responseText.success === true) {
						
						$('#pessoasList').flexReload();
						
						$("#pessoaDialogForm").dialog('close');
	
						showInfoMessage(responseText.message);
					}
					else if (responseText.enderecoMessage !== undefined || responseText.telefoneMessage !== undefined) {

						loadForm('pessoaForm', 'pessoa', obj);
						
						$("#pessoaDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('enable');
						
						if (responseText.enderecoMessage !== undefined)
							showErrorMessagesPessoaForm(responseText.enderecoMessage);
						if (responseText.telefoneMessage !== undefined)
							showErrorMessagesPessoaForm(responseText.telefoneMessage)
					}
					else {
						$("#pessoaDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('enable');
						
						$("#pessoaForm").validate().showErrors(responseText.message);
					}
				}
			});
			return false;
		}
	});
	
	/*****| ENDEREÇO FORM - VALIDATE |***********************************/
	$( "#enderecoForm" ).validate({ 
		
		errorContainer: "#errorBlockEndereco-div1, #errorBlockEndereco-div2",
		errorLabelContainer: "#errorBlockEndereco-div2 ul",
		
		rules: {
			"endereco[tipo_endereco_id]": "required", 
			"endereco[endereco]": {
				required: true,
				minlength: 5, 
				maxlength: 100
			},
			"endereco[cidade]": {
				required: true,
				minlength: 2, 
				maxlength: 40				
			},
			"endereco[uf]": {
				required: true
			},
			"endereco[cep]": {
				required: true,
				minlength: 8, 
				maxlength: 9				
			}
		},
		
		messages: {
			"endereco[tipo_endereco_id]": 'Por favor, selecione o Tipo de Endereço', 
			"endereco[endereco]": {
				required:  getMsgErrorField('required', 'Endereço'), 
				minlength: getMsgErrorField('minlength', 'Endereço', "{0}"), 
				maxlength: getMsgErrorField('maxlength', 'Endereço', null, "{0}") 
			},
			"endereco[cidade]": {
				required:  getMsgErrorField('required', 'Cidade'), 
				minlength: getMsgErrorField('minlength', 'Cidade', "{0}"), 
				maxlength: getMsgErrorField('maxlength', 'Cidade', null, "{0}") 
			},
			"endereco[uf]": getMsgErrorField('required', 'UF'),
			"endereco[cep]": {
				required:  getMsgErrorField('required', 'Cep'), 
				minlength: getMsgErrorField('minlength', 'Cep', "{0}"), 
				maxlength: getMsgErrorField('maxlength', 'Cep', null, "{0}") 
			}
		},

		submitHandler: function(form) {
			var arrObjJSON = $.parseJSON('[' +
				'{' +
					'"tipo_endereco":"'		+ $("#endereco_tipo_endereco_id option:selected").text() + '",' + 
					'"tipo_endereco_id":"'	+ $("#endereco_tipo_endereco_id").val()					 + '",' + 
					'"endereco":"'			+ $("#endereco_endereco").val()							 + '",' +  
					'"cidade":"'			+ $("#endereco_cidade").val()							 + '",' + 
					'"uf":"'				+ $("#endereco_uf").val()								 + '",' +  
					'"cep":"'				+ $("#endereco_cep").val()								 + '"' +
				'}' +
			']');
			
			addEnderecoPessoa(arrObjJSON);
			$('#enderecoDialogForm').dialog('close');
		}
	});
	
	/*****| TELEFONE FORM - VALIDATE |***********************************/
	$( "#telefoneForm" ).validate({
		
		errorContainer: "#errorBlockTelefone-div1, #errorBlockTelefone-div2",
		errorLabelContainer: "#errorBlockTelefone-div2 ul",
		
		rules: {
			"telefone[tipo_telefone_id]": "required", 
			"telefone[ddd]": {
				required: true,
				minlength: 2, 
				maxlength: 2
			},
			"telefone[numero]": {
				required: true,
				minlength: 8, 
				maxlength: 9				
			}
		},
		
		messages: {
			"telefone[tipo_telefone_id]": 'Por favor, selecione o Tipo de Telefone', 
			"telefone[ddd]": {
				required:  getMsgErrorField('required', 'DDD'), 
				minlength: getMsgErrorField('minlength', 'DDD', "{0}"), 
				maxlength: getMsgErrorField('maxlength', 'DDD', null, "{0}") 
			},
			"telefone[numero]": {
				required:  getMsgErrorField('required', 'Telefone'), 
				minlength: getMsgErrorField('minlength', 'Telefone', "{0}"), 
				maxlength: getMsgErrorField('maxlength', 'Telefone', null, "{0}") 
			}
		},
		
		submitHandler: function(form) {
			var arrObjJSON = $.parseJSON('[' +
				'{' +
					'"tipo_telefone":"'		+ $("#telefone_tipo_telefone_id option:selected").text()+ '",' + 
					'"tipo_telefone_id":"'	+ $("#telefone_tipo_telefone_id").val()					+ '",' + 
					'"ddd":"'				+ $("#telefone_ddd").val()								+ '",' +  
					'"numero":"'			+ $("#telefone_numero").val()							+ '"' +
				'}' +
			']');

			addTelefonePessoa(arrObjJSON);
			$('#telefoneDialogForm').dialog('close');
		}
	});
	
	/*****| TIPO ENDERECO FORM - VALIDATE |***********************************/
	$( "#tipoEnderecoForm" ).validate({
		
		errorContainer: "#errorBlockTipoEndereco-div1, #errorBlockTipoEndereco-div2",
		errorLabelContainer: "#errorBlockTipoEndereco-div2 ul",
		
		rules: {
			"tipo_endereco[nome]": {
				required: true,
				maxlength: 45
			},
			"tipo_endereco[descricao]": {
				maxlength: 1000
			}
		},
		
		messages: {
			"tipo_endereco[nome]": {
				required:  getMsgErrorField('required', 'Nome'), 
				maxlength: getMsgErrorField('maxlength', 'Nome', null, "{0}") 
			},
			"tipo_endereco[descricao]": {
				maxlength: getMsgErrorField('maxlength', 'Descrição', null, "{0}") 
			}
		},
		
		submitHandler: function(form) {
			$("#tipoEnderecoDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('disable');
			
			$(form).ajaxSubmit({
				dataType: 'json', 
				success: function(responseText, statusText, xhr, $form) {

					var obj = responseText.obj;
					
					if (responseText.success === true) {
						
						$('.comboTipoEndereco').append('<option value="' + obj.id + '">' + obj.nome + '</option>');
						$('.comboTipoEndereco').val("");
						
						$("#tipoEnderecoDialogForm").dialog('close');
					}
					else {
						$("#tipoEnderecoDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('enable');
						
						$("#tipoEnderecoForm").validate().showErrors(responseText.message);
					}
				}
			});
			return false;
		}
	});
	
	/*****| TIPO TELEFONE FORM - VALIDATE |***********************************/
	$( "#tipoTelefoneForm" ).validate({
		
		errorContainer: "#errorBlockTipoTelefone-div1, #errorBlockTipoTelefone-div2",
		errorLabelContainer: "#errorBlockTipoTelefone-div2 ul",
		
		rules: {
			"tipo_telefone[nome]": {
				required: true,
				maxlength: 45
			},
			"tipo_telefone[descricao]": {
				maxlength: 1000
			}
		},
		
		messages: {
			"tipo_telefone[nome]": {
				required:  getMsgErrorField('required', 'Nome'), 
				maxlength: getMsgErrorField('maxlength', 'Nome', null, "{0}") 
			},
			"tipo_telefone[descricao]": {
				maxlength: getMsgErrorField('maxlength', 'Descrição', null, "{0}") 
			}
		},
		
		submitHandler: function(form) {
			$("#tipoTelefoneDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('disable');
			
			$(form).ajaxSubmit({
				dataType: 'json', 
				success: function(responseText, statusText, xhr, $form) {

					var obj = responseText.obj;
					
					if (responseText.success === true) {
						
						$('.comboTipoTelefone').append('<option value="' + obj.id + '">' + obj.nome + '</option>');
						$('.comboTipoTelefone').val("");
						
						$("#tipoTelefoneDialogForm").dialog('close');
					}
					else {
						$("#tipoTelefoneDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('enable');
						
						$("#tipoTelefoneForm").validate().showErrors(responseText.message);
					}
				}
			});
			return false;
		}
	});
	
	
	
	/**
	 * ##############################################################
	 * ###################| FUNÇÕES UTILIDADAS |#####################
	 * ##############################################################
	 */
	
	addEnderecoPessoa = function(arrObjJSON) {
		
		$.each(arrObjJSON, function(k, obj){
			
			var linha	 = $("#enderecosTable tbody tr" ).length * 1;

			$("#enderecosTable tbody").append($(
				"<tr>" +
					"<td class='ui-widget-content'> <input type='hidden' name='enderecos[" + linha + "][tipo_endereco_id]' value='" + obj.tipo_endereco_id + "' />" + obj.tipo_endereco + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='enderecos[" + linha + "][endereco]' value='" + obj.endereco + "'/>" + obj.endereco + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='enderecos[" + linha + "][cidade]' value='" + obj.cidade + "'/>" + obj.cidade + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='enderecos[" + linha + "][uf]' value='" + obj.uf + "'/>" + obj.uf + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='enderecos[" + linha + "][cep]' value='" + obj.cep + "'/>" + obj.cep + "</td>" + 
					"<td class='ui-widget-content'> <span class='ui-icon ui-icon-trash delete' ></span> </td>" + 
				"</tr>" 
			).hide().fadeIn(600)); 
		});
		dispatchEventDeleteTr();
	}
		
	addTelefonePessoa = function(arrObjJSON) {
		
		$.each(arrObjJSON, function(k, obj){
			
			var linha	= $("#telefonesTable tbody tr" ).length * 1;

			$("#telefonesTable tbody").append($(
				"<tr>" +
					"<td class='ui-widget-content'> <input type='hidden' name='telefones[" + linha + "][tipo_telefone_id]' value='" + obj.tipo_telefone_id + "'/>" + obj.tipo_telefone + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='telefones[" + linha + "][ddd]' value='" + obj.ddd + "'/>" + obj.ddd + "</td>" + 
					"<td class='ui-widget-content'> <input type='hidden' name='telefones[" + linha + "][numero]' value='" + obj.numero + "'/>" + obj.numero + "</td>" + 
					"<td class='ui-widget-content'> <span class='ui-icon ui-icon-trash delete' ></span> </td>" + 
				"</tr>" 
			).hide().fadeIn(600)); 
		});

		dispatchEventDeleteTr();		
	}

	function dispatchEventDeleteTr() {
		
		$( '.delete' ).click(function(e){
			var button = e.currentTarget;
			
			$(button).closest('tr').fadeOut(400, function(){
				$(this).remove();
			});
		});
	}

	function getMsgErrorField(type, strField, min, max) {
		
		var msg = "";
		
		switch (type) {
			case "required":
				msg = "Por favor, preencha o campo " + strField + ".";
				break;
			
			case "minlength":
				msg = "O campo " + strField + " precisa ter pelo menos " + min + " digitos.";
				break;
			
			case "maxlength":
				msg = "O campo " + strField + " precisa ter no máximo " + max + " digitos.";
				break;
			
			case "email":
				msg = "Por favor, informe um email válido.";
				break;
			
			default:break;
		}
		return msg;
	}
});