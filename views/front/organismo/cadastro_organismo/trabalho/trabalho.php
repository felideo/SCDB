<section id="features" class="features section">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginB10">
        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	            <h2 class="title">Trabalhos</h2>
	        </div>
        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	            <button type="button" class="btn btn-primary modal-trigger green_buttom" data-toggle="modal" data-target="#add_trabalho_modal" style="float: right; margin-top: 18px;">
                    <i class="fa fa-plus-circle"></i> Adicionar Trabalho
                </button>
	        </div>
	    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginT10">
            <div id="trabalho_conteiner" class="container"></div>
        </div>
    </div>
</section>

<!-- ******MODAL TRABALHO****** -->
<?php require 'views/front/organismo/cadastro_organismo/trabalho/modal_trabalho.php'; ?>
<!--//modal trabalho-->