CREATE DATABASE SianiMVCBase CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `usuario` (
	`id`           			int(11) NOT NULL AUTO_INCREMENT,
	`email`					varchar(256) NOT NULL,
	`senha` 				varchar(64) NOT NULL,
	`hierarquia` 			int(11) NOT NULL,
	`ativo` 				tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `modulo` (
	`id` 					int(11) 	NOT NULL AUTO_INCREMENT,
	`modulo` 				varchar(64) NOT NULL,
	`id_submenu`			int(11) 	null,
	`nome` 					varchar(64) NOT NULL,
	`submenu`					varchar(64) NULL,
	`hierarquia` 			int(11) 	NOT NULL,
	`icone` 				varchar(64) NOT NULL DEFAULT 'fa-angle-right',
	`oculto` 				tinyint(1) 	NOT NULL DEFAULT '0',
	`ordem`					int(11) 	NOT NULL DEFAULT '1000',
	`ativo` 				tinyint(1) 	NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_submenu`)    REFERENCES `submenu`    (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `configuracao_sistema` (
	`id` 					int(11) NOT NULL AUTO_INCREMENT,
	`nome_aplicacao` 		varchar(64) NOT NULL,
	`id_google_analitics` 	varchar(64) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `modulo`
	(`id`, `modulo`, `nome`, `hierarquia`, `icone`, `oculto`, `ordem` `ativo`)
VALUES
	(1, 'modulo', 'Modulos', 0, 'fa-check-square-o', 0, 1, 1),
	(2, 'usuarior', 'Usuarios', 1, 'fa-users', 0, 2, 1),
	(3, 'configuracao_sistema', 'Configurações de Sistema', 0, 'fa-cog', 0, 1000, 1);

INSERT INTO `usuario` VALUES ('1', 'felideo@gmail.com', '12345', '0', '1');


ALTER TABLE `modulo`


    ADD COLUMN `submenu` varchar(64) NULL AFTER `nome`;

ALTER TABLE `modulo`
    ADD COLUMN `icone-submenu` varchar(64) NULL AFTER `nome`;

CREATE TABLE `paciente` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`nome` 					varchar(128) 	NOT NULL,
	`pai` 					varchar(128) 	NOT NULL,
	`mae`					varchar(128) 	NULL,
	`nascimento` 			date 	 		NOT NULL,
	`sexo` 					tinyint(1) 		NOT NULL COMMENT "Masculino 1; Feminino 0",
	`patologia`				varchar(128) 	NOT NULL,
	`descricao`				text 			NULL,
	`tipo`					tinyint(1)		NOT NULL DEFAULT '0' COMMENT "Candidato 0; Paciente 1, Ex Paciente 2",
	`ativo` 				tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `contato` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`id_paciente` 			int(11) 		NULL,
	`contato` 				varchar(128) 	NOT NULL,
	`tipo`					tinyint(1)		NOT NULL COMMENT "Telefone 0; Celular 1, Email 2",
	`ativo` 				tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_paciente`)      REFERENCES paciente(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `endereco` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`id_paciente` 			int(11) 		NOT NULL,
	`cep` 					int(8) 			NOT NULL,
	`rua`					varchar(128) 	NOT NULL,
	`numero`				int 			NOT NULL,
	`complemento`			varchar(128) 	NULL,
	`bairro`				varchar(128) 	NOT NULL,
	`cidade`				varchar(128) 	NOT NULL,
	`uf`					varchar(128) 	NOT NULL,
	`ativo` 				tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_paciente`)      REFERENCES paciente(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `aluno` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`id_usuario` 			int(11) 		NOT NULL,
	`nome` 					varchar(128)	NOT NULL,
	`rgm`					int(11) 		NOT NULL,
	`curso`					varchar(128)	NOT NULL,
	`semestre`				int 		 	NOT NULL,
	`turma`					varchar(16) 	NOT NULL,
	`ativo` 				tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_usuario`)      REFERENCES usuario(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `contato`
	ADD COLUMN `id_aluno` int('') null after `id_paciente`;

ALTER TABLE `modulo`
    ADD COLUMN `submenu` 		varchar(64) NULL AFTER `nome`,
    ADD COLUMN `submenu_icone` 	varchar(64) NULL AFTER `submenu`;

CREATE TABLE `permissao` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`modulo` 				int(11) 		NOT NULL,
	`permissao` 			varchar(64) 	NOT NULL,
	`hash` 					varchar(128) 	NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`modulo`)    REFERENCES `modulo`    (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE `permissao` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`id_modulo` 				int(11) 		NOT NULL,
	`permissao` 			varchar(64) 	NOT NULL,
	`hash` 					varchar(128) 	NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_modulo`)    REFERENCES `modulo`    (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

  CREATE TABLE `submenu` (
	`id` 				int(11) 		NOT NULL AUTO_INCREMENT,
	`nome` 				varchar(64) 	NOT NULL,
	`icone` 			varchar(64) 	NOT NULL DEFAULT 'fa-angle-right',
	`ativo` 			tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


insert into `submenu` (`nome`, `nome_exibicao`, `icone`) VALUES ('desenvolvedor', 'Desenvolvedor', 'fa-github');



alter table `modulo`
	drop COLUMN submenu,
	drop COLUMN submenu_icone;

ALTER TABLE `modulo`
	drop COLUMN submenu,
	add COLUMN id_submenu int(11) null after nome;

ALTER TABLE `modulo`
	  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`submenu`) REFERENCES `submenu` (`id`);

 ALTER TABLE `submenu`
	ADD COLUMN `ativo` tinyint(1) NOT NULL DEFAULT '1';



 CREATE TABLE `hierarquia` (
	`id` 				int(11) 		NOT NULL AUTO_INCREMENT,
	`nome` 				varchar(64) 	NOT NULL,
	`ativo` 			tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

 CREATE TABLE `hierarquia_relaciona_permissao` (
	`id` 					int(11) 		NOT NULL AUTO_INCREMENT,
	`id_hierarquia` 		int(11) 		NOT NULL,
	`id_permissao` 			int(11) 		NOT NULL,
	`ativo` 				tinyint(1) 		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_hierarquia`)    	REFERENCES `hierarquia`    (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN KEY (`id_permissao`)    	REFERENCES `permissao`    (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


 insert into permissao values (1,	1,	'modulo_criar',	'cc3bb12c0fbfaf466b4b3442aec26ae5');
insert into permissao values (2,	1,	'modulo_visualizar',	'21006e54557171565f06d4b79480c62e');
insert into permissao values (3,	1,	'modulo_editar',	'0a61da91a3d6953396eb49f844399776');
insert into permissao values (4,	1,	'modulo_deletar',	'1e13c49199d07d25108253d4982f5efa');
insert into permissao values (5,	2,	'usuario_criar',	'df7afc5232a6e220c22166323ca5f551');
insert into permissao values (6,	2,	'usuario_visualizar',	'e88cc50fe5e03eb08e8e1e78ac379df6');
insert into permissao values (7,	2,	'usuario_editar',	'75a565eade80c3eb9431b22e28365939');
insert into permissao values (8,	2,	'usuario_deletar',	'887268422c47fce0482cf3f9c22157ac');
insert into permissao values (9,	3,	'configuracao_criar',	'13775a7912dd755ee9b4efde6c3d3844');
insert into permissao values (10,	3,	'configuracao_visualizar',	'e5303147cb6974926266f2294ce4561c');
insert into permissao values (11,	3,	'configuracao_editar',	'2b826c13ec3182bf7deed873b771e5fd');
insert into permissao values (12,	3,	'configuracao_deletar',	'bb3d9288e744f73f09e4ea9cd4485d8c');
insert into permissao values (13,	4,	'submenu_criar',	'd10379017fafe92880e8b29d75bad6a4');
insert into permissao values (14,	4,	'submenu_visualizar',	'ed065364bd719b8746c3792606844e82');
insert into permissao values (15,	4,	'submenu_editar',	'd0a836f04fff1c81daf41df627ee9731');
insert into permissao values (16,	4,	'submenu_deletar',	'fffb557355b50c87c2c4201592579553');
insert into permissao values (17,	6,	'hierarquia_criar',	'78b69f969483e811894a6a043a6ca4c5');
insert into permissao values (18,	6,	'hierarquia_visualizar',	'73830dc1f025487a276655271365cdcf');
insert into permissao values (19,	6,	'hierarquia_editar',	'c3252221d02fcb92834f875d880e0fd0');
insert into permissao values (20,	6,	'hierarquia_deletar',	'9caa48ecea8dd2547fcc5353ac119263');

