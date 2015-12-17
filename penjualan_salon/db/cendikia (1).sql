-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2015 at 12:18 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cendikia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbcustomer`
--

CREATE TABLE IF NOT EXISTS `tbcustomer` (
  `cust_kode` varchar(50) NOT NULL,
  `cust_nama` varchar(50) NOT NULL,
  `cust_alamat` text NOT NULL,
  `cust_jk` varchar(10) NOT NULL,
  `cust_tempat` varchar(30) NOT NULL,
  `cust_dob` date NOT NULL,
  `cust_hp` varchar(12) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcustomer`
--

INSERT INTO `tbcustomer` (`cust_kode`, `cust_nama`, `cust_alamat`, `cust_jk`, `cust_tempat`, `cust_dob`, `cust_hp`, `isactive`) VALUES
('PL001', 'Jihan', 'Serang', 'L', 'Serang', '2015-08-04', '089675657654', 1),
('PL002', 'Laras', 'Cilegon', 'L', 'serang', '2015-08-15', '081345651231', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbitem`
--

CREATE TABLE IF NOT EXISTS `tbitem` (
  `item_kode` varchar(12) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_note` text NOT NULL,
  `isavailable` tinyint(1) NOT NULL,
  `harga` decimal(18,2) DEFAULT NULL,
  `item_type` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbitem`
--

INSERT INTO `tbitem` (`item_kode`, `item_name`, `item_note`, `isavailable`, `harga`, `item_type`) VALUES
('111', 'Hair Conditioner', 'di pake setelah nyampo', 1, '20000.00', 'BARANG'),
('112', 'Coloring Hair', 'Coloring Hair', 1, '19000.00', 'BARANG'),
('190', 'krimbat', 'wanita/pria', 1, '900000.00', 'JASA'),
('200', 'warna', 'wanita/pria', 1, '2000.00', 'JASA');

-- --------------------------------------------------------

--
-- Table structure for table `tborder`
--

CREATE TABLE IF NOT EXISTS `tborder` (
  `order_id` varchar(12) NOT NULL,
  `order_date` date NOT NULL,
  `cust_kode` varchar(12) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tborder`
--

INSERT INTO `tborder` (`order_id`, `order_date`, `cust_kode`, `username`) VALUES
('20150816-001', '2015-08-16', 'PL002', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tborderdetail`
--

CREATE TABLE IF NOT EXISTS `tborderdetail` (
  `order_id` varchar(12) NOT NULL,
  `item_kode` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tborderdetail`
--

INSERT INTO `tborderdetail` (`order_id`, `item_kode`, `qty`, `notes`) VALUES
('20150816-001', '112', 10, '-');

--
-- Triggers `tborderdetail`
--
DELIMITER $$
CREATE TRIGGER `tr_delete_stock` BEFORE DELETE ON `tborderdetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty + OLD.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = OLD.item_kode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_stock_add` AFTER INSERT ON `tborderdetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty - NEW.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = NEW.item_kode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_update_stok` AFTER UPDATE ON `tborderdetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty + OLD.qty - NEW.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = OLD.item_kode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbpurchase`
--

CREATE TABLE IF NOT EXISTS `tbpurchase` (
  `purchase_id` varchar(13) NOT NULL,
  `supplier_kode` varchar(12) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpurchase`
--

INSERT INTO `tbpurchase` (`purchase_id`, `supplier_kode`, `purchase_date`, `username`) VALUES
('PP/150816/001', 'SP001', '2015-08-16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbpurchasedetail`
--

CREATE TABLE IF NOT EXISTS `tbpurchasedetail` (
  `purchase_id` varchar(13) NOT NULL,
  `item_kode` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpurchasedetail`
--

INSERT INTO `tbpurchasedetail` (`purchase_id`, `item_kode`, `qty`, `harga`) VALUES
('PP/150816/001', '112', 10, '10000.00');

--
-- Triggers `tbpurchasedetail`
--
DELIMITER $$
CREATE TRIGGER `tr_add_stok1` AFTER INSERT ON `tbpurchasedetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty + NEW.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = NEW.item_kode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_delete_stock1` BEFORE DELETE ON `tbpurchasedetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty - OLD.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = OLD.item_kode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_edit_stok1` BEFORE UPDATE ON `tbpurchasedetail`
 FOR EACH ROW BEGIN
UPDATE tbstok
SET 
	tbstok.qty = tbstok.qty - OLD.qty + NEW.qty,
	tbstok.last_update = now()
WHERE tbstok.item_kode = OLD.item_kode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbstok`
--

CREATE TABLE IF NOT EXISTS `tbstok` (
  `stock_date` date NOT NULL,
  `item_kode` varchar(12) NOT NULL,
  `qty` decimal(18,2) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbstok`
--

INSERT INTO `tbstok` (`stock_date`, `item_kode`, `qty`, `last_update`, `username`) VALUES
('2015-08-14', '112', '50.00', '2015-08-16 10:01:43', 'sarah'),
('2015-08-15', '111', '50.00', '2015-08-16 10:00:39', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbsupplier`
--

CREATE TABLE IF NOT EXISTS `tbsupplier` (
  `supplier_kode` varchar(12) NOT NULL,
  `supplier_nama` varchar(50) NOT NULL,
  `supplier_alamat` text NOT NULL,
  `supplier_hp` varchar(12) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbsupplier`
--

INSERT INTO `tbsupplier` (`supplier_kode`, `supplier_nama`, `supplier_alamat`, `supplier_hp`, `isactive`) VALUES
('SP001', 'Selebrity Collection', 'Jaarta', '21330324', 1),
('SP002', 'Klinik Wajah', 'Serang', '254227243', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE IF NOT EXISTS `tbuser` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userlevel` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`username`, `password`, `userlevel`, `isactive`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
('innaki', 'db3068513687e6d51c977b06a8abc9b9', 1, 0),
('sarah', '9e9d7a08e048e9d604b79460b54969c3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temporder`
--

CREATE TABLE IF NOT EXISTS `temporder` (
  `order_id` varchar(12) NOT NULL,
  `order_date` date NOT NULL,
  `cust_kode` varchar(12) NOT NULL,
  `bayar` decimal(18,2) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temporderdetail`
--

CREATE TABLE IF NOT EXISTS `temporderdetail` (
  `order_id` varchar(12) NOT NULL,
  `item_kode` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  `notes` text NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmppurchase`
--

CREATE TABLE IF NOT EXISTS `tmppurchase` (
  `purchase_id` varchar(13) NOT NULL,
  `supplier_kode` varchar(12) NOT NULL,
  `purchase_date` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmppurchasedetail`
--

CREATE TABLE IF NOT EXISTS `tmppurchasedetail` (
  `purchase_id` varchar(13) NOT NULL,
  `item_kode` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(18,2) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcustomer`
--
ALTER TABLE `tbcustomer`
  ADD PRIMARY KEY (`cust_kode`);

--
-- Indexes for table `tbitem`
--
ALTER TABLE `tbitem`
  ADD PRIMARY KEY (`item_kode`);

--
-- Indexes for table `tborder`
--
ALTER TABLE `tborder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `username` (`username`),
  ADD KEY `cust_kode` (`cust_kode`);

--
-- Indexes for table `tborderdetail`
--
ALTER TABLE `tborderdetail`
  ADD PRIMARY KEY (`order_id`,`item_kode`),
  ADD KEY `item_kode` (`item_kode`);

--
-- Indexes for table `tbpurchase`
--
ALTER TABLE `tbpurchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tbpurchasedetail`
--
ALTER TABLE `tbpurchasedetail`
  ADD PRIMARY KEY (`purchase_id`,`item_kode`),
  ADD KEY `item_kode` (`item_kode`);

--
-- Indexes for table `tbstok`
--
ALTER TABLE `tbstok`
  ADD PRIMARY KEY (`stock_date`,`item_kode`),
  ADD KEY `username` (`username`),
  ADD KEY `item_kode` (`item_kode`);

--
-- Indexes for table `tbsupplier`
--
ALTER TABLE `tbsupplier`
  ADD PRIMARY KEY (`supplier_kode`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tborder`
--
ALTER TABLE `tborder`
  ADD CONSTRAINT `tborder_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbuser` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tborder_ibfk_2` FOREIGN KEY (`cust_kode`) REFERENCES `tbcustomer` (`cust_kode`) ON UPDATE CASCADE;

--
-- Constraints for table `tborderdetail`
--
ALTER TABLE `tborderdetail`
  ADD CONSTRAINT `tborderdetail_ibfk_1` FOREIGN KEY (`item_kode`) REFERENCES `tbitem` (`item_kode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbpurchase`
--
ALTER TABLE `tbpurchase`
  ADD CONSTRAINT `tbpurchase_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbuser` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `tbpurchasedetail`
--
ALTER TABLE `tbpurchasedetail`
  ADD CONSTRAINT `tbpurchasedetail_ibfk_1` FOREIGN KEY (`item_kode`) REFERENCES `tbitem` (`item_kode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbstok`
--
ALTER TABLE `tbstok`
  ADD CONSTRAINT `tbstok_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbuser` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbstok_ibfk_2` FOREIGN KEY (`item_kode`) REFERENCES `tbitem` (`item_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
