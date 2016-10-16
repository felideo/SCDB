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
	`nome` 					varchar(64) NOT NULL,
	`submenu`					varchar(64) NULL,
	`hierarquia` 			int(11) 	NOT NULL,
	`icone` 				varchar(64) NOT NULL DEFAULT 'fa-angle-right',
	`oculto` 				tinyint(1) 	NOT NULL DEFAULT '0',
	`ordem`					int(11) 	NOT NULL DEFAULT '1000',
	`ativo` 				tinyint(1) 	NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
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

    ADD COLUMN `submenu` 		varchar(64) NULL AFTER `nome`,
    ADD COLUMN `submenu_icone` 	varchar(64) NULL AFTER `submenu`;

