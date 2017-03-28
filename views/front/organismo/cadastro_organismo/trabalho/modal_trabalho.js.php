<script type="text/javascript">
	$('input[type=radio][name=tipo_trabalho]').change(function() {
  		if($('input[type=radio][name=tipo_trabalho]:checked').val() == 'upload'){
  			$('#upload_trabalho').show();
			$('#link_trabalho').hide();
  		}else{
  			$('#upload_trabalho').hide();
			$('#link_trabalho').show();
  		}
	});

	 var trabalho_manualUploader = new qq.FineUploader({
		element: document.getElementById('upload_trabalho_trigger'),
		validation: {
			allowedExtensions: ["pdf"],
			sizeLimit: 50000000
		},
		template: 'qq-template-manual-trigger',
		request: {
			endpoint: "/ajax_upload/upload/",
		},
		thumbnails: {
			placeholders: {
				waitingPath: '/public/fineuploader/placeholders/waiting-generic.png',
				notAvailablePath: '/public/fineuploader/placeholders/not_available-generic.png'
			}
		},
		uploadSuccess: {
	        endpoint: '/s3/success'
	    },
		autoUpload: false,
		debug: true,
		multiple: false,
		callbacks: {
			onSubmit: function (id, fileName) {
	            var local = {
					local: 'trabalhos'
				}

	            this.setParams(local);
		    },
			onComplete: function(id, name, retorno, maybeXhr) {
				console.log(retorno);

				$('#id_arquivo').val(retorno['id']);

				// input = '<div>\n\t\t'
				// 	+ '<input type="hidden" value="' + retorno['id'] + '" name="imagens[' + $("#image_inputs > div").length + ']" />\n\t\t'
				// 	+ '</div>\n';


			}
		}
	});

	qq($('#upload_trabalho_trigger #trigger-upload').on('click', function(){
		trabalho_manualUploader.uploadStoredFiles();
	}));

	$(document).ready(function(){
		$('#add_trabalho').on('click', function(){
			var id = $("#trabalho_conteiner > div").length;

			var trabalho = ''
				+ ' <div id="id_trabalho_' + id + '" class="item col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center" data-id_trabalho="' + id + '">\n\t'
                + '     <div class="icon">\n\t\t'
                + '         <i id="icone_tipo_trabalho_' + id + '" class="fa"></i>\n\t'
                + '     </div>\n'
                + '     <div class="content">\n\t'
                + '         <h3 class="title">leroelro leorler leorleor </h3>\n\t'
                + '         <p class=short_description>Primeiros 144 caracteres do Resumo do trabalho</p>\n\t'
                + '         <button type="button" class="remover_trabalho btn btn-link" data-id_trabalho="' + id + '"><i class="fa fa-close"></i> Remover</button>\n'
                + '     </div>\n'
                + ' </div>\n';

            $('#trabalho_conteiner').append(trabalho);

            $('#id_trabalho_' + id + " .short_description").html();


			$('#add_trabalho_modal :input').each(function(){
		 		if (typeof $(this).attr('name') !== 'undefined' && $(this).val() != '') {
		 			if($(this).attr('name') == 'titulo'){
            			$('#id_trabalho_' + id + " .title").html($(this).val());
		 			}

		 			if($(this).attr('name') == 'resumo'){
            			$('#id_trabalho_' + id + " .short_description").html(($(this).val()).substring(0,256));
		 			}



		 			console.log($(this).val() == 'link' && $(this).is(':checked') != 0);

		 			if($(this).attr('name') == 'tipo_trabalho'){

		 				console.log('#icone_tipo_trabalho_' + id);

		 				if($(this).val() == 'link' && $(this).is(':checked') != 0){
            				$('#icone_tipo_trabalho_' + id).addClass('fa-link');
			 			}else if($(this).val() == 'upload' && $(this).is(':checked') != 0){
	            			$('#icone_tipo_trabalho_' + id).addClass('fa-file-pdf-o');
			 			}
		 			}

		 			var input = '<input id="' + $(this).attr('name') + '_' + id + '" name="trabalho[' + id + '][' + $(this).attr('name') + ']" value="' + $(this).val() + '">'
		 			$('#id_trabalho_' + id + ' .content').append(input);

		 			$(this).val('');
		 			$(this).select2('val', '');
				}
			});

 			$('.modal').modal('toggle');

			$('.remover_trabalho').on('click', function(){
				console.log($(this).data('id_trabalho'));
				$('#id_trabalho_' + id).remove();
			});
		});

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

	});

	$('#autor').select2({
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/autor/buscar_autor_select2",
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

	$('#idioma').select2({
		placeholder: $(this).data('placeholder'),
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/idioma/buscar_idioma_select2",
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

	$('#palavra_chave').select2({
		placeholder: $(this).data('placeholder'),
		multiple: true,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/palavra_chave/buscar_palavra_chave_select2",
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


	// 	document.getElementById("trigger-upload")).attach("click", function() {
	// });
</script>

</script>