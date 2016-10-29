<script type="text/javascript">
	$('#buscar_cep').keyup(function(){
		if($('#buscar_cep').val().length != 9){
			return false;
		}

		var cep;
		var url;

		cep = $('#buscar_cep').val().replace('-', '');
		url = "http://api.postmon.com.br/v1/cep/" + cep

		$.getJSON(url,function(data){
			$('#rua').val(data.logradouro);
			$('#bairro').val(data.bairro);
			$('#cidade').val(data.cidade);
			$('#uf').val(data.estado);
	    });
	});

	$('#data_nascimento').datetimepicker({
        sideBySide: true,
        debug: false,
        format: 'DD/MM/YYYY',
        widgetPositioning: {
        	horizontal: 'auto',
            vertical: 'bottom'
        }
    });

    $('#data_nascimento').keydown(function(){
    	swal("Erro", "Selecione uma data no calendario a baixo!", "error");
			$('#data_nascimento').val('');
    });

</script>