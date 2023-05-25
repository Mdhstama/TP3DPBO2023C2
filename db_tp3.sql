/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100136 (10.1.36-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_tp3

 Target Server Type    : MySQL
 Target Server Version : 100136 (10.1.36-MariaDB)
 File Encoding         : 65001

 Date: 25/05/2023 13:12:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_human
-- ----------------------------
DROP TABLE IF EXISTS `tb_human`;
CREATE TABLE `tb_human`  (
  `id_player` int NOT NULL AUTO_INCREMENT,
  `real_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `in_game_nickname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_club` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_player`) USING BTREE,
  INDEX `club`(`id_club` ASC) USING BTREE,
  INDEX `role`(`id_role` ASC) USING BTREE,
  CONSTRAINT `club` FOREIGN KEY (`id_club`) REFERENCES `tb_team` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_human
-- ----------------------------
INSERT INTO `tb_human` VALUES (2, 'Jason Susanto', 'f0rsakeN', 'Indonesia', 'jason.jpg', 1, 18);
INSERT INTO `tb_human` VALUES (4, 'Ilya Petrov', 'something', 'Russia', 'ilya.jpg', 1, 17);
INSERT INTO `tb_human` VALUES (5, 'Wang Jing Jie', 'Jinggg', 'Singapore', 'jing.jpg', 1, 17);
INSERT INTO `tb_human` VALUES (8, 'Alexandre Salle', 'alecks', 'France', 'alek.jpg', 1, 14);
INSERT INTO `tb_human` VALUES (16, 'Aaron Leonhart', 'mindfreak', 'Indonesian', 'aaron.jpg', 1, 16);

-- ----------------------------
-- Table structure for tb_role
-- ----------------------------
DROP TABLE IF EXISTS `tb_role`;
CREATE TABLE `tb_role`  (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `name_role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_role
-- ----------------------------
INSERT INTO `tb_role` VALUES (9, 'Interim Coach');
INSERT INTO `tb_role` VALUES (14, 'Coach');
INSERT INTO `tb_role` VALUES (15, 'Analyst');
INSERT INTO `tb_role` VALUES (16, 'Controller');
INSERT INTO `tb_role` VALUES (17, 'Duelist');
INSERT INTO `tb_role` VALUES (18, 'Sentinel');
INSERT INTO `tb_role` VALUES (20, 'Initiator');

-- ----------------------------
-- Table structure for tb_team
-- ----------------------------
DROP TABLE IF EXISTS `tb_team`;
CREATE TABLE `tb_team`  (
  `id_club` int NOT NULL AUTO_INCREMENT,
  `name_team` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_club`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_team
-- ----------------------------
INSERT INTO `tb_team` VALUES (1, 'Paper Rex');
INSERT INTO `tb_team` VALUES (2, 'Fnatic');
INSERT INTO `tb_team` VALUES (3, 'NRG Esports');
INSERT INTO `tb_team` VALUES (4, 'LOUD ');
INSERT INTO `tb_team` VALUES (5, 'Cloud9');
INSERT INTO `tb_team` VALUES (6, 'DRX');
INSERT INTO `tb_team` VALUES (10, 'Pantheon Smasher');

SET FOREIGN_KEY_CHECKS = 1;
