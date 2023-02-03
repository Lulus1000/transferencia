$(document).ready(
	function() {
		$("input[name='radiocpfcnpj'").checkboxradio({
			icon : false
	    });

	    $(".controlgroup").controlgroup();

	    $("#cpfcnpj").mask('99.999.999/9999-99');

	    $("input[name='radiocpfcnpj'").on("change", function(e) {
			if (e.target.id === 'radiocpf') {
				$("#cpfcnpj").mask('999.999.999-99');
				$("#cpfcnpj").attr('placeholder', 'Informe o CPF');
			} else if (e.target.id === 'radiocnpj') {
				$("#cpfcnpj").mask('99.999.999/9999-99');
				$("#cpfcnpj").attr('placeholder', 'Informe o CNPJ');
			}
	    });

	    /**
	     * Rotina para setar o id da pessoa no login É disparada no evento
	     * onBlur do input cpf/cnpj do login
	     */

	    $('#cpfcnpj').blur(
		    function() {

				var cpfcnpj = $('#cpfcnpj').val().replace(/[^\d]+/g, '');
				
				if (cpfcnpj != "") {
					$('#senha').addClass('loading');
					$('#cpfcnpj').removeClass('error');
					$('#cpfcnpj').removeClass('check');
					$.ajax({
						type : 'GET',
						url : (baseUrl() + "/pessoas-ajax/pessoas/" + cpfcnpj),
						dataType : "json",
						success : function(data) {
							$('#senha').removeClass('loading');
							// alert(data);
							if (data != "") {
							$('#pessoas_id').val(data[0].id);
							$('#cpfcnpj').addClass('check');
							} else {
							$('#cpfcnpj').addClass('error');
							}
						},
						error : function(XMLHttpRequest, textStatus,
							errorThrown) {
							console.log(textStatus);
							$('#senha').removeClass('loading');
							$('#cpfcnpj').addClass('error');
						}
					})
				} else {
					$('#cpfcnpj').addClass('error');
				}
		    });

	    /*
	     * Fim da rotina
	     */

	    /**
	     * Rotina para informar uma pessoa no momento de cadastrar um
	     * usuário.
	     */
	    $("#pessoa").autocomplete({
			source : function(request, response) {
			    $.ajax({
				type : 'get',
				url : baseUrl() + "/pessoas-fisicas-ajax/pessoas-fisicas/"
					+ $("#pessoa").val(),
				dataType : "json",
				data : {
				    term : request.term
				},
				success : function(data) {
				    response(data);
				}
			    });
			},
			minLength : 2,
			select : function(event, ui) {
			    $("#pessoas_id").val(ui.item.id);
			}
		});

	    /**
	     *  Rotina para colocar/retira mascara no campo de consulta de pessoas físicas
	    */
	    function setMask(){
	        if($("#usuarios_campo_consulta").val() == "PessoasFisicas.cpf"){
	            $("#usuarios_valor_consulta").mask("999.999.999-99");
	        } else if($("#usuarios_campo_consulta").val() == "PessoasJuridicas.cnpj"){
	            $("#usuarios_valor_consulta").mask("99.999.999/9999-99");
	        } else if($("#usuarios_campo_consulta").val() == "usuarios.inscricao_municipal"){
	            $("#usuarios_valor_consulta").mask("999999-9");
	        } else{
	            $("#usuarios_valor_consulta").unmask();
	        }
	    }

	    $("#usuarios_campo_consulta").change(function(){
	        setMask();
	    });

	    //Carrega iniciamente a mascara para o campo de consulta
		setMask();
		
		/**
		 * Mascaras dinamicas para cpf/cnpj, 
		 */
		$(".cpf-cnpj").inputmask({
			mask: ['999.999.999-99', '99.999.999/9999-99'],
			keepStatic: true
		});
});
