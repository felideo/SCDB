<div class="row-fluid">
    <div class="span12">
        <form method="post"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">

                <div class="form-group span4" style="position: relative;">
                    <label>Inicio da Bateria:</label>
                    <input id="inicio_bateria" autocomplete="off" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_inicio]" required>
                </div>
                <div class="form-group span4" style="position: relative;">
                    <label>Final da Bateria:</label>
                    <input id="fim_bateria" autocomplete="off" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_fim]" required>
                </div>
                <div class="form-group span4" style="position: relative;">
                    <label>N° de Atendimentos Simultaneos:</label>
                    <input class="form-control somente_numeros" name="<?php echo $this->modulo['modulo']; ?>[atendimentos_simultaneos]" required>
                </div>
            </div>

            <?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/clone_relacao/clone_relacao.php'; ?>


            <div class="row-fluid">
                <div class="form-group span12">
                    <button id="submit" type="button" class="btn btn-primary" style="float: right;">
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

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/form.js.php'; ?>