-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2020 at 08:40 PM
-- Server version: 10.2.32-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tazbinur_ram`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `name`, `pass`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

CREATE TABLE `course_teacher` (
  `id` int(11) NOT NULL,
  `teacher` varchar(30) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `course_number` varchar(50) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `series` int(2) DEFAULT NULL,
  `section` varchar(30) DEFAULT NULL,
  `dept_code` int(2) DEFAULT NULL,
  `start_roll` int(7) DEFAULT NULL,
  `end_roll` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_teacher`
--

INSERT INTO `course_teacher` (`id`, `teacher`, `teacher_id`, `course_number`, `dept`, `series`, `section`, `dept_code`, `start_roll`, `end_roll`) VALUES
(5, 'Imtiaz Ahmed', 21, 'ECE 3207', 'ECE', 16, 'A', 10, 1, 20),
(6, 'Imtiaz Ahmed', 21, 'ECE 4102', 'ECE', 16, 'B', 10, 10, 20);

-- --------------------------------------------------------

--
-- Table structure for table `dept_series`
--

CREATE TABLE `dept_series` (
  `dept` varchar(10) DEFAULT NULL,
  `dept_code` int(2) NOT NULL,
  `series_15` int(3) DEFAULT NULL,
  `series_16` int(3) DEFAULT NULL,
  `series_17` int(3) DEFAULT NULL,
  `series_18` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_series`
--

INSERT INTO `dept_series` (`dept`, `dept_code`, `series_15`, `series_16`, `series_17`, `series_18`) VALUES
('CE', 0, 120, 120, 120, 120),
('EEE', 1, 120, 120, 180, 180),
('ME', 2, 120, 120, 120, 120),
('CSE', 3, 120, 120, 180, 180),
('ETE', 4, 60, 60, 60, 60),
('IPE', 5, 120, 120, 120, 120),
('GCE', 6, 60, 60, 60, 60),
('URP', 7, 60, 60, 60, 60),
('MTE', 8, 60, 60, 60, 60),
('ARCH', 9, 30, 30, 30, 30),
('ECE', 10, 60, 60, 60, 60),
('CFPE', 11, 30, 30, 30, 30),
('BECM', 12, 30, 30, 30, 30),
('MSE', 13, 30, 30, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `text` varchar(3000) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date`) VALUES
(1, 'RAM is ready to go!', 'RAM - Ruet Academic Media is a digitalized academic management system for RUET. It is designed to co-operate all departmental stuff of all department & series of RUET. It will act as a media between teachers & students for academic issue. Tazbinur Rahaman from ECE department developed the system under supervision of Abdul Matin Muaz, Lecturer, ECE as a 4th semester project. This system is ready for it\'s test trial. Soon it will be realized for practical use. User suggestion & experience will help us to make it more useful. ', 'Fri, 17 May 2019 - 11:30 pm'),
(5, 'Technocrcay again!', 'Technocracy - 2019 is coming this June! Department of ECE, RUET once again on the way to bring it back again. This time they are going NATIONAL level. All students from all part of the country are open to participate in total 6 segments. Registration is open, get you team and mark the target. Visit tech.ece-ruet.com for more.', 'Fri, 17 May 2019 - 11:50 pm');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_date` varchar(30) DEFAULT NULL,
  `notice_subject` varchar(300) DEFAULT NULL,
  `notice_text` varchar(1024) DEFAULT NULL,
  `sender` varchar(30) DEFAULT NULL,
  `receiver` varchar(2) DEFAULT NULL,
  `is_file` int(1) DEFAULT 0,
  `file_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_date`, `notice_subject`, `notice_text`, `sender`, `receiver`, `is_file`, `file_name`) VALUES
(5, 'Sun, 21 Jun 2020 - 08:26 pm', 'Assignment alert!', 'Dear students, your assignment is to solve all programming problems of chapter 1. For better understanding, check the attached document.', 't@gmail.com', '5', 1, 'programming_problem.png'),
(6, 'Sun, 21 Jun 2020 - 08:36 pm', 'Designing ROM', 'Design a 64x8 ROM architecture & submit. For example, find the attachment, please.', 't@gmail.com', '6', 1, 'Rom design.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_num` int(11) NOT NULL,
  `report_date` date DEFAULT NULL,
  `report_text` varchar(512) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_mail` varchar(30) DEFAULT NULL,
  `user_phone` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `st_roll` int(10) NOT NULL,
  `st_name` varchar(40) DEFAULT NULL,
  `st_pass` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'student',
  `st_series` int(2) DEFAULT NULL,
  `st_dept` varchar(10) DEFAULT NULL,
  `is_pending` int(1) DEFAULT 0,
  `st_mail` varchar(30) DEFAULT NULL,
  `st_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`st_roll`, `st_name`, `st_pass`, `status`, `st_series`, `st_dept`, `is_pending`, `st_mail`, `st_phone`) VALUES
(1510010, 'Tanvir Ahmed', '202cb962ac59075b964b07152d234b70', 'student', 15, 'ECE', 0, 'tanvir@gmail.com', '01728091199'),
(1610010, 'Md Tazbinur Rahaman', '202cb962ac59075b964b07152d234b70', 'student', 16, 'ECE', 0, 't@gmail.com', '01728091199');

-- --------------------------------------------------------

--
-- Table structure for table `student_note`
--

CREATE TABLE `student_note` (
  `id` int(225) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `roll` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_note`
--

INSERT INTO `student_note` (`id`, `title`, `text`, `date`, `roll`) VALUES
(2, 'Assignment', 'Programming assignment must be submitted withint tomorrow.', 'Sun, 21 Jun 2020 - 01:28 am', 1610010);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_data`
--

CREATE TABLE `teacher_data` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(30) DEFAULT NULL,
  `teacher_pass` varchar(50) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'teacher',
  `teacher_designation` varchar(30) DEFAULT NULL,
  `teacher_dept` varchar(100) DEFAULT NULL,
  `teacher_mail` varchar(30) DEFAULT NULL,
  `teacher_phone` varchar(15) DEFAULT NULL,
  `teacher_code` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_data`
--

INSERT INTO `teacher_data` (`teacher_id`, `teacher_name`, `teacher_pass`, `status`, `teacher_designation`, `teacher_dept`, `teacher_mail`, `teacher_phone`, `teacher_code`) VALUES
(18, NULL, NULL, 'teacher', NULL, NULL, NULL, NULL, 321),
(21, 'Imtiaz Ahmed', '202cb962ac59075b964b07152d234b70', 'teacher', 'Lecturer', 'ECE', 't@gmail.com', '01728091199', 321);

-- --------------------------------------------------------

--
-- Table structure for table `_5`
--

CREATE TABLE `_5` (
  `roll` int(10) DEFAULT NULL,
  `tot_day` int(5) DEFAULT 0,
  `att_day` int(5) DEFAULT 0,
  `ct_1` int(2) DEFAULT NULL,
  `ct_2` int(2) DEFAULT NULL,
  `ct_3` int(2) DEFAULT NULL,
  `ct_4` int(2) DEFAULT NULL,
  `last_date` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_5`
--

INSERT INTO `_5` (`roll`, `tot_day`, `att_day`, `ct_1`, `ct_2`, `ct_3`, `ct_4`, `last_date`) VALUES
(1610001, 4, 3, 5, 5, 2, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610002, 4, 3, 6, 6, 5, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610003, 4, 3, 5, 4, 4, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610004, 4, 3, 6, 5, 7, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610005, 4, 3, 4, 2, 8, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610006, 4, 3, 5, 1, 9, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610007, 4, 3, 2, 4, 6, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610008, 4, 3, 1, 5, 3, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610009, 4, 4, 2, 6, 5, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610010, 4, 3, 3, 9, 18, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610011, 4, 4, 6, 8, 10, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610012, 4, 3, 5, 7, 2, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610013, 4, 4, 4, 4, 5, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610014, 4, 3, 7, 1, 6, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610015, 4, 3, 9, 2, 9, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610016, 4, 3, 6, 3, 8, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610017, 4, 4, 5, 0, 7, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610018, 4, 4, 4, 1, 4, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610019, 4, 3, 5, 2, 5, NULL, 'Sun, 21 Jun 2020 - 08:29 pm'),
(1610020, 4, 3, 2, 5, 6, NULL, 'Sun, 21 Jun 2020 - 08:29 pm');

-- --------------------------------------------------------

--
-- Table structure for table `_6`
--

CREATE TABLE `_6` (
  `roll` int(10) DEFAULT NULL,
  `tot_day` int(5) DEFAULT 0,
  `att_day` int(5) DEFAULT 0,
  `ct_1` int(2) DEFAULT NULL,
  `ct_2` int(2) DEFAULT NULL,
  `ct_3` int(2) DEFAULT NULL,
  `ct_4` int(2) DEFAULT NULL,
  `last_date` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_6`
--

INSERT INTO `_6` (`roll`, `tot_day`, `att_day`, `ct_1`, `ct_2`, `ct_3`, `ct_4`, `last_date`) VALUES
(1610010, 2, 1, 5, 5, 10, 18, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610011, 2, 1, 6, 6, 2, 5, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610012, 2, 2, 5, 9, 5, 6, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610013, 2, 1, 5, 7, 5, 2, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610014, 2, 1, 6, 4, 8, 1, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610015, 2, 2, 4, 5, 9, 4, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610016, 2, 2, 5, 6, 6, 5, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610017, 2, 1, 8, 3, 5, 8, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610018, 2, 1, 7, 2, 2, 7, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610019, 2, 2, 9, 1, 3, 9, 'Sun, 21 Jun 2020 - 08:37 pm'),
(1610020, 2, 2, 6, 5, 5, 6, 'Sun, 21 Jun 2020 - 08:37 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_series`
--
ALTER TABLE `dept_series`
  ADD PRIMARY KEY (`dept_code`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_num`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`st_roll`);

--
-- Indexes for table `student_note`
--
ALTER TABLE `student_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_data`
--
ALTER TABLE `teacher_data`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_teacher`
--
ALTER TABLE `course_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_note`
--
ALTER TABLE `student_note`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_data`
--
ALTER TABLE `teacher_data`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
