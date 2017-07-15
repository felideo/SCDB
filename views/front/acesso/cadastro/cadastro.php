<!-- ******LOGIN****** -->
<section id="contact" class="contact section has-pattern" style="min-height: 84vh;">
    <div class="container">

<?php debug2($this->cadastro) ?>

        <div class="row text-center">
            <h2 class="title">Cadastro</h2>
            <div class="intro col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                <?php if(!isset($this->cadastro)) : ?>
                    <p>Para que seja possivel efetuar a inserção de novos organismos ou trablhos, seu cadastro precisará ser aprovado por um administrador.</p>
                <?php endif ?>
            </div>
        </div><!--//row-->
value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa']['']; } ?>"
        <div class="row ">
            <?php if(!isset($this->cadastro['pessoa'])) : ?>
                <form class="form" method="post" action="usuario_create">
            <?php else : ?>
                <form class="form" method="post" action="/usuario/update_perfil/<?php echo $this->cadastro['id'] ?>">
            <?php endif ?>
                <div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="row-fluid">
                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Pronome de tratamento</label>
                            <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="usuario[pronome]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['pronome']; } ?>" type="text" >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <label>Nome</label>
                            <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="usuario[nome]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['nome']; } ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Sobrenome</label>
                            <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="usuario[sobrenome]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['sobrenome']; } ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Instituição/Afiliação</label>
                            <input class="form-control letras_e_numeros remover_caracteres_especiais embelezar_string" name="usuario[instituicao]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['instituicao']; } ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Area de Atuação</label>
                            <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="usuario[atuacao]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['atuacao']; } ?>" type="text" required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <label>Link Currículo Lattes</label>
                            <input class="form-control" name="usuario[lattes]" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['pessoa'][0]['lattes']; } ?>" type="text" >
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label>Grau </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="1" type="radio" <?php if(isset($this->cadastro['pessoa']) && $this->cadastro['pessoa'][0]['grau'] == 1){ echo 'checked'; } ?> required> Aluno de Graduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="2" type="radio" <?php if(isset($this->cadastro['pessoa']) && $this->cadastro['pessoa'][0]['grau'] == 2){ echo 'checked'; } ?> required> Aluno Pós greduação
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="3" type="radio" <?php if(isset($this->cadastro['pessoa']) && $this->cadastro['pessoa'][0]['grau'] == 3){ echo 'checked'; } ?> required> Professor
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" type="radio" <?php if(isset($this->cadastro['pessoa']) && $this->cadastro['pessoa'][0]['grau'] == 4){ echo 'checked'; } ?> required> Pesquisador
                            </label>
                            <label class="radio-inline">
                                <input name="usuario[grau]" value="4" type="radio" <?php if(isset($this->cadastro['pessoa']) && $this->cadastro['pessoa'][0]['grau'] == 5){ echo 'checked'; } ?> required> Outros
                            </label>
                        </div>


                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Email</label>
                            <input class="form-control validar_email letras_e_numeros remover_caracteres_especiais email_unico somente_minusculas" name="usuario[email]" type="email" value="<?php if(isset($this->cadastro['pessoa'])){ echo $this->cadastro['email']; } ?>" <?php if(isset($this->cadastro['pessoa'])){ echo ' disabled '; } ?> required >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Senha</label>
                            <input class="form-control validar_senha" name="usuario[senha]" type="password" <?php if(!isset($this->cadastro)){ echo ' required '; }?>  >
                        </div>

                        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <label>Confirmar Senha</label>
                            <input class="form-control validar_senha" name="usuario[senha]" type="password" <?php if(!isset($this->cadastro)){ echo ' required '; }?>  >
                        </div>
                    </div>








                    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <?php if(!isset($this->cadastro)) : ?>
                            <a href="login" class="btn btn-lg btn-theme">Entrar</a>
                            <button type="submit" class="btn btn-lg btn-theme">Cadastrar</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-lg btn-theme">Salvar</button>
                        <?php endif ?>
                    </div>
                </div>
            </form><!--//form-->
        </div><!--//row-->


    </div><!--//container-->
</section><!--//login-->