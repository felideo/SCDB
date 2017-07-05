<!-- ******LOGIN****** -->
<section id="contact" class="contact section has-pattern" style="min-height: 84vh;">
    <div class="container">

        <div class="row text-center">
            <h2 class="title">Cadastro</h2>
            <div class="intro col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                <p>Para que seja possivel efetuar a inserção de novos organismos ou trablhos, seu cadastro precisará ser aprovado por um administrador.</p>
            </div>
        </div><!--//row-->

        <div class="row ">
            <form class="form" method="post" action="usuario_create">
                <div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Pronome de tratamento</label>
                            <input class="form-control" name="usuario[pronome]" type="text" >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Nome</label>
                            <input class="form-control embelezar_string" name="usuario[nome]" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Sobrenome</label>
                            <input class="form-control embelezar_string" name="usuario[sobrenome]" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Instituição/Afiliação</label>
                            <input class="form-control" name="usuario[instituicao]" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Area de Atuação</label>
                            <input class="form-control" name="usuario[atuacao]" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Link Currículo Lattes</label>
                            <input class="form-control" name="usuario[lattes]" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Grau </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="1" type="radio" required> Aluno de Graduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="2" type="radio" required> Aluno Pós greduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="3" type="radio" required> Professor
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" type="radio" required> Pesquisador
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" type="radio" required> Outros
                            </label>
                        </div>


                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Email</label>
                            <input class="form-control validar_email letras_e_numeros remover_caracteres_especiais email_unico" name="usuario[email]" type="email" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Senha</label>
                            <input class="form-control validar_senha" name="usuario[senha]" type="password" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Confirmar Senha</label>
                            <input class="form-control validar_senha" name="usuario[senha]" type="password" required >
                        </div>
                    </div>








                    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <button type="submit" class="btn btn-lg btn-theme">Cadastrar</button>
                        <a href="login" class="btn btn-lg btn-theme">Entrar</a>
                    </div>
                </div>
            </form><!--//form-->
        </div><!--//row-->


    </div><!--//container-->
</section><!--//login-->