CREATE TABLE `classificacao` (
	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`             VARCHAR(128) 	NOT NULL,
	`id_classificacao` INT(11) 			NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`),
	FOREIGN            KEY (`id_classificacao`) REFERENCES `classificacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `taxon` (
	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`             VARCHAR(128) 	NOT NULL,
	`id_classificacao` INT(11) 			NOT NULL,
	`id_taxonomia`     INT(11) 			NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`),
	FOREIGN            KEY (`id_classificacao`) REFERENCES `classificacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`id_taxonomia`) REFERENCES `taxon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


CREATE TABLE `organismo` (
	`id`             INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`           VARCHAR(256) 		NOT NULL,
	`numero_petalas` INT(11) 			NOT NULL,
	`numero_estames` INT(11) 			NOT NULL,
	`posicao_ovario` VARCHAR(64) 		NOT NULL,
	`descricao`      TEXT 				NOT NULl,
	`id_last_taxon`  INT(11) 			NOT NULL,
	`localizador`    TEXT 				NOT NULL,
	`ativo`          TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY          KEY (`id`),
	FOREIGN          KEY (`id_last_taxon`) REFERENCES `taxon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `nome_popular` (
	`id`             INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`           VARCHAR(128) 		NOT NULL,
	`id_organismo`   INT(11) 			NOT NULL,
	`ativo`          TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY          KEY (`id`),
	FOREIGN          KEY (`id_organismo`) REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

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

CREATE TABLE `organismo_relaciona_imagem` (
	`id`             INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_arquivo`     INT(11)	 		NOT NULL,
	`id_organismo`   INT(11) 			NOT NULL,
	`ativo`          TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY          KEY (`id`),
	FOREIGN          KEY (`id_organismo`) REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN          KEY (`id_arquivo`) REFERENCES `arquivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `posicao_geografica` (
	`id`           INT(11) 			NOT NULL AUTO_INCREMENT,
	`latitude`     DECIMAL(3.6)	 	NOT NULL,
	`longitude`    DECIMAL(3.6)	 	NOT NULL,
	`id_organismo` INT(11) 			NOT NULL,
	`ativo`        TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN        KEY (`id_organismo`) REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8

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

CREATE TABLE `submenu` (
  `id`            int(11) NOT NULL AUTO_INCREMENT,
  `nome`          varchar(64) NOT NULL,
  `icone`         varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `ativo`         tinyint(1) NOT NULL DEFAULT '1',
  `nome_exibicao` varchar(64) NOT NULL,
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
	(1,1,'modulo_criar'),
	(2,1,'modulo_visualizar'),
	(3,1,'modulo_editar'),
	(4,1,'modulo_deletar'),
	(5,2,'usuario_criar'),
	(6,2,'usuario_visualizar'),
	(7,2,'usuario_editar'),
	(8,2,'usuario_deletar'),
	(9,3,'configuracao_criar'),
	(10,3,'configuracao_visualizar'),
	(11,3,'configuracao_editar'),
	(12,3,'configuracao_deletar'),
	(13,4,'submenu_criar'),
	(14,4,'submenu_visualizar'),
	(15,4,'submenu_editar'),
	(16,4,'submenu_deletar'),
	(17,5,'hierarquia_criar'),
	(18,5,'hierarquia_visualizar'),
	(19,5,'hierarquia_editar'),
	(20,5,'hierarquia_deletar');

ALTER TABLE organismo
ADD COLUMN aprovado TINYINT(1) NOT NULL DEFAULT 0 AFTER `localizador`;

CREATE TABLE `autor` (
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

CREATE TABLE `palavra_chave` (
	`id`          INT(11) 			NOT NULL AUTO_INCREMENT,
	`palavra`     VARCHAR(128) 		NOT NULL,
	`id_trabalho` INT(11) 			NOT NULL,
	`ativo`       TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY       KEY (`id`),
	FOREIGN       KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `organismo_relaciona_trabalho` (
	`id`           INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_organismo` INT(11) 			NOT NULL,
	`id_trabalho`  INT(11) 			NOT NULL,
	`ativo`        TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN        KEY (`id_trabalho`) 	REFERENCES `trabalho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN        KEY (`id_organismo`) REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


ALTER TABLE organismo
ADD COLUMN forma_folha VARCHAR(128) NOT NULL DEFAULT 0 AFTER `posicao_ovario`;




CREATE TABLE `trabalho` (
	`id`            INT(11) 		NOT NULL AUTO_INCREMENT,
	`titulo`        TEXT 			NOT NULL,
	`ano`           INT(4) 			NOT NULL,
	`resumo`        TEXT 			NOT NULL,
	`link_trabalho` TEXT 			NOT NULL,
	`id_arquivo`    INT(11) 		NOT NULL,
	`ativo`        TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN        KEY (`id_arquivo`) 	REFERENCES `trabalho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `organismo_relaciona_nome_popular` (
	`id`           INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_organismo` INT(11) 			NOT NULL,
	`id_nome_popular`  INT(11) 			NOT NULL,
	`ativo`        TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN        KEY (`id_organismo`) 	REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN        KEY (`id_nome_popular`) REFERENCES `nome_popular` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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

ALTER TABLE nome_popular DROP COLUMN id_organismo;
ALTER TABLE palavra_chave DROP COLUMN id_trabalho;

CREATE TABLE `organismo_trabalho_autor` (
	`id`           INT(11) 			NOT NULL AUTO_INCREMENT,
	`id_organismo` INT(11) 			NOT NULL,
	`id_trabalho`  INT(11) 			NOT NULL,
	`id_autor`     INT(11) 			NOT NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`),
	FOREIGN            KEY (`id_organismo`) 	REFERENCES `organismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`id_autor`) REFERENCES `autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

set foreign_key_checks = 0;
ALTER TABLE nome_popular DROP FOREIGN KEY `nome_popular_ibfk_1`;
ALTER TABLE nome_popular DROP COLUMN id_organismo;
ALTER TABLE palavra_chave DROP FOREIGN KEY `palavra_chave_ibfk_1`;
ALTER TABLE palavra_chave DROP COLUMN id_trabalho;
set foreign_key_checks = 1;

