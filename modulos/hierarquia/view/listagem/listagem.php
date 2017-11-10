<?php
    if(\Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . '_criar')){
        require 'modulos/' . $this->modulo['modulo'] . '/view/form/form.php';
    }
?>

<div style="display: block; clear: both;">
<div class="col-lg-12">
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

