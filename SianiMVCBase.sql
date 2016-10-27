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
        (7,'paciente','Pacientes',NULL,1,'fa-check-circle',0,1000,1),
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
