CREATE DATABASE LiveDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `taxonomia` (
	`id`           INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`         VARCHAR(128) 	NOT NULL,
	`id_taxonomia` INT(11) 			NULL,
	`ativo`        TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY        KEY (`id`),
	FOREIGN KEY (`id_taxonomia`) REFERENCES `taxonomia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `classificacao` (
	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome`             VARCHAR(128) 	NOT NULL,
	`id_classificacao` INT(11) 			DEFAULT NULL,
	`id_taxonomia`     INT(11) 			DEFAULT NULL,
	`tsn`              INT(11) 			DEFAULT NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`),
	FOREIGN            KEY (`id_classificacao`) REFERENCES `classificacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`tsn`) REFERENCES `taxonomia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `classificacao_import_itis` (
	`tsn`              INT(11) 			NOT NULL,
	`nome`             VARCHAR(128) 	NOT NULL,
	`id_classificacao` INT(11) 			DEFAULT NULL,
	`id_taxonomia`     INT(11) 			DEFAULT NULL,
	`id_tsn`           INT(11) 			DEFAULT NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`tsn`),
	FOREIGN            KEY (`id_tsn`) REFERENCES `classificacao_import_itis` (`tsn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN            KEY (`id_taxonomia`) REFERENCES `taxonomia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `ser_vivo` (
	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
	`nome_binominal`   VARCHAR(256) 	NOT NULL,
	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY            KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

-- CREATE TABLE `classificacao_relacionar_ser_vivo` (
-- 	`id`               INT(11) 			NOT NULL AUTO_INCREMENT,
-- 	`id_ser_vivo`      INT(11) 			NOT NULL,
-- 	`id_classificacao` INT(11) 			NOT NULL,
-- 	`ativo`            TINYINT(1) 		NOT NULL DEFAULT '1',
-- 	PRIMARY            KEY (`id`),
-- 	FOREIGN            KEY (`id_classificacao`) REFERENCES `classificacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
-- 	FOREIGN            KEY (`id_ser_vivo`) REFERENCES `ser_vivo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
-- ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE `classificacao_relacionar_ser_vivo` (
	`id`                 INT(11) 		NOT NULL AUTO_INCREMENT,
	`id_ser_vivo`        INT(11) 		NOT NULL,
	`data_classificacao` DATE 			NOT NULL,
	`reino`              INT(11)		NULL,
	`filo_divisao`       INT(11)		NULL,
	`classe`             INT(11)		NULL,
	`ordem`              INT(11)		NULL,
	`família`            INT(11)		NULL,
	`género`             INT(11)		NULL,
	`espécie`            INT(11)		NULL,
	`subespécie`         INT(11)		NULL,
	`ativo`              TINYINT(1) 		NOT NULL DEFAULT '1',
	PRIMARY              KEY (`id`),
	FOREIGN              KEY (`id_ser_vivo`) 	REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`reino`) 			REFERENCES `ser_vivo` (`id`) 		ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`filo_divisao`) 	REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`classe`) 		REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`ordem`) 			REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`família`) 		REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`género`) 		REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`espécie`) 		REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN              KEY (`subespécie`) 	REFERENCES `classificacao` (`id`) 	ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;


SQL Error [1414] [42000]: OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)
SQL Error [1414] [42000]: OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)
  OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)
  OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)
    OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)
    OUT or INOUT argument 1 for routine ITIS.full_hierarchy is not a variable or NEW pseudo-variable in BEFORE trigger
Query is : CALL full_hierarchy(123)

INSERT INTO taxonomia
	VALUES
		(1, 'Reino', NULL, 1),
		(2, 'Filo/Divisão', 1, 1),
		(3, 'Classe', 2, 1),
		(4, 'Ordem', 3, 1),
		(5, 'Família', 4, 1),
		(6, 'Género', 5, 1),
		(7, 'Espécie', 6, 1),
		(8, 'Subespécie', 7, 1);

INSERT INTO classificacao
	VALUES
		(1, 'Plantae', 			NULL, 	1, 1),
		(2, 'Tracheophyta', 	1, 		2, 1),
		(3, 'Magnoliopsida', 	2, 		3, 1),
		(4, 'Asterales', 		3, 		4, 1),
		(5, 'Asteraceae', 		4, 		5, 1),
		(6, 'Artemisia', 		5, 		6, 1),
		(7, 'Absinthium', 		6, 		7, 1);



INSERT INTO ser_vivo
	VALUES
		(1, 'Artemisia Absinthium', 1);

INSERT INTO classificacao_relacionar_ser_vivo
	VALUES
		(1, 1, '2016-11-27', 1, 2, 3, 4, 5, 6, 7, NULL, 1);



DELIMITER
$$ DROP PROCEDURE IF EXISTS `listar_paises` $$

CREATE PROCEDURE `classificacao_ser_vivo`(IN _nome VARCHAR(256))
BEGIN

	`id`                 	INT(11),
	`nome`        			VARCHAR(256),
	`data_classificacao` 	DATE,
	`reino`              	VARCHAR(256),
	`filo_divisao`       	VARCHAR(256),
	`classe`             	VARCHAR(256),
	`ordem`              	VARCHAR(256),
	`família`            	VARCHAR(256),
	`género`             	VARCHAR(256),
	`espécie`            	VARCHAR(256),
	`subespécie`         	VARCHAR(256),

CREATE TABLE #temp
(
	`id`                 	INT(11),
	`nome`        			VARCHAR(256),
	`data_classificacao` 	DATE,
	`reino`              	VARCHAR(256),
	`filo_divisao`       	VARCHAR(256),
	`classe`             	VARCHAR(256),
	`ordem`              	VARCHAR(256),
	`família`            	VARCHAR(256),
	`género`             	VARCHAR(256),
	`espécie`            	VARCHAR(256),
	`subespécie`         	VARCHAR(256),
);

create table #Temp
(
    EventID int,
    EventTitle Varchar(50),
    EventStartDate DateTime,
    EventEndDate DatetIme,
    EventEnumDays int,
    EventStartTime Datetime,
    EventEndTime DateTime,
    EventRecurring Bit,
    EventType int
)


	SELECT * FROM `ser_vivo` WHERE `nome` = _nome;


	IF(_id IS NULL) THEN
		SELECT * FROM pais;
	ELSE
		SELECT * FROM pais where id_pais = _id;
	END IF;
END $$
DELIMITER;

Post completo em:

https://www.oficinadanet.com.br/artigo/2088/criando_stored_procedures_no_mysql

O conteúdo do Oficina da Net é protegido sob a licença Creative Commons (CC BY-NC-ND). Você pode reproduzi-lo, desde que insira créditos COM O LINK para o CONTEÚDO ORIGINAL e não faça uso comercial de nossa produção.