<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <label>Email</label>
        <input class="form-control validar_email email_unico letras_e_numeros remover_caracteres_especiais" <?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {
?> disabled <?php 
}?> name="<?php echo $this->scope["modulo"]["modulo"];?>[<?php echo $this->scope["modulo"]["modulo"];?>][email]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["email"];

}?>" required>
    </div>
    <div class="contact-form form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <label>Hierarquia</label>
         <br>
         <select class="form-group span12" name="<?php echo $this->scope["modulo"]["modulo"];?>[<?php echo $this->scope["modulo"]["modulo"];?>][hierarquia]" >
            <option disabled>Selecnione</option>
            <?php 
$_fh0_data = (isset($this->scope["hierarquia_list"]) ? $this->scope["hierarquia_list"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['hierarquia'])
	{
/* -- foreach start output */
?>

                <option value="<?php echo $this->scope["hierarquia"]["id"];?>" <?php if ((isset($this->scope["hierarquia"]["id"]) ? $this->scope["hierarquia"]["id"]:null) == (isset($this->scope["cadastro"]["hierarquia"]) ? $this->scope["cadastro"]["hierarquia"]:null)) {
?> selected <?php 
}?>>
                    <?php echo $this->scope["hierarquia"]["nome"];?>

                </option>
            <?php 
/* -- foreach end output */
	}
}?>

         </select>
    </div>
</div>

<div class="contact-form form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row-fluid">
        <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <label>Nome</label>
            <input class="form-control embelezar_string letras_e_numeros" name="<?php echo $this->scope["modulo"]["modulo"];?>[pessoa][nome]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["pessoa"]["0"]["nome"];

}?>" type="text" required >
        </div>

        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <label>Sobrenome</label>
            <input class="form-control embelezar_string letras_e_numeros" name="<?php echo $this->scope["modulo"]["modulo"];?>[pessoa][sobrenome]" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["pessoa"]["0"]["sobrenome"];

}?>" type="text" required >
        </div>

    </div>
</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>