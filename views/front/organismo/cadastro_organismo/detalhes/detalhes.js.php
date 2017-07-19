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


	<?php
		if(isset($this->organismo['organismo_relaciona_nome_popular']) && !empty($this->organismo['organismo_relaciona_nome_popular'])){
			$nomes_populares = [];

			foreach ($this->organismo['organismo_relaciona_nome_popular'] as $indice => $nome_popular) {
				$nomes_populares[] = [
					'id'   => $nome_popular['nome_popular'][0]['id'],
					'nome' => $nome_popular['nome_popular'][0]['nome']
				];
			}

			echo 'var nomes_populares = ' . json_encode($nomes_populares) . ';';
		}
	?>

	console.log(nomes_populares);

	<?php if(isset($this->organismo['organismo_relaciona_nome_popular']) && !empty($this->organismo['organismo_relaciona_nome_popular'])) : ?>
		$('#nomes_populares').select2(
			'data',
			nomes_populares
		);

	<?php endif; ?>
</script>