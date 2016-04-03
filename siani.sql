/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : siani

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-02 21:12:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for consumidor_cadastro
-- ----------------------------
DROP TABLE IF EXISTS `consumidor_cadastro`;
CREATE TABLE `consumidor_cadastro` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `apartamento` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of consumidor_cadastro
-- ----------------------------
INSERT INTO `consumidor_cadastro` VALUES ('1', 'kkk', '111', 'lll', '444');
INSERT INTO `consumidor_cadastro` VALUES ('2', 'mmmm', '555', '555', '555');
INSERT INTO `consumidor_cadastro` VALUES ('3', 'mmmm', '555', '555', '555');
INSERT INTO `consumidor_cadastro` VALUES ('4', 'ddddd', '11', 'kkk', '111');
INSERT INTO `consumidor_cadastro` VALUES ('5', 'ddddd', '11', 'kkk', '111');
INSERT INTO `consumidor_cadastro` VALUES ('6', 'qqq', '0', 'lll', '0');
INSERT INTO `consumidor_cadastro` VALUES ('7', 'ssfsdfa', '11234213', 'sdsdf', '123412');
INSERT INTO `consumidor_cadastro` VALUES ('8', 'ssfsdfa', '11234213', 'sdsdf', '123412');
INSERT INTO `consumidor_cadastro` VALUES ('9', 'ssfsdfa', '11234213', 'sdsdf', '123412');
INSERT INTO `consumidor_cadastro` VALUES ('10', 'lerolero', '11241234', 'sdvdf', '14234');

-- ----------------------------
-- Table structure for data
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `dataid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`dataid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data
-- ----------------------------
INSERT INTO `data` VALUES ('11', 'dasddqdqd');
INSERT INTO `data` VALUES ('12', 'ffff');
INSERT INTO `data` VALUES ('34', 'Que isso novinha');
INSERT INTO `data` VALUES ('35', 'que que iso faz???');

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `hierarquia` int(11) NOT NULL,
  `visivel` tinyint(1) NOT NULL,
  `icone` varchar(64) NOT NULL DEFAULT 'fa-angle-right',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modulos
-- ----------------------------
INSERT INTO `modulos` VALUES ('1', 'modulos', 'Modulos', '0', '1', 'fa-check-square-o');
INSERT INTO `modulos` VALUES ('2', 'user', 'Usuarios', '1', '1', 'fa-users');
INSERT INTO `modulos` VALUES ('3', 'trecho', 'Trechos', '1', '1', 'fa-arrows-h');
INSERT INTO `modulos` VALUES ('4', 'hidrocontrol', 'Hidrometros de Controle', '1', '1', 'fa-clock-o');

-- ----------------------------
-- Table structure for note
-- ----------------------------
DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `noteid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`noteid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of note
-- ----------------------------
INSERT INTO `note` VALUES ('1', '1', 'Jesse', 'Some content test', '0000-00-00 00:00:00');
INSERT INTO `note` VALUES ('7', '1', 'testasdsaas', 'asdasd', '2012-11-08 20:02:53');
INSERT INTO `note` VALUES ('9', '9', 'teste2', 'teste2', '2012-11-08 20:18:55');
INSERT INTO `note` VALUES ('10', '10', 'cu', 'cu', '2016-03-02 21:45:16');
INSERT INTO `note` VALUES ('11', '10', 'buceta', 'buceta', '2016-03-02 21:45:27');
INSERT INTO `note` VALUES ('12', '10', 'lkjhblhbl', 'khvkhgvkgh', '2016-03-22 21:22:00');

-- ----------------------------
-- Table structure for person
-- ----------------------------
DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `personid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(1) NOT NULL,
  PRIMARY KEY (`personid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of person
-- ----------------------------
INSERT INTO `person` VALUES ('1', 'jesse', '2', '0');
INSERT INTO `person` VALUES ('2', 'joe', '22', 'm');

-- ----------------------------
-- Table structure for trecho
-- ----------------------------
DROP TABLE IF EXISTS `trecho`;
CREATE TABLE `trecho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localizacao` varchar(512) COLLATE utf8_icelandic_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci;

-- ----------------------------
-- Records of trecho
-- ----------------------------
INSERT INTO `trecho` VALUES ('1', '10Â° Andar', '1');
INSERT INTO `trecho` VALUES ('2', '9Â° Andar', '1');
INSERT INTO `trecho` VALUES ('3', '8Â° Andar', '1');
INSERT INTO `trecho` VALUES ('4', '7Â° Andar', '0');
INSERT INTO `trecho` VALUES ('5', '6Â° Andar', '1');
INSERT INTO `trecho` VALUES ('6', '5Â° Andar', '1');
INSERT INTO `trecho` VALUES ('7', '4Â° Andar', '1');
INSERT INTO `trecho` VALUES ('8', '3Â° Andar', '1');
INSERT INTO `trecho` VALUES ('9', '2Â° Andar', '1');
INSERT INTO `trecho` VALUES ('10', '1Â° Andar', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('default','admin','owner') NOT NULL DEFAULT 'default',
  `hierarquia` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'jesse', '3327a2154aa1900fa110ae3d20d27d051ba719ead0396f1a23d6865b2677ed4a', 'owner', '0');
INSERT INTO `user` VALUES ('8', 'joe', 'c88a8d39b76a45e1842bc920c48c221ca7a2a835806308efd63ec7eeb751a5b6', 'default', '0');
INSERT INTO `user` VALUES ('9', 'jesse2', '0889bcc6832e0994d99a1930924c23dd75417a58ee308b9b2223c0573e536b3f', 'default', '0');
INSERT INTO `user` VALUES ('10', 'felideo', 'db43f2e0c286138f02780956af17cedbc90ba591af4d1f0f326d00276aaf2a7a', 'owner', '0');
