/*
 Navicat Premium Data Transfer

 Source Server         : Connection MySQL
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : project_lab_puskes

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 26/04/2021 08:56:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dokter
-- ----------------------------
DROP TABLE IF EXISTS `dokter`;
CREATE TABLE `dokter`  (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jk` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telpon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `poli` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dokter`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dokter
-- ----------------------------
INSERT INTO `dokter` VALUES (1, 'dr. Santoso, S. Ap', '123', 'Laki-laki', '123', 'abc', 'anak');
INSERT INTO `dokter` VALUES (2, 'anang', '234', 'Laki-laki', '4545445', 'fasfasdfasd', 'dfasfasf');

-- ----------------------------
-- Table structure for hasil_pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `hasil_pemeriksaan`;
CREATE TABLE `hasil_pemeriksaan`  (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemeriksaan` int(11) NOT NULL,
  `leucosit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `trombosit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `malaria` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rapid_covid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gds` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gdp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cholesterol` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `trigliserida` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `protein` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `golongan_darah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kesimpulan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_hasil` date NOT NULL,
  PRIMARY KEY (`id_hasil`) USING BTREE,
  INDEX `pemeriksaan`(`id_pemeriksaan`) USING BTREE,
  CONSTRAINT `pemeriksaan` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `pemeriksaan` (`id_pemeriksaan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil_pemeriksaan
-- ----------------------------
INSERT INTO `hasil_pemeriksaan` VALUES (1, 1, 'jhjgj', 'jhgjhg', 'uytyuvhg', 'ghchgc', 'hghg', 'cghhjgc', 'hgcgcghc', 'ghvgh', 'hgvgh', '-', 'sehat', '2021-04-15');

-- ----------------------------
-- Table structure for nomor_antri
-- ----------------------------
DROP TABLE IF EXISTS `nomor_antri`;
CREATE TABLE `nomor_antri`  (
  `id_antri` int(11) NOT NULL AUTO_INCREMENT,
  `no_antri` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Selesai','Belum Selesai') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_antri`) USING BTREE,
  INDEX `pasien`(`id_pasien`) USING BTREE,
  CONSTRAINT `pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nomor_antri
-- ----------------------------
INSERT INTO `nomor_antri` VALUES (13, '001', 6, '2021-04-15', 'Selesai', 'cek gula darah');

-- ----------------------------
-- Table structure for pasien
-- ----------------------------
DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien`  (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pasien` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_ktp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jk` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telpon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_pasien`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pasien
-- ----------------------------
INSERT INTO `pasien` VALUES (6, 'P001', '12345', 'Abdullah', 'Laki-laki', 'Mengkatip', '1980-04-15', 'Jl Mengkatip', '0987654345325', 3);

-- ----------------------------
-- Table structure for pemeriksaan
-- ----------------------------
DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE `pemeriksaan`  (
  `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerimaan` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `jam_periksa` time NOT NULL,
  PRIMARY KEY (`id_pemeriksaan`) USING BTREE,
  INDEX `penerimaan`(`id_penerimaan`) USING BTREE,
  INDEX `dokter`(`id_dokter`) USING BTREE,
  CONSTRAINT `dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `penerimaan` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan` (`id_penerimaan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemeriksaan
-- ----------------------------
INSERT INTO `pemeriksaan` VALUES (1, 1, 1, '2021-04-15', '22:55:00');

-- ----------------------------
-- Table structure for penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `penerimaan`;
CREATE TABLE `penerimaan`  (
  `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_antri` int(11) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  PRIMARY KEY (`id_penerimaan`) USING BTREE,
  INDEX `antrian`(`id_antri`) USING BTREE,
  CONSTRAINT `antrian` FOREIGN KEY (`id_antri`) REFERENCES `nomor_antri` (`id_antri`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penerimaan
-- ----------------------------
INSERT INTO `penerimaan` VALUES (1, 13, '2021-04-15');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` enum('superadmin','adminlab','pasien') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin');
INSERT INTO `user` VALUES (2, 'adminlab', 'de2b643ce7e1d85739b5c3f552bcc4ef', 'adminlab');
INSERT INTO `user` VALUES (3, 'abdul', '827ccb0eea8a706c4c34a16891f84e7b', 'pasien');

SET FOREIGN_KEY_CHECKS = 1;
