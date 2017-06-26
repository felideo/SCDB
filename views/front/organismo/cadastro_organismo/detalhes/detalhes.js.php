<script type="text/javascript">
	$('#nomes_populares').select2({
		placeholder: $(this).data('placeholder'),
		multiple: true,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/organismo/buscar_nome_popular_select2",
			dataType: 'json',
			data: function(term) {
				return {
					busca: {
						nome: term,
						page_limit: 10,
						cadastrar_busca: true
					}
				};
			},
			results: function(data) {
			console.log(data);

				return {
					results: data
				};
			}
		},
		formatResult: function(object) {
			return object.nome
		},
		formatSelection: function(object) {
			return object.nome.replace_all('Cadastrar ', '')
		}
	});

</script>