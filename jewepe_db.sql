-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 01:56 AM
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
-- Database: `jewepe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'admin', '$2y$10$3OrncKQgQ8w0vMFm/OKovOAM6ODQHGoiiI/1pp.vdpf96PeXnws86', '2024-07-29 15:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(15) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `admin_message` text DEFAULT NULL,
  `booking_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `service_id`, `customer_name`, `customer_phone`, `customer_email`, `booking_date`, `status`, `admin_message`, `booking_number`, `created_at`, `updated_at`) VALUES
(2, 1, 'Johansyah Diaz', '08999131287', 'johansyah.diaz8@gmail.com', '2024-07-27', 'diterima', 'kami akan segera proses', '26988', '2024-07-31 01:04:25', '2024-07-31 01:09:50'),
(3, 4, 'Johansyah Diaz', '08999131287', 'johansyah.diaz8@gmail.com', '2024-07-30', 'ditolak', 'kami belum siap', '02285', '2024-07-31 01:05:22', '2024-07-31 01:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `image_url`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Layanan Konsultasi Pernikahan', 'Sesi konsultasi awal untuk memahami visi dan konsep pernikahan Anda. Tim kami akan memberikan saran dan rekomendasi yang tepat untuk mewujudkan pernikahan impian Anda.', 1500000.00, 'sandy-millar-8vaQKYnawHw-unsplash.jpg', 0, '2024-07-29 15:59:39', '2024-07-31 01:19:17'),
(2, 'Paket Pernikahan Lengkap', 'Paket all-in-one yang mencakup segala aspek pernikahan mulai dari dekorasi, catering, dokumentasi, hingga hiburan. Tim kami akan mengurus semua detail agar Anda bisa fokus menikmati momen istimewa.', 50000000.00, 'drew-coffman-llWjwo200fo-unsplash.jpg', 1, '2024-07-30 12:05:11', '2024-07-30 12:05:11'),
(4, 'Layanan Dekorasi', 'Dekorasi elegan dan personal untuk acara pernikahan Anda, termasuk dekorasi panggung, meja tamu, dan area resepsi.', 15000000.00, 'pexels-asadphoto-169198.jpg', 1, '2024-07-31 00:57:48', '2024-07-31 00:57:48'),
(5, 'Layanan Catering', 'Menu makanan dan minuman yang disesuaikan dengan selera Anda dan tamu undangan. Kami menyediakan berbagai pilihan menu dari tradisional hingga internasional.', 100000.00, 'pexels-mastercowley-1128783.jpg', 1, '2024-07-31 00:58:59', '2024-07-31 00:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(11) NOT NULL,
  `about_us` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `about_us`, `address`, `email`, `phone`, `facebook_url`, `instagram_url`, `twitter_url`, `updated_at`) VALUES
(1, 'JeWePe Wedding Organizer adalah mitra tepercaya Anda dalam merencanakan dan mewujudkan pernikahan impian. Dengan pengalaman bertahun-tahun di industri pernikahan, kami berkomitmen untuk menghadirkan layanan terbaik dan personalisasi penuh untuk setiap pasangan. Tim profesional kami menggabungkan kreativitas, detail, dan dedikasi untuk menciptakan momen tak terlupakan yang mencerminkan keunikan cinta Anda. Dari konsultasi awal hingga hari besar, JeWePe Wedding Organizer selalu siap mendampingi Anda dalam setiap langkah, memastikan setiap detail sempurna dan setiap momen spesial. Bersama JeWePe, pernikahan impian Anda akan menjadi kenyataan yang lebih indah dari yang pernah Anda bayangkan.', '123 Wedding Street, City, Country 12345', '1@a.com', '081227364333', 'https://www.facebook.com/johansyah.diaz?locale=id_ID', 'https://www.facebook.com/johansyah.diaz?locale=id_ID', 'https://www.facebook.com/johansyah.diaz?locale=id_ID', '2024-07-31 13:38:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
