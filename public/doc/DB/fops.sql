-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2023 at 09:04 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fops`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `element_id` bigint(20) UNSIGNED NOT NULL,
  `is_debit` tinyint(1) NOT NULL DEFAULT '0',
  `is_credit` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advanced_salaries`
--

CREATE TABLE `advanced_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advanced_salary_details`
--

CREATE TABLE `advanced_salary_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advanced_salary_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `installment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cash_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advanced_salary_paid_details`
--

CREATE TABLE `advanced_salary_paid_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advanced_salary_details_id` bigint(20) UNSIGNED NOT NULL,
  `installment_pay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashes`
--

CREATE TABLE `cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cashes`
--

INSERT INTO `cashes` (`id`, `cash_name`, `balance`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Main cash', '950.00', 'n/a', '2022-04-07 01:08:55', '2023-05-13 21:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organigation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'Positive(+) balance payable and negative(-) is receivable.',
  `current_balance` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'Positive(+) balance payable and negative(-) is receivable.',
  `credit_limit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_addresses`
--

CREATE TABLE `contact_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `street` text COLLATE utf8mb4_unicode_ci,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `union` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazila` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `mobile_no`, `balance`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Mahmudur Rahman', '01971072007', '100.00', NULL, '2023-04-06 00:41:43', '2023-05-13 21:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `sub_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `voucher_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `fabric_bill` decimal(12,2) NOT NULL DEFAULT '0.00',
  `fabric_paid` decimal(12,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `customer_id`, `date`, `order_no`, `delivery_date`, `sub_total`, `discount_type`, `discount`, `voucher_amount`, `fabric_bill`, `fabric_paid`, `user_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-05-08', '123', '2023-05-15', '1050.00', 'flat', '100.00', '0.00', '0.00', '0.00', 1, 1, NULL, '2023-05-08 05:32:11', '2023-05-13 21:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `depreciations`
--

CREATE TABLE `depreciations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_id` bigint(20) UNSIGNED NOT NULL,
  `years` int(11) NOT NULL COMMENT 'approximate use of year',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT 'fund per year',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `depreciation_details`
--

CREATE TABLE `depreciation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date NOT NULL,
  `depreciation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `design_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `design_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '২ কুচি,ক্রস পকেট,ব্যাক পকেট ০১টা', NULL, NULL, '2022-05-15 22:12:31', '2022-05-15 22:12:31'),
(2, '২ কুচি,ক্রস পকেট,ব্যাক পকেট ০২টা', NULL, NULL, '2022-05-15 22:13:04', '2022-05-15 22:13:04'),
(3, '১ কুচি,ক্রস পকেট,ব্যাক পকেট ০১টা', NULL, NULL, '2022-05-15 22:13:41', '2022-05-15 22:13:41'),
(4, '১ কুচি,ক্রস পকেট,ব্যাক পকেট ০২টা', NULL, NULL, '2022-05-15 22:14:02', '2022-05-15 22:14:02'),
(5, 'কুচি হবে না , ক্রস পকেট ,ব্যাক পকেট ০১ টা', NULL, NULL, '2022-05-15 22:14:34', '2022-05-15 22:14:34'),
(6, 'কুচি হবে না , ক্রস পকেট ,ব্যাক পকেট ০২ টা', NULL, NULL, '2022-05-15 22:15:03', '2022-05-15 22:15:03'),
(7, '২ কুচি , সোজা পকেট , ব্যাক পকেট ০১ টা', NULL, NULL, '2022-05-15 22:15:24', '2022-05-15 22:15:24'),
(8, '২ কুচি , সোজা পকেট , ব্যাক পকেট ০২ টা', NULL, NULL, '2022-05-15 22:16:04', '2022-05-15 22:16:04'),
(9, 'গেবার্ডিন সম্পূর্ণ ডাবল সেলাই নিচে মেশিন সেলাই হবে', NULL, NULL, '2022-05-15 22:16:24', '2022-05-15 22:16:24'),
(10, 'সম্পূর্ণ জিন্স স্টাইল প্যান্ট হবে', NULL, NULL, '2022-05-15 22:16:47', '2022-05-15 22:16:47'),
(11, 'BCS রাউন্ড পকেট হবে', NULL, NULL, '2022-05-15 22:17:31', '2022-05-15 22:17:31'),
(12, 'ক্রস বন পকেট হবে', NULL, NULL, '2022-05-15 22:18:00', '2022-05-15 22:18:00'),
(13, 'ক্রস পকেটে পাইপিন হবে', NULL, NULL, '2022-05-15 22:18:37', '2022-05-15 22:18:37'),
(14, 'হিপ ফ্রি হবে', NULL, NULL, '2022-05-15 22:19:08', '2022-05-15 22:19:08'),
(15, 'হিপ ফিটিং হবে', NULL, NULL, '2022-05-15 22:19:40', '2022-05-15 22:19:40'),
(16, '২ কুঁচি', NULL, NULL, '2022-05-15 22:20:33', '2022-05-15 22:20:33'),
(17, '১ কুঁচি', NULL, NULL, '2022-05-15 22:20:57', '2022-05-15 22:20:57'),
(18, 'কুঁচি হবে না', NULL, NULL, '2022-05-15 22:21:29', '2022-05-15 22:21:29'),
(19, '৬ লুপ', NULL, NULL, '2022-05-15 22:22:08', '2022-05-15 22:22:08'),
(20, '৭ লুপ', NULL, NULL, '2022-05-15 22:22:57', '2022-05-15 22:22:57'),
(21, '৮ লুপ', NULL, NULL, '2022-05-15 22:23:41', '2022-05-15 22:23:41'),
(22, '৯ লুপ', NULL, NULL, '2022-05-15 22:25:02', '2022-05-15 22:25:02'),
(23, 'ক্রস পকেট', NULL, NULL, '2022-05-15 22:26:06', '2022-05-15 22:26:06'),
(24, 'সোজা পকেট', NULL, NULL, '2022-05-15 22:26:52', '2022-05-15 22:26:52'),
(25, 'ব্যাক পকেট ০১ টা', NULL, '2022-05-16 00:38:18', '2022-05-15 22:28:28', '2022-05-16 00:38:18'),
(26, 'ব্যাক পকেট ০২ টা', NULL, '2022-05-16 00:38:24', '2022-05-15 22:37:47', '2022-05-16 00:38:24'),
(27, 'ব্যাক পকেট হবে না', NULL, '2022-05-16 00:38:29', '2022-05-15 23:11:31', '2022-05-16 00:38:29'),
(28, 'ছোট কুঁচি', NULL, NULL, '2022-05-15 23:15:23', '2022-05-15 23:15:23'),
(29, 'লং বেল্ট বুতাম মাথা V হবে', NULL, NULL, '2022-05-15 23:19:31', '2022-05-15 23:19:31'),
(30, 'লং বেল্ট বুতাম মাথা সোজা হবে / রাউন্ড হবে', NULL, NULL, '2022-05-15 23:21:46', '2022-05-15 23:21:46'),
(31, 'কাড বেল্ট বুতাম হবে', NULL, NULL, '2022-05-15 23:22:10', '2022-08-10 13:02:26'),
(32, 'সাইডে লবে এক সেলাই নিচে মেশিন সেলাই হবে', NULL, NULL, '2022-05-15 23:23:27', '2022-05-15 23:23:27'),
(33, 'ব্যাক জিন্স স্টাইল হবে', NULL, NULL, '2022-05-15 23:23:53', '2022-05-15 23:23:53'),
(34, 'লুপ বুতাম', NULL, NULL, '2022-05-15 23:24:10', '2022-05-15 23:24:10'),
(35, 'মোবাইল পকেট হবে', NULL, NULL, '2022-05-15 23:24:31', '2022-05-15 23:24:31'),
(36, '1/2 সিংগেল বন', NULL, NULL, '2022-05-15 23:24:51', '2022-05-15 23:24:51'),
(37, 'ডাবল বন', NULL, NULL, '2022-05-15 23:25:15', '2022-05-15 23:25:15'),
(38, 'পিছনের পকেটে কাজঘর + বুতাম হবে না', NULL, NULL, '2022-05-15 23:25:39', '2022-05-15 23:25:39'),
(39, 'ব্যাক হাই বড়', NULL, NULL, '2022-05-15 23:26:10', '2022-05-15 23:26:10'),
(40, 'রাউন্ড হাই বড়', NULL, NULL, '2022-05-15 23:26:50', '2022-05-15 23:26:50'),
(41, 'তলপেট ভারী', NULL, NULL, '2022-05-15 23:27:10', '2022-05-15 23:27:10'),
(42, 'বেল্টসহ ফ্লাই', NULL, NULL, '2022-05-15 23:28:23', '2022-05-15 23:28:23'),
(43, 'ব্যাক শেপ', NULL, NULL, '2022-05-15 23:28:47', '2022-05-15 23:28:47'),
(44, 'নিচে ফোল্ডিং হবে', NULL, NULL, '2022-05-15 23:42:14', '2022-05-15 23:42:14'),
(45, 'ফ্রন্ট', NULL, '2022-08-10 11:13:11', '2022-05-15 23:42:38', '2022-08-10 11:13:11'),
(46, 'ব্যাক', NULL, '2022-08-10 11:13:42', '2022-05-15 23:42:59', '2022-08-10 11:13:42'),
(47, 'ব্যাক ডাউন', NULL, NULL, '2022-05-15 23:43:15', '2022-05-15 23:43:15'),
(48, 'ফ্রন্ট ডাউন', NULL, NULL, '2022-05-15 23:43:44', '2022-05-15 23:43:44'),
(49, 'জোড়া লুপ', NULL, NULL, '2022-05-15 23:44:13', '2022-05-15 23:44:13'),
(50, 'পুলিশ লুপ', NULL, NULL, '2022-05-15 23:45:03', '2022-05-15 23:45:03'),
(51, 'সাইডে হারমোনিয়াম পকেট', NULL, NULL, '2022-05-15 23:45:26', '2022-05-15 23:45:26'),
(52, 'তালি পকেট', NULL, NULL, '2022-05-15 23:45:50', '2022-05-15 23:45:50'),
(53, 'ওয়েস্ট পকেট ২ টা', NULL, NULL, '2022-05-15 23:46:08', '2022-07-28 11:20:59'),
(54, 'কয়েন পকেট', NULL, NULL, '2022-05-15 23:46:29', '2022-05-15 23:46:29'),
(55, 'পান ঢাকনা / স্কয়ার ঢাকনা', NULL, NULL, '2022-05-15 23:47:04', '2022-05-15 23:47:04'),
(56, 'লুপ হবে না', NULL, NULL, '2022-05-15 23:47:25', '2022-05-15 23:47:25'),
(57, 'ফুল চাইনিজ, বক্সপ্লেট, বুক পকেট ০১ টা', NULL, NULL, '2022-05-15 23:59:23', '2022-05-15 23:59:23'),
(58, 'ফুল চাইনিজ, বক্সপ্লেট লবে সেলাই বুক পকেট ০১ টা', NULL, NULL, '2022-05-16 00:01:15', '2022-05-16 00:01:15'),
(59, 'ফুল চাইনিজ, বক্সপ্লেট লবে সেলাই বুক পকেট হবে না', NULL, NULL, '2022-05-16 00:02:07', '2022-05-16 00:02:07'),
(60, 'ফুল চাইনিজ, নিনোপ্লেট, বুক পকেট ০১ টা', NULL, NULL, '2022-05-16 00:02:40', '2022-05-16 00:02:40'),
(61, 'ফুল চাইনিজ, নিনোপ্লেট, বুক পকেট হবে না', NULL, NULL, '2022-05-16 00:03:17', '2022-05-16 00:03:17'),
(62, 'ফুল চাইনিজ, নিনোপ্লেট, বুক পকেট ০২ টা + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-05-16 00:03:40', '2022-05-16 00:03:40'),
(63, 'ফুল চাইনিজ, বক্সপ্লেট, বুক পকেট ০২ টা + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-05-16 00:04:00', '2022-05-16 00:04:00'),
(64, 'হাফ চাইনিজ, বক্সপ্লেট, বুক পকেট ০১ টা + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-05-16 00:04:25', '2022-05-16 00:04:25'),
(65, 'হাফ ফ্লাইং, সাইড কাটা, বক্সপ্লেট, ০১ পকেট', NULL, NULL, '2022-05-16 00:04:54', '2022-05-16 00:04:54'),
(66, 'হাফ ফ্লাইং/ফুল ফ্লাইং, সাইড কাটা, নিনোপ্লেট, ০১ পকেট', NULL, NULL, '2022-05-16 00:05:18', '2022-05-16 00:05:18'),
(67, 'হাফ ফ্লাইং/ফুল ফ্লাইং, সাইড কাটা, বক্সপ্লেট, ০২ পকেট + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-05-16 00:05:40', '2022-05-16 00:05:40'),
(68, 'হাফ ফ্লাইং/ফুল ফ্লাইং, সাইড কাটা, নিনোপ্লেট, ০২ পকেট + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-05-16 00:05:58', '2022-05-16 00:05:58'),
(69, 'হাফ ফ্লাইং/ফুল ফ্লাইং, সাইড কাটা, নিনোপ্লেট পকেট হবে না', NULL, NULL, '2022-05-16 00:06:14', '2022-05-16 00:06:14'),
(70, '১.২৫/১/.৭৫ ব্যান্ড কলার মাথা রাউন্ড .৫ গ্যাপ হবে', NULL, NULL, '2022-05-16 00:06:57', '2022-05-16 00:06:57'),
(71, '১.২৫/১/.৭৫ ব্যান্ড কলার মাথা সোজা গ্যাপ হবে না', NULL, NULL, '2022-05-16 00:07:35', '2022-05-16 00:07:35'),
(72, 'বাবা শার্ট/ব্যাপারী শার্ট', NULL, NULL, '2022-05-16 00:07:52', '2022-05-16 00:07:52'),
(73, 'বিন্দু ডিজাইন হবে', NULL, NULL, '2022-05-16 00:08:10', '2022-05-16 00:08:10'),
(74, 'ব্যাক শেপ হবে', NULL, NULL, '2022-05-16 00:08:27', '2022-05-16 00:08:27'),
(75, 'ব্যাক শেপ হবে না', NULL, NULL, '2022-05-16 00:09:06', '2022-05-16 00:09:06'),
(76, 'ব্যান্ড সহ ৮ বোতাম হবে', NULL, NULL, '2022-05-16 00:12:22', '2022-05-16 00:12:22'),
(77, 'শেপ টিকেন হবে', NULL, NULL, '2022-05-16 00:12:40', '2022-05-16 00:12:40'),
(78, 'তিরা V হবে', NULL, NULL, '2022-05-16 00:13:02', '2022-05-16 00:13:02'),
(79, 'পকেটের মুখ V সেলাই হবে', NULL, NULL, '2022-05-16 00:13:21', '2022-05-16 00:13:21'),
(80, 'হাতা + পকেট বক্স হবে', NULL, NULL, '2022-05-16 00:13:44', '2022-05-16 00:13:44'),
(81, 'কলার + কফ + পকেট + প্লেট ওরফ হবে', NULL, NULL, '2022-05-16 00:14:04', '2022-05-16 00:14:04'),
(82, 'ডাবল কাপলিং', NULL, NULL, '2022-05-16 00:14:20', '2022-05-16 00:14:20'),
(83, 'সিংগেল কাপলিং', NULL, NULL, '2022-05-16 00:14:37', '2022-05-16 00:14:37'),
(84, '২.৫\" এরো কলার', NULL, NULL, '2022-05-16 00:17:13', '2022-05-16 00:17:13'),
(85, '২.২৫\" এরো কলার', NULL, NULL, '2022-05-16 00:18:07', '2022-05-16 00:18:07'),
(86, '২\" এরো কলার', NULL, NULL, '2022-05-16 00:18:33', '2022-05-16 00:18:33'),
(87, '২.৭৫\" এরো কলার', NULL, NULL, '2022-05-16 00:18:59', '2022-05-16 00:18:59'),
(88, '৩\" এরো কলার', NULL, NULL, '2022-05-16 00:19:26', '2022-05-16 00:19:26'),
(89, '২.৫\" সোজা কলার', NULL, NULL, '2022-05-16 00:20:28', '2022-05-16 00:20:28'),
(90, '২.২৫\" সোজা কলার', NULL, NULL, '2022-05-16 00:20:50', '2022-05-16 00:20:50'),
(91, '২\" সোজা কলার', NULL, NULL, '2022-05-16 00:21:08', '2022-05-16 00:21:08'),
(92, '২.৭৫\" সোজা কলার', NULL, NULL, '2022-05-16 00:21:30', '2022-05-16 00:21:30'),
(93, '৩\" সোজা কলার', NULL, NULL, '2022-05-16 00:21:52', '2022-05-16 00:21:52'),
(94, '২.৫\" টাই কলার', NULL, NULL, '2022-05-16 00:22:21', '2022-05-16 00:22:21'),
(95, '২.২৫\" টাই কলার', NULL, NULL, '2022-05-16 00:22:40', '2022-05-16 00:22:40'),
(96, '২\" টাই কলার', NULL, NULL, '2022-05-16 00:23:02', '2022-05-16 00:23:02'),
(97, '২.৭৫\" টাই কলার', NULL, NULL, '2022-05-16 00:23:23', '2022-05-16 00:23:23'),
(98, '৩\" টাই কলার', NULL, NULL, '2022-05-16 00:24:27', '2022-05-16 00:24:27'),
(99, '২.৫\" ব্যাক এরো কলার', NULL, NULL, '2022-05-16 00:24:51', '2022-05-16 00:24:51'),
(100, '২.২৫\" ব্যাক এরো কলার', NULL, NULL, '2022-05-16 00:25:09', '2022-05-16 00:25:09'),
(101, '২\" ব্যাক এরো কলার', NULL, NULL, '2022-05-16 00:25:34', '2022-05-16 00:25:34'),
(102, '২.৭৫\" ব্যাক এরো কলার', NULL, NULL, '2022-05-16 00:25:57', '2022-05-16 00:25:57'),
(103, '৩\" ব্যাক এরো কলার', NULL, NULL, '2022-05-16 00:26:25', '2022-05-16 00:26:25'),
(104, 'হাতা + মোহড়া + ইজি হবে', NULL, NULL, '2022-05-16 00:27:11', '2022-05-16 00:27:11'),
(105, 'দেড় পকেট', NULL, NULL, '2022-05-16 00:29:47', '2022-05-16 00:29:47'),
(106, 'ব্যাক পকেট', NULL, NULL, '2022-05-16 00:30:07', '2022-05-16 00:30:07'),
(107, '৩\" কোনাকাটা কফ (৪) বোতাম হবে', NULL, NULL, '2022-05-16 00:30:32', '2022-05-16 00:30:32'),
(108, '৩\" সোজা কফ (৪) বোতাম হবে', NULL, NULL, '2022-05-16 00:31:06', '2022-05-16 00:31:06'),
(109, '৩\" রাউন্ড কফ (৪) বোতাম হবে', NULL, NULL, '2022-05-16 00:31:29', '2022-05-16 00:31:29'),
(110, 'বক্স প্লেট - ১\" হবে', NULL, NULL, '2022-05-16 00:31:48', '2022-05-16 00:31:48'),
(111, 'নিনো প্লেট - ১\" হবে', NULL, NULL, '2022-05-16 00:32:07', '2022-05-16 00:32:07'),
(112, 'ফতুয়া - নিচে ফ্লাইং, সাইড কাটা, নিচে (২) পকেট, (১) বুক পকেট', NULL, NULL, '2022-05-16 00:32:27', '2022-05-16 00:32:27'),
(113, 'ফতুয়া - নিচে চাইনিজ, নিচে (২) পকেট, (১) বুক পকেট', NULL, NULL, '2022-05-16 00:32:49', '2022-05-16 00:32:49'),
(114, 'ঘারি দাববে', NULL, NULL, '2022-05-16 00:33:10', '2022-07-26 11:29:15'),
(126, 'ব্যাক পকেট ০১ টা', NULL, NULL, '2022-05-16 00:46:32', '2022-05-16 00:46:32'),
(127, 'ব্যাক পকেট ০২ টা', NULL, NULL, '2022-05-16 00:46:59', '2022-05-16 00:46:59'),
(128, 'ব্যাক পকেট হবে না', NULL, NULL, '2022-05-16 00:47:29', '2022-05-16 00:47:29'),
(129, 'কাড বেল্ট হুক হবে মাথা V / রাউন্ড / সোজা হবে', NULL, NULL, '2022-05-16 00:52:17', '2022-05-16 00:52:17'),
(130, '২ বোতাম, নিচে রাউন্ড, সাইড ওপেন', NULL, NULL, '2022-05-16 00:55:26', '2022-05-16 00:55:26'),
(131, '২ বোতাম, নিচে রাউন্ড, নো ওপেন', NULL, NULL, '2022-05-16 00:56:09', '2022-05-16 00:56:09'),
(132, '৩ বোতাম, নিচে রাউন্ড, সাইড ওপেন', NULL, NULL, '2022-05-16 00:56:42', '2022-05-16 00:56:42'),
(133, '৩ বোতাম, নিচে রাউন্ড, নো ওপেন', NULL, NULL, '2022-05-16 00:59:53', '2022-05-16 00:59:53'),
(134, '১ বোতাম, নিচে রাউন্ড, সাইড ওপেন', NULL, NULL, '2022-05-16 01:00:27', '2022-05-16 01:00:27'),
(135, '১ বোতাম, নিচে রাউন্ড, নো ওপেন', NULL, NULL, '2022-05-16 01:00:59', '2022-05-16 01:00:59'),
(136, '২\" নেপেল', NULL, NULL, '2022-05-16 01:01:36', '2022-05-16 01:01:36'),
(137, '২.২৫\" নেপেল', NULL, NULL, '2022-05-16 01:02:09', '2022-05-16 01:02:09'),
(138, '২.৫\" নেপেল', NULL, NULL, '2022-05-16 01:02:47', '2022-05-16 01:02:47'),
(139, '২.৭৫\" নেপেল', NULL, NULL, '2022-05-16 01:03:46', '2022-05-16 01:03:46'),
(140, '৩\" নেপেল', NULL, NULL, '2022-05-16 01:04:28', '2022-05-16 01:04:28'),
(141, 'সিংগেল বেস্ট কোট', NULL, NULL, '2022-05-16 01:05:46', '2022-05-16 01:05:46'),
(142, 'ডাবল বেস্ট কোট', NULL, NULL, '2022-05-16 01:06:21', '2022-05-16 01:06:21'),
(143, 'ডাবল বেস্ট নেপেল', NULL, NULL, '2022-05-16 01:06:54', '2022-05-16 01:06:54'),
(144, 'ডিনার নেপেল', NULL, NULL, '2022-05-16 01:07:21', '2022-05-16 01:07:21'),
(145, 'সম্পূর্ণ পাইপিন হবে', NULL, NULL, '2022-05-16 01:10:17', '2022-05-16 01:10:17'),
(146, 'নেপেল কাজঘর হবে না', NULL, NULL, '2022-05-16 01:10:45', '2022-05-16 01:10:45'),
(147, 'মুজিব কোট, ০৬ বোতাম, নিচে সোজা, সাইড ওপেন', NULL, NULL, '2022-05-16 01:11:45', '2022-05-16 01:11:45'),
(148, 'মুজিব কোট, ০৫ বোতাম, নিচে সোজা, সাইড ওপেন', NULL, NULL, '2022-05-16 01:12:14', '2022-05-16 01:12:14'),
(149, 'মুজিব কোট, ০৬ বোতাম, নিচে সোজা, নো ওপেন', NULL, NULL, '2022-05-16 01:12:49', '2022-05-16 01:12:49'),
(150, 'শেরওয়ানী, ০৫ বোতাম, নিচে সোজা', NULL, NULL, '2022-05-16 01:13:19', '2022-05-16 01:13:19'),
(151, 'ক্যাটালগ ডিজাইন', NULL, NULL, '2022-05-16 01:13:44', '2022-05-16 01:13:44'),
(152, 'প্রিন্স কোট, ০৫/০৬ বোতাম, নিচে সোজা, সাইড ওপেন', NULL, NULL, '2022-05-16 01:14:13', '2022-05-16 01:14:13'),
(153, 'প্রিন্স কোট, ০৫/০৬ বোতাম, নিচে রাউন্ড, সাইড ওপেন', NULL, NULL, '2022-05-16 01:14:45', '2022-05-16 01:14:45'),
(154, 'প্রিন্স কোট, ০৫/০৬ বোতাম, নিচে সোজা, নো ওপেন', NULL, NULL, '2022-05-16 01:15:20', '2022-05-16 01:15:20'),
(155, 'প্রিন্স কোট, ০৫/০৬ বোতাম, নিচে রাউন্ড, নো ওপেন', NULL, NULL, '2022-05-16 01:15:49', '2022-05-16 01:15:49'),
(156, 'ফুল চাইনিজ,বক্সপ্লেট, বুক পকেট হবে না', NULL, NULL, '2022-06-08 18:16:05', '2022-06-08 18:19:35'),
(157, 'বুক পকেট হবে না', NULL, NULL, '2022-06-08 18:16:22', '2022-06-08 18:16:22'),
(158, 'দের পকেট', NULL, NULL, '2022-06-08 18:16:49', '2022-06-08 18:16:49'),
(159, 'একছাটা পাঞ্জাবি', NULL, NULL, '2022-06-08 18:20:48', '2022-06-08 18:20:48'),
(160, 'মাদানি পাঞ্জাবি', NULL, NULL, '2022-06-08 18:21:10', '2022-06-08 18:21:10'),
(161, 'কোল্লিদার পাঞ্জাবি', NULL, NULL, '2022-06-08 18:21:54', '2022-06-08 18:21:54'),
(162, '১.২৫ ব্যান্ড কলার,মাথা রাউন্ড,১/২\'\' গ্যাপ', NULL, NULL, '2022-06-08 18:25:07', '2022-07-18 12:04:18'),
(163, '১.২৫ ব্যান্ড কলার,মাথা সোজা, গ্যাপ হবেনা', NULL, NULL, '2022-06-08 18:32:03', '2022-06-08 18:32:03'),
(164, 'ফুল ফ্লাইং, সাইড কাটা, বক্সপ্লেট, ০১ পকেট', NULL, NULL, '2022-06-09 08:38:16', '2022-06-09 08:38:16'),
(165, 'হাফ ফ্লাইং, বক্সপ্লেট, ০১ পকেট', NULL, NULL, '2022-06-09 08:38:48', '2022-06-09 08:38:48'),
(166, 'ফুল ফ্লাইং,, বক্সপ্লেট, ০১ পকেট', NULL, NULL, '2022-06-09 08:39:56', '2022-06-09 08:39:56'),
(167, 'হাফ চাইনিজ, বক্সপ্লেট, বুক পকেট ০১ টা', NULL, NULL, '2022-06-13 09:39:08', '2022-06-13 09:39:08'),
(168, 'হাফ চাইনিজ, বক্সপ্লেট, বুক পকেট ০১ টা ,হাতা+পকেট বক্স হবে', NULL, NULL, '2022-06-13 09:41:07', '2022-06-13 09:41:07'),
(169, 'স্যাম্পল ডিজাইন কপি টু কপি', NULL, NULL, '2022-06-14 15:21:40', '2022-06-14 15:21:40'),
(170, 'একছাটা পাইজামা', NULL, NULL, '2022-06-30 12:41:38', '2022-06-30 12:41:38'),
(171, 'সামনে চেইন,সাইড পকেট,কমরে এলাস্তিক ফিতা,পিছনে ১ পকেট', NULL, NULL, '2022-06-30 12:47:15', '2022-06-30 13:06:41'),
(172, 'নিচে পার্টিস', NULL, NULL, '2022-06-30 12:49:44', '2022-06-30 12:49:44'),
(173, 'নিচে ঘনপার্টিস', NULL, NULL, '2022-06-30 12:57:55', '2022-06-30 12:57:55'),
(174, 'সাইডে পকেটে চেইন হবে', NULL, NULL, '2022-06-30 13:00:33', '2022-06-30 13:00:33'),
(175, 'চুরিদার  পাইজামা', NULL, NULL, '2022-06-30 13:07:42', '2022-06-30 13:07:42'),
(176, 'কল্লিদার পাইজামা', NULL, NULL, '2022-06-30 13:08:12', '2022-06-30 13:08:12'),
(177, 'চুস পাইজামা', NULL, NULL, '2022-06-30 13:08:42', '2022-06-30 13:08:42'),
(178, 'প্যান্ট কাটিং পাইজামা', NULL, NULL, '2022-06-30 13:09:48', '2022-06-30 13:09:48'),
(179, 'শর্ট বেল্ট বুতাম হবে', NULL, NULL, '2022-07-03 16:12:18', '2022-07-03 16:12:18'),
(180, 'লং বেল্ট বুতাম হবে', NULL, NULL, '2022-07-03 16:12:59', '2022-07-03 16:12:59'),
(181, 'প্লেটে ২ পাশেই কাজঘর হবে', NULL, NULL, '2022-07-04 09:44:59', '2022-07-04 09:44:59'),
(182, 'চেইন বুতাম হবে', NULL, NULL, '2022-07-04 09:45:29', '2022-07-04 09:45:29'),
(183, 'হাফ চাইনিজ, নিনো প্লেট, বুক পকেট ০১ টা', NULL, NULL, '2022-07-18 11:52:03', '2022-07-18 12:02:54'),
(184, 'হাফ ফ্লাইং, সাইড কাটা,নিনো প্লেট,  ০১ পকেট', NULL, NULL, '2022-07-18 12:01:19', '2022-07-18 12:02:24'),
(185, 'ফুল চাইনিজ, বক্সপ্লেট, বুক পকেট হবে না', NULL, NULL, '2022-07-18 14:58:33', '2022-07-18 14:58:33'),
(186, 'পিছনের ২ পকেটে কাজঘর + বুতাম হবে', NULL, NULL, '2022-07-19 15:43:12', '2022-07-19 15:43:12'),
(187, 'মনোগ্রাম হবে', NULL, NULL, '2022-07-25 14:36:53', '2022-07-25 14:36:53'),
(188, '০২ পকেট + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-07-25 14:39:42', '2022-07-25 14:39:42'),
(189, 'প্লেটে কোন সেলাই হবেনা', NULL, NULL, '2022-07-27 12:42:20', '2022-07-27 12:42:20'),
(190, 'প্লেটের মাথা V হবে', NULL, NULL, '2022-07-27 12:43:37', '2022-07-27 12:43:37'),
(191, 'প্লেটের মাথা সোজা হবে', NULL, NULL, '2022-07-27 12:44:05', '2022-07-27 12:44:05'),
(192, 'মোবাইল প্যান্ট হবে', NULL, NULL, '2022-07-27 12:44:58', '2022-07-27 12:44:58'),
(193, 'প্লেট হবেনা', NULL, NULL, '2022-07-27 12:46:01', '2022-07-27 12:46:01'),
(194, 'সম্পূর্ণ কলার+কফ+পকেট+প্লেট ওরফ হবে', NULL, NULL, '2022-07-27 17:06:44', '2022-07-27 17:06:44'),
(195, 'সাইডে এক সেলাই নিচে মেশিন সেলাই', NULL, NULL, '2022-07-28 11:23:10', '2022-07-28 11:23:10'),
(196, 'হাতে কুচি হবেনা', NULL, NULL, '2022-08-08 11:01:04', '2022-08-08 11:01:04'),
(197, 'পিছনে জোড়া লুপ হবে', NULL, NULL, '2022-08-08 11:01:58', '2022-08-08 11:06:14'),
(198, 'ফুল ফ্লাইং, বক্সপ্লেট লবে সেলাই বুক পকেট ০১ টা', NULL, NULL, '2022-08-10 11:17:46', '2022-08-10 11:17:46'),
(199, 'হাফ ফ্লাইং, বক্সপ্লেট লবে সেলাই বুক পকেট ০১ টা', NULL, NULL, '2022-08-10 11:25:01', '2022-08-10 11:25:01'),
(200, 'হাফ ফ্লাইং, নিনু প্লেট লবে সেলাই বুক পকেট ০১ টা', NULL, NULL, '2022-08-10 11:27:13', '2022-08-10 11:27:13'),
(201, 'ইন সাইডে ডাবল সেলাই,নিচে মেশিন সেলাই', NULL, NULL, '2022-08-10 12:57:38', '2022-08-10 12:57:38'),
(202, 'জিন্স বুতাম', NULL, NULL, '2022-08-10 13:01:45', '2022-08-10 13:01:45'),
(203, 'সম্পূর্ণ ডাবল সেলাই', NULL, NULL, '2022-08-11 18:36:19', '2022-08-11 18:36:19'),
(204, 'সাইড পকেটে চেইন হবে', NULL, NULL, '2022-08-14 09:09:55', '2022-08-14 09:09:55'),
(205, 'বুক পকেট রাউন্ড হবে', NULL, NULL, '2022-08-14 09:11:35', '2022-08-14 09:15:25'),
(206, 'সাইডে     \'\' ফাড়া  হবে', NULL, NULL, '2022-08-14 09:13:19', '2022-08-14 09:13:19'),
(207, 'কাধে সোল্ডার হবে', NULL, NULL, '2022-08-16 17:16:44', '2022-08-16 17:16:44'),
(208, 'ব্যান্ডের মাথা রউন্ড হবে', NULL, NULL, '2022-08-16 17:20:16', '2022-08-16 17:20:16'),
(209, 'গোল্ডেন কালার সুতা দিয়ে সেলাই হবে', NULL, NULL, '2022-08-20 08:43:32', '2022-08-20 08:43:32'),
(210, 'ব্যান্ডের মেইন পার্টে অন্য কাপড় হবে', NULL, NULL, '2022-08-20 11:06:23', '2022-08-20 11:06:23'),
(211, 'পকেটের থলি বড় হবে', NULL, NULL, '2022-08-20 15:12:17', '2022-08-20 15:12:17'),
(212, 'প্যান্ট উপরে পড়ে', NULL, NULL, '2022-08-20 15:20:42', '2022-08-20 15:20:42'),
(213, 'বেলি রেডি=', NULL, NULL, '2022-08-20 15:44:16', '2022-08-20 15:44:16'),
(214, 'ইন সাইড ফ্রী হবে', NULL, NULL, '2022-08-20 17:38:47', '2022-08-20 17:38:47'),
(215, 'দেড় বন', NULL, NULL, '2022-08-21 15:37:15', '2022-08-21 15:37:15'),
(216, 'পকেট ৫\'\'/৫.৫০\'\' হবে', NULL, NULL, '2022-08-22 08:42:47', '2022-08-22 08:42:47'),
(217, 'বক্স প্লেট ১.৫০\'\'  হবে', NULL, NULL, '2022-08-22 08:44:40', '2022-08-22 08:44:40'),
(218, '২.৭৫\'\' কোণাকাটা কফ', NULL, NULL, '2022-08-22 08:47:09', '2022-08-22 08:47:09'),
(219, 'ইয়ক হবে', NULL, NULL, '2022-08-24 17:53:05', '2022-08-24 17:53:05'),
(220, 'পিছনে বক্স  হবে', NULL, NULL, '2022-08-25 17:41:44', '2022-08-25 17:41:44'),
(221, 'পিছনে বক্স  হবে', NULL, NULL, '2022-08-25 17:41:46', '2022-08-25 17:41:46'),
(222, 'কলারের মাথায় কাজঘর বুতাম হবে', NULL, NULL, '2022-08-25 17:43:42', '2022-08-25 17:43:42'),
(223, 'ব্যান্ড সহ ৭ বুতাম হবে', NULL, NULL, '2022-08-25 17:44:26', '2022-08-25 17:44:26'),
(224, 'কাবলি পাঞ্জাবি', NULL, NULL, '2022-08-27 09:35:06', '2022-08-27 09:35:06'),
(225, 'বুক পকেট ০২ টা + ঢাকনা + বোতাম হবে', NULL, NULL, '2022-08-27 10:59:26', '2022-08-27 10:59:26'),
(226, 'পকেটের মাঝে বক্স হবে', NULL, NULL, '2022-08-27 11:00:30', '2022-08-27 11:00:30'),
(227, 'কাধে সোল্ডার হবে + সোল্ডার ফিক্সড হবে', NULL, NULL, '2022-08-27 11:03:26', '2022-08-27 11:03:26'),
(228, 'হাতে ফিতা বুতাম হবে', NULL, NULL, '2022-08-27 11:04:07', '2022-08-27 11:04:07'),
(229, 'মুজিব কোট, ০৬ বোতাম, নিচে রাউন্ড, সাইড ওপেন', NULL, NULL, '2022-08-27 14:54:56', '2022-08-27 14:54:56'),
(230, 'পকেট ৫\'\'/৫.৭৫\'\' হবে', NULL, NULL, '2022-08-27 17:25:05', '2022-08-27 17:25:05'),
(231, 'ব্যাক শর্ট', NULL, NULL, '2022-09-03 12:01:18', '2022-09-03 12:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `design_item`
--

CREATE TABLE `design_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `design_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `design_item`
--

INSERT INTO `design_item` (`id`, `design_id`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 1, 9, NULL, NULL),
(2, 1, 10, NULL, NULL),
(3, 1, 11, NULL, NULL),
(5, 2, 9, NULL, NULL),
(6, 2, 10, NULL, NULL),
(7, 2, 11, NULL, NULL),
(9, 3, 9, NULL, NULL),
(10, 3, 10, NULL, NULL),
(11, 3, 11, NULL, NULL),
(13, 4, 9, NULL, NULL),
(14, 4, 10, NULL, NULL),
(15, 4, 11, NULL, NULL),
(17, 5, 9, NULL, NULL),
(18, 5, 10, NULL, NULL),
(19, 5, 11, NULL, NULL),
(21, 6, 9, NULL, NULL),
(22, 6, 10, NULL, NULL),
(23, 6, 11, NULL, NULL),
(25, 7, 9, NULL, NULL),
(26, 7, 10, NULL, NULL),
(27, 7, 11, NULL, NULL),
(29, 8, 9, NULL, NULL),
(30, 8, 10, NULL, NULL),
(31, 8, 11, NULL, NULL),
(33, 9, 9, NULL, NULL),
(34, 9, 10, NULL, NULL),
(35, 9, 11, NULL, NULL),
(37, 10, 9, NULL, NULL),
(38, 10, 10, NULL, NULL),
(39, 10, 11, NULL, NULL),
(41, 11, 9, NULL, NULL),
(42, 11, 10, NULL, NULL),
(43, 11, 11, NULL, NULL),
(45, 12, 9, NULL, NULL),
(46, 12, 10, NULL, NULL),
(47, 12, 11, NULL, NULL),
(49, 13, 9, NULL, NULL),
(50, 13, 10, NULL, NULL),
(51, 13, 11, NULL, NULL),
(53, 14, 9, NULL, NULL),
(54, 14, 10, NULL, NULL),
(55, 14, 11, NULL, NULL),
(57, 15, 9, NULL, NULL),
(58, 15, 10, NULL, NULL),
(59, 15, 11, NULL, NULL),
(61, 16, 9, NULL, NULL),
(62, 16, 10, NULL, NULL),
(63, 16, 11, NULL, NULL),
(64, 16, 15, NULL, NULL),
(65, 17, 9, NULL, NULL),
(66, 17, 10, NULL, NULL),
(67, 17, 11, NULL, NULL),
(69, 18, 9, NULL, NULL),
(70, 18, 10, NULL, NULL),
(71, 18, 11, NULL, NULL),
(72, 18, 15, NULL, NULL),
(73, 19, 9, NULL, NULL),
(74, 19, 10, NULL, NULL),
(75, 19, 11, NULL, NULL),
(76, 19, 15, NULL, NULL),
(77, 20, 9, NULL, NULL),
(78, 20, 10, NULL, NULL),
(79, 20, 11, NULL, NULL),
(80, 20, 15, NULL, NULL),
(81, 21, 9, NULL, NULL),
(82, 21, 10, NULL, NULL),
(83, 21, 11, NULL, NULL),
(84, 21, 15, NULL, NULL),
(85, 22, 9, NULL, NULL),
(86, 22, 10, NULL, NULL),
(87, 22, 11, NULL, NULL),
(88, 22, 15, NULL, NULL),
(89, 23, 9, NULL, NULL),
(90, 23, 10, NULL, NULL),
(91, 23, 11, NULL, NULL),
(92, 23, 15, NULL, NULL),
(93, 24, 9, NULL, NULL),
(94, 24, 10, NULL, NULL),
(95, 24, 11, NULL, NULL),
(96, 24, 15, NULL, NULL),
(97, 25, 9, NULL, NULL),
(98, 25, 10, NULL, NULL),
(99, 25, 11, NULL, NULL),
(100, 25, 15, NULL, NULL),
(101, 26, 9, NULL, NULL),
(102, 26, 10, NULL, NULL),
(103, 26, 11, NULL, NULL),
(104, 26, 15, NULL, NULL),
(105, 27, 9, NULL, NULL),
(106, 27, 10, NULL, NULL),
(107, 27, 11, NULL, NULL),
(108, 27, 15, NULL, NULL),
(109, 28, 9, NULL, NULL),
(110, 28, 10, NULL, NULL),
(111, 28, 11, NULL, NULL),
(112, 28, 15, NULL, NULL),
(113, 29, 9, NULL, NULL),
(114, 29, 10, NULL, NULL),
(115, 29, 11, NULL, NULL),
(116, 29, 15, NULL, NULL),
(117, 30, 9, NULL, NULL),
(118, 30, 10, NULL, NULL),
(119, 30, 11, NULL, NULL),
(120, 30, 15, NULL, NULL),
(121, 31, 9, NULL, NULL),
(122, 31, 10, NULL, NULL),
(123, 31, 11, NULL, NULL),
(124, 31, 15, NULL, NULL),
(125, 32, 9, NULL, NULL),
(126, 32, 10, NULL, NULL),
(127, 32, 11, NULL, NULL),
(128, 32, 15, NULL, NULL),
(129, 33, 9, NULL, NULL),
(130, 33, 10, NULL, NULL),
(131, 33, 11, NULL, NULL),
(132, 33, 15, NULL, NULL),
(133, 34, 9, NULL, NULL),
(134, 34, 10, NULL, NULL),
(135, 34, 11, NULL, NULL),
(136, 34, 15, NULL, NULL),
(137, 35, 9, NULL, NULL),
(138, 35, 10, NULL, NULL),
(139, 35, 11, NULL, NULL),
(140, 35, 15, NULL, NULL),
(141, 36, 9, NULL, NULL),
(142, 36, 10, NULL, NULL),
(143, 36, 11, NULL, NULL),
(144, 36, 15, NULL, NULL),
(145, 37, 9, NULL, NULL),
(146, 37, 10, NULL, NULL),
(147, 37, 11, NULL, NULL),
(148, 37, 15, NULL, NULL),
(149, 38, 9, NULL, NULL),
(150, 38, 10, NULL, NULL),
(151, 38, 11, NULL, NULL),
(152, 38, 15, NULL, NULL),
(153, 39, 9, NULL, NULL),
(154, 39, 10, NULL, NULL),
(155, 39, 11, NULL, NULL),
(156, 39, 15, NULL, NULL),
(157, 40, 9, NULL, NULL),
(158, 40, 10, NULL, NULL),
(159, 40, 11, NULL, NULL),
(160, 40, 15, NULL, NULL),
(161, 41, 9, NULL, NULL),
(162, 41, 10, NULL, NULL),
(163, 41, 11, NULL, NULL),
(164, 41, 15, NULL, NULL),
(165, 42, 9, NULL, NULL),
(166, 42, 10, NULL, NULL),
(167, 42, 11, NULL, NULL),
(168, 42, 15, NULL, NULL),
(169, 43, 9, NULL, NULL),
(170, 43, 10, NULL, NULL),
(171, 43, 11, NULL, NULL),
(172, 43, 15, NULL, NULL),
(173, 44, 9, NULL, NULL),
(174, 44, 10, NULL, NULL),
(175, 44, 11, NULL, NULL),
(176, 44, 15, NULL, NULL),
(177, 45, 9, NULL, NULL),
(178, 45, 10, NULL, NULL),
(179, 45, 11, NULL, NULL),
(180, 45, 15, NULL, NULL),
(181, 46, 9, NULL, NULL),
(182, 46, 10, NULL, NULL),
(183, 46, 11, NULL, NULL),
(184, 46, 15, NULL, NULL),
(185, 47, 9, NULL, NULL),
(186, 47, 10, NULL, NULL),
(187, 47, 11, NULL, NULL),
(188, 47, 15, NULL, NULL),
(189, 48, 9, NULL, NULL),
(190, 48, 10, NULL, NULL),
(191, 48, 11, NULL, NULL),
(192, 48, 15, NULL, NULL),
(193, 49, 9, NULL, NULL),
(194, 49, 10, NULL, NULL),
(195, 49, 11, NULL, NULL),
(196, 49, 15, NULL, NULL),
(197, 50, 9, NULL, NULL),
(198, 50, 10, NULL, NULL),
(199, 50, 11, NULL, NULL),
(200, 50, 15, NULL, NULL),
(201, 51, 9, NULL, NULL),
(202, 51, 10, NULL, NULL),
(203, 51, 11, NULL, NULL),
(204, 51, 15, NULL, NULL),
(205, 52, 9, NULL, NULL),
(206, 52, 10, NULL, NULL),
(207, 52, 11, NULL, NULL),
(208, 52, 15, NULL, NULL),
(209, 53, 9, NULL, NULL),
(210, 53, 10, NULL, NULL),
(211, 53, 11, NULL, NULL),
(212, 53, 15, NULL, NULL),
(213, 54, 9, NULL, NULL),
(214, 54, 10, NULL, NULL),
(215, 54, 11, NULL, NULL),
(216, 54, 15, NULL, NULL),
(217, 55, 9, NULL, NULL),
(218, 55, 10, NULL, NULL),
(219, 55, 11, NULL, NULL),
(220, 55, 15, NULL, NULL),
(221, 56, 9, NULL, NULL),
(222, 56, 10, NULL, NULL),
(223, 56, 11, NULL, NULL),
(224, 56, 15, NULL, NULL),
(225, 57, 12, NULL, NULL),
(226, 57, 13, NULL, NULL),
(229, 58, 12, NULL, NULL),
(230, 58, 13, NULL, NULL),
(233, 59, 12, NULL, NULL),
(234, 59, 13, NULL, NULL),
(237, 60, 12, NULL, NULL),
(238, 60, 13, NULL, NULL),
(241, 61, 12, NULL, NULL),
(242, 61, 13, NULL, NULL),
(245, 62, 12, NULL, NULL),
(246, 62, 13, NULL, NULL),
(249, 63, 12, NULL, NULL),
(250, 63, 13, NULL, NULL),
(253, 64, 12, NULL, NULL),
(254, 64, 13, NULL, NULL),
(257, 65, 12, NULL, NULL),
(258, 65, 13, NULL, NULL),
(261, 66, 12, NULL, NULL),
(262, 66, 13, NULL, NULL),
(265, 67, 12, NULL, NULL),
(266, 67, 13, NULL, NULL),
(269, 68, 12, NULL, NULL),
(270, 68, 13, NULL, NULL),
(273, 69, 12, NULL, NULL),
(274, 69, 13, NULL, NULL),
(277, 70, 12, NULL, NULL),
(278, 70, 13, NULL, NULL),
(279, 70, 16, NULL, NULL),
(280, 70, 14, NULL, NULL),
(281, 71, 12, NULL, NULL),
(282, 71, 13, NULL, NULL),
(283, 71, 16, NULL, NULL),
(284, 71, 14, NULL, NULL),
(285, 72, 12, NULL, NULL),
(286, 72, 13, NULL, NULL),
(287, 72, 16, NULL, NULL),
(288, 72, 14, NULL, NULL),
(289, 73, 12, NULL, NULL),
(290, 73, 13, NULL, NULL),
(291, 73, 16, NULL, NULL),
(292, 73, 14, NULL, NULL),
(293, 74, 12, NULL, NULL),
(294, 74, 13, NULL, NULL),
(295, 74, 16, NULL, NULL),
(296, 74, 14, NULL, NULL),
(297, 75, 12, NULL, NULL),
(298, 75, 13, NULL, NULL),
(299, 75, 16, NULL, NULL),
(300, 75, 14, NULL, NULL),
(301, 76, 12, NULL, NULL),
(302, 76, 13, NULL, NULL),
(303, 76, 16, NULL, NULL),
(304, 76, 14, NULL, NULL),
(305, 77, 12, NULL, NULL),
(306, 77, 13, NULL, NULL),
(307, 77, 16, NULL, NULL),
(308, 77, 14, NULL, NULL),
(309, 78, 12, NULL, NULL),
(310, 78, 13, NULL, NULL),
(311, 78, 16, NULL, NULL),
(312, 78, 14, NULL, NULL),
(313, 79, 12, NULL, NULL),
(314, 79, 13, NULL, NULL),
(315, 79, 16, NULL, NULL),
(316, 79, 14, NULL, NULL),
(317, 80, 12, NULL, NULL),
(318, 80, 13, NULL, NULL),
(319, 80, 16, NULL, NULL),
(320, 80, 14, NULL, NULL),
(321, 81, 12, NULL, NULL),
(322, 81, 13, NULL, NULL),
(323, 81, 16, NULL, NULL),
(324, 81, 14, NULL, NULL),
(325, 82, 12, NULL, NULL),
(326, 82, 13, NULL, NULL),
(327, 82, 16, NULL, NULL),
(328, 82, 14, NULL, NULL),
(329, 83, 12, NULL, NULL),
(330, 83, 13, NULL, NULL),
(331, 83, 16, NULL, NULL),
(332, 83, 14, NULL, NULL),
(333, 84, 12, NULL, NULL),
(334, 84, 13, NULL, NULL),
(335, 84, 16, NULL, NULL),
(336, 84, 14, NULL, NULL),
(337, 85, 12, NULL, NULL),
(338, 85, 13, NULL, NULL),
(339, 85, 16, NULL, NULL),
(340, 85, 14, NULL, NULL),
(341, 86, 12, NULL, NULL),
(342, 86, 13, NULL, NULL),
(343, 86, 16, NULL, NULL),
(344, 86, 14, NULL, NULL),
(345, 87, 12, NULL, NULL),
(346, 87, 13, NULL, NULL),
(347, 87, 16, NULL, NULL),
(348, 87, 14, NULL, NULL),
(349, 88, 12, NULL, NULL),
(350, 88, 13, NULL, NULL),
(351, 88, 16, NULL, NULL),
(352, 88, 14, NULL, NULL),
(353, 89, 12, NULL, NULL),
(354, 89, 13, NULL, NULL),
(355, 89, 16, NULL, NULL),
(356, 89, 14, NULL, NULL),
(357, 90, 12, NULL, NULL),
(358, 90, 13, NULL, NULL),
(359, 90, 16, NULL, NULL),
(360, 90, 14, NULL, NULL),
(361, 91, 12, NULL, NULL),
(362, 91, 13, NULL, NULL),
(363, 91, 16, NULL, NULL),
(364, 91, 14, NULL, NULL),
(365, 92, 12, NULL, NULL),
(366, 92, 13, NULL, NULL),
(367, 92, 16, NULL, NULL),
(368, 92, 14, NULL, NULL),
(369, 93, 12, NULL, NULL),
(370, 93, 13, NULL, NULL),
(371, 93, 16, NULL, NULL),
(372, 93, 14, NULL, NULL),
(373, 94, 12, NULL, NULL),
(374, 94, 13, NULL, NULL),
(375, 94, 16, NULL, NULL),
(376, 94, 14, NULL, NULL),
(377, 95, 12, NULL, NULL),
(378, 95, 13, NULL, NULL),
(379, 95, 16, NULL, NULL),
(380, 95, 14, NULL, NULL),
(381, 96, 12, NULL, NULL),
(382, 96, 13, NULL, NULL),
(383, 96, 16, NULL, NULL),
(384, 96, 14, NULL, NULL),
(385, 97, 12, NULL, NULL),
(386, 97, 13, NULL, NULL),
(387, 97, 16, NULL, NULL),
(388, 97, 14, NULL, NULL),
(389, 98, 12, NULL, NULL),
(390, 98, 13, NULL, NULL),
(391, 98, 16, NULL, NULL),
(392, 98, 14, NULL, NULL),
(393, 99, 12, NULL, NULL),
(394, 99, 13, NULL, NULL),
(395, 99, 16, NULL, NULL),
(396, 99, 14, NULL, NULL),
(397, 100, 12, NULL, NULL),
(398, 100, 13, NULL, NULL),
(399, 100, 16, NULL, NULL),
(400, 100, 14, NULL, NULL),
(401, 101, 12, NULL, NULL),
(402, 101, 13, NULL, NULL),
(403, 101, 16, NULL, NULL),
(404, 101, 14, NULL, NULL),
(405, 102, 12, NULL, NULL),
(406, 102, 13, NULL, NULL),
(407, 102, 16, NULL, NULL),
(408, 102, 14, NULL, NULL),
(409, 103, 12, NULL, NULL),
(410, 103, 13, NULL, NULL),
(411, 103, 16, NULL, NULL),
(412, 103, 14, NULL, NULL),
(413, 104, 12, NULL, NULL),
(414, 104, 13, NULL, NULL),
(415, 104, 16, NULL, NULL),
(416, 104, 14, NULL, NULL),
(417, 105, 12, NULL, NULL),
(418, 105, 13, NULL, NULL),
(419, 105, 16, NULL, NULL),
(420, 105, 14, NULL, NULL),
(421, 106, 12, NULL, NULL),
(422, 106, 13, NULL, NULL),
(423, 106, 16, NULL, NULL),
(424, 106, 14, NULL, NULL),
(425, 107, 12, NULL, NULL),
(426, 107, 13, NULL, NULL),
(427, 107, 16, NULL, NULL),
(428, 107, 14, NULL, NULL),
(429, 108, 12, NULL, NULL),
(430, 108, 13, NULL, NULL),
(431, 108, 16, NULL, NULL),
(432, 108, 14, NULL, NULL),
(433, 109, 12, NULL, NULL),
(434, 109, 13, NULL, NULL),
(435, 109, 16, NULL, NULL),
(436, 109, 14, NULL, NULL),
(437, 110, 12, NULL, NULL),
(438, 110, 13, NULL, NULL),
(439, 110, 16, NULL, NULL),
(440, 110, 14, NULL, NULL),
(441, 111, 12, NULL, NULL),
(442, 111, 13, NULL, NULL),
(443, 111, 16, NULL, NULL),
(444, 111, 14, NULL, NULL),
(445, 112, 12, NULL, NULL),
(446, 112, 13, NULL, NULL),
(447, 112, 16, NULL, NULL),
(448, 112, 14, NULL, NULL),
(449, 113, 12, NULL, NULL),
(450, 113, 13, NULL, NULL),
(451, 113, 16, NULL, NULL),
(452, 113, 14, NULL, NULL),
(453, 114, 12, NULL, NULL),
(454, 114, 13, NULL, NULL),
(455, 114, 16, NULL, NULL),
(456, 114, 14, NULL, NULL),
(501, 126, 9, NULL, NULL),
(502, 126, 10, NULL, NULL),
(503, 126, 11, NULL, NULL),
(504, 126, 15, NULL, NULL),
(505, 127, 9, NULL, NULL),
(506, 127, 10, NULL, NULL),
(507, 127, 11, NULL, NULL),
(508, 127, 15, NULL, NULL),
(509, 128, 9, NULL, NULL),
(510, 128, 10, NULL, NULL),
(511, 128, 11, NULL, NULL),
(512, 128, 15, NULL, NULL),
(513, 129, 10, NULL, NULL),
(514, 129, 11, NULL, NULL),
(515, 129, 15, NULL, NULL),
(516, 130, 4, NULL, NULL),
(517, 130, 5, NULL, NULL),
(518, 130, 19, NULL, NULL),
(519, 130, 20, NULL, NULL),
(520, 130, 1, NULL, NULL),
(521, 130, 2, NULL, NULL),
(522, 130, 3, NULL, NULL),
(523, 131, 4, NULL, NULL),
(524, 131, 5, NULL, NULL),
(525, 131, 19, NULL, NULL),
(526, 131, 20, NULL, NULL),
(527, 131, 1, NULL, NULL),
(528, 131, 2, NULL, NULL),
(529, 131, 3, NULL, NULL),
(530, 132, 4, NULL, NULL),
(531, 132, 5, NULL, NULL),
(532, 132, 1, NULL, NULL),
(533, 132, 2, NULL, NULL),
(534, 132, 3, NULL, NULL),
(535, 132, 19, NULL, NULL),
(536, 132, 20, NULL, NULL),
(537, 130, 6, NULL, NULL),
(538, 131, 6, NULL, NULL),
(539, 132, 6, NULL, NULL),
(540, 133, 4, NULL, NULL),
(541, 133, 5, NULL, NULL),
(542, 133, 6, NULL, NULL),
(543, 133, 1, NULL, NULL),
(544, 133, 2, NULL, NULL),
(545, 133, 3, NULL, NULL),
(546, 133, 19, NULL, NULL),
(547, 133, 20, NULL, NULL),
(548, 134, 4, NULL, NULL),
(549, 134, 5, NULL, NULL),
(550, 134, 6, NULL, NULL),
(551, 134, 1, NULL, NULL),
(552, 134, 2, NULL, NULL),
(553, 134, 3, NULL, NULL),
(554, 134, 19, NULL, NULL),
(555, 134, 20, NULL, NULL),
(556, 135, 4, NULL, NULL),
(557, 135, 5, NULL, NULL),
(558, 135, 6, NULL, NULL),
(559, 135, 1, NULL, NULL),
(560, 135, 2, NULL, NULL),
(561, 135, 3, NULL, NULL),
(562, 135, 19, NULL, NULL),
(563, 135, 20, NULL, NULL),
(564, 136, 4, NULL, NULL),
(565, 136, 5, NULL, NULL),
(566, 136, 6, NULL, NULL),
(567, 136, 1, NULL, NULL),
(568, 136, 2, NULL, NULL),
(569, 136, 3, NULL, NULL),
(570, 136, 19, NULL, NULL),
(571, 136, 20, NULL, NULL),
(572, 137, 4, NULL, NULL),
(573, 137, 5, NULL, NULL),
(574, 137, 6, NULL, NULL),
(575, 137, 1, NULL, NULL),
(576, 137, 2, NULL, NULL),
(577, 137, 3, NULL, NULL),
(578, 137, 19, NULL, NULL),
(579, 137, 20, NULL, NULL),
(580, 138, 4, NULL, NULL),
(581, 138, 5, NULL, NULL),
(582, 138, 6, NULL, NULL),
(583, 138, 1, NULL, NULL),
(584, 138, 2, NULL, NULL),
(585, 138, 3, NULL, NULL),
(586, 138, 19, NULL, NULL),
(587, 138, 20, NULL, NULL),
(588, 139, 4, NULL, NULL),
(589, 139, 5, NULL, NULL),
(590, 139, 6, NULL, NULL),
(591, 139, 1, NULL, NULL),
(592, 139, 2, NULL, NULL),
(593, 139, 3, NULL, NULL),
(594, 139, 19, NULL, NULL),
(595, 139, 20, NULL, NULL),
(596, 140, 4, NULL, NULL),
(597, 140, 5, NULL, NULL),
(598, 140, 6, NULL, NULL),
(599, 140, 1, NULL, NULL),
(600, 140, 2, NULL, NULL),
(601, 140, 3, NULL, NULL),
(602, 140, 19, NULL, NULL),
(603, 140, 20, NULL, NULL),
(604, 141, 4, NULL, NULL),
(607, 141, 1, NULL, NULL),
(608, 141, 2, NULL, NULL),
(609, 141, 3, NULL, NULL),
(612, 142, 4, NULL, NULL),
(613, 142, 5, NULL, NULL),
(614, 142, 6, NULL, NULL),
(615, 142, 1, NULL, NULL),
(616, 142, 2, NULL, NULL),
(617, 142, 3, NULL, NULL),
(618, 142, 19, NULL, NULL),
(619, 142, 20, NULL, NULL),
(620, 143, 4, NULL, NULL),
(621, 143, 5, NULL, NULL),
(622, 143, 6, NULL, NULL),
(623, 143, 1, NULL, NULL),
(624, 143, 2, NULL, NULL),
(625, 143, 3, NULL, NULL),
(626, 143, 19, NULL, NULL),
(627, 143, 20, NULL, NULL),
(628, 144, 4, NULL, NULL),
(629, 144, 5, NULL, NULL),
(630, 144, 6, NULL, NULL),
(631, 144, 1, NULL, NULL),
(632, 144, 2, NULL, NULL),
(633, 144, 3, NULL, NULL),
(634, 144, 19, NULL, NULL),
(635, 144, 20, NULL, NULL),
(636, 145, 4, NULL, NULL),
(637, 145, 5, NULL, NULL),
(638, 145, 6, NULL, NULL),
(639, 145, 1, NULL, NULL),
(640, 145, 2, NULL, NULL),
(641, 145, 3, NULL, NULL),
(642, 145, 19, NULL, NULL),
(643, 145, 20, NULL, NULL),
(644, 146, 4, NULL, NULL),
(645, 146, 5, NULL, NULL),
(646, 146, 6, NULL, NULL),
(647, 146, 1, NULL, NULL),
(648, 146, 2, NULL, NULL),
(649, 146, 3, NULL, NULL),
(650, 146, 19, NULL, NULL),
(651, 146, 20, NULL, NULL),
(652, 147, 4, NULL, NULL),
(653, 147, 5, NULL, NULL),
(654, 147, 6, NULL, NULL),
(655, 147, 1, NULL, NULL),
(656, 147, 2, NULL, NULL),
(657, 147, 3, NULL, NULL),
(658, 147, 19, NULL, NULL),
(659, 147, 20, NULL, NULL),
(660, 148, 4, NULL, NULL),
(661, 148, 5, NULL, NULL),
(662, 148, 6, NULL, NULL),
(663, 148, 1, NULL, NULL),
(664, 148, 2, NULL, NULL),
(665, 148, 3, NULL, NULL),
(666, 148, 19, NULL, NULL),
(667, 148, 20, NULL, NULL),
(668, 149, 4, NULL, NULL),
(669, 149, 5, NULL, NULL),
(670, 149, 6, NULL, NULL),
(671, 149, 1, NULL, NULL),
(672, 149, 2, NULL, NULL),
(673, 149, 3, NULL, NULL),
(674, 149, 19, NULL, NULL),
(675, 149, 20, NULL, NULL),
(676, 150, 4, NULL, NULL),
(677, 150, 5, NULL, NULL),
(678, 150, 6, NULL, NULL),
(679, 150, 1, NULL, NULL),
(680, 150, 2, NULL, NULL),
(681, 150, 3, NULL, NULL),
(682, 150, 19, NULL, NULL),
(683, 150, 20, NULL, NULL),
(684, 151, 4, NULL, NULL),
(685, 151, 5, NULL, NULL),
(686, 151, 6, NULL, NULL),
(687, 151, 1, NULL, NULL),
(688, 151, 2, NULL, NULL),
(689, 151, 3, NULL, NULL),
(690, 151, 19, NULL, NULL),
(691, 151, 20, NULL, NULL),
(692, 152, 4, NULL, NULL),
(693, 152, 5, NULL, NULL),
(694, 152, 6, NULL, NULL),
(695, 152, 1, NULL, NULL),
(696, 152, 2, NULL, NULL),
(697, 152, 3, NULL, NULL),
(698, 152, 19, NULL, NULL),
(699, 152, 20, NULL, NULL),
(700, 153, 4, NULL, NULL),
(701, 153, 5, NULL, NULL),
(702, 153, 6, NULL, NULL),
(703, 153, 1, NULL, NULL),
(704, 153, 2, NULL, NULL),
(705, 153, 3, NULL, NULL),
(706, 153, 19, NULL, NULL),
(707, 153, 20, NULL, NULL),
(708, 154, 4, NULL, NULL),
(709, 154, 5, NULL, NULL),
(710, 154, 6, NULL, NULL),
(711, 154, 1, NULL, NULL),
(712, 154, 2, NULL, NULL),
(713, 154, 3, NULL, NULL),
(714, 154, 19, NULL, NULL),
(715, 154, 20, NULL, NULL),
(716, 155, 4, NULL, NULL),
(717, 155, 5, NULL, NULL),
(718, 155, 6, NULL, NULL),
(719, 155, 1, NULL, NULL),
(720, 155, 2, NULL, NULL),
(721, 155, 3, NULL, NULL),
(722, 155, 19, NULL, NULL),
(723, 155, 20, NULL, NULL),
(724, 156, 12, NULL, NULL),
(725, 157, 12, NULL, NULL),
(726, 158, 12, NULL, NULL),
(727, 159, 14, NULL, NULL),
(728, 160, 14, NULL, NULL),
(729, 161, 14, NULL, NULL),
(730, 162, 14, NULL, NULL),
(731, 162, 18, NULL, NULL),
(732, 162, 19, NULL, NULL),
(733, 162, 16, NULL, NULL),
(734, 162, 12, NULL, NULL),
(735, 162, 4, NULL, NULL),
(736, 162, 5, NULL, NULL),
(737, 162, 6, NULL, NULL),
(738, 163, 4, NULL, NULL),
(739, 163, 5, NULL, NULL),
(740, 163, 6, NULL, NULL),
(741, 163, 12, NULL, NULL),
(742, 163, 14, NULL, NULL),
(743, 163, 16, NULL, NULL),
(744, 163, 19, NULL, NULL),
(745, 164, 12, NULL, NULL),
(746, 165, 12, NULL, NULL),
(747, 166, 12, NULL, NULL),
(748, 167, 12, NULL, NULL),
(749, 168, 12, NULL, NULL),
(750, 169, 1, NULL, NULL),
(751, 169, 19, NULL, NULL),
(752, 169, 18, NULL, NULL),
(753, 169, 14, NULL, NULL),
(754, 169, 10, NULL, NULL),
(755, 169, 12, NULL, NULL),
(756, 169, 5, NULL, NULL),
(757, 170, 15, NULL, NULL),
(758, 171, 15, NULL, NULL),
(759, 172, 15, NULL, NULL),
(760, 173, 15, NULL, NULL),
(761, 174, 15, NULL, NULL),
(762, 175, 15, NULL, NULL),
(763, 176, 15, NULL, NULL),
(764, 177, 15, NULL, NULL),
(765, 178, 15, NULL, NULL),
(766, 179, 10, NULL, NULL),
(767, 179, 9, NULL, NULL),
(768, 180, 10, NULL, NULL),
(769, 181, 14, NULL, NULL),
(770, 182, 14, NULL, NULL),
(771, 183, 12, NULL, NULL),
(772, 184, 12, NULL, NULL),
(773, 185, 12, NULL, NULL),
(774, 185, 13, NULL, NULL),
(775, 186, 10, NULL, NULL),
(776, 186, 9, NULL, NULL),
(777, 187, 1, NULL, NULL),
(778, 187, 3, NULL, NULL),
(779, 187, 12, NULL, NULL),
(780, 187, 13, NULL, NULL),
(781, 187, 14, NULL, NULL),
(782, 187, 16, NULL, NULL),
(783, 188, 12, NULL, NULL),
(784, 188, 16, NULL, NULL),
(785, 188, 18, NULL, NULL),
(786, 188, 14, NULL, NULL),
(787, 189, 12, NULL, NULL),
(788, 190, 14, NULL, NULL),
(789, 190, 18, NULL, NULL),
(790, 190, 16, NULL, NULL),
(791, 191, 14, NULL, NULL),
(792, 191, 16, NULL, NULL),
(793, 191, 18, NULL, NULL),
(794, 192, 10, NULL, NULL),
(795, 193, 12, NULL, NULL),
(796, 194, 12, NULL, NULL),
(797, 194, 16, NULL, NULL),
(798, 195, 10, NULL, NULL),
(799, 196, 12, NULL, NULL),
(800, 197, 10, NULL, NULL),
(801, 197, 15, NULL, NULL),
(802, 198, 12, NULL, NULL),
(803, 198, 13, NULL, NULL),
(804, 199, 12, NULL, NULL),
(805, 199, 13, NULL, NULL),
(806, 200, 12, NULL, NULL),
(807, 151, 12, NULL, NULL),
(808, 151, 15, NULL, NULL),
(809, 151, 14, NULL, NULL),
(810, 201, 10, NULL, NULL),
(811, 201, 9, NULL, NULL),
(812, 202, 10, NULL, NULL),
(813, 202, 9, NULL, NULL),
(814, 203, 12, NULL, NULL),
(815, 203, 16, NULL, NULL),
(816, 204, 14, NULL, NULL),
(817, 204, 18, NULL, NULL),
(818, 205, 14, NULL, NULL),
(819, 205, 15, NULL, NULL),
(820, 206, 14, NULL, NULL),
(821, 203, 15, NULL, NULL),
(822, 207, 12, NULL, NULL),
(823, 207, 18, NULL, NULL),
(824, 208, 12, NULL, NULL),
(825, 209, 10, NULL, NULL),
(826, 209, 9, NULL, NULL),
(827, 210, 12, NULL, NULL),
(828, 210, 14, NULL, NULL),
(829, 210, 16, NULL, NULL),
(830, 211, 10, NULL, NULL),
(831, 211, 11, NULL, NULL),
(832, 211, 9, NULL, NULL),
(833, 212, 10, NULL, NULL),
(834, 212, 9, NULL, NULL),
(835, 212, 11, NULL, NULL),
(836, 213, 1, NULL, NULL),
(837, 213, 3, NULL, NULL),
(838, 213, 2, NULL, NULL),
(839, 213, 4, NULL, NULL),
(840, 213, 5, NULL, NULL),
(841, 213, 7, NULL, NULL),
(842, 214, 10, NULL, NULL),
(843, 214, 9, NULL, NULL),
(844, 215, 10, NULL, NULL),
(845, 216, 12, NULL, NULL),
(846, 216, 16, NULL, NULL),
(847, 216, 14, NULL, NULL),
(848, 216, 18, NULL, NULL),
(849, 217, 12, NULL, NULL),
(850, 218, 12, NULL, NULL),
(851, 219, 14, NULL, NULL),
(852, 219, 16, NULL, NULL),
(853, 220, 12, NULL, NULL),
(854, 220, 16, NULL, NULL),
(855, 221, 12, NULL, NULL),
(856, 221, 16, NULL, NULL),
(857, 222, 12, NULL, NULL),
(858, 222, 16, NULL, NULL),
(859, 222, 18, NULL, NULL),
(860, 223, 12, NULL, NULL),
(861, 224, 18, NULL, NULL),
(862, 90, 18, NULL, NULL),
(863, 225, 18, NULL, NULL),
(864, 226, 18, NULL, NULL),
(865, 226, 12, NULL, NULL),
(866, 227, 18, NULL, NULL),
(867, 228, 18, NULL, NULL),
(868, 228, 12, NULL, NULL),
(869, 229, 4, NULL, NULL),
(870, 230, 12, NULL, NULL),
(871, 230, 14, NULL, NULL),
(872, 169, 7, NULL, NULL),
(873, 169, 16, NULL, NULL),
(874, 169, 17, NULL, NULL),
(875, 231, 1, NULL, NULL),
(876, 231, 3, NULL, NULL),
(877, 231, 4, NULL, NULL),
(878, 231, 12, NULL, NULL),
(879, 231, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `design_order_detail`
--

CREATE TABLE `design_order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `design_id` bigint(20) UNSIGNED NOT NULL,
  `order_details_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `design_order_detail`
--

INSERT INTO `design_order_detail` (`id`, `design_id`, `order_details_id`, `created_at`, `updated_at`) VALUES
(1, 57, 1, NULL, NULL),
(2, 59, 1, NULL, NULL),
(3, 2, 2, NULL, NULL),
(4, 4, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `distributions`
--

CREATE TABLE `distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_details_id` bigint(20) UNSIGNED NOT NULL,
  `distribute_date` date NOT NULL,
  `complete_date` date DEFAULT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_debit` tinyint(1) NOT NULL DEFAULT '0',
  `is_credit` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nid_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `employee_role`, `mobile_no`, `basic_salary`, `nid_number`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alexander Callahan', 'Master', '01900000000', '5000.00', NULL, NULL, NULL, '2023-04-06 00:43:41', '2023-04-06 00:43:41'),
(2, 'Patrick Cooley', 'Manager', '01700000000', '15000.00', NULL, NULL, NULL, '2023-04-06 00:44:10', '2023-04-06 00:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_month` date NOT NULL,
  `given_date` date NOT NULL,
  `cash_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_details`
--

CREATE TABLE `employee_salary_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_salary_id` bigint(20) UNSIGNED NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtls_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` bigint(20) UNSIGNED NOT NULL,
  `expense_sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `category_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Stationary', NULL, NULL, '2022-06-05 15:47:38', '2022-06-05 15:47:38'),
(2, 'Hospitality', NULL, NULL, '2022-06-05 15:47:45', '2022-06-05 15:47:45'),
(3, 'Materials', NULL, NULL, '2022-06-05 15:47:52', '2022-06-05 15:47:52'),
(4, 'Shop Rent', NULL, NULL, '2022-06-05 15:48:13', '2022-06-05 15:48:13'),
(5, 'Electricity Bill', NULL, NULL, '2022-06-05 15:48:23', '2022-06-05 15:48:23'),
(6, 'Vat', NULL, NULL, '2022-06-05 15:48:35', '2022-06-05 15:48:35'),
(7, 'Internet Bill', NULL, NULL, '2022-06-05 15:49:08', '2022-06-05 15:49:08'),
(8, 'Worker Payment(ALL)', NULL, NULL, '2022-06-05 15:49:59', '2022-06-05 15:49:59'),
(9, 'Nasta', NULL, NULL, '2022-06-05 15:50:19', '2022-06-05 15:50:19'),
(10, 'Feusing', NULL, NULL, '2022-06-05 16:03:48', '2022-06-05 16:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `expense_sub_categories`
--

CREATE TABLE `expense_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_sub_categories`
--

INSERT INTO `expense_sub_categories` (`id`, `expense_category_id`, `subcategory_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'Factory', NULL, NULL, '2022-06-08 13:09:11', '2022-06-08 13:09:11'),
(2, 5, 'Shop', NULL, NULL, '2022-06-08 13:09:25', '2022-06-08 13:09:25'),
(3, 1, 'Khata', NULL, NULL, '2022-06-08 13:09:40', '2022-06-08 13:09:40'),
(4, 1, 'Pen', NULL, NULL, '2022-06-08 13:09:52', '2022-06-08 13:09:52'),
(5, 6, 'Shop', NULL, NULL, '2022-06-16 10:27:58', '2022-06-16 10:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fittings`
--

CREATE TABLE `fittings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fitting_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fittings`
--

INSERT INTO `fittings` (`id`, `fitting_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'লুজ ফিটিং', 'n/a', NULL, '2022-01-20 05:02:32', '2022-07-02 10:01:27'),
(2, 'স্লিম ফিটিং', 'n/a', NULL, '2022-01-20 05:02:55', '2022-07-02 10:01:55'),
(3, 'ফিটিং', NULL, NULL, '2022-05-07 23:14:14', '2022-07-02 10:02:56'),
(4, 'ওভার লুজ', NULL, NULL, '2022-05-07 23:14:39', '2022-07-02 10:03:20'),
(5, 'মিডিয়াম ফিটিং', NULL, NULL, '2022-06-13 18:45:16', '2022-06-13 18:45:16'),
(6, '১.২৫\'\' লুজ', NULL, NULL, '2022-06-13 18:46:11', '2022-07-02 10:03:44'),
(7, 'মিডিয়াম লুজ', NULL, NULL, '2022-06-13 18:48:02', '2022-06-13 18:48:02'),
(8, 'বডি ফিটিং', NULL, NULL, '2022-06-13 18:49:57', '2022-07-02 10:04:46'),
(9, '১.৫০\'\'  লুজ', NULL, NULL, '2022-07-02 09:56:57', '2022-07-02 09:58:25'),
(10, '১.৭৫\'\' লুজ', NULL, NULL, '2022-07-02 09:58:02', '2022-07-02 09:58:02'),
(11, '২\'\' লুজ', NULL, NULL, '2022-07-02 09:58:43', '2022-07-02 09:58:43'),
(12, '২.২৫\'\'লুজ', NULL, NULL, '2022-07-02 09:58:59', '2022-07-02 09:58:59'),
(13, '২.৫০\'\'লুজ', NULL, NULL, '2022-07-02 09:59:28', '2022-07-02 09:59:28'),
(14, '২.৭৫\'\' লুজ', NULL, NULL, '2022-07-02 09:59:50', '2022-07-02 09:59:50'),
(15, '৩\'\' লুজ', NULL, NULL, '2022-07-02 10:00:32', '2022-07-02 10:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_part` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_part` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `worker_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_part`, `price`, `worker_cost`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Suit', 'Upper part', '3700.00', '910.00', 'n/a', NULL, '2022-01-26 01:25:16', '2022-08-27 10:31:20'),
(2, 'Suit 3pcs', 'Upper part', '4200.00', '910.00', 'n/a', NULL, '2022-01-26 01:30:20', '2022-08-04 10:13:57'),
(3, 'Blazer', 'Upper part', '3700.00', '910.00', 'n/a', NULL, '2022-01-26 01:30:53', '2022-06-05 09:25:22'),
(4, 'Mujib Coat', 'Upper part', '3200.00', '770.00', 'n/a', NULL, '2022-01-26 01:31:23', '2022-06-05 09:25:57'),
(5, 'Prince Coat', 'Upper part', '4500.00', '1010.00', 'n/a', NULL, '2022-01-26 01:31:46', '2022-06-05 09:26:35'),
(6, 'Sarwany', 'Upper part', '5500.00', '1000.00', 'n/a', NULL, '2022-01-26 01:32:08', '2022-06-05 09:26:57'),
(7, 'Safaari', 'Upper part', '2000.00', '400.00', 'n/a', NULL, '2022-01-26 01:32:25', '2022-06-05 09:27:38'),
(8, 'Coty', 'Upper part', '1500.00', '395.00', 'n/a', NULL, '2022-01-26 01:32:41', '2022-06-05 09:27:57'),
(9, 'Jeans Pant', 'Lower part', '600.00', '212.00', 'n/a', NULL, '2022-01-26 01:32:59', '2022-06-05 09:28:45'),
(10, 'Pant', 'Lower part', '550.00', '192.00', 'n/a', NULL, '2022-01-26 01:33:20', '2022-06-06 16:25:56'),
(11, 'Half Pant', 'Lower part', '450.00', '0.00', 'n/a', NULL, '2022-01-26 01:33:41', '2022-05-31 23:22:54'),
(12, 'Shirt', 'Upper part', '450.00', '138.00', 'n/a', NULL, '2022-01-26 01:34:32', '2022-06-06 16:25:40'),
(13, 'Double Cufling Shirt', 'Upper part', '450.00', '138.00', 'n/a', NULL, '2022-01-26 01:36:44', '2022-06-05 09:32:27'),
(14, 'Panjabi', 'Upper part', '550.00', '212.00', 'n/a', NULL, '2022-01-26 01:37:03', '2022-06-05 09:32:54'),
(15, 'Paijama', 'Lower part', '500.00', '160.00', 'n/a', NULL, '2022-01-26 01:37:22', '2022-06-05 09:33:23'),
(16, 'Fotua', 'Upper part', '450.00', '138.00', 'n/a', NULL, '2022-01-26 01:37:51', '2022-06-05 09:33:50'),
(17, 'Afron', 'Upper part', '600.00', '250.00', 'n/a', NULL, '2022-01-26 01:38:10', '2022-06-05 09:34:15'),
(18, 'Kabli Set', 'Upper part', '1100.00', '371.00', 'n/a', NULL, '2022-01-26 01:38:42', '2022-06-05 09:34:49'),
(19, 'Alem Coat', 'Upper part', '3200.00', '500.00', 'n/aa', NULL, '2022-01-26 01:39:03', '2022-06-05 09:35:38'),
(20, 'Modi Coat', 'Upper part', '1800.00', '500.00', 'n/a', NULL, '2022-01-26 01:39:25', '2022-06-05 09:35:54'),
(21, 'test', 'Upper part', '500.00', '200.00', 'n/a', '2022-05-16 01:03:00', '2022-03-05 23:07:20', '2022-05-16 01:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_worker`
--

CREATE TABLE `item_worker` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `worker_cost` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_worker`
--

INSERT INTO `item_worker` (`id`, `worker_id`, `item_id`, `worker_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 12, '138.00', NULL, NULL),
(2, 1, 13, '138.00', NULL, NULL),
(3, 2, 10, '192.00', NULL, NULL),
(4, 2, 9, '212.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journalables`
--

CREATE TABLE `journalables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_id` bigint(20) UNSIGNED NOT NULL,
  `journalable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `journalable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Spender',
  `note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_details`
--

CREATE TABLE `journal_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_debit` tinyint(1) NOT NULL,
  `is_credit` tinyint(1) NOT NULL,
  `pair_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `expire_date` date NOT NULL,
  `cash_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_installments`
--

CREATE TABLE `loan_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `adjustment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cash_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_13_174626_create_elements_table', 1),
(6, '2021_10_14_065500_create_accounts_table', 1),
(7, '2021_10_15_070521_create_groups_table', 1),
(8, '2021_10_15_080521_create_templates_table', 1),
(9, '2021_10_16_092851_create_banks_table', 1),
(10, '2021_10_19_173427_create_contacts_table', 1),
(11, '2021_10_21_093716_create_journals_table', 1),
(12, '2021_10_21_094808_create_depreciations_table', 1),
(15, '2022_01_20_103239_create_fittings_table', 4),
(16, '2022_01_20_071215_create_items_table', 5),
(19, '2022_01_27_045510_create_expense_categories_table', 6),
(20, '2022_01_27_045529_create_expense_sub_categories_table', 6),
(21, '2022_01_27_0455530_create_expenses_table', 7),
(38, '2022_02_14_051325_create_design_order_detail_table', 16),
(95, '2022_03_06_101717_create_images_table', 19),
(108, '2022_03_12_060103_create_item_worker_table', 21),
(109, '2022_02_05_054735_create_workers_table', 22),
(112, '2022_02_03_052303_create_order_details_table', 24),
(114, '2022_02_17_060030_create_distributions_table', 24),
(116, '2022_01_20_110913_create_customer_orders_table', 25),
(117, '2022_01_31_065150_create_payment_types_table', 26),
(118, '2022_02_03_052523_create_payment_details_table', 26),
(119, '2022_01_15_105827_create_customers_table', 27),
(120, '2022_03_24_105621_create_employees_table', 28),
(129, '2022_04_07_064738_create_cashes_table', 34),
(133, '2022_03_30_051120_create_employee_salaries_table', 36),
(134, '2022_03_31_093158_create_employee_salary_details_table', 36),
(135, '2022_03_29_065024_create_advanced_salaries_table', 37),
(136, '2022_03_31_070435_create_advanced_salary_details_table', 37),
(137, '2022_03_31_070649_create_advanced_salary_paid_details_table', 37),
(138, '2022_03_29_042649_create_worker_salaries_table', 38),
(140, '2022_01_20_092508_create_designs_table', 39),
(141, '2022_04_20_080256_create_design_item_table', 39),
(142, '2022_05_09_073653_create_vouchers_table', 40),
(143, '2022_05_26_040550_create_loans_table', 41),
(144, '2022_05_26_064844_create_loan_installments_table', 42);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `master_id` bigint(20) UNSIGNED NOT NULL,
  `upper_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belly` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upper_hip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleeve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mussle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neck` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belly_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hip_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `down` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `straight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lower_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muhuri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thigh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lower_hip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `front_down` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_down` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fly` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fitting_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `customer_order_id`, `item_id`, `image_id`, `master_id`, `upper_length`, `round_body`, `belly`, `upper_hip`, `solder`, `sleeve`, `coff`, `arm`, `mussle`, `neck`, `body_front`, `belly_front`, `hip_front`, `down`, `straight`, `lower_length`, `muhuri`, `knee`, `thigh`, `waist`, `lower_hip`, `high`, `front_down`, `back_down`, `fly`, `front`, `back`, `fitting_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 12, NULL, 1, '54', '54', '54', '54', '54', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', 1, '2023-05-08 05:32:11', '2023-05-08 05:32:11'),
(2, 1, 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '54', '45', '45', '54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', 1, '2023-05-08 05:32:11', '2023-05-08 05:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `customer_order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash_id` bigint(20) UNSIGNED NOT NULL,
  `total_paid` decimal(12,2) NOT NULL DEFAULT '0.00',
  `adjustment` decimal(12,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `date`, `customer_order_id`, `customer_id`, `payment_type`, `cash_id`, `total_paid`, `adjustment`, `description`, `created_at`, `updated_at`) VALUES
(1, '2023-05-08', 1, 1, 'cash', 1, '950.00', '0.00', NULL, '2023-05-08 05:32:12', '2023-05-13 21:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Cash', NULL, NULL, '2022-03-21 03:53:38', '2022-03-21 03:53:38'),
(2, 'Bcash', 'n/a', NULL, '2022-04-02 22:19:40', '2022-04-02 22:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `particular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_depreciable` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_details`
--

CREATE TABLE `template_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `is_debitable` tinyint(1) NOT NULL DEFAULT '0',
  `is_creditable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mahmudur Rahman', 'admin@maxsop.com', NULL, '$2y$10$EnJjscgKAGnqtcTzb4Xu3uk6kXyFNtES9Bj1E1MxIBc.tfkZUwwwq', NULL, '2022-01-19 23:29:43', '2022-01-19 23:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `worker_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `worker_name`, `mobile_no`, `balance`, `address`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kaye Yang', '01647000000', '0.00', NULL, NULL, NULL, '2023-04-06 00:46:52', '2023-04-06 00:46:52'),
(2, 'Wesley Guy', '01900000000', '0.00', NULL, NULL, NULL, '2023-04-06 00:47:39', '2023-04-06 00:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `worker_salaries`
--

CREATE TABLE `worker_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cash_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bonus_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `form_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_element_id_foreign` (`element_id`);

--
-- Indexes for table `advanced_salaries`
--
ALTER TABLE `advanced_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advanced_salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `advanced_salary_details`
--
ALTER TABLE `advanced_salary_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advanced_salary_details_advanced_salary_id_foreign` (`advanced_salary_id`),
  ADD KEY `advanced_salary_details_cash_id_foreign` (`cash_id`);

--
-- Indexes for table `advanced_salary_paid_details`
--
ALTER TABLE `advanced_salary_paid_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advanced_salary_paid_details_advanced_salary_details_id_foreign` (`advanced_salary_details_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `cashes`
--
ALTER TABLE `cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_addresses`
--
ALTER TABLE `contact_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_addresses_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_details_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `depreciations`
--
ALTER TABLE `depreciations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depreciations_journal_id_foreign` (`journal_id`);

--
-- Indexes for table `depreciation_details`
--
ALTER TABLE `depreciation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depreciation_details_depreciation_id_foreign` (`depreciation_id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_item`
--
ALTER TABLE `design_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `design_item_design_id_foreign` (`design_id`),
  ADD KEY `design_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `design_order_detail`
--
ALTER TABLE `design_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `design_order_detail_design_id_foreign` (`design_id`),
  ADD KEY `design_order_detail_order_details_id_foreign` (`order_details_id`);

--
-- Indexes for table `distributions`
--
ALTER TABLE `distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributions_order_details_id_foreign` (`order_details_id`),
  ADD KEY `distributions_worker_id_foreign` (`worker_id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salaries_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_salaries_cash_id_foreign` (`cash_id`);

--
-- Indexes for table `employee_salary_details`
--
ALTER TABLE `employee_salary_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salary_details_employee_salary_id_foreign` (`employee_salary_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `expenses_expense_sub_category_id_foreign` (`expense_sub_category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_sub_categories_expense_category_id_foreign` (`expense_category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fittings`
--
ALTER TABLE `fittings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_worker`
--
ALTER TABLE `item_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_worker_worker_id_foreign` (`worker_id`),
  ADD KEY `item_worker_item_id_foreign` (`item_id`);

--
-- Indexes for table `journalables`
--
ALTER TABLE `journalables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journalables_journal_id_foreign` (`journal_id`),
  ADD KEY `journalables_journalable_type_journalable_id_index` (`journalable_type`,`journalable_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journals_user_id_foreign` (`user_id`),
  ADD KEY `journals_group_id_foreign` (`group_id`),
  ADD KEY `journals_template_id_foreign` (`template_id`),
  ADD KEY `journals_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_details_journal_id_foreign` (`journal_id`),
  ADD KEY `journal_details_account_id_foreign` (`account_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_employee_id_foreign` (`employee_id`),
  ADD KEY `loans_cash_id_foreign` (`cash_id`);

--
-- Indexes for table `loan_installments`
--
ALTER TABLE `loan_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_installments_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_installments_cash_id_foreign` (`cash_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_customer_order_id_foreign` (`customer_order_id`),
  ADD KEY `order_details_item_id_foreign` (`item_id`),
  ADD KEY `order_details_image_id_foreign` (`image_id`),
  ADD KEY `order_details_fitting_id_foreign` (`fitting_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_details_customer_order_id_foreign` (`customer_order_id`),
  ADD KEY `payment_details_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templates_group_id_foreign` (`group_id`);

--
-- Indexes for table `template_details`
--
ALTER TABLE `template_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_details_template_id_foreign` (`template_id`),
  ADD KEY `template_details_account_id_foreign` (`account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_salaries`
--
ALTER TABLE `worker_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_salaries_worker_id_foreign` (`worker_id`),
  ADD KEY `worker_salaries_cash_id_foreign` (`cash_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advanced_salaries`
--
ALTER TABLE `advanced_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advanced_salary_details`
--
ALTER TABLE `advanced_salary_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advanced_salary_paid_details`
--
ALTER TABLE `advanced_salary_paid_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashes`
--
ALTER TABLE `cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_addresses`
--
ALTER TABLE `contact_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `depreciations`
--
ALTER TABLE `depreciations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depreciation_details`
--
ALTER TABLE `depreciation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `design_item`
--
ALTER TABLE `design_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=880;

--
-- AUTO_INCREMENT for table `design_order_detail`
--
ALTER TABLE `design_order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distributions`
--
ALTER TABLE `distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_salary_details`
--
ALTER TABLE `employee_salary_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fittings`
--
ALTER TABLE `fittings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `item_worker`
--
ALTER TABLE `item_worker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `journalables`
--
ALTER TABLE `journalables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_details`
--
ALTER TABLE `journal_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_installments`
--
ALTER TABLE `loan_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_details`
--
ALTER TABLE `template_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `worker_salaries`
--
ALTER TABLE `worker_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_element_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advanced_salaries`
--
ALTER TABLE `advanced_salaries`
  ADD CONSTRAINT `advanced_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advanced_salary_details`
--
ALTER TABLE `advanced_salary_details`
  ADD CONSTRAINT `advanced_salary_details_advanced_salary_id_foreign` FOREIGN KEY (`advanced_salary_id`) REFERENCES `advanced_salaries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advanced_salary_details_cash_id_foreign` FOREIGN KEY (`cash_id`) REFERENCES `cashes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advanced_salary_paid_details`
--
ALTER TABLE `advanced_salary_paid_details`
  ADD CONSTRAINT `advanced_salary_paid_details_advanced_salary_details_id_foreign` FOREIGN KEY (`advanced_salary_details_id`) REFERENCES `advanced_salary_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_addresses`
--
ALTER TABLE `contact_addresses`
  ADD CONSTRAINT `contact_addresses_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD CONSTRAINT `customer_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `depreciations`
--
ALTER TABLE `depreciations`
  ADD CONSTRAINT `depreciations_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `depreciation_details`
--
ALTER TABLE `depreciation_details`
  ADD CONSTRAINT `depreciation_details_depreciation_id_foreign` FOREIGN KEY (`depreciation_id`) REFERENCES `depreciations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `design_item`
--
ALTER TABLE `design_item`
  ADD CONSTRAINT `design_item_design_id_foreign` FOREIGN KEY (`design_id`) REFERENCES `designs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `design_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `design_order_detail`
--
ALTER TABLE `design_order_detail`
  ADD CONSTRAINT `design_order_detail_design_id_foreign` FOREIGN KEY (`design_id`) REFERENCES `designs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `design_order_detail_order_details_id_foreign` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributions`
--
ALTER TABLE `distributions`
  ADD CONSTRAINT `distributions_order_details_id_foreign` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributions_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD CONSTRAINT `employee_salaries_cash_id_foreign` FOREIGN KEY (`cash_id`) REFERENCES `cashes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_salary_details`
--
ALTER TABLE `employee_salary_details`
  ADD CONSTRAINT `employee_salary_details_employee_salary_id_foreign` FOREIGN KEY (`employee_salary_id`) REFERENCES `employee_salaries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_expense_sub_category_id_foreign` FOREIGN KEY (`expense_sub_category_id`) REFERENCES `expense_sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense_sub_categories`
--
ALTER TABLE `expense_sub_categories`
  ADD CONSTRAINT `expense_sub_categories_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_worker`
--
ALTER TABLE `item_worker`
  ADD CONSTRAINT `item_worker_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_worker_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journalables`
--
ALTER TABLE `journalables`
  ADD CONSTRAINT `journalables_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journals`
--
ALTER TABLE `journals`
  ADD CONSTRAINT `journals_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journals_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journals_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD CONSTRAINT `journal_details_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_details_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_cash_id_foreign` FOREIGN KEY (`cash_id`) REFERENCES `cashes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan_installments`
--
ALTER TABLE `loan_installments`
  ADD CONSTRAINT `loan_installments_cash_id_foreign` FOREIGN KEY (`cash_id`) REFERENCES `cashes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loan_installments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_customer_order_id_foreign` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_fitting_id_foreign` FOREIGN KEY (`fitting_id`) REFERENCES `fittings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_details_customer_order_id_foreign` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_details`
--
ALTER TABLE `template_details`
  ADD CONSTRAINT `template_details_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_details_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_salaries`
--
ALTER TABLE `worker_salaries`
  ADD CONSTRAINT `worker_salaries_cash_id_foreign` FOREIGN KEY (`cash_id`) REFERENCES `cashes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_salaries_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
