<section id="how" class="how section has-pattern">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <h2 class="title">Posição Geografica</h2>


            <div class="row">
                <?php if(!isset($this->organismo)) : ?>
                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5">
                            <label>Latitude</label>
                            <input id="latitude" class="form-control latitude" maxlength="11" />
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5 col-lg-5">
                            <label>Longitude</label>
                            <input id="longitude" class="form-control longitude" maxlength="11" />
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <a id="add_localizacao" type="buttom" style="margin-top: 13px; float: right;" class="btn btn-lg btn-theme">Adicionar</a>
                        </div>
                    </div>
                <?php endif ?>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="map_wrapper">
                        <div id="map_canvas" class="mapping"></div>
                    </div>
                </div>

                <div id="posicao_geografica_inputs" style="display: none"></div>

            </div>
		</div>
	</div>
</section>

<?php require 'views/front/organismo/cadastro_organismo/posicao_geografica/posicao_geografica.js.php'; ?>