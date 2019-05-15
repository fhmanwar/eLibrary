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
  `id_user` int(11) NOT NULL,
  `status_anggota` enum('Active','Non-Active','','') CHARACTER SET utf8 NOT NULL,
  `nama_anggota` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tlp` varchar(50) CHARACTER SET utf8 NOT NULL,
  `instansi` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.anggota: ~2 rows (approximately)
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`id_anggota`, `id_user`, `status_anggota`, `nama_anggota`, `email`, `tlp`, `instansi`, `username`, `password`, `tanggal`) VALUES
	(2, 4, 'Active', 'picollococo', 'pico@gmas.com', '87897894654213', '   wakwaw ', 'pco', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2019-03-18 00:03:31'),
	(3, 4, 'Active', 'miasda', 'nmasd@gmail.com', '654564', 'uweeesss', 'mimi', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2019-03-18 00:07:30');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table elibrary.bahasa
CREATE TABLE IF NOT EXISTS `bahasa` (
  `id_bahasa` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bahasa` varchar(3) CHARACTER SET utf8 NOT NULL,
  `nama_bahasa` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` text,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bahasa`),
  UNIQUE KEY `kode_bhs` (`kode_bahasa`),
  UNIQUE KEY `nama_bhs` (`nama_bahasa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.bahasa: ~1 rows (approximately)
/*!40000 ALTER TABLE `bahasa` DISABLE KEYS */;
INSERT INTO `bahasa` (`id_bahasa`, `kode_bahasa`, `nama_bahasa`, `keterangan`, `urutan`, `tanggal`) VALUES
	(1, 'K01', 'Bahasa Kalbu', '  ', 1, '2019-03-23 01:44:01');
/*!40000 ALTER TABLE `bahasa` ENABLE KEYS */;

-- Dumping structure for table elibrary.berita
CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `slug_berita` varchar(255) CHARACTER SET utf8 NOT NULL,
  `judul_berita` varchar(255) CHARACTER SET utf8 NOT NULL,
  `isi` text CHARACTER SET utf8 NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status_berita` enum('Publish','Draft','','') CHARACTER SET utf8 NOT NULL,
  `jenis_berita` enum('Berita','Slide','','') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berita`),
  UNIQUE KEY `judul_berita` (`judul_berita`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.berita: ~5 rows (approximately)
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` (`id_berita`, `id_user`, `slug_berita`, `judul_berita`, `isi`, `gambar`, `status_berita`, `jenis_berita`, `tanggal`) VALUES
	(1, 4, 'iwak-e-nyebur-sumur-tandas', 'iwak e nyebur sumur tandas', '<p>asdasdasd asd</p>', 'kandang-ternak-kenari-siste5.jpg', 'Publish', 'Berita', '2019-03-25 20:24:14'),
	(4, 4, 'hard-work', 'Hard Work', '<p>Hard work is but one of the ways you can achieve your goals. For those of us who aren&rsquo;t inordinately&nbsp;<a href="https://www.primermagazine.com/2011/learn/the-only-4-reasons-why-your-peers-are-more-successful-than-you">wealthy, smart, or lucky</a>, it&rsquo;s the only way. While each person&rsquo;s path to success will be unique, the anatomy of the hard work that they do often looks very similar.</p>', 'b1.jpg', 'Publish', 'Slide', '2019-03-25 20:31:57'),
	(5, 4, 'study', 'Study', '<p><span class="ind">The devotion of time and attention to gaining knowledge of an academic subject, especially by means of books.</span></p>', 'b2.jpg', 'Publish', 'Slide', '2019-03-25 20:30:29'),
	(6, 4, 'class', 'Class', '<p>Learning is the process of acquiring new, or modifying existing, <span style="text-decoration: underline;"><a title="Knowledge" href="https://en.wikipedia.org/wiki/Knowledge">knowledge</a></span>, <span style="text-decoration: underline;"><a title="Behavior" href="https://en.wikipedia.org/wiki/Behavior">behaviors</a>, </span><a title="Skill" href="https://en.wikipedia.org/wiki/Skill">skills</a>, <a class="mw-redirect" title="Value (personal and cultural)" href="https://en.wikipedia.org/wiki/Value_(personal_and_cultural)">values</a>, or <a title="Preference" href="https://en.wikipedia.org/wiki/Preference">preferences</a>.<sup id="cite_ref-1" class="reference"></sup></p>', 'b3.jpg', 'Publish', 'Slide', '2019-03-25 20:34:21'),
	(7, 4, 'sayur-kol', 'Sayur Kol', '<p>Makan daging teman dengan sayur kol</p>', 'Sabyan_Gambus_Nissa_Sabyan_1548167665.jpeg', 'Publish', 'Berita', '2019-03-25 23:41:34');
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;

-- Dumping structure for table elibrary.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_bahasa` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `penulis_buku` varchar(255) NOT NULL,
  `subjek_buku` varchar(255) DEFAULT NULL,
  `letak_buku` varchar(50) DEFAULT NULL,
  `kode_buku` varchar(50) DEFAULT NULL,
  `kolasi` int(11) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `no_seri` varchar(50) DEFAULT NULL,
  `status_buku` enum('Publish','Not_Publish','Missing','') DEFAULT NULL,
  `ringkasan` mediumtext,
  `cover_buku` varchar(255) DEFAULT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  `tanggal_entri` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.buku: ~8 rows (approximately)
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`id_buku`, `id_user`, `id_jenis`, `id_bahasa`, `judul_buku`, `penulis_buku`, `subjek_buku`, `letak_buku`, `kode_buku`, `kolasi`, `penerbit`, `tahun_terbit`, `no_seri`, `status_buku`, `ringkasan`, `cover_buku`, `jumlah_buku`, `tanggal_entri`, `tanggal`) VALUES
	(5, 4, 3, 1, 'Ilmu Pengetahuan Sosial', 'Nur Wahyu Rochmadi', 'Sekolah Menengah Kejuruan', '', 'IPSJD1', 11, 'Buku Sekolah Elektronik (BSE)', '2004', '123xr3', 'Publish', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'ips.jpg', 20, '2019-03-22 20:14:19', '2019-03-28 15:58:55'),
	(6, 4, 3, 1, 'Dasar Kewirausahaan', 'Ir. Hendro', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170212035154.jpg', 0, '2019-03-23 14:33:09', '2019-03-23 20:33:09'),
	(7, 4, 3, 1, 'PHP Modul', 'Teguh Wahyono', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170212145310.jpg', 0, '2019-03-25 18:10:31', '2019-03-26 00:10:31'),
	(8, 4, 3, 1, 'Pengantar Teknologi Informasi', 'Eddy Sutanta', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170209044244.jpg', 0, '2019-03-25 18:11:29', '2019-03-26 00:11:29'),
	(9, 4, 3, 1, 'Kamus Istilah Internet', 'wang cun', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170212080423.jpg', 0, '2019-03-25 18:12:13', '2019-03-26 00:12:13'),
	(10, 4, 3, 1, 'Kamus Matematika', 'ario', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170207102926.jpg', 0, '2019-03-25 18:12:56', '2019-03-26 00:12:56'),
	(11, 4, 3, 1, 'E-Learning', 'mario', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170209050821.jpg', 0, '2019-03-25 18:13:39', '2019-03-26 00:13:39'),
	(12, 4, 3, 1, 'Algoritma C++', 'niawarti', '', '', '', 0, '', '0000', '', 'Publish', '  ', '20170209045014.jpg', 0, '2019-03-25 18:14:22', '2019-03-26 00:14:22');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for table elibrary.file
CREATE TABLE IF NOT EXISTS `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_file` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `keterangan` text,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table elibrary.file: ~2 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id_file`, `id_buku`, `id_user`, `judul_file`, `nama_file`, `keterangan`, `urutan`, `tanggal`) VALUES
	(34, 5, 4, 'bab 3', 'agilinilucu.docx', 'qweasd', 2, '2019-03-25 00:44:30'),
	(35, 5, 4, 'bab 1', 'Tata_Tertib_Kos_Ibu_Said.pdf', 'asdasd', 1, '2019-03-29 23:58:24');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table elibrary.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis` varchar(20) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `keterangan` mediumtext,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jenis`),
  UNIQUE KEY `kode_jenis` (`kode_jenis`),
  UNIQUE KEY `nama_jenis` (`nama_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`id_jenis`, `kode_jenis`, `nama_jenis`, `keterangan`, `urutan`, `tanggal`) VALUES
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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(15) NOT NULL,
  `Password` text NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table elibrary.tbl_user: 1 rows
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`ID`, `Username`, `Password`, `Email`) VALUES
	(1, 'admin', 'a74ac0a61316e8e74256de730cd32a78eac4653f10b485cbb452612367b61fcf', 'developer.solodroid@gmail.com');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

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