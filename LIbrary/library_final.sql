-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2015 at 11:52 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_leading`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info_exam`
--

CREATE TABLE IF NOT EXISTS `admin_info_exam` (
  `admin_id` varchar(30) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` varchar(60) NOT NULL,
  `admin_status` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info_exam`
--

INSERT INTO `admin_info_exam` (`admin_id`, `admin_name`, `admin_pass`, `admin_status`) VALUES
('admin1', 'Tasnia', '1101020008', 'Admin'),
('admin2', 'Tanny', '1101020017', 'Admin'),
('admin3', 'Susoma', '1101020010', 'Admin'),
('admin4', 'Iffat', '1101020026', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `all_transactions`
--

CREATE TABLE IF NOT EXISTS `all_transactions` (
  `tNo` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `transBy` varchar(50) NOT NULL,
  PRIMARY KEY (`tNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `all_transactions`
--

INSERT INTO `all_transactions` (`tNo`, `date`, `category`, `description`, `amount`, `transBy`) VALUES
(0, '0000-00-00', '', '', 0, ''),
(1, '2015-02-25', 'income', 'student Collection', 15000, 'admin'),
(2, '2015-02-27', 'income', 'student Collection', 14375, 'admin'),
(3, '2015-02-27', 'income', 'student Collection', 200, 'admin'),
(4, '2015-02-27', 'income', 'student Collection', 10000, 'admin'),
(5, '2015-02-27', 'income', 'student Collection', 16000, 'admin'),
(6, '2015-02-27', 'income', 'student Collection', 22037.5, 'admin'),
(7, '2015-02-27', 'income', 'student Collection', 500, 'admin'),
(8, '2015-02-27', 'income', 'student Collection', 200, 'admin'),
(9, '2015-02-27', 'income', 'others', 50000, 'admin'),
(10, '2015-02-27', 'expense', 'electricity bill', 5000, 'admin'),
(11, '2015-02-27', 'expense', 'Vehicle Cost', 2000, 'admin'),
(12, '2015-02-28', 'income', 'Student Collection', 16000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE IF NOT EXISTS `book_info` (
  `book_number` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(10) NOT NULL,
  `book_title` varchar(70) NOT NULL,
  `author` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `campus_name` varchar(25) NOT NULL,
  `shelf_number` int(4) NOT NULL,
  `status` int(4) NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `Book_Number` (`book_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`book_number`, `book_id`, `book_title`, `author`, `isbn`, `edition`, `price`, `campus_name`, `shelf_number`, `status`, `category`, `entry_date`) VALUES
(1, 1, '30 Minutes to Succeed in Busin', 'Graham Hart', 'ENG01', '6', 150, 'Shurma Tower', 5, 3, 'ENGLISH', '2015-02-19 18:39:54'),
(2, 2, '30 Minutes to Succeed in Busin', 'Graham Hart', 'ENG01', '5', 200, 'Rongmohol Tower', 3, 1, 'ENGLISH', '2015-02-19 18:39:54'),
(3, 3, '30 Minutes to write a Report ', 'Patrick Forsyth', 'ENG02', '6', 190, 'Shurma Tower', 3, 2, 'ENGLISH', '2015-02-19 18:42:51'),
(4, 4, 'Digital image Processing', 'Rafael C. Gonzales', 'CSE001', '9', 2000, 'Rongmohol Tower', 1, 1, 'CSE', '2015-02-19 18:43:51'),
(5, 5, 'Digital image Processing', 'Rafael C. Gonzales', 'CSE001', '9', 2000, 'Shurma Tower', 5, 3, 'CSE', '2015-02-19 18:43:51'),
(6, 6, 'Digital image Processing', 'Rafael C. Gonzales', 'CSE001', '9', 2000, 'Rongmohol Tower', 6, 1, 'CSE', '2015-02-19 18:43:51'),
(7, 7, 'Elements of Properties of Matter', 'D.S Mathur', 'CSE02', '12', 103, 'Shurma Tower', 6, 1, 'CSE', '2015-02-19 18:45:30'),
(8, 8, 'Elements of Properties of Matter', 'D.S Mathur', 'CSE02', '12', 103, 'Rongmohol Tower', 5, 3, 'CSE', '2015-02-19 18:45:30'),
(9, 9, 'Entrepreneurship Small Busines', 'Dr. A. R Khan', 'BBA01', '9', 540, 'Rongmohol Tower', 8, 2, 'BUA', '2015-02-19 18:46:15'),
(10, 10, 'Computer Programming', 'Tamim Shahriyar Subeen', 'CSE03', '1', 180, 'Rongmohol Tower', 1, 1, 'CSE', '2015-02-19 18:47:14'),
(11, 11, 'Compuer Programming', 'Tamim Shariyar Subeen', 'CSE04', '2', 190, 'Shurma Tower', 9, 2, 'CSE', '2015-02-19 18:48:17'),
(12, 12, 'Compuer Programming', 'Tamim Shariyar Subeen', 'CSE04', '2', 190, 'Rongmohol Tower', 6, 2, 'CSE', '2015-02-19 18:48:17'),
(13, 13, 'Core Servlets and Java Server ', 'Marty Hall', 'CSE05', '7', 150, 'Rongmohol Tower', 1, 1, 'CSE', '2015-02-19 18:52:43'),
(14, 14, 'Computer Fundamentals', 'Lutfur Rahman', 'CSE06', '3', 230, 'Shurma Tower', 3, 1, 'CSE', '2015-02-19 18:53:30'),
(15, 15, 'Computer Fundamentals', 'Lutfur Rahman', 'CSE06', '3', 230, 'Central Library', 2, 2, 'CSE', '2015-02-19 18:53:30'),
(16, 16, 'A Portrait of the Artist as a Young Man', 'James Joyce', 'ENG03', '9', 330, 'Central Library', 6, 1, 'ENGLISH', '2015-02-19 18:54:18'),
(17, 17, 'Big Bang Theory', 'Stifen Hokings', 'Big001', '5', 250, 'Central Library', 2, 1, 'CSE', '2015-02-26 20:03:44'),
(18, 18, 'Big Bang Theory', 'Stifen Hokings', 'Big001', '5', 250, 'Rongmohol Tower', 1, 1, 'CSE', '2015-02-26 20:55:14'),
(19, 19, 'Big Bang Theory', 'Stifen Hokings', 'Big001', '5', 250, 'Shurma Tower', 3, 1, 'CSE', '2015-02-26 20:55:45'),
(20, 20, 'Big Bang Theory', 'Stifen Hokings', 'Big001', '5', 250, 'Shurma Tower', 1, 2, 'CSE', '2015-02-26 20:56:48'),
(21, 21, 'Big Bang Theory', 'Stifen Hokings', 'Big001', '5', 250, 'Shurma Tower', 1, 1, 'CSE', '2015-02-26 20:56:48'),
(22, 22, 'Labour & Industrial Laws of Bangladesh', 'Md. Rofiuddin & A.A Khan', 'LAW002', '9', 390, '', 0, 1, 'LAW', '2015-02-27 21:09:47'),
(23, 23, 'Labour & Industrial Laws of Bangladesh', 'Md. Rofiuddin & A.A Khan', 'LAW002', '9', 390, '', 0, 1, 'LAW', '2015-02-27 21:09:47'),
(24, 24, 'Numerical Method', 'Ebala Guru', 'CSE067', '5', 200, 'Kamal Bazar', 6, 1, 'CSE', '2015-03-01 06:49:49'),
(25, 25, 'Numerical Method', 'Ebala Guru', 'CSE067', '5', 200, 'Kamal Bazar', 6, 1, 'CSE', '2015-03-01 06:49:49'),
(26, 26, 'Numerical Method', 'Ebala Guru', 'CSE001', '6', 500, 'Central Library', 1, 0, 'CSE', '2015-03-01 07:42:38'),
(27, 27, 'Numerical Method', 'Ebala Guru', 'CSE001', '6', 500, 'Kamal Bazar', 4, 2, 'CSE', '2015-03-01 07:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `book_request`
--

CREATE TABLE IF NOT EXISTS `book_request` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `edition` varchar(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `buy_status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `book_request`
--

INSERT INTO `book_request` (`serial`, `user_id`, `book_title`, `author`, `edition`, `time`, `buy_status`) VALUES
(1, '44', '415', 'd', '8', '2014-12-23 18:00:00', 0),
(2, '1301020071', 'Sample', 'Mohaimenul Adnan', '1', '2014-12-08 18:00:00', 0),
(3, '123', 'Esho Programming Sikhi', 'Dr Tushar', '5', '2015-02-28 10:44:01', 1),
(4, '11', 'MIS', 'Dr Tushar', '5', '2015-02-27 10:34:02', 1),
(5, '1234', 'MIS', 'Dr Tushar', '5', '2015-02-27 10:14:25', 1),
(6, '11', 'Esho Programming Sikhi', 'Dr Tushar', '10', '2014-12-11 18:00:00', 0),
(7, '11', 'MIS', 'Subeen', '5', '2015-02-27 10:17:17', 0),
(8, '11', 'MLS', 'Kanthi', '0', '2014-11-13 18:00:00', 0),
(9, '123', 'Mozilla', 'Rayhan', '2', '2015-02-27 10:04:29', 1),
(10, '12345', 'Java', 'raj', '2', '2014-11-22 18:00:00', 0),
(11, '123', 'Algotithm', 'MMR', '1', '2014-12-23 20:37:40', 0),
(12, '123', 'Hello World', 'Kallol', '0', '2015-02-27 10:19:50', 1),
(13, '145', 'java2', 'pk', '4', '2015-02-27 10:28:02', 1),
(14, '1234', 'Bangladesh study', 'Md khan', '4', '2015-02-08 19:55:54', 0),
(15, '123', 'robotics', 'arpita', '5', '2015-02-11 17:01:20', 0),
(16, '123', 'tumi ami', 'tumi', '1', '2015-02-27 20:23:25', 1),
(17, '1101020022', 'Numerical Method', 'Ebala Guru', '4', '2015-03-01 06:45:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_transaction`
--

CREATE TABLE IF NOT EXISTS `book_transaction` (
  `transaction_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(15) NOT NULL,
  `book_number` int(10) NOT NULL,
  `issue_date` timestamp NULL DEFAULT NULL,
  `return_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issue_by` varchar(30) NOT NULL,
  `transaction_status` int(2) NOT NULL,
  `day_limit` int(4) NOT NULL DEFAULT '10',
  `renew_status` int(3) NOT NULL DEFAULT '1',
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `issue_by` (`issue_by`),
  KEY `book_number` (`book_number`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  KEY `transaction_status` (`transaction_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `book_transaction`
--

INSERT INTO `book_transaction` (`transaction_id`, `user_id`, `book_number`, `issue_date`, `return_date`, `issue_by`, `transaction_status`, `day_limit`, `renew_status`) VALUES
(1, 1101020034, 5, '2015-02-27 18:40:34', '2015-02-27 18:46:09', 'GC', 1, 10, 1),
(2, 1101020022, 6, '2015-02-13 18:46:22', '2015-02-28 07:17:39', 'GC', 1, 10, 1),
(3, 1101020022, 8, '2015-01-31 18:48:56', '2015-02-27 18:49:26', 'GC', 1, 10, 1),
(4, 1101020022, 8, '2015-02-27 18:50:17', '2015-02-27 18:50:25', 'GC', 1, 10, 1),
(5, 1101020022, 8, '2015-02-27 18:53:56', '2015-02-27 19:07:57', 'GC', 1, 13, 1),
(6, 1101020022, 8, '2015-02-12 19:08:25', '2015-02-27 19:09:51', 'GC', 1, 14, 1),
(7, 1101020022, 8, '2015-02-27 19:17:48', '2015-02-27 20:59:58', 'Smriti', 1, 13, 1),
(8, 1101020022, 16, '2015-02-27 19:54:26', '2015-02-28 07:18:30', 'Smriti', 1, 25, 1),
(9, 1101020002, 10, '2015-02-27 20:35:31', '2015-02-28 10:49:24', 'GC', 1, 10, 1),
(10, 1101020022, 8, '2015-02-20 21:00:17', '2015-02-27 21:00:52', 'GC', 1, 10, 1),
(11, 1101020022, 8, '2015-02-19 21:02:49', '2015-02-27 21:03:15', 'GC', 1, 10, 1),
(12, 1101020022, 2, '2015-02-27 21:06:56', '2015-03-01 07:07:14', '', 1, 23, 1),
(13, 1101020034, 6, '2015-02-28 07:19:30', '2015-03-02 08:45:36', 'Smriti', 1, 21, 1),
(14, 1101020022, 1, '2015-02-28 09:46:49', '2015-02-28 09:50:06', 'GC', 1, 10, 1),
(15, 1101020022, 7, '2015-02-28 11:03:34', '2015-03-01 06:31:43', 'Gautam', 1, 18, 1),
(16, 1101020034, 1, '2015-02-28 21:02:11', '2015-02-28 21:05:19', 'Gautam', 1, 10, 1),
(17, 1101020022, 7, '2015-03-01 06:32:11', '2015-03-01 06:32:17', 'Gautam', 1, 10, 1),
(18, 1101020022, 4, '2015-03-01 06:47:34', '2015-03-01 06:48:04', 'Gautam', 1, 10, 1),
(19, 1101020022, 1, '2015-03-01 07:10:37', '0000-00-00 00:00:00', 'Gautam', 0, 10, 1),
(20, 1101020022, 2, '2015-03-01 07:11:51', '2015-03-01 07:12:00', '', 1, 10, 1),
(21, 1101020022, 2, '2015-03-01 07:14:25', '2015-03-01 07:15:08', 'Gautam Chakrabaty', 1, 10, 1),
(22, 1101020034, 4, '2015-03-02 11:12:42', '2015-03-02 11:12:51', 'Gautam Chakrabaty', 1, 10, 1),
(23, 1101020034, 8, '2015-02-03 11:20:07', '0000-00-00 00:00:00', 'Gautam', 0, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `sender_name` varchar(50) NOT NULL,
  `sender_mob` int(12) NOT NULL,
  `sender_email` varchar(40) NOT NULL,
  `message` varchar(600) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `sender_name`, `sender_mob`, `sender_email`, `message`, `time`, `status`) VALUES
(9, 'Gautam Chakraborty', 1521236091, 'gc_tushar@yahoo.com', 'Hello Admin, I have Lost a book . Now What to do ? Please sent me mail .', '2015-03-02 07:55:18', 0),
(10, 'Shamsia Sharmin', 1717744884, 'smriti@yahoo.com', 'Are there any Way to borroow the Library Copy Book ??', '2015-03-02 07:33:00', 0),
(12, 'Mashuk Ahmed', 1731456791, 'mashuk@gmail.com', 'How to reach to Central library ?', '2015-03-02 11:09:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `descriptions_list`
--

CREATE TABLE IF NOT EXISTS `descriptions_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `part` varchar(50) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `descriptions_list`
--

INSERT INTO `descriptions_list` (`id`, `category`, `part`, `descriptions`, `code`) VALUES
(1, 'income', 'student', 'student Collection', 0),
(3, 'income', 'others', 'others', 0),
(4, 'expense', 'others', 'others', 0),
(6, 'expense', 'others', 'tax', 0),
(7, 'expense', 'others', 'electricity bill', 0),
(10, 'expense', 'others', 'Paper', 0),
(11, 'expense', 'others', 'Stationary', 0),
(12, 'expense', 'others', 'Rent', 0),
(13, 'expense', 'others', 'Vehicle Cost', 0),
(20, 'expense', 'others', 'Generator', 110140);

-- --------------------------------------------------------

--
-- Table structure for table `due_history`
--

CREATE TABLE IF NOT EXISTS `due_history` (
  `studentId` int(11) NOT NULL,
  `tNo` int(10) NOT NULL,
  `libraryFine` float NOT NULL,
  `dueAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due_history`
--

INSERT INTO `due_history` (`studentId`, `tNo`, `libraryFine`, `dueAmount`) VALUES
(1101020034, 0, 50, 100),
(1101020022, 0, 22, 0),
(1101020002, 0, 205, 553);

-- --------------------------------------------------------

--
-- Table structure for table `ebook_info`
--

CREATE TABLE IF NOT EXISTS `ebook_info` (
  `ebook_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(30) NOT NULL,
  `author` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ebook_link` varchar(500) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ebook_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `ebook_info`
--

INSERT INTO `ebook_info` (`ebook_id`, `book_title`, `author`, `isbn`, `edition`, `category`, `ebook_link`, `entry_date`) VALUES
(3, 'Oracle 9i A Beginners Guide', 'Michael Abbey\n', 'CSE0026', '8', 'CSE', 'http://www.w3schools.com/', '2015-01-24 10:27:39'),
(4, 'Organization Development	', 'Wendel French\n', 'BBA0026', '6', 'Other', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-01-24 10:28:27'),
(5, 'Esho Programming Sikhi', 'Subeen', 'CSE006', '5', 'Other', 'http://www.w3schools.com/', '2015-01-24 10:29:10'),
(6, 'Organizational Behavior', 'Stephen P. Robbins', 'BBA005', '2', 'Other', 'http://www.w3schools.com/', '2015-01-24 10:36:41'),
(7, 'Management Information System	', 'D.P. Goyal', 'Mang005', '1', 'Other', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-01-24 10:37:26'),
(8, 'MIS', 'Dr. Tushar', 'CSE050', '1', 'Other', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-01-24 10:42:53'),
(9, 'MIS', 'Dr. Tushar', 'CSE051', '2', 'Other', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-01-24 10:44:07'),
(14, 'Testing for Language Teachers	', 'Arthur Hughes\n', 'ENG005', '4', 'CSE', 'http://localhost/lu_library/SearchEBook.php', '2015-02-06 21:27:51'),
(16, 'The arden Shakespeare Kinglear', 'Ed. R.A Foakes', 'ENG006', '6', 'CSE', 'http://localhost/lu_library/', '2015-02-06 21:34:54'),
(17, 'Computer Fundamentals	', 'Lutfur Rahman\n', 'CSE404', '4', '', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-02-06 21:36:07'),
(18, 'Twelfth night Notes', 'Shakespeare', 'ENG0504', '5', 'BUA', 'http://localhost/library/index.php', '2015-02-12 10:50:23'),
(23, 'Introduction to Algorithms', 'Robert Sedgewick and Kevin Wayne', 'CSE082', '4', 'CSE', 'https://www.dropbox.com/s/cwkuiergrv4n91g/Assignment%20On%20Family%20.doc?dl=0', '2015-02-27 21:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `fees_list`
--

CREATE TABLE IF NOT EXISTS `fees_list` (
  `batch` varchar(20) NOT NULL,
  `dept` int(11) NOT NULL,
  `creditFee` float NOT NULL,
  `adFee` float NOT NULL,
  `actDevFee` float NOT NULL,
  `librarySFee` float NOT NULL,
  `trncptFee` float NOT NULL,
  `certiFee` float NOT NULL,
  `makeUpFee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_list`
--

INSERT INTO `fees_list` (`batch`, `dept`, `creditFee`, `adFee`, `actDevFee`, `librarySFee`, `trncptFee`, `certiFee`, `makeUpFee`) VALUES
('26', 1, 1870, 15000, 1000, 1000, 200, 500, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `fine_desc`
--

CREATE TABLE IF NOT EXISTS `fine_desc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fine_desc`
--

INSERT INTO `fine_desc` (`id`, `description`) VALUES
(1, 'Library Fine'),
(2, 'Late Registration Fee'),
(3, 'Janina'),
(4, 'Janina');

-- --------------------------------------------------------

--
-- Table structure for table `keycode`
--

CREATE TABLE IF NOT EXISTS `keycode` (
  `key` varchar(30) NOT NULL,
  `code` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keycode`
--

INSERT INTO `keycode` (`key`, `code`) VALUES
('Available', 1),
('Lost', 0),
('Library Copy', 2),
('On Rent', 3),
('Transaction Complete', 1),
('Renue enable', 2),
('Incomplete Transaction', 0);

-- --------------------------------------------------------

--
-- Table structure for table `library_admin_info`
--

CREATE TABLE IF NOT EXISTS `library_admin_info` (
  `name` varchar(30) NOT NULL,
  `admin_id` varchar(15) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact_number` varchar(18) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library_admin_info`
--

INSERT INTO `library_admin_info` (`name`, `admin_id`, `admin_email`, `password`, `contact_number`) VALUES
('Gautam Chakrabaty', '123', 'gc_tushar@yahoo.com', '123456', '01717744884'),
('Smriti', '1234', 'smriti@gmail.com', '123456', '01749721012'),
('Juhi', '234', 'Juhi@yahoo.com', '123456', '01718684255');

-- --------------------------------------------------------

--
-- Table structure for table `notice_info`
--

CREATE TABLE IF NOT EXISTS `notice_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `dept` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `user_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recover_password`
--

CREATE TABLE IF NOT EXISTS `recover_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_hash` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reduce_fine`
--

CREATE TABLE IF NOT EXISTS `reduce_fine` (
  `studentId` int(11) NOT NULL,
  `fineDesc` varchar(200) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reduce_fine`
--

INSERT INTO `reduce_fine` (`studentId`, `fineDesc`, `amount`) VALUES
(1101020024, 'Library Fine', 100),
(1101020009, 'Late Registration Fee', 1000),
(1101020024, 'Late Registration Fee', 1000),
(1101020009, 'Library Fine', 100);

-- --------------------------------------------------------

--
-- Table structure for table `reg_dates`
--

CREATE TABLE IF NOT EXISTS `reg_dates` (
  `season` varchar(20) NOT NULL,
  `year` int(5) NOT NULL,
  `dept` int(11) NOT NULL,
  `lastDate` date NOT NULL,
  `fine500Date` date NOT NULL,
  `fine1000Date` date NOT NULL,
  `fineHalfDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_dates`
--

INSERT INTO `reg_dates` (`season`, `year`, `dept`, `lastDate`, `fine500Date`, `fine1000Date`, `fineHalfDate`) VALUES
('Spring', 2015, 1, '2015-03-01', '2015-03-10', '2015-03-20', '2015-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE IF NOT EXISTS `routine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `path` varchar(60) NOT NULL,
  `count` int(30) NOT NULL,
  `dept` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE IF NOT EXISTS `student_result` (
  `s_no` int(35) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(25) NOT NULL,
  `course_id` varchar(30) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `session` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `total_marks` double NOT NULL,
  `grade` varchar(5) NOT NULL,
  `t_id` varchar(100) NOT NULL,
  `flag` int(2) NOT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`s_no`, `s_id`, `course_id`, `course_code`, `session`, `year`, `total_marks`, `grade`, `t_id`, `flag`) VALUES
(1, '1101020008', '3', 'ART-1111', 'Spring', 2011, 81, 'A+', '1111', 0),
(2, '1101020017', '3', 'ART-1111', 'Spring', 2011, 85, 'A+', '1111', 0),
(3, '1101070010', '5', 'EEE-1111', 'Spring', 2011, 30, 'F', '2222', 1),
(4, '1101070010', '8', 'MATH-1213', 'Spring', 2011, 90, 'A+', '2222', 0),
(5, '1101020008', '4', 'ENG-1213', 'Spring', 2011, 60, 'B+', '3333', 0),
(6, '1101020017', '4', 'ENG-1213', 'Spring', 2011, 75, 'A', '3333', 0),
(7, '1101020008', '7', 'MATH-1213', 'Spring', 2011, 75, 'A', '2222', 0),
(8, '1101020017', '7', 'MATH-1213', 'Spring', 2011, 70, 'A-', '2222', 0),
(9, '1101020008', '6', 'EEE-1213', 'Summer', 2011, 45, 'C', '1111', 0),
(10, '1101020017', '6', 'EEE-1213', 'Summer', 2011, 60, 'B', '1111', 0),
(11, '1101070010', '11', 'CSE-1213', 'Summer', 2011, 60, 'B', '2222', 0),
(12, '1101070010', '5', 'EEE-1111', 'Summer', 2011, 80, 'A+', '3333', 0),
(13, '1101020008', '1', 'CSE-1111', 'Summer', 2011, 50, 'C+', '2222', 0),
(14, '1101020017', '1', 'CSE-1111', 'Summer', 2011, 50, 'C+', '2222', 0),
(15, '1201070001', '5', 'EEE-1111', 'Fall', 2011, 50, 'C+', '1111', 0),
(16, '1201070001', '8', 'MATH-1213', 'Fall', 2011, 80, 'A+', '3333', 0),
(17, '1101070010', '6', 'EEE-1213', 'Fall', 2011, 70, 'A-', '2222', 0),
(18, '1101020008', '9', 'CSE-1214', 'Fall', 2011, 80, 'A+', '1111', 0),
(19, '1101020017', '9', 'CSE-1214', 'Fall', 2011, 80, 'A+', '1111', 0),
(20, '1201070001', '11', 'CSE-1213', 'Spring', 2012, 70, 'A-', '1111', 0),
(21, '1201070001', '6', 'EEE-1213', 'Spring', 2012, 80, 'A+', '2222', 0),
(22, '1301020026', '2', 'CSE-1112', 'Spring', 2012, 80, 'A+', '1111', 0),
(23, '1301020026', '3', 'ART-1111', 'Spring', 2012, 70, 'A-', '3333', 0),
(24, '1101020008', '10', 'CSE-1214', 'Spring', 2012, 80, 'A+', '3333', 0),
(25, '1101020017', '10', 'CSE-1214', 'Spring', 2012, 80, 'A+', '3333', 0),
(26, '1301020027', '7', 'MATH-1213', 'Summer', 2012, 70, 'A-', '2222', 0),
(27, '1301020027', '9', 'CSE-1214', 'Summer', 2012, 80, 'A+', '2222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_trans`
--

CREATE TABLE IF NOT EXISTS `student_trans` (
  `tNo` int(11) NOT NULL,
  `slipNo` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `season` varchar(20) NOT NULL,
  `year` int(5) NOT NULL,
  `admissionFee` float NOT NULL,
  `regularCredit` float NOT NULL,
  `retakeCredit` float NOT NULL,
  `activityFee` float NOT NULL,
  `libraryFee` float NOT NULL,
  `lateFee` float NOT NULL,
  `reAdFee` float NOT NULL,
  `transcriptFee` float NOT NULL,
  `certificateFee` float NOT NULL,
  `makeupFee` float NOT NULL,
  `due` float NOT NULL,
  `total` float NOT NULL,
  `payCategory` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`slipNo`),
  UNIQUE KEY `slipNo` (`slipNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_trans`
--

INSERT INTO `student_trans` (`tNo`, `slipNo`, `studentId`, `season`, `year`, `admissionFee`, `regularCredit`, `retakeCredit`, `activityFee`, `libraryFee`, `lateFee`, `reAdFee`, `transcriptFee`, `certificateFee`, `makeupFee`, `due`, `total`, `payCategory`, `status`) VALUES
(0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 1, 1101020024, 'Spring', 2015, 15000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 15000, 2, 1),
(2, 2, 1101020024, 'Spring', 2015, 0, 14025, 9350, 1000, 0, 0, 0, 0, 0, 0, 10000, 14375, 1, 1),
(3, 3, 1101020024, 'Spring', 2015, 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 0, 200, 6, 1),
(4, 4, 1101020024, 'Spring', 2015, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10000, 1, 1),
(5, 5, 2, 'Spring', 2015, 15000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 16000, 2, 1),
(6, 6, 1101020009, 'Spring', 2015, 0, 21037.5, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 22037.5, 1, 1),
(7, 7, 1101020024, 'Spring', 2015, 0, 0, 0, 0, 0, 0, 0, 0, 500, 0, 0, 500, 7, 1),
(8, 8, 1101020024, 'Spring', 2015, 0, 0, 0, 0, 0, 0, 0, 200, 0, 0, 0, 200, 6, 1),
(12, 9, 5, 'Spring', 2015, 15000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 16000, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL,
  PRIMARY KEY (`admin_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_auto_id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_info`
--

CREATE TABLE IF NOT EXISTS `tbl_course_info` (
  `course_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(60) NOT NULL,
  `course_credit` double NOT NULL,
  `course_dept` int(11) NOT NULL,
  `course_prerequisite` int(11) NOT NULL,
  PRIMARY KEY (`course_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_course_info`
--

INSERT INTO `tbl_course_info` (`course_auto_id`, `course_code`, `course_name`, `course_credit`, `course_dept`, `course_prerequisite`) VALUES
(3, 'CSE-1111', 'Introduction To Computer', 3, 1, 0),
(4, 'CSE-1112', 'Intoduction To Computer : Sessional', 1, 1, 0),
(5, 'CSE-2222', 'Introduction To C', 2, 1, 0),
(6, 'CSE-2223', 'Introduction To C++', 3, 1, 0),
(7, 'cse-123', 'Intoduction To Computer : Sessionalsdf', 2, 1, 3),
(8, 'CSE-RRRR', 'admin4', 6, 1, 7),
(9, 'fre-1471', 'janina', 3, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_course_offer` (
  `offer_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_semester` int(11) NOT NULL,
  `course_auto_id` int(11) NOT NULL,
  `offer_teacher_id` int(11) NOT NULL,
  `section` varchar(4) NOT NULL,
  `year` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  `offer_dept` int(11) NOT NULL,
  PRIMARY KEY (`offer_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `tbl_course_offer`
--

INSERT INTO `tbl_course_offer` (`offer_auto_id`, `offer_semester`, `course_auto_id`, `offer_teacher_id`, `section`, `year`, `session`, `offer_dept`) VALUES
(124, 1, 3, 1101020001, 'A', '2015', 'Spring', 1),
(125, 1, 4, 1101020002, 'A', '2015', 'Spring', 1),
(126, 1, 3, 1101020001, 'B', '2015', 'Spring', 1),
(130, 1, 4, 1101020001, 'E', '2015', 'Spring', 1),
(131, 1, 4, 1101020002, 'D', '2015', 'Spring', 1),
(132, 2, 5, 0, 'C', '2015', 'Spring', 1),
(133, 12, 6, 10507, 'A', '2015', 'Spring', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_course_registration` (
  `reg_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_semester` int(11) NOT NULL,
  `reg_year` varchar(20) NOT NULL,
  `session` varchar(20) NOT NULL,
  `reg_main_course_list` text NOT NULL,
  `reg_retake_course_list` text NOT NULL,
  `active` int(11) NOT NULL,
  `reg_main_credit` double NOT NULL,
  `reg_retake_credit` double NOT NULL,
  `reg_total_credit` double NOT NULL,
  PRIMARY KEY (`reg_auto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department_info`
--

CREATE TABLE IF NOT EXISTS `tbl_department_info` (
  `dept_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `dept_short_name` varchar(10) NOT NULL,
  `dept_program_name` varchar(60) NOT NULL,
  PRIMARY KEY (`dept_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_department_info`
--

INSERT INTO `tbl_department_info` (`dept_auto_id`, `dept_name`, `dept_id`, `dept_short_name`, `dept_program_name`) VALUES
(10, 'Computer Science &amp; Engineering', 1, 'CSE', 'BSc In CSE'),
(11, 'Electrical &amp; Electronics Engineering', 2, 'EEE', 'Bsc in EEE'),
(12, 'Civil Engineering', 3, 'CIVIL', 'BSc In CIVIL'),
(13, 'Architecture Science &amp; Engineering', 4, 'ARCH', 'BSc In ARCH'),
(14, 'Buisness', 5, 'BBA', 'BBA'),
(17, 'Computer Science &amp; Engineering', 1, 'CSE', 'MSC in CSE'),
(23, 'Computer Science &amp; Engineering', 1, 'CSE', 'GSC'),
(24, 'Electrical &amp; Electronics Engineering', 2, 'EEE', 'sabbir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dept_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_dept_admin` (
  `dadmin_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `dadmin_name` varchar(20) NOT NULL,
  `dadmin_password` varchar(60) NOT NULL,
  `dadmin_dept` int(11) NOT NULL,
  PRIMARY KEY (`dadmin_auto_id`),
  UNIQUE KEY `dadmin_name` (`dadmin_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_dept_admin`
--

INSERT INTO `tbl_dept_admin` (`dadmin_auto_id`, `dadmin_name`, `dadmin_password`, `dadmin_dept`) VALUES
(1, 'admin', '123456', 1),
(2, 'admin1', '123456', 2),
(3, 'admin2', '123456', 3),
(4, 'admin4', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE IF NOT EXISTS `tbl_student_info` (
  `std_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `std_pic` varchar(255) NOT NULL,
  `std_dept` int(11) NOT NULL,
  `std_program` varchar(20) NOT NULL,
  `std_name` varchar(60) NOT NULL,
  `std_father_name` varchar(60) NOT NULL,
  `std_mother_name` varchar(60) NOT NULL,
  `std_guardian_name` varchar(60) NOT NULL,
  `std_permanent_address` varchar(100) NOT NULL,
  `std_present_address` varchar(100) NOT NULL,
  `std_contact_no` int(11) NOT NULL,
  `std_guardian_contact_no` int(11) NOT NULL,
  `std_birth_date` varchar(100) NOT NULL,
  `std_gender` text NOT NULL,
  `std_nationality` varchar(60) NOT NULL,
  `std_ssc_result` double NOT NULL,
  `std_hsc_result` double NOT NULL,
  `std_email` varchar(100) NOT NULL,
  `std_total_result` double NOT NULL,
  `std_active` int(11) NOT NULL,
  `std_batch` int(11) NOT NULL,
  `std_semester` int(11) NOT NULL,
  `std_section` varchar(5) NOT NULL,
  `std_waiver` int(11) NOT NULL,
  `std_math` text NOT NULL,
  `std_physics` text NOT NULL,
  `std_id` int(11) NOT NULL,
  `std_password` varchar(60) NOT NULL,
  `std_total_credit` double NOT NULL,
  `std_total_cgpa` double NOT NULL,
  `total_gradepoint` double NOT NULL,
  `std_old_id` int(11) NOT NULL,
  `std_required_credit` double NOT NULL,
  PRIMARY KEY (`std_auto_id`),
  UNIQUE KEY `std_id` (`std_id`),
  UNIQUE KEY `std_email` (`std_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`std_auto_id`, `std_pic`, `std_dept`, `std_program`, `std_name`, `std_father_name`, `std_mother_name`, `std_guardian_name`, `std_permanent_address`, `std_present_address`, `std_contact_no`, `std_guardian_contact_no`, `std_birth_date`, `std_gender`, `std_nationality`, `std_ssc_result`, `std_hsc_result`, `std_email`, `std_total_result`, `std_active`, `std_batch`, `std_semester`, `std_section`, `std_waiver`, `std_math`, `std_physics`, `std_id`, `std_password`, `std_total_credit`, `std_total_cgpa`, `total_gradepoint`, `std_old_id`, `std_required_credit`) VALUES
(5, '../img/ img1502164224.jpg', 1, 'MSC in CSE', 'Md.Muhibuzzaman Rimon', 'Late Md. Nurul Haque', 'Gulshan Ara Haque', 'Nai', 'Sylhet', 'Sylhet', 1673861112, 1673861112, '12/21/1991', 'Male', 'Bangladesh', 5, 4.75, 'rimon.ccnaa@gmail.com', 9.75, 0, 26, 1, '', 15, 'Yes', 'Yes', 1101020022, '123', 0, 0, 0, 0, 0),
(7, '../img/ img1502165334.jpg', 2, 'BSc In EEE', 'Abdullah Al Mamun', 'slkda', 'dsad', 'Nai', 'Sylhet', 'Sylhet', 178245678, 1763861112, '02/01/2015', 'female', 'Bangladesh', 4.19, 4.75, 'almsdasdamun@yahoo.com', 8.94, 1, 1, 2, '', 20, 'Yes', 'Yes', 1101020002, '123456', 0, 0, 0, 0, 0),
(8, '../img/ img1502153328.jpg', 1, 'BSc In CSE', 'Robert Brian', 'James Anderson', 'David Backham', 'Michael Angelo', 'Snigdha 32, Kamalbazar R/A, Sylhet.', 'Snigdha 32, Kamalbazar R/A, Sylhet.', 1712345678, 1555555555, '02/15/1968', 'Male', 'Bangladeshi', 5, 5, 'nightmare@yahu.com', 10, 1, 26, 1, '', 50, 'Yes', 'Yes', 1101020034, '123456', 0, 0, 0, 0, 0),
(9, '', 1, 'CSE', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, '', 0, 0, 0, 0, '', 25, '', '', 9, 'kallol', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_syllebus_info`
--

CREATE TABLE IF NOT EXISTS `tbl_syllebus_info` (
  `syllebus_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `syllebus_name` varchar(20) NOT NULL,
  `syllebus_dept` int(11) NOT NULL,
  `program_name` varchar(60) NOT NULL,
  `batch` int(11) NOT NULL,
  `course_auto_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`syllebus_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `tbl_syllebus_info`
--

INSERT INTO `tbl_syllebus_info` (`syllebus_auto_id`, `syllebus_name`, `syllebus_dept`, `program_name`, `batch`, `course_auto_id`, `semester`) VALUES
(55, 'Final_CSE', 1, 'BSc In CSE', 26, 3, 1),
(56, 'Final_CSE', 1, 'BSc In CSE', 26, 4, 1),
(57, 'Final_CSE', 1, 'BSc In CSE', 26, 5, 2),
(58, 'Final_CSE', 1, 'BSc In CSE', 26, 6, 2),
(59, 'Final_CSE', 1, 'BSc In CSE', 26, 7, 3),
(60, 'Final_CSE', 1, 'BSc In CSE', 26, 9, 3),
(61, 'kallol', 1, 'BSc In CSE', 26, 6, 12),
(62, 'kallol', 1, 'BSc In CSE', 26, 4, 12),
(63, 'kallol', 1, 'BSc In CSE', 26, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_info`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher_info` (
  `tch_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `tch_pic` varchar(255) NOT NULL,
  `tch_dept` int(11) NOT NULL,
  `tch_name` varchar(60) NOT NULL,
  `tch_father_name` varchar(60) NOT NULL,
  `tch_mother_name` varchar(60) NOT NULL,
  `tch_permanent_address` varchar(100) NOT NULL,
  `tch_present_address` varchar(100) NOT NULL,
  `tch_contact_no` int(11) NOT NULL,
  `tch_birth_date` varchar(60) NOT NULL,
  `tch_gender` text NOT NULL,
  `tch_nationality` varchar(60) NOT NULL,
  `tch_position` text NOT NULL,
  `tch_qualification` text NOT NULL,
  `tch_email` varchar(100) NOT NULL,
  `tch_id` int(11) NOT NULL,
  `tch_password` varchar(60) NOT NULL,
  PRIMARY KEY (`tch_auto_id`),
  UNIQUE KEY `tch_email` (`tch_email`,`tch_id`),
  UNIQUE KEY `tch_email_2` (`tch_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_teacher_info`
--

INSERT INTO `tbl_teacher_info` (`tch_auto_id`, `tch_pic`, `tch_dept`, `tch_name`, `tch_father_name`, `tch_mother_name`, `tch_permanent_address`, `tch_present_address`, `tch_contact_no`, `tch_birth_date`, `tch_gender`, `tch_nationality`, `tch_position`, `tch_qualification`, `tch_email`, `tch_id`, `tch_password`) VALUES
(15, '../img/ img1501062601.jpg', 1, 'Md.Asaduzzaman Khan', 'Janina', 'Janina', 'Dhaka', 'Sylhet', 171446688, '01/06/1984', 'Male', 'Bangladeshi', 'Assistant Professor', 'MSc in ETE', 'nippon@gmail.com', 1101020001, '123456'),
(16, '../img/ img1501062816.jpg', 1, 'Md.Arif Chy', 'janina', 'janina', 'sylhet', 'sylhet', 17884256, '01/12/2015', 'Male', 'Bangladeshi', 'Senior Lecturer', 'MSc in ETE', 'arif@gmail.com', 1101020002, '123456'),
(17, '../img/ img1502154212.jpg', 1, 'David Andrew Miller', 'Chris Gayle', 'Serena Williams', 'Snigdha 32, Kamalbazar R/A, Sylhet.', 'Snigdha 32, Kamalbazar R/A, Sylhet.', 1712345678, '02/15/1928', 'Male', 'Bangladeshi', 'Lecturer', 'M.Sc in IT', 'hihello@gimail.com', 10507, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `category` int(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fname`, `lname`, `email`, `category`) VALUES
('1101020024', 'a277d01396bb37aa98a453e46c01c0d3', 'Kallol', 'Das', 'kalloldas@gmail.com', 2),
('admin', '06e08a443adc3d240de8be4973075786', 'Admin', 'Admin', 'kalloldash@gmail.com', 1),
('MahbubAhmed', '4fdc74faccee0a5c55da095343fb841e', 'Mahbub', 'Ahmed', 'mahbubahmed@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--

CREATE TABLE IF NOT EXISTS `user_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` varchar(600) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_message`
--

INSERT INTO `user_message` (`id`, `user_id`, `admin_id`, `message`, `time`, `status`) VALUES
(2, 1101020022, 1234, 'Hello, Can you please return the economics book back ?', '2015-02-28 22:36:27', 2),
(4, 1101020034, 123, 'Our Library will be closed from tomorrow.', '2015-02-28 22:41:37', 2),
(9, 1101020022, 1234, 'Please Return the book Digital Image processing book.', '2015-03-02 07:55:18', 0),
(10, 1101020022, 1234, 'Testing the sent message :)', '2015-03-02 10:54:09', 0),
(12, 1101020022, 1234, 'Write down your message here.', '2015-03-02 11:09:09', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
