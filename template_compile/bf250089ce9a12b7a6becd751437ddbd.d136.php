<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ?>

    <?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

    <?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array("modulos/".(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null)."/view/form/form.html", null, null, null, '_root', null));?>

    <?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>


<<<<<<< HEAD
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/listagem_padrao/listagem_padrao.html', null, null, null, '_root', null));
 /* end template body */
=======
<?php  /* end template body */
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
return $this->buffer . ob_get_clean();
?>