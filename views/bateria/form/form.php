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
                <div class="form-group span5" style="position: relative;">
                    <label>Inicio da Bateria</label>
                    <input id="inicio_bateria" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_inicio]" required>
                </div>
                <div class="form-group span2">
                </div>
                <div class="form-group span5" style="position: relative;">
                    <label>Final da Bateria:</label>
                    <input id="fim_bateria" class="form-control" name="<?php echo $this->modulo['modulo']; ?>[data__data_fim]" required>
                </div>
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

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/clone_relacao/clone_relacao.php'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#inicio_bateria').datetimepicker({
            inline: true,
            sideBySide: true,
            debug: false,
            format: 'DD/MM/YYYY'
        });

        $('#fim_bateria').datetimepicker({
            inline: true,
            sideBySide: true,
            debug: false,
            format: 'DD/MM/YYYY'
        });


    });
</script>

