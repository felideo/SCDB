<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>


<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <label for="autor">Autor * :</label>
    <input class="form-control embelezar_string somente_letras" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[nome]"  value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["nome"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <label for="email">Email * :</label>
    <input class="form-control validar_email" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[email]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["email"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <label for="link">Lattes/Site * :</label>
    <input class="form-control" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[link]"  value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["link"];

}?>" required>
</div>

<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>