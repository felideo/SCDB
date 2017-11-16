<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="module-footer text-center">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-success botao_enviar pull-right">
                                <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?>Editar <?php echo $this->scope["modulo"]["send"];

}
else {
?>Cadastrar Novo <?php echo $this->scope["modulo"]["send"];

}?>

                            </button>

                            <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?>

                                <button type="button" onclick="window.history.back();" class="btn btn btn-danger botao_voltar pull-right marginR10">
                                    <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?>Cancelar<?php 
}
else {
?>Voltar<?php 
}?>

                                </button>
                            <?php 
}?>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>