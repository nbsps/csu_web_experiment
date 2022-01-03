/*
 Navicat Premium Data Transfer

 Source Server         : nbsps
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : user

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 22/11/2021 16:32:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码(hash)',
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'key值',
  `role` tinyint(1) UNSIGNED ZEROFILL NULL DEFAULT 0 COMMENT '0: user, 1: admin',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('888', 'stiheuqdblwtubffmlscfqkcflepfjlt', '2467214168@qq.com', 'atodnswfj6y6ffct2lbsq9mamzv14yz6', 1);
INSERT INTO `users` VALUES ('8208191112', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 0);
INSERT INTO `users` VALUES ('820819111', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 0);
INSERT INTO `users` VALUES ('8208191114', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 1);
INSERT INTO `users` VALUES ('5', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 1);
INSERT INTO `users` VALUES ('1', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 0);
INSERT INTO `users` VALUES ('2', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 0);
INSERT INTO `users` VALUES ('3', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 1);
INSERT INTO `users` VALUES ('4', 'dlikxitdmazpvimmdnodxigddeodzjwj', '2467214168@qq.com', 'rb3oyav2ckh2emh3ih0lea14mk6sp9ez', 1);
INSERT INTO `users` VALUES ('lazyLauncher', 'hapchccrdhaahxphjbebqimsabzdetko', NULL, 'jh6k6psh9jor4f9oebkcvi2cni8mezi7', 0);
INSERT INTO `users` VALUES ('lazyLauncher1', 'lqqkvjpteblsmoqdaaeuzdjfaabchzyf', NULL, 'xwwie0hvot6c2ivrhgte9znfhksn2iin', 0);

SET FOREIGN_KEY_CHECKS = 1;
