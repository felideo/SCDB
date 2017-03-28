<script type="text/javascript">
	$('.taxonomy_search').select2({
		placeholder: $(this).data('placeholder'),
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/taxon/buscar_taxonomia_select2",
			dataType: 'json',
			data: function(term) {
				return {
					busca: {
						nome: term,
						id_taxonomia: $(this).data("id_taxonomia"),
						// id_ascendente: $(this).data('id_ascendente'),
						page_limit: 10
					}
				};
			},
			results: function(data) {
				return {
					results: data
				};
			}
		},
		formatResult: function(object) {
			return object.classificacao_nome
		},
		formatSelection: function(object) {
			return object.classificacao_nome.replace_all('Cadastrar Nova Taxonomia: ', '')
		}
	});


	 $(document).ready(function() {

	 	var busca;

        $('.taxonomy_search').on('change', function() {
            var id_taxon = $(this).val();
            var id_taxonomia = $(this).data('id_taxonomia');

            $.each($('.taxonomy_search'), function(index, item) {

                console.log($(this).data('id_taxonomia'));

                if ($(this).data('id_taxonomia') > id_taxonomia) {
                    $(this).select2('val', '');
                }
            });

            $.ajax({
                type: 'POST',
                url: "/taxon/buscar_hierarquia_ajax",
                data: {
                    id_clado: $(this).val(),
                },
                dataType: 'json',
                async: false,
                success: function(dados) {
                    busca = dados;

                    $.each(dados, function(index, item) {
                        $('#' + item['index']).select2(
                            'data', {
                                id: item['id'],
                                classificacao_nome: item['classificacao_nome']
                            }
                        );
                    });

                }
            });

            if($('#genero').select2('data')){
            	var genero = $('#genero').select2('data')['classificacao_nome'];
			}else{
				var genero = 'replace'
			}

			if($('#especie').select2('data')){
            	var especie = $('#especie').select2('data')['classificacao_nome'];
			}else{
				var especie = 'replace'
			}

			if($('#subespecie').select2('data')){
            	var subespecie = $('#subespecie').select2('data')['classificacao_nome'];
			}else{
				var subespecie = 'replace'
			}

			subespecie = subespecie.replace_all(especie, '');
			genero     = genero.replace_all('replace', '');
			especie    = especie.replace_all(genero, '');

			var nome_binominal = (genero + ' ' + especie + ' ' + subespecie);

			console.log(nome_binominal);

			nome_binominal =  nome_binominal.replace_all('undefined', '').replace_all('Cadastrar Nova Taxonomia: ', '');

			nome_binominal = nome_binominal.replace_all('replace', '');

			nome_binominal = nome_binominal.replace_all('Cadastrar', '');

			console.log(nome_binominal);

        	$('#nome_binominal').html(nome_binominal);

        	buscar_trabalhos(busca);
        	delete busca;


        });
	});
</script>