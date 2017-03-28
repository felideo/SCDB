<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ;
echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/header.html', null, null, null, '_root', null));?>

<div class="row-fluid">
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <label>Nome</label>
        <input class="form-control somente_letras remover_caracteres_especiais embelezar_string" name="<?php echo $this->scope["modulo"]["modulo"];?>" value="<?php if (((isset($this->scope["cadastro"]) ? $this->scope["cadastro"] : null) !== null)) {

echo $this->scope["cadastro"]["nome"];

}?>" required>
    </div>
</div>

<div class="row">
    <?php 
$_fh1_data = (isset($this->scope["permissoes_list"]) ? $this->scope["permissoes_list"] : null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['modulo_permissao'])
	{
/* -- foreach start output */
?>

        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa <?php echo $this->scope["modulo_permissao"]["modulo"]["icone"];?> fa-fw"></i><?php echo $this->scope["modulo_permissao"]["modulo"]["nome"];?></h4>
                </div>
                <div class="panel-body">

                    <?php 
$_fh0_data = (isset($this->scope["modulo_permissao"]["permissoes"]) ? $this->scope["modulo_permissao"]["permissoes"]:null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['permissao'])
	{
/* -- foreach start output */
?>

                        <div class="checkbox">
                            <label>
                                <input
                                    class="permissao_hierarquia"
                                    id="<?php echo $this->scope["modulo_permissao"]["modulo"]["modulo"];?>_<?php echo $this->scope["permissao"]["permissao"];?>"
                                    value="<?php echo $this->scope["permissao"]["id"];?>"
                                    name="hierarquia_relaciona_permissao[]"
                                    type="checkbox"
                                    data-permissao="<?php echo $this->scope["permissao"]["permissao"];?>"
                                    data-modulo="<?php echo $this->scope["modulo_permissao"]["modulo"]["modulo"];?>"
                                    <?php if (($this->readVar("cadastro.hierarquia_relaciona_permissao..".(isset($this->scope["permissao"]["id"]) ? $this->scope["permissao"]["id"]:null)) !== null) && (isset($this->scope["permissao"]["id"]) ? $this->scope["permissao"]["id"]:null) == $this->readVar("cadastro.hierarquia_relaciona_permissao..".(isset($this->scope["permissao"]["id"]) ? $this->scope["permissao"]["id"]:null).".permissao.0.id")) {
?> checked <?php 
}?>

                                >
                                    <?php echo ucwords((isset($this->scope["permissao"]["nome"]) ? $this->scope["permissao"]["nome"]:null));?>

                            </label>
                        </div>

                    <?php 
/* -- foreach end output */
	}
}?>

                </div>
            </div>
        </div>
    <?php 
/* -- foreach end output */
	}
}?>

</div>
<?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/form_padrao/footer.html', null, null, null, '_root', null));?>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>