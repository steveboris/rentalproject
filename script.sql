--
-- Database name: `carrentals`
--
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS brands;
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS contactus;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS categories;

-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE IF NOT EXISTS `admin`
(
    `id`           int(11)      NOT NULL,
    `UserName`     varchar(100) NOT NULL,
    `Email`      varchar(100) NOT NULL,
    `Password`     varchar(100) NOT NULL,
    `LastUpdate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = latin1;

INSERT INTO `admin` (`id`, `Username`, `Email`, `Password`, `LastUpdate`)
VALUES (1, 'admin', 'admin@local.com', '21232f297a57a5a743894a0e4a801fc3', default);

-- --------------------------------------------------------
--
-- Table structure for table `brands`
--
CREATE TABLE IF NOT EXISTS `brands` (
   `id` int(11) NOT NULL,
   `Name` varchar(120) NOT NULL,
   `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `LastUpdate`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `brands` (`id`, `Name`, `CreationDate`, `LastUpdate`)
VALUES (1, 'MERCEDES', default, default),
       (2, 'BMW', default, default),
       (3, 'Audi', default, default);

-- --------------------------------------------------------
--
-- Table structure for table `localisation`
--
CREATE TABLE IF NOT EXISTS `location` (
      `id` int(11) NOT NULL,
      `Name` varchar(120) DEFAULT NULL,
      `Country` varchar(120) DEFAULT NULL,
      `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `location` (`id`, `Name`, `Country`,`CreationDate`) VALUES
(1, 'Berlin', 'Deutschland', default),
(2, 'Brandenburg', 'Deutschland', default),
(3, 'Potsdam', 'Deutschland', default);

-- --------------------------------------------------------
--
-- Table structure for table `categories`
--
CREATE TABLE IF NOT EXISTS `categories` (
      `id` int(11) NOT NULL,
      `Name` varchar(120) DEFAULT NULL,
      `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `Name`,`CreationDate`) VALUES
(1, 'Kleinwagen', default),
(2, 'Kompaktklasse', default),
(3, 'Mittelklasse', default),
(4, 'Sportwagen', default);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--
CREATE TABLE IF NOT EXISTS `cars` (
     `id` int(11) NOT NULL,
     `CarTitle` varchar(150) DEFAULT NULL,
     `CarBrand` int(11) DEFAULT NULL,
     `Location` int(11) DEFAULT NULL,
     `Category` int(11) DEFAULT NULL,
     `CarColor` varchar(20) DEFAULT NULL,
     `CarOverview` longtext,
     `PricePerDay` int(11) DEFAULT NULL,
     `FuelType` varchar(100) DEFAULT NULL,
     `ModelYear` int(6) DEFAULT NULL,
     `SeatingCapacity` int(11) DEFAULT NULL,
     `CarImage1` varchar(120) DEFAULT NULL,
     `CarImage2` varchar(120) DEFAULT NULL,
     `CarImage3` varchar(120) DEFAULT NULL,
     `CarImage4` varchar(120) DEFAULT NULL,
     `CarImage5` varchar(120) DEFAULT NULL,
     `AirConditioner` int(11) DEFAULT NULL,
     `PowerDoorLocks` int(11) DEFAULT NULL,
     `AntiLockBrakingSystem` int(11) DEFAULT NULL,
     `BrakeAssist` int(11) DEFAULT NULL,
     `PowerSteering` int(11) DEFAULT NULL,
     `DriverAirbag` int(11) DEFAULT NULL,
     `PassengerAirbag` int(11) DEFAULT NULL,
     `PowerWindows` int(11) DEFAULT NULL,
     `CDPlayer` int(11) DEFAULT NULL,
     `CentralLocking` int(11) DEFAULT NULL,
     `CrashSensor` int(11) DEFAULT NULL,
     `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `LastUpdate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `cars` (`id`, `CarTitle`, `CarBrand`, `Location`,`Category`, `CarColor`, `CarOverview`, `PricePerDay`, `FuelType`, `ModelYear`,
                    `SeatingCapacity`, `CarImage1`, `CarImage2`, `CarImage3`, `CarImage4`, `CarImage5`,
                    `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`,
                    `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`,
                    `RegDate`, `LastUpdate`)
VALUES (1, 'ML 240', 1, 1, 1, 'Schwarz', 'Mercedes ML 240 ll', 45, 'Benzin', 2020, 7, NULL, NULL, NULL, NULL, NULL, 1, 1, 1,
        1, 1, 1, 1, 1, 1, 1, 1, default, default),
       (2, 'X7', 2, 2, 1, 'Blau', 'BMW X7', 45, 'Benzin', 2020, 7, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        1, default, default),
       (3, 'A8', 1, 3,1,'Silber', 'Audi A8', 35, 'Benzin', 2020, 7, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        1, 1, default, default);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL,
      `FullName` varchar(120) DEFAULT NULL,
      `Email` varchar(100) DEFAULT NULL,
      `Password` varchar(100) DEFAULT NULL,
      `ContactNo` char(11) DEFAULT NULL,
      `Birthday` varchar(100) DEFAULT NULL,
      `Address` varchar(255) DEFAULT NULL,
      `City` varchar(100) DEFAULT NULL,
      `Country` varchar(100) DEFAULT NULL,
      `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `LastUpdate` TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `FullName`, `Email`, `Password`, `ContactNo`, `Birthday`, `Address`, `City`, `Country`,
                     `RegDate`, `LastUpdate`)
VALUES (1, 'Danielle', 'danielle@local.com', '21232f297a57a5a743894a0e4a801fc3', 015276899452, '15/02/2020',
        'Brandenburgerstr. 1', 'Berlin', 'Deutschland', default, default),
       (2, 'Marie', 'marie@local.com', '21232f297a57a5a743894a0e4a801fc3', 015171895552, '15/02/2020',
        'Bergerstr. 1', 'Brandenburg', 'Deutschland', default, default);
-- --------------------------------------------------------
--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
    `id` int(11) NOT NULL,
    `UserEmail` varchar(100) DEFAULT NULL,
    `CarID` int(11) DEFAULT NULL,
    `FromDate` varchar(20) DEFAULT NULL,
    `ToDate` varchar(20) DEFAULT NULL,
    `Message` varchar(255) DEFAULT NULL,
    `Status` int(11) DEFAULT NULL,
    `PostingDate` TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `booking` (`id`, `UserEmail`, `CarID`, `FromDate`, `ToDate`, `Message`, `Status`, `PostingDate`)
VALUES (1, 'booking@test.com', 1, '2020-02-14 09:34:04', '2020-02-20 09:34:04', 'Danke für die Punktlichkeit', 1,
        default);
-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
   `id` int(11) NOT NULL,
   `Name` varchar(100) DEFAULT NULL,
   `Email` varchar(120) DEFAULT NULL,
   `ContactNb` char(11) DEFAULT NULL,
   `Message` longtext,
   `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `status` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `contactus` (`id`, `Name`, `Email`, `ContactNb`, `Message`, `PostingDate`, `Status`)
VALUES (1, 'Titus', 'tituslepro@test.com', 015623178952,
        'I would like to have more information about the rental process', default, 1);

-- --------------------------------------------------------
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
    ADD PRIMARY KEY (`id`);
--
-- Indexes for table `localisation`
--
ALTER TABLE `location`
    ADD PRIMARY KEY (`id`);
--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`);

--
-- Tables settings
--
ALTER TABLE `admin`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

ALTER TABLE `location`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

-- --------------------------------------------------------------------
