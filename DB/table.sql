/*
MySQL Backup
Database: nolimits
Backup Time: 2025-01-09 10:18:24
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `nolimit`.`addons`;
DROP TABLE IF EXISTS `nolimit`.`cabang`;
DROP TABLE IF EXISTS `nolimit`.`customers`;
DROP TABLE IF EXISTS `nolimit`.`fnb_hdr`;
DROP TABLE IF EXISTS `nolimit`.`fnb_item`;
DROP TABLE IF EXISTS `nolimit`.`fnb_kategori`;
DROP TABLE IF EXISTS `nolimit`.`fnb_trans`;
DROP TABLE IF EXISTS `nolimit`.`gym_hdr`;
DROP TABLE IF EXISTS `nolimit`.`gym_trans`;
DROP TABLE IF EXISTS `nolimit`.`kelas`;
DROP TABLE IF EXISTS `nolimit`.`kelas_boxing`;
DROP TABLE IF EXISTS `nolimit`.`member_visit`;
DROP TABLE IF EXISTS `nolimit`.`membership`;
DROP TABLE IF EXISTS `nolimit`.`membership_cat`;
DROP TABLE IF EXISTS `nolimit`.`membership_trans`;
DROP TABLE IF EXISTS `nolimit`.`menu`;
DROP TABLE IF EXISTS `nolimit`.`nonmember_visit`;
DROP TABLE IF EXISTS `nolimit`.`trainer`;
DROP TABLE IF EXISTS `nolimit`.`user`;
DROP TABLE IF EXISTS `nolimit`.`user_group`;
DROP TABLE IF EXISTS `nolimit`.`usermenu`;
CREATE TABLE `addons` (
  `id` varchar(6) NOT NULL COMMENT 'ADD001',
  `kdcab` varchar(5) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `cabang` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` tinytext,
  `telp` varchar(20) DEFAULT NULL,
  `hp` varchar(25) DEFAULT NULL,
  `email` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `sosmed` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `customers` (
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'SMG1001',
  `kdcab` varchar(5) DEFAULT NULL,
  `noktp` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `hp_wa` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` tinytext,
  `barcode` tinytext,
  `password` varchar(255) DEFAULT NULL,
  `idcard_image` varchar(255) DEFAULT NULL COMMENT 'image',
  `fp_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `fnb_hdr` (
  `hdr_id` varchar(25) NOT NULL COMMENT 'TRXSMG012405150001',
  `kdcab` varchar(5) DEFAULT NULL,
  `custid` varchar(7) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hdr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `fnb_item` (
  `iditem` varchar(12) NOT NULL COMMENT 'SMG01MKN0001',
  `idkat` varchar(3) DEFAULT NULL,
  `kdcab` varchar(5) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iditem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `fnb_kategori` (
  `id` varchar(3) NOT NULL COMMENT 'MKN, MNM, SNK',
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `fnb_trans` (
  `hdr_id` varchar(25) DEFAULT NULL,
  `item` varchar(12) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `gym_hdr` (
  `id` varchar(14) NOT NULL COMMENT 'TRXG1705240001',
  `kdcab` varchar(5) DEFAULT NULL,
  `custid` varchar(7) DEFAULT NULL COMMENT 'UM = umum',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `gym_trans` (
  `gym_hdr` varchar(14) DEFAULT NULL,
  `mem_kls` varchar(10) DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Kelas, member id, addons',
  `biaya` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `kelas` (
  `id` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'KLS001',
  `kdcab` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `trainer` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `kelas_boxing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kdcab` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `trainer` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `member_visit` (
  `idx` bigint NOT NULL AUTO_INCREMENT,
  `idmember` varchar(10) DEFAULT NULL,
  `cabang` varchar(5) DEFAULT NULL,
  `locker` varchar(3) DEFAULT NULL,
  `handuk` enum('ya','tidak','kembali') DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `membership` (
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'MBS2405001',
  `nama` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `expired` int DEFAULT NULL COMMENT 'lama bulan expired',
  `deskripsi` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `catid` int DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `membership_cat` (
  `catid` int NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `membership_trans` (
  `id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'SMG01-DFT-2405150001',
  `custid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `membershipid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_deskription` varchar(255) DEFAULT NULL,
  `payment_bill` varchar(255) DEFAULT NULL COMMENT 'image',
  `expired_date` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `transaction_status` varchar(100) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `va_number` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `menu` (
  `MenuID` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Icon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Seq` int DEFAULT NULL,
  `Level` int DEFAULT NULL,
  `Active` int DEFAULT '0',
  `Public` int DEFAULT NULL,
  `Link` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`MenuID`) USING BTREE,
  KEY `MenuID` (`MenuID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
CREATE TABLE `nonmember_visit` (
  `idx` bigint NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cabang` varchar(5) DEFAULT NULL,
  `locker` varchar(3) DEFAULT NULL,
  `handuk` enum('ya','tidak','kembali') DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `paket_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `trainer` (
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'SMG1TRN001',
  `kdcab` varchar(5) DEFAULT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` tinytext,
  `hp` varchar(25) DEFAULT NULL,
  `foto` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `user` (
  `UserID` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varbinary(255) NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `UserGroup` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `LastActivity` datetime DEFAULT NULL,
  `LastIP` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CurrentActivity` datetime DEFAULT NULL,
  `CurrentIP` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Ket` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kdcab` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `token` char(64) NOT NULL,
  `token_created_at` datetime NOT NULL,
  PRIMARY KEY (`UserID`,`Nama`) USING BTREE,
  UNIQUE KEY `idxUserID` (`UserID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
CREATE TABLE `user_group` (
  `groupid` varchar(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `urut` int DEFAULT NULL,
  `dashboard_path` tinytext,
  `crud` tinytext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `usermenu` (
  `menuid` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `userid` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`menuid`,`userid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;
BEGIN;
LOCK TABLES `nolimit`.`addons` WRITE;
DELETE FROM `nolimit`.`addons`;
INSERT INTO `nolimit`.`addons` (`id`,`kdcab`,`nama`,`biaya`,`created_at`,`updated_at`,`deleted_at`,`user`) VALUES ('ADD001', 'SMG1', 'Handuk', 35000, '2024-06-21 15:00:57', NULL, NULL, 'sadmin'),('ADD002', 'SMG1', 'Sandal Japit', 50000, '2024-06-21 15:00:57', NULL, NULL, 'sadmin');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`cabang` WRITE;
DELETE FROM `nolimit`.`cabang`;
INSERT INTO `nolimit`.`cabang` (`id`,`nama`,`alamat`,`telp`,`hp`,`email`,`sosmed`,`created_at`,`updated_at`,`deleted_at`,`kota`) VALUES ('NL01', 'No Limits WR. Supratman', 'Jl. Wr. Supratman, Kalibanteng Kidul, Kec. Semarang Barat, Kota Semarang, Jawa Tengah', '0249292929', '0812373773', 'nolimits.smg@gmail.com', '', '2024-08-06 16:51:03', '2024-11-05 11:27:31', NULL, 'semarang'),('NL02', 'No Limits Pekunden', 'Jl. Batan Selatan No.1042, Pekunden, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah', '099999', '09999', 'cabang@gmail.com', '', '2024-08-07 22:28:26', '2024-10-26 09:07:51', NULL, 'semarang'),('NL03', 'No Limits Jogja', 'JL. Bumijo no. 50, Sleman, Jogjakarta', '0299123456', '08812345678', 'jogja@nolimitstraining.id', '', '2025-01-04 07:40:52', '2025-01-04 07:40:52', NULL, 'jogjakarta');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`customers` WRITE;
DELETE FROM `nolimit`.`customers`;
INSERT INTO `nolimit`.`customers` (`id`,`kdcab`,`noktp`,`nama`,`tgl_lhr`,`hp_wa`,`email`,`alamat`,`barcode`,`password`,`idcard_image`,`fp_image`,`created_at`,`updated_at`,`deleted_at`,`user`) VALUES ('NL01001', 'NL01', NULL, 'Juniar Arif Wicaksono', NULL, NULL, 'juniararifwicaksono@gmail.com', NULL, NULL, NULL, 'ktp_CAB01001.jpg', 'fp_CAB01001.jpg', '2024-12-05 14:25:13', '2024-12-05 14:25:13', NULL, NULL),('NL01002', 'NL01', NULL, 'wuhu waha', NULL, '0888999', 'arifsavutage@gmail.com', 'Boja', NULL, NULL, 'ktp_CAB01002.jpg', 'fp_CAB01002.jpg', '2024-12-18 16:53:29', '2024-12-18 16:53:29', NULL, NULL),('NL02001', 'NL02', NULL, 'Fayyadh Ammar Adiatma', NULL, '0881242424', 'arifokbgt@gmail.com', 'Bancar Residence II Blk. D No. 1 Krajan Barat, Kel. Meteseh, Kec. Boja, Kendal', NULL, NULL, 'fp_CAB02001.jpg', 'fp_CAB02001.jpg', '2024-12-06 10:46:34', '2024-12-21 23:04:30', NULL, 'nolimits');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`fnb_hdr` WRITE;
DELETE FROM `nolimit`.`fnb_hdr`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`fnb_item` WRITE;
DELETE FROM `nolimit`.`fnb_item`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`fnb_kategori` WRITE;
DELETE FROM `nolimit`.`fnb_kategori`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`fnb_trans` WRITE;
DELETE FROM `nolimit`.`fnb_trans`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`gym_hdr` WRITE;
DELETE FROM `nolimit`.`gym_hdr`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`gym_trans` WRITE;
DELETE FROM `nolimit`.`gym_trans`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`kelas` WRITE;
DELETE FROM `nolimit`.`kelas`;
INSERT INTO `nolimit`.`kelas` (`id`,`kdcab`,`nama`,`hari`,`jam_mulai`,`jam_akhir`,`trainer`,`created_at`,`updated_at`,`deleted_at`,`user`) VALUES ('KLS001', 'CAB01', 'Body Builder', 'Selasa', '10:30:00', '11:15:00', 'TRN0001', '2024-08-07 21:07:37', '2024-08-07 21:18:07', NULL, 'sadmin'),('KLS002', 'CAB01', 'Body Combat', 'Sabtu', '10:00:00', '11:45:00', 'TRN0002', '2024-08-07 22:36:16', '2024-08-10 12:51:54', NULL, 'sadmin');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`kelas_boxing` WRITE;
DELETE FROM `nolimit`.`kelas_boxing`;
INSERT INTO `nolimit`.`kelas_boxing` (`id`,`kdcab`,`nama`,`hari`,`jam_mulai`,`jam_akhir`,`trainer`,`created_at`,`updated_at`,`deleted_at`,`user`) VALUES (1, 'CAB02', 'Boxing', 'Senin', '10:00:00', '11:30:00', 'TRN0007', '2024-12-26 09:19:41', '2024-12-26 09:25:42', NULL, 'nolimits'),(2, 'CAB01', 'Boxing', 'Senin', '15:30:00', '17:30:00', 'TRN0007', '2024-12-26 09:26:25', '2024-12-26 09:26:25', NULL, 'nolimits');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`member_visit` WRITE;
DELETE FROM `nolimit`.`member_visit`;
INSERT INTO `nolimit`.`member_visit` (`idx`,`idmember`,`cabang`,`locker`,`handuk`,`user`,`created_at`,`updated_at`,`deleted_at`) VALUES (23, 'NL01001', 'NL01', '15', 'ya', 'sadmin', '2025-01-09 07:21:16', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`membership` WRITE;
DELETE FROM `nolimit`.`membership`;
INSERT INTO `nolimit`.`membership` (`id`,`nama`,`nominal`,`expired`,`deskripsi`,`created_at`,`updated_at`,`deleted_at`,`user`,`catid`,`kota`) VALUES ('MBS0125011', 'Pervisit', 75000, 0, '', '2025-01-04 11:03:29', '2025-01-04 11:03:29', NULL, 'sadmin', 5, 'Jogjakarta'),('MBS0125012', '1 Month', 300000, 1, '', '2025-01-04 11:03:58', '2025-01-04 11:03:58', NULL, 'sadmin', 6, 'Jogjakarta'),('MBS0125013', '6 Month', 1500000, 6, '', '2025-01-04 11:04:24', '2025-01-04 11:04:24', NULL, 'sadmin', 6, 'Jogjakarta'),('MBS0125014', '12 Month', 2400000, 12, '', '2025-01-04 11:04:59', '2025-01-04 11:04:59', NULL, 'sadmin', 6, 'Jogjakarta'),('MBS0125015', '1 Month', 250000, 1, '', '2025-01-04 11:05:26', '2025-01-04 11:05:26', NULL, 'sadmin', 7, 'Jogjakarta'),('MBS0125016', '6 Month', 1200000, 6, '', '2025-01-04 11:05:55', '2025-01-04 11:05:55', NULL, 'sadmin', 7, 'Jogjakarta'),('MBS0125017', '12 Month', 2100000, 12, '', '2025-01-04 11:06:21', '2025-01-04 11:06:21', NULL, 'sadmin', 7, 'Jogjakarta'),('MBS1024001', 'Pervisit', 75000, 0, 'Biaya pervisit,Locker + Bathroom+Towel,Free Refill Water', '2024-10-26 09:15:53', '2024-10-26 12:39:29', NULL, 'sadmin', 1, 'semarang'),('MBS1024002', '1 Bulan', 350000, 1, 'Membership 1 bulan,Locker+Bathroom+Towel,Free Refill Water', '2024-10-26 09:17:53', '2024-10-26 12:42:23', NULL, 'sadmin', 1, 'semarang'),('MBS1024003', '6 Bulan', 1800000, 6, 'Membership 6 bulan,Locker+Bathroom+Towel,Free Refill Water', '2024-10-26 09:18:26', '2024-10-26 12:42:15', NULL, 'sadmin', 1, 'semarang'),('MBS1024004', '12 Bulan', 3000000, 12, 'Membership 12 bulan,Locker+Bathroom+Towel,Free Refill Water,', '2024-10-26 09:18:53', '2024-10-26 12:42:03', NULL, 'sadmin', 1, 'semarang'),('MBS1024005', '1 Bulan + 4x', 575000, 1, 'Membership 1 Bulan, Gym & Boxing / Muaythai (4x), Locker+Bathroom+Towel, Free Refill Water', '2024-10-26 09:20:31', '2024-10-26 12:41:02', NULL, 'sadmin', 3, 'semarang'),('MBS1024006', '6 Bulan + 8x', 2200000, 6, 'Membership 6 Bulan, Gym & Muaythai / Boxing (8x),Locker+Bathroom+Towel,Free Refill Water', '2024-10-26 12:21:29', '2024-10-26 12:41:20', NULL, 'sadmin', 3, 'semarang'),('MBS1024007', '12 Bulan + 16x', 3700000, 12, 'Membership 12 bulan,Gym & Boxing / Muaythai (16x),Locker+Bathroom+Towel, Free Refill Water', '2024-10-26 12:35:32', '2024-10-26 12:41:35', NULL, 'sadmin', 3, 'semarang'),('MBS1224008', '1x (Pervisit)', 100000, 0, '', '2024-12-18 15:43:04', '2024-12-18 15:43:04', NULL, 'nolimits', 2, 'semarang'),('MBS1224009', '4x - 1 Bulan', 350000, 1, '', '2024-12-18 15:44:23', '2024-12-18 15:44:23', NULL, 'nolimits', 2, 'semarang'),('MBS1224010', '8x - 2 Bulan', 600000, 2, '', '2024-12-18 15:44:50', '2024-12-18 15:44:50', NULL, 'nolimits', 2, 'semarang');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`membership_cat` WRITE;
DELETE FROM `nolimit`.`membership_cat`;
INSERT INTO `nolimit`.`membership_cat` (`catid`,`catname`,`created_at`,`updated_at`,`deleted_at`) VALUES (1, 'Gym Membership', '2024-12-14 10:25:31', NULL, NULL),(2, 'Boxing Sessions', '2024-12-14 10:25:34', NULL, NULL),(3, 'Gym + Boxing Bundling', '2024-12-14 10:25:38', NULL, NULL),(4, 'Samba', '2024-12-14 12:58:07', '2024-12-18 15:38:15', '2024-12-18 15:38:15'),(5, 'Day Pass', '2025-01-04 11:02:17', '2025-01-04 11:02:17', NULL),(6, 'Normal Price', '2025-01-04 11:02:36', '2025-01-04 11:02:36', NULL),(7, 'Student Price', '2025-01-04 11:02:47', '2025-01-04 11:02:47', NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`membership_trans` WRITE;
DELETE FROM `nolimit`.`membership_trans`;
INSERT INTO `nolimit`.`membership_trans` (`id`,`custid`,`membershipid`,`nominal`,`payment_method`,`payment_date`,`payment_deskription`,`payment_bill`,`expired_date`,`status`,`created_at`,`updated_at`,`deleted_at`,`user`,`payment_type`,`transaction_time`,`transaction_status`,`bank`,`va_number`) VALUES ('CAB01202412051425137', 'NL01001', 'MBS1024005', 575000, NULL, '2024-12-06 00:00:00', NULL, NULL, '2025-01-06 23:59:00', 2, '2024-12-05 14:25:13', '2024-12-06 10:56:27', NULL, 'nolimits', 'Qris', NULL, NULL, NULL, NULL),('CAB01202412181653296', 'NL01002', 'MBS1224009', 350000, NULL, '2024-12-18 00:00:00', NULL, NULL, '2025-01-18 23:59:00', 1, '2024-12-18 16:53:29', '2024-12-18 17:00:43', NULL, 'nolimits', 'Qris', NULL, NULL, NULL, NULL),('CAB02202412061046346', 'NL02001', 'MBS1024002', 350000, NULL, '2024-12-06 00:00:00', NULL, NULL, '2025-01-06 23:59:00', 2, '2024-12-06 10:46:34', '2024-12-06 10:57:23', NULL, 'nolimits', 'Cash', NULL, NULL, NULL, NULL),('NL012025010816310801', 'NL01001', 'MBS1024007', 3700000, NULL, '2025-01-08 00:00:00', NULL, NULL, '2026-01-08 23:59:00', 1, '2025-01-08 16:31:08', '2025-01-08 17:11:50', NULL, 'sadmin', 'Qris', NULL, NULL, NULL, NULL),('NL022025010904030141', 'NL02001', 'MBS1224009', 350000, NULL, '2025-01-09 00:00:00', NULL, NULL, '2025-02-09 23:59:00', 1, '2025-01-09 04:03:01', '2025-01-09 04:10:01', NULL, 'sadmin', 'Cash', NULL, NULL, NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`menu` WRITE;
DELETE FROM `nolimit`.`menu`;
INSERT INTO `nolimit`.`menu` (`MenuID`,`Name`,`Icon`,`Seq`,`Level`,`Active`,`Public`,`Link`) VALUES ('0804', 'User Menu', '', 4, 2, 0, 0, '/menu/user'),('0803', 'Menu', '', 3, 2, 0, 0, '/menu'),('0802', 'Group', '', 2, 2, 0, 0, '/account/group'),('0801', 'Daftar User', '', 1, 2, 0, 0, '/account/list'),('08', 'User Account', 'fas fa-fw fa-user-cog', 88, 1, 0, 0, ''),('0702', 'Food & Baverage', '', 2, 2, 0, 0, '/transaksi-fnb'),('0701', 'Kunjungan Gym', '', 1, 2, 0, 0, '/transaksi-gym'),('07', 'Kasir', 'fas fa-fw fa-cash-register', 77, 1, 0, 0, ''),('06', 'Reports', 'fas fa-fw fa-file', 66, 1, 1, 0, ''),('0502', 'Daftar Transaksi', '', 2, 2, 0, 0, '/food-transaction-lits'),('0501', 'Daftar Item', '', 1, 2, 0, 0, '/food-item'),('05', 'Makanan & Minuman', 'fas fa-fw fa-utensils', 55, 1, 0, 0, ''),('0402', 'Kategori Membership', '', 1, 2, 1, 0, '/membership/category'),('0401', 'Paket Membership', '', 2, 2, 1, 0, '/membership'),('04', 'Membership', 'fas fa-fw fa-id-card', 44, 1, 1, 0, ''),('0303', 'Data Trainer', '', 3, 2, 1, 0, '/trainer'),('0301', 'Kelas', '', 1, 2, 1, 0, '/jadwal'),('03', 'Jadwal', 'fas fa-fw fa-calendar-alt', 33, 1, 1, 0, ''),('02', 'Customers', 'fas fa-fw fa-users', 22, 1, 1, 0, '/customer'),('01', 'Cabang', 'fas fa-fw fa-map-marked-alt', 11, 1, 1, 0, '/cabang'),('00', 'Dashboard', 'fas fa-tachometer-alt', 0, 1, 1, 1, '/dashboard'),('09', 'Profil Member', 'fas fa-fw fa-user', 99, 1, 1, 0, '/customer/profil'),('10', 'Update Password', 'fas fa-fw fa-lock', 101, 1, 1, 0, '/customer/password'),('11', 'Visitors', 'fas fa-fw fa-users', 102, 1, 1, 0, ''),('1101', 'Member', NULL, 1021, 2, 1, 0, '/visitors/member'),('1102', 'Non Member', NULL, 1022, 2, 1, 0, '/visitors/nonmember'),('0302', 'Boxing / Muaythai', NULL, 2, 2, 1, 0, '/boxing'),('0601', 'Transaksi Membership', NULL, 1, 2, 1, NULL, '/report/trans_membership'),('0602', 'Visitor Nonmember', NULL, 2, 2, 1, NULL, '/report/umumvisit');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`nonmember_visit` WRITE;
DELETE FROM `nolimit`.`nonmember_visit`;
INSERT INTO `nolimit`.`nonmember_visit` (`idx`,`nama`,`cabang`,`locker`,`handuk`,`user`,`created_at`,`updated_at`,`deleted_at`,`nominal`,`payment_method`,`paket_id`) VALUES (8, 'Barjo', 'NL02', '10', 'ya', 'sadmin', '2025-01-09 08:02:50', NULL, NULL, 75000, 'Qris', 'MBS1024001');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`trainer` WRITE;
DELETE FROM `nolimit`.`trainer`;
INSERT INTO `nolimit`.`trainer` (`id`,`kdcab`,`jenis`,`nama`,`alamat`,`hp`,`foto`,`created_at`,`updated_at`,`deleted_at`) VALUES ('TRN0001', 'CAB01', 'personal trainer', 'ABI CUMI', 'Semarang', '08112345678', 'TRN0001.jpg', '2024-08-06 17:52:19', '2024-12-21 21:45:15', NULL),('TRN0002', 'CAB01', 'personal trainer', 'ADRIAN', 'Ungaran', '083838388', 'TRN0002.jpg', '2024-08-06 17:56:13', '2024-12-21 21:45:00', NULL),('TRN0003', 'CAB01', 'personal trainer', 'coba', 'semarang', '099999', 'user.png', '2024-08-07 20:57:49', '2024-08-07 20:58:00', '2024-08-07 20:58:00'),('TRN0004', 'CAB01', 'personal trainer', 'ANTO', 'Madagascar', '08112345678', 'TRN0004.jpg', '2024-08-09 15:33:50', '2024-12-21 21:52:38', NULL),('TRN0005', 'CAB02', 'class trainer', 'Don Juan', 'Jl. Gerbang Merdeka No. 101', '081345123455', 'user.png', '2024-11-03 17:03:14', '2024-11-03 17:13:41', NULL),('TRN0006', 'CAB01', 'coach boxing / muaithai', 'Rofiq', 'Semarang', '0888', 'TRN0006.jpg', '2024-12-25 20:26:12', '2024-12-25 20:26:34', '2024-12-25 20:26:34'),('TRN0007', 'CAB01', 'coach boxing / muaithai', 'Rofiq', 'Semarang', '088999992', 'TRN0007.jpg', '2024-12-25 20:27:06', '2024-12-25 20:32:04', NULL),('TRN0008', 'CAB02', 'personal trainer', 'Fauzan', 'Semarang', '08899999', 'TRN0008.jpg', '2024-12-26 10:21:21', '2024-12-26 10:21:21', NULL),('TRN0009', 'CAB01', 'coach boxing / muaithai', 'adrian john', 'Semarang', '0888', 'TRN0009.jpg', '2024-12-26 13:50:40', '2024-12-26 13:50:40', NULL),('TRN0010', 'CAB02', 'coach boxing / muaithai', 'winardi', 'semarang', '08888', 'TRN0010.jpg', '2024-12-26 13:51:06', '2024-12-26 13:51:06', NULL),('TRN0011', 'NL01', 'coach boxing / muaithai', 'Regina', 'Semarang', '+6293883773773', 'TRN0011.jpg', '2025-01-04 21:07:51', '2025-01-04 21:07:51', NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`user` WRITE;
DELETE FROM `nolimit`.`user`;
INSERT INTO `nolimit`.`user` (`UserID`,`Password`,`Nama`,`UserGroup`,`LastActivity`,`LastIP`,`CurrentActivity`,`CurrentIP`,`CreatedDate`,`CreatedBy`,`Ket`,`kdcab`,`token`,`token_created_at`) VALUES ('sadmin', 0x243279243130246361307070353579496F5161376B7450615532306E4F6C417051697432646D48616C516B476C614C3162582F5A5942366B2F625A4F, 'Developers', 'SA', NULL, NULL, NULL, NULL, '2024-05-25 05:50:56', 'sadmin', 'active', '%', '', '0000-00-00 00:00:00'),('nolimits', 0x243279243130246B6F6D7764623158494F7659707338786C5837494B755735456D697A3554673568542E2F6139564D69785941414B75674D31794253, 'Adm Enrico', 'AD', NULL, NULL, NULL, NULL, '2024-11-16 00:00:00', 'sadmin', 'active', '%', '', '0000-00-00 00:00:00'),('arifsavutage@gmail.com', 0x2432792431302430734475566450384D677272584B32546F6F7666674F6E303473384A536779456D65754E65354E457A66465030444F786E6C362F61, 'wuhu waha', 'MS', NULL, NULL, NULL, NULL, '2024-12-18 17:00:43', 'nolimits', 'Membership', 'NL01', '', '0000-00-00 00:00:00'),('pekunden', 0x243279243130246361307070353579496F5161376B7450615532306E4F6C417051697432646D48616C516B476C614C3162582F5A5942366B2F625A4F, 'OP Pekunden', 'OP', NULL, NULL, NULL, NULL, '2024-12-10 10:29:13', 'nolimits', 'active', 'NL02', '0', '2024-12-10 10:30:05'),('arifokbgt@gmail.com', 0x2432792431302475763937794A4C645652534E3149586D6B2E6568522E7234737957794474554B70304757555350635170447A4662497A5167304847, 'Fayyadh Ammar Adiatma', 'MS', NULL, NULL, NULL, NULL, '2024-12-06 10:57:23', 'nolimits', 'Membership', 'NL02', '', '0000-00-00 00:00:00'),('juniararifwicaksono@gmail.com', 0x243279243130243148697761386253514A452F4576646B4869554D4665396D786C57357676616848644A7276646C75646D305135776B6756494D2E75, 'Juniar Arif Wicaksono', 'MS', NULL, NULL, NULL, NULL, '2024-12-06 10:56:27', 'nolimits', 'Membership', 'NL01', '', '0000-00-00 00:00:00');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`user_group` WRITE;
DELETE FROM `nolimit`.`user_group`;
INSERT INTO `nolimit`.`user_group` (`groupid`,`nama`,`urut`,`dashboard_path`,`crud`,`created_at`,`updated_at`,`deleted_at`) VALUES ('AD', 'Admin', 4, '/modules/dashboard/admin', 'C,R,U,D', '2024-11-16 13:24:59', NULL, NULL),('MS', 'Membership', 3, '/modules/dashboard/member', 'C,R,U', '2024-05-25 05:46:16', NULL, NULL),('OP', 'Operator', 2, '/modules/dashboard/admin', 'C,R,U', '2024-05-25 05:44:36', NULL, NULL),('SA', 'Super Admin', 1, '/modules/dashboard/admin', 'C,R,U,D', '2024-05-25 05:43:43', NULL, NULL);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `nolimit`.`usermenu` WRITE;
DELETE FROM `nolimit`.`usermenu`;
INSERT INTO `nolimit`.`usermenu` (`menuid`,`userid`) VALUES ('01', 'AD'),('01', 'SA'),('02', 'AD'),('02', 'SA'),('03', 'SA'),('0301', 'AD'),('0301', 'SA'),('0302', 'AD'),('0302', 'SA'),('0303', 'AD'),('0303', 'SA'),('04', 'AD'),('04', 'SA'),('0401', 'AD'),('0401', 'SA'),('0402', 'AD'),('0402', 'SA'),('05', 'AD'),('05', 'SA'),('0501', 'AD'),('0501', 'SA'),('0502', 'AD'),('0502', 'SA'),('06', 'AD'),('06', 'SA'),('07', 'AD'),('07', 'SA'),('0701', 'AD'),('0701', 'SA'),('0702', 'AD'),('0702', 'SA'),('08', 'AD'),('08', 'SA'),('0801', 'AD'),('0801', 'SA'),('0802', 'AD'),('0802', 'SA'),('0803', 'AD'),('0803', 'SA'),('0804', 'AD'),('0804', 'SA'),('09', 'MS'),('10', 'MS'),('11', 'AD'),('1101', 'AD'),('1102', 'AD');
UNLOCK TABLES;
COMMIT;
