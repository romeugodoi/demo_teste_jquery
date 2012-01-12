$(document).ready(function() {

	/**
	 * ##############################################################
	 * #################| FUNÇÃO DE ACOES DA GRID |################## 
	 * ##############################################################
	 */
	var doCommand = function(com, grid) {

		if ( (com == 'Editar' || com == 'Deletar') &&  $('.trSelected', grid).length < 1) {
			alertDialog('Você precisa selecionar um registro primeiro!');
		}
		
		if (com == 'Adicionar') {
			
			$( "#pessoaDialogForm" ).dialog( "open" );
		}
		else if (com == 'Editar') {
			
			$('.trSelected', grid).each(function() {
				var id = $(this).attr('id');
				id = id.substring(id.lastIndexOf('row')+3);
				
				$.getJSON('/index.php/pessoa/retrieve?id=' + id, function(obj) {
					
					loadForm('pessoaForm', 'pessoa', obj);
					
					if (obj.enderecos !== undefined)
						addEnderecoPessoa(obj.enderecos);
					
					if (obj.telefones !== undefined)
						addTelefonePessoa(obj.telefones);
				
					$( "#pessoaDialogForm" ).dialog( "open" );
				});				
			});
		} 
		else if (com == 'Deletar') {
			
			$('.trSelected', grid).each(function() {
				var id = $(this).attr('id');
				id = id.substring(id.lastIndexOf('row')+3);
				
				confirmDialog("Deletar registro?", function() {
					$.ajax({
						url: '/index.php/pessoa/delete',
						dataType: 'json',
						data: "id=" + id, 

						success: function(data) {
							if (data.success === true) {
								showInfoMessage(data.message);
							}
							$('#pessoasList').flexReload();
						}, 
						error: function (jqXHR, textStatus, errorThrown) {
							alertDialog("A requisição falhou: " + errorThrown);
						}
					});
				});
			});
		}
	};
	
	
	/**
	 * ##############################################################
	 * ###################| DEFINICAO DA GRID |###################### 
	 * ##############################################################
	 */
	
	$("#pessoasList").flexigrid({
		url: '/index.php/pessoa/list',
		dataType: 'json',
		colModel : [
			{display: 'ID',     name: 'id',    width: 40,  sortable : true, align: 'center'},
			{display: 'Nome',   name: 'nome',  width: 300, sortable : true, align: 'left'},
			{display: 'E-mail', name: 'email', width: 321, sortable : true, align: 'left'},
		],
		buttons : [
			{name: 'Adicionar', bclass: 'add',    onpress: doCommand},
			{name: 'Editar',    bclass: 'edit',   onpress: doCommand},
			{name: 'Deletar',   bclass: 'delete', onpress: doCommand},
			{separator: true}
		],
		searchitems : [
			{display: 'Nome', name : 'nome', isdefault: true}
		],
		sortname: "nome",
		sortorder: "asc",
		usepager: true,
		page: 1,
		title: 'Pessoas',
		useRp: true,
		rp: 10,
		showTableToggleBtn: true,
		width: 700,
		height: "auto", 
		singleSelect: true
	});



	/**
	 * ##############################################################
	 * #################| DEFINICAO DAS JANELAS |####################
	 * ##############################################################
	 */
	
	/** #####| Pessoa - Dialog |##### */
	
	$("#pessoaDialogForm").dialog({
		autoOpen: false,
		height: "auto",
		width: 600,
		modal: true,
		buttons: {
			"Salvar": function() { 
				$("#pessoaForm").submit(); 
			},
			Cancelar: function() { 
				$(this).dialog('close'); 
			}
		},
		close: function() {
			$("#pessoaDialogForm ~ .ui-dialog-buttonpane button:nth-child(1)").button('enable');
			$('#pessoaForm').validate().resetForm();
			
			$("#enderecosTable tbody").empty();
			$("#telefonesTable tbody").empty();
		}
	});

	/** #####| Endereço - Dialog |##### */
	
	$("#enderecoDialogForm").dialog({
		autoOpen: false,
		height: "auto",
		width: 300,
		modal: true,
		buttons: {
			"Salvar": function() { 
				$("#enderecoForm").submit(); 
			},
			Cancelar: function() { 
				$(this).dialog('close'); 
			}
		},
		close: function() {
			$("#enderecoForm").validate().resetForm(); 
		}
	});
	
	/** #####| Telefone - Dialog |##### */

	$("#telefoneDialogForm").dialog({
		autoOpen: false,
		height: "auto",
		width: 300,
		modal: true,
		buttons: {
			"Salvar": function() { 
				$("#telefoneForm").submit(); 
			},
			Cancelar: function() { 
				$(this).dialog('close'); 
			}
		},
		close: function() {
			$("#telefoneForm").validate().resetForm(); 
		}
	});
	
	/** #####| Tipo Endereco - Dialog |##### */

	$("#tipoEnderecoDialogForm").dialog({
		autoOpen: false,
		height: "auto",
		width: 200,
		modal: true,
		buttons: {
			"Salvar": function() { 
				$("#tipoEnderecoForm").submit(); 
			},
			Cancelar: function() { 
				$(this).dialog('close'); 
			}
		},
		close: function() {
			$("#tipoEnderecoForm").validate().resetForm(); 
		}
	});
	
	/** #####| Tipo Telefone - Dialog |##### */

	$("#tipoTelefoneDialogForm").dialog({
		autoOpen: false,
		height: "auto",
		width: 200,
		modal: true,
		buttons: {
			"Salvar": function() { 
				$("#tipoTelefoneForm").submit(); 
			},
			Cancelar: function() { 
				$(this).dialog('close'); 
			}
		},
		close: function() {
			$("#tipoTelefoneForm").validate().resetForm(); 
		}
	});


	/**
	 * ##############################################################
	 * ####################| ACOES CLICK |###########################
	 * ##############################################################
	 */
	
	$( "#btnAddPessoa" ).button().click(function(){
		$( "#pessoaDialogForm" ).dialog( "open" );
	});

	
	$( "#btnAddEndereco" ).button().click(function(){
		$( "#enderecoDialogForm" ).dialog( "open" );
	});
	
	$( "#btnAddTelefone" ).button().click(function(){
		$( "#telefoneDialogForm" ).dialog( "open" );
	});
	
	$( "#addTipoEndereco" ).click(function(){
		$( "#tipoEnderecoDialogForm" ).dialog( "open" );
	});
	
	$( "#addTipoTelefone" ).click(function(){
		$( "#tipoTelefoneDialogForm" ).dialog( "open" );
	});
	
	

	
	/**
	 * ##############################################################
	 * ################| DEFINICAO CSS AUTO |########################
	 * ##############################################################
	 */
	
	$( "input:not(:submit, :reset), select, textarea" ).addClass('text ui-widget-content ui-corner-all');



	/**
	 * ##############################################################
	 * #######################| MASCARAS |###########################
	 * ##############################################################
	 */

	$(".cep").mask("99999-999");
	$(".fone").mask("9999-9999");	
	$(".ddd").mask("99");	
	
	
	
	/**
	 * ##############################################################
	 * #########################| TABS |#############################
	 * ##############################################################
	 */
		
	$( "#tabs" ).tabs({
		select: function(event, ui) {
			return $("#pessoaForm").valid();
		}
	});
});