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
                <div class="form-group span12">
                    <label>Nome</label>
                    <input class="form-control somente_letras" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span3">
                    <label>RGM</label>
                    <input class="form-control somente_numeros" maxlength="11" name="<?php echo $this->modulo['modulo']; ?>[rgm]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['rgm'];} ?>" required>
                </div>
                <div class="form-group span5">
                    <label>Curso</label>
                    <input class="form-control somente_letras" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[curso]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['curso'];} ?>" required>
                </div>
                <div class="form-group span2">
                    <label>Semestre</label>
                    <input class="form-control somente_numeros" maxlength="1" name="<?php echo $this->modulo['modulo']; ?>[semestre]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['semestre'];} ?>" required>
                </div>
                <div class="form-group span2">
                    <label>Turma</label>
                    <input id="turma" class="form-control somente_letras" maxlength="1" name="<?php echo $this->modulo['modulo']; ?>[turma]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['turma'];} ?>" required>
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
                    <input class="form-control validar_email verificar_email" maxlength="128" name="contato[2]" value="<?php if(isset($this->cadastro['contato'][2])){echo $this->cadastro['contato'][2]['contato'];} ?>" required>
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

<script>
$(document).ready(function() {
    $('#turma').keyup(function(){
        var turma = $('#turma').val();
        turma = turma.toUpperCase();
        $('#turma').val(turma);
    });
});
</script>