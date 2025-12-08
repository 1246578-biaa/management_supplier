-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 03:54 PM
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
-- Database: `management_supplier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'admin',
  `id_toko` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `role`, `id_toko`) VALUES
('1', 'admin@gmail.com', '12345', 'admin', 'TOK001'),
('2', 'owner123@gmail.com', '123456', 'owner', 'TOK001');

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
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_supplier`, `nama_barang`, `stok`, `harga`, `gambar`) VALUES
('BA001', 'SUP001', 'Tipex', 12, 3500.00, '1764713633_tipex.jpg'),
('BA002', 'SUP001', 'Cleantex', 18, 10000.00, '1764713738_cleantex.jpg'),
('BA003', 'SUP002', 'Snowman V1', -5, 2000.00, 'snowman.jpg'),
('BA004', 'SUP003', 'Buku Tulis 38', 10, 3000.00, '1764713763_buku tulis38.jpg'),
('BA005', 'SUP003', 'Kertas HVS A4', 2500, 500.00, '1764713775_kertasHVSA4.jpg'),
('BA006', 'SUP003', 'HVS F4 COPY', 2500, 500.00, '1764712374_hvsf4copy.jpg'),
('BA007', 'SUP003', 'BUKU TULIS SIDU 32', -6, 2000.00, '1764712187_sidu32.jpg'),
('BA008', 'SUP003', 'BUKU TULIS SIDU 38', 10, 3000.00, '1764712226_buku tulis38.jpg'),
('BA009', 'SUP003', 'BUKU TULIS SIDU 58', 10, 5000.00, '1764712242_sidu58.jpg'),
('BA010', 'SUP003', 'BUKU TULIS VISION 32', 10, 3000.00, '1764713007_vision32.jpg'),
('BA011', 'SUP003', 'BUKU TULIS VISION 38', 20, 4000.00, '1764714255_buku tulis38.jpg'),
('BA012', 'SUP003', 'BUKU TULIS VISION 58', 10, 5000.00, '1764713791_vision58.jpg'),
('BA013', 'SUP003', 'BUKU TULIS BIGBOSS 36', 10, 3000.00, '1764713932_bigboss36.jpg'),
('BA014', 'SUP002', 'PENCIL 2B JOYKO', 12, 1500.00, '1764714164_joyko.jpg'),
('BA015', 'SUP002', 'PENCIL 2B STEADLER', 12, 3000.00, '1764713842_steadler.jpg'),
('BA016', 'SUP002', 'PENCIL 2B FABERCASTLE', 12, 4000.00, '1764714224_fabercastle.jpg'),
('BA017', 'SUP002', 'PENCIL 2B LYRA', 12, 2500.00, '1764713913_lyra.jpg'),
('BA018', 'SUP002', 'Snowman V2', 12, 2000.00, '1764713818_snowmanv2.jpg'),
('BA019', 'SUP002', 'Snowman V3', 12, 2500.00, '1764713858_snowmanv3.jpg'),
('BA020', 'SUP002', 'Snowman V4', 12, 2000.00, '1764713876_snowmanv4.jpg'),
('BA021', 'SUP002', 'Snowman V5', 12, 2500.00, '1764713890_snowmanv5.jpg');

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
('DP001', 'PSN001', 'BA001', 5),
('DP002', 'PSN001', 'BA003', 3),
('DP003', 'PSN002', 'BA002', 2),
('DP004', 'PSN002', 'BA004', 4),
('DP005', 'PSN003', 'BA005', 10),
('DP006', 'PSN003', 'BA001', 1),
('DP007', 'PSN004', 'BA001', 4),
('DP008', 'PSN004', 'BA003', 2),
('DP018', 'PSN005', 'BA001', 1),
('DP020', 'PSN007', 'BA002', 4),
('DP023', 'PSN010', 'BA016', 2);

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
-- Table structure for table `log_return`
--

CREATE TABLE `log_return` (
  `id_log` varchar(11) NOT NULL,
  `id_return` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('tidak_layak') NOT NULL DEFAULT 'tidak_layak',
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_return`
--

INSERT INTO `log_return` (`id_log`, `id_return`, `id_barang`, `jumlah`, `status`, `tanggal`) VALUES
('LOG001', 'RET003', 'BA003', 7, 'tidak_layak', '2025-12-03 00:39:21'),
('LOG002', 'RET004', 'BA003', 10, 'tidak_layak', '2025-12-03 02:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_toko` varchar(11) DEFAULT NULL,
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
('PSN005', '2025-11-20', 'Selesai Dikirim', 'TOK001', 'SUP001'),
('PSN006', '2025-12-01', 'Selesai Dikirim', 'TOK001', 'SUP001'),
('PSN007', '2025-12-02', 'Diambil', 'TOK001', 'SUP002'),
('PSN008', '2025-12-01', 'Diambil', 'TOK001', 'SUP002'),
('PSN010', '2025-12-06', 'Diambil', 'TOK001', 'SUP002');

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
('RET002', 'SUP003', 'BA004', 2, 'rusak', '2025-11-14'),
('RET003', 'SUP003', 'BA003', 7, 'TINTA BOCOR', '2025-11-30'),
('RET004', 'SUP003', 'BA003', 10, 'TINTA BOCOR', '2025-12-04');

--
-- Triggers `return_to`
--
DELIMITER $$
CREATE TRIGGER `after_return_insert` AFTER INSERT ON `return_to` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(10);

    -- Generate id_log
    SELECT IFNULL(MAX(CAST(SUBSTRING(id_log,4) AS UNSIGNED)),0) INTO last_id FROM log_return;
    SET new_id = CONCAT('LOG', LPAD(last_id + 1, 3, '0'));

    -- Insert ke log_return
    INSERT INTO log_return (id_log, id_return, id_barang, jumlah, status, tanggal)
    VALUES (new_id, NEW.id_return, NEW.id_barang, NEW.jumlah, 'tidak_layak', NOW());

    -- Kurangi stok master barang
    UPDATE barang
    SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
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
  `tipe_supplier` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `nama_alias`, `no_telp`, `alamat`, `tipe_supplier`) VALUES
('SUP001', 'PT SURYA CITRA UTAMA MANDIRI', 'Surya Citra', '(0321)396169', 'Sooko, Mojokerto', 'Mengirim'),
('SUP002', 'CV PUTRA ABADI', 'Putra.A', '081282532302', 'Pakelan, Kediri', 'Diambil'),
('SUP003', 'CV SBS', 'SBS', '081231561264', 'Madiun, Madiun', 'Datang_langsung');

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
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `fk_admin_toko` (`id_toko`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_barang_supplier` (`id_supplier`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_pesanan` (`id_pesanan`),
  ADD KEY `fk_detail_pesanan_barang` (`id_barang`);

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
-- Indexes for table `log_return`
--
ALTER TABLE `log_return`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `id_return` (`id_return`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

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
  ADD KEY `return_to_ibfk_1` (`id_supplier`),
  ADD KEY `return_to_ibfk_2` (`id_barang`);

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
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_toko` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `display_on`
--
ALTER TABLE `display_on`
  ADD CONSTRAINT `display_on_ibfk_1` FOREIGN KEY (`id_etalase`) REFERENCES `etalase` (`id_etalase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_display_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etalase`
--
ALTER TABLE `etalase`
  ADD CONSTRAINT `etalase_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_return`
--
ALTER TABLE `log_return`
  ADD CONSTRAINT `log_return_ibfk_1` FOREIGN KEY (`id_return`) REFERENCES `return_to` (`id_return`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_return_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

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
