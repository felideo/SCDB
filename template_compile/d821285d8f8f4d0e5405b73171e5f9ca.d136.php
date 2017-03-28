<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <label>Palavra Chave</label>
    <input class="form-control somente_letras remover_caracteres_especiais"  name="<?php echo $this->scope["modulo"]["modulo"];?>[palavra_chave]"  value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["palavra_chave"];

}?>" required>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>


<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>