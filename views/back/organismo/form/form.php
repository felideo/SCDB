<form id="form_submit lazy_view" class="lazy_view" method="post"
	<?php if(isset($this->action)) : ?>
        action="/<?php echo $this->modulo['modulo'] . $this->action; ?>"
    <?php endif ?>
>

	<input name="redirect" type="hidden" value="/organismo/index">


	<!-- ******CLASSIFICACAO****** -->
	<?php require 'views/back/organismo/form/classificacao/classificacao.php'; ?>
	<!--//classificacao-->

	<!-- ******IMAGE UPLOAD****** -->
	<?php // require 'views/back/organismo/form/image_upload/image_upload.php';	?>
	<!--//image upload-->

	<!-- ******DETALHES****** -->
	<?php require 'views/back/organismo/form/detalhes/detalhes.php'; ?>
	<!--//detalhes-->

	<!-- ******TRABALHOS****** -->
	<?php // require 'views/back/organismo/form/trabalho/trabalho.php'; ?>
	<!--//trabalhos-->

	<!-- ******POSICAO GEOGRAFICA****** -->
	<?php // require 'views/back/organismo/form/posicao_geografica/posicao_geografica.php'; ?>
	<!--//posicao_geografica-->

	<!-- ******ENVIAR****** -->
	<section id="features" class="features section">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginB10">
    	        <button type="submit" class="btn btn-success" style="float: right;margin-bottom: 15px;">
		            <?php if(isset($this->organismo)) : ?>
		                Editar <?php echo $this->modulo['send']; ?>
		            <?php else : ?>
		                Cadastrar Novo <?php echo $this->modulo['send']; ?>
		            <?php endif?>
		        </button>

		        <button type="button" class="btn btn btn-danger voltar" style="float: right;margin-right: 10px; <?php if(!isset($this->organismo)){ echo 'display: none;';} ?>">
		            <?php if(isset($this->organismo)) : ?>
		                Cancelar
		            <?php else : ?>
		                Voltar
		            <?php endif?>
		        </button>
		    </div>
	</section>
	<!--//enviar-->
</form>