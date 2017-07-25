<script type="text/javascript">
	 var imagem_manualUploader = new qq.FineUploader({
		element: document.getElementById('fine-uploader-manual-trigger'),
		validation: {
			allowedExtensions: ["jpeg", "jpg"],
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
		debug: false,
		callbacks: {
			onSubmit: function (id, fileName) {
	            var local = {
					local: 'imagens'
				}

	            this.setParams(local);
		    },
			onComplete: function(id, name, retorno, maybeXhr) {

				console.log(retorno);

				var id = typeof $(".carousel-indicators li").last().data('slide-to') !== 'undefined' ? $(".carousel-indicators li").last().data('slide-to') + 1 : 0;

				// console.log(retorno['endereco']);

				$('#myCarousel').show();
				$('#ser_vivo_imagens').prepend('<div class="item" data-id="' + retorno['id'] + '"><img src="/' + retorno['endereco'] + '"  alt="" /></div>');
				$('#ser_vivo_imagens_indicadores').prepend('<li data-target="#myCarousel" data-slide-to="' + retorno['id'] + '"></li>');

				input = '<div>\n\t\t'
					+ '<input type="hidden" value="' + retorno['id'] + '" name="imagens[' + $("#image_inputs > div").length + ']" />\n\t\t'
					+ '</div>\n';



				$('#image_inputs').append(input);

				$('#ser_vivo_imagens div').each(function(){
		 			$(this).removeClass('active');
				});

				$('#ser_vivo_imagens_indicadores li').each(function(){
		 			$(this).removeClass('active');
				});

				$('#ser_vivo_imagens div:first').addClass('active');
				$('#ser_vivo_imagens_indicadores li:first').addClass('active');


				$("#myCarousel").carousel("pause").removeData();
				$("#myCarousel").carousel(retorno['id']);

				// setTimeout(function(){
				//   	$('#1_remove').remove();
				// 	$('#2_remove').remove();
				// }, 3000);
			}
		}
	});

	// qq(document.getElementById("trigger-upload")).attach("click", function() {
	// 	manualUploader.uploadStoredFiles();
	// });

	qq($('#fine-uploader-manual-trigger #trigger-upload').on('click', function(){
		imagem_manualUploader.uploadStoredFiles();
	}));


</script>