<div class="row-fluid">
    <div class="span12">
        <form method="post"
            id="lazy_view"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo array_values($this->cadastro)[0]['id_hierarquia']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span6">
                    <label>Nome</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo array_values($this->cadastro)[0]['nome'];} ?>" required>
                </div>
            </div>
            <div class="row">
                <?php foreach ($this->permissoes_list as $indice_01 => $modulo) : ?>
                    <div class="col-lg-4 col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa <?php echo $modulo['modulo']['icone']; ?> fa-fw"></i> <?php echo $modulo['modulo']['nome']; ?></h4>
                            </div>
                            <div class="panel-body">
                                <?php foreach ($modulo['permissoes'] as $indice_02 => $permissao) : ?>

                                    <div class="checkbox">
                                        <label>
                                            <input
                                                class="permissao_hierarquia"
                                                id="<?php echo $modulo['modulo']['modulo']; ?>_<?php echo $permissao['nome']; ?>"
                                                value="<?php echo $permissao['id'] ?>"
                                                name="hierarquia_relaciona_permissao[]"
                                                type="checkbox"
                                                data-permissao="<?php echo $permissao['nome']; ?>"
                                                data-modulo="<?php echo $modulo['modulo']['modulo']; ?>"
                                                <?php
                                                    if(isset($this->cadastro[$permissao['id']])){
                                                        echo " checked ";
                                                    }
                                                ?> ><?php echo ucwords($permissao['nome']); ?>
                                        </label>
                                    </div>

                                <?php endforeach ?>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                <?php endforeach ?>
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

<script type="text/javascript">
    $(".permissao_hierarquia").on('click', function(){
        if($(this).data('permissao') != 'visualizar' && $(this).prop('checked')){
            $('#' + $(this).data('modulo') + '_visualizar').prop('checked', true);
        }
    });
</script>