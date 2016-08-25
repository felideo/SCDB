<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $this->modulo['name']; ?></h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="install/install">
                    <fieldset>
                        <div class="panel-heading">
                            <h3 class="panel-title">Database</h3>
                        </div>
                        <div class="form-group">
                            <input
                            class="form-control" placeholder="Host" name="database[host]" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Database Name" name="database[name]" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="User" name="database[user]" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="database[password]" type="text" autofocus>
                        </div>

                        <div class="panel-heading">
                            <h3 class="panel-title">Usuário</h3>
                        </div>

                        <div class="form-group">
                            <input id="usuario" class="form-control" placeholder="Usuario" name="user[usuario]" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Senha" name="user[senha]" type="text" autofocus>
                        </div>
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="<?php echo $this->modulo['send']; ?>">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#usuario').change(function(){
            er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
            if(!er.exec($('#usuario').val())){
                swal("Erro!", "O nome de usuário dever ser um e-mail válido.", "error");
                $('#usuario').val('');
            }
        });
    });

</script>