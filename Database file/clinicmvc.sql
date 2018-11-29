-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2017 at 05:41 PM
-- Server version: 5.7.10-log
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicmvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutsite`
--

CREATE TABLE `aboutsite` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `aboutUs` text NOT NULL,
  `email` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `instagram` text NOT NULL,
  `logo` text NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `copyright` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutsite`
--

INSERT INTO `aboutsite` (`id`, `title`, `aboutUs`, `email`, `facebook`, `twitter`, `instagram`, `logo`, `telephone`, `address`, `copyright`) VALUES
(1, 'E-Clinic', 'E-Clinic Is Free Service For Our Dental Clinic , You Can Contact Us And Make Appointment With Us Through The Site , If That The First Time For You , You Must Register And Login , Then You Can Make Appointment , Thanks For Using Our Service1', 'ahmed@yahoo.com', 'ahmed@facebook.com', 'E-Clinic', 'ahmed@facebook.com', 'images/_1306logo.png', '01117418466', 'helwan 15 mayo', '2017  All Rights Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `startTime` varchar(10) NOT NULL,
  `endTime` varchar(10) NOT NULL,
  `dayTime` varchar(15) NOT NULL,
  `state` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `startTime`, `endTime`, `dayTime`, `state`, `doctorId`) VALUES
(2, '10:30', '10:40', 'Wednesday', 1, 18),
(3, '10:50', '11:30', 'Tuesday', 1, 18),
(4, '3:40', '4:00', 'Monday', 1, 18),
(5, '12:10', '12:30', 'Wednesday', 1, 16),
(6, '12:40', '12:50', 'Monday', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `appointmentId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `date`) VALUES
(3, 'Waleed Mohamed', 'waleed@waleed.com', 'please Improve Your Site That \'s good But There is The better .. Thank You', '2017-04-12 14:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `state` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `receiverId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message`, `receiverId`, `senderId`) VALUES
(2, 'Your Appointment : Day : Monday From : 3:40 To : 4:00With Dr : Tamer Ragb', 10, 18),
(3, 'Your Appointment : Day : Wednesday From : 10:30 To : 10:40With Dr : Tamer Ragb', 10, 18),
(5, 'Your Appointment { Day : Wednesday From : 12:10 To : 12:30 With Dr : mohamed karim }', 9, 16),
(6, 'Your Appointment { Day : Wednesday From : 12:10 To : 12:30 With Dr : mohamed karim }', 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `state`) VALUES
(19, 'Pages', 'managePage', 1),
(21, 'Clinic', 'clinic', 1),
(22, 'Sliders', 'manageSlider', 1),
(23, 'Users', 'manageUser', 1),
(26, 'Edit Profile', 'editProfile', 0),
(27, 'Appointments', 'manageAppointment', 1),
(28, 'Booking', 'manageReservation', 1),
(29, 'Schedule', 'manageSchedule', 1),
(30, 'Prescriptions', 'prescription', 1),
(31, 'Message', 'message', 0),
(32, 'adminController', 'adminController', 0),
(33, 'doctors', 'cast', 0),
(34, 'contact', 'contact', 0),
(35, 'Contact', 'manageContact', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagesusers`
--

CREATE TABLE `pagesusers` (
  `id` int(11) NOT NULL,
  `typeUserId` int(11) NOT NULL,
  `pagesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagesusers`
--

INSERT INTO `pagesusers` (`id`, `typeUserId`, `pagesId`) VALUES
(25, 1, 19),
(27, 1, 21),
(28, 1, 22),
(30, 1, 23),
(32, 1, 26),
(33, 2, 26),
(34, 3, 26),
(35, 2, 27),
(36, 3, 28),
(37, 2, 29),
(38, 3, 30),
(39, 1, 31),
(40, 2, 31),
(41, 3, 31),
(42, 1, 32),
(43, 1, 33),
(44, 2, 33),
(45, 3, 33),
(46, 1, 34),
(47, 2, 34),
(48, 3, 34),
(49, 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `prescription` text NOT NULL,
  `patientId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `prescription`, `patientId`, `doctorId`) VALUES
(2, 'hello', 10, 18),
(3, 'ok', 10, 18),
(5, 'Hello Mohamed Tamer', 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `slider` text NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slider`, `state`) VALUES
(2, 'images/sliders/_64dentist.png', 1),
(3, 'images/sliders/_269434411029.jpg', 1),
(4, 'images/sliders/_8201female-associate-dentist.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `typeuser`
--

CREATE TABLE `typeuser` (
  `id` int(11) NOT NULL,
  `typeUser` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeuser`
--

INSERT INTO `typeuser` (`id`, `typeUser`) VALUES
(1, 'admin'),
(2, 'doctor'),
(3, 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `gender`, `telephone`, `photo`, `username`, `password`, `state`, `type`) VALUES
(1, 'ahmed rabi', 'ahmedrabi2020@yahoo.com', 'male', '01068260112', 'images/users/_8375IMG-20170108-WA0000.jpg', 'admin', '111', 1, 1),
(9, 'mohamed tamer ahmed ', 'ahmedtamer@tamer.com', 'Female', '01117418466', 'images/users/profile.jpg', 'ahmedtamer', '111111', 1, 3),
(10, 'mohamed ahmed saleem', 'ahmed@mohamed.com', 'Female', '01117418466', 'images/users/_8050final.jpg', 'ahmedmohamed', '11111', 0, 3),
(12, 'mohamed ', 'a@a.com', 'Male', '01111111111', 'images/users/_9817new 7.jpg', 'mohamed', '111111', 1, 3),
(16, 'mohamed karim', 'ahmed@a.com', 'Male', '01117418466', 'images/users/_964217883659_856936914454281_6138622185954183632_n.jpg', 'mohameds', '11111', 1, 2),
(17, 'Ahmed Said', 'ahmed@a.com', 'Male', '01117418466', 'images/users/_2269pr.jpg', 'ahmedsaid', '11111', 1, 2),
(18, 'Tamer Ragb', 'tamer@tamer.com', 'Male', '01117418466', 'images/users/_371x1.jpg', 'tamer', '11111', 1, 2),
(19, 'Marwa Mahmoud', 'marwa@m.com', 'Female', '01117418466', 'images/users/_4848Doctors+and+Indonesian+Doctors+Oath+beautiful.png', 'marwa', '11111', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutsite`
--
ALTER TABLE `aboutsite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointmentId` (`appointmentId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiverId` (`receiverId`),
  ADD KEY `senderId` (`senderId`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagesusers`
--
ALTER TABLE `pagesusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeUserId` (`typeUserId`),
  ADD KEY `pagesId` (`pagesId`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeuser`
--
ALTER TABLE `typeuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutsite`
--
ALTER TABLE `aboutsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `pagesusers`
--
ALTER TABLE `pagesusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `typeuser`
--
ALTER TABLE `typeuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `users` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`appointmentId`) REFERENCES `appointment` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`);

--
-- Constraints for table `pagesusers`
--
ALTER TABLE `pagesusers`
  ADD CONSTRAINT `pagesusers_ibfk_1` FOREIGN KEY (`typeUserId`) REFERENCES `typeuser` (`id`),
  ADD CONSTRAINT `pagesusers_ibfk_2` FOREIGN KEY (`pagesId`) REFERENCES `pages` (`id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
