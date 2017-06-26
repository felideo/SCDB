<div class="modal modal-feature" id="add_trabalho_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                <h2 class="modal-title text-center">Adicionar Trabalho</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="content col-xs-12 col-sm-12 col-md-12 col-lg-12 ">

                        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	                            <div class="form-group">
	                                <label>Autor</label>
	                                <br>
	                                <input id="autor" name="autor" style="width: 100%">
	                            </div>

	                            <div class="form-group">
	                                <label>Lattes/Site</label>
	                                <p id="link_autor_div" style="display: none;"></p>
	                                <input id="link_autor_input" type="text" class="form-control" name="site">
	                            </div>

	                            <div class="form-group">
	                                <label>Email</label>
	                                <p id="email_autor_div" style="display: none;"></p>
	                                <input id="email_autor_input" type="email" class="form-control" name="email">
	                            </div>

	                            <div id="upload_trabalho" class="row" style="display: none;">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div id="upload_trabalho_trigger"></div>
		                                <input type="text" class="form-control" id="id_arquivo" name="id_arquivo">
									</div>
								</div>

								<div id="link_trabalho" class="row" style="display: none;">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
			                                <label>Link do Trabalho</label>
			                                <input type="text" class="form-control" name="link_trabalho">
			                            </div>
									</div>
								</div>
	                        </div>

                        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	 							<div class="form-group">
	                                <label>Titulo</label>
	                                <input type="text" class="form-control" name="titulo">
	                            </div>

	                            <div class="form-group">
	                                <label>Idioma</label>
	                                <br>
	                                <input id="idioma" name="idioma" style="width: 100%">
	                            </div>

	                            <div class="form-group">
	                                <label>Ano</label>
	                                <input type="text" class="form-control" name="ano">
	                            </div>

	                            <div class="form-group">
	                                <label>Palavras Chave</label>
	                                <br>
	                                <input id="palavra_chave" name="palavras_chave">
	                            </div>

	                            <div class="form-group">
	                                <label>Resumo</label>
	                                <textarea class="form-control" rows="3" name="resumo"></textarea>
	                            </div>

	                            <fieldset class="form-group">
	                                <legend>Tipo de Trabalho</legend>
	                                <div class="form-check">
	                                    <label class="form-check-label">
	                                        <input type="radio" class="form-check-input" name="tipo_trabalho" id="upload" value="upload"> Upload de Arquivo
	                                    </label>
	                                </div>
	                                <div class="form-check">
	                                    <label class="form-check-label">
	                                        <input type="radio" class="form-check-input" name="tipo_trabalho" id="link" value="link"> Link
	                                    </label>
	                                </div>
	                            </fieldset>
	                        </div>

                        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	                            <button id="add_trabalho" type="button" class="btn btn-primary green_buttom">
	                            	<i class="fa fa-check-circle"></i> Enviar
	                            </button>
	                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ******MODAL TRABALHO****** -->
<?php require 'views/front/organismo/cadastro_organismo/trabalho/modal_trabalho.js.php'; ?>
<!--//modal trabalho-->