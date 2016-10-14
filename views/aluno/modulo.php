<div class="span12">
    <h1 class="page-header">Modulos</h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo URL; ?>modulo/create">
            <div class="row-fluid">
                <div class="form-group span6">
                    <label>Modulo</label>
                    <input class="form-control" name="modulo[modulo]">
                </div>
                <div class="form-group span6">
                    <label>Nome de Exibição</label>
                    <input class="form-control" name="modulo[nome]">
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span4">
                    <label>Hierarquia</label>
                    <input class="form-control" name="modulo[hierarquia]">
                </div>
                <div class="form-group span8">
                    <label>Icone</label>
                    <input class="form-control" name="modulo[icone]">
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <button type="submit" class="btn btn-primary" style="float: right;">Enviar</button>
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
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Modulo</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Link</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Hierarquia</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Icone</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($this->modulo_list as $indice => $modulo) : ?>
                                        <tr role="row" class="gradeA odd">
                                            <td class="sorting_1"><?php echo $modulo['id']; ?></td>
                                            <td><?php echo $modulo['nome']; ?></td>
                                            <td>/<?php echo $modulo['modulo']; ?></td>
                                            <td><?php echo $modulo['hierarquia']; ?></td>
                                            <td><?php echo $modulo['icone']; ?></td>
                                            <td>
                                                <?php echo '<a href="' . URL . 'modulo/delete/' . $modulo['id'] . '"><i class="fa fa-trash-o fa-fw"></i></a></td>'; ?>
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

