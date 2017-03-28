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

            <div class="row-fluid marginB10">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 marginT10">
                            <label class="folha_text_shadow">Taxon</label>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 marginT10">
                            <input id="taxon_nome"  name="<?php echo $this->modulo['modulo']; ?>[nome]" style="width: 100%;" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>" >
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 marginT10">
                            <label class="folha_text_shadow">Ascendente</label>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 marginT10">
                                <input id="taxon_nome"  name="<?php echo $this->modulo['modulo']; ?>[nome]" style="width: 100%;" value="<?php if(isset($this->cadastro)){echo $this->cadastro['ascendente_nome'];} ?>" disabled>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 marginT10">
                            <label class="folha_text_shadow">Classificacao</label>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 marginT10">
                            <input id="taxon_nome"  name="<?php echo $this->modulo['modulo']; ?>[nome]" style="width: 100%;" value="<?php if(isset($this->cadastro)){echo $this->cadastro['classificacao_nome'];} ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid marginT10">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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