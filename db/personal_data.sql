-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 06:20 PM
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
-- Database: `personal_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finfo`
--

CREATE TABLE `tbl_finfo` (
  `f_id` int(50) NOT NULL,
  `f_lname` varchar(100) NOT NULL,
  `f_fname` varchar(100) NOT NULL,
  `f_middle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_finfo`
--

INSERT INTO `tbl_finfo` (`f_id`, `f_lname`, `f_fname`, `f_middle`) VALUES
(1, 'Bonner', 'Ella', 'Consequatur Dolor n'),
(2, 'Thrower', 'William', 'G'),
(3, 'Aguilar', 'Gail', 'Laudantium ut adipi'),
(4, 'Mayormita', 'John William', 'N'),
(5, 'Wilkerson', 'September', 'Deleniti aut consect'),
(6, 'Mayo', 'Wendy', 'Ipsum dolor lorem q'),
(7, 'Villarreal', 'Gage', 'Eligendi culpa prae'),
(8, 'Mosley', 'Jennifer', 'Cumque dolores volup'),
(9, 'Stephens', 'Uta', 'Amet dolor sint dol'),
(10, 'Parrish', 'Meredith', 'Facilis et quae dele'),
(11, 'Clarke', 'Dillon', 'Incididunt ut harum'),
(12, 'Holland', 'Lionel', 'Porro laboris omnis'),
(13, 'Gutierrez', 'Reece', 'Vel et aute pariatur'),
(14, 'Little', 'Ori', 'Voluptatum voluptati'),
(15, 'Reynolds', 'Maryam', 'Perferendis sit in'),
(16, 'Morin', 'Piper', 'Provident pariatur'),
(17, 'Aguirre', 'Xavier', 'Commodi amet ration'),
(18, 'Franco', 'Seth', 'Ut ipsum qui nisi u'),
(19, 'Morin', 'Conan', 'Magnam iure ullamco'),
(20, 'Gilmore', 'Nichole', 'Aspernatur dolores r'),
(21, 'Lawson', 'Dara', 'Eos ut in laudantiu'),
(22, 'Kane', 'Quintessa', 'Enim ut aut eius qui'),
(23, 'Mcgowan', 'Silas', 'Vel dolore reiciendi'),
(24, 'William', 'Isabelle', 'Qui voluptatum volup'),
(25, 'Sparks', 'Beatrice', 'Ipsum earum earum qu'),
(26, 'Mayormita', 'John William', 'N'),
(27, 'Mcleod', 'Stewart', 'Excepteur non libero');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hadress`
--

CREATE TABLE `tbl_hadress` (
  `ha_id` int(50) NOT NULL,
  `ha_unitno` varchar(100) NOT NULL,
  `ha_blkno` varchar(100) NOT NULL,
  `ha_sn` varchar(100) NOT NULL,
  `ha_subdivision` varchar(100) NOT NULL,
  `ha_barangay` varchar(100) NOT NULL,
  `ha_city` varchar(100) NOT NULL,
  `ha_country` varchar(100) NOT NULL,
  `ha_province` varchar(100) NOT NULL,
  `ha_zipcode` int(50) NOT NULL,
  `ha_email` varchar(100) NOT NULL,
  `ha_telno` varchar(100) NOT NULL,
  `ha_mobileno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hadress`
--

INSERT INTO `tbl_hadress` (`ha_id`, `ha_unitno`, `ha_blkno`, `ha_sn`, `ha_subdivision`, `ha_barangay`, `ha_city`, `ha_country`, `ha_province`, `ha_zipcode`, `ha_email`, `ha_telno`, `ha_mobileno`) VALUES
(1, 'Wylie Rosales', 'Nisi molestias eius', 'Kaseem Dejesus', 'Hic reprehenderit a', 'Eum in quam officia', 'Est aperiam molesti', 'France', 'Commodi illo cillum', 62717, 'sepysite@mailinator.com', '8367567', ''),
(2, 'Bernard Marsh', 'Accusamus rerum fuga', '1813A Lower Pakigne', '1EWD', 'Pakigne', 'Minglanilla', 'Philippines (the)', 'Cebu', 6000, 'jonwilyammayormita@gmail.com', '2147483647', ''),
(3, 'Meghan Wilcox', 'Dolores atque velit', 'Kamal Dickson', 'Omnis exercitationem', 'Enim magnam magna od', 'Enim eiusmod expedit', 'Venezuela (Bolivarian Republic of)', 'Magna qui occaecat c', 93616, 'lolat@mailinator.com', '099233487824', '09560390918'),
(4, 'Bernard Marsh', 'Accusamus rerum fuga', '1813A Lower Pakigne', '1EWD', 'SDASD', 'Minglanilla', 'Australia', 'Cebu', 6000, 'huhjennifer@gmail.com', '1212121212121', '09560390918'),
(5, 'Keefe Rojas', 'Sed blanditiis conse', 'Jessamine Pennington', 'Et et consectetur fu', 'Expedita excepteur a', 'Quae obcaecati duis', 'Korea (the Democratic People\'s Republic of)', 'Et illum quam in sa', 47484, 'huhjennifer@gmail.com', '099233487824', '8357'),
(6, 'Karyn Jacobson', 'Voluptates sed ratio', 'Maisie Spence', 'Et ratione expedita', 'Doloremque lorem eiu', 'Facere hic atque quo', 'Åland Islands', 'Officia velit ut off', 69821, 'kyqyf@mailinator.com', '9541', '8056'),
(7, 'Xandra Sharpe', 'Similique laborum Q', 'Devin Brooks', 'Qui ea occaecat porr', 'Error recusandae La', 'Sequi cum facere ull', 'Paraguay', 'Esse anim recusanda', 93118, 'topoci@mailinator.com', '9393945', '5579779'),
(8, 'Shaine Crosby', 'Perferendis cupidita', 'Cathleen Harvey', 'Nobis ea nisi non ea', 'Maiores ad excepturi', 'Itaque ipsum vel ir', 'Viet Nam', 'Eveniet impedit in', 26177, 'laviled@mailinator.com', '8311135', '6923688'),
(9, 'Stuart Wheeler', 'Ipsam maxime volupta', 'Judith Branch', 'Aspernatur ullamco o', 'Ea deserunt consecte', 'Autem dolore eum cul', 'Lao People\'s Democratic Republic (the)', 'Modi deleniti sint s', 24212, 'supac@mailinator.com', '457', '788'),
(10, 'Shellie Schmidt', 'Et rem repudiandae d', 'Rana Gomez', 'Duis maiores illo ne', 'Ut id amet delenit', 'Quae repudiandae dui', 'Grenada', 'Eligendi distinctio', 13021, 'mypucely@mailinator.com', '3269', '9589'),
(11, 'Oleg Chapman', 'Minim veniam deseru', 'Garrison Chavez', 'Atque aperiam eligen', 'Ipsum dolor dignissi', 'Ea incidunt dolor n', 'Italy', 'Voluptas labore mole', 65212, 'fuhivaf@mailinator.com', '7777', '4323'),
(12, 'Fay Ellison', 'Ipsam ipsa quos in', 'Gabriel Henderson', 'Alias libero tempor', 'Et fugit tempor off', 'Ullam explicabo Qui', 'Philippines (the)', 'Ut voluptatem volup', 36187, 'jonwilyammayormita@gmail.com', '8136', '3306'),
(13, 'Owen York', 'Modi iste tempor lab', 'Brennan Steele', 'Qui facere dolore ut', 'Cupidatat labore a n', 'Aute facilis dolore', 'Korea (the Democratic People\'s Republic of)', 'Illum commodi est s', 59300, 'hutydunaba@mailinator.com', '099233487824', '09560390918'),
(14, 'Haviva Rios', 'Voluptatem quae vol', 'Kennan Schultz', 'Velit lorem placeat', 'Voluptatibus ut occa', 'Architecto unde ea i', 'Turkmenistan', 'Incididunt nesciunt', 82635, 'sejul@mailinator.com', '1424497', '3441888'),
(15, 'Stacey Santos', 'Voluptatem Ut volup', 'Cassandra Burris', 'Consequatur Omnis h', 'Quia animi est volu', 'Duis dicta eu qui ir', 'Azerbaijan', 'Quam enim accusantiu', 90016, 'cuvefumyvo@mailinator.com', '7979', '3551'),
(16, 'Nigel Nielsen', 'Voluptas in voluptat', 'Beau English', 'Sit quasi quo volup', 'Qui elit quia vitae', 'Qui et neque repudia', 'Tonga', 'Sunt odit sed dolor', 21502, 'lopitylon@mailinator.com', '5467', '6179'),
(17, 'Mona Lancaster', 'Laudantium et elit', 'Tatyana Larsen', 'Qui pariatur Do aut', 'Sapiente magna offic', 'Ad in ipsa molestia', 'Kenya', 'Illo exercitation nu', 95988, 'kedum@mailinator.com', '1506', '7697'),
(18, 'Ross Maxwell', 'Odit sapiente conseq', 'Carla Gonzalez', 'Consectetur sint od', 'Aliquid non vel volu', 'Et eiusmod reprehend', 'Holy See (the)', 'Reiciendis unde beat', 53254, 'hycoryneq@mailinator.com', '7327474', '7111185'),
(19, 'Shafira Strong', 'Voluptas inventore q', 'Harding Dale', 'Sit eligendi culpa', 'Dicta quo praesentiu', 'Rerum in maiores arc', 'Gabon', 'Error dignissimos in', 59407, 'wonox@mailinator.com', '9279', '6384'),
(20, 'Yoshio Hendrix', 'Beatae blanditiis fu', 'Eaton Gallegos', 'At ullam in doloremq', 'Excepturi obcaecati', 'Vel et eligendi et n', 'Jordan', 'Autem sed maiores id', 47120, 'hisolygu@mailinator.com', '1502', '6692'),
(21, 'Cadman Graves', 'Aspernatur dolores u', 'Abigail Hicks', 'Sequi aperiam labori', 'Id quia culpa perfer', 'Ducimus molestiae s', 'Kyrgyzstan', 'Voluptatem aute dol', 30606, 'fubibora@mailinator.com', '1753', '2157'),
(22, 'MacKensie Pollard', 'Eius occaecat qui om', 'Madeson Drake', 'Sed voluptate except', 'Sunt quis non et con', 'Consequatur aut bea', 'Lebanon', 'Sint mollit explica', 10777, 'fipigybib@mailinator.com', '6743', '5283'),
(23, 'Libby Barnett', 'Voluptate quo asperi', 'Lana Wallace', 'Totam in consequatur', 'Fugiat deleniti lib', 'Consequatur consequa', 'Papua New Guinea', 'Odio accusantium nem', 80225, 'hypuwozi@mailinator.com', '2797', '3624'),
(24, 'Kareem Goodwin', 'Consectetur labore', 'Xerxes Haley', 'Saepe asperiores nob', 'Ipsam sapiente offic', 'Accusantium doloremq', 'Botswana', 'Culpa dignissimos e', 23344, 'tycubizewe@mailinator.com', '2', '719'),
(25, 'Sacha Schmidt', 'Incidunt maxime pro', 'Caldwell Conway', 'Fugit officia incid', 'Perferendis incididu', 'Et ab ex perspiciati', 'Aruba', 'In commodi omnis dol', 96971, 'fupyqojyzi@mailinator.com', '43', '12'),
(26, 'Bernard Marsh', 'Accusamus rerum fuga', '1813A Lower Pakigne', 'Cillum sunt id id e', 'SDASD', 'Minglanilla', 'Korea (the Democratic People\'s Republic of)', 'Cebu', 6000, 'jonwilyammayormita@gmail.com', '099233487824', '09560390918'),
(27, 'Jael Morton', 'Sed cupiditate qui l', 'Jonah Kaufman', 'Veritatis qui invent', 'Corrupti ullam nihi', 'Qui expedita corrupt', 'Cayman Islands (the)', 'Ab optio at a accus', 12351, 'dakawokyza@mailinator.com', '8167', '6664');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_minfo`
--

CREATE TABLE `tbl_minfo` (
  `m_id` int(50) NOT NULL,
  `m_lname` varchar(100) NOT NULL,
  `m_fname` varchar(100) NOT NULL,
  `m_middle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_minfo`
--

INSERT INTO `tbl_minfo` (`m_id`, `m_lname`, `m_fname`, `m_middle`) VALUES
(1, 'Langley', 'Mohammad', 'Proident eum ea sin'),
(2, 'Mayormita', 'Lyn', 'N'),
(3, 'Foster', 'Martina', 'Sed temporibus labor'),
(4, 'Mayormita', 'John William', 'N'),
(5, 'Moss', 'Colin', 'Labore minima dolore'),
(6, 'Powers', 'Sybil', 'Minim fugiat maxime'),
(7, 'Lynch', 'Rina', 'Fugiat enim nulla d'),
(8, 'Bush', 'Larissa', 'Animi dignissimos e'),
(9, 'Downs', 'Abdul', 'Aliquid voluptas qui'),
(10, 'Crane', 'Unity', 'Sapiente aliquip bea'),
(11, 'Witt', 'Rowan', 'In sint totam aut e'),
(12, 'Velazquez', 'Adrian', 'Repudiandae a accusa'),
(13, 'Mercado', 'Veronica', 'Odio et aut aut mole'),
(14, 'Mcpherson', 'Regina', 'In dolorem in tempor'),
(15, 'Mcleod', 'Brooke', 'Voluptatem Dolores'),
(16, 'Delaney', 'Aladdin', 'Beatae quidem ducimu'),
(17, 'Gonzales', 'John', 'Illum sit quasi vol'),
(18, 'Britt', 'Reuben', 'Ipsa nemo nihil inc'),
(19, 'Lancaster', 'Madeson', 'Dignissimos suscipit'),
(20, 'Porter', 'Ulric', 'Voluptate ut delectu'),
(21, 'Porter', 'Sopoline', 'Magni ipsam ullam fu'),
(22, 'Kidd', 'Elvis', 'Amet expedita venia'),
(23, 'Vazquez', 'Bertha', 'Consectetur archite'),
(24, 'Mosley', 'Jemima', 'Consectetur iusto co'),
(25, 'Watts', 'Kay', 'Aut consequatur Qui'),
(26, 'Mayormita', 'John William', 'N'),
(27, 'Webb', 'Jamalia', 'Voluptate eu duis as');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal`
--

CREATE TABLE `tbl_personal` (
  `p_id` int(50) NOT NULL,
  `p_lname` varchar(100) NOT NULL,
  `p_fname` varchar(100) NOT NULL,
  `p_middle` varchar(100) NOT NULL,
  `p_bdate` date NOT NULL,
  `p_sex` varchar(100) NOT NULL,
  `p_civilstatus` varchar(100) NOT NULL,
  `p_taxno` int(50) NOT NULL,
  `p_religion` varchar(100) NOT NULL,
  `p_nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_personal`
--

INSERT INTO `tbl_personal` (`p_id`, `p_lname`, `p_fname`, `p_middle`, `p_bdate`, `p_sex`, `p_civilstatus`, `p_taxno`, `p_religion`, `p_nationality`) VALUES
(1, 'Gregory', 'Sierra', 'Ad doloribus est hic', '0000-00-00', 'Male', 'Widowed', 123, 'Fuga Tempore quis', 'Veniam accusamus ve'),
(2, 'Mayormita', 'John William', 'none', '2004-04-13', 'Male', 'Divorced', 123, 'Catholic', 'Pinoy'),
(3, 'Dodson', 'Carol', 'Consectetur possimu', '2003-10-12', 'Female', 'Widowed', 123, 'Minus dignissimos co', 'Elit quibusdam quia'),
(4, 'Huh', 'Jennifer', 'Yunjin', '2025-04-13', 'Female', 'Married', 123, 'Catholic', 'Korean'),
(5, 'Huh', 'Jennifer', 'Yunjin', '2001-03-28', 'Female', 'Married', 143, 'Possimus quis est', 'Soluta officiis qui'),
(6, 'Conley', 'Rebekah', 'Beatae rerum ratione', '1997-04-08', 'Male', 'Single', 123, 'Aut possimus blandi', 'Voluptatum laborum i'),
(7, 'Cruz', 'Madison', 'Ullam facilis eos al', '1977-12-25', 'Male', 'Widowed', 123, 'Dolor id quos ut exc', 'Tempor voluptas hic'),
(8, 'Buck', 'Hilel', 'Ullam a sint aliqua', '2001-02-24', 'Male', 'Single', 123, 'Magni amet aspernat', 'Illum corrupti in'),
(9, 'Calhoun', 'Rigel', 'Mollitia laboriosam', '1983-07-20', 'Female', 'Married', 123, 'Officia aliquid dolo', 'Quae ratione veritat'),
(10, 'Berry', 'Lyle', 'Irure consectetur la', '1974-06-22', 'Female', 'Divorced', 123, 'Dignissimos quis mag', 'Quae fugiat eu tenet'),
(11, 'Thornton', 'Zeph', 'Ea ipsam cupiditate', '2002-03-18', 'Female', 'Separated', 123, 'Ducimus quo eligend', 'Et aliqua Officia n'),
(12, 'Mayormita', 'John Wilyam', 'A', '2004-04-13', 'Male', 'Divorced', 143, 'Vel quidem dolor adi', 'Ea quam esse ut lab'),
(13, 'Delaney', 'Harlan', 'Ezra', '1974-06-09', 'Female', 'Single', 123, 'Illo qui et tempor r', 'Dolorum pariatur Co'),
(14, 'Hinton', 'Thor', 'Dolore', '1974-03-31', 'Male', 'Divorced', 123, 'Fuga Eius autem tem', 'Libero molestiae cup'),
(15, 'Gallagher', 'Abra', 'Et deserunt id volup', '1983-10-06', 'Male', 'Divorced', 123, 'Iusto esse deleniti', 'Et qui eaque ut est'),
(16, 'Hickman', 'Silas', 'Neque enim ut enim t', '2003-12-01', 'Male', 'Widowed', 123, 'Voluptate rem vel si', 'Ad minima dolores fu'),
(17, 'Marquez', 'Mariam', 'Fugiat maiores natu', '1987-04-16', 'Female', 'Others', 123, 'Dolore ducimus dolo', 'Optio possimus ver'),
(18, 'Travis', 'Curran', 'Temporibus aperiam m', '2003-07-29', 'Male', 'Widowed', 123, 'Consequatur Rerum q', 'Et quis ea magna exp'),
(19, 'Mathews', 'Lewis', 'Cillum laboris exerc', '2004-08-27', 'Female', 'Separated', 123, 'Deleniti voluptatem', 'Sit lorem facilis lo'),
(20, 'Howe', 'Russell', 'Alias saepe eos volu', '2000-09-06', 'Male', 'Others', 123, 'Eligendi voluptas vi', 'In aute aliquid eius'),
(21, 'Swanson', 'Hector', 'Est do ipsum dignis', '1996-02-04', 'Male', 'Single', 123, 'Aute suscipit ut id', 'Et architecto eum es'),
(22, 'Sargent', 'Amelia', 'Commodo dolor quas l', '2002-03-21', 'Female', 'Widowed', 123, 'Mollitia ut ut qui d', 'In in iste soluta mo'),
(23, 'Park', 'Kylee', 'Reiciendis eum eos e', '1985-02-08', 'Female', 'Married', 123, 'Sed ut doloribus min', 'Qui cumque qui simil'),
(24, 'Gross', 'Kenneth', 'Natus pariatur Sapi', '1978-07-01', 'Male', 'Others', 123, 'Sequi libero similiq', 'Est magni architect'),
(25, 'Jensen', 'Reagan', 'Debitis qui suscipit', '2003-04-30', 'Male', 'Divorced', 123, 'Pariatur Anim nostr', 'Esse eum cum unde si'),
(26, 'Mayormita', 'John William', 'none', '2002-03-06', 'Male', 'Single', 123, 'Catholic', 'Pinoy'),
(27, 'Terrell', 'Chantale', 'm', '2004-03-29', 'Female', 'Single', 123, 'Exercitation veritat', 'Et nihil maxime repr');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_placeofbirth`
--

CREATE TABLE `tbl_placeofbirth` (
  `pob_id` int(50) NOT NULL,
  `pob_unitno` varchar(100) NOT NULL,
  `pob_blk` varchar(100) NOT NULL,
  `pob_sn` varchar(100) NOT NULL,
  `pob_subdivision` varchar(100) NOT NULL,
  `pob_barangay` varchar(100) NOT NULL,
  `pob_city` varchar(100) NOT NULL,
  `pob_country` varchar(100) NOT NULL,
  `pob_province` varchar(100) NOT NULL,
  `pob_zipcode` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_placeofbirth`
--

INSERT INTO `tbl_placeofbirth` (`pob_id`, `pob_unitno`, `pob_blk`, `pob_sn`, `pob_subdivision`, `pob_barangay`, `pob_city`, `pob_country`, `pob_province`, `pob_zipcode`) VALUES
(1, 'Bradley Nolan', 'Anim sed lorem repud', 'Lara Pate', 'Voluptates adipisici', 'Provident eos enim', 'Et cillum aut dolore', 'Israel', 'Nisi iste fugiat im', 20326),
(2, 'dasd', 'awawaaw', 'Curvada', 'asdad', 'Banhigan', 'Badian', 'Philippines (the)', 'Cebu', 6000),
(3, 'Hedda Oconnor', 'Voluptas repudiandae', 'Alika Thomas', 'Non ratione sit ad q', 'Velit fuga Iure co', 'Veritatis saepe obca', 'Saint Lucia', 'Optio aut delectus', 57664),
(4, 'dasd', 'awawaaw', 'Heart nako', 'Basta', 'Taga Pakigne', 'Minglanilla', 'Korea (the Democratic People\'s Republic of)', 'Cebu', 6000),
(5, 'Nola Farmer', 'Sunt nisi quo qui de', 'Virginia Gay', 'Rerum incididunt fac', 'Eum perferendis et a', 'Distinctio Harum mo', 'Australia', 'Provident et corpor', 27813),
(6, 'Zachery Cabrera', 'Corrupti eius aut f', 'Katelyn Bonner', 'Quae qui est alias r', 'Soluta ut temporibus', 'Et est consectetur', 'Bosnia and Herzegovina', 'Illum est porro ess', 73179),
(7, 'Anne Walker', 'Amet asperiores omn', 'Megan Shannon', 'Quos laboriosam qua', 'Quod et harum rerum', 'Rerum vel maiores in', 'Djibouti', 'Exercitationem rerum', 88117),
(8, 'Tasha Chase', 'Est quis est dolore', 'Abdul Flowers', 'Adipisci eligendi re', 'Quis ab perferendis', 'Excepteur excepturi', 'Australia', 'Cillum facilis molli', 54923),
(9, 'Rebecca Velazquez', 'Iste id nostrud Nam', 'Isabelle Evans', 'Non sed asperiores e', 'Veritatis nisi verit', 'Adipisicing pariatur', 'Fiji', 'Mollitia tempore si', 32206),
(10, 'Cailin Adkins', 'Qui tenetur libero e', 'Yolanda Myers', 'Harum similique plac', 'Impedit quae ipsa', 'Delectus enim conse', 'El Salvador', 'Dicta fugit consect', 78260),
(11, 'Patrick Rodriquez', 'Et incididunt conseq', 'Rafael Malone', 'Eos vitae velit tem', 'Deserunt nisi culpa', 'Anim et et aperiam o', 'Norfolk Island', 'Possimus ipsam ipsa', 85146),
(12, 'Rae Sykes', 'Accusamus molestiae', 'Addison Collier', 'Tempor aut quis ab s', 'Laborum numquam debi', 'Provident voluptas', 'Philippines (the)', 'Eveniet voluptatem', 92516),
(13, 'Miranda Fletcher', 'Error commodi blandi', 'September Gutierrez', 'Labore omnis esse mo', 'Voluptatem officiis', 'Debitis voluptatem l', 'Hong Kong', 'Et reprehenderit la', 89690),
(14, 'Moana England', 'Provident ut sint d', 'Evangeline Davis', 'Eveniet anim soluta', 'Sunt aliquam sint', 'Quo est labore non u', 'Mali', 'Sunt qui nulla volup', 45015),
(15, 'Francesca Wilkerson', 'Voluptas ratione aut', 'Amity Mcmillan', 'Non voluptatem quod', 'Necessitatibus sunt', 'Explicabo Quae quid', 'Armenia', 'Cum reprehenderit f', 94833),
(16, 'Kyla Valdez', 'Facilis voluptate ve', 'Arsenio Gamble', 'Aut alias ratione nu', 'Odio ea mollitia com', 'Eaque ipsam voluptas', 'Cocos (Keeling) Islands (the)', 'Eaque dolor ad corpo', 50142),
(17, 'Dean Castaneda', 'Similique laboriosam', 'Hashim Rocha', 'Blanditiis neque id', 'Veniam culpa ipsam', 'Lorem perferendis si', 'Falkland Islands (the) [Malvinas]', 'Est magnam ab in ill', 85530),
(18, 'Keelie Ruiz', 'Iste amet eius ex a', 'Remedios Bennett', 'Dolore et nobis dist', 'Labore sunt ea ipsu', 'Reprehenderit nostru', 'Korea (the Democratic People\'s Republic of)', 'Molestiae earum qui', 23214),
(19, 'Nicole Melton', 'Non quam do pariatur', 'Dolan Webb', 'Commodo voluptatem n', 'Ut perferendis conse', 'Nemo veniam autem e', 'Tonga', 'Omnis sit libero il', 47316),
(20, 'Dexter Stein', 'Iste accusamus molli', 'Keelie Parker', 'Autem nostrum conseq', 'Assumenda ut praesen', 'Nisi atque non amet', 'Ireland', 'Hic eum esse ipsum d', 92887),
(21, 'Jelani Robertson', 'Sequi consequatur e', 'Dominic Guy', 'Architecto qui sed i', 'Quasi consectetur un', 'Nesciunt non maiore', 'Papua New Guinea', 'Similique ab dolore', 60793),
(22, 'Sage Burks', 'Aute eveniet dolore', 'Benedict Barry', 'Consequat Ipsa con', 'Voluptatum do quam f', 'Neque amet qui mole', 'Ethiopia', 'Aut unde nulla animi', 37113),
(23, 'Timon Conway', 'Sunt incididunt sap', 'Colton Stuart', 'Nihil ipsum ut culp', 'Aliquam animi quos', 'Id numquam dolor sed', 'Burkina Faso', 'Nesciunt ea fugit', 56789),
(24, 'Hanna Kim', 'Amet aut autem quae', 'Ethan Ray', 'Repudiandae dolore s', 'Labore adipisicing q', 'Aut nulla distinctio', 'Greenland', 'Iure odit magnam pro', 37460),
(25, 'Chandler Morrow', 'Delectus ea ut elit', 'Randall Craft', 'Qui aut explicabo E', 'Ut velit eu quia di', 'Maxime consequuntur', 'Germany', 'Earum laborum Anim', 81047),
(26, 'dasd', 'awawaaw', '1813A Lower Pakigne', 'asdad', 'adasd', 'Minglanilla', 'Philippines (the)', 'Cebu', 6000),
(27, 'Uriel Rush', 'Eveniet dicta cum v', 'Belle Guerra', 'Ut rem officia venia', 'Dolorum amet nobis', 'Sint sunt ad ut con', 'New Caledonia', 'Ut et ut omnis dolor', 21500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_finfo`
--
ALTER TABLE `tbl_finfo`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tbl_hadress`
--
ALTER TABLE `tbl_hadress`
  ADD PRIMARY KEY (`ha_id`);

--
-- Indexes for table `tbl_minfo`
--
ALTER TABLE `tbl_minfo`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_personal`
--
ALTER TABLE `tbl_personal`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_placeofbirth`
--
ALTER TABLE `tbl_placeofbirth`
  ADD PRIMARY KEY (`pob_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_finfo`
--
ALTER TABLE `tbl_finfo`
  MODIFY `f_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_hadress`
--
ALTER TABLE `tbl_hadress`
  MODIFY `ha_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_minfo`
--
ALTER TABLE `tbl_minfo`
  MODIFY `m_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_personal`
--
ALTER TABLE `tbl_personal`
  MODIFY `p_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_placeofbirth`
--
ALTER TABLE `tbl_placeofbirth`
  MODIFY `pob_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
