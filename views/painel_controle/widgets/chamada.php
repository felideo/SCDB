
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Comparecimento
            </div>
            <div class="panel-body">
                <?php if(isset($this->chamada)) : ?>
                    <?php foreach ($this->chamada as $indice => $chamada) : ?>
                        <?php if(!empty($chamada['agendamento_data']) && !empty($chamada['id_paciente']) || !empty($chamada['id_aluno'])) : ?>
                            <div class="row">
                                 <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Dia: <?php echo \DateTime::createFromFormat('Y-m-d', $chamada['agendamento_data'])->format('Y-m-d'); ?>
                                        </div>

                                        <div class="panel-body">
                                            <?php if(empty($chamada['presenca_paciente']) && !empty($chamada['id_paciente'])) : ?>
                                                <div class="row-fluid">
                                                    <div class="form-group span12">
                                                        <label><?php echo "Paciente: " . $chamada['nome_paciente'] ?> </label>
                                                        <div class="form-group">
                                                            <label class="radio-inline">
                                                                <input name="input_chamada_<?php echo $chamada['id_agendamento']; ?>" class="input_chamada" data-id_agendamento="<?php echo $chamada['id_agendamento']; ?>" data-id_paciente="<?php echo $chamada['id_paciente']; ?>"  data-tipo="presença" type="radio"> Compareceu
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input name="input_chamada_<?php echo $chamada['id_agendamento']; ?>" class="input_chamada" data-id_agendamento="<?php echo $chamada['id_agendamento']; ?>" data-id_paciente="<?php echo $chamada['id_paciente']; ?>"  data-tipo="falta" type="radio"> Não Compareceu
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(empty($chamada['presenca_aluno']) && !empty($chamada['id_aluno'])) : ?>
                                                <div class="row-fluid">
                                                    <div class="form-group span12">
                                                        <label><?php echo "Aluno: " . $chamada['nome_aluno'] ?> </label>
                                                        <div class="form-group">
                                                            <label class="radio-inline">
                                                                <input name="input_chamada_<?php echo $chamada['id_agendamento']; ?>" class="input_chamada" data-id_agendamento="<?php echo $chamada['id_agendamento']; ?>" data-id_aluno="<?php echo $chamada['id_aluno']; ?>"  data-tipo="presença" type="radio"> Compareceu
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input name="input_chamada_<?php echo $chamada['id_agendamento']; ?>" class="input_chamada" data-id_agendamento="<?php echo $chamada['id_agendamento']; ?>" data-id_aluno="<?php echo $chamada['id_aluno']; ?>"  data-tipo="falta" type="radio"> Não Compareceu
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
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
