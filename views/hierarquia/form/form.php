<div class="row-fluid">
    <div class="span12">
        <form method="post"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo array_values($this->cadastro)[0]['id_hierarquia']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span6">
                    <label>Nome</label>
                    <input class="form-control somente_letras" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo array_values($this->cadastro)[0]['nome'];} ?>" required>
                </div>
            </div>
            <div class="row">
                <?php foreach ($this->permissoes_list as $indice_01 => $modulo) : ?>
                    <div class="col-lg-2 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa <?php echo $modulo['modulo']['icone']; ?> fa-fw"></i> <?php echo $modulo['modulo']['nome']; ?></h4>
                            </div>
                            <div class="panel-body">
                                <?php foreach ($modulo['permissoes'] as $indice_02 => $permissao) : ?>

                                    <div class="checkbox">
                                        <label>
                                            <input
                                                value="<?php echo $permissao['id'] ?>"
                                                name="hierarquia_relaciona_permissao[]"
                                                type="checkbox"
                                                <?php
                                                    if(isset($this->cadastro[$permissao['id']])){
                                                        echo " checked ";
                                                    }
                                                ?> ><?php echo $permissao['nome']; ?>
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
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <?php if(isset($this->cadastro)) : ?>
                            Editar <?php echo $this->modulo['send']; ?>
                        <?php else : ?>
                            Cadastrar Novo <?php echo $this->modulo['send']; ?>
                        <?php endif?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>