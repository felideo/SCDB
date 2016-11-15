<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="login/run">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control validar_email" placeholder="Email" name="email" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                        </div>
                        <!-- <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div> -->
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Entrar">
                        <br>
                        <button id="recuperar_senha" type="button" class="btn btn-lg btn-primary btn-block">Recuperar Senha</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once '../' . strtolower(APP_NAME) . '/views/' . $this->modulo['modulo'] . '/login.js.php'; ?>
