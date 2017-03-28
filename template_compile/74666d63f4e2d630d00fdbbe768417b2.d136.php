<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>


<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <label for="email">Nome do Site * :</label>
    <input class="form-control validar_email" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[email]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["email"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <label for="link">ID Google Analytics * :</label>
    <input class="form-control" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[link]"  value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["link"];

}?>" required>
</div>

<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <label for="link">Email para Notificações * :</label>
    <input class="form-control validar_email email_unico letras_e_numeros remover_caracteres_especiais" name="<?php echo $this->scope["modulo"]["modulo"];?>[email]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["email"];

}?>" required>
</div>

<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));
 /* end template body */
return $this->buffer . ob_get_clean();
?>