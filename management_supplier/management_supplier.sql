-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_supplier2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`) VALUES
('1', 'owner@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `Gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_supplier`, `nama_barang`, `stok`, `harga`, `Gambar`) VALUES
('BA001', 'SUP001', 'Tipex', 12, 40000.00, 'tipex.jpg'),
('BA002', 'SUP001', 'Cleantex', 16, 190000.00, 'cleantex.jpg'),
('BA003', 'SUP002', 'Snowman V1', 12, 20000.00, 'snowman.jpg'),
('BA004', 'SUP003', 'Buku Tulis 38', 10, 30000.00, 'buku tulis38.jpg'),
('BA005', 'SUP003', 'Kertas HVS A4', 2500, 200000.00, 'kertasHVSA4.jpg'),
('BA006', 'SUP003', 'Kertas HVS A4', 2500, 200000.00, 'kertasHVSA4.jpg'),
('BA007', 'SUP003', 'HVS F4 SIDU', 2500, 210000.00, 'hvsf4sidu.jpg'),
('BA008', 'SUP003', 'HVS A4 SIDU', 2500, 190000.00, 'hvsa4sidu.jpg'),
('BA009', 'SUP003', 'HVS F4 COPY', 2500, 190000.00, 'hvsf4copy.jpg'),
('BA010', 'SUP003', 'HVS A4 COPY', 2500, 170000.00, 'hvsa4copy.jpg'),
('BA011', 'SUP003', 'BUKU TULIS SIDU 32', 10, 25000.00, 'sidu32.jpg'),
('BA012', 'SUP003', 'BUKU TULIS SIDU 38', 10, 30000.00, 'sidu38.jpg'),
('BA013', 'SUP003', 'BUKU TULIS SIDU 58', 10, 40000.00, 'sidu58.jpg'),
('BA014', 'SUP003', 'BUKU TULIS VISION 32', 10, 20000.00, 'vision32.jpg'),
('BA015', 'SUP003', 'BUKU TULIS VISION 38', 20, 30000.00, 'vision38.jpg'),
('BA016', 'SUP003', 'BUKU TULIS VISION 58', 10, 40000.00, 'vision58.jpg'),
('BA017', 'SUP003', 'BUKU TULIS BIGBOSS 36', 10, 30000.00, 'bigboss36.jpg'),
('BA018', 'SUP002', 'PENCIL 2B JOYKO', 12, 10000.00, 'joyko.jpg'),
('BA019', 'SUP002', 'PENCIL 2B STEADLER', 12, 35000.00, 'steadler.jpg'),
('BA020', 'SUP002', 'PENCIL 2B FABERCASTLE', 12, 45000.00, 'fabercastle.jpg'),
('BA021', 'SUP002', 'PENCIL 2B LYRA', 12, 30000.00, 'lyra.jpg'),
('BA022', 'SUP002', 'Snowman V1', 12, 20000.00, 'snowmanv1.jpg'),
('BA023', 'SUP002', 'Snowman V2', 12, 20000.00, 'snowmanv2.jpg'),
('BA024', 'SUP002', 'Snowman V3', 12, 25000.00, 'snowmanv3.jpg'),
('BA025', 'SUP002', 'Snowman V4', 12, 20000.00, 'snowmanv4.jpg'),
('BA026', 'SUP002', 'Snowman V5', 12, 30000.00, 'snowmanv5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengiriman`
--

CREATE TABLE `detail_pengiriman` (
  `id_detail_pengiriman` varchar(11) NOT NULL,
  `id_pengiriman` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_pengiriman`
--

INSERT INTO `detail_pengiriman` (`id_detail_pengiriman`, `id_pengiriman`, `id_barang`, `jumlah_barang`) VALUES
('DTP001', 'PNG006', 'BA001', 5),
('DTP002', 'PNG006', 'BA003', 3),
('DTP003', 'PNG007', 'BA005', 10),
('DTP004', 'PNG007', 'BA001', 1),
('DTP005', 'PNG008', 'BA001', 4),
('DTP006', 'PNG008', 'BA003', 2),
('DTP007', 'PNG001', 'BA001', 3),
('DTP008', 'PNG001', 'BA003', 2),
('DTP009', 'PNG002', 'BA001', 5),
('DTP010', 'PNG002', 'BA003', 3),
('DTP011', 'PNG003', 'BA005', 10),
('DTP012', 'PNG003', 'BA001', 1),
('DTP013', 'PNG005', 'BA001', 4),
('DTP014', 'PNG005', 'BA003', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` varchar(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_barang`, `jumlah`) VALUES
('DTL001', 'PSN001', 'BA001', 5),
('DTL002', 'PSN001', 'BA003', 3),
('DTL003', 'PSN002', 'BA002', 2),
('DTL004', 'PSN002', 'BA004', 4),
('DTL005', 'PSN003', 'BA005', 10),
('DTL006', 'PSN003', 'BA001', 1),
('DTL007', 'PSN004', 'BA001', 4),
('DTL008', 'PSN004', 'BA003', 2),
('DTL009', 'PSN005', 'BA002', 6),
('DTL010', 'PSN005', 'BA004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `display_on`
--

CREATE TABLE `display_on` (
  `id_barang` varchar(11) NOT NULL,
  `id_etalase` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `display_on`
--

INSERT INTO `display_on` (`id_barang`, `id_etalase`) VALUES
('BA001', 'ETA004'),
('BA002', 'ETA001'),
('BA003', 'ETA003'),
('BA004', 'ETA002'),
('BA005', 'ETA005');

-- --------------------------------------------------------

--
-- Table structure for table `etalase`
--

CREATE TABLE `etalase` (
  `id_etalase` varchar(11) NOT NULL,
  `nama_etalase` varchar(100) NOT NULL,
  `id_toko` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `etalase`
--

INSERT INTO `etalase` (`id_etalase`, `nama_etalase`, `id_toko`) VALUES
('ETA001', 'Etalase Penghapus', 'TOK001'),
('ETA002', 'Etalase Pembersih', 'TOK001'),
('ETA003', 'Etalase Bolpoint', 'TOK001'),
('ETA004', 'Etalase Buku', 'TOK001'),
('ETA005', 'Etalase Kertas', 'TOK001');

-- --------------------------------------------------------

--
-- Table structure for table `log_stok`
--

CREATE TABLE `log_stok` (
  `id_log` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `perubahan` enum('+','-') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_stok`
--

INSERT INTO `log_stok` (`id_log`, `id_barang`, `perubahan`, `jumlah`, `keterangan`, `tanggal`) VALUES
('', 'BA004', '', 2, 'Retur ke supplier, alasan: rusak', '2025-11-23 13:08:06'),
('1', 'BA001', '', 12, 'Retur ke supplier, alasan: rusak', '2025-11-20 02:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` varchar(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `tgl_pengiriman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pesanan`, `id_supplier`, `tgl_pengiriman`) VALUES
('PNG001', 'PSN006', 'SUP001', '2025-11-22'),
('PNG002', 'PSN001', 'SUP001', '2025-10-10'),
('PNG003', 'PSN003', 'SUP001', '2025-10-12'),
('PNG005', 'PSN004', 'SUP001', '2025-10-15'),
('PNG006', 'PSN001', 'SUP001', '2025-10-10'),
('PNG007', 'PSN003', 'SUP001', '2025-10-12'),
('PNG008', 'PSN004', 'SUP001', '2025-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_toko` varchar(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `tgl_pesanan`, `status`, `id_toko`, `id_supplier`) VALUES
('PSN001', '2025-10-01', 'Dikirim', 'TOK001', 'SUP001'),
('PSN002', '2025-10-02', 'Diambil', 'TOK001', 'SUP002'),
('PSN003', '2025-10-03', 'Dikirim', 'TOK001', 'SUP001'),
('PSN004', '2025-10-05', 'Dikirim', 'TOK001', 'SUP001'),
('PSN005', '2025-10-06', 'Diambil', 'TOK001', 'SUP002'),
('PSN006', '2025-11-13', 'Dikirim', 'TOK001', 'SUP001');

-- --------------------------------------------------------

--
-- Table structure for table `return_to`
--

CREATE TABLE `return_to` (
  `id_return` varchar(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `alasan` varchar(100) DEFAULT NULL,
  `tanggal_return` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `return_to`
--

INSERT INTO `return_to` (`id_return`, `id_supplier`, `id_barang`, `jumlah`, `alasan`, `tanggal_return`) VALUES
('RET001', 'SUP003', 'BA005', 500, 'Kertas rusak', '2025-10-05'),
('RET002', 'SUP003', 'BA004', 2, 'rusak', '2025-11-14');

--
-- Triggers `return_to`
--
DELIMITER $$
CREATE TRIGGER `log_retur` AFTER INSERT ON `return_to` FOR EACH ROW BEGIN
    INSERT INTO log_stok (id_barang, perubahan, jumlah, keterangan)
    VALUES (NEW.id_barang, 'keluar', NEW.jumlah, CONCAT('Retur ke supplier, alasan: ', NEW.alasan));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `nama_alias` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` varchar(150) NOT NULL,
  `tipe_supplier` varchar(50) DEFAULT NULL,
  `jadwal_pengiriman` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `nama_alias`, `no_telp`, `alamat`, `tipe_supplier`, `jadwal_pengiriman`) VALUES
('SUP001', 'PT SURYA CITRA UTAMA MANDIRI', 'Surya Citra', '(0321)396169', 'Sooko, Mojokerto', 'Mengirim', '2025-10-06'),
('SUP002', 'CV PUTRA ABADI', 'Putra.A', '0812-8253-2302', 'Pakelan, Kediri', 'Diambil', '2025-10-08'),
('SUP003', 'CV SBS', 'SBS', '081231561264', 'Madiun, Madiun', 'Datang_langsung', '2025-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` varchar(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `no_telp`, `alamat`) VALUES
('TOK001', 'EL-FATH FOTOCOPY', '081252477384', 'Jl. Veteran No. 51 Nganjuk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_barang_supplier` (`id_supplier`);

--
-- Indexes for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD PRIMARY KEY (`id_detail_pengiriman`),
  ADD UNIQUE KEY `unique_pengiriman_barang` (`id_pengiriman`,`id_barang`),
  ADD KEY `id_pengiriman` (`id_pengiriman`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `display_on`
--
ALTER TABLE `display_on`
  ADD PRIMARY KEY (`id_barang`,`id_etalase`),
  ADD KEY `id_etalase` (`id_etalase`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_etalase_2` (`id_etalase`);

--
-- Indexes for table `etalase`
--
ALTER TABLE `etalase`
  ADD PRIMARY KEY (`id_etalase`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `fk_pengiriman_pesanan` (`id_pesanan`),
  ADD KEY `fk_pengiriman_supplier` (`id_supplier`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `return_to`
--
ALTER TABLE `return_to`
  ADD PRIMARY KEY (`id_return`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `detail_pengiriman`
--
ALTER TABLE `detail_pengiriman`
  ADD CONSTRAINT `detail_pengiriman_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pengiriman_ibfk_3` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pengiriman_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `fk_detail_pengiriman_pengiriman` FOREIGN KEY (`id_pengiriman`) REFERENCES `pengiriman` (`id_pengiriman`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pesanan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `fk_detail_pesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `display_on`
--
ALTER TABLE `display_on`
  ADD CONSTRAINT `fk_display_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etalase`
--
ALTER TABLE `etalase`
  ADD CONSTRAINT `etalase_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD CONSTRAINT `fk_log_stok_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `log_stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `fk_pengiriman_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_to`
--
ALTER TABLE `return_to`
  ADD CONSTRAINT `fk_return_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `fk_return_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `return_to_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `return_to_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
