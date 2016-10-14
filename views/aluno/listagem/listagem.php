<div class="span12">
    <h1 class="page-header"><?php echo $this->modulo['name']; ?></h1>
</div>

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/form.php'; ?>

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
                                        <th aria-sort="ascending" style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting_asc">ID</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Nome</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Curso</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Semestre</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Turma</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">RGM</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($this->aluno_list as $indice => $aluno) : ?>
                                        <tr role="row" class="gradeA odd">
                                            <td class="sorting_1"><?php echo $aluno['id']; ?></td>
                                            <td><?php echo $aluno['nome']; ?></td>
                                            <td><?php echo $aluno['curso']; ?></td>

                                            <td><?php echo $aluno['semestre']; ?></td>
                                            <td><?php echo $aluno['turma']; ?></td>
                                            <td><?php echo $aluno['rgm']; ?></td>
                                            <td>
                                                <?php echo '<a href="' . URL . $this->modulo['modulo'] . '/editar/' . $aluno['id'] .  '" title="Editar"><i class="fa fa-pencil fa-fw"></i></a>'; ?>
                                                <?php echo '<a href="' . URL . $this->modulo['modulo'] . '/delete/' . $aluno['id'] . '/' . $aluno['id_usuario'] . '"><i class="fa fa-trash-o fa-fw"></i></a></td>'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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
</script>


