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
                                        <th aria-sort="ascending" style="width: 30px;" colspan="1" rowspan="1" tabindex="0">ID</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Nome</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting"  class="sorting_asc">Idade</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Sexo</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Patologia</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($this->listagem_candidatos as $indice => $candidato) : ?>
                                        <tr role="row" class="gradeA odd">
                                            <td class="sorting_1"><?php echo $candidato['id']; ?></td>
                                            <td><?php echo $candidato['nome']; ?></td>

                                            <?php
                                                $nascimento = new DateTime($candidato['nascimento']);
                                                $hoje = new DateTime(date('Y-m-d'));
                                                $diferenca = $nascimento->diff($hoje);

                                                // $idade = $diferenca->y . ' anos e ' . $diferenca->m . ' meses';
                                                $idade = $diferenca->y . ' anos';

                                            ?>

                                            <td><?php echo $idade; ?></td>
                                            <td><?php echo ($candidato['sexo'] == 1) ? 'Masculino' : 'Feminino'; ?></td>


                                            <td><?php echo $candidato['patologia']; ?></td>
                                            <td>
                                                <!-- ZZZ: Configuração de hierarquia transforar em paciente -->
                                                <?php echo '<a href="#" class="transformar_paciente" data-id-paciente="' . $candidato['id'] . '" title="Transformar em Paciente"><i class="fa fa-check-circle fa-fw"></i></a>'; ?>
                                                <?php echo '<a href="#" class="transformar_ex_paciente" data-id-paciente="' . $candidato['id'] . '" title="Transformar em EX Paciente"><i class="fa fa-times-circle fa-fw"></i></a>'; ?>

                                                <?php echo '<a href="' . URL . $this->modulo['modulo'] . '/editar/' . $candidato['id'] . '" title="Editar"><i class="fa fa-pencil fa-fw"></i></a>'; ?>
                                                <?php echo '<a href="' . URL . $this->modulo['modulo'] . '/delete/' . $candidato['id'] . '"><i class="fa fa-trash-o fa-fw"></i></a></td>'; ?>
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

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/listagem/listagem.js.php'; ?>