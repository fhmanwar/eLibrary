-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for elibrary
CREATE DATABASE IF NOT EXISTS `elibrary` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `elibrary`;

-- Dumping structure for table elibrary.anggota
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `status_anggota` enum('Active','Non-Active','','') CHARACTER SET utf8 NOT NULL,
  `nama_anggota` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tlp` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.anggota: ~2 rows (approximately)
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`id_anggota`, `status_anggota`, `nama_anggota`, `tlp`, `tanggal`) VALUES
	(2, 'Active', 'picollococo', '87897894654213', '2019-03-18 00:03:31'),
	(3, 'Active', 'miasda', '654564', '2019-03-18 00:07:30');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table elibrary.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `serve_for` enum('Available','Sold Out') DEFAULT NULL,
  `kode_buku` varchar(50) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `status` enum('Publish','Not_Publish','Missing','') DEFAULT NULL,
  `ringkasan` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `jml_buku` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.buku: ~8 rows (approximately)
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`id_buku`, `id_jenis`, `judul`, `penulis`, `subjek`, `serve_for`, `kode_buku`, `penerbit`, `tahun_terbit`, `status`, `ringkasan`, `image`, `jml_buku`, `tanggal`) VALUES
	(5, 3, 'Ilmu Pengetahuan Sosial', 'Nur Wahyu Rochmadi', 'Sekolah Menengah Kejuruan', 'Available', 'IPSJD1', 'Buku Sekolah Elektronik (BSE)', '2004', 'Publish', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'ips.jpg', 20, '2019-05-17 01:30:41'),
	(6, 3, 'Dasar Kewirausahaan', 'Ir. Hendro', '', 'Available', '', '', '0000', 'Publish', '  ', '20170212035154.jpg', 6, '2019-05-17 20:52:18'),
	(7, 3, 'PHP Modul', 'Teguh Wahyono', '', 'Available', '', '', '0000', 'Publish', '  ', '20170212145310.jpg', 5, '2019-05-17 20:52:21'),
	(8, 3, 'Pengantar Teknologi Informasi', 'Eddy Sutanta', '', 'Available', '', '', '0000', 'Publish', '  ', '20170209044244.jpg', 34, '2019-05-17 20:52:26'),
	(9, 3, 'Kamus Istilah Internet', 'wang cun', '', 'Available', '', '', '0000', 'Publish', '  ', '20170212080423.jpg', 34, '2019-05-17 20:52:31'),
	(10, 3, 'Kamus Matematika', 'ario', '', 'Available', '', '', '0000', 'Publish', '  ', '20170207102926.jpg', 12, '2019-05-17 20:52:34'),
	(11, 3, 'E-Learning', 'mario', '', 'Available', '', '', '0000', 'Publish', '  ', '20170209050821.jpg', 55, '2019-05-17 20:52:36'),
	(12, 3, 'Algoritma C++', 'niawarti', '', 'Available', '', '', '0000', 'Publish', '  ', '20170209045014.jpg', 54, '2019-05-17 20:52:42');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for table elibrary.file
CREATE TABLE IF NOT EXISTS `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `judul_file` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `keterangan` text,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.file: ~2 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id_file`, `id_buku`, `judul_file`, `nama_file`, `keterangan`, `urutan`, `tanggal`) VALUES
	(34, 5, 'bab 3', 'agilinilucu.docx', 'qweasd', 2, '2019-03-25 00:44:30'),
	(35, 5, 'bab 1', 'Tata_Tertib_Kos_Ibu_Said.pdf', 'asdasd', 1, '2019-03-29 23:58:24');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table elibrary.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis` varchar(20) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `keterangan` mediumtext,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_jenis` (`kode_jenis`),
  UNIQUE KEY `nama_jenis` (`nama_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`id`, `kode_jenis`, `nama_jenis`, `keterangan`, `urutan`, `tanggal`) VALUES
	(3, 'I01', 'Ilmu sosial', '', 1, '2019-03-23 01:44:32'),
	(4, 'bio', 'buku biologi', '  buku ini tentang biologi dalam tumbuhan dan hewan\r\njika ada tambahan, kemungkinan tentang kamasutra', 2, '2019-03-20 00:46:05');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

-- Dumping structure for table elibrary.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `keterangan` text CHARACTER SET utf8 NOT NULL,
  `status_kembali` enum('Belum','Sudah','Hilang','') CHARACTER SET utf8 NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.peminjaman: ~2 rows (approximately)
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `id_anggota`, `id_user`, `tanggal_pinjam`, `tanggal_kembali`, `keterangan`, `status_kembali`, `tanggal`) VALUES
	(2, 7, 2, 4, '2019-04-27', '2019-05-11', 'asdweqwe', 'Belum', '2019-04-01 18:23:58'),
	(5, 7, 4, 4, '2019-04-01', '2019-05-02', 'asdweqwe', 'Belum', '2019-04-01 19:45:27');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table elibrary.tbl_category
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `Category_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_name` varchar(20) NOT NULL,
  `Category_image` text NOT NULL,
  PRIMARY KEY (`Category_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_category: 8 rows
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` (`Category_ID`, `Category_name`, `Category_image`) VALUES
	(1, 'Computer', 'upload/images/1843-2015-07-09.png'),
	(2, 'Smartphone', 'upload/images/3025-2015-07-09.png'),
	(3, 'Camera', 'upload/images/7089-2015-07-09.png'),
	(4, 'Clothes', 'upload/images/9350-2015-07-09.png'),
	(5, 'Other', 'upload/images/6260-2015-07-09.png'),
	(7, 'Music', 'upload/images/8666-2015-07-09.png'),
	(8, 'Sports', 'upload/images/5354-2015-07-09.png'),
	(9, 'Cars', 'upload/images/7789-2015-07-09.png');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;

-- Dumping structure for table elibrary.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `Menu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_name` varchar(50) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Serve_for` varchar(45) NOT NULL,
  `Menu_image` text NOT NULL,
  `Description` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Menu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_menu: 23 rows
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` (`Menu_ID`, `Menu_name`, `Category_ID`, `Price`, `Serve_for`, `Menu_image`, `Description`, `Quantity`) VALUES
	(1, 'Sample 1', 3, 250, 'Available', 'upload/images/7833-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 20),
	(2, 'Sample 2', 3, 450, 'Available', 'upload/images/3013-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 55),
	(3, 'Sample 3', 3, 300, 'Available', 'upload/images/1027-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 80),
	(4, 'Sample 4', 3, 600, 'Available', 'upload/images/4458-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 10),
	(5, 'Sample 5', 3, 540, 'Available', 'upload/images/1566-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 15),
	(6, 'Sample 1', 4, 25, 'Available', 'upload/images/1281-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 17),
	(7, 'Sample 2', 4, 20, 'Available', 'upload/images/7383-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 40),
	(8, 'Sample 3', 4, 28, 'Available', 'upload/images/3531-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 45),
	(9, 'Sample 4', 4, 15, 'Available', 'upload/images/3734-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 75),
	(10, 'Sample 1', 1, 500, 'Available', 'upload/images/6577-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 20),
	(11, 'Sample 2', 1, 560, 'Available', 'upload/images/3087-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 65),
	(12, 'Sample 3', 1, 350, 'Available', 'upload/images/2988-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 22),
	(13, 'Sample 4', 1, 750, 'Available', 'upload/images/5981-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 25),
	(14, 'Sample 1', 2, 300, 'Available', 'upload/images/4843-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 9),
	(15, 'Sample 2', 2, 280, 'Available', 'upload/images/0510-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 30),
	(16, 'Sample 3', 2, 450, 'Available', 'upload/images/9066-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 17),
	(17, 'Sample 4', 2, 250, 'Available', 'upload/images/9409-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 6),
	(18, 'Sample 5', 2, 500, 'Available', 'upload/images/8119-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 7),
	(19, 'Sample 6', 2, 380, 'Available', 'upload/images/8611-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 50),
	(20, 'Sample 1', 5, 30, 'Available', 'upload/images/2414-2015-02-11.jpg', 'This is just sample menu, go to admin page and add your own menu.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\n\r\n\r\n', 8),
	(21, 'Sample 2', 5, 18, 'Available', 'upload/images/3652-2015-02-11.jpg', '<p>This is just sample menu, go to admin page and add your own menu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n', 7),
	(22, 'Sample 3', 5, 65, 'Available', 'upload/images/7534-2015-02-11.jpg', '<p>This is just sample menu, go to admin page and add your own menu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n', 8),
	(23, 'Sample 4', 5, 9, 'Available', 'upload/images/8044-2015-02-11.jpg', '<p>This is just sample menu, go to admin page and add your own menu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n', 10);
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;

-- Dumping structure for table elibrary.tbl_reservation
CREATE TABLE IF NOT EXISTS `tbl_reservation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `Kota` varchar(50) NOT NULL,
  `Provinsi` varchar(50) NOT NULL,
  `Number_of_people` varchar(50) NOT NULL,
  `Date_n_Time` datetime NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Order_list` text NOT NULL,
  `Status` char(1) NOT NULL DEFAULT '0',
  `Comment` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_reservation: 0 rows
/*!40000 ALTER TABLE `tbl_reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reservation` ENABLE KEYS */;

-- Dumping structure for table elibrary.tbl_setting
CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `Variable` varchar(20) NOT NULL,
  `Value` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_setting: 2 rows
/*!40000 ALTER TABLE `tbl_setting` DISABLE KEYS */;
INSERT INTO `tbl_setting` (`Variable`, `Value`) VALUES
	('Tax', '0'),
	('Currency', 'USD');
/*!40000 ALTER TABLE `tbl_setting` ENABLE KEYS */;

-- Dumping structure for table elibrary.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `akses_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_user: 1 rows
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id`, `id_anggota`, `username`, `password`, `email`, `nama`, `akses_level`) VALUES
	(1, 0, 'admin', 'a74ac0a61316e8e74256de730cd32a78eac4653f10b485cbb452612367b61fcf', 'developer.solodroid@gmail.com', NULL, NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

-- Dumping structure for table elibrary.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

-- Dumping data for table elibrary.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
	(1, 'Mike', 'Dalisay', 'mike@example.com', '0999999999', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$AUBptrm9sQF696zr8Hv31On3x4wqnTihdCLocZmGLbiDvyLpyokL.', 'Admin', '', 1, '2014-10-29 17:31:09', '2016-06-13 18:17:47'),
	(22, 'jono', 'jhon', 'jon@mail.net', '1235345134', 'Manila', '$2y$10$bjHJiqOa9HA/XWcPdwQ3gu2Iv/tY66sd6P/Q.EymhsPoYlXB5TSSa', 'Customer', 'm0q46Aq3z3hLNXTswzPZ97XZuvfESx3L', 1, '2019-05-18 22:30:42', '2019-05-19 13:18:33'),
	(23, 'admin', '-', 'admin@admin.com', '9331868359', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$5cdLNILxv6w/X3.o4WgmDObwV3UrFI81KWUn9u3gA0O/eiWF4r35C', 'Admin', '0ybHhBcrMdPzqwR8KGaG6xNizp7zY7t8', 1, '2019-05-19 13:14:38', '2019-05-19 13:19:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table elibrary.usulan
CREATE TABLE IF NOT EXISTS `usulan` (
  `id_usulan` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `keterangan` text,
  `nama_pengusul` varchar(255) NOT NULL,
  `email_pengusul` varchar(255) NOT NULL,
  `ip_add` varchar(50) NOT NULL,
  `status_usulan` varchar(20) NOT NULL,
  `tanggal_usulan` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usulan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.usulan: ~3 rows (approximately)
/*!40000 ALTER TABLE `usulan` DISABLE KEYS */;
INSERT INTO `usulan` (`id_usulan`, `judul`, `penulis`, `penerbit`, `keterangan`, `nama_pengusul`, `email_pengusul`, `ip_add`, `status_usulan`, `tanggal_usulan`, `tanggal`) VALUES
	(1, 'asdasdasdqweqwe', 'asdasdasd', 'asdasdadw', '    ', 'asdasdd', 'asdasd@afasd.etr', '::1', 'Diterima', '2019-03-30 15:37:28', '2019-03-30 23:03:08'),
	(2, 'Cerita tentang Midun', 'Marah Rusli', 'PT Andi Offset', NULL, 'Andoyo', 'wikwik@gmail.net', '::1', 'Baru', '2019-03-30 15:42:04', '2019-03-30 21:42:04'),
	(3, 'Dragon Ball Mencari mangsa', 'Andomir', 'Gramedia', 'Dragon Ball Jalan Jalan  ', 'rayyanwe', 'rayanwe@asd.net', '::1', 'Baru', '2019-03-30 17:04:15', '2019-03-30 23:04:15');
/*!40000 ALTER TABLE `usulan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
