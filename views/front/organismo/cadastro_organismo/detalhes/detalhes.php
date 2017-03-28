<section id="how" class="how section has-pattern">
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2 class="title">Nomes Populares</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input id="nomes_populares" style="width: 100%;" name="nomes_populares" required>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2 class="title">Características</h2>

			<div class="row-fluid">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Numero de Petalas:</label>
                    <input class="form-control somente_numeros" maxlength="1" name="detalhes[numero_petalas]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['atendimentos_simultaneos'];} ?>" required>
                </div>
            </div>
			<div class="row-fluid">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Numero de Estames</label>
                    <input class="form-control somente_numeros" maxlength="1" name="detalhes[numero_estames]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['atendimentos_simultaneos'];} ?>" required>
                </div>
            </div>
			<div class="row-fluid">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Posição do Ovario</label>
                    <input class="form-control" name="detalhes[posicao_ovario]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['atendimentos_simultaneos'];} ?>" required>
                </div>
            </div>
		</div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2 class="title">Descrição</h2>
			<div class="row-fluid">
                <div class="form-group message">
						<label class="sr-only" for="message">Descrição</label>
						<textarea id="message" class="form-control" rows="9" placeholder="Descrição:" name="detalhes[descricao]" required=""></textarea>
				</div>
            </div>
		</div>

        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="title">Forma de Folha</h2>

    		<div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/acicular.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="acicular" type="radio" required>
                        <label class="radio-inline">acicular</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/deltoide.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="deltoide" type="radio" required>
                        <label class="radio-inline">deltoide</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/flabelada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="flabelada" type="radio" required>
                        <label class="radio-inline">flabelada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/obtusa.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obtusa" type="radio" required>
                        <label class="radio-inline">obtusa</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/pinatilobada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinatilobada" type="radio" required>
                        <label class="radio-inline">pinatilobada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/subulada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="subulada" type="radio" required>
                        <label class="radio-inline">subulada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/acuminada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="acuminada" type="radio" required>
                        <label class="radio-inline">acuminada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/digitiforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="digitiforme" type="radio" required>
                        <label class="radio-inline">digitiforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/hastada_ou_alabardina.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="alabardina" type="radio" required>
                        <label class="radio-inline">alabardina</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/oposta.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="oposta" type="radio" required>
                        <label class="radio-inline">oposta</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/pinulada_impar.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinulada impar" type="radio" required>
                        <label class="radio-inline">pinulada impar</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/ternifoliada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="ternifoliada" type="radio" required>
                        <label class="radio-inline">ternifoliada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/alternada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="alternada" type="radio" required>
                        <label class="radio-inline">alternada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/eliptica.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="eliptica" type="radio" required>
                        <label class="radio-inline">eliptica</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/lanceolada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="lanceolada" type="radio" required>
                        <label class="radio-inline">lanceolada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/orbicular.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="orbicular" type="radio" required>
                        <label class="radio-inline">orbicular</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/pinulada_par.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pinulada par" type="radio" required>
                        <label class="radio-inline">pinulada par</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/tripinulada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="tripinulada" type="radio" required>
                        <label class="radio-inline">tripinulada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/aristada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="aristada" type="radio" required>
                        <label class="radio-inline">aristada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/espalmada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espalmada" type="radio" required>
                        <label class="radio-inline">espalmada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/linear.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="linear" type="radio" required>
                        <label class="radio-inline">linear</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/ovada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="ovada" type="radio" required>
                        <label class="radio-inline">ovada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/reniforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="reniforme" type="radio" required>
                        <label class="radio-inline">reniforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/truncada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="truncada" type="radio" required>
                        <label class="radio-inline">truncada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/bipinulada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="bipinulada" type="radio" required>
                        <label class="radio-inline">bipinulada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/espatulada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espatulada" type="radio" required>
                        <label class="radio-inline">espatulada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/lobada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="lobada" type="radio" required>
                        <label class="radio-inline">lobada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/pediforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pediforme" type="radio" required>
                        <label class="radio-inline">pediforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/romboide.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="romboide" type="radio" required>
                        <label class="radio-inline">romboide</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/unifolar.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="unifolar" type="radio" required>
                        <label class="radio-inline">unifolar</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/cordiforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="cordiforme" type="radio" required>
                        <label class="radio-inline">cordiforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/espiralada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="espiralada" type="radio" required>
                        <label class="radio-inline">espiralada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/obcordata.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obcordata" type="radio" required>
                        <label class="radio-inline">obcordata</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/peltada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="peltada" type="radio" required>
                        <label class="radio-inline">peltada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/roseta.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="roseta" type="radio" required>
                        <label class="radio-inline">roseta</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/cuneiforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="cuneiforme" type="radio" required>
                        <label class="radio-inline">cuneiforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/falciforme.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="falciforme" type="radio" required>
                        <label class="radio-inline">falciforme</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/obovada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="obovada" type="radio" required>
                        <label class="radio-inline">obovada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/pernifoliada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="pernifoliada" type="radio" required>
                        <label class="radio-inline">pernifoliada</label>
                    </div>
                </div>
            </div>
            <div class="forma_folha_outer col-md-3 col-lg-3" >
                <div class="forma_folha_inner col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="forma_folha_img col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <img class="row text-center" src="/public/front_end/images/folhas/sagitada.png">
                    </div>
                    <div class="option_forma_folha form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input name="detalhes[forma_folha]" id="optionsRadiosInline3" value="sagitada" type="radio" required>
                        <label class="radio-inline">sagitada</label>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>

<?php require 'views/front/organismo/cadastro_organismo/detalhes/detalhes.js.php'; ?>
