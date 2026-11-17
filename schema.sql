-- Expense Tracker Database Schema
-- Database: expense_tracker

CREATE DATABASE IF NOT EXISTS `expense_tracker` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `expense_tracker`;

-- --------------------------------------------------------
-- Table: users
-- --------------------------------------------------------
DROP TABLE IF EXISTS `budgets`;
DROP TABLE IF EXISTS `expenses`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: categories
-- --------------------------------------------------------
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `user_id` INT DEFAULT NULL,
    INDEX `idx_categories_user` (`user_id`),
    CONSTRAINT `fk_categories_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed default categories (global categories have user_id = NULL)
INSERT INTO `categories` (`name`, `user_id`) VALUES
('Food', NULL),
('Transport', NULL),
('Rent', NULL),
('Entertainment', NULL),
('Health', NULL),
('Shopping', NULL),
('Utilities', NULL),
('Education', NULL),
('Other', NULL);

-- --------------------------------------------------------
-- Table: expenses
-- --------------------------------------------------------
CREATE TABLE `expenses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `note` VARCHAR(255) DEFAULT NULL,
    `expense_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_expenses_user_date` (`user_id`, `expense_date`),
    CONSTRAINT `fk_expenses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_expenses_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: budgets
-- --------------------------------------------------------
CREATE TABLE `budgets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `month` TINYINT NOT NULL,
    `year` SMALLINT NOT NULL,
    UNIQUE KEY `unique_budget` (`user_id`, `category_id`, `month`, `year`),
    INDEX `idx_budgets_user_period` (`user_id`, `month`, `year`),
    CONSTRAINT `fk_budgets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_budgets_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
