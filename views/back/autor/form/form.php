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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Autor</label>
                        <br>
                        <input class="somente_letras embelezar_string" id="autor" name="<?php echo $this->modulo['modulo']; ?>[nome]" style="width: 100%" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>">
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label>Lattes/Site</label>
                        <p id="link_autor_div" style="display: none;"></p>
                        <input id="link_autor_input" type="text" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[link]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['link'];} ?>">
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label>Email</label>
                        <p id="email_autor_div" style="display: none;"></p>
                        <input class="form-control validar_email email_unico letras_e_numeros remover_caracteres_especiais" id="email_autor_input" type="email" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[email]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['email'];} ?>">
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