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

	// $('.validar_email').change(function(){
	// 	if (validar_email($('.validar_email').val())) {
	// 		alert("E-Mail Valido!");
	// 	} else {
	// 		alert("Digite um e-mail valido");
	// 	}
	// });

	// function validar_email(email){
	// 	var str = email;
	// 	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	// 	if(filtro.test(str)) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

</script>