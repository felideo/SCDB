<div class="row-fluid">
    <div class="span12">
        <form method="post"
            id="lazy_view"
            <?php if(isset($this->cadastro)) : ?>
                action="/<?php echo $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id']; ?>"
            <?php else : ?>
                action="/<?php echo $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span8">
                    <label>Email</label>
                    <input class="form-control validar_email email_unico letras_e_numeros remover_caracteres_especiais" name="<?php echo $this->modulo['modulo']; ?>[email]" <?php if(isset($this->cadastro)){echo 'disabled';} ?> value="<?php if(isset($this->cadastro)){echo $this->cadastro['email'];} ?>" required>
                </div>
                <div class="form-group span4">
                     <label>Hierarquia</label>
                     <br>
                     <select class="form-group span12" name="<?php echo $this->modulo['modulo']; ?>[hierarquia]" >
                        <option disabled>Selecnione</option>
                        <?php foreach ($this->hierarquia_list as $indice => $hierarquia) : ?>
                            <option value="<?php echo $hierarquia['id']?>" <?php if(isset($this->cadastro) && $this->cadastro['hierarquia'] == $hierarquia['id']){echo ' selected ';} ?> >
                                <?php echo $hierarquia['nome']; ?>
                            </option>
                        <?php endforeach ?>
                     </select>
                </div>

                <div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Pronome de Tratamento</label>
                            <input class="form-control" name="usuario[pronome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['pronome'];} ?>" type="text" >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Nome</label>
                            <input class="form-control embelezar_string" name="usuario[nome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['nome'];} ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Sobrenome</label>
                            <input class="form-control embelezar_string" name="usuario[sobrenome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['sobrenome'];} ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Instituição/Afiliação</label>
                            <input class="form-control" name="usuario[instituicao]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['instituicao'];} ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Area de Atuação</label>
                            <input class="form-control" name="usuario[atuacao]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['atuacao'];} ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Link Currículo Lattes</label>
                            <input class="form-control" name="usuario[lattes]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pessoa'][0]['lattes'];} ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Grau </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="1" value="<?php if(isset($this->cadastro['pessoa'][0]['grau']) && $this->cadastro['pessoa'][0]['grau'] == 1){echo ' checked ';} ?>" type="radio" required> Aluno de Graduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="2" value="<?php if(isset($this->cadastro['pessoa'][0]['grau']) && $this->cadastro['pessoa'][0]['grau'] == 2){echo ' checked ';} ?>" type="radio" required> Aluno Pós greduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="3" value="<?php if(isset($this->cadastro['pessoa'][0]['grau']) && $this->cadastro['pessoa'][0]['grau'] == 3){echo ' checked ';} ?>" type="radio" required> Professor
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" value="<?php if(isset($this->cadastro['pessoa'][0]['grau']) && $this->cadastro['pessoa'][0]['grau'] == 4){echo ' checked ';} ?>" type="radio" required> Pesquisador
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" value="<?php if(isset($this->cadastro['pessoa'][0]['grau']) && $this->cadastro['pessoa'][0]['grau'] == 4){echo ' checked ';} ?>" type="radio" required> Outros
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row-fluid">
                <div class="form-group span12">

                    <button type="submit" class="btn btn-success" style="float: right;">
                        <?php if(isset($this->cadastro)) : ?>
                            Editar <?php echo $this->modulo['send']; ?>
                        <?php else : ?>
                            Cadastrar Novo <?php echo $this->modulo['send']; ?>
                        <?php endif?>
                    </button>

                    <button type="button" class="btn btn btn-danger voltar" style="float: right;margin-right: 10px; <?php if(!isset($this->cadastro)){ echo 'display: none;';} ?>">
                        <?php if(isset($this->cadastro)) : ?>
                            Cancelar
                        <?php else : ?>
                            Voltar
                        <?php endif?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>