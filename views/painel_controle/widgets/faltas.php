    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Faltas
            </div>
            <div class="panel-body">
                    <?php foreach ($this->faltas as $indice_01 => $falta) : ?>
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
                                                         <a href="<?php echo URL . 'painel_controle/faltou_de_mais/' . $aluno_paciente['id_relacao'] . '/' . $aluno_paciente['id'] . '/' . $indice_01; ?>" class="btn btn-success marginL10" style="float: right;">Remover</a>
                                                         <!-- <a href="#" class="btn btn-warning" style="float: right;">Justificar</a> -->
                                                      </div>
                                                  </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
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

});

</script>
