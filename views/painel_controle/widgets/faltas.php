    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Faltas
            </div>
            <div class="panel-body">
                    <?php foreach ($this->faltas as $indice_01 => $falta) : ?>
                        <?php if($indice_01 == 'pacientes' && \Util\Permission::check_user_permission('paciente', 'paciente_remover_por_excesso_de_faltas')) : ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <?php echo ucfirst($indice_01); ?>
                                        </div>

                                        <div class="panel-body">
                                            <?php foreach($falta as $indice_02 => $aluno_paciente) : ?>
                                                  <div class="row-fluid">
                                                      <div class="form-group span12">
                                                         <label><?php echo $aluno_paciente['nome'] ?> - <?php echo $aluno_paciente['faltas'] ?> Faltas </label>
                                                         <a href="<?php echo URL . 'painel_controle/faltou_de_mais/' . $aluno_paciente['id_relacao'] . '/' . $aluno_paciente['id'] . '/' . $indice_01; ?>" class="btn btn-success marginL10 marginR10 marginT10" style="float: right;">Remover</a>
                                                         <a href="<?php echo URL . 'painel_controle/justificar_falta/' . $aluno_paciente['id_relacao'] . '/' . $aluno_paciente['id'] . '/' . $indice_01; ?>" class="btn btn-danger marginL10 marginR10 marginT10" style="float: right;">Justificar</a>
                                                        <button type="button" class="justificativas btn btn-warning marginL10 marginR10 marginT10" data-tipo="paciente" data-id="<?php echo $aluno_paciente['id']; ?>" style="float: right;">Justificativas</button>

                                                      </div>
                                                  </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($indice_01 == 'alunos' && \Util\Permission::check_user_permission('aluno', 'aluno_remover_por_excesso_de_faltas')) : ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <?php echo ucfirst($indice_01); ?>
                                        </div>

                                        <div class="panel-body">
                                            <?php foreach($falta as $indice_02 => $aluno_paciente) : ?>
                                                  <div class="row-fluid">
                                                      <div class="form-group span12">
                                                         <label><?php echo $aluno_paciente['nome'] ?> - <?php echo $aluno_paciente['faltas'] ?> Faltas </label>
                                                         <a href="<?php echo URL . 'painel_controle/faltou_de_mais/' . $aluno_paciente['id_relacao'] . '/' . $aluno_paciente['id'] . '/' . $indice_01; ?>" class="btn btn-success marginL10 marginR10 marginT10" style="float: right;">Remover</a>
                                                         <a href="<?php echo URL . 'painel_controle/justificar_falta/' . $aluno_paciente['id_relacao'] . '/' . $aluno_paciente['id'] . '/' . $indice_01; ?>" class="btn btn-danger marginL10 marginR10 marginT10" style="float: right;">Justificar</a>
                                                        <button data-id="<?php echo $aluno_paciente['id']; ?>" type="button" class="justificativas btn btn-warning marginL10 marginR10 marginT10" data-tipo="aluno"  style="float: right;">Justificativas</button>

                                                      </div>
                                                  </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>

<script type="text/javascript">

$(document).ready(function() {
    $('.input_chamada').change(function(){
        var id_agendamento = $(this).data('id_agendamento');
        var id_aluno       = $(this).data('id_aluno');
        var id_paciente    = $(this).data('id_paciente');
        var tipo           = $(this).data('tipo');
        var aluno_paciente = typeof id_aluno !== 'undefined' && typeof id_paciente === 'undefined' ? 'aluno' : 'paciente';

        swal({
          title: "Atenção!",
          text: "Tem certeza que deseja marcar " + tipo + " para este " + aluno_paciente + "?",
          type: "warning",
          customClass: 'swal_btn_cancel',
          showCancelButton: true,
          confirmButtonColor: "#5cb85c",
          confirmButtonText: "Sim",
          cancelButtonColor: "#c9302c",
          cancelButtonText: "Não",
          closeOnConfirm: false
        },
        function(){
          window.location.href = "<?php echo URL; ?>agenda/fazer_chamada/" + id_agendamento + "/" + tipo + "/" + id_aluno + "/" + id_paciente;
        });

        $(this).attr('checked', false);
    });

    $('.justificativas').on('click', function(){
      var tipo = $(this).data('tipo');
      console.log(tipo);
      console.log($(this).data('id'));

        var justificativas = <?php echo $this->justificativas; ?>;

        var pacientes = $.map(justificativas.pacientes, function(value, index) {
            return [value];
        });

        var alunos = $.map(justificativas.alunos, function(value, index) {
            return [value];
        });

      console.log(justificativas);

      if(tipo == 'paciente'){
        if (typeof justificativas.pacientes[$(this).data('id')] !== 'undefined') {
          console.log(justificativas.pacientes[$(this).data('id')]);
        }
      }

      if(tipo == 'aluno'){
          console.log(alunos);
        if (typeof justificativas.alunos[$(this).data('id')] !== 'undefined') {
        }

      }


        // swal("Atenção!", "Ao selecionar esta opção, o paciente sera agentado toda "
        //   + dia_semana + " as " + $('#hora_consulta').val()
        //   + " até a data final da bateria. Neste caso, certifique-se de selecionar o dia da primeira consulta!", "info");
    });

});

</script>
