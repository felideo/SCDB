<div class=".col-xs-12 text-center">
    <h3 class="page-header"><?php echo APP_NAME; ?></h3>
    <!-- <p>Sistema de Gerenciamento de Recursos Hídricos</p> -->
</div>

<!-- /.col-lg-12 -->
<style type="text/css">
*{
	margin: 0;
	padding: 0;
}

html, body{
	width: 100%;
	height: 100%;

}

.sempre_igual{
	display: block;
	float: left;
	position: relative;
}

.content{
	width: 100%;
	height: 100%;
	display: table;
	background: #DCDCDC;
	background-repeat: no-repeat;
	background-size: 100% 100%;
}

.center{
	vertical-align: middle;
	display: table-cell;
	padding: 10px;

}

#esquerda {
	width: 30%;
	height: 100%;
	display: table;
    text-align: justify;
    text-justify: inter-word;
	border-right: solid 1px #000000;
}

#direita {
	width: 70%;
	height: 100%;
	display: table;
    text-align: justify;
    text-justify: inter-word;
}

#nome {
	width: 100%;
	display: table;
	padding: 10px;

}

#foto {
	width: 100%;
	display: table;
	padding: 10px;

}

#tipo {
	width: 100%;
	display: table;
	padding: 10px;

}

#resumo {
	width: 100%;
	display: table;
	padding: 10px;
	border-bottom: solid 1px #000000;


}

#link {
	width: 100%;
	display: table;
	padding: 10px;
}

#foto img {
	width: 200px;
}

#quadrados {
	background: #F5F5F5;
	margin: 10px;
	border-radius: 20px;
}

</style>

<p>Bio-SenseLab é o grupo de pesquisa formado por professores pesquisadores da Universidade Mogi Das Cruzes - UMC e com sede no Núcleo de Pesquisas Tecnológicas (NPT - UMC). Entre os objetivos do grupo está o de desenvolver pesquisa de impacto tecnológico e social que visa contribuir na melhoria da qualidade de vida do individuo e no tratamento de dados biológicos.</p>
<p>Atualmente o grupo se destaca no desenvolvimento de aplicações assistivas, sistemas para monitoramento de sinais vitais, ferramentas e plataformas para armazenamento e tratamento de dados biológicos etc. </p>

<div class="content sempre_igual">
<?php foreach($this->listagem_colaboradores as $indice => $colaborador) : ?>
	<div id="quadrados" class="center sempre_igual">
		<div id="esquerda" class="sempre_igual">
			<div id="nome" class="sempre_igual"><?php echo $colaborador['nome'] ?></div>
			<div id="foto" class="sempre_igual"><img src="<?php echo URL; ?>imagens/colaboradores/<?php echo $colaborador['imagem'] ?>"></div>
			<div id="tipo" class="sempre_igual"><?php echo $colaborador['tipo'] ?></div>
		</div>

		<div id="direita" class="sempre_igual">
			<div id="resumo" class="sempre_igual">	<?php echo $colaborador['resumo'] ?>		</div>
			<div id="link" 	class="sempre_igual">	<?php echo $colaborador['link_lattes'] ?>	</div>
		</div>
		<div style="display: block; clear: both;"></div>
	</div>
<?php endforeach ?>

<div>

