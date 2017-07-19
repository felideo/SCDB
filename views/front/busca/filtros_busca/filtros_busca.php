<section
	id="promo"
	class="promo section offset-header has-pattern "
	style="
		background-image: url('/public/front_end/images/background/folhas_02.jpg');
		background-color: #56bc94;
		background-size: 100%;
		background-blend-mode: luminosity;order:"
>
	<div class="container">
		<div class="row">

			<!-- ******CLASSIFICACAO TAXONOMICA****** -->
			<div class="overview col-xs-12 col-sm-12  col-md-12 col-lg-12 ">
				<h2 class="title folha_text_shadow">Busca</h2>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 marginT10">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label class="folha_text_shadow">Taxon</label>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<input id="taxonomy_search" data-placeholder="Taxon" style="width: 100%;">
						</div>
					</div>


					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 marginT10">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label class="folha_text_shadow">Nome Popular</label>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<input id="nome_popular_search" data-placeholder="Nome Popular" style="width: 100%;">
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 marginT10">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label class="folha_text_shadow">Numero de Petalas</label>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<select class="form-group span12" id="numero_petalas" style="width: 100%;">
		                        <option selected ></option>
		                        <?php for($i = $this->min_max_n_petalas_e_estames['min_n_petalas']; $i <= $this->min_max_n_petalas_e_estames['max_n_petalas']; $i++) : ?>
		                            <option value="<?php echo $i; ?>" >
		                                <?php echo $i; ?>
		                            </option>
		                        <?php endfor ?>
		                     </select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 marginT10">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label class="folha_text_shadow">Numero de Estames</label>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<select class="form-group span12" id="numero_estames" style="width: 100%;">
		                        <option selected ></option>
		                        <?php for($i = $this->min_max_n_petalas_e_estames['min_n_estames']; $i <= $this->min_max_n_petalas_e_estames['max_n_estames']; $i++) : ?>
		                            <option value="<?php echo $i; ?>" >
		                                <?php echo $i; ?>
		                            </option>
		                        <?php endfor ?>
		                     </select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 marginT10">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<label class="folha_text_shadow">Forma da Folha</label>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<select class="form-group span12" id="forma_folha" style="width: 100%;">
		                        <option selected ></option>
								<option value="acicular" >Acicular</option>
								<option value="deltoide" >Deltoide</option>
								<option value="flabelada" >Flabelada</option>
								<option value="obtusa" >Obtusa</option>
								<option value="pinatilobada" >Pinatilobada</option>
								<option value="subulada" >Subulada</option>
								<option value="acuminada" >Acuminada</option>
								<option value="digitiforme" >Digitiforme</option>
								<option value="alabardina" >Alabardina</option>
								<option value="oposta" >Oposta</option>
								<option value="pinulada" >Pinulada</option>
								<option value="ternifoliada" >Ternifoliada</option>
								<option value="alternada" >Alternada</option>
								<option value="eliptica" >Eliptica</option>
								<option value="lanceolada" >Lanceolada</option>
								<option value="orbicular" >Orbicular</option>
								<option value="pinulada" >Pinulada</option>
								<option value="tripinulada" >Tripinulada</option>
								<option value="aristada" >Aristada</option>
								<option value="espalmada" >Espalmada</option>
								<option value="linear" >Linear</option>
								<option value="ovada" >Ovada</option>
								<option value="reniforme" >Reniforme</option>
								<option value="truncada" >Truncada</option>
								<option value="bipinulada" >Bipinulada</option>
								<option value="espatulada" >Espatulada</option>
								<option value="lobada" >Lobada</option>
								<option value="pediforme" >Pediforme</option>
								<option value="romboide" >Romboide</option>
								<option value="unifolar" >Unifolar</option>
								<option value="cordiforme" >Cordiforme</option>
								<option value="espiralada" >Espiralada</option>
								<option value="obcordata" >Obcordata</option>
								<option value="peltada" >Peltada</option>
								<option value="roseta" >Roseta</option>
								<option value="cuneiforme" >Cuneiforme</option>
								<option value="falciforme" >Falciforme</option>
								<option value="obovada" >Obovada</option>
								<option value="pernifoliada" >Pernifoliada</option>
								<option value="sagitada" >Sagitada</option>
		                     </select>
						</div>
					</div>








				</div>

			</div><!--//classificacao taxonomica-->
		</div>
	</div>
</section>

<?php require 'views/front/busca/filtros_busca/filtros_busca.js.php'; ?>

