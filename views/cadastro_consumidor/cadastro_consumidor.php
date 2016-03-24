<div class="col-lg-12">
    <h1 class="page-header">Consumidores</h1>
</div>

	<form method="post" action="<?php echo URL; ?>cadastro_consumidor/cadastrar_consumidor">
		<label>Nome</label><input type="text" name="consumidor_cadastro[nome]"><br>
		<label>Telefone</label><input type="text" name="consumidor_cadastro[telefone]"><br>
		<label>E-Mail</label><input type="text" name="consumidor_cadastro[email]"><br>
		<label>Apartamento</label><input type="text" name="consumidor_cadastro[apartamento]"><br>
		<label>&nbsp;</label><input type="submit">
	</form>