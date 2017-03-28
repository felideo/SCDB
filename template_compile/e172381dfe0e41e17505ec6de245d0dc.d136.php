<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Nome</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[nome]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["nome"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Nome de Exibição</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[nome_exibicao]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["nome_exibicao"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Icone</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[icone]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["icone"];

}?>" required>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>