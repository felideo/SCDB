<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="col-lg-6 col-md-6"><i class="fa fa-link  fa-fw"> </i> Relação Aluno x Paciente </h4>
                <button id="clone_relacao" type="button" class="btn btn-primary" style="float: right;"> <i class="fa fa-plus fa-fw"> </i> Adicionar Relação </button>
                <div style="display:block; clear: both;"></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group" id="container_clone">
                    <div id="nenhum_clone_adicionado">Nenhum item adicionado.</div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4" id="clonar" style="display: none;">
        <div class="panel panel-default" data-id_clone="$id_clone" id="clone_$id_clone">
            <div class="panel-heading">
                <h4> <i class="fa fa-link fa-fw"> </i> Relação Aluno x Pacinete $id_clone</h4>
                <button type="button" class="btn btn-primary remove-box" data-id_remover="$id_clone" style="float: right;"> <i class="fa fa-minus fa-fw"> </i> Remover </button>
                <div style="display:block; clear: both;"></div>
            </div>
            <div class="panel-body">
                <div class="row-fluid">
                    <div class="form-group span6" id="relacao_aluno_$id_clone">
                         <label>Aluno:</label>
                         <br>
                         <select class="form-group span12" name="relacao_aluno_paciente[$id_clone][relacao][aluno]" required disabled >
                            <option ></option>
                            <?php foreach ($this->aluno_list as $indice => $aluno) : ?>
                                <option value="<?php echo $aluno['id']?>" >
                                    <?php echo $aluno['nome']; ?>
                                </option>
                            <?php endforeach ?>
                         </select>
                    </div>
                    <div class="form-group span6" id="relacao_paciente_$id_clone">
                         <label>Paciente:</label>
                         <br>
                         <select class="form-group span12" name="relacao_aluno_paciente[$id_clone][relacao][paciente]" required disabled >
                            <option></option>
                            <?php foreach ($this->paciente_list as $indice => $paciente) : ?>
                                <option value="<?php echo $paciente['id']?>" >
                                    <?php echo $paciente['nome']; ?>
                                </option>
                            <?php endforeach ?>
                         </select>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-4 -->
</div>

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/form/clone_relacao/clone_relacao.js.php'; ?>




