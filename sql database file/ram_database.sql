-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 07:53 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ram_database`
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
  `is_file` int(1) DEFAULT '0',
  `file_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `is_pending` int(1) DEFAULT '0',
  `st_mail` varchar(30) DEFAULT NULL,
  `st_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(16, NULL, NULL, 'teacher', NULL, NULL, NULL, NULL, 321);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_note`
--
ALTER TABLE `student_note`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_data`
--
ALTER TABLE `teacher_data`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
