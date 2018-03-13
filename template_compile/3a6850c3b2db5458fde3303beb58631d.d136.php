<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ?><section class="login-section auth-section">
    <div class="container">
        <div class="row">
            <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                <h1 class="form-box-heading logo text-center">
                    <span class="pe-icon pe-7s-box2 icon"></span><span class="highlight"><?php echo APP_NAME; ?></span>
                </h1>
                <div class="form-box-inner">
                    <h2 class="title text-center">Acesso</h2>
                    <div class="row">
                        <div class="form-container col-md-12 col-sm-12 col-xs-12">
                            <form  role="form" method="post" action="/acesso/run_back">
                                <div class="form-group email">
                                    <label class="sr-only" for="login-email">Email</label>
                                    <span class="fa fa-user icon"></span>
                                    <input id="login-email" type="email" class="form-control login-email validar_email" placeholder="Email" name="acesso[email]">
                                </div>

                                <div class="form-group password">
                                    <label class="sr-only" for="login-password">Senha</label>
                                    <span class="fa fa-lock icon"></span>
                                    <input id="login-password" type="password" class="form-control login-password" placeholder="Senha" name="acesso[senha]">
                                </div>

                                <button type="submit" class="btn btn-block btn-primary">Acessar</button>
                                <button id="recuperar_senha" type="button" class="btn btn-block btn-primary">Recuperar Senha</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('login.js.html', null, null, null, '_root', null));
 /* end template body */
return $this->buffer . ob_get_clean();
?>