-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 05:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `scheduleview` ()   BEGIN
      DECLARE done INT DEFAULT FALSE;
      DECLARE s_id,r_id,b_id,c_id,d_id INT;
      DECLARE strt,stp TIME;
      DECLARE cur CURSOR FOR SELECT * FROM schedule;
      DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

      OPEN cur;

      read_loop: LOOP
        FETCH cur INTO s_id,r_id,strt,stp,b_id,c_id,d_id;
        IF done THEN
          LEAVE read_loop;
        END IF;
        -- Do something with the row fetched
        SELECT s_id,r_id,strt,stp,b_id,c_id,d_id;

      END LOOP;

      CLOSE cur;
    END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getfare` (`tid` INT) RETURNS INT(11)  BEGIN
                    DECLARE rid INT;
                    DECLARE dist INT;
                    DECLARE diff INT;
                    DECLARE num INT;
                    SET diff = tid%100-((tid/100)%100);
                
                    SET rid = tid / 10000;
                
                    SELECT distance INTO dist FROM route WHERE route_id = rid;
                    SELECT no_of_stops INTO num FROM route WHERE route_id = rid;
                    RETURN dist * 5*diff/num;
                END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `gettickid` (`src` INT, `dst` INT) RETURNS INT(11)  BEGIN
                    DECLARE last_two_digits INT;
                    SET last_two_digits = dst % 100;
                
                    IF last_two_digits < 10 THEN
                        RETURN CONCAT(src, '0', last_two_digits);
                    ELSE
                        RETURN CONCAT(src, last_two_digits);
                    END IF;
                END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(4) NOT NULL,
  `bus_name` varchar(25) NOT NULL,
  `model` varchar(25) NOT NULL,
  `capacity` int(3) NOT NULL,
  `ownership` varchar(25) NOT NULL DEFAULT 'public',
  `depot_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `model`, `capacity`, `ownership`, `depot_id`) VALUES
(101, 'Mahakali', 'x450', 50, 'private', 1),
(102, 'KSRTC', 's550', 45, 'public', 3),
(103, 'Ganesh', 'c720', 35, 'private', 3),
(104, 'Durgamba', 't880', 60, 'private', 2),
(105, 'Anand Travels', 'e600', 55, 'private', 4),
(106, 'KSRTC', 's551', 45, 'public', 4),
(107, 'Karavali', 'r700', 50, 'private', 1),
(108, 'Ambari', 'm660', 60, 'public', 2),
(109, 'Bharath', 'c520', 40, 'private', 3),
(110, 'APM', 's770', 60, 'public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `depot`
--

CREATE TABLE `depot` (
  `depot_id` int(4) NOT NULL,
  `depot_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `depot`
--

INSERT INTO `depot` (`depot_id`, `depot_name`) VALUES
(1, 'Udupi'),
(2, 'Hebri'),
(3, 'Katpady'),
(4, 'Kundapura');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(4) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `type` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL DEFAULT 'male',
  `license_number` varchar(25) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `salary` decimal(10,2) NOT NULL DEFAULT 10000.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `first_name`, `last_name`, `dob`, `type`, `gender`, `license_number`, `phone_no`, `salary`) VALUES
(5001, 'Arjun', 'Nair', '1990-05-15', 'driver', 'male', 'KA78958798', '9876543210', 25000.00),
(5002, 'Vikram', 'Nayak', '1985-09-20', 'driver', 'male', 'KA58486523', '9012345678', 28000.00),
(5003, 'Rajesh', 'Shenoy', '1988-12-10', 'driver', 'male', 'KA84864651', '8765432109', 22000.00),
(5004, 'Sanjay', 'Subramanium', '1993-04-25', 'conductor', 'male', '', '8901234567', 30000.00),
(5005, 'Venkat', 'Shetty', '1987-07-03', 'both', 'male', 'KA78786533', '7654321098', 26500.00),
(5006, 'Ganesh', 'Holla', '1992-01-12', 'both', 'male', 'KA14892635', '8123456789', 27500.00),
(5007, 'Rakesh', 'Bhat', '1984-06-18', 'both', 'male', 'KA59756251', '6543210987', 23500.00),
(5008, 'Vivek', 'Gopal', '1973-08-22', 'conductor', 'male', '', '7890123456', 29000.00),
(5009, 'Sashikala', 'Ganapathy', '1970-04-12', 'driver', 'female', 'KA12328999', '7012345678', 24500.00),
(5010, 'Amit', 'Desai', '1985-09-20', 'driver', 'male', 'KA87978856', '6789012345', 31000.00),
(5011, 'Mohan', 'Bhat', '1986-10-08', 'conductor', 'male', '', '8765432101', 26000.00),
(5012, 'Venkat', 'Nayak', '1977-03-26', 'conductor', 'male', '', '7890123456', 28500.00),
(5013, 'Girish', 'Bhat', '1980-08-08', 'conductor', 'male', '', '8901234567', 24000.00),
(5014, 'Ramesh', 'Moolya', '1972-11-14', 'driver', 'male', 'KA33666888', '8765432109', 29500.00),
(5015, 'Shashidhar', 'Prabhu', '1969-09-25', 'conductor', 'male', '', '9876543210', 25500.00),
(5016, 'Krishna', 'Hegde', '1971-08-23', 'driver', 'male', 'KA11323121', '9012345678', 32000.00),
(5017, 'Sunil', 'Bunt', '1978-04-05', 'driver', 'male', 'KA78756465', '7654321098', 27000.00),
(5018, 'Sakshi', 'Naik', '1977-08-06', 'conductor', 'female', '', '8123456789', 30500.00),
(5019, 'Annappa', 'Devadiga', '1981-01-12', 'conductor', 'male', '', '7012345678', 25500.00),
(5020, 'Suresha', 'Shenoy', '1979-04-25', 'driver', 'male', 'KA56451223', '6789012345', 28500.00);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `delete_employee_age` AFTER DELETE ON `employee` FOR EACH ROW BEGIN
    -- Delete corresponding record from employee_age table
    DELETE FROM employee_age WHERE emp_id = OLD.emp_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `manage_employee_age` AFTER INSERT ON `employee` FOR EACH ROW BEGIN
    DECLARE emp_age INT;
    
    -- Calculate age
    SET emp_age = TIMESTAMPDIFF(YEAR, NEW.dob, CURDATE());
    
    -- Insert into employee_age table
    INSERT INTO employee_age (emp_id, first_name, last_name, age) 
    VALUES (NEW.emp_id, NEW.first_name, NEW.last_name, emp_age);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_employee_age` AFTER UPDATE ON `employee` FOR EACH ROW BEGIN
    DECLARE emp_age INT;
    
    -- Calculate age
    SET emp_age = TIMESTAMPDIFF(YEAR, NEW.dob, CURDATE());
    
    -- Update employee_age table
    UPDATE employee_age
    SET first_name = NEW.first_name,
        last_name = NEW.last_name,
        age = emp_age
    WHERE emp_id = NEW.emp_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_age`
--

CREATE TABLE `employee_age` (
  `emp_id` int(4) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_age`
--

INSERT INTO `employee_age` (`emp_id`, `first_name`, `last_name`, `age`) VALUES
(5001, 'Arjun', 'Nair', 33),
(5002, 'Vikram', 'Nayak', 38),
(5003, 'Rajesh', 'Shenoy', 35),
(5004, 'Sanjay', 'Subramanium', 30),
(5005, 'Venkat', 'Shetty', 36),
(5006, 'Ganesh', 'Holla', 32),
(5007, 'Rakesh', 'Bhat', 39),
(5008, 'Vivek', 'Gopal', 50),
(5009, 'Sashikala', 'Ganapathy', 54),
(5010, 'Amit', 'Desai', 38),
(5011, 'Mohan', 'Bhat', 37),
(5012, 'Venkat', 'Nayak', 47),
(5013, 'Girish', 'Bhat', 43),
(5014, 'Ramesh', 'Moolya', 51),
(5015, 'Shashidhar', 'Prabhu', 54),
(5016, 'Krishna', 'Hegde', 52),
(5017, 'Sunil', 'Bunt', 46),
(5018, 'Sakshi', 'Naik', 46),
(5019, 'Annappa', 'Devadiga', 43),
(5020, 'Suresha', 'Shenoy', 44);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `insurance_id` int(4) NOT NULL,
  `bus_id` int(4) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `last_maintain` date NOT NULL,
  `next_maintain` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`insurance_id`, `bus_id`, `status`, `last_maintain`, `next_maintain`) VALUES
(2001, 101, 'active', '2024-03-15', '2024-09-15'),
(2002, 102, 'active', '2024-02-20', '2024-08-20'),
(2003, 103, 'active', '2024-01-01', '2024-07-12'),
(2004, 104, 'active', '2024-01-01', '2024-07-12'),
(2005, 105, 'inactive', '2024-01-01', '2024-07-12'),
(2006, 106, 'active', '2024-01-01', '2024-07-12'),
(2007, 107, 'active', '2024-01-10', '2024-07-10'),
(2008, 108, 'active', '2024-03-25', '2024-10-25'),
(2009, 104, 'inactive', '2023-02-01', '2023-07-07'),
(2010, 110, 'active', '2024-03-15', '2024-09-24'),
(2011, 109, 'active', '2024-02-22', '2024-07-10'),
(2012, 108, 'inactive', '2023-04-01', '2023-10-07');

-- --------------------------------------------------------

--
-- Stand-in structure for view `multiple_insurance`
-- (See below for the actual view)
--
CREATE TABLE `multiple_insurance` (
`bus_name` varchar(25)
,`total_insurance` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `private_bus`
-- (See below for the actual view)
--
CREATE TABLE `private_bus` (
`bus_id` int(4)
,`bus_name` varchar(25)
,`model` varchar(25)
,`capacity` int(3)
,`ownership` varchar(25)
,`depot_id` int(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `public_bus`
-- (See below for the actual view)
--
CREATE TABLE `public_bus` (
`bus_id` int(4)
,`bus_name` varchar(25)
,`model` varchar(25)
,`capacity` int(3)
,`ownership` varchar(25)
,`depot_id` int(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(4) NOT NULL,
  `start_point` varchar(25) NOT NULL,
  `stop_point` varchar(25) NOT NULL,
  `distance` int(6) NOT NULL,
  `no_of_stops` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_point`, `stop_point`, `distance`, `no_of_stops`) VALUES
(10, 'Udupi', 'Karkala', 37, 12),
(11, 'Udupi', 'Kundapura', 38, 14),
(12, 'Udupi', 'Manipal', 4, 9),
(13, 'Manipal', 'Kundapura', 43, 16),
(14, 'Udupi', 'Bhramavar', 14, 7),
(15, 'Bhramavar', 'Hebri', 28, 10),
(16, 'Udupi', 'Hebri', 42, 10),
(17, 'Udupi', 'Herga', 42, 10),
(18, 'Udupi', 'Manchi', 9, 15),
(19, 'Manipal', 'Manchi', 5, 6),
(20, 'Manipal', 'Petri', 20, 10),
(21, 'Udupi', 'Mattu', 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(4) NOT NULL,
  `route_id` int(4) NOT NULL,
  `start_time` time NOT NULL,
  `stop_time` time NOT NULL,
  `bus_id` int(4) NOT NULL,
  `c_id` int(4) NOT NULL,
  `d_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `route_id`, `start_time`, `stop_time`, `bus_id`, `c_id`, `d_id`) VALUES
(101, 10, '14:38:00', '16:37:00', 101, 5004, 5001),
(102, 21, '10:00:00', '06:20:00', 101, 5004, 5001),
(103, 11, '13:03:00', '09:16:00', 110, 5005, 5010),
(104, 20, '15:46:00', '10:47:00', 109, 5007, 5020),
(105, 12, '17:25:00', '10:17:00', 107, 5019, 5017),
(106, 19, '19:10:00', '14:48:00', 107, 5018, 5002),
(107, 13, '20:35:00', '15:58:00', 106, 5015, 5016),
(108, 18, '23:20:00', '16:20:00', 104, 5011, 5014),
(109, 15, '15:15:00', '16:25:00', 102, 5005, 5006),
(110, 17, '16:30:00', '17:45:00', 104, 5008, 5007),
(111, 15, '17:45:00', '18:23:00', 105, 5004, 5001),
(201, 11, '18:00:00', '19:30:00', 106, 5012, 5003),
(202, 13, '19:25:00', '19:55:00', 103, 5013, 5020),
(203, 10, '20:30:00', '21:00:00', 109, 5007, 5010),
(204, 16, '22:05:00', '23:05:00', 110, 5011, 5009),
(205, 14, '22:20:00', '23:20:00', 101, 5015, 5017),
(206, 21, '23:05:00', '23:45:00', 106, 5018, 5003),
(207, 10, '21:50:00', '22:50:00', 103, 5019, 5005),
(208, 14, '21:50:00', '22:15:00', 105, 5004, 5006);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sort_by_name`
-- (See below for the actual view)
--
CREATE TABLE `sort_by_name` (
`emp_id` int(4)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`dob` date
,`type` varchar(50)
,`gender` varchar(20)
,`license_number` varchar(25)
,`phone_no` varchar(20)
,`salary` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sort_by_salary`
-- (See below for the actual view)
--
CREATE TABLE `sort_by_salary` (
`emp_id` int(4)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`dob` date
,`type` varchar(50)
,`gender` varchar(20)
,`license_number` varchar(25)
,`phone_no` varchar(20)
,`salary` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `source_id` int(4) NOT NULL,
  `destination_id` int(4) NOT NULL,
  `ticket_id` int(4) NOT NULL,
  `fare` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`source_id`, `destination_id`, `ticket_id`, `fare`) VALUES
(1001, 1004, 100104, 46),
(1001, 1005, 100105, 62),
(1001, 1006, 100106, 77),
(1001, 1007, 100107, 93),
(1001, 1008, 100108, 108),
(1001, 1009, 100109, 123),
(1001, 1010, 100110, 139),
(1001, 1012, 100112, 170),
(1002, 1004, 100204, 31);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `phone`, `email`, `usertype`, `password`) VALUES
(1, 'admin1', '123456789', 'admin1@admin.com', 'admin', '1234'),
(2, 'admin2', '987654321', 'admin2@admin.com', 'admin', '5678');

-- --------------------------------------------------------

--
-- Structure for view `multiple_insurance`
--
DROP TABLE IF EXISTS `multiple_insurance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `multiple_insurance`  AS SELECT `bus`.`bus_name` AS `bus_name`, count(`maintenance`.`insurance_id`) AS `total_insurance` FROM (`bus` join `maintenance` on(`bus`.`bus_id` = `maintenance`.`bus_id`)) GROUP BY `maintenance`.`insurance_id` HAVING `total_insurance` > 1 ;

-- --------------------------------------------------------

--
-- Structure for view `private_bus`
--
DROP TABLE IF EXISTS `private_bus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `private_bus`  AS SELECT `bus`.`bus_id` AS `bus_id`, `bus`.`bus_name` AS `bus_name`, `bus`.`model` AS `model`, `bus`.`capacity` AS `capacity`, `bus`.`ownership` AS `ownership`, `bus`.`depot_id` AS `depot_id` FROM `bus` WHERE `bus`.`ownership` = 'private' ;

-- --------------------------------------------------------

--
-- Structure for view `public_bus`
--
DROP TABLE IF EXISTS `public_bus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `public_bus`  AS SELECT `bus`.`bus_id` AS `bus_id`, `bus`.`bus_name` AS `bus_name`, `bus`.`model` AS `model`, `bus`.`capacity` AS `capacity`, `bus`.`ownership` AS `ownership`, `bus`.`depot_id` AS `depot_id` FROM `bus` WHERE `bus`.`ownership` = 'public' ;

-- --------------------------------------------------------

--
-- Structure for view `sort_by_name`
--
DROP TABLE IF EXISTS `sort_by_name`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sort_by_name`  AS SELECT `employee`.`emp_id` AS `emp_id`, `employee`.`first_name` AS `first_name`, `employee`.`last_name` AS `last_name`, `employee`.`dob` AS `dob`, `employee`.`type` AS `type`, `employee`.`gender` AS `gender`, `employee`.`license_number` AS `license_number`, `employee`.`phone_no` AS `phone_no`, `employee`.`salary` AS `salary` FROM `employee` ORDER BY `employee`.`first_name` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `sort_by_salary`
--
DROP TABLE IF EXISTS `sort_by_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sort_by_salary`  AS SELECT `employee`.`emp_id` AS `emp_id`, `employee`.`first_name` AS `first_name`, `employee`.`last_name` AS `last_name`, `employee`.`dob` AS `dob`, `employee`.`type` AS `type`, `employee`.`gender` AS `gender`, `employee`.`license_number` AS `license_number`, `employee`.`phone_no` AS `phone_no`, `employee`.`salary` AS `salary` FROM `employee` ORDER BY `employee`.`salary` DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `bus_depot_fk` (`depot_id`);

--
-- Indexes for table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`depot_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_age`
--
ALTER TABLE `employee_age`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`insurance_id`),
  ADD KEY `maintain_bus_fkid` (`bus_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedule_route_fk` (`route_id`),
  ADD KEY `schedule_employee_fk` (`d_id`),
  ADD KEY `schedule_employee_fk_2` (`c_id`),
  ADD KEY `schedule_bus_fk` (`bus_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `depot`
--
ALTER TABLE `depot`
  MODIFY `depot_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5021;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100205;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintain_bus_fkid` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_bus_fk` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `schedule_employee_fk` FOREIGN KEY (`d_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `schedule_employee_fk_2` FOREIGN KEY (`c_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `schedule_route_fk` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
