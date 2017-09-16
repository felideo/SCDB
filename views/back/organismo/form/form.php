<form id="form_submit lazy_view" class="lazy_view" method="post"
	<?php if(isset($this->action)) : ?>
        action="/<?php echo $this->modulo['modulo'] . $this->action; ?>"
    <?php endif ?>
>

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
	    <div class="container">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginB10">
	        	<button type="buttom" style="margin-top: 13px; float: right;" class="lazy_view_remove btn btn-lg btn-theme marginL10" onClick="$('#form_submit').submit();">Salvar</button>
	        	<button type="buttom" style="margin-top: 13px; float: right;" class="lazy_view_remove btn btn-lg btn-theme-cancel marginR10">Cancelar</button>
		    </div>
	    </div>
	</section>
	<!--//enviar-->
</form>