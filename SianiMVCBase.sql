set foreign_key_checks = 1;

CREATE DATABASE NeuroSis CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `hierarquia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `icone` varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `nome_exibicao` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `id_submenu` int(11) DEFAULT NULL,
  `hierarquia` int(11) NOT NULL,
  `icone` varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `oculto` tinyint(1) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '1000',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_submenu` (`id_submenu`),
  CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`id_submenu`) REFERENCES `submenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `permissao` varchar(64) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_modulo` (`id_modulo`),
  CONSTRAINT `permissao_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `hierarquia_relaciona_permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hierarquia` int(11) NOT NULL,
  `id_permissao` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_hierarquia` (`id_hierarquia`),
  KEY `id_permissao` (`id_permissao`),
  CONSTRAINT `hierarquia_relaciona_permissao_ibfk_1` FOREIGN KEY (`id_hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `hierarquia_relaciona_permissao_ibfk_2` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `hierarquia` int(11) NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `hierarquia` (`hierarquia`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
	(1,1,'modulo_criar','a9429d71928516579f52b4f3fc81dcd7'),
	(2,1,'modulo_visualizar','bfadbb719afdf71180c5987486c1d723'),
	(3,1,'modulo_editar','80e935b9298e7e8d3d3bb03cfde2eecd'),
	(4,1,'modulo_deletar','37c71e0c63fe3d007aa4ece847da8541'),
	(5,2,'usuario_criar','39d12358a09338a74b5c64c9e478d86b'),
	(6,2,'usuario_visualizar','4a5c36befd855430bf892bcd88255aaf'),
	(7,2,'usuario_editar','0d9ae71042b8d9b9e0ae8c196d8d4a5a'),
	(8,2,'usuario_deletar','5b54085c639264dbe33db53f60457c7e'),
	(9,3,'configuracao_criar','3e38f89bfc5fa44a179bba8904b759fa'),
	(10,3,'configuracao_visualizar','e8ba416878375fe60347cabec75159f0'),
	(11,3,'configuracao_editar','065a633506a8ce8c0b3a5755310b6b17'),
	(12,3,'configuracao_deletar','d22413a0f7c8dedf53e5f3bdb592fcd2'),
	(13,4,'submenu_criar','e50f858c2e87d0e55caccefd10030d72'),
	(14,4,'submenu_visualizar','e634b284d151cbd67ff1cdc160455b75'),
	(15,4,'submenu_editar','d122b8a00f6bdd6cfe4d00d2c43a6efc'),
	(16,4,'submenu_deletar','1785791cd91e72bca417bc5ce0c0af0c'),
	(17,5,'hierarquia_criar','82af03d7b8931a5fa708c027edbb835f'),
	(18,5,'hierarquia_visualizar','f104b987bc0927f9f54575dcd3f15eda'),
	(19,5,'hierarquia_editar','02a5fff71ec3c951a1cfdbcd50213509'),
	(20,5,'hierarquia_deletar','38fa3046cd2516c579b66ba770e65004');

INSERT INTO `hierarquia`
  VALUES
	(1,'Administrador',1);

INSERT INTO `hierarquia_relaciona_permissao`
  VALUES
	(1,1,1,1),
	(2,1,2,1),
	(3,1,3,1),
	(4,1,4,1),
	(5,1,5,1),
	(6,1,6,1),
	(7,1,7,1),
	(8,1,8,1),
	(9,1,9,1),
	(10,1,10,1),
	(11,1,11,1),
	(12,1,12,1),
	(13,1,13,1),
	(14,1,14,1),
	(15,1,15,1),
	(16,1,16,1),
	(17,1,17,1),
	(18,1,18,1),
	(19,1,19,1),
	(20,1,20,1);

INSERT INTO `usuario`
  VALUES
	(1,'felideo@gmail.com','12345',NULL,1,1);

CREATE TABLE `paciente` (
  `id`          int(11)     NOT NULL AUTO_INCREMENT,
  `nome`          varchar(128)  NOT NULL,
  `pai`           varchar(128)  NOT NULL,
  `mae`         varchar(128)  NULL,
  `nascimento`      date      NOT NULL,
  `sexo`          tinyint(1)    NOT NULL COMMENT "Masculino 1; Feminino 0",
  `patologia`       varchar(128)  NOT NULL,
  `descricao`       text      NULL,
  `tipo`          tinyint(1)    NOT NULL DEFAULT '0' COMMENT "Candidato 0; Paciente 1, Ex Paciente 2",
  `ativo`         tinyint(1)    NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `contato` (
  `id`          int(11)     NOT NULL AUTO_INCREMENT,
  `id_paciente`       int(11)     NULL,
  `id_aluno`        int(11)     null,
  `contato`         varchar(128)  NOT NULL,
  `tipo`          tinyint(1)    NOT NULL COMMENT "Telefone 0; Celular 1, Email 2",
  `ativo`         tinyint(1)    NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_paciente`)      REFERENCES paciente(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `endereco` (
  `id`          int(11)     NOT NULL AUTO_INCREMENT,
  `id_paciente`       int(11)     NOT NULL,
  `cep`           int(8)      NOT NULL,
  `rua`         varchar(128)  NOT NULL,
  `numero`        int       NOT NULL,
  `complemento`     varchar(128)  NULL,
  `bairro`        varchar(128)  NOT NULL,
  `cidade`        varchar(128)  NOT NULL,
  `uf`          varchar(128)  NOT NULL,
  `ativo`         tinyint(1)    NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_paciente`)      REFERENCES paciente(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `aluno` (
  `id`          int(11)     NOT NULL AUTO_INCREMENT,
  `id_usuario`      int(11)     NOT NULL,
  `nome`          varchar(128)  NOT NULL,
  `rgm`         int(11)     NOT NULL,
  `curso`         varchar(128)  NOT NULL,
  `semestre`        int       NOT NULL,
  `turma`         varchar(16)   NOT NULL,
  `ativo`         tinyint(1)    NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_usuario`)      REFERENCES usuario(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



INSERT INTO `submenu`
	VALUES
		(2,'paciente','fa-hospital-o',1,'Pacientes');

INSERT INTO `modulo`
	VALUES
		(6,'candidato','Candidatos',2,1,'fa-question-circle',0,1000,1),
		(7,'paciente','Pacientes',2,1,'fa-check-circle',0,1000,1),
		(8,'ex_paciente','Ex Pacientes',2,1,'fa-times-circle',0,1000,1),
		(9,'aluno','Alunos',NULL,1,'fa-book',0,1000,1);

INSERT INTO `permissao`
	VALUES
		(21,6,'candidato_criar','3d9c9470ad8763c304c9b6863503f2f3'),
		(22,6,'candidato_visualizar','d214d1234116fbdf5285e17ca9c0990c'),
		(23,6,'candidato_editar','e0aa165921d2f1d82022b96eab8e7433'),
		(24,6,'candidato_deletar','c5baa66c40a747d1922ddc1e2dde43eb'),
		(25,7,'paciente_criar','1d7a3f555a8c1b691cb477794e297a93'),
		(26,7,'paciente_visualizar','a93ae8d0ac79f5c6e633dd3849d742b5'),
		(27,7,'paciente_editar','ba4ec5903bd29209e4d128325d148d4c'),
		(28,7,'paciente_deletar','624af79c720e15713486b23c5b95729d'),
		(29,8,'ex_paciente_criar','15c22c6d7346e86c953b3d28dcb37ead'),
		(30,8,'ex_paciente_visualizar','4a03d9cdcb4377ce6653464955d80e63'),
		(31,8,'ex_paciente_editar','a86d2e7fadf719321e15b127954be667'),
		(32,8,'ex_paciente_deletar','81e7579cbc594e348021dfcc233c00c9'),
		(33,9,'aluno_criar','bca8014b542e466064bdb7a89774855e'),
		(34,9,'aluno_visualizar','5d1bbd93e9beb245489558aef962b5b9'),
		(35,9,'aluno_editar','0e7cee61ae888dea957667b370fe5875'),
		(36,9,'aluno_deletar','c793f72c38e1005344d1041b288c459f');

CREATE TABLE `bateria` (
  `id`                    int(11)       NOT NULL AUTO_INCREMENT,
  `data_inicio`           date          NOT NULL,
  `data_fim`              date          NOT NULL,
  `qtd_atendimentos_dia`  int(11) NOT NULL,
  `ativo`                 tinyint(1)    NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



CREATE TABLE `bateria_relaciona_aluno_paciente` (
  `id`               int(11) NOT NULL AUTO_INCREMENT,
  `id_bateria`       int(11) NOT NULL,
  `id_aluno`         int(11) NOT NULL,
  `id_paciente`      int(11) NOT NULL,
  `id_ficha_clinica` int(11) NOT NULL,
  `data_agendamento` date    NOT NULL,
  `ativo`            tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY            KEY (`id`),
  FOREIGN            KEY (`id_bateria`)        REFERENCES `bateria`        (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN            KEY (`id_aluno`)          REFERENCES `aluno`          (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN            KEY (`id_paciente`)       REFERENCES `paciente`       (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN            KEY (`id_ficha_clinica`)  REFERENCES `ficha_clinica`  (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



INSERT INTO `hierarquia`
  VALUES (2,'Aluno',1);




CREATE TABLE `ficha_clinica` (
	`id`                                   int(11) NOT NULL AUTO_INCREMENT,

	`classificacao_topografica`            TEXT NULL,
	`classificacao_clinica`                TEXT NULL,
	`classificacao_clinica_nivel`          TEXT NULL,
	`classificacao_clinica_nivel_nivel`    TEXT NULL,
	`molestia_atual_pregressa`             TEXT NULL,
	`patologia_disturbio_associado`        TEXT NULL,
	`medicamento_uso_motivo`               TEXT NULL,
	`exames_complementares`                TEXT NULL,
	`orteses_proteses_adaptacoes`          TEXT NULL,
	`caracteristicas_sindromicas`          TEXT NULL,
	`desenvolvimento_motor_visao`          TEXT NULL,
	`desenvolvimento_motor_audicao`        TEXT NULL,
	`desenvolvimento_motor_linguagem`      TEXT NULL,
	`desenvolvimento_motor_cognitivo`      TEXT NULL,
	`contato`                              TEXT NULL,
	`contato_resposta`                     TEXT NULL,
	`reflexos_primitivos`                  TEXT NULL,
	`reflexos_primitivos_presente`         TEXT NULL,
	`controle_cervical`                    TEXT NULL,
	`linha_media`                          TEXT NULL,
	`linha_media_incompleto`               TEXT NULL,
	`simetria`                             TEXT NULL,
	`alinhamento`                          TEXT NULL,
	`movimentacao_ativa`                   TEXT NULL,
	`movimentacao_ativa_observacoes`       TEXT NULL,
	`rolar`                                TEXT NULL,
	`rolar_padrao_patologico`              TEXT NULL,
	`controle_tronco`                      TEXT NULL,
	`postura_quadril`                      TEXT NULL,
	`postura_quadril_inclinada`            TEXT NULL,
	`deformidade_coluna`                   TEXT NULL,
	`deformidade_coluna_presente`          TEXT NULL,
	`deformidade_quadril`                  TEXT NULL,
	`deformidade_quadril_presente`         TEXT NULL,
	`ortostatismo`                         TEXT NULL,
	`ortostatismo_posicionamento_pes`      TEXT NULL,
	`marcha`                               TEXT NULL,
	`marcha_observacoes`                   TEXT NULL,
	`trocas_posturais`                     TEXT NULL,
	`encurtamento_musculares_deformidades` TEXT NULL,
	`alimentacao`                          TEXT NULL,
	`alimentacao_observacoes`              TEXT NULL,
	`higiene`                              TEXT NULL,
	`higiene_observacoes`                  TEXT NULL,
	`vestuario`                            TEXT NULL,
	`vestuario_observacoes`                TEXT NULL,
	`locomocao`                            TEXT NULL,
	`locomocao_observacoes`                TEXT NULL,
	`sistema_respiratorio`                 TEXT NULL,
	`condutas`                             TEXT NULL,
	`evolucao_periodo`                     TEXT NULL,
	`rolar_inicia_porem_incompleto`        TEXT NULL,

	`ativo`                                tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY                                KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


=====================================================================================================


set foreign_key_checks = 0;

CREATE DATABASE NeuroSis CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `aluno`;

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `rgm` int(11) NOT NULL,
  `curso` varchar(128) NOT NULL,
  `semestre` int(11) NOT NULL,
  `turma` varchar(16) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `bateria`;

CREATE TABLE `bateria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `qtd_atendimentos_dia` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `bateria_ralacions_aluno_paciente`;

DROP TABLE IF EXISTS `bateria_relaciona_aluno_paciente`;

CREATE TABLE `bateria_relaciona_aluno_paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bateria` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_ficha_clinica` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_bateria` (`id_bateria`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_ficha_clinica` (`id_ficha_clinica`),
  CONSTRAINT `bateria_relaciona_aluno_paciente_ibfk_1` FOREIGN KEY (`id_bateria`) REFERENCES `bateria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bateria_relaciona_aluno_paciente_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bateria_relaciona_aluno_paciente_ibfk_3` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bateria_relaciona_aluno_paciente_ibfk_4` FOREIGN KEY (`id_ficha_clinica`) REFERENCES `ficha_clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `contato`;

CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `contato` varchar(128) NOT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT 'Telefone 0; Celular 1, Email 2',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `contato_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `endereco`;

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `cep` int(8) NOT NULL,
  `rua` varchar(128) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(128) DEFAULT NULL,
  `bairro` varchar(128) NOT NULL,
  `cidade` varchar(128) NOT NULL,
  `uf` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ficha_clinica`;

CREATE TABLE `ficha_clinica` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`classificacao_topografica`         		text,
	`classificacao_clinica`             		text,
	`classificacao_clinica_nivel`       		text,
	`classificacao_clinica_nivel_nivel` 		text,
	`molestia_atual_pregressa`          		text,
	`patologia_disturbio_associado`     		text,
	`medicamento_uso_motivo`            		text,
	`exames_complementares`             		text,
	`orteses_proteses_adaptacoes`       		text,
	`caracteristicas_sindromicas`       		text,
	`desenvolvimento_motor_visao`       		text,
	`desenvolvimento_motor_audicao`     		text,
	`desenvolvimento_motor_linguagem`   		text,
	`desenvolvimento_motor_cognitivo`   		text,
	`contato`                           		text,
	`contato_resposta`                  		text,
	`reflexos_primitivos`               		text,
	`reflexos_primitivos_presente`      		text,
	`controle_cervical`                 		text,
	`linha_media`                       		text,
	`linha_media_incompleto`            		text,
	`simetria`                          		text,
	`alinhamento`                       		text,
	`movimentacao_ativa`                		text,
	`movimentacao_ativa_observacoes`    		text,
	`rolar`                             		text,
	`rolar_padrao_patologico`           		text,
	`controle_tronco`                   		text,
	`postura_quadril`                   		text,
	`postura_quadril_inclinada`         		text,
	`deformidade_coluna`                		text,
	`deformidade_coluna_presente`       		text,
	`deformidade_quadril`               		text,
	`deformidade_quadril_presente`      		text,
	`ortostatismo`                      		text,
	`ortostatismo_posicionamento_pes`   		text,
	`marcha`                            		text,
	`marcha_observacoes`                		text,
	`trocas_posturais`                  		text,
	`avaliacao_tonus`                        	text,
	`hipertonia_elastica_grupos_musculares`  	text,
	`hipertonia_plastica`                    	text,
	`hipertonia_plastica_localizacao`        	text,
	`sinais_clinicos`                        	text,
	`asworth`                                	text,
	`discinesias`                            	text,
	`discinesias_atetose`                    	text,
	`discinesias_coréia`                     	text,
	`discinesias_distonia`                   	text,
	`discinesias_localizacao`                	text,
	`hipotonia`                              	text,
	`hipotonia_localizacao`                  	text,
	`incoordenaco_de_movimentos`             	text,
	`incoordenaco_de_movimentos_ataxia`      	text,
	`incoordenaco_de_movimentos_dismetría`   	text,
	`incoordenaco_de_movimentos_hipometria`  	text,
	`incoordenaco_de_movimentos_hipermetria` 	text,
	`encurtamento_musculares_deformidades` 		text,
	`alimentacao`                          		text,
	`alimentacao_observacoes`              		text,
	`higiene`                              		text,
	`higiene_observacoes`                  		text,
	`vestuario`                            		text,
	`vestuario_observacoes`                		text,
	`locomocao`                            		text,
	`locomocao_observacoes`                		text,
	`sistema_respiratorio`                 		text,
	`condutas`                             		text,
	`evolucao_periodo`                     		text,
	`rolar_inicia_porem_incompleto`        		text,
	`ativo`                                tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY                                 KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;













DROP TABLE IF EXISTS `hierarquia`;

CREATE TABLE `hierarquia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `hierarquia_relaciona_permissao`;

CREATE TABLE `hierarquia_relaciona_permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hierarquia` int(11) NOT NULL,
  `id_permissao` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_hierarquia` (`id_hierarquia`),
  KEY `id_permissao` (`id_permissao`),
  CONSTRAINT `hierarquia_relaciona_permissao_ibfk_1` FOREIGN KEY (`id_hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `hierarquia_relaciona_permissao_ibfk_2` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `modulo`;

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `id_submenu` int(11) DEFAULT NULL,
  `hierarquia` int(11) NOT NULL,
  `icone` varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `oculto` tinyint(1) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '1000',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_submenu` (`id_submenu`),
  CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`id_submenu`) REFERENCES `submenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `paciente`;

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `pai` varchar(128) NOT NULL,
  `mae` varchar(128) DEFAULT NULL,
  `nascimento` date NOT NULL,
  `sexo` tinyint(1) NOT NULL COMMENT 'Masculino 1; Feminino 0',
  `patologia` varchar(128) NOT NULL,
  `descricao` text,
  `tipo` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Candidato 0; Paciente 1, Ex Paciente 2',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `permissao`;

CREATE TABLE `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `permissao` varchar(64) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_modulo` (`id_modulo`),
  CONSTRAINT `permissao_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `submenu`;

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `icone` varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `nome_exibicao` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `token` varchar(32) NULL,
  `hierarquia` int(11) DEFAULT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `hierarquia` (`hierarquia`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`hierarquia`) REFERENCES `hierarquia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `submenu`
	VALUES
		(1,'desenvolvedor','fa-github',1,'Desenvolvedor'),
		(2,'paciente','fa-hospital-o',1,'Pacientes');

INSERT INTO `modulo`
	VALUES
		(1,'modulo','Modulos',1,0,'fa-check-square-o',0,1000,1),
		(2,'usuario','Usuarios',NULL,1,'fa-users',0,1000,1),
		(3,'configuracao','Configurações',1,0,'fa-arrows-h',0,1200,1),
		(4,'submenu','Submenus',1,0,'fa-sitemap',0,1100,1),
		(5,'hierarquia','Hierarquias',NULL,1,'fa-sitemap',0,2000,1),
		(6,'candidato','Candidatos',2,1,'fa-question-circle',0,1000,1),
		(7,'paciente','Pacientes',2,1,'fa-check-circle',0,1100,1),
		(8,'ex_paciente','Ex Pacientes',2,1,'fa-times-circle',0,1200,1),
		(9,'aluno','Alunos',NULL,1,'fa-book',0,1100,1),
		(10,'bateria','Baterias',NULL,1,'fa-calendar ',0,1200,1),
		(11,'ficha_clinica','Fichas Clinicas',NULL,1,'fa-file-text ',0,1300,1);

INSERT INTO `permissao`
  VALUES
	(1, 1, 'modulo_criar','a9429d71928516579f52b4f3fc81dcd7'),
	(2, 1, 'modulo_visualizar','bfadbb719afdf71180c5987486c1d723'),
	(3, 1, 'modulo_editar','80e935b9298e7e8d3d3bb03cfde2eecd'),
	(4, 1, 'modulo_deletar','37c71e0c63fe3d007aa4ece847da8541'),
	(5, 2, 'usuario_criar','39d12358a09338a74b5c64c9e478d86b'),
	(6, 2, 'usuario_visualizar','4a5c36befd855430bf892bcd88255aaf'),
	(7, 2, 'usuario_editar','0d9ae71042b8d9b9e0ae8c196d8d4a5a'),
	(8, 2, 'usuario_deletar','5b54085c639264dbe33db53f60457c7e'),
	(9, 3, 'configuracao_criar','3e38f89bfc5fa44a179bba8904b759fa'),
	(10, 3, 'configuracao_visualizar','e8ba416878375fe60347cabec75159f0'),
	(11, 3, 'configuracao_editar','065a633506a8ce8c0b3a5755310b6b17'),
	(12, 3, 'configuracao_deletar','d22413a0f7c8dedf53e5f3bdb592fcd2'),
	(13, 4, 'submenu_criar','e50f858c2e87d0e55caccefd10030d72'),
	(14, 4, 'submenu_visualizar','e634b284d151cbd67ff1cdc160455b75'),
	(15, 4, 'submenu_editar','d122b8a00f6bdd6cfe4d00d2c43a6efc'),
	(16, 4, 'submenu_deletar','1785791cd91e72bca417bc5ce0c0af0c'),
	(17, 5, 'hierarquia_criar','82af03d7b8931a5fa708c027edbb835f'),
	(18, 5, 'hierarquia_visualizar','f104b987bc0927f9f54575dcd3f15eda'),
	(19, 5, 'hierarquia_editar','02a5fff71ec3c951a1cfdbcd50213509'),
	(20, 5, 'hierarquia_deletar','38fa3046cd2516c579b66ba770e65004'),
	(21, 6, 'candidato_criar','3d9c9470ad8763c304c9b6863503f2f3'),
	(22, 6, 'candidato_visualizar','d214d1234116fbdf5285e17ca9c0990c'),
	(23, 6, 'candidato_editar','e0aa165921d2f1d82022b96eab8e7433'),
	(24, 6, 'candidato_deletar','c5baa66c40a747d1922ddc1e2dde43eb'),
	(25, 7, 'paciente_criar','1d7a3f555a8c1b691cb477794e297a93'),
	(26, 7, 'paciente_visualizar','a93ae8d0ac79f5c6e633dd3849d742b5'),
	(27, 7, 'paciente_editar','ba4ec5903bd29209e4d128325d148d4c'),
	(28, 7, 'paciente_deletar','624af79c720e15713486b23c5b95729d'),
	(29, 8, 'ex_paciente_criar','15c22c6d7346e86c953b3d28dcb37ead'),
	(30, 8, 'ex_paciente_visualizar','4a03d9cdcb4377ce6653464955d80e63'),
	(31, 8, 'ex_paciente_editar','a86d2e7fadf719321e15b127954be667'),
	(32, 8, 'ex_paciente_deletar','81e7579cbc594e348021dfcc233c00c9'),
	(33, 9, 'aluno_criar','bca8014b542e466064bdb7a89774855e'),
	(34, 9, 'aluno_visualizar','5d1bbd93e9beb245489558aef962b5b9'),
	(35, 9, 'aluno_editar','0e7cee61ae888dea957667b370fe5875'),
	(36, 9, 'aluno_deletar','c793f72c38e1005344d1041b288c459f'),
	(37, 10 ,'bateria_criar','52f7a3198040252cf5a269524a4f6b22'),
	(38, 10 ,'bateria_visualizar','ccab388eae2a319c18b72f4ec8c7740f'),
	(39, 10 ,'bateria_editar','583faa25955f0784b78c7e94961b3039'),
	(40, 10 ,'bateria_deletar','824fe7c4a4fc5608116f7d503530f0bd'),
	(41, 11 ,'ficha_clinica_criar','6827f09a54dbe6f59f281b3f41e347f6'),
	(42, 11 ,'ficha_clinica_visualizar','e4efbb943a4640d2550304e25a033db1'),
	(43, 11 ,'ficha_clinica_editar','9a9927e25b300c0567586f16e9052502'),
	(44, 11 ,'ficha_clinica_deletar','51120561544488a14ecb7e32ca4d87c0'),
    (45, 6, 'candidato_transformar_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (46, 6, 'candidato_transformar_ex_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (47, 6, 'candidato_transformar_candidato','51120561544488a14ecb7e32ca4d87c0'),
    (48, 7, 'paciente_transformar_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (49, 7, 'paciente_transformar_ex_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (50, 7, 'paciente_transformar_candidato','51120561544488a14ecb7e32ca4d87c0'),
    (51, 8, 'ex_paciente_transformar_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (52, 8, 'ex_paciente_transformar_ex_paciente','51120561544488a14ecb7e32ca4d87c0'),
    (53, 8, 'ex_paciente_transformar_candidato','51120561544488a14ecb7e32ca4d87c0'),
    (54, 12,  'agenda_visualizar',  '4e5b94f90c937156a1901d0274cf1a2d'),
    (55, 12,  'agenda_criar',  '15ee3fcfded4fefe92e695c470fa0f04'),
    (56, 12,  'agenda_deletar',  'f01baa84ab7bc782fdf9d49b45cb6ba2'),
    (57, 12,  'agenda_editar',  '8b29eb6e4d13718ff25bfa4850f34320'),
    (58, 12,  'agenda_agendar',  '6eda82ee12a3367506780901b083acc0'),
    (59, 12,  'agenda_cancelar_agendamento',  '25694643fa0a33f400a622f6463e2507'),
    (60, 7,  'paciente_remover_por_excesso_de_faltas',  'e32ca4d87c0367506780901b083acc0'),
    (61, 9,  'aluno_remover_por_excesso_de_faltas',  '6eda82ee12a330a622f6463e2507');
    (62, 11,  'ficha_clinica_imprimir',  '6edac953b3e12a330a622f6463e2507');








INSERT INTO `hierarquia`
	VALUES
		(1,'Administrador',1),
		(2,'Secretaria',1),
		(3,'Aluno',1);

INSERT INTO `hierarquia_relaciona_permissao`
	VALUES
		(133,1,5,1),
		(134,1,6,1),
		(135,1,7,1),
		(136,1,8,1),
		(137,1,17,1),
		(138,1,18,1),
		(139,1,19,1),
		(140,1,20,1),
		(141,1,21,1),
		(142,1,22,1),
		(143,1,23,1),
		(144,1,24,1),
		(145,1,25,1),
		(146,1,26,1),
		(147,1,27,1),
		(148,1,28,1),
		(149,1,29,1),
		(150,1,30,1),
		(151,1,31,1),
		(152,1,32,1),
		(153,1,33,1),
		(154,1,34,1),
		(155,1,35,1),
		(156,1,36,1),
		(157,1,37,1),
		(158,1,38,1),
		(159,1,39,1),
		(160,1,40,1),
		(161,1,41,1),
		(162,1,42,1),
		(163,1,43,1),
		(164,1,44,1),
		(165,2,6,1),
		(166,2,21,1),
		(167,2,22,1),
		(168,2,23,1),
		(169,2,26,1),
		(170,2,27,1),
		(171,2,30,1),
		(172,2,34,1),
		(173,2,38,1),
		(174,2,42,1),
		(175,3,42,1),
		(176,3,43,1);

INSERT INTO `usuario`
  VALUES
	(1,'felideo@gmail.com','12345',NULL,1,1),
	(2,'admin@admin.com.br','12345',1,0,1);



ALTER TABLE `bateria`
	DROP COLUMN `qtd_atendimentos_dia`;

ALTER TABLE `bateria`
  ADD COLUMN `atendimentos_simultaneos` tinyint(1) not null;

ALTER TABLE `aluno`
  DROP COLUMN `rgm`;

ALTER TABLE `aluno`
  ADD COLUMN `rgm` varchar(16) not null AFTER nome;


CREATE TABLE `agendamento` (
	`id`									INT(11) 	NOT NULL AUTO_INCREMENT,
  	`data` 									DATE 		NOT NULL,
  	`hora` 									TIME 		NOT NULL,
  	`id_bateria_relaciona_aluno_paciente`	INT(11) 	NOT NULL,
  	`ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_bateria_relaciona_aluno_paciente`) REFERENCES `bateria_relaciona_aluno_paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



ALTER TABLE `agendamento`
  ADD COLUMN `presenca_aluno`      TINYINT(1) NULL AFTER `hora`,
  ADD COLUMN `presenca_paciente`  TINYINT(1) NULL AFTER `presenca_aluno`;

update agendamento SET ativo = 0;
update aluno SET ativo = 0;
update bateria SET ativo = 0;
update bateria_relaciona_aluno_paciente SET ativo = 0;
update contato SET ativo = 0;
update endereco SET ativo = 0;
update ficha_clinica SET ativo = 0;
update paciente SET ativo = 0;

update usuario SET ativo = 0 WHERE id > 18;

DELETE FROM table_name
WHERE some_column = some_value

DELETE FROM agendamento WHERE ativo = 0;
DELETE FROM aluno WHERE ativo = 0;
DELETE FROM bateria WHERE ativo = 0;
DELETE FROM bateria_relaciona_aluno_paciente WHERE ativo = 0;
DELETE FROM contato WHERE ativo = 0;
DELETE FROM endereco WHERE ativo = 0;
DELETE FROM ficha_clinica WHERE ativo = 0;
DELETE FROM paciente WHERE ativo = 0;


SELECT * FROM agendamento;
SELECT * FROM aluno;
SELECT * FROM bateria;
SELECT * FROM bateria_relaciona_aluno_paciente;
SELECT * FROM contato;
SELECT * FROM endereco;
SELECT * FROM ficha_clinica;
SELECT * FROM hierarquia;
SELECT * FROM hierarquia_relaciona_permissao;
SELECT * FROM modulo;
SELECT * FROM paciente;
SELECT * FROM permissao;
SELECT * FROM submenu;
SELECT * FROM usuario;

ALTER TABLE `aluno`
  ADD COLUMN `tipo` tinyint(1) not null DEFAULT 1 AFTER turma;

  ALTER TABLE NeuroSis.aluno MODIFY COLUMN tipo tinyint(1) DEFAULT 1 NOT NULL;
