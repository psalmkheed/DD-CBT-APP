-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 07:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ded_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(16) NOT NULL,
  `subjects` tinytext NOT NULL,
  `class` varchar(16) NOT NULL,
  `term` varchar(8) NOT NULL,
  `session` varchar(10) NOT NULL,
  `author` tinytext NOT NULL,
  `exam_type` tinytext NOT NULL,
  `paper_type` enum('Theory','Objectives') DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime NOT NULL,
  `num_quest` int(11) NOT NULL,
  `status` enum('set-up','expired','published','ready') NOT NULL DEFAULT 'set-up',
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_id`, `subjects`, `class`, `term`, `session`, `author`, `exam_type`, `paper_type`, `date_created`, `due_date`, `num_quest`, `status`, `duration`) VALUES
(4, '68aa416564ee0', 'Physics', 'SSS 2', 'First', '2025/2026', 'DIS/C/22/001', 'Mid-Term', 'Objectives', '2025-08-24 00:00:00', '2025-09-07 00:00:00', 20, 'published', 1500),
(5, '68aa41eb4af16', 'Physics', 'SSS 3', 'First', '2025/2026', 'DIS/C/22/001', 'Mid-Term', 'Objectives', '2025-08-24 00:00:00', '2025-09-07 00:00:00', 20, 'published', 1500),
(6, '68a99885690f8', 'Physics', 'SSS 1', 'First', '2025/2026', 'DIS/C/22/001', 'Mid-Term', 'Objectives', '2025-08-24 00:00:00', '2025-09-07 00:00:00', 20, 'ready', 1200),
(7, '68ecfc0de9399', 'CRS', 'SSS 1', 'First', '2025/2026', 'DIS/C/22/001', 'Mid-Term', 'Theory', '2025-10-13 00:00:00', '2025-10-20 00:00:00', 5, 'set-up', 1800);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(16) DEFAULT NULL,
  `quest_num` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_answer` enum('A','B','C','D') DEFAULT NULL,
  `acad_year` text DEFAULT NULL,
  `subject` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `quest_num`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `acad_year`, `subject`) VALUES
(1, '68a99885690f8', 1, 'The branch of Physics that investigates the behavior of matter that travels with the speed of light is known as', 'Classical Physics', 'Quantum Physics', 'Experimental Physics', 'Atomic Physics', 'B', 'first 2025/2026', 'Physics'),
(2, '68a99885690f8', 2, 'The physical quantity that determines the quantity of matter contained in a body is known as', 'temperature', 'weight', 'mass', 'gravity', 'C', 'first 2025/2026', 'Physics'),
(3, '68a99885690f8', 3, 'The temperature of a body is measured by a ....', 'Thermometer', 'Calorimeter', 'Thermopile', 'heating coil', 'A', 'first 2025/2026', 'Physics'),
(4, '68a99885690f8', 4, 'Which of the following is not a scalar quantity?', 'mass', 'speed', 'distance', 'velocity', 'D', 'first 2025/2026', 'Physics'),
(5, '68a99885690f8', 5, 'The following are set of fundamental quantities except', 'mass, weight, distance', 'mass, time, distance', 'distance, luminous intensity, temperature', 'time, temperature, amount', 'A', 'first 2025/2026', 'Physics'),
(6, '68a99885690f8', 6, 'The type of motion in which only a part of an object moves to and fro about a fixed point is known as', 'random', 'oscillatory', 'rotational', 'linear', 'B', 'first 2025/2026', 'Physics'),
(7, '68a99885690f8', 7, 'The reluctance of a body to change its motion is known as', 'force', 'friction', 'inertia', 'momentum', 'C', 'first 2025/2026', 'Physics'),
(8, '68a99885690f8', 8, 'The following are laws of solid friction except', 'coefficient of static friction is greater than coefficient of dynamic friction', 'The frictional force is proportional to the normal reaction', 'the magnitude of frictional force is independent on speed of rubbing', 'friction depends on the nature of surfaces in contact', 'A', 'first 2025/2026', 'Physics'),
(9, '68a99885690f8', 9, 'The amount of pull exerted on a body by the earth is regarded as', 'friction', 'energy', 'weight', 'magnetism', 'C', 'first 2025/2026', 'Physics'),
(10, '68aa41eb4af16', 1, 'Which of the following is not an electromagnetic ray', 'X-rays', 'Gamma Rays', 'Adobe Rays', 'Micro wave', 'C', 'first 2025/2026', 'Physics'),
(11, '68aa41eb4af16', 2, 'The electromagnetic wave with the longest wavelength but shortest frequency is', 'visible light', 'microwave', 'radiowave', 'ultraviolet wave', 'C', 'first 2025/2026', 'Physics'),
(12, '68aa41eb4af16', 3, 'When a semiconductor material experiences an increase in temperature, which of the following properties will be affected', 'purity', 'conductivity', 'density', 'expansivity', 'B', 'first 2025/2026', 'Physics'),
(13, '68aa41eb4af16', 4, 'Semiconductors are widely useful in electronics for all of these except', 'transistor', 'diode', 'resistor', 'thyristor', 'C', 'first 2025/2026', 'Physics'),
(14, '68aa41eb4af16', 5, 'The act of increasing the conductivity of semiconductors by injecting excess holes or electrons from trivalent/tetravalent metals is known as', 'doping', 'dopamizing', 'photoinjection', 'laser', 'A', 'first 2025/2026', 'Physics'),
(15, '68aa41eb4af16', 6, 'One of the condition of LASER formation are all these except', 'Population inversion must occur', 'There must be stimulation', 'Energy transition must occur', 'Absorbing mirrors must be used ', 'D', 'first 2025/2026', 'Physics'),
(16, '68aa41eb4af16', 7, 'One of the advantage of LASER over conventional light is its', 'coherence', 'dispersion', 'chromatic abberation', 'damping nature', 'A', 'first 2025/2026', 'Physics'),
(17, '68aa41eb4af16', 8, 'All of these are components of LASER except', 'photomultiplier', 'gain/active medium', 'electron gun', 'optical cavity', 'C', 'first 2025/2026', 'Physics'),
(18, '68aa41eb4af16', 9, 'In LASER production, population inversion is a term used to describe a situation in which ', 'There are more excited electrons than electrons in ground state', 'there are more electrons in ground state than excited state', 'there are equal number of electrons in the metastable state', 'The total number of electrons in the gain medium', 'A', 'first 2025/2026', 'Physics'),
(19, '68aa41eb4af16', 10, 'The transmission of electronic signals using light is known as ', 'fibre optics', 'phototransmission', 'LASER', 'Internet', 'A', 'first 2025/2026', 'Physics'),
(20, '68aa41eb4af16', 11, 'A fibre optical operates on the principle of ____ of light', 'reflection', 'refraction', 'reflection and refraction', 'polarization', 'C', 'first 2025/2026', 'Physics'),
(21, '68aa41eb4af16', 12, 'LASER can be technologically applied in all of these except', 'welding', 'weaponry', 'aesthetics', 'dermatology', 'C', 'first 2025/2026', 'Physics'),
(22, '68aa41eb4af16', 13, 'LASER can be technologically applied in all of these except', 'welding', 'weaponry', 'aesthetics', 'dermatology', 'C', 'first 2025/2026', 'Physics'),
(23, '68aa41eb4af16', 14, 'When an electric field oscillates at right angle with a magnetic field, it produces a', 'mechanical wave', 'polarized wave', 'electromagnetic wave', 'longitudinal wave', 'C', 'first 2025/2026', 'Physics'),
(24, '68aa41eb4af16', 15, 'The relationship between energy of penetration of EM-waves and its wavelength is such that', 'Energy is directly proportional to wavelength', 'energy is inversely proportional to wavelength', 'energy is jointly proportional to wavelength', 'Energy partly constant and partly varies as wavelength', 'B', 'first 2025/2026', 'Physics'),
(25, '68aa41eb4af16', 16, 'The chemical decomposition of a molten compound by passing direct current through it is known as ', 'electrolysis', 'thermodynamics', 'thermal decomposition', 'electrode potential', 'A', 'first 2025/2026', 'Physics'),
(26, '68aa41eb4af16', 17, 'An electronic device that allows current to flow through it only one direction is known as', 'Diode', 'Resistor', 'Capacitor', 'Inductor', 'A', 'first 2025/2026', 'Physics'),
(27, '68aa41eb4af16', 18, 'The parabolic path through which an object launched at a given angle to the horizontal is known as a .....', 'projectile', 'trajectory', 'parabola', 'hyperbola', 'B', 'first 2025/2026', 'Physics'),
(28, '68aa41eb4af16', 19, 'Identify the wrong statement in the below expressions', 'A body falling under the influence of gravity has no acceleration', 'A body under free fall has a steady velocity', 'When a body falls freely under the influence of gravity, its velocity increases as it falls', 'When a body falls freely under the influence of gravity, its acceleration remains constant', 'D', 'first 2025/2026', 'Physics'),
(29, '68aa41eb4af16', 20, 'One of these is not a usage of rockets', 'fireworks', 'transportation of payloads into space', 'launchers for missiles and weaponries', 'emergency ejections seat for fighter jets', 'A', 'first 2025/2026', 'Physics'),
(30, '68aa416564ee0', 1, 'The points at which the extension of a body is disproportionate to the weight of load applied is known as ', 'yield point', 'elastic limit ', 'breaking point', 'plastic point', 'D', 'first 2025/2026', 'Physics'),
(31, '68aa416564ee0', 2, 'The reluctance of a body to change its state of uniform motion unless acted upon by an external force is known as ', 'inertia', 'projectile', 'impulse', 'momentum', 'A', 'first 2025/2026', 'Physics'),
(32, '68aa416564ee0', 3, 'A body of mass 5kg initially at rest is acted upon by two mutually perpendicular forces 12N and 5N. Calculate the magnitude of the acceleration', '0.40m/s2', '1.40m/s2', '0.26m/s2', '2.60m/s2', 'D', 'first 2025/2026', 'Physics'),
(33, '68aa416564ee0', 4, 'The best color of shirt to be won on a bright and sunny noon day is ', 'red', 'black', 'green', 'white', 'D', 'first 2025/2026', 'Physics'),
(34, '68aa416564ee0', 5, 'A body starts moving with a speed of 40m/s and accelerates uniformly to 90m/s in 4.0s. Calculate the distance travelled.', '100m', '180m', '200m', '260m', 'D', 'first 2025/2026', 'Physics'),
(35, '68aa416564ee0', 6, 'The unit of magnetic flux density is ', 'Tesla', 'Watt', 'Newton per Metre', 'Coulumb', 'A', 'first 2025/2026', 'Physics'),
(36, '68aa416564ee0', 7, 'Meters are installed in houses to monitor and evaluate the cost of electricity consumed. What physical quantity does this meter measure?', 'power', 'energy', 'voltage', 'current', 'B', 'first 2025/2026', 'Physics'),
(37, '68aa416564ee0', 8, 'The type of energy stored in a dry Leclance cell is', 'chemical', 'electrical', 'nuclear', 'thermal', 'A', 'first 2025/2026', 'Physics'),
(38, '68aa416564ee0', 9, 'Which of the following pertains to Newton\'s third law of motion?', 'a ball rolling on the ground', 'an accelerating car', 'a rocket propelled into space', 'pedalling of bicycle', 'C', 'first 2025/2026', 'Physics'),
(39, '68aa416564ee0', 10, 'A body in a lift is moving down with acceleration due to gravity. Which of the following statements is correct? The body', 'weighs less than its actual weight', 'weighs more than its actual weight', 'weighs exactly its own weight', 'is weightless', 'D', 'first 2025/2026', 'Physics'),
(40, '68aa416564ee0', 11, 'A body of masses 3kg and 5kg hangs on opposite side of a smooth massless and frictionless pulley. The acceleration of the block is', '2.0m/s2', '1.25m/s2', '2.5m/s2', '4.0m/s2', 'C', 'first 2025/2026', 'Physics'),
(44, '68aa416564ee0', 12, 'A ball falls from a height of 80m. Calculate the time of fall. (g=10m/s2)', '4.0s', '16.0s', '2.0s', '8.0s', 'A', 'first 2025/2026', 'Physics'),
(45, '68a99885690f8', 10, 'A body starts from rest and accelerates uniformly at 5ms⁻² until it attains a velocity of 25ms⁻¹. Calculate the time taken to attain this velocity.', '10s', '5s', '25s', '15s', 'B', 'first 2025/2026', 'Physics'),
(46, '68a99885690f8', 11, 'which of these is the dimension of power', 'ML²T⁻³', 'M⁻²L⁻¹T⁻²', 'M⁻³LT⁻²', 'M⁻²LT⁻²', 'A', 'first 2025/2026', 'Physics'),
(47, '68a99885690f8', 12, 'The following are types of Motion EXCEPT', 'Translational Motion', 'Oscillatory Motion', 'Rectangular Motion', 'Random Motion', 'C', 'first 2025/2026', 'Physics'),
(48, '68a99885690f8', 13, 'A lamborghini initially moving at 33.66m/s. As its velocity reduced to 29.63m/s in 6 seconds. Find the acceleration', '0.6716', '-0.6726', '-0.672', '0.672', 'C', 'first 2025/2026', 'Physics'),
(49, '68a99885690f8', 14, 'The area under a VELOCITY-TIME graph represents', 'Acceleration', 'Displacement', 'Speed', 'Force', 'B', 'first 2025/2026', 'Physics'),
(50, '68a99885690f8', 15, 'The slope of a VELOCITY-TIME graph represents', 'Acceleration', 'Displacement ', 'Speed ', 'Force', 'C', 'first 2025/2026', 'Physics'),
(51, '68a99885690f8', 16, 'A car accelerates uniformly from rest to a VELOCITY v in TIME t. The average velocity of the car during this time is', 'v/0.5t', 'v/2t', '2/v', '2v/2t', 'B', 'first 2025/2026', 'Physics'),
(52, '68a99885690f8', 17, 'The truck of a passenger car applied at a velocity of 30m/s and comes to rest 30 minutes later. What is the acceleration', '-0.16m/s', '0.02m/s', '-0.016m/s', '-0.106m/s', 'C', 'first 2025/2026', 'Physics'),
(53, '68a99885690f8', 18, 'The motion of an object occurs when one of the following acts on it ', 'Weight', 'Moment', 'Force', 'Impulse', 'C', 'first 2025/2026', 'Physics'),
(54, '68a99885690f8', 19, 'The physical quantity that determines the rate of change of Velocity is known as', 'Force', 'Acceleration', 'Couple', 'Torque', 'B', 'first 2025/2026', 'Physics'),
(55, '68a99885690f8', 20, 'Which of the following is the dimension of PRESSURE', 'ML⁻³', 'MLT⁻²', 'ML²T³', 'ML⁻¹T⁻²', 'D', 'first 2025/2026', 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(16) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `exam_id`, `user_id`, `score`, `total`, `start_time`, `end_time`) VALUES
(17, '68aa41eb4af16', 'raphael', 14, 20, '2025-10-21 18:20:07', '2025-10-21 18:45:07'),
(18, '68aa41eb4af16', 'damola', 10, 20, '2025-10-21 18:20:28', '2025-10-21 18:45:28'),
(19, '68aa416564ee0', 'demilade', 3, 20, '2025-10-21 18:32:22', '2025-10-21 18:57:22'),
(20, '68aa416564ee0', 'jomiloju', 4, 20, '2025-10-21 18:32:26', '2025-10-21 18:57:26'),
(21, '68aa416564ee0', 'david', 4, 20, '2025-10-21 18:33:47', '2025-10-21 18:58:47'),
(22, '68aa416564ee0', 'marvellous', 5, 20, '2025-10-21 18:46:08', '2025-10-21 19:11:08'),
(23, '68aa416564ee0', 'Kareem', 0, 20, '2025-10-21 19:02:56', '2025-10-21 19:17:16'),
(24, '68aa416564ee0', 'Folorunsho', 2, 20, '2025-10-21 18:54:02', '2025-10-21 19:19:02'),
(25, '68aa416564ee0', 'Regbekhai', 3, 20, '2025-10-21 18:55:17', '2025-10-21 19:20:17'),
(26, '68aa41eb4af16', 'dis/a/001', 0, 20, '2025-10-21 19:11:24', '2025-10-21 19:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `term` varchar(16) NOT NULL,
  `year` varchar(9) NOT NULL,
  `status` enum('ended','active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `term`, `year`, `status`) VALUES
(1, 'first', '2025/2026', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(16) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `quest_num` int(11) NOT NULL,
  `selected_answer` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`id`, `exam_id`, `user_id`, `quest_num`, `selected_answer`) VALUES
(112, '68aa41eb4af16', 'raphael', 1, 'C'),
(113, '68aa41eb4af16', 'raphael', 2, 'C'),
(114, '68aa41eb4af16', 'raphael', 3, 'A'),
(115, '68aa41eb4af16', 'raphael', 4, 'D'),
(116, '68aa41eb4af16', 'raphael', 5, 'C'),
(117, '68aa41eb4af16', 'raphael', 6, 'D'),
(118, '68aa41eb4af16', 'raphael', 7, 'A'),
(119, '68aa41eb4af16', 'raphael', 8, 'C'),
(120, '68aa41eb4af16', 'raphael', 9, 'A'),
(121, '68aa41eb4af16', 'raphael', 10, 'A'),
(122, '68aa41eb4af16', 'raphael', 11, 'A'),
(123, '68aa41eb4af16', 'raphael', 12, 'C'),
(124, '68aa41eb4af16', 'raphael', 13, 'C'),
(125, '68aa41eb4af16', 'raphael', 14, 'C'),
(126, '68aa41eb4af16', 'raphael', 15, 'B'),
(127, '68aa41eb4af16', 'raphael', 16, 'A'),
(128, '68aa41eb4af16', 'raphael', 17, 'C'),
(129, '68aa41eb4af16', 'raphael', 18, 'A'),
(130, '68aa41eb4af16', 'raphael', 19, 'D'),
(131, '68aa41eb4af16', 'raphael', 20, 'A'),
(132, '68aa41eb4af16', 'damola', 1, 'A'),
(133, '68aa41eb4af16', 'damola', 2, 'C'),
(134, '68aa41eb4af16', 'damola', 3, 'D'),
(135, '68aa41eb4af16', 'damola', 4, 'D'),
(136, '68aa41eb4af16', 'damola', 5, 'D'),
(137, '68aa41eb4af16', 'damola', 6, 'D'),
(138, '68aa41eb4af16', 'damola', 7, 'A'),
(139, '68aa41eb4af16', 'damola', 8, 'A'),
(140, '68aa41eb4af16', 'damola', 9, 'A'),
(141, '68aa41eb4af16', 'damola', 10, 'A'),
(142, '68aa41eb4af16', 'damola', 11, 'B'),
(143, '68aa41eb4af16', 'damola', 12, 'A'),
(144, '68aa41eb4af16', 'damola', 13, 'A'),
(145, '68aa41eb4af16', 'damola', 14, 'C'),
(146, '68aa41eb4af16', 'damola', 15, 'B'),
(147, '68aa41eb4af16', 'damola', 16, 'A'),
(148, '68aa41eb4af16', 'damola', 17, 'A'),
(149, '68aa41eb4af16', 'damola', 18, 'A'),
(150, '68aa41eb4af16', 'damola', 19, 'A'),
(151, '68aa41eb4af16', 'damola', 20, 'A'),
(152, '68aa416564ee0', 'jomiloju', 1, 'B'),
(153, '68aa416564ee0', 'jomiloju', 2, 'D'),
(154, '68aa416564ee0', 'jomiloju', 3, 'D'),
(155, '68aa416564ee0', 'jomiloju', 4, 'D'),
(156, '68aa416564ee0', 'jomiloju', 5, 'C'),
(157, '68aa416564ee0', 'jomiloju', 6, 'C'),
(158, '68aa416564ee0', 'jomiloju', 7, 'D'),
(159, '68aa416564ee0', 'jomiloju', 8, 'D'),
(160, '68aa416564ee0', 'jomiloju', 9, 'D'),
(161, '68aa416564ee0', 'jomiloju', 10, 'B'),
(162, '68aa416564ee0', 'jomiloju', 11, 'C'),
(163, '68aa416564ee0', 'jomiloju', 12, 'A'),
(164, '68aa416564ee0', 'demilade', 1, 'B'),
(165, '68aa416564ee0', 'demilade', 2, 'D'),
(166, '68aa416564ee0', 'demilade', 3, 'D'),
(167, '68aa416564ee0', 'demilade', 4, 'D'),
(168, '68aa416564ee0', 'demilade', 5, 'C'),
(169, '68aa416564ee0', 'demilade', 6, 'C'),
(170, '68aa416564ee0', 'demilade', 7, 'D'),
(171, '68aa416564ee0', 'demilade', 8, 'A'),
(172, '68aa416564ee0', 'demilade', 9, 'B'),
(173, '68aa416564ee0', 'demilade', 10, 'B'),
(174, '68aa416564ee0', 'demilade', 11, 'A'),
(175, '68aa416564ee0', 'demilade', 12, 'D'),
(176, '68aa416564ee0', 'david', 1, 'C'),
(177, '68aa416564ee0', 'david', 2, 'A'),
(178, '68aa416564ee0', 'david', 3, 'B'),
(179, '68aa416564ee0', 'david', 4, 'D'),
(180, '68aa416564ee0', 'david', 5, 'C'),
(181, '68aa416564ee0', 'david', 6, 'C'),
(182, '68aa416564ee0', 'david', 7, 'D'),
(183, '68aa416564ee0', 'david', 8, 'B'),
(184, '68aa416564ee0', 'david', 9, 'B'),
(185, '68aa416564ee0', 'david', 10, 'D'),
(186, '68aa416564ee0', 'david', 11, 'B'),
(187, '68aa416564ee0', 'david', 12, 'A'),
(188, '68aa416564ee0', 'marvellous', 1, 'D'),
(189, '68aa416564ee0', 'marvellous', 2, 'A'),
(190, '68aa416564ee0', 'marvellous', 3, 'D'),
(191, '68aa416564ee0', 'marvellous', 4, 'B'),
(192, '68aa416564ee0', 'marvellous', 5, 'D'),
(193, '68aa416564ee0', 'marvellous', 6, 'D'),
(194, '68aa416564ee0', 'marvellous', 7, 'D'),
(195, '68aa416564ee0', 'marvellous', 8, 'A'),
(196, '68aa416564ee0', 'marvellous', 9, 'A'),
(197, '68aa416564ee0', 'marvellous', 10, 'B'),
(198, '68aa416564ee0', 'marvellous', 11, 'B'),
(199, '68aa416564ee0', 'marvellous', 12, 'D'),
(200, '68aa416564ee0', 'Regbekhai', 1, 'C'),
(201, '68aa416564ee0', 'Regbekhai', 2, 'C'),
(202, '68aa416564ee0', 'Regbekhai', 3, 'B'),
(203, '68aa416564ee0', 'Regbekhai', 4, 'D'),
(204, '68aa416564ee0', 'Regbekhai', 5, 'A'),
(205, '68aa416564ee0', 'Regbekhai', 6, 'D'),
(206, '68aa416564ee0', 'Regbekhai', 7, 'D'),
(207, '68aa416564ee0', 'Regbekhai', 8, 'A'),
(208, '68aa416564ee0', 'Regbekhai', 9, 'B'),
(209, '68aa416564ee0', 'Regbekhai', 10, 'D'),
(210, '68aa416564ee0', 'Regbekhai', 11, 'B'),
(211, '68aa416564ee0', 'Regbekhai', 12, 'D'),
(212, '68aa416564ee0', 'Kareem', 1, 'B'),
(213, '68aa416564ee0', 'Kareem', 2, 'D'),
(214, '68aa416564ee0', 'Kareem', 3, 'C'),
(215, '68aa416564ee0', 'Kareem', 4, 'B'),
(216, '68aa416564ee0', 'Kareem', 5, 'C'),
(217, '68aa416564ee0', 'Kareem', 6, 'C'),
(218, '68aa416564ee0', 'Kareem', 7, 'D'),
(219, '68aa416564ee0', 'Kareem', 8, 'B'),
(220, '68aa416564ee0', 'Kareem', 9, 'B'),
(221, '68aa416564ee0', 'Kareem', 10, 'B'),
(222, '68aa416564ee0', 'Kareem', 11, 'B'),
(223, '68aa416564ee0', 'Kareem', 12, 'D'),
(224, '68aa416564ee0', 'Folorunsho', 1, 'B'),
(225, '68aa416564ee0', 'Folorunsho', 2, 'D'),
(226, '68aa416564ee0', 'Folorunsho', 3, 'C'),
(227, '68aa416564ee0', 'Folorunsho', 4, 'D'),
(228, '68aa416564ee0', 'Folorunsho', 5, 'B'),
(229, '68aa416564ee0', 'Folorunsho', 6, 'B'),
(230, '68aa416564ee0', 'Folorunsho', 7, 'C'),
(231, '68aa416564ee0', 'Folorunsho', 8, 'C'),
(232, '68aa416564ee0', 'Folorunsho', 9, 'A'),
(233, '68aa416564ee0', 'Folorunsho', 10, 'B'),
(234, '68aa416564ee0', 'Folorunsho', 11, 'B'),
(235, '68aa416564ee0', 'Folorunsho', 12, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `surname` tinytext NOT NULL,
  `other_names` text NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `auth_code` varchar(128) NOT NULL,
  `user_role` enum('student','staff','admin') NOT NULL,
  `class` varchar(5) NOT NULL,
  `directory` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `other_names`, `user_id`, `auth_code`, `user_role`, `class`, `directory`) VALUES
(1, 'Oshiyokun', 'Olamide Oluwole', 'dis/a/001', 'admin', 'admin', '', ''),
(2, 'Isiaka', 'Jomiloju Sodiq', 'jomiloju', 'isiaka', 'student', 'SSS 2', 'uploads/ded.jpg'),
(3, 'Maforikan', 'David', 'david', 'maforikan', 'student', 'SSS 2', 'uploads/ded.jpg'),
(4, 'Bello', 'Demilade', 'demilade', 'bello', 'student', 'SSS 2', 'uploads/ded.jpg'),
(5, 'Balogun', 'Mariam', 'mariam', 'balogun', 'student', 'SSS 3', 'uploads/ded.jpg'),
(6, 'Ugorji', 'Dominion', 'dominion', 'ugorji', 'student', 'SSS 3', 'uploads/ded.jpg'),
(7, 'Ikeanyionwu', 'Mmesoma', 'mmesoma', 'ikeanyionwu', 'student', 'SSS 3', 'uploads/ded.jpg'),
(8, 'Ojo', 'Raphael', 'raphael', 'ojo', 'student', 'SSS 3', 'uploads/ded.jpg'),
(9, 'Mayungbe', 'Damola', 'damola', 'mayungbe', 'student', 'SSS 3', 'uploads/ded.jpg'),
(10, 'Odum', 'Olivia', 'olivia', 'odum', 'student', 'SSS 3', 'uploads/ded.jpg'),
(11, 'Mfuk', 'Esther', 'esther', 'mfuk', 'student', 'SSS 3', 'uploads/ded.jpg'),
(12, 'Babawale', 'Bukunmi', 'bukunmi', 'babawale', 'student', 'SSS 3', 'uploads/ded.jpg'),
(13, 'Kehinde', 'Marvellous', 'marvellous', 'kehinde', 'student', 'SSS 2', 'uploads/IMG_20251015_120301.jpg'),
(14, 'Kareem', 'Mistura', 'Kareem', 'mistura', 'student', 'SSS 2', 'uploads/Screenshot_20251016-194310.jpg'),
(15, 'Folorunsho', 'Hashraf', 'Folorunsho', 'hashraf', 'student', 'SSS 2', 'uploads/IMG-20251021-WA0004.jpeg'),
(16, 'Regbekhai', 'Tunmise', 'Regbekhai', 'tunmise', 'student', 'SSS 2', 'uploads/IMG-20251021-WA0004.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_id` (`exam_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_fk` (`exam_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_id` (`exam_id`,`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fk_results` (`exam_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `quest_fk` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_fk_results` FOREIGN KEY (`exam_id`) REFERENCES `results` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
