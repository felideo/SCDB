<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
if (! empty($this->scope["permissao_criar"])) {
?>

    <?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array("modulos/".(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null)."/view/form/form.html", null, null, null, '_root', null));?>

<?php 
}?>


<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/listagem_padrao/listagem_padrao.html', null, null, null, '_root', null));
 /* end template body */
return $this->buffer . ob_get_clean();
?>