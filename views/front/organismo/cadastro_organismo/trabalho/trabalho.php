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
            <div id="trabalho_conteiner" class="container">
                <?php
                    if(isset($this->organismo['organismo']['organismo_relaciona_trabalho'][0]) && !empty(isset($this->organismo['organismo']['organismo_relaciona_trabalho'][0]))){
                        foreach ($this->organismo['organismo']['organismo_relaciona_trabalho']['trabalho'] as $indice => $trabalho) {
                            if(!is_numeric($indice)){
                                continue;
                            }

                            debug2($indice);
                            $div_trabalho = ''
                                + " <div id='id_trabalho_" . $indice . "' class='item col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center' data-id_trabalho='" . $indice . "'>\n\t"
                                + "     <div class='icon'>\n\t\t"
                                + "         <i id='icone_tipo_trabalho_' class='fa'></i>\n\t"
                                + "     </div>\n"
                                + "     <div class='content'>\n\t"
                                + "         <h3 class='title'>leroelro leorler leorleor </h3>\n\t"
                                + "         <p class=short_description>Primeiros 144 caracteres do Resumo do trabalho</p>\n\t"
                                + "         <button type='button' class='remover_trabalho btn btn-link' data-id_trabalho=''><i class='fa fa-close'></i> Remover</button>\n"
                                + "     </div>\n"
                                + " </div>\n";

                                debug2($div_trabalho);
                        }
                    }


 ?>


            </div>
        </div>
    </div>
</section>

<!-- ******MODAL TRABALHO****** -->
<?php require 'views/front/organismo/cadastro_organismo/trabalho/modal_trabalho.php'; ?>
<!--//modal trabalho-->