CREATE TABLE `arquivo` (
	`id`       INT(11) 			NOT NULL AUTO_INCREMENT,
	`hash`     VARCHAR(32) 	NOT NULL,
	`nome`     VARCHAR(128) 	NOT NULL,
	`endereco` VARCHAR(256) 	NOT NULL,
	`tamanho`  DECIMAL	 		NOT NULL,
	`extensao` VARCHAR(16) 		NOT NULL,
	`ativo`    TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY    KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `hierarquia` (
  `id`    			int(11) 		NOT NULL AUTO_INCREMENT,
  `nome`  			varchar(64) 	NOT NULL,
  `ativo` 			tinyint(1) 	NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `usuario` (
  `id`          	int(11) 		NOT NULL AUTO_INCREMENT,
  `email`       	varchar(256) 	NOT NULL,
  `senha`       	varchar(64) 	NOT NULL,
  `hierarquia`  	int(11) 		NULL,
  `super_admin` 	tinyint(1) 		NOT NULL DEFAULT '0',
  `ativo`       	tinyint(1) 		NOT NULL DEFAULT '1',
  PRIMARY       KEY (`id`),
  KEY           `hierarquia` (`hierarquia`),
  CONSTRAINT    `usuario_ibfk_1` FOREIGN KEY (`hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `hierarquia`
  VALUES
	(1,'Administrador',1);

INSERT INTO `usuario`
  VALUES
	(1,'felideo@gmail.com','12345',NULL,1,1);

CREATE TABLE `submenu` (
  `id`            int(11) NOT NULL AUTO_INCREMENT,
  `nome`          varchar(64) NOT NULL,
  `icone`         varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `nome_exibicao` varchar(64) NOT NULL,
  `ativo`         tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY         KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `modulo` (
  `id`         int(11) NOT NULL AUTO_INCREMENT,
  `modulo`     varchar(64) NOT NULL,
  `nome`       varchar(64) NOT NULL,
  `id_submenu` int(11) DEFAULT NULL,
  `hierarquia` int(11) NOT NULL,
  `icone`      varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `oculto`     tinyint(1) NOT NULL DEFAULT '0',
  `ordem`      int(11) NOT NULL DEFAULT '1000',
  `ativo`      tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY      KEY (`id`),
  KEY          `id_submenu` (`id_submenu`),
  CONSTRAINT   `modulo_ibfk_1` FOREIGN KEY (`id_submenu`) REFERENCES `submenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `permissao` (
  `id`        int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `permissao` varchar(64) NOT NULL,
  PRIMARY     KEY (`id`),
  KEY         `id_modulo` (`id_modulo`),
  CONSTRAINT  `permissao_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `hierarquia_relaciona_permissao` (
  `id`            int(11) NOT NULL AUTO_INCREMENT,
  `id_hierarquia` int(11) NOT NULL,
  `id_permissao`  int(11) NOT NULL,
  `ativo`         tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY         KEY (`id`),
  KEY             `id_hierarquia` (`id_hierarquia`),
  KEY             `id_permissao` (`id_permissao`),
  CONSTRAINT      `hierarquia_relaciona_permissao_ibfk_1` FOREIGN KEY (`id_hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT      `hierarquia_relaciona_permissao_ibfk_2` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


INSERT INTO `submenu`
  VALUES
	(1,'desenvolvedor','fa-github',1,'Desenvolvedor');

INSERT INTO `modulo`
  VALUES
	(1,'modulo','Modulos',1,0,'fa-check-square-o',0,1000,1),
	(2,'usuario','Usuarios',NULL,1,'fa-users',0,1000,1),
	(3,'configuracao','Configurações',1,0,'fa-arrows-h',0,1000,1),
	(4,'submenu','Submenus',1,0,'fa-sitemap',0,1000,1),
	(5,'hierarquia','Hierarquias',NULL,1,'fa-sitemap',0,1000,1);

INSERT INTO `permissao`
  VALUES
	(1,1,'criar'),
	(2,1,'visualizar'),
	(3,1,'editar'),
	(4,1,'deletar'),
	(5,2,'criar'),
	(6,2,'visualizar'),
	(7,2,'editar'),
	(8,2,'deletar'),
	(9,3,'criar'),
	(10,3,'visualizar'),
	(11,3,'editar'),
	(12,3,'deletar'),
	(13,4,'criar'),
	(14,4,'visualizar'),
	(15,4,'editar'),
	(16,4,'deletar'),
	(17,5,'criar'),
	(18,5,'visualizar'),
	(19,5,'editar'),
	(20,5,'deletar');

CREATE TABLE `autor` (
	`id`    INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`  VARCHAR(256) 		NOT NULL,
	`email` VARCHAR(256) 		NULL,
	`link`  VARCHAR(256) 		NULL,
	`ativo` TINYINT(1) 			NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `orientador` (
	`id`    INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`  VARCHAR(256) 		NOT NULL,
	`email` VARCHAR(256) 		NULL,
	`link`  VARCHAR(256) 		NULL,
	`ativo` TINYINT(1) 			NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `idioma` (
	`id`     INT(11) 			NOT NULL AUTO_INCREMENT,
	`idioma` VARCHAR(64) 		NOT NULL,
	`ativo`  TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY  KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;



CREATE TABLE `trabalho` (
	`id`            INT(11) 		NOT NULL AUTO_INCREMENT,
	`titulo`        TEXT 			NOT NULL,
	`ano`           INT(4) 			NOT NULL,
	`resumo`        TEXT 			NOT NULL,
	`link_trabalho` TEXT 			NULL,
	`id_arquivo`    INT(11) 		NULL,
	`id_idioma`     INT(11) 		NOT NULL,
	`id_autor`      INT(11) 		NOT NULL,
	`ativo`        	TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN        KEY (`id_arquivo`) 	REFERENCES `arquivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN        KEY (`id_idioma`) 	REFERENCES `idioma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN        KEY (`id_autor`) 	REFERENCES `autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


CREATE TABLE `palavra_chave` (
	`id`            INT(11) 			NOT NULL AUTO_INCREMENT,
	`palavra_chave` VARCHAR(128) 		NOT NULL,
	`ativo`         TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY         KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


CREATE TABLE `trabalho_relaciona_palavra_chave` (
	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_trabalho`      INT(11) 			NOT NULL,
	`id_palavra_chave` INT(11) 			NOT NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`),
	FOREIGN            KEY (`id_trabalho`) 	REFERENCES `trabalho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`id_palavra_chave`) REFERENCES `palavra_chave` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


ALTER TABLE `usuario`
    ADD FOREIGN KEY (hierarquia) REFERENCES hierarquia(id);

CREATE TABLE `blame_cadastro_trabalho` (
	`id`                   INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_usuario_cadastro`  INT(11) 			NULL,
	`id_usuario_aprovacao` INT(11) 			NULL,
	`data_cadastro`        DATETIME			NOT NULL,
	`data_aprovacao`       DATETIME			NULL,
	`operacao`             VARCHAR(128)		NOT NULl,
	`ativo`                TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY                KEY (`id`),
	FOREIGN                KEY (`id_usuario_cadastro`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN                KEY (`id_usuario_aprovacao`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `pagina_institucional` (
	`id`       INT(11) 			NOT NULL AUTO_INCREMENT,
	`titulo`   VARCHAR(512)		NULL,
	`conteudo` TEXT				NOT NULL,
	`ativo`    TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY    KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

ALTER TABLE `permissao`
	ADD COLUMN `ativo`       tinyint(1) 		NOT NULL DEFAULT '1';

CREATE TABLE `pessoa` (
  `id`          int(11) 		NOT NULL AUTO_INCREMENT,
  `id_usuario`  int(11) 		NOT NULL,
  `pronome`     varchar(64) 	NULL,
  `nome`        varchar(64) 	NOT NULL,
  `sobrenome`   varchar(256)	NOT NULL,
  `instituicao` varchar(512)	NOT NULL,
  `ativo`       tinyint(1) 		NOT NULL DEFAULT '1',
  PRIMARY       KEY (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `configuracoes` (
	`id`        INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`      VARCHAR(512)		NULL DEFAULT "Scientific Work DB",
	`analytics` VARCHAR(16)			NULL DEFAULT "UA-36899868-1",
	`ativo`     TINYINT(1) 			NOT NULL DEFAULT '1',
	PRIMARY     KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
