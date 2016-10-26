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
                    <label>Email</label>
                    <input class="form-control validar_email" name="<?php echo $this->modulo['modulo']; ?>[email]" value="<?php if(isset($this->cadastro)){echo $this->cadastro['email'];} ?>" required>
                </div>
                <div class="form-group span4">
                    <label>Senha</label>
                    <input class="form-control" type="password" name="<?php echo $this->modulo['modulo']; ?>[senha]" <?php if(!isset($this->cadastro)){echo 'required';} ?> >
                </div>
                <div class="form-group span4">
                     <label>Hierarquia</label>
                     <br>
                     <select class="form-group span12"name="<?php echo $this->modulo['modulo']; ?>[hierarquia]" >
                        <option></option>
                        <?php foreach ($this->hierarquia_list as $indice => $hierarquia) : ?>
                            <option value="<?php echo $hierarquia['id']?>" <?php if(isset($this->cadastro) && $this->cadastro['submenu'] == $submenu['id']){echo ' selected ';} ?> >
                                <?php echo $hierarquia['nome']; ?>
                            </option>
                        <?php endforeach ?>
                     </select>
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