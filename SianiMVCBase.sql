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

