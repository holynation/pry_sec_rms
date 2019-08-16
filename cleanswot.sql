-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 05:02 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleanswot`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_session`
--

CREATE TABLE `academic_session` (
  `ID` int(11) NOT NULL,
  `session_name` varchar(150) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_session`
--

INSERT INTO `academic_session` (`ID`, `session_name`, `start_date`, `end_date`, `status`) VALUES
(1, '1948/1949', '1948-09-16', '1949-05-25', 0),
(2, '1949/1950', '1949-09-16', '1950-05-25', 0),
(3, '1950/1951', '1950-09-16', '1951-05-25', 0),
(4, '1951/1952', '1951-09-16', '1952-05-24', 0),
(5, '1952/1953', '1952-09-17', '1953-05-25', 0),
(6, '1953/1954', '1953-09-16', '1954-05-25', 0),
(7, '1954/1955', '1954-09-16', '1955-05-25', 0),
(8, '1955/1956', '1955-09-17', '1956-05-25', 0),
(9, '1956/1957', '1956-09-16', '1957-05-25', 0),
(10, '1957/1958', '1957-09-16', '1958-05-25', 0),
(11, '1958/1959', '1958-09-17', '1959-05-25', 0),
(12, '1959/1960', '1959-09-16', '1960-05-26', 0),
(13, '1960/1961', '1960-09-17', '1961-05-25', 0),
(14, '1961/1962', '1961-09-17', '1962-05-26', 0),
(15, '1962/1963', '1962-09-18', '1963-05-24', 0),
(16, '1963/1964', '1963-09-16', '1964-05-25', 0),
(17, '1964/1965', '1964-09-17', '1965-05-25', 0),
(18, '1965/1966', '1965-09-17', '1966-05-24', 0),
(19, '1966/1967', '1966-09-16', '1967-05-25', 0),
(20, '1967/1968', '1967-09-17', '1968-05-25', 0),
(21, '1968/1969', '1968-09-16', '1969-05-25', 0),
(22, '1969/1970', '1969-09-16', '1970-05-25', 0),
(23, '1970/1971', '1970-09-16', '1971-05-25', 0),
(24, '1971/1972', '1971-09-16', '1972-05-26', 0),
(25, '1972/1973', '1972-09-16', '1973-05-23', 0),
(26, '1973/1974', '1973-09-16', '1974-05-24', 0),
(27, '1974/1975', '1974-09-16', '1975-05-24', 0),
(28, '1975/1976', '1975-09-16', '1976-05-25', 0),
(29, '1976/1977', '1976-09-17', '1977-05-24', 0),
(30, '1977/1978', '1977-09-16', '1978-05-24', 0),
(31, '1978/1979', '1978-09-16', '1979-05-24', 0),
(32, '1979/1980', '1979-09-16', '1980-05-24', 0),
(33, '1980/1981', '1980-09-16', '1981-05-24', 0),
(34, '1981/1982', '1981-09-17', '1982-05-24', 0),
(35, '1982/1983', '1982-09-16', '1983-05-24', 0),
(36, '1983/1984', '1983-09-16', '1984-05-25', 0),
(37, '1984/1985', '1984-09-16', '1985-05-24', 0),
(38, '1985/1986', '1985-09-16', '1986-05-24', 0),
(39, '1986/1987', '1986-09-16', '1987-05-25', 0),
(40, '1987/1988', '1987-09-16', '1988-05-24', 0),
(41, '1988/1989', '1988-09-17', '1989-05-24', 0),
(42, '1989/1990', '1989-09-16', '1990-05-25', 0),
(43, '1990/1991', '1990-09-16', '1991-05-25', 0),
(44, '1991/1992', '1991-09-16', '1992-05-25', 0),
(45, '1992/1993', '1992-09-18', '1993-05-25', 0),
(46, '1993/1994', '1993-09-16', '1994-05-24', 0),
(47, '1994/1995', '1994-09-16', '1995-05-24', 0),
(48, '1995/1996', '1995-09-16', '1996-05-24', 0),
(49, '1996/1997', '1996-09-16', '1997-05-25', 0),
(50, '1997/1998', '1997-09-16', '1998-05-24', 0),
(51, '1998/1999', '1998-09-17', '1999-05-25', 0),
(52, '1999/2000', '1999-09-16', '2000-05-25', 0),
(53, '2000/2001', '2000-09-16', '2001-05-25', 0),
(54, '2001/2002', '2001-09-16', '2002-05-25', 0),
(55, '2002/2003', '2002-09-17', '2003-05-26', 0),
(56, '2003/2004', '2003-09-17', '2004-05-25', 0),
(57, '2004/2005', '2004-09-16', '2005-05-25', 0),
(58, '2005/2006', '2005-09-16', '2006-05-24', 0),
(59, '2006/2007', '2006-09-17', '2007-05-25', 0),
(60, '2007/2008', '2007-09-16', '2008-05-25', 0),
(61, '2008/2009', '2008-09-16', '2009-05-25', 0),
(62, '2009/2010', '2009-09-16', '2010-05-25', 0),
(63, '2010/2011', '2010-09-17', '2011-05-25', 0),
(64, '2011/2012', '2011-09-16', '2012-05-25', 0),
(65, '2012/2013', '2012-09-16', '2013-05-26', 0),
(66, '2013/2014', '2013-09-17', '2014-05-25', 0),
(67, '2014/2015', '2014-09-16', '2015-05-25', 0),
(68, '2015/2016', '2015-09-16', '2016-05-26', 0),
(69, '2016/2017', '2016-09-17', '2017-05-25', 0),
(70, '2017/2018', '2017-04-23', '2018-02-22', 0),
(71, '2018/2019', '2018-04-23', '2019-06-20', 1),
(72, '2019/2020', '2020-04-23', '2021-06-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `img_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `firstname`, `middlename`, `lastname`, `email`, `phone_number`, `address`, `dob`, `role_id`, `status`, `img_path`) VALUES
(1, 'Holynation', '', 'Development', 'holynationdevelopment@gmail.com', '', '', '0000-00-00', 1, 1, 'uploads/admin/profile_pictures/1_5ce7db1429bce_2019-05-24.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `configure_report`
--

CREATE TABLE `configure_report` (
  `ID` int(11) NOT NULL,
  `student_biodata_id` int(11) NOT NULL,
  `academic_session_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `school_class_id` int(11) NOT NULL,
  `times_school_open` int(11) NOT NULL,
  `time_present` int(11) NOT NULL,
  `teacher_comment` text NOT NULL,
  `head_teacher_comment` text NOT NULL,
  `next_term_begins` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entry_mode`
--

CREATE TABLE `entry_mode` (
  `ID` int(11) NOT NULL,
  `mode_of_entry` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `school_class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry_mode`
--

INSERT INTO `entry_mode` (`ID`, `mode_of_entry`, `description`, `school_class_id`) VALUES
(1, 'Nursery Beginners I', 'This is the enrty mode for Nursery I class student', 1),
(2, 'Primary Beginners 1', 'This is the enrty mode for Primary 1 class student', 4),
(4, 'Nursery Beginners II', 'This is the enrty mode for Nursery II class student', 2),
(5, 'Nursery Beginners III', 'This is the enrty mode for Nursery III class student', 3),
(6, 'Primary Beginners 2', 'This is the enrty mode for Primary 2 class student', 5),
(7, 'Primary Beginners 3', 'This is the enrty mode for Primary 3 class student', 6),
(8, 'Primary Beginners 4', 'This is the enrty mode for Primary 4 class student', 7),
(9, 'Primary Beginners 5', 'This is the enrty mode for Primary 5 class student', 8),
(10, 'Senior Beginner 1', 'This is the enty mode for Senior 1 class student', 9),
(11, 'Senior Beginner 2', 'This is the entry mode for Senior 2 class student', 10),
(12, 'Senior Beginner 3', 'This is the entry mode for Senior 3 class student', 11);

-- --------------------------------------------------------

--
-- Table structure for table `grade_scale`
--

CREATE TABLE `grade_scale` (
  `ID` int(11) NOT NULL,
  `min_score` float NOT NULL,
  `max_score` float NOT NULL,
  `grade` varchar(10) NOT NULL,
  `point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_scale`
--

INSERT INTO `grade_scale` (`ID`, `min_score`, `max_score`, `grade`, `point`) VALUES
(1, 0, 44, 'E', 1),
(2, 45, 49, 'D', 2),
(3, 50, 59, 'C', 3),
(4, 60, 69, 'B', 4),
(5, 70, 100, 'A', 5);

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `ID` int(11) NOT NULL,
  `student_biodata_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_num` varchar(18) NOT NULL,
  `address` text,
  `img_path` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `ID` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `permission` enum('r','w') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`ID`, `role_id`, `path`, `permission`) VALUES
(1, 1, 'vc/admin/dashboard', 'w'),
(2, 1, 'vc/admin/profile', 'w'),
(3, 1, 'vc/add/student_biodata', 'w'),
(4, 1, 'vc/add/admin', 'w'),
(5, 1, 'vc/add/role', 'w'),
(6, 1, 'vc/admin/school', 'w'),
(7, 1, 'vc/add/academic_session', 'w'),
(8, 1, 'vc/add/term', 'w'),
(9, 1, 'vc/add/school_class', 'w'),
(10, 1, 'vc/add/subject', 'w'),
(11, 1, 'vc/add/grade_scale', 'w'),
(12, 1, 'vc/admin/upload_result', 'w'),
(13, 1, 'vc/admin/view_result', 'w'),
(14, 1, 'vc/admin/upload_history', 'w'),
(15, 1, 'vc/admin/student_result', 'w'),
(2258, 1, 'vc/add/session_term', 'w'),
(4957, 1, 'vc/add/entry_mode', 'w'),
(7241, 1, 'vc/admin/student_registration', 'w'),
(7243, 1, 'vc/admin/result_option', 'w'),
(7297, 1, 'vc/admin/', 'w'),
(7370, 1, 'vc/add/configure_report', 'w'),
(7430, 1, 'vc/add/signature', 'w'),
(8522, 1, 'vc/admin/signature', 'w'),
(8527, 1, 'vc/add/guardian', 'w'),
(8535, 1, 'vc/add/title', 'w');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `role_title` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `role_title`, `status`) VALUES
(1, 'superadmin', 1),
(2, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `ID` int(11) NOT NULL,
  `school_name` varchar(150) DEFAULT NULL,
  `school_report_first_header` varchar(150) NOT NULL,
  `school_report_second_header` varchar(150) NOT NULL,
  `school_logo` varchar(150) DEFAULT NULL,
  `slogan` text,
  `location` text,
  `description` text,
  `school_website` varchar(200) DEFAULT NULL,
  `school_mail` varchar(200) DEFAULT NULL,
  `telephone1` varchar(20) NOT NULL,
  `telephone2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`ID`, `school_name`, `school_report_first_header`, `school_report_second_header`, `school_logo`, `slogan`, `location`, `description`, `school_website`, `school_mail`, `telephone1`, `telephone2`) VALUES
(1, 'Swot Charter College', 'swot', 'charter school', 'uploads/school/1_5ce6c13c0672e_2019-05-23.png', 'The only school in the city', 'No. 1 Benin City road, Adjacent Kaduna Road, Adewale, Ilorin, Kware State', 'This is a native style in new brand from a good texture', 'swotcharterschool.com', 'swotcharter@gmail.com', '09032410000', '07060720000');

-- --------------------------------------------------------

--
-- Table structure for table `school_class`
--

CREATE TABLE `school_class` (
  `ID` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `class_order` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_class`
--

INSERT INTO `school_class` (`ID`, `class_name`, `description`, `class_order`, `date_created`) VALUES
(1, 'Nursery I', '', 1, '2019-05-20 14:37:51'),
(2, 'Nursery II', '', 2, '2019-05-20 14:37:54'),
(3, 'Nursery III', '', 3, '2019-05-20 14:37:57'),
(4, 'Primary 1', '', 4, '2019-05-20 14:37:59'),
(5, 'Primary 2', '', 5, '2019-05-20 14:38:02'),
(6, 'Primary 3', '', 6, '2019-05-20 14:38:05'),
(7, 'Primary 4', '', 7, '2019-05-20 14:38:08'),
(8, 'Primary 5', '', 8, '2019-05-20 14:38:10'),
(9, 'SS 1', 'This is for Senior 1 class student', 9, '2019-08-15 01:36:22'),
(10, 'SS 2', 'This is for Senior 2 class student', 10, '2019-08-15 01:36:29'),
(11, 'SS 3', 'This is for Senior 3 class student', 11, '2019-08-15 01:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `session_term`
--

CREATE TABLE `session_term` (
  `ID` int(11) NOT NULL,
  `academic_session_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_term`
--

INSERT INTO `session_term` (`ID`, `academic_session_id`, `term_id`, `status`) VALUES
(1, 71, 1, 1),
(2, 71, 2, 1),
(3, 71, 3, 1),
(4, 72, 1, 1),
(5, 72, 2, 1),
(6, 72, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `ID` int(11) NOT NULL,
  `path` varchar(250) NOT NULL,
  `fullname` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_biodata`
--

CREATE TABLE `student_biodata` (
  `ID` int(11) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `middlename` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` text,
  `phone_number` text,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `state_of_origin` varchar(150) DEFAULT NULL,
  `lga_of_origin` varchar(150) DEFAULT NULL,
  `registration_number` varchar(150) DEFAULT NULL,
  `school_class_id` int(11) NOT NULL,
  `entry_mode_id` int(11) NOT NULL,
  `academic_session_id` int(11) NOT NULL,
  `img_path` varchar(150) DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `religion` enum('Christianity','Islam','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_session_history`
--

CREATE TABLE `student_session_history` (
  `ID` int(11) NOT NULL,
  `school_class_id` int(11) NOT NULL,
  `academic_session_id` int(11) NOT NULL,
  `student_biodata_id` int(11) NOT NULL,
  `data_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_registration`
--

CREATE TABLE `student_subject_registration` (
  `ID` int(11) NOT NULL,
  `student_biodata_id` int(11) NOT NULL,
  `school_class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `session_term_id` int(11) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `academic_session_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `ID` int(11) NOT NULL,
  `subject_title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`ID`, `subject_title`) VALUES
(6, 'Agric. Science'),
(5, 'Basic Science'),
(13, 'Computer Studies'),
(11, 'Creative Arts/Colouring'),
(1, 'English Language'),
(15, 'French'),
(17, 'Handwriting'),
(12, 'IRS/CRS'),
(3, 'Literacy SWOT'),
(2, 'Mathematics'),
(16, 'Music'),
(14, 'Nursery Rhymes'),
(9, 'Phonics/Phonetics'),
(7, 'Quantitative Reasoning'),
(4, 'Social Studies'),
(8, 'Verbal Reasoning'),
(10, 'Yoruba Language');

-- --------------------------------------------------------

--
-- Table structure for table `subject_score`
--

CREATE TABLE `subject_score` (
  `ID` int(11) NOT NULL,
  `ca_score1` double DEFAULT NULL,
  `ca_score2` double DEFAULT NULL,
  `ca_total` int(11) NOT NULL,
  `exam_score` double NOT NULL,
  `score` float NOT NULL,
  `student_subject_registration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `ID` int(11) NOT NULL,
  `term_name` varchar(100) NOT NULL,
  `is_last` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`ID`, `term_name`, `is_last`) VALUES
(1, 'First', 0),
(2, 'Second', 0),
(3, 'Third', 1);

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `ID` int(11) NOT NULL,
  `title_name` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`ID`, `title_name`, `status`) VALUES
(1, 'Mr.', 1),
(2, 'Mrs.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload_history`
--

CREATE TABLE `upload_history` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'approved by',
  `academic_session_id` int(11) NOT NULL,
  `session_term_id` int(11) NOT NULL,
  `school_class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_table_id` int(11) NOT NULL,
  `token` text,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_logout` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `user_type`, `user_table_id`, `token`, `last_login`, `last_logout`, `date_created`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, NULL, '2019-05-28 11:59:11', NULL, '2019-05-17 21:10:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_session`
--
ALTER TABLE `academic_session`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `session_name` (`session_name`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `configure_report`
--
ALTER TABLE `configure_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `entry_mode`
--
ALTER TABLE `entry_mode`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `mode_of_entry` (`mode_of_entry`);

--
-- Indexes for table `grade_scale`
--
ALTER TABLE `grade_scale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_biodata_id` (`student_biodata_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_id` (`role_id`,`path`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_title` (`role_title`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `school_class`
--
ALTER TABLE `school_class`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `session_term`
--
ALTER TABLE `session_term`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `academic_session_id` (`academic_session_id`,`term_id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_biodata`
--
ALTER TABLE `student_biodata`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `registration_number` (`registration_number`);

--
-- Indexes for table `student_session_history`
--
ALTER TABLE `student_session_history`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_biodata_id` (`student_biodata_id`,`academic_session_id`);

--
-- Indexes for table `student_subject_registration`
--
ALTER TABLE `student_subject_registration`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_biodata_id` (`student_biodata_id`,`session_term_id`,`academic_session_id`,`term_id`,`subject_id`) USING BTREE;

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `subject_title` (`subject_title`);

--
-- Indexes for table `subject_score`
--
ALTER TABLE `subject_score`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `term_name` (`term_name`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `upload_history`
--
ALTER TABLE `upload_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_session`
--
ALTER TABLE `academic_session`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configure_report`
--
ALTER TABLE `configure_report`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entry_mode`
--
ALTER TABLE `entry_mode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grade_scale`
--
ALTER TABLE `grade_scale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25671;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_class`
--
ALTER TABLE `school_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `session_term`
--
ALTER TABLE `session_term`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_biodata`
--
ALTER TABLE `student_biodata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_session_history`
--
ALTER TABLE `student_session_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subject_registration`
--
ALTER TABLE `student_subject_registration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject_score`
--
ALTER TABLE `subject_score`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_history`
--
ALTER TABLE `upload_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
