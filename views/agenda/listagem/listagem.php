<?php
    if(\Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . '_criar')
        && isset($this->bateria_atual[0]['data_inicio'])
        && isset($this->bateria_atual[0]['data_fim'])
    ){
        include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/form.php';
    }
?>

<button id="open_horario_modal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#horario_modal" style="display: none">Open Modal</button>

<!-- Modal -->
<div id="horario_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="titulo_horario_modal" class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p id="texto_horario_modal"><strong>Paciente:</strong></p>
            </div>
            <div class="modal-footer">
                <button id="id_horario_modal" type="button" class="btn btn-danger" data-id_horario="">Cancelar Consulta</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div style="display: block; clear: both;"></div>
<div class="col-lg-12">
    <div id='calendar'></div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    $('#calendar').fullCalendar({
        contentHeight: 'auto',
        events: <?php echo $this->horarios_agendados ?>,
        eventRender: function (event, element) {
            element.attr('href', 'javascript:void(0);');
            element.click(function() {
                horario_modal(event);
            });
        }
    })


    $('#id_horario_modal').on('click', function(){

        $('#horario_modal').modal('hide');

        swal({
          title: "Atenção!",
          text: "Tem certeza que deseja desagendar essa consulta?",
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
          window.location.href = "<?php echo URL . $this->modulo['modulo']; ?>/delete/" + $('#id_horario_modal').attr('id_horario');
        });
    });

});

function horario_modal(event){

    var texto = '<strong>Paciente: ';

    $.each(event.className, function(index, item){
        texto += item + ' ';
    });

    texto = texto.replace('muda_1', ' </strong>').replace('muda_2', '<br><strong>Estagiario: ').replace('muda_3', '</strong>');
    console.log(event.id);

    $('#id_horario_modal').attr('id_horario', event.id );
    $('#titulo_horario_modal').html(moment(event.start).format('dddd[,] d [de] MMMM [de] YYYY HH[:00]'));
    $('#texto_horario_modal').html(texto);

    $("#open_horario_modal").trigger("click");
}



</script>

<div style="display: block; clear: both;"></div>
<div class="col-lg-12 marginT10">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <table aria-describedby="dataTables-example_info" role="grid" class="display table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" id="data_table">
                                <thead>
                                    <tr role="row">
                                        <?php
                                            foreach ($this->colunas_datatable as $indice => $coluna) {
                                                echo $coluna;
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($this->linhas_datatable)){
                                            foreach($this->linhas_datatable as $indice => $linhas){
                                                echo '<tr role="row" class="gradeA odd">';
                                                    foreach ($linhas as $indice => $coluna_linha) {
                                                        echo $coluna_linha;
                                                    }
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<script>
$(document).ready(function() {
    $('#data_table').DataTable({
        responsive: true,
        "order": [[ 0, "desc" ]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
        }
    });
});
</script>,