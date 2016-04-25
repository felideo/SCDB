<div class="span12">
    <h1 class="page-header">Hidroconsul</h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo URL; ?>hidroconsul/create">
            <div class="row-fluid">
                <div class="form-group span4">
                    <label>Associar ao Hidrometro de Controle</label>
                    <select name="hidroconsul[id_trecho]" class="span6">
                        <option>Selecione um Hidrometro</option>
                        <?php foreach ($this->hidrocontrol_list as $key => $hidrometro) : ?>
                            <option value="<?php echo $hidrometro['id'] . '+++' . $hidrometro['id_trecho']; ?>"><?php echo $hidrometro['id'] . ' - ' . $hidrometro['localizacao']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group span4">
                    <div class="form-group span12">
                        <label>Localizacao</label>
                        <input class="form-control" type="text" name="hidroconsul[localizacao]"><br>
                    </div>
                </div>

                <div class="form-group span4">
                    <div class="form-group span12">
                        <button type="submit" class="btn btn-primary" style="float: right;">Enviar</button>
                    </div>
                </div>
            </div>
       </form>
    </div>
</div>
<div style="display: block; clear: both;">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                                <thead>
                                    <tr role="row">
                                        <th aria-sort="ascending" style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting_asc">ID</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Localização</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($this->hidroconsul_list as $indice => $hidroconsul) : ?>
                                        <tr role="row" class="gradeA odd">
                                            <td class="sorting_1"><?php echo $hidroconsul['id']; ?></td>
                                            <td><?php echo $hidroconsul['localizacao']; ?></td>
                                            <td>
                                                <?php echo '<a href="' . URL . 'hidroconsul/delete/' . $hidroconsul['id'] . '"><i class="fa fa-trash-o fa-fw"></i></a></td>'; ?>
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