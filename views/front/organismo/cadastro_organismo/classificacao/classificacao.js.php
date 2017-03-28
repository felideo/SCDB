<script type="text/javascript">
	$('.taxonomy_search').select2({
		placeholder: $(this).data('placeholder'),
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/taxon/buscar_taxon_select2",
			dataType: 'json',
			data: function(term) {
				return {
					busca: {
						nome: term,
						id_classificacao: $(this).data("id_classificacao"),
						id_ascendente: $(this).data('id_ascendente'),
						page_limit: 10,
						cadastrar_busca: true
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
			return object.nome
		},
		formatSelection: function(object) {
			return object.nome.replace_all('Cadastrar ', '')
		}
	});


	 $(document).ready(function() {
        $('.taxonomy_search').on('change', function() {
            var id_taxon = $(this).val();
            var id_classificacao = $(this).data('id_classificacao');

            $.each($('.taxonomy_search'), function(index, item) {
                if ($(this).data('id_classificacao') > id_classificacao) {
                    $(this).select2('val', '');
                }
            });

            $.ajax({
                type: 'POST',
                url: "/taxon/buscar_ascendencia_ajax",
                data: {
                    id_ascendente: $(this).val(),
                },
                dataType: 'json',
                async: false,
                success: function(dados) {

                    console.log(dados);

                    $.each(dados, function(index, item) {
                        $('#' + item['index']).select2(
                            'data', {
                                id: item['id'],
                                nome: item['nome']
                            }
                        );
                    });
                }
            });

            preencher_nome_binominal();

        });
	});

	function preencher_nome_binominal(){
		if($('#genero').select2('data')){
        	var genero = $('#genero').select2('data')['nome'];
		}else{
			var genero = 'replace'
		}

		if($('#especie').select2('data')){
        	var especie = $('#especie').select2('data')['nome'];
		}else{
			var especie = 'replace'
		}

		if($('#subespecie').select2('data')){
        	var subespecie = $('#subespecie').select2('data')['nome'];
		}else{
			var subespecie = 'replace'
		}

		subespecie = subespecie.replace_all(especie, '');
		especie    = especie.replace_all(genero, '');
		genero     = genero.replace_all('replace', '');

		var nome_binominal = (genero + ' ' + especie + ' ' + subespecie);
		nome_binominal =  nome_binominal.replace_all('undefined', '').replace_all('Novo Taxon: ', '').replace_all('replace', '').replace_all('Cadastrar', '');

    	$('#nome_binominal').html(nome_binominal);
    }

</script>