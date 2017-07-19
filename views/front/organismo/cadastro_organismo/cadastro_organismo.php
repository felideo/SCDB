<form id="form_submit lazy_view" method="post"
	<?php if(isset($this->action)){ echo 'action="/' . $this->modulo['modulo'] . $this->action . '"'; } ?>
>

<!-- <form id="form_submit" method="post" action="/<?php echo $this->modulo['modulo'] . $this->action; ?>"> -->
	<!-- ******CLASSIFICACAO****** -->
	<?php require 'views/front/organismo/cadastro_organismo/classificacao/classificacao.php'; ?>
	<!--//classificacao-->

	<!-- ******IMAGE UPLOAD****** -->
	<?php
		require 'views/front/organismo/cadastro_organismo/image_upload/image_upload.php';
	?>
	<!--//image upload-->

	<!-- ******DETALHES****** -->
	<?php require 'views/front/organismo/cadastro_organismo/detalhes/detalhes.php'; ?>
	<!--//detalhes-->

	<!-- ******TRABALHOS****** -->
	<?php require 'views/front/organismo/cadastro_organismo/trabalho/trabalho.php'; ?>
	<!--//trabalhos-->

	<!-- ******POSICAO GEOGRAFICA****** -->
	<?php require 'views/front/organismo/cadastro_organismo/posicao_geografica/posicao_geografica.php'; ?>
	<!--//posicao_geografica-->

	<!-- ******ENVIAR****** -->
	<section id="features" class="features section">
	    <div class="container">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginB10">
	        	<button type="buttom" style="margin-top: 13px; float: right;" class="btn btn-lg btn-theme marginL10" onClick="$('#form_submit').submit();">Salvar</button>
	        	<button type="buttom" style="margin-top: 13px; float: right;" class="btn btn-lg btn-theme-cancel marginR10">Cancelar</button>
		    </div>
	    </div>
	</section>
	<!--//enviar-->
</form>