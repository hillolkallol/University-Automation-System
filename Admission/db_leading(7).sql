-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2014 at 10:22 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

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
  `course_credit` int(11) NOT NULL,
  `course_dept` int(11) NOT NULL,
  `course_prerequisite` int(11) NOT NULL,
  PRIMARY KEY (`course_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_course_info`
--

INSERT INTO `tbl_course_info` (`course_auto_id`, `course_code`, `course_name`, `course_credit`, `course_dept`, `course_prerequisite`) VALUES
(3, 'CSE-1111', 'Introduction To Computer', 3, 1, 0),
(4, 'CSE-1112', 'Intoduction To Computer : Sessional', 1, 1, 0),
(5, 'CSE-2222', 'Introduction To C', 2, 1, 0),
(6, 'CSE-2223', 'Introduction To C++', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_course_offer` (
  `offer_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_semester` int(11) NOT NULL,
  `course_auto_id` int(11) NOT NULL,
  `offer_teacher_id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  PRIMARY KEY (`offer_auto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_course_registration` (
  `reg_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `reg_year` varchar(20) NOT NULL,
  `session` varchar(20) NOT NULL,
  `reg_course_list` text NOT NULL,
  `active` int(11) NOT NULL,
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
  PRIMARY KEY (`dept_auto_id`),
  UNIQUE KEY `dept_id` (`dept_id`,`dept_short_name`),
  UNIQUE KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_department_info`
--

INSERT INTO `tbl_department_info` (`dept_auto_id`, `dept_name`, `dept_id`, `dept_short_name`, `dept_program_name`) VALUES
(10, 'Computer Science &amp; Engineering', 1, 'CSE', 'BSc In CSE'),
(11, 'Electrical &amp; Electronics Engineering', 2, 'EEE', 'Bsc in EEE'),
(12, 'Civil Engineering', 3, 'CIVIL', 'BSc In CIVIL'),
(13, 'Architecture Science &amp; Engineering', 4, 'ARCH', 'BSc In ARCH'),
(14, 'Buisness', 5, 'BBA', 'BBA');

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
  `std_program` int(11) NOT NULL,
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
  `std_starting_date` varchar(60) NOT NULL,
  `std_waiver` int(11) NOT NULL,
  `std_math` text NOT NULL,
  `std_physics` text NOT NULL,
  `std_id` int(11) NOT NULL,
  `std_password` varchar(60) NOT NULL,
  PRIMARY KEY (`std_auto_id`),
  UNIQUE KEY `std_id` (`std_id`),
  UNIQUE KEY `std_email` (`std_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`std_auto_id`, `std_pic`, `std_dept`, `std_program`, `std_name`, `std_father_name`, `std_mother_name`, `std_guardian_name`, `std_permanent_address`, `std_present_address`, `std_contact_no`, `std_guardian_contact_no`, `std_birth_date`, `std_gender`, `std_nationality`, `std_ssc_result`, `std_hsc_result`, `std_email`, `std_total_result`, `std_active`, `std_batch`, `std_semester`, `std_starting_date`, `std_waiver`, `std_math`, `std_physics`, `std_id`, `std_password`) VALUES
(1, '../img/ img1412071836.jpg', 1, 1, 'Md.Muhibuzzaman Rimon', 'Late Md. Nurul Haque', 'Gulshan Ara Haque', 'Nai', 'Sylhet', 'Sylhet', 1673861112, 1673861112, '12/21/1991', 'Male', 'Bangladesh', 4.19, 3.9, 'rimon_tea@gmail.com', 8.09, 1, 26, 1, '', 20, 'Yes', 'Yes', 1101020009, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_syllebus_info`
--

CREATE TABLE IF NOT EXISTS `tbl_syllebus_info` (
  `syllebus_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `syllebus_name` varchar(20) NOT NULL,
  `course_auto_id` text NOT NULL,
  `syllebus_Dept` int(11) NOT NULL,
  PRIMARY KEY (`syllebus_auto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_syllebus_info`
--

INSERT INTO `tbl_syllebus_info` (`syllebus_auto_id`, `syllebus_name`, `course_auto_id`, `syllebus_Dept`) VALUES
(3, 'Spring-14 CSE', '3,4,5,6', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_teacher_info`
--

INSERT INTO `tbl_teacher_info` (`tch_auto_id`, `tch_pic`, `tch_dept`, `tch_name`, `tch_father_name`, `tch_mother_name`, `tch_permanent_address`, `tch_present_address`, `tch_contact_no`, `tch_birth_date`, `tch_gender`, `tch_nationality`, `tch_position`, `tch_qualification`, `tch_email`, `tch_id`, `tch_password`) VALUES
(13, '../img/ img1412145923.jpg', 3, 'Keshob Chokroborti', 'Janina', 'Janina', 'Sylhet', 'Sylhet', 171245678, '12/07/2014', 'Male', 'Bangladesh', 'Lecturer', 'Nai', 'keshobk@gmail.com', 1201020002, '123456'),
(14, '../img/ img1412074510.jpg', 1, 'Md.Muhibuzzaman Rimon', 'Late Md. Nurul Haque', 'Gulshan Ara Haque', 'Sylhet', 'Sylhet', 1673861112, '12/21/2014', 'Male', 'Bangladesh', 'Lecturer', 'Nai', 'rimon.ccnaa@gmail.com', 1101020001, '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
