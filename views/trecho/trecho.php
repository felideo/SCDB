<div class="span12">
    <h1 class="page-header">Trechos</h1>
</div>

<div class="row-fluid span12">
    <form method="post" action="<?php echo URL; ?>trecho/create">
        <div class="row-fluid">
            <div class="form-group span12">
                <label>Localizacao</label>
                <input class="form-control" type="text" name="trecho[localizacao]"><br>
            </div>
        </div>
        <div class="row-fluid">
            <div class="form-group span12">
                <button type="submit" class="btn btn-primary" style="float: right;">Enviar</button>
            </div>
        </div>
    </form>
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
                                        <th aria-sort="descending" style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting_desc">ID</th>
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Localização</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php foreach($this->trechos_list as $indice => $trecho) : ?>
	                                    <tr role="row" class="gradeA odd">
	                                        <td class="sorting_1"><?php echo $trecho['id']; ?></td>
	                                        <td><?php echo $trecho['localizacao']; ?></td>
	                                        <td>
	                                        	<?php echo '<a href="' . URL . 'trecho/delete/' . $trecho['id'] . '"><i class="fa fa-trash-o fa-fw"></i></a></td>'; ?>
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