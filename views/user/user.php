<!-- 	<form method="post" action="<?php echo URL; ?>user/create">
		<label>Username</label><input type="text" name="username"><br>
		<label>Password</label><input type="text" name="password"><br>
		<label>Role</label>
		<select name="role">
			<option value="default">Default</option>
			<option value="admin">Admin</option>
		</select><br>
		<label>&nbsp;</label><input type="submit">
	</form> -->

<div class="col-lg-12">
    <h1 class="page-header">Usuarios</h1>
</div>
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
                                        <th style="width: 200px;" colspan="1" rowspan="1" tabindex="0" class="sorting">User Name</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Hierarquia</th>
                                        <th style="width: 30px;" colspan="1" rowspan="1" tabindex="0" class="sorting">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php foreach($this->userList as $indice => $usuario) : ?>
	                                    <tr role="row" class="gradeA odd">
	                                        <td class="sorting_1"><?php echo $usuario['userid']; ?></td>
	                                        <td><?php echo $usuario['username']; ?></td>
	                                        <td><?php echo $usuario['hierarquia']; ?></td>
	                                        <td>
	                                        	<?php echo '<a href="'.URL.'user/edit/'.$usuario['userid'].'" title="Editar"><i class="fa fa-pencil fa-fw"></i></a>'; ?>
	                                        	<?php
	                                        		if($_SESSION['usuario']['id'] != $usuario['userid']) {
	                                        	 		echo '<a href="'.URL.'user/delete/'.$usuario['userid'].'"><i class="fa fa-trash-o fa-fw"></i></a></td>';
	                                        	 	}
	                                        	 ?>
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

