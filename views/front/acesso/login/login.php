<!-- ******LOGIN****** -->
<section id="contact" class="contact section has-pattern" style="min-height: 84vh;">
    <div class="container">
        <div class="row text-center">
            <h2 class="title">Login</h2>
            <div class="intro col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis nunc velit, mattis ultrices nisi dignissim vitae. Aenean convallis urna convallis accumsan accumsan.</p>
            </div>
        </div><!--//row-->
        <div class="row text-center">
            <div class="contact-form col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                <form class="form" method="post" action="run">

                    <div class="form-group name">
                        <label class="sr-only" for="name">email</label>
                        <input class="form-control validar_email letras_e_numeros remover_caracteres_especiais" placeholder="Email" name="acesso[email]" type="text" autofocus>
                    </div><!--//form-group-->
                    <div class="form-group email">
                        <label class="sr-only" for="email">senha</label>
                        <input class="form-control" placeholder="Senha" name="acesso[senha]" type="password" value="">
                    </div><!--//form-group-->
                    <button type="submit" class="btn btn-lg btn-theme">Entrar</button>
                    <a href="cadastro" class="btn btn-lg btn-theme">Cadastre-se</a>
					<button class="btn btn-lg btn-theme" id="recuperar_senha" type="button" >Recuperar Senha</button>

                </form><!--//form-->
            </div><!--//contact-form-->
        </div><!--//row-->

    </div><!--//container-->
</section><!--//login-->

<?php require 'views/front/acesso/login/login.js.php'; ?>
