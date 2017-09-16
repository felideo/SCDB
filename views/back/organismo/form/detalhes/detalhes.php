<style type="text/css">
	.forma_folha_outer{
		padding: 10px;
	}

	.forma_folha_inner{
		background: #FFFFFF;
		border: 1px solid #000;
		border-radius: 10px;
		min-height: 120px;
	}

	.forma_folha_img{
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 120px;
	}

</style>

<section id="how" class="how section has-pattern">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h2 class="title">Nomes Populares</h2>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<input id="nomes_populares" name="nomes_populares" required>
				</div>
			</div>
		</div>
	</div>

		<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2 class="title">Características</h2>

			<div class="row-fluid">
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label>Numero de Petalas:</label>
						<input class="form-control somente_numeros" maxlength="1" name="detalhes[numero_petalas]" value="<?php if(isset($this->organismo)){echo $this->organismo['numero_petalas'];} ?>" required>

				</div>
			</div>
			<div class="row-fluid">
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label>Numero de Estames</label>
					<input class="form-control somente_numeros" maxlength="2" name="detalhes[numero_estames]" value="<?php if(isset($this->organismo)){echo $this->organismo['numero_estames'];} ?>" required>
				</div>
			</div>
			<div class="row-fluid">
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label>Posição do Ovario</label>
					<input class="form-control" name="detalhes[posicao_ovario]" value="<?php if(isset($this->organismo)){echo $this->organismo['posicao_ovario'];} ?>" required>
				</div>
			</div>
		</div>
		<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2 class="title">Descrição</h2>
			<div class="row-fluid">
				<div class="form-group message">
						<label class="sr-only" for="message">Descrição</label>
						<textarea id="message" class="form-control" rows="9" placeholder="Descrição:" name="detalhes[descricao]" required=""><?php if(isset($this->organismo)){echo $this->organismo['descricao'];} ?></textarea>
				</div>
			</div>
		</div>


		<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2 class="title">Forma de Folha</h2>

			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/acicular.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="acicular" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'acicular'){echo ' checked ';}} ?> required>
						<label class="radio-inline">acicular</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/deltoide.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="deltoide" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'deltoide'){echo ' checked ';}} ?> required>
						<label class="radio-inline">deltoide</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/flabelada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="flabelada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'flabelada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">flabelada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/obtusa.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obtusa" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'obtusa'){echo ' checked ';}} ?> required>
						<label class="radio-inline">obtusa</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/pinatilobada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinatilobada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'pinatilobada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">pinatilobada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/subulada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="subulada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'subulada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">subulada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/acuminada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="acuminada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'acuminada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">acuminada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/digitiforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="digitiforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'digitiforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">digitiforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/hastada_ou_alabardina.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="alabardina" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'alabardina'){echo ' checked ';}} ?> required>
						<label class="radio-inline">alabardina</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/oposta.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="oposta" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'oposta'){echo ' checked ';}} ?> required>
						<label class="radio-inline">oposta</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/pinulada_impar.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinulada impar" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'impar'){echo ' checked ';}} ?> required>
						<label class="radio-inline">pinulada impar</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/ternifoliada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="ternifoliada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'ternifoliada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">ternifoliada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/alternada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="alternada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'alternada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">alternada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/eliptica.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="eliptica" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'eliptica'){echo ' checked ';}} ?> required>
						<label class="radio-inline">eliptica</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/lanceolada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="lanceolada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'lanceolada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">lanceolada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/orbicular.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="orbicular" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'orbicular'){echo ' checked ';}} ?> required>
						<label class="radio-inline">orbicular</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/pinulada_par.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinulada par" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'par'){echo ' checked ';}} ?> required>
						<label class="radio-inline">pinulada par</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/tripinulada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="tripinulada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'tripinulada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">tripinulada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/aristada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="aristada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'aristada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">aristada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/espalmada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espalmada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'espalmada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">espalmada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/linear.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="linear" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'linear'){echo ' checked ';}} ?> required>
						<label class="radio-inline">linear</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/ovada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="ovada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'ovada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">ovada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/reniforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="reniforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'reniforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">reniforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/truncada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="truncada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'truncada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">truncada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/bipinulada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="bipinulada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'bipinulada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">bipinulada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/espatulada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espatulada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'espatulada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">espatulada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/lobada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="lobada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'lobada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">lobada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/pediforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pediforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'pediforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">pediforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/romboide.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="romboide" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'romboide'){echo ' checked ';}} ?> required>
						<label class="radio-inline">romboide</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/unifolar.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="unifolar" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'unifolar'){echo ' checked ';}} ?> required>
						<label class="radio-inline">unifolar</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/cordiforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="cordiforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'cordiforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">cordiforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/espiralada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espiralada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'espiralada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">espiralada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/obcordata.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obcordata" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'obcordata'){echo ' checked ';}} ?> required>
						<label class="radio-inline">obcordata</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/peltada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="peltada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'peltada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">peltada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/roseta.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="roseta" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'roseta'){echo ' checked ';}} ?> required>
						<label class="radio-inline">roseta</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/cuneiforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="cuneiforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'cuneiforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">cuneiforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/falciforme.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="falciforme" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'falciforme'){echo ' checked ';}} ?> required>
						<label class="radio-inline">falciforme</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/obovada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obovada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'obovada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">obovada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/pernifoliada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pernifoliada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'pernifoliada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">pernifoliada</label>
					</div>
				</div>
			</div>
			<div class="forma_folha_outer col-md-4 col-lg-4" >
				<div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<img class="row text-center" src="/public/front_end/images/folhas/sagitada.png">
					</div>
					<div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="sagitada" type="radio" <?php if(isset($this->organismo)){if($this->organismo['forma_folha'] == 'sagitada'){echo ' checked ';}} ?> required>
						<label class="radio-inline">sagitada</label>
					</div>
				</div>
			</div>
		</div>
</section>



<?php require 'views/back/organismo/form/detalhes/detalhes.js.php'; ?>
