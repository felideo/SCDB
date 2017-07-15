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



                <?php if(isset($this->organismo['organismo_relaciona_trabalho'][0]) && !empty($this->organismo['organismo_relaciona_trabalho'][0])) : ?>
                    <?php foreach($this->organismo['organismo_relaciona_trabalho'][0]['trabalho'] as $indice => $trabalho) : ?>

                        <?php
                            if(isset($trabalho['link_trabalho']) && !empty($trabalho['link_trabalho'])) {
                                $icone = 'fa-link';
                            }
                        ?>
                        <div id="id_trabalho_0" class="item col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center" data-id_trabalho="<?php echo $trabalho['id']; ?>">
                            <div class="icon">
                                <i id="icone_tipo_trabalho_<?php echo $trabalho['id']; ?>" class="fa <?php echo $icone; ?>"></i>
                            </div>
                            <div class="content">
                                <h3 class="title"><?php echo $trabalho['titulo']; ?></h3>
                                <p class="short_description"><?php echo substr($trabalho['resumo'], 0, 256); ?></p>
                                <p class="short_description"><strong>Autor: </strong><?php echo $trabalho['autor'][0]['nome']; ?></p>
                            </div>
                        </div>

                    <?php endforeach ?>
                <?php endif ?>



            </div>
        </div>
    </div>
</section>

<!-- ******MODAL TRABALHO****** -->
<?php require 'views/front/organismo/cadastro_organismo/trabalho/modal_trabalho.php'; ?>
<!--//modal trabalho-->