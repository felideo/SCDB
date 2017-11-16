<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Autores</h3>
			<button id="botao_clone_autor" type="button" class="btn btn-primary pull-right" style="margin-top: -25px;">Adicionar Autor</button>
		</div>
		<div class="panel-body">
			<div id="conteiner_clone_autor" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			</div>
			<div id="nenhum_clone_autor_adicionado" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Nenhum Autor Adicionado</label>
			</div>
		</div>
	</div>
</div>

<div id="clonar_autor" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" data-id_clone_autor="$id_clone_autor" style="display: none;">
	<div id="box_clone_autor_$id_clone_autor" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Autor $id_clone_autor</h3>
		</div>
		<div class="panel-body">
			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Autor</label>
			    <br>
			    <input id="autor_$id_clone_autor" class="clone_autor_select_2_$id_clone_autor" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[autor][$id_clone_autor]" style="width: 100%;" disabled>
			</div>

			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Lattes/Site</label>
			    <p id="link_autor_div"></p>
			    <input id="link_$id_clone_autor" type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[site][$id_clone_autor]" value="" disabled>
			</div>

			<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    <label>Email</label>
			    <p id="email_autor_div"></p>
			    <input id="email_$id_clone_autor" type="text" class="form-control" name="<?php echo $this->scope["modulo"]["modulo"];?>[site][$id_clone_autor]" value="" disabled>
			</div>
		</div>
		<div class="panel-footer">
			<button id="remover_clone_autor_$id_clone_autor" type="button" class="btn btn-danger pull-right remove-box">Remover</button>
        	<div class="clearfix"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#botao_clone_autor').on('click', function(){
            var container_clone    = $('#conteiner_clone_autor');
            var id_container_clone = ($("#conteiner_clone_autor > div").length) + 1;


            $('#nenhum_clone_autor_adicionado').hide();

            var clone = $('#clonar_autor').html();
            clone     = clone.replaceAll("$id_clone_autor", id_container_clone);
            clone     = clone.replaceAll("disabled", "", clone);

            container_clone.prepend(clone);

            $('#remover_clone_autor_' + id_container_clone).on('click', function(){
                $('#box_clone_autor_' + id_container_clone).remove();

	            if($("#conteiner_clone_autor > div").length == 0){
            		$('#nenhum_clone_autor_adicionado').show();
	            }
            });

        	atualizar_clone_autor_select_2(id_container_clone);

        });
    });

function atualizar_clone_autor_select_2(id_container_clone){
	$('.clone_autor_select_2_' + id_container_clone).select2({
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
}
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>