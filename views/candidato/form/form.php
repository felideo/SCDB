<div class="row-fluid">
    <div class="span12">
        <form method="post"
            <?php if(isset($this->cadastro)) : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/update/<?php echo $this->cadastro['id']; ?>"
            <?php else : ?>
                action="<?php echo URL . $this->modulo['modulo']; ?>/create"
            <?php endif ?>
        >

            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome do Paciente</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[nome]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nome'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome do Pai</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[pai]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['pai'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Nome da Mãe</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[mae]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['mae'];} ?>" required>
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span4">
                    <label>Data de Nascimento</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[nascimento]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['nascimento'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Sexo</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[sexo]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['patologia'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Hipótese de Patologia</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[patologia]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['patologia'];} ?>" required>
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group span4">
                    <label>Telefone</label>
                    <input class="form-control" name="contato[telefone]" value="<?php if(isset($this->contato)){echo $this->contato['telefone'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Celular</label>
                    <input class="form-control" name="contato[celular]" value="<?php if(isset($this->contato)){echo $this->contato['celular'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Email</label>
                    <input class="form-control" name="contato[email]" value="<?php if(isset($this->contato)){echo $this->contato['email'];} ?>" required>
                </div>
            </div>


            <div class="row-fluid">
                <div class="form-group span2">
                    <label>CEP</label>
                    <input class="form-control" name="endereco[cep]" value="<?php if(isset($this->endereco)){echo $this->endereco['submenu'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span10">
                    <label>Rua</label>
                    <input class="form-control" name="endereco[rua]" value="<?php if(isset($this->endereco)){echo $this->endereco['hierarquia'];} ?>" required>
                </div>
                <div class="form-group span2">
                    <label>Numero</label>
                    <input class="form-control" name="endereco[numero]" value="<?php if(isset($this->endereco)){echo $this->endereco['icone'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <label>Complemento</label>
                    <input class="form-control" name="endereco[complemento]" value="<?php if(isset($this->endereco)){echo $this->endereco['hierarquia'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid">
                <div class="form-group span5">
                    <label>Bairro</label>
                    <input class="form-control" name="endereco[bairro]" value="<?php if(isset($this->endereco)){echo $this->endereco['icone'];} ?>" required>
                </div>
                <div class="form-group span5">
                    <label>Cidade</label>
                    <input class="form-control" name="endereco[cidade]" value="<?php if(isset($this->endereco)){echo $this->endereco['icone'];} ?>" required>
                </div>
                <div class="form-group span2">
                    <label>UF</label>
                    <input class="form-control" name="endereco[uf]" value="<?php if(isset($this->endereco)){echo $this->endereco['icone'];} ?>" required>
                </div>
            </div>
            <div class="row-fluid marginB10">
                <label>Descrição do Caso</label>
                <textarea rows="10" cols="88" name="<?php echo $this->modulo['modulo']; ?>[icone]">
                </textarea>
            </div>
            <div class="row-fluid">
                <div class="form-group span12">
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <?php if(isset($this->cadastro)) : ?>
                            Editar <?php echo $this->modulo['send']; ?>
                        <?php else : ?>
                            Cadastrar Novo <?php echo $this->modulo['send']; ?>
                        <?php endif?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>