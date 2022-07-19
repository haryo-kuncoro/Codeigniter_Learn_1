/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : belajar_ci

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 19/07/2022 16:54:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ci_data_keluarga
-- ----------------------------
DROP TABLE IF EXISTS `ci_data_keluarga`;
CREATE TABLE `ci_data_keluarga`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NAMA_LENGKAP` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `TGL_LAHIR` date NULL DEFAULT NULL,
  `STATUS` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `KD_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_data_keluarga
-- ----------------------------
INSERT INTO `ci_data_keluarga` VALUES (1, 'Haryo Suro Kuncoro', '1995-06-20', 'Suami', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (2, 'Widya Ariska', '1998-04-21', 'Istri', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (3, 'Asma Khalisa Putri', '2021-07-14', 'Anak', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (59, 'Tes Orang lain Lagi', '2000-04-04', 'Orang Lain', 'yoyo');

-- ----------------------------
-- Table structure for ci_data_user
-- ----------------------------
DROP TABLE IF EXISTS `ci_data_user`;
CREATE TABLE `ci_data_user`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `KD_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NM_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `PWD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `STATUS` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1' COMMENT '[0]nonaktif; [1]aktif',
  `LEVEL` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1' COMMENT '[0]notauthorized; [1]administrator; [2]user',
  `DARK_THEME` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '[0]false; [1]true',
  `TOKEN_API` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `DATE_TOKEN_CREATE` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_data_user
-- ----------------------------
INSERT INTO `ci_data_user` VALUES (1, 'yoyo', 'Haryo Suro Kuncoro', '356a192b7913b04c54574d18c28d46e6395428ab', '1', '1', '0', 'b348ee373b9a1b55e643e0dc244a80f89774f63387ffddc6a08ec2ab7b127876d9a126a00b12a530', '2022-07-19 04:02:56');
INSERT INTO `ci_data_user` VALUES (2, 'admin', 'Admin', '356a192b7913b04c54574d18c28d46e6395428ab', '1', '1', '0', '1f96c4fd0a9792aa073fe9467bec0fc40255815f80ff25bb76795e6456ab187ebc331f1b99d58399', '2022-07-19 03:00:10');
INSERT INTO `ci_data_user` VALUES (10, 'ayyasi', 'Ayyasi Fawaz', '9b2c3280ccea0ba408270c45185bfbcd36164237', '1', '1', '0', '2aac574ffabe1da5709ffc2b48b5ca11875c6b07ae28b5268bda486d542625b14badd332d4158125', '2022-07-19 04:48:42');

-- ----------------------------
-- Table structure for ci_setting
-- ----------------------------
DROP TABLE IF EXISTS `ci_setting`;
CREATE TABLE `ci_setting`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DARK` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0:false, 1:true',
  `KD_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_setting
-- ----------------------------
INSERT INTO `ci_setting` VALUES (1, '0', 'yoyo');

SET FOREIGN_KEY_CHECKS = 1;
