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
                    <label>Nome</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span3">
                    <label>RGM</label>
                    <input id="rgm" class="form-control somente_numeros" maxlength="11" name="<?php echo $this->modulo['modulo']; ?>[rgm]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['rgm'];} ?>" required>
                </div>
                <div class="form-group span5">
                    <label>Curso</label>
                    <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" maxlength="128" name="<?php echo $this->modulo['modulo']; ?>[curso]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['curso'];} ?>" required>
                </div>
                <div class="form-group span2">
                    <label>Semestre</label>
                    <input id="semestre" class="form-control somente_numeros" maxlength="2" name="<?php echo $this->modulo['modulo']; ?>[semestre]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['semestre'];} ?>" required>
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

    $('#semestre').change(function(){
        if($('#semestre').val() == 0 || $('#semestre').val() > 12){
            swal({
                title: 'Erro',
                text: 'Digite um numero de semestre válido!',
                type: 'error',
                tconfirmButtonText: 'OK'
            });

            $('#semestre').val('');
        }
    });

    $('#rgm').change(function(){
        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>aluno/verificar_duplicidade_rgm_ajax",
            data: {
                rgm: $('#rgm').val()
            },
            dataType: 'json',
            async: false,
            beforeSend: function(){
                carregar_loader('show');
            },
            success: function(dados) {
                if(dados == false){
                    swal({
                        title: 'Erro',
                        text: 'RGM ja cadastrado no sistema!',
                        type: 'error',
                        tconfirmButtonText: 'OK'
                    });

                    $('#RGM').val('');
                } else {
                    setTimeout("carregar_loader('hide');", 1000);
                }
            }
        });
    });



    $('.validar_email').change(function(){
        if($('.validar_email').val() == ''){
        return false;
        }

        if (!validar_email($('.validar_email').val())) {
            swal("Erro", "Digite um email válido!", "error");
            $('.validar_email').val('');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "<?php echo URL; ?>usuario/verificar_duplicidade_ajax",
            data: {
                usuario: $('.validar_email').val()
            },
            dataType: 'json',
            async: false,
            beforeSend: function(){
                carregar_loader('show');
            },
            success: function(dados) {
                if(dados == false){
                    swal({
                        title: 'Erro',
                        text: 'Email ja cadastrado no sistema!',
                        type: 'error',
                        tconfirmButtonText: 'OK'
                    });

                    $('.validar_email').val('');
                } else {
                    setTimeout("carregar_loader('hide');", 1000);
                }
            }
        });
    });
});
</script>