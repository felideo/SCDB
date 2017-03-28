<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <label for="autor">Titulo * :</label>
    <input class="form-control" type="text" name="<?php echo $this->scope["modulo"]["modulo"];?>[titulo]"  value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["titulo"];

}?>" required>

	<div class="module-content collapse in" id="content-1">
		<div class="module-content-inner no-padding-bottom">
			<label for="autor">Conteúdo *:</label>
			<textarea name="<?php echo $this->scope["modulo"]["modulo"];?>[conteudo]" id="wysihtml5-editor" rows="20" class="form-control"><?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["conteudo"];

}?></textarea>
		</div>
	</div>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>