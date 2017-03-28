<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <label>Hierarquia</label>
         <br>
         <select class="form-group span12" name="<?php echo $this->scope["modulo"]["modulo"];?>[id_modulo]" >
            <?php 
$_fh0_data = (isset($this->scope["modulos"]) ? $this->scope["modulos"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

                <option value="<?php echo $this->scope["item"]["id"];?>" <?php if ((isset($this->scope["item"]["id"]) ? $this->scope["item"]["id"]:null) == (isset($this->scope["cadastro"]["id_modulo"]) ? $this->scope["cadastro"]["id_modulo"]:null)) {
?> selected <?php 
}?>>
                    <?php echo $this->scope["item"]["nome"];?>

                </option>
            <?php 
/* -- foreach end output */
	}
}?>

         </select>
    </div>
    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <label>Permissão</label>
        <input class="form-control somente_minusculas" name="<?php echo $this->scope["modulo"]["modulo"];?>[permissao]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["permissao"];

}?>" required>
    </div>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>