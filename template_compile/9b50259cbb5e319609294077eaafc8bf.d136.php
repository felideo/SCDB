<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Modulo</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[modulo]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["modulo"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Nome de Exibição</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[nome]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["nome"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
     <label>Submenu</label>
     <br>
     <select class="form-group span12"name=<?php echo $this->scope["modulo"]["modulo"];?>[id_submenu]" style="width: 100%;">
        <option></option>

        <?php 
$_fh0_data = (isset($this->scope["submenu_list"]) ? $this->scope["submenu_list"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['submenu'])
	{
/* -- foreach start output */
?>

            <option value="<?php echo $this->scope["submenu"]["id"];?>" <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null) && (isset($this->scope["cadastro"]["id_submenu"]) ? $this->scope["cadastro"]["id_submenu"]:null) == (isset($this->scope["submenu"]["id"]) ? $this->scope["submenu"]["id"]:null)) {
?> selected <?php 
}?> >
                <?php echo $this->scope["submenu"]["nome_exibicao"];?>

            </option>
        <?php 
/* -- foreach end output */
	}
}?>

     </select>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4" style="min-height: 68px;">
    <label>Acesso</label>
    <br>
    <label class="radio-inline">
        <input name=<?php echo $this->scope["modulo"]["modulo"];?>[hierarquia]" value="0" type="radio" <?php if (((isset($this->scope["cadastro"]["hierarquia"]) ? $this->scope["cadastro"]["hierarquia"]:null) !== null) && (isset($this->scope["cadastro"]["hierarquia"]) ? $this->scope["cadastro"]["hierarquia"]:null) == 0) {
?>  checked <?php 
}?> >Super Admin
    </label>
    <label class="radio-inline">
        <input name=<?php echo $this->scope["modulo"]["modulo"];?>[hierarquia]" value="1" type="radio" <?php if (((isset($this->scope["cadastro"]["hierarquia"]) ? $this->scope["cadastro"]["hierarquia"]:null) !== null) && (isset($this->scope["cadastro"]["hierarquia"]) ? $this->scope["cadastro"]["hierarquia"]:null) == 1) {
?>  checked <?php 
}?> >Hierarquico
    </label>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Icone</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[icone]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["icone"];

}?>" required>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <label>Ordem</label>
    <input class="form-control" name=<?php echo $this->scope["modulo"]["modulo"];?>[ordem]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["ordem"];

}?>" required>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>