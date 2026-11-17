# Expense Tracker (Portal)

A modern, full-stack personal finance and expense management web application. Built with a clean **PHP (PDO)** backend exposing a **RESTful JSON API**, paired with an interactive **Vanilla JavaScript** frontend, **Bootstrap 5**, and **Chart.js** data visualizations.

---

## Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Project Architecture & Directory Structure](#-project-architecture--directory-structure)
- [Database Schema & Setup](#-database-schema--setup)
- [Installation & Setup](#-installation--setup)
- [Configuration](#-configuration)
- [REST API Reference](#-rest-api-reference)
- [Security & Engineering Highlights](#-security--engineering-highlights)
- [License](#-license)

---

## Overview

Expense Tracker is designed to provide users with complete visibility into their financial habits. Users can log daily transactions, categorize expenditures, establish monthly budgets per category, inspect real-time visual analytics (budget vs. actual spend bar charts and category distribution pie charts), receive over-budget warnings, and export transaction data directly to CSV.

---

## Key Features

- ** Secure Authentication & User Accounts**
  - User registration with strong password enforcement (uppercase, lowercase, number, special character, 8+ characters).
  - Secure login using PHP session management and `password_hash()` / `password_verify()` (Bcrypt).
  - Protected routes via `auth_guard.php`.
  - Profile management with account details and password change functionality.

- ** Expense Management (CRUD)**
  - Add, view, edit, and delete expenses in real-time.
  - Track amount, date, category, and optional notes for every transaction.
  - Filter and review transactions dynamically.

- ** Monthly Category Budgets**
  - Set target budgets per category for specific months and years.
  - Database-enforced uniqueness prevents duplicate budgets for the same category and period.

- ** Visual Analytics & Over-Budget Alerts**
  - **Budget vs. Actual Spent**: Bar and line chart comparison powered by Chart.js.
  - **Spending Distribution**: Dynamic donut/pie breakdown by category.
  - **Visual Warnings**: Automatic badge notifications when spending exceeds the established budget.

- ** CSV Data Export**
  - One-click export downloading the user's complete expense history formatted as a CSV spreadsheet.

- ** Premium UI & Theming**
  - Modern aesthetic featuring responsive layouts, custom glassmorphism cards, and dark mode support.

---

##  Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.x (Vanilla, Object-Oriented PDO) |
| **Database** | MySQL / MariaDB (InnoDB engine, Foreign Keys, Cascading Deletes) |
| **Frontend** | Vanilla JavaScript (ES6+, Fetch API, Async/Await) |
| **UI Framework** | Bootstrap 5.3 + Custom CSS3 variables & styling |
| **Charts** | Chart.js 4.x |
| **Server** | Apache (XAMPP / Laragon) or PHP Built-in Server |

---

##  Project Architecture & Directory Structure

```text
expense-tracker/
├── api/                       # REST API endpoints returning JSON
│   ├── budgets.php            # GET, POST, PUT, DELETE category budgets
│   ├── categories.php         # GET list of available expense categories
│   ├── expenses.php           # GET, POST, PUT, DELETE expense records
│   └── stats.php              # Aggregated monthly statistics for charts & alerts
├── assets/                    # Static frontend assets
│   ├── css/
│   │   └── app.css            # Custom CSS overrides and styles
│   └── js/
│       ├── auth.js            # Frontend auth interactions
│       ├── budgets.js         # Budget form submission & async sync
│       ├── categories.js      # Dynamic category dropdown populator
│       ├── charts.js          # Chart.js rendering & over-budget alert logic
│       └── expenses.js        # Expense table rendering, editing, & deletion
├── exports/
│   └── export.php             # Streams user expense history as CSV download
├── includes/
│   ├── auth_guard.php         # Session verification middleware for protected views
│   └── db.php                 # Reusable PDO database connection instance
├── pages/                     # Application views / user interfaces
│   ├── dashboard.php          # Main analytical dashboard & transaction tracker
│   ├── login.php              # Login view & credential handler
│   ├── logout.php             # Session invalidation & redirect
│   ├── profile.php            # Account overview & password update form
│   └── register.php           # Account registration view & validation handler
├── index.php                  # Landing page introducing the platform
└── README.md                  # Project documentation
```

---

## Database Schema & Setup

Execute the following SQL script in your database management tool (**phpMyAdmin**, **MySQL Workbench**, or **HeidiSQL**) to create the database, tables, relationships, and seed categories:

```sql
CREATE DATABASE IF NOT EXISTS `expense_tracker` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `expense_tracker`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Categories Table
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `user_id` INT DEFAULT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Seed default categories
INSERT INTO `categories` (`name`, `icon`) VALUES
('Food'),
('Transport'),
('Rent', '🏠'),
('Entertainment'),
('Health'),
('Shopping'),
('Other')
ON DUPLICATE KEY UPDATE `name`=`name`;

-- 3. Expenses Table
CREATE TABLE IF NOT EXISTS `expenses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `note` VARCHAR(255) DEFAULT NULL,
    `expense_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 4. Budgets Table
CREATE TABLE IF NOT EXISTS `budgets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `month` TINYINT NOT NULL,
    `year` SMALLINT NOT NULL,
    UNIQUE KEY `unique_budget` (`user_id`, `category_id`, `month`, `year`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
```

---

## Installation & Setup

### Prerequisites

- **PHP 8.0 or higher** with `pdo_mysql`, `mbstring`, and `session` extensions enabled.
- **MySQL 5.7+ / MariaDB 10.3+**.
- A local web server environment such as **XAMPP**, **Laragon**, **WampServer**, or PHP's built-in CLI server.

### Step-by-Step Setup

1. **Place Project in Web Root**:
   - If using **XAMPP**: move the project folder into `C:\xampp\htdocs\expense-tracker`.
   - If using **Laragon**: place into `C:\laragon\www\expense-tracker`.

2. **Configure Database Connection**:
   Open [includes/db.php](file:///c:/Users/Dell/Desktop/New%20folder%20(2)-20261113T214519Z-1-001/New%20folder%20(2)/htdocs/Expenses%20tracker/expense-tracker/includes/db.php) and verify your MySQL credentials:
   ```php
   $dbname = 'expense_tracker';
   $host   = 'localhost';
   $user   = 'root';
   $psw    = ''; // Update if your MySQL root account has a password
   ```

3. **Import Database Schema**:
   Run the SQL statements provided in the [Database Schema & Setup](#-database-schema--setup) section above.

4. **Start the Web Server**:
   - Start **Apache** and **MySQL** from your XAMPP/Laragon control panel.
   - Alternatively, you can launch PHP's built-in web server from the terminal:
     ```bash
     cd "C:\Users\Dell\Desktop\New folder (2)-20261113T214519Z-1-001\New folder (2)\htdocs\Expenses tracker\expense-tracker"
     php -S localhost:8000
     ```

5. **Access the Application**:
   - If using XAMPP/Laragon: Open your browser to `http://localhost/expense-tracker/` (or matching path).
   - If using PHP CLI server: Navigate to `http://localhost:8000/`.

---

## REST API Reference

All API endpoints return JSON data and require an authenticated active session.

### 1. Expenses API (`/api/expenses.php`)

| Method | Endpoint | Query Parameters | Body Parameters (JSON) | Description |
|---|---|---|---|---|
| `GET` | `/api/expenses.php` | `month` (opt), `year` (opt) | None | Returns list of expenses for the period. |
| `GET` | `/api/expenses.php` | `expense_id` | None | Returns single expense record. |
| `POST` | `/api/expenses.php` | None | `amount`, `category_id`, `date`, `note` | Creates a new expense record. |
| `PUT` | `/api/expenses.php` | `expense_id` | `amount`, `category_id`, `date`, `note` | Updates existing expense. |
| `DELETE` | `/api/expenses.php` | `expense_id` | None | Deletes an expense record. |

### 2. Budgets API (`/api/budgets.php`)

| Method | Endpoint | Query Parameters | Body Parameters (JSON) | Description |
|---|---|---|---|---|
| `GET` | `/api/budgets.php` | `month` (opt), `year` (opt) | None | Returns active budgets for the given month/year. |
| `POST` | `/api/budgets.php` | None | `category_id`, `amount`, `month`, `year` | Sets or creates a budget for a category. |
| `PUT` | `/api/budgets.php` | None | `id`, `category_id`, `amount`, `month`, `year` | Updates an existing budget. |
| `DELETE` | `/api/budgets.php` | `budget_id` | None | Removes a budget record. |

### 3. Categories API (`/api/categories.php`)

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/categories.php` | Returns all available expense categories. |

### 4. Stats & Analytics API (`/api/stats.php`)

| Method | Endpoint | Query Parameters | Description |
|---|---|---|---|
| `GET` | `/api/stats.php` | `month` (opt), `year` (opt) | Returns aggregated data combining budget vs. total expense per category. |

### 5. CSV Export (`/exports/export.php`)

| Method | Endpoint | Output | Description |
|---|---|---|---|
| `GET` | `/exports/export.php` | File download (`expenses.csv`) | Streams user's expenses with headers: `Date`, `Category`, `Amount`, `Note`. |

---

## Security & Engineering Highlights

- **SQL Injection Prevention**: All database queries strictly utilize **PDO Prepared Statements** with parameterized inputs (`$stmt->prepare()` and `$stmt->execute()`).
- **Cryptographic Password Security**: Passwords are never stored in plaintext; they are hashed using PHP's native `password_hash()` with **Bcrypt**.
- **Session Hijacking Mitigation**: Authenticated sessions trigger `session_regenerate_id(true)` upon successful login to prevent session fixation.
- **Access Control & Data Isolation**: Every SQL operation explicitly enforces `WHERE user_id = ?`, ensuring complete data privacy and isolation between multi-tenant accounts.
- **Input Sanitization & Output Encoding**: HTML output escapes user-provided variables via `htmlspecialchars()` to eliminate Cross-Site Scripting (XSS) risks.
- **Accurate Financial Arithmetic**: Monetary values are stored using MySQL's `DECIMAL(10, 2)` instead of floating-point numbers to avoid precision loss.

---

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT). Feel free to adapt and expand it for personal or educational portfolios!
