<div class="row-fluid">
    <div class="span12">
        <form method="post"
            id="lazy_view"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome do Paciente</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome do Pai</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[pai]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pai'];} ?>">
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome da Mãe</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[mae]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['mae'];} ?>" required>
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span3" style="position: relative;">
                    <label>Data de Nascimento</label>
                    <input id="data_nascimento" autocomplete="off" class="form-control mascara_data somente_numeros" name="<?php echo $this->modulo['modulo']; ?>[data__nascimento]" value="<?php if(isset($this->cadastro)){echo date('d/m/Y', strtotime($this->cadastro['nascimento']));} ?>" required>

                </div>
                <div class="form-group span2">
                    <label>Sexo</label>
                    <br>
                    <select name="<?php echo $this->modulo['modulo']; ?>[sexo]" required>
                        <option <?php if(isset($this->cadastro) && $this->cadastro['sexo'] == 1 ){echo ' selected ';} ?> value="1">Masculino</option>
                        <option <?php if(isset($this->cadastro) && $this->cadastro['sexo'] == 0 ){echo ' selected ';} ?> value="0">Feminino</option>
                    </select>
                </div>
                <div class="form-group span7">
                    <label>Hipótese de Patologia</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[patologia]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['patologia'];} ?>" required>
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span4">
                    <label>Telefone</label>
                    <input class="form-control mascara_telefone somente_numeros" name="contato[0]" value="<?php if(isset($this->cadastro['contato'][0])){echo $this->cadastro['contato'][0]['contato'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Celular</label>
                    <input class="form-control mascara_celular somente_numeros" name="contato[1]" value="<?php if(isset($this->cadastro['contato'][1])){echo $this->cadastro['contato'][1]['contato'];} ?>" >
                </div>
                <div class="form-group span4">
                    <label>Email</label>
                    <input class="form-control validar_email" maxlength="128" name="contato[2]" value="<?php if(isset($this->cadastro['contato'][2])){echo $this->cadastro['contato'][2]['contato'];} ?>" >
                </div>
            </div>


            <div class="row-fluid">
                <div class="form-group span2">
                    <label>CEP</label>
                    <input id="buscar_cep" class="form-control mascara_cep somente_numeros" name="endereco[cep]" value="<?php if(isset($this->cadastro) && $this->cadastro['endereco']['cep'] != 0){echo $this->cadastro['endereco']['cep'];} ?>" >
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span10">
                    <label>Rua</label>
                    <input id="rua" maxlength="128" class="form-control" name="endereco[rua]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['endereco']['rua'];} ?>" >
                </div>
                <div class="form-group span2">
                    <label>Numero</label>
                    <input class="form-control" name="endereco[numero]" value="<?php if(isset($this->cadastro) && $this->cadastro['endereco']['cep'] != 0){echo $this->cadastro['endereco']['numero'];} ?>" >
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Complemento</label>
                    <input class="form-control" maxlength="128" name="endereco[complemento]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['endereco']['complemento'];} ?>" >
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span5">
                    <label>Bairro</label>
                    <input id="bairro" class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="endereco[bairro]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['endereco']['bairro'];} ?>" >
                </div>
                <div class="form-group span5">
                    <label>Cidade</label>
                    <input id="cidade" class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="endereco[cidade]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['endereco']['cidade'];} ?>" >
                </div>
                <div class="form-group span2">
                    <label>UF</label>
                    <input id="uf" class="form-control somente_letras" maxlength="2" name="endereco[uf]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['endereco']['uf'];} ?>" >
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Descrição do Caso</label>
                </div>
               <div class="form-group col-lg-12 col-md-12">
                    <textarea class="form-control" rows="3" name="<?php echo $this->modulo['modulo']; ?>[descricao]"><?php if(isset($this->cadastro)){echo $this->cadastro['descricao'];} ?></textarea>
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

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/form.js.php'; ?>