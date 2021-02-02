-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2020 at 05:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_hungry_14`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hno` text NOT NULL,
  `society` text NOT NULL,
  `area` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `landmark` text DEFAULT NULL,
  `type` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=585 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `area_db`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `area_db`;
CREATE TABLE IF NOT EXISTS `area_db` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `dcharge` float NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `bimg` text NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Aug 07, 2020 at 01:12 PM
-- Last update: Aug 07, 2020 at 03:05 PM
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` text NOT NULL,
  `catimg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `code`
--
-- Creation: Aug 07, 2020 at 01:12 PM
-- Last update: Aug 07, 2020 at 02:50 PM
--

DROP TABLE IF EXISTS `code`;
CREATE TABLE IF NOT EXISTS `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ccode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `ccode`, `status`) VALUES
(1, 'AL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rate` text NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `home`;
CREATE TABLE IF NOT EXISTS `home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_setting`
--
-- Creation: Aug 07, 2020 at 01:12 PM
-- Last update: Aug 07, 2020 at 03:03 PM
--

DROP TABLE IF EXISTS `main_setting`;
CREATE TABLE IF NOT EXISTS `main_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_setting`
--

INSERT INTO `main_setting` (`id`, `data`) VALUES
(1, '<script src = \"app-assets/vendors/js/core/jquery-3.2.1.min.js\" type = \"text/javascript\"></script>\r\n<script src = \"app-assets/vendors/js/core/popper.min.js\" type = \"text/javascript\"></script>\r\n<script src = \"app-assets/vendors/js/core/bootstrap.min.js\" type = \"text/javascript\"></script>\r\n<script src = \"app-assets/vendors/js/perfect-scrollbar.jquery.min.js\" type = \"text/javascript\" > </script>\r\n<script src = \"app-assets/vendors/js/prism.min.js\" type = \"text/javascript\" > </script>\r\n<script src = \"app-assets/vendors/js/jquery.matchHeight-min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/screenfull.min.js\" type = \"text/javascript\" > </script>\r\n<script src = \"app-assets/vendors/js/pace/pace.min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/datatable/datatables.min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/datatable/dataTables.buttons.min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/datatable/buttons.flash.min.js\" type = \"text/javascript\" > </script>\r\n<script src = \"app-assets/vendors/js/datatable/jszip.min.js\" type = \"text/javascript\" > </script>\r\n<script src = \"app-assets/vendors/js/datatable/pdfmake.min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/datatable/vfs_fonts.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/vendors/js/datatable/buttons.print.min.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/js/app-sidebar.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/js/notification-sidebar.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/js/customizer.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/js/data-tables/datatable-advanced.js\" type = \"text/javascript\" ></script>\r\n<script src = \"app-assets/js/tag.js\" > </script>\r\n\r\n<style>\r\n.customizer[_ngcontent - rta - c5] {\r\n    width: 400 px;\r\n    right: -400 px;\r\n    padding: 0;\r\n    background - color: #fff;\r\n    z - index: 1051;\r\n    position: fixed;\r\n    top: 0;\r\n    bottom: 0;\r\n    height: 100 vh;\r\n    - webkit - transition: right .4 s cubic - bezier(.05, .74, .2, .99);\r\n    transition: right .4 s cubic - bezier(.05, .74, .2, .99);\r\n    - webkit - backface - visibility: hidden;\r\n    backface - visibility: hidden;\r\n    border - left: 1 px solid rgba(0, 0, 0, .05);\r\n    box - shadow: 0 0 8 px rgba(0, 0, 0, .1)\r\n}\r\n\r\n.customizer.open[_ngcontent - rta - c5] {\r\n    right: 0\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].customizer - content[_ngcontent - rta - c5] {\r\n    position: relative;\r\n    height: 100 %\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5] a.customizer - toggle[_ngcontent - rta - c5] {\r\n    background: #fff;\r\n    color: theme - color(\"primary\");\r\n    display: block;\r\n    box - shadow: -3 px 0 8 px rgba(0, 0, 0, .1)\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5] a.customizer - close[_ngcontent - rta - c5] {\r\n    color: #000\r\n}\r\n\r\n.customizer[_ngcontent-rta-c5] .customizer-close[_ngcontent-rta-c5] {\r\n    position: absolute;\r\n    right: 10px;\r\n    top: 10px;\r\n    padding: 7px;\r\n    width: auto;\r\n    z-index: 10\r\n}\r\n\r\n.customizer[_ngcontent-rta-c5] # rtl - icon[_ngcontent - rta - c5] {\r\n    position: absolute;\r\n    right: -1 px;\r\n    top: 35 %;\r\n    width: 54 px;\r\n    height: 50 px;\r\n    text - align: center;\r\n    cursor: pointer;\r\n    line - height: 50 px;\r\n    margin - top: 50 px\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].customizer - toggle[_ngcontent - rta - c5] {\r\n    position: absolute;\r\n    top: 35 %;\r\n    width: 54 px;\r\n    height: 50 px;\r\n    left: -54 px;\r\n    text - align: center;\r\n    line - height: 50 px;\r\n    cursor: pointer\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].color - options[_ngcontent - rta - c5] a[_ngcontent - rta - c5] {\r\n    white - space: pre\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - color[_ngcontent - rta - c5] {\r\n    margin: 0 auto\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - color[_ngcontent - rta - c5] span[_ngcontent - rta - c5]: hover {\r\n    cursor: pointer\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - color[_ngcontent - rta - c5] span.white[_ngcontent - rta - c5] {\r\n    color: #ddd !important\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - color[_ngcontent - rta - c5].selected[_ngcontent - rta - c5],\r\n.customizer[_ngcontent - rta - c5].cz - tl - bg - color[_ngcontent - rta - c5].selected[_ngcontent - rta - c5] {\r\n    box - shadow: 0 0 10 px 3 px #009da0;\r\n    border: 3px solid # fff\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - image[_ngcontent - rta - c5]: hover {\r\n    cursor: pointer\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - image[_ngcontent - rta - c5] img.rounded[_ngcontent - rta - c5] {\r\n    border - radius: 1 rem !important;\r\n    border: 2 px solid #e6e6e6;\r\n    height: 100 px;\r\n    width: 50 px\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - image[_ngcontent - rta - c5] img.rounded.selected[_ngcontent - rta - c5] {\r\n    border: 2 px solid #ff586b\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].tl - color - options[_ngcontent - rta - c5] {\r\n    display: none\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - tl - bg - image[_ngcontent - rta - c5] img.rounded[_ngcontent - rta - c5] {\r\n    border - radius: 1 rem !important;\r\n    border: 2 px solid #e6e6e6;\r\n    height: 100 px;\r\n    width: 70 px\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - tl - bg - image[_ngcontent - rta - c5] img.rounded.selected[_ngcontent - rta - c5] {\r\n    border: 2 px solid #ff586b\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - tl - bg - image[_ngcontent - rta - c5] img.rounded[_ngcontent - rta - c5]: hover {\r\n    cursor: pointer\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].bg - hibiscus[_ngcontent - rta - c5] {\r\n    background - image: -webkit - gradient(linear, left top, right bottom, from(#f05f57), color - stop(#c83d5c), color - stop(#99245a), color-stop(# 671351), to(#360940));\r\n    background-image: linear-gradient(to right bottom, # f05f57, #c83d5c, #99245a, # 671351, #360940);\r\n    background-size: 100% 100%;\r\n    background-attachment: fixed;\r\n    background-position: center;\r\n    background-repeat: no-repeat;\r\n    -webkit-transition: background .3s;\r\n    transition: background .3s\r\n}\r\n\r\n.customizer[_ngcontent-rta-c5] .bg-purple-pizzazz[_ngcontent-rta-c5] {\r\n    background-image: -webkit-gradient(linear, left top, right bottom, from(# 662 d86), color - stop(#8b2a8a), color-stop(# ae2389), color - stop(#cf1d83), to(#ed1e79));\r\n\r\n    background - image: linear - gradient(to right bottom, #662d86, # 8 b2a8a, #ae2389, #cf1d83, #ed1e79);\r\n    background - size: 100 % 100 %;\r\n    background - attachment: fixed;\r\n    background - position: center;\r\n    background - repeat: no - repeat;\r\n    - webkit - transition: background .3 s;\r\n    transition: background .3 s\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].bg - blue - lagoon[_ngcontent - rta - c5] {\r\n    background - image: -webkit - gradient(linear, left top, right bottom, from(#144e68), color-stop(# 006 d83), color - stop(#008d92), color-stop(# 00 ad91), to(#57ca85));\r\n    background-image: linear-gradient(to right bottom, # 144e68, #006d83, # 008 d92, #00ad91, # 57 ca85);\r\n    background - size: 100 % 100 %;\r\n    background - attachment: fixed;\r\n    background - position: center;\r\n    background - repeat: no - repeat;\r\n    - webkit - transition: background .3 s;\r\n    transition: background .3 s\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].bg - electric - violet[_ngcontent - rta - c5] {\r\n    background - image: -webkit - gradient(linear, right bottom, left top, from(#4a00e0), color-stop(# 600 de0), color - stop(#7119e1), color-stop(# 8023e1), to(#8e2de2));\r\n    background-image: linear-gradient(to left top, # 4 a00e0, #600de0, # 7119e1, #8023e1, # 8e2 de2);\r\n    background - size: 100 % 100 %;\r\n    background - attachment: fixed;\r\n    background - position: center;\r\n    background - repeat: no - repeat;\r\n    - webkit - transition: background .3 s;\r\n    transition: background .3 s\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].bg - portage[_ngcontent - rta - c5] {\r\n    background - image: -webkit - gradient(linear, right bottom, left top, from(#97abff), color-stop(# 798 ce5), color - stop(#5b6ecb), color-stop(# 3 b51b1), to(#123597));\r\n    background-image: linear-gradient(to left top, # 97 abff, #798ce5, # 5 b6ecb, #3b51b1, # 123597);\r\n    background - size: 100 % 100 %;\r\n    background - attachment: fixed;\r\n    background - position: center;\r\n    background - repeat: no - repeat;\r\n    - webkit - transition: background .3 s;\r\n    transition: background .3 s\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].bg - tundora[_ngcontent - rta - c5] {\r\n    background - image: -webkit - gradient(linear, right bottom, left top, from(#474747), color-stop(# 4 a4a4a), color - stop(#4c4d4d), color-stop(# 4 f5050), to(#525352));\r\n    background-image: linear-gradient(to left top, # 474747, #4a4a4a, # 4 c4d4d, #4f5050, # 525352);\r\n    background - size: 100 % 100 %;\r\n    background - attachment: fixed;\r\n    background - position: center;\r\n    background - repeat: no - repeat;\r\n    - webkit - transition: background .3 s;\r\n    transition: background .3 s\r\n}\r\n\r\n.customizer[_ngcontent - rta - c5].cz - bg - color[_ngcontent - rta - c5].col[_ngcontent - rta - c5] span.rounded - circle[_ngcontent - rta - c5]: hover,\r\n.customizer[_ngcontent - rta - c5].cz - tl - bg - color[_ngcontent - rta - c5].col[_ngcontent - rta - c5] span.rounded - circle[_ngcontent - rta - c5]: hover {\r\n    cursor: pointer\r\n}\r\n\r\n[dir=rtl][_nghost - rta - c5].customizer {\r\n    left: -400 px;\r\n    right: auto;\r\n    border - right: 1 px solid rgba(0, 0, 0, .05);\r\n    border - left: 0\r\n}\r\n\r\n[dir=rtl][_nghost - rta - c5].customizer.open {\r\n    left: 0;\r\n    right: auto\r\n}\r\n\r\n[dir=rtl][_nghost - rta - c5].customizer.customizer - close {\r\n    left: 10 px;\r\n    right: auto\r\n}\r\n\r\n[dir=rtl][_nghost - rta - c5].customizer.customizer - toggle {\r\n    right: -54 px;\r\n    left: auto\r\n}\r\n</style>\r\n\r\n<style>\r\n.label - info,\r\n.badge - info {\r\n    background - color: #3a87ad;\r\n}\r\n\r\n.bootstrap-tagsinput {\r\n    width: 100%;\r\n}\r\n\r\n.label,\r\n.badge {\r\n    display: inline-block;\r\n    padding: 2px 4px;\r\n    font-size: 11.844px;\r\n    font-weight: bold;\r\n    line-height: 14px;\r\n    color: # fff;\r\n    text - shadow: 0 - 1 px 0 rgba(0, 0, 0, 0.25);\r\n    white - space: nowrap;\r\n    vertical - align: baseline;\r\n\r\n}\r\n</style>');

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `noti`;
CREATE TABLE IF NOT EXISTS `noti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `oid` text NOT NULL,
  `uid` int(11) NOT NULL,
  `pname` text NOT NULL,
  `pid` text NOT NULL,
  `ptype` text NOT NULL,
  `pprice` text NOT NULL,
  `ddate` text NOT NULL,
  `timesloat` text NOT NULL,
  `order_date` date NOT NULL,
  `status` text NOT NULL,
  `qty` text NOT NULL,
  `total` float NOT NULL,
  `rate` int(11) NOT NULL DEFAULT 0,
  `p_method` text DEFAULT NULL,
  `rid` int(11) NOT NULL DEFAULT 0,
  `a_status` int(11) NOT NULL DEFAULT 0,
  `photo` longtext DEFAULT NULL,
  `s_photo` longtext DEFAULT NULL,
  `r_status` varchar(200) DEFAULT 'Not Assigned',
  `pickup` text DEFAULT NULL,
  `tax` int(11) NOT NULL DEFAULT 0,
  `address_id` int(11) NOT NULL DEFAULT 0,
  `tid` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `payment_list`;
CREATE TABLE IF NOT EXISTS `payment_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cred_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cred_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `img`, `title`, `cred_title`, `cred_value`, `status`) VALUES
(1, 'payment/thump_1589451371.png', 'Razorpay', 'RAZORPAY_API_KEY', '', 1),
(2, 'payment/thump_1589451385.png', 'Paypal', 'Sendbox', '', 1),
(3, 'payment/thump_1589451400.png', 'Cash On Delivery', '-', '-', 1),
(4, 'payment/thump_1589451416.png', 'Pickup Myself', '-', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` text NOT NULL,
  `sname` text NOT NULL,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `psdesc` text NOT NULL,
  `pgms` text NOT NULL,
  `pprice` text NOT NULL,
  `status` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `pimg` text NOT NULL,
  `prel` longtext DEFAULT NULL,
  `date` datetime NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rate_order`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `rate_order`;
CREATE TABLE IF NOT EXISTS `rate_order` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `oid` text NOT NULL,
  `uid` int(11) NOT NULL,
  `msg` text NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `rider`;
CREATE TABLE IF NOT EXISTS `rider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `aid` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject` int(11) NOT NULL DEFAULT 0,
  `accept` int(11) NOT NULL DEFAULT 0,
  `complete` int(11) NOT NULL DEFAULT 0,
  `a_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rnoti`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `rnoti`;
CREATE TABLE IF NOT EXISTS `rnoti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--
-- Creation: Aug 07, 2020 at 01:12 PM
-- Last update: Aug 07, 2020 at 03:13 PM
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `one_key` text NOT NULL,
  `one_hash` text NOT NULL,
  `r_key` text NOT NULL,
  `r_hash` text NOT NULL,
  `currency` text CHARACTER SET utf8 NOT NULL,
  `privacy_policy` longtext NOT NULL,
  `about_us` longtext NOT NULL,
  `contact_us` longtext NOT NULL,
  `o_min` int(11) NOT NULL,
  `timezone` text NOT NULL,
  `tax` int(11) NOT NULL,
  `logo` text NOT NULL,
  `favicon` text NOT NULL,
  `title` text NOT NULL,
  `terms` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `one_key`, `one_hash`, `r_key`, `r_hash`, `currency`, `privacy_policy`, `about_us`, `contact_us`, `o_min`, `timezone`, `tax`, `logo`, `favicon`, `title`, `terms`) VALUES
(1, '', '', '', '', '€', '<p><strong>Privacy Policy</strong></p>\r\n', '<p><strong>ABOUT US</strong></p>\r\n', '<p><strong>CONTACT US</strong></p>\r\n', 300, 'Europe/Tirane', 6, 'website/thump_1589874137.png', 'website/thump_1589874137.png', 'Hungry Grocery 14 Nulled TRC4 Albania', '<p><strong>TERMS &amp; CONDITIONS</strong></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--
-- Creation: Aug 07, 2020 at 01:12 PM
-- Last update: Aug 07, 2020 at 03:06 PM
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE IF NOT EXISTS `timeslot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mintime` text NOT NULL,
  `maxtime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uread`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `uread`;
CREATE TABLE IF NOT EXISTS `uread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `nid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Aug 07, 2020 at 01:12 PM
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `imei` text NOT NULL,
  `email` text NOT NULL,
  `ccode` text NOT NULL,
  `mobile` text NOT NULL,
  `rdate` datetime NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `pin` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
