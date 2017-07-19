<script type="text/javascript">
	$('#taxonomy_search').select2({
		placeholder: $(this).data('placeholder'),
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/busca/buscar_taxonomia_select2",
			dataType: 'json',
			data: function(term) {
				return {
					busca: {
						nome: term,
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
			return object.nome
		},
		formatSelection: function(object) {
			return object.nome
		}
	});

	$('#nome_popular_search').select2({
		placeholder: $(this).data('placeholder'),
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/busca/buscar_nome_popular_select2",
			dataType: 'json',
			data: function(term) {
				return {
					busca: {
						nome: term,
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
			return object.nome
		},
		formatSelection: function(object) {
			return object.nome
		}
	});


	$('#numero_petalas').select2();

	$('#numero_estames').select2();
	$('#forma_folha').select2();






	 $(document).ready(function() {
        $('#taxonomy_search, #nome_popular_search, #numero_petalas, #numero_estames, #forma_folha').on('change', function() {
            var id_taxon        = $('#taxonomy_search').val();
            var id_nome_popular = $('#nome_popular_search').val();
            var numero_petalas  = $('#numero_petalas').val();
            var numero_estames  = $('#numero_estames').val();
            var forma_folha     = $('#forma_folha').val();

            $.ajax({
                type: 'POST',
                url: "/busca/efetuar_busca",
                data: {
                    busca: {
                    	'id_taxon'  	 : id_taxon,
                    	'id_nome_popular': id_nome_popular,
                    	'numero_petalas' : numero_petalas,
						'numero_estames' : numero_estames,
                    }
                },
                dataType: 'json',
                async: false,
                success: function(dados) {
                	console.log(dados);

			        $('#resultado_conteiner').html('');


                    $.each(dados, function(index, item) {
                    	console.log(item);

						var id = $("#resulado_conteiner > div").length;

						var resultado = ''
							+ ' <div id="id_resultado_' + item['id'] + '" class="item col-md-3 col-sm-6 col-xs-12 text-center" data-id_resultado="' + item['id'] + '">\n\t'
			                + '     <div class="icon">\n\t\t'
			                + '         <i class="fa fa-leaf"></i>\n\t'
			                + '     </div>\n'
			                + '     <div class="content">\n\t'
			                + '         <h3 class="title">' + item['nome'] + '</h3>\n\t'
			                + '         <p class=short_description>' + item['descricao'].substr(0, 144) + '</p>\n\t'

			                + '         <a href="/organismo/visualizacao/' + item['id'] + '" class="btn btn-link">Abrir</a>\n'
			                + '     </div>\n'
			                + ' </div>\n';

			            $('#resultado_conteiner').append(resultado);
                    });
                }
            });
        });
	});
</script>