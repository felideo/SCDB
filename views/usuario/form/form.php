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
                <div class="form-group span4">
                    <label>Nome de Usuario</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[email]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['email'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Senha</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[senha]" <?php if(!isset($this->cadastro)){echo 'required';} ?> >
                </div>
                <div class="form-group span4">
                    <label>Hierarquia</label>
                    <input class="form-control" name="<?php echo $this->modulo['modulo']; ?>[hierarquia]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['hierarquia'];} ?>" required>
                </div>
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