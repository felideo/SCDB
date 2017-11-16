<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Orientadores</h3>
			<button id="botao_clone_orientador" type="button" class="btn btn-primary pull-right" style="margin-top: -25px;">Adicionar Orientador</button>
		</div>
		<div class="panel-body">
			<div id="conteiner_clone_orientador" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			</div>
			<div id="nenhum_clone_orientador_adicionado" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Nenhum Orientador Adicionado</label>
			</div>
		</div>
	</div>
</div>

<div id="clonar_orientador" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" data-id_clone_orientador="$id_clone_orientador" style="display: none;">
	<div id="box_clone_orientador_$id_clone_orientador" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Orientador $id_clone_orientador</h3>
		</div>
		<div class="panel-body">
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Orientador</label>
			    <br>
<<<<<<< HEAD
			    <input id="orientador_$id_clone_orientador" class="clone_orientador_select_2_$id_clone_orientador" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[orientador][$id_clone_orientador][orientador]" style="width: 100%;" required disabled>
=======
			    <input id="orientador_$id_clone_orientador" class="clone_orientador_select_2_$id_clone_orientador" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[orientador][$id_clone_orientador]" style="width: 100%;" disabled>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
			</div>

			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Lattes/Site</label>
<<<<<<< HEAD
			    <input id="link_orientador_$id_clone_orientador" type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[orientador][$id_clone_orientador][site]" value="" disabled>
=======
			    <p id="link_orientador_div"></p>
			    <input id="link_$id_clone_orientador" type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[site][$id_clone_orientador]" value="" disabled>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
			</div>

			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Email</label>
<<<<<<< HEAD
			    <input id="email_orientador_$id_clone_orientador" type="text" class="form-control validar_email" name="<?php echo $this->scope["modulo"]["modulo"];?>[orientador][$id_clone_orientador][email]" value="" disabled>
			</div>
		</div>
		<div class="panel-footer">
			<button id="remover_clone_orientador_$id_clone_orientador" type="button" class="btn btn-danger pull-right remove-box">Remover Orientador</button>
=======
			    <p id="email_orientador_div"></p>
			    <input id="email_$id_clone_orientador" type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[site][$id_clone_orientador]" value="" disabled>
			</div>
		</div>
		<div class="panel-footer">
			<button id="remover_clone_orientador_$id_clone_orientador" type="button" class="btn btn-danger pull-right remove-box">Remover</button>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
        	<div class="clearfix"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#botao_clone_orientador').on('click', function(){
<<<<<<< HEAD
           clone_orientador_box();
      	});
    });

function clone_orientador_box(){
	 var container_clone    = $('#conteiner_clone_orientador');
=======
            var container_clone    = $('#conteiner_clone_orientador');
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
            var id_container_clone = ($("#conteiner_clone_orientador > div").length) + 1;


            $('#nenhum_clone_orientador_adicionado').hide();

            var clone = $('#clonar_orientador').html();
            clone     = clone.replaceAll("$id_clone_orientador", id_container_clone);
            clone     = clone.replaceAll("disabled", "", clone);

            container_clone.prepend(clone);

            $('#remover_clone_orientador_' + id_container_clone).on('click', function(){
                $('#box_clone_orientador_' + id_container_clone).remove();

	            if($("#conteiner_clone_orientador > div").length == 0){
            		$('#nenhum_clone_orientador_adicionado').show();
	            }
            });

<<<<<<< HEAD
        	atualizar_clone_orientador_select_2(id_container_clone);

}
=======
            atualizar_clone_orientador_select_2(id_container_clone);
        });
    });
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!

function atualizar_clone_orientador_select_2(id_container_clone){
	$('.clone_orientador_select_2_' + id_container_clone).select2({
		multiple: false,
		minimumInputLength: 2,
		ajax: {
			type: 'POST',
			url: "/orientador/buscar_orientador_select2",
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
<<<<<<< HEAD
			console.log(object);


			return object.nome
		},
		formatSelection: function(object) {
			if(object.email != ''){
				$('#email_orientador_' + id_container_clone).val(object.email);
			}else{
				$('#email_orientador_' + id_container_clone).html('Não cadastrado.');
			}

			if(object.link != ''){
				$('#link_orientador_' + id_container_clone).val(object.link);
			}else{
				$('#link_orientador_' + id_container_clone).html('Não cadastrado.');
			}



			if($.isNumeric(object.id)) {
				$('#email_orientador_' + id_container_clone).attr('readonly', true);
				$('#link_orientador_' + id_container_clone).attr('readonly', true);
			}else{
				$('#email_orientador_' + id_container_clone).removeAttr('readonly');
				$('#link_orientador_' + id_container_clone).removeAttr('readonly');
			}

			return object.nome.replace_all('Cadastrar ', '')
		}
	});

	$('.validar_email').change(function(){
		if($('.validar_email').val() == ''){
			return false;
		}

		if (!validar_email($('.validar_email').val())) {
			swal("Erro", "Digite um email válido!", "error");
			$('.validar_email').val('');
		}
	});
}


<?php if (((isset($this->scope["cadastro"]["trabalho_relaciona_orientador"]) ? $this->scope["cadastro"]["trabalho_relaciona_orientador"]:null) !== null) && ! empty($this->scope["cadastro"]["trabalho_relaciona_orientador"])) {
?>

	var orientadores = <?php echo json_encode((isset($this->scope["cadastro"]["trabalho_relaciona_orientador"]) ? $this->scope["cadastro"]["trabalho_relaciona_orientador"]:null));?>;

	$.each(orientadores, function(index, item){
		id_container_clone = index + 1;

		var orientador = item['orientador'][0];

		clone_orientador_box();

	    $('#orientador_' + id_container_clone).select2(
	        'data', {
	            id: orientador['id'],
	            nome: orientador['nome']
	        }
	    );

		$('#link_orientador_' + id_container_clone).val(orientador['link']);
		$('#email_orientador_' + id_container_clone).val(orientador['email']);
    });
<?php 
}?>



=======
			return object.nome
		},
		formatSelection: function(object) {
			return object.nome.replace_all('Cadastrar ', '')
		}
	});
}

>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>