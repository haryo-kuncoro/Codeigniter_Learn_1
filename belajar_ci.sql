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

 Date: 18/07/2022 17:01:25
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
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_data_keluarga
-- ----------------------------
INSERT INTO `ci_data_keluarga` VALUES (1, 'Haryo Suro Kuncoro', '1995-06-20', 'Suami', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (2, 'Widya Ariska', '1998-04-21', 'Istri', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (3, 'Asma Khalisa Putri', '2021-07-14', 'Anak', 'yoyo');
INSERT INTO `ci_data_keluarga` VALUES (52, 'Tes Orang lain', '2000-04-04', 'Orang Lain', NULL);
INSERT INTO `ci_data_keluarga` VALUES (53, 'Tes Orang lain Lagi', '2000-04-04', 'Orang Lain', NULL);
INSERT INTO `ci_data_keluarga` VALUES (55, NULL, NULL, NULL, NULL);
INSERT INTO `ci_data_keluarga` VALUES (56, NULL, NULL, NULL, NULL);
INSERT INTO `ci_data_keluarga` VALUES (57, NULL, NULL, NULL, NULL);
INSERT INTO `ci_data_keluarga` VALUES (58, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for ci_data_user
-- ----------------------------
DROP TABLE IF EXISTS `ci_data_user`;
CREATE TABLE `ci_data_user`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `KD_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NM_USER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `PWD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `STATUS` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '[0]nonaktif; [1]aktif',
  `LEVEL` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '[0]notauthorized; [1]administrator; [2]user',
  `DARK_THEME` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '[0]false; [1]true',
  `TOKEN_API` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `DATE_TOKEN_CREATE` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_data_user
-- ----------------------------
INSERT INTO `ci_data_user` VALUES (1, 'yoyo', 'Haryo Suro Kuncoro', '1', '1', '1', '0', 'e5abc43568ca14e0a54090f4c8721519c8257b26bb66f64e14ed2fe82041bcb298dcd64b6cba2571', '2022-07-18 04:36:08');
INSERT INTO `ci_data_user` VALUES (2, 'admin', 'Admin', '1', '1', '1', '0', '4010e96eda9f6c58bc5359105fc3b8ee6cdb15c31fc141bd8a0f42c5b08d892b0fffcb27f5d48930', '2022-07-16 03:13:12');

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
