-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 03:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cc_matrix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'software@thesoftking.com', 'admin', NULL, '5e3042dd258e91580221149.jpg', '$2y$10$GmNdZfsrjLzsuwK3f8Woce6KWzm3KtRbL2gC5w1POh/Kf3SfTnMPO', 'BtnhfhmvqLpx0orbbE4nZO6aDjGGIXQ9I0746TaBpLciCFRRhQ4dS23Q6WHx', NULL, '2020-01-28 08:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `method_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `final_amo` decimal(11,2) DEFAULT NULL,
  `btc_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(11) NOT NULL DEFAULT 0,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT 1,
  `sms_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'ACCOUNT_RECOVERY_CODE', 'Account recovery code send', 'Account recovery code', 'Your account recovery code is: {{code}}', 'Your account recovery code is: {{code}}', '{\"code\":\"Recovery code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(2, 'EVER_CODE', 'Email Verification code send', 'Please verify your email address', 'Your email verification code is: {{code}}', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(3, 'SVER_CODE', 'Phone Verification code send', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(4, 'PASS_RESET', 'Password reset email', 'You have changed your password', 'Your password has been changed successfully', 'Your password has been changed successfully', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(6, 'WITHDRAW_PENDING', 'Withdraw Pending', 'Withdraw Request Pending', '{{amount}} Withdraw Request Successful Via {{method}}. Your Transaction Number {{trx}}. Charge {{charge}}', '{{amount}} Withdraw Request Successful Via {{method}}. Your Transaction Number {{trx}}. Charge {{charge}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\",\"charge\":\"Withdraw Charge\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(7, 'TRADE_START', 'Trading Start', 'Trade has been started', '{{trade}} has been started with {{amount}}', '{{trade}} has been started with {{amount}}', '{\"amount\":\"Trade Amount\", \"trade\":\"Trade Name\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(8, 'TRADE_END', 'Trading End', 'Trade has been Ended', '{{trade}} has been ended. {{amount}} has been refunded to your balance.', '{{trade}} has been ended. {{amount}} has been refunded to your balance.', '{\"trade\":\"Trade Name\",\"amount\":\"Trade Amount/Return Amount}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(9, 'TRADE_CLOSE', 'Trading Closed', 'Trading has been closed', '{{trade}} has been closed. You have collected {{profit}}.', '{{trade}} has been closed. You have collected {{profit}}.', '{\"trade\":\"Trade Name\",\"profit\":\"Trading Profit\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(10, '2FA_ENABLE', 'Google Two Factor Enable', 'Google Two Factor verification is enabled', 'Your verification code is: {{code}}', 'Your verification code is: {{code}}', '{\"trade\":\"Trade Name\",\"profit\":\"Trading Profit\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(11, '2FA_DISABLE', 'Google Two Factor Disable', 'Google Two Factor verification is disabled', 'Google two factor verification is disabled', 'Google two factor verification is disabled', '{}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(13, 'WITHDRAW_APPROVE', 'Withdraw Approved', 'Withdraw Request has been approved', '{{amount}} Withdraw Request Approved Successfully Via {{method}}. Your transaction number is {{trx}}. You should receive {{receive_amount}} after charge deduction {{charge}}', '{{amount}} Withdraw Request Approved Successfully Via {{method}}. Your transaction number is {{trx}}. You should receive {{receive_amount}} after charge deduction {{charge}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\",\"charge\":\"Withdraw Charge\",\"receive_amount\":\"Receivable Amount\" }', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(14, 'WITHDRAW_REJECT', 'Withdraw Reject', 'Withdraw Request has been rejected', '{{amount}} Withdraw Request Has Been Rejected For {{method}}. Your transaction number is {{trx}}', '{{amount}} Withdraw Request Has Been Rejected For {{method}}. Your transaction number is {{trx}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(15, 'DEPOSIT_PENDING', 'Deposit Pending', 'Deposit Request Pending', '{{amount}} Deposit Request Successful Via {{method}}. Your Transaction Number {{trx}}. Charge {{charge}}', '{{amount}} Deposit Request Successful Via {{method}}. Your Transaction Number {{trx}}. Charge {{charge}}', '{\"amount\":\"Deposit Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\",\"charge\":\"Deposit Charge\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(16, 'DEPOSIT_APPROVE', 'Deposit Approved', 'Deposit Request has been approved', '{{amount}} Deposit Request Approved Successfully Via {{method}}. Your transaction number is {{trx}}. You should receive {{receive_amount}} after charge deduction {{charge}}', '{{amount}} Deposit Request Approved Successfully Via {{method}}. Your transaction number is {{trx}}. You should receive {{receive_amount}} after charge deduction {{charge}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\",\"charge\":\"Withdraw Charge\",\"receive_amount\":\"Receivable Amount\" }', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(17, 'DEPOSIT_REJECT', 'Deposit Reject', 'Deposit Request has been rejected', '{{amount}} Deposit Request Has Been Rejected For {{method}}. Your transaction number is {{trx}}', '{{amount}} Deposit Request Has Been Rejected For {{method}}. Your transaction number is {{trx}}', '{\"amount\":\"Withdraw Amount\", \"method\":\"Method Name\",\"trx\":\"Transaction Number\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(18, 'REF_COM', 'Referral commission', 'You Got Referral commission', 'Congratulation, You Got Level {{reflevel}} Referral Commission.', 'Congratulation, You Got Level {{reflevel}} Referral Commission.', '{\"reflevel\":\"Refer Level\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(19, 'BAL_ADD', 'Balance Add by Admin', 'Your balance has been credited', 'Your balance has been credited with {{amount}}', 'Your balance has been credited with {{amount}}', '{\"amount\":\"Credited Amount\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(20, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your balance has been debited', 'Your balance has been debited by {{amount}}', 'Your balance has been debited by {{amount}}', '{\"amount\":\"Debited Amount\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(21, 'BAL_SEND', 'Balance Send', 'Balance Transfer Successfully', 'Balance transferred successfully complete. You send  {{amount}}  to  {{name}}  And charge to transfer  {{charge}}. Your current balance is {{balance_now}}', 'Balance transferred successfully complete. You send  {{amount}}  to  {{name}}  And charge to transfer  {{charge}}. Your current balance is {{balance_now}}', '{\"amount\":\"Send Amount\", \"name\":\"Receiver Name\",\"charge\":\"Transfer charge\" ,\"balance_now\":\" After Balance\"}', 1, 1, '2019-09-24 23:04:05', '2019-09-24 23:58:46'),
(22, 'bal_receive', 'Balance Received', 'Balance Received Successfully', 'Balance received successfully. You got {{amount}} from {{name}}  And charge {{charge}}. Your current balance is {{balance_now}}', 'Balance transferred successfully complete. You send  {{amount}}  to  {{name}}  And charge to transfer  {{charge}}. Your current balance is {{balance_now}}', '{\"amount\":\"Send Amount\", \"name\":\"Receiver Name\" ,\"balance_now\":\" After Balance\",\"charge\":\"Transfer charge\"}', 1, 1, '2019-09-24 23:04:05', '2019-11-09 08:46:09'),
(27, 'pan_purchased', 'Purchased Plan', 'Purchased Plan', 'Congratulation, You have successfully purchased {{name}}. {{price}}  subtract from your balance. And your current balance is {{balance_now}}.', 'Congratulation, You have successfully purchased {{name}}. {{price}}  subtract from your balance. And your current balance is {{balance_now}}.', '{\"price\":\"plan Price\", \"name\":\"Plan Name\" ,\"balance_now\":\" After Balance\"}', 1, 1, '2019-09-24 23:04:05', '2019-11-09 08:46:09'),
(28, 'referral_commission', 'referral commission', 'New referral commission', 'New referral commission : {{amount}}, from user {{username}}', 'New referral commission : {{amount}}, from user {{username}}', '{\"amount\":\"Referral commission\", \"username\":\"Referral commission from user\"}', 1, 1, '2019-09-24 23:04:05', '2020-01-01 04:27:21'),
(29, 'level_commission', 'Level commission', 'New Level commission', 'Congratulation, You Got  Level {{level_number}} Referral Commission. : {{amount}}, from user {{username}}', 'Congratulation, You Got  Level {{level_number}} Referral Commission. : {{amount}}, from user {{username}}', '{\"level_number\":\"Level\", \"amount\":\"Referral commission\", \"username\":\"Referral commission from user\"}', 1, 1, '2019-09-24 23:04:05', '2020-01-01 04:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `epins`
--

CREATE TABLE `epins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_user_id` int(11) NOT NULL DEFAULT 0,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'seo', '{\"keywords\":[\"forced matrix\",\"matrix\",\"mlm\",\"mlm business\",\"multilevel\",\"network marketing\",\"p2p\",\"pyramid\",\"uni matrix\",\"unilevel\"],\"description\":\"KingMatrix is a powerful MLM (Multilevel Marketing) Platform. With this awesome script you can run any set of matrix, like 2X3, 4X5 , 3X7 and whatever size you want. for demo, we set it 5X5.\",\"social_title\":\"KingMatrix\",\"social_description\":\"KingMatrix is a powerful MLM (Multilevel Marketing) Platform. With this awesome script you can run any set of matrix, like 2X3, 4X5 , 3X7 and whatever size you want. for demo, we set it 5X5.\",\"image\":\"5e303faa00e051580220330.jpg\"}', '2019-09-24 23:04:05', '2020-01-28 08:05:30'),
(6, 'testimonial', '{\"author\":\"John Doe\",\"designation\":\"Designer @ Adobe\",\"quote\":\"Lorem ipsum dolor sit amet, consetetur sadipscing elitr,\",\"image\":\"5d8b51026c3f51569411330.jpg\"}', '2019-09-24 23:35:19', '2019-09-24 23:35:30'),
(7, 'social.item', '{\"title\":\"facebook\",\"icon\":\"<i class=\\\"fab fa-facebook\\\"><\\/i>\",\"url\":\"#\"}', '2019-09-24 23:53:31', '2020-01-02 06:37:37'),
(8, 'blog.post', '{\"title\":\"osuere justo diam, commodo\",\"body\":\"<p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Tiam nisl sit quis, ante tempus pede phasellus vitae nulla, id semper vestibulum. Auctor pulvinar eget id at aliquam, lorem mattis praesent donec amet magna in, mauris etiam est ligula cras. Nec quisque. Pellentesque eget suspendisse ut. In eros, magna auctor augue ligula, amet vel erat amet litora ante. Auctor vestibulum erat vulputate, eget dictum amet quisque sem, a quaerat sed, ipsum aenean integer tellus, rutrum feugiat pellentesque turpis pede a quam.<\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Libero tincidunt tristique, vestibulum tempor ipsum praesent. A a, dolor in dui mauris sed proin sit, mattis ipsum id molestie integer sollicitudin, quis vivamus hymenaeos mi leo, sed condimentum. Sodales dolore vestibulum<\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\"><br><\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Tiam nisl sit quis, ante tempus pede phasellus vitae nulla, id semper vestibulum. Auctor pulvinar eget id at aliquam, lorem mattis praesent donec amet magna in, mauris etiam est ligula cras. Nec quisque. Pellentesque eget suspendisse ut. In eros, magna auctor augue ligula, amet vel erat amet litora ante. Auctor vestibulum erat vulputate, eget dictum amet quisque sem, a quaerat sed, ipsum aenean integer tellus, rutrum feugiat pellentesque turpis pede a quam.<\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Libero tincidunt tristique, vestibulum tempor ipsum praesent. A a, dolor in dui mauris sed proin sit, mattis ipsum id molestie integer sollicitudin, quis vivamus hymenaeos mi leo, sed condimentum. Sodales dolore vestibulum<\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\"><br><\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\"><br><\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Tiam nisl sit quis, ante tempus pede phasellus vitae nulla, id semper vestibulum. Auctor pulvinar eget id at aliquam, lorem mattis praesent donec amet magna in, mauris etiam est ligula cras. Nec quisque. Pellentesque eget suspendisse ut. In eros, magna auctor augue ligula, amet vel erat amet litora ante. Auctor vestibulum erat vulputate, eget dictum amet quisque sem, a quaerat sed, ipsum aenean integer tellus, rutrum feugiat pellentesque turpis pede a quam.<\\/p><p style=\\\"margin-top: -11px; margin-bottom: 31px; color: rgb(85, 85, 85); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgba(255, 255, 255, 0.05);\\\">Libero tincidunt tristique, vestibulum tempor ipsum praesent. A a, dolor in dui mauris sed proin sit, mattis ipsum id molestie integer sollicitudin, quis vivamus hymenaeos mi leo, sed condimentum. Sodales dolore vestibulum<\\/p>\",\"image\":\"5e2f113d668ad1580142909.jpg\"}', '2019-09-24 23:54:46', '2020-01-27 10:35:09'),
(9, 'blog.post', '{\"title\":\"Osamp - Multipurpose Tampleat\",\"body\":\"<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; color: rgb(132, 132, 132); line-height: 1.7; font-family: Poppins, sans-serif;\\\">Folly was these three and songs arose whose. Of in vicinity contempt together in possible branched. Friendship contrasted solicitude insipidity in introduced literature it. He seemed denote except as oppose do spring my. Between any may mention evening age shortly can ability regular. He shortly sixteen of colonel colonel evening cordial to. Although jointure an my of mistress servants am weddings. Age why the therefore education unfeeling for arranging. Above again money own scale maids ham least led.<\\/p><div><br><\\/div><div><div class=\\\"product-tab-wrapper mb-30\\\" style=\\\"margin-bottom: 30px; font-family: Poppins, sans-serif; font-size: 16px;\\\"><div class=\\\"tab-cont\\\" style=\\\"box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px 0px; padding: 30px;\\\"><div class=\\\"tab-item\\\" data-tab=\\\"tab0\\\"><div class=\\\"product-item-features\\\"><span class=\\\"caption\\\" style=\\\"display: inline-block; font-size: 18px; color: rgb(69, 69, 69); line-height: 1.7; margin: 0px 0px 15px; font-weight: 600;\\\">Template Features<\\/span><ul class=\\\"template-features\\\" style=\\\"padding-left: 20px; list-style-type: disc;\\\"><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">How Random Is Random?<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">What Is \\\"Cryptographycally Secure?\\\"<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">What You\'ll Cover Here<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">PRNGs in Python<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">The Random Module<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">PRNGs for Arrays:numpy.random<\\/li><li style=\\\"font-size: 14px; color: rgb(132, 132, 132); line-height: 1.7; margin: 0px;\\\">CPRNGs in Python<\\/li><li><\\/li><\\/ul><\\/div><\\/div><\\/div><\\/div><\\/div>\",\"image\":\"5e2f10b045f4b1580142768.jpg\"}', '2019-10-02 18:29:46', '2020-01-27 10:32:48'),
(11, 'social.item', '{\"title\":\"youtube\",\"icon\":\"<i class=\\\"fab fa-youtube\\\"><\\/i>\",\"url\":\"#\"}', '2019-10-02 18:34:17', '2020-01-02 03:25:14'),
(12, 'social.item', '{\"title\":\"twitter\",\"icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"#\"}', '2019-10-02 18:37:00', '2020-01-02 03:24:30'),
(13, 'social.item', '{\"title\":\"linkedin\",\"icon\":\"<i class=\\\"fab fa-linkedin\\\"><\\/i>\",\"url\":\"#\"}', '2019-10-02 18:38:36', '2020-01-02 06:37:48'),
(14, 'testimonial.title', '{\"title\":\"What People Says\",\"subtitle\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime!\"}', '2019-10-02 18:38:36', '2020-01-28 07:47:03'),
(15, 'testimonial', '{\"author\":\"John Doe II\",\"designation\":\"someone @ anything\",\"quote\":\"Lorem ipsum dolor sit amet, consetetur sadipscing elitr,\",\"image\":\"5e303c30c23241580219440.jpg\"}', '2019-10-14 01:34:14', '2020-01-28 07:50:40'),
(16, 'service.title', '{\"title\":\"Why Choose us\",\"subtitle\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime!\"}', '2019-10-02 18:38:36', '2020-01-28 07:23:03'),
(17, 'service.item', '{\"title\":\"Certified\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"far fa-file\\\"><\\/i>\"}', '2019-10-14 01:48:45', '2020-01-28 07:26:52'),
(18, 'service.item', '{\"title\":\"Secure\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-lock\\\"><\\/i>\"}', '2019-10-14 01:49:04', '2020-01-28 07:27:26'),
(19, 'service.item', '{\"title\":\"Profitable\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-hand-holding-heart\\\"><\\/i>\"}', '2019-10-14 01:49:23', '2020-01-28 07:45:04'),
(21, 'howWork.title', '{\"title\":\"How It Work\",\"subtitle\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime!\"}', '2019-10-02 18:38:36', '2020-01-28 07:13:17'),
(22, 'howWork.item', '{\"title\":\"SignUp\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fas fa-user-edit\\\"><\\/i>\"}', '2019-10-14 02:21:18', '2020-01-28 07:14:08'),
(23, 'howWork.item', '{\"title\":\"Bring People\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fas fa-users\\\"><\\/i>\"}', '2019-10-14 02:21:42', '2020-01-28 07:13:41'),
(24, 'howWork.item', '{\"title\":\"Get Paid\",\"sub_title\":\"Certainty listening no no behaviour existence assurance situation is. Because add why\",\"icon\":\"<i class=\\\"fas fa-wallet\\\"><\\/i>\"}', '2019-10-14 02:21:54', '2019-10-14 02:46:12'),
(27, 'footer.title', '{\"title\":\"\\u00a9 2020  - KingMatrix\",\"subtitle\":\"KingMatrix is a powerful MLM (Multilevel Marketing) Platform. With this awesome script you can run any set of matrix, like 2X3, 4X5 , 3X7 and whatever size you want. for demo, we set it 5X5.\"}', '2019-10-02 18:38:36', '2020-01-28 08:01:15'),
(28, 'about.title', '{\"title\":\"About Us\",\"detail\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime, nihil corporis quis beatae neque, esse. Laborum maxime blanditiis quasi voluptate nisi tempore, rem, quae culpa, voluptas quod tempora animi! Architecto vitae dolorem, at. Libero atque obcaecati voluptatibus voluptate fuga in!\",\"image\":\"5e087e17220a61577614871.jpg\"}', '2019-10-02 18:38:36', '2020-01-28 07:11:35'),
(29, 'faq.post', '{\"title\":\"How to Register\",\"body\":\"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.<br>\"}', '2019-09-24 23:54:46', '2019-09-24 23:57:26'),
(30, 'faq.post', '{\"title\":\"WHAT IS THE E-PIN USED FOR?\",\"body\":\"The E-pin is a unique feature that allows users to share their funds in form recharge pins. You can share your funds with E-pin by clicking on the E-pin recharge option in you dashboard then click on the \'create new pin\' button, insert the amount you wish to convert to a recharge pin, then click \'generate\'. You will find the pin below. When you want to use the recharge pin, copy the recharge pin, click on E-pin recharge, paste in the \'ENTER PIN\' box,  click on \'recharge now\'. You will find the equivalent amount deposited into your dashboard.\"}', '2019-10-20 04:39:57', '2019-10-20 04:39:57'),
(31, 'faq.post', '{\"title\":\"CAN I TRANSFER FUNDS TO ANY USER FROM MY ACCOUNT?\",\"body\":\"Yes you can, you can do that by clicking on the transfer balance option in your dashboard, insert the persons username or email followed by the amount then click send.\"}', '2019-10-20 04:40:29', '2019-10-20 04:40:29'),
(32, 'faq.post', '{\"title\":\"HOW CAN I SIGN UP ON THE WEBSITE?\",\"body\":\"You can sign up on the website using your e-mail address, mobile number, full name and a username.\"}', '2019-10-20 04:40:39', '2019-10-20 04:40:39'),
(33, 'faq.post', '{\"title\":\"IS THE WITHDRAWAL FROM EGOLDRICH FAST?\",\"body\":\"Our withdrawal system is automated. We aspire to process all withdrawal request immediately, Kindly make sure you provide your correct withdrawal details to avoid an error response.\"}', '2019-10-20 04:40:48', '2019-10-20 04:40:48'),
(34, 'faq.post', '{\"title\":\"I FORGOT MY E-MAIL ADDRESS WHAT SHALL I DO?\",\"body\":\"Contact our support service via the form on the website or e-mail to: support@egoldrich.com. We will try to help you as soon as possible.\"}', '2019-10-20 04:40:57', '2019-10-20 04:40:57'),
(35, 'faq.post', '{\"title\":\"CAN I OPEN SEVERAL ACCOUNTS?\",\"body\":\"Multiple registration is strictly prohibited!\"}', '2019-10-20 04:41:06', '2019-10-20 04:41:06'),
(36, 'faq.post', '{\"title\":\"HOW CAN I GET MY REFERRAL BONUSES?\",\"body\":\"You get your bonuses instantly as soon as any or all of your 5 referrals (which is the minimum number of referrals) make deposits, it will be displayed in the account balance section of your dashboard.\"}', '2019-10-20 04:41:16', '2019-10-20 04:43:54'),
(44, 'contact.post', '{\"phone\":\"1111-2222-3333 3333-2222-1111\",\"email\":\"demo@demo.com\",\"address\":\"Bahamas, French , London Dhaka, 1230\"}', '2019-10-14 02:21:54', '2019-12-21 05:16:35'),
(45, 'blog.title', '{\"title\":\"Latest News\",\"subtitle\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime!\"}', '2019-10-02 18:38:36', '2020-01-28 08:24:46'),
(46, 'banner', '{\"title\":\"Matrix MLM\",\"subtitle\":\"Earn more  Togather\",\"details\":\"With this awesome script you can run any set of matrix, like 2X3, 4X5 , 3X7 and whatever size you want. for demo, we set it 5X5.\",\"image\":\"5e3034d1317f21580217553.jpg\"}', '2019-10-20 07:30:38', '2020-01-28 07:21:14'),
(47, 'blog.post', '{\"title\":\"What is Lorem Ipsum?\",\"body\":\"<h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">The standard Lorem Ipsum passage, used since the 1500s<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\\\"<\\/p>\",\"image\":\"5e2f1047289b41580142663.jpg\"}', '2019-12-21 08:11:04', '2020-01-27 10:31:03'),
(48, 'blog.post', '{\"title\":\"What is Lorem Ipsum?\",\"body\":\"<h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">The standard Lorem Ipsum passage, used since the 1500s<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\\\"<\\/p>\",\"image\":\"5e2f103ed11c81580142654.jpeg\"}', '2019-12-21 08:11:12', '2020-01-27 10:30:54'),
(49, 'blog.post', '{\"title\":\"Where can I get some?\",\"body\":\"<h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">The standard Lorem Ipsum passage, used since the 1500s<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p><h3 style=\\\"margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Section 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">\\\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\\\"&nbsp;&nbsp; <br><\\/p>\",\"image\":\"5e2f101dba6b31580142621.jpg\"}', '2019-12-21 08:12:36', '2020-01-27 10:30:21'),
(56, 'vid.post', '{\"title\":\"Video Presentation\",\"link\":\"https:\\/\\/www.youtube.com\\/embed\\/GT6-H4BRyqQ\",\"detail\":\"Nunc nec amet vestibulum. Nunc fringilla, aenean ipsum lorem morbi consectetuer aliquam quis, mauris ullamcorper, nam diam, fusce justo vestibulum felis. Lorem dapibus sed, modi dis magna vulputate laoreet Pellentesque mi aliquam suspendisse a leo, lacus facilisi ac sem ipsum lorem bibendum.\",\"image\":\"5e303dd6cbca91580219862.png\"}', '2019-10-14 02:21:54', '2020-01-28 07:57:42'),
(58, 'plan.title', '{\"title\":\"Our Plans\",\"subtitle\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est maiores quo tempora illum quibusdam, incidunt aspernatur, voluptatem maxime!\"}', '2019-10-02 18:38:36', '2020-01-28 07:15:02'),
(59, 'service.item', '{\"title\":\"Crypto\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fab fa-bitcoin\\\"><\\/i>\"}', '2020-01-28 07:45:17', '2020-01-28 07:45:26'),
(60, 'service.item', '{\"title\":\"Support\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-life-ring\\\"><\\/i>\"}', '2020-01-28 07:45:42', '2020-01-28 07:45:42'),
(61, 'service.item', '{\"title\":\"Global\",\"sub_title\":\"A better way to present your money using fully featured digital\",\"icon\":\"<i class=\\\"fas fa-globe\\\"><\\/i>\"}', '2020-01-28 07:46:03', '2020-01-28 07:46:03'),
(62, 'testimonial', '{\"author\":\"Jony Vai\",\"designation\":\"Investor\",\"quote\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit\",\"image\":\"5e303c67a77fc1580219495.jpg\"}', '2020-01-28 07:51:35', '2020-01-28 07:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `parameter_list` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `name`, `alias`, `image`, `status`, `parameter_list`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 101, 'Paypal', 'Paypal', '5d985257a92911570263639.jpg', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"i@abir.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, 'PayPal allows customers to establish an account on its platform, which is connected to a user\'s credit card or checking account. PayPal is a fast, simple, and secure way to make a payment online.', '2019-09-14 13:14:22', '2019-10-06 18:24:54'),
(2, 102, 'Perfect Money', 'Perfect Money', '5d985267e2ee31570263655.jpg', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"6451561651551dfgdfhhth\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, 'Paytm is largest mobile payments and commerce platform. It started with online mobile recharge and bill payments and has an online marketplace today. To keep things at ease, you can also use Paytm Wallet.', '2019-09-14 13:14:22', '2019-10-06 18:24:52'),
(3, 103, 'Stripe', 'Stripe', '5d98527da9ede1570263677.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, 'Stripe is a third-party payments processor built around a simple idea: make it easy for companies to do business online.', '2019-09-14 13:14:22', '2019-10-04 20:21:17'),
(4, 104, 'Skrill', 'Skrill', '5d985288936bd1570263688.jpg', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"TheSoftKing\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, 'Skrill is one of the most popular electronic payment systems in the world. In addition to rapid processing of payments and low commissions, the system’s advantages include the ability to use credit cards. Making a deposit using Skrill is possible through a form in the Personal Account.', '2019-09-14 13:14:22', '2019-10-04 20:21:28'),
(5, 105, 'PayTM', 'PayTM', '5d9852b9c57da1570263737.jpg', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, 'Paytm is largest mobile payments and commerce platform. It started with online mobile recharge and bill payments and has an online marketplace today. To keep things at ease, you can also use Paytm Wallet.', '2019-09-14 13:14:22', '2019-10-04 20:22:17'),
(6, 106, 'Payeer', 'Payeer', '5d9852d61a60d1570263766.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.g106\"}}', 'Payeer is one of the many e-wallets available for use on betting sites. As mentioned, the payment gateway allows deposits through various methods.', '2019-09-14 13:14:22', '2019-10-04 20:22:46'),
(7, 107, 'PayStack', 'PayStack', '5d9852ee227461570263790.jpg', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.g107\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.g107\"}}\r\n', 'Paystack, a widely popular payment gateway for African business, facilitates to accept secure online payments. The payment gateway allows the businesses registered in Africa to accept the payments from global customers.', '2019-09-14 13:14:22', '2019-10-04 20:23:10'),
(8, 108, 'VoguePay', 'VoguePay', '5d9852faa21731570263802.jpg', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, 'VoguePay is an online payment gateway allows site owners to receive payment for their goods and services on their website without any setup fee for both local and International payments', '2019-09-14 13:14:22', '2019-10-04 20:23:22'),
(9, 109, 'Flutterwave', 'Flutterwave', '5d9853f5ce5f61570264053.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"FLWPUBK_TEST-5d9bb05bba2c13aa6c7a1ec7d7526ba2-X\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"FLWSECK_TEST-2ac7b05b6b9fa8a423eb58241fd7bbb6-X\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"FLWSECK_TEST32e13665a95a\"}}', '{\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}', 0, NULL, 'Its process credit card and local alternative payments, like mobile money and ACH, across Africa. They make it possible for global merchants to process payments like a local African company.', '2019-09-14 13:14:22', '2019-10-04 20:27:33'),
(10, 110, 'RazorPay', 'RazorPay', '5d9854adb0e101570264237.jpg', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, 'Razor’s payment gateway is one of the most ambitious in its sector. Razorpay allows online businesses to accept, process and disburse digital payments through several payment modes like debit cards, credit cards, net banking, UPI and prepaid digital wallets.', '2019-09-14 13:14:22', '2019-10-04 20:30:37'),
(11, 111, 'Stripe JS', 'Stripe JS', '5d9855a3c43381570264483.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, 'Stripe JS is a third-party payments processor built around a simple idea: make it easy for companies to do business online. It’s not just about processing credit cards. Stripe JS primarily targets developers with a suite of tools that make it nearly effortless to handle everything from in-app payments to marketplace transactions.', '2019-09-14 13:14:22', '2019-10-04 20:34:43'),
(12, 112, 'Instamojo', 'Instamojo', '5d9855d1485701570264529.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, 'Instamojo Payment Gateway in PHP As for indian Payment Gateway. It provides many solutions like test environment and signup process also is simple.', '2019-09-14 13:14:22', '2019-10-04 20:35:29'),
(13, 501, 'Blockchain', 'Blockchain', '5d98566ba7b2b1570264683.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"8df2e5a0-3798-4b74-871d-973615b57e7b\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CXLqfWXj1xgXe79nEQb3pv2E7TGD13pZgHceZKrQAxqXdrC2FaKuQhm5CYVGyNcHLhSdWau4eQvq3EDCyayvbKJvXa11MX9i2cHPugpt3G\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, 'Blockchain has been able to give under banked groups access to money, allows people to make cross-border payments and uses smart contracts to act as a means towards faster and safer payment processing', '2019-09-14 13:14:22', '2019-10-04 20:38:03'),
(14, 502, 'Block.io', 'Block.io', '5d98580ee98ed1570265102.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"qwertyuiop\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.g502\"}}', 'This method provides exponentially higher security for your Wallets and applications than single-signature addresses. This way, you spend coins yourself, without trusting Block.io with your credentials.', '2019-09-14 13:14:22', '2019-11-04 23:35:23'),
(15, 503, 'CoinPayments', 'CoinPayments', '5d985d51661061570266449.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"7638eebaf4061b7f7cdfceb14046318bbdabf7e2f64944773d6550bd59f70274\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"Cb6dee7af8Eb9E0D4123543E690dA3673294147A5Dc8e7a621B5d484a3803207\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, 'CoinPayments is a cloud wallet solution that offers an easy way to integrate a checkout system for numerous cryptocurrencies. Its website offers payment solutions for multiple crypto-currencies such as bitcoin and litecoin.', '2019-09-14 13:14:22', '2019-12-31 15:57:29'),
(16, 504, 'CoinPayments Fiat', 'CoinPayments Fiat', '5d985d5aef47b1570266458.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, 'This is the same gateway as CoinPayments but we used fiat currency as calculation currency.', '2019-09-14 13:14:22', '2019-10-04 21:07:39'),
(17, 505, 'Coingate', 'Coingate', '5d985d66805591570266470.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, 'CoinGate Bitcoin Payment Processor is an online cryptocurrency platform that provides merchant services to businesses and individuals', '2019-09-14 13:14:22', '2019-10-04 21:07:50'),
(18, 506, 'Coinbase Commerce', 'Coinbase commerce', '5d985d7d8fcc91570266493.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a-\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66-\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.g506\"}}', 'Coinbase Commerce allows merchants to accept cryptocurrency payments in Bitcoin, Bitcoin Cash, Ethereum and Litecoin.', '2019-09-14 13:14:22', '2019-10-04 21:56:10'),
(19, 1000, 'The soft bank', 'The soft bank', '5db411c6d294d1572082118.png', 1, '[]', '[]', 0, '{\"delay\":\"4 Dasys\",\"verify_image\":\"image\"}', 'jhdkmsd', '2019-10-22 00:06:18', '2020-01-27 07:04:46'),
(20, 1001, 'Manual Deposit', 'Manual Deposit', '', 1, '[]', '[]', 0, '{\"delay\":\"0-24 Hours\",\"verify_image\":\"image\"}', '<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry.</span><br>', '2020-01-26 02:40:56', '2020-01-26 02:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percent_charge` decimal(8,4) NOT NULL DEFAULT 0.0000,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sitename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `efrom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email sent from',
  `etemp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email template',
  `smsapi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sms api',
  `bclr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Base Color',
  `sclr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Secondary Color',
  `ev` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sv` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `social_login` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'social login',
  `reg` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'allow registration',
  `alert` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => none, 1 => iziToast, 2 => toaster',
  `active_template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'active template folder name',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matrix_width` int(10) NOT NULL DEFAULT 1,
  `matrix_height` int(10) NOT NULL DEFAULT 1,
  `bal_trans_fixed_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `bal_trans_per_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `cur_text`, `cur_sym`, `efrom`, `etemp`, `smsapi`, `bclr`, `sclr`, `ev`, `en`, `mail_config`, `sv`, `sn`, `social_login`, `reg`, `alert`, `active_template`, `created_at`, `updated_at`, `matrix_width`, `matrix_height`, `bal_trans_fixed_charge`, `bal_trans_per_charge`, `contact_email`, `contact_address`, `contact_phone`) VALUES
(1, 'KingMatrix', 'USD', '$', 'do-not-reply@thesoftking.com', '<br style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;\"><br style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;\"><div class=\"contents\" style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; max-width: 600px; margin: 0px auto; border: 2px solid rgb(0, 0, 54);\"><div class=\"header\" style=\"background-color: rgb(0, 0, 54); padding: 15px; text-align: center;\"><div class=\"logo\" style=\"padding: 25px; width: 260px; margin: 0px auto;\"><img src=\"https://i.imgur.com/4NN55uD.png\" alt=\"THESOFTKING\" style=\"width: 210px;\">&nbsp;	</div></div><div class=\"mailtext\" style=\"padding: 30px 15px; background-color: rgb(240, 248, 255); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; line-height: 26px;\">Hi {{name}},&nbsp;<br><br>{{message}}&nbsp;<br><br><br><br></div><div class=\"footer\" style=\"background-color: rgb(0, 0, 54); padding: 15px; text-align: center;\"><a href=\"https://thesoftking.com/\" style=\"color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;\">WEBSITE</a>&nbsp;<a href=\"https://thesoftking.com/products\" style=\"color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;\">PRODUCTS</a>&nbsp;<a href=\"https://thesoftking.com/contact\" style=\"color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; font-weight: 600; border-radius: 4px;\">CONTACT</a></div><div class=\"footer\" style=\"background-color: rgb(0, 0, 54); padding: 15px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.2);\"><span style=\"font-weight: bolder; color: rgb(255, 255, 255);\">© 2011 - 2020 THESOFTKING. All Rights Reserved.</span><p style=\"color: rgb(221, 221, 221);\">TheSoftKing is not partnered with any other company or person. We work as a team and do not have any reseller, distributor or partner!</p></div></div><br style=\"font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;\">', NULL, '2ecc71', '000036', 0, 1, '{\"name\":\"php\"}', 0, 0, 0, 1, 1, 'tmp2', '2019-10-18 23:16:05', '2020-01-28 07:04:54', 5, 5, '2', '5', 'do-not-reply@thesoftking.com', 'Company Location, City, Country', '1111-2222-3333, 3333-2222-1111');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrix_levels`
--

CREATE TABLE `matrix_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `ref_bonus` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google-analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{app_key}}\");\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"Demo\"}}', 'ganalytics.png', 1, '2019-10-18 23:16:05', '2019-10-18 23:16:05'),
(2, 'tawk-chat', 'Tawk Chat', 'Key location is shown bellow', 'tawky_big.png', '<script>\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\n                        (function(){\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\n                        s1.async=true;\n                        s1.src=\"https://embed.tawk.to/{{app_key}}/default\";\n                        s1.charset=\"UTF-8\";\n                        s1.setAttribute(\"crossorigin\",\"*\");\n                        s0.parentNode.insertBefore(s1,s0);\n                        })();\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"Demo\"}}', 'twak.png', 1, '2019-10-18 23:16:05', '2019-10-18 23:16:05'),
(3, 'google-recaptcha3', 'Google Recaptch 3', 'Key location is shown bellow', 'recaptcha3.png', '<script type=\"text/javascript\">\n\n                            var onloadCallback = function() {\n                                grecaptcha.render(\"recaptcha\", {\n                                    \"sitekey\" : \"{{sitekey}}\",\n                                    \"callback\": function(token) {\n                                        $(\"#recaptcha\").parents(\"form:first\").submit();\n                                    } \n                                });\n                            };\n                        </script>\n                        <script src=\"https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit\" async defer></script>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"6Ldy8bUUAAAAALn0JWsmdKYvOBuL18qExf1PczsJ\"}}', 'recaptcha.png', 1, '2019-10-18 23:16:05', '2020-01-27 06:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_comments`
--

CREATE TABLE `support_ticket_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: user, 1: admin',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trxes`
--

CREATE TABLE `trxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_amo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `balance` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ref_id` int(10) NOT NULL DEFAULT 0,
  `plan_id` int(10) NOT NULL DEFAULT 0,
  `position` int(10) NOT NULL DEFAULT 0 COMMENT 'Position 1/2/3/4',
  `position_id` int(10) NOT NULL DEFAULT 0 COMMENT 'after user id',
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `ev` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ac_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ac_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ac` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ctm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cancel payemt',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `final_amo` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(18,8) NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_limit` decimal(18,8) NOT NULL,
  `max_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_charge` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `percent_charge` decimal(5,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_sms_templates_act_unique` (`act`);

--
-- Indexes for table `epins`
--
ALTER TABLE `epins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `epins_pin_unique` (`pin`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frontends_key_index` (`key`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gateways_code_unique` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gateway_currencies_method_code_index` (`method_code`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matrix_levels`
--
ALTER TABLE `matrix_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plugins_act_unique` (`act`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_comments`
--
ALTER TABLE `support_ticket_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trxes`
--
ALTER TABLE `trxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdrawals_trx_unique` (`trx`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `epins`
--
ALTER TABLE `epins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matrix_levels`
--
ALTER TABLE `matrix_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_ticket_comments`
--
ALTER TABLE `support_ticket_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trxes`
--
ALTER TABLE `trxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
