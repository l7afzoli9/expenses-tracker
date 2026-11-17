<?php
require_once '../includes/auth_guard.php';

$user = htmlspecialchars($_SESSION['user_name'] ?? 'User');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Dashboard — Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-offwhite: #f6f7fb;
            --text-main: #16181d;
            --text-muted: #737887;
            --accent-blue: #5b5ce2;
            --accent-blue-hover: #4849c9;
            --accent-soft: rgba(91, 92, 226, 0.10);
            --accent-glow: rgba(91, 92, 226, 0.28);
            --border-soft: rgba(27, 31, 39, 0.08);
            --font-serif: "Instrument Serif", Georgia, serif;
            --font-sans: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            --shadow-float: 0 24px 70px rgba(29, 32, 43, 0.16);
            --shadow-soft: 0 10px 30px rgba(29, 32, 43, 0.08);
            --body-bg:
                radial-gradient(circle at 10% 8%, rgba(255, 255, 255, 0.85), transparent 30%),
                radial-gradient(circle at 92% 4%, rgba(124, 104, 255, 0.18), transparent 27%),
                radial-gradient(circle at 50% 95%, rgba(236, 167, 188, 0.14), transparent 30%),
                linear-gradient(145deg, #eef0ff 0%, #f8f8fc 44%, #f7eff9 100%);
            --card-bg: rgba(255, 255, 255, 0.82);
            --card-border: rgba(255, 255, 255, 0.9);
            --input-bg: rgba(247, 248, 252, 0.95);
            --table-th-color: #8a8f9e;
            --danger: #dd5c6f;
            --success: #2f9d79;
        }

        [data-theme="dark"] {
            --bg-offwhite: #171922;
            --text-main: #f3f4f8;
            --text-muted: #9b9eac;
            --accent-blue: #7d7ff2;
            --accent-blue-hover: #6b6de2;
            --accent-soft: rgba(125, 127, 242, 0.13);
            --accent-glow: rgba(125, 127, 242, 0.24);
            --border-soft: rgba(255, 255, 255, 0.09);
            --shadow-float: 0 28px 80px rgba(0, 0, 0, 0.30);
            --shadow-soft: 0 12px 30px rgba(0, 0, 0, 0.20);
            --body-bg:
                radial-gradient(circle at 8% 0%, rgba(98, 90, 205, 0.22), transparent 28%),
                radial-gradient(circle at 90% 8%, rgba(187, 103, 169, 0.14), transparent 28%),
                linear-gradient(145deg, #12141c 0%, #191a25 48%, #211821 100%);
            --card-bg: rgba(25, 27, 37, 0.78);
            --card-border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(15, 17, 24, 0.76);
            --table-th-color: #9da0ae;
            --danger: #ff7b8c;
            --success: #4bc294;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-main);
            background: var(--body-bg);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            position: relative;
            padding-bottom: 4rem;
            transition: background 0.35s ease, color 0.25s ease;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 18% 18%, rgba(255, 255, 255, 0.55) 0 1px, transparent 1px),
                radial-gradient(circle at 76% 31%, rgba(255, 255, 255, 0.4) 0 1px, transparent 1px);
            background-size: 120px 120px, 170px 170px;
            opacity: 0.22;
            pointer-events: none;
            z-index: -1;
        }

        body.container {
            max-width: 1180px;
        }

        #nav {
            padding: 0.6rem 0 1rem;
        }

        .brand-logo {
            font-weight: 700;
            font-size: 1.08rem;
            letter-spacing: -0.03em;
            color: #ffffff;
            text-decoration: none;
            text-shadow: 0 5px 20px rgba(38, 35, 76, 0.22);
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .brand-logo::first-letter {
            font-size: 1.25em;
        }

        .dashboard-title {
            font-family: var(--font-serif);
            font-size: clamp(2.8rem, 5vw, 4.4rem);
            line-height: 0.95;
            letter-spacing: -0.035em;
            color: #ffffff;
            margin: 0 0 1.8rem;
            text-shadow: 0 12px 35px rgba(39, 35, 80, 0.20);
            max-width: 700px;
        }

        .nav {
            gap: 0.15rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.78) !important;
            font-weight: 500;
            font-size: 0.86rem;
            padding: 0.5rem 0.75rem !important;
            border-radius: 999px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08);
        }

        .nav-link.disabled {
            color: rgba(255, 255, 255, 0.92) !important;
            opacity: 1;
        }

        .nav-link.text-danger {
            color: #ff9ca8 !important;
        }

        .nav-link.text-danger:hover {
            color: #ffffff !important;
            background: rgba(255, 119, 135, 0.12);
        }

        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.92);
            font-weight: 500;
            cursor: pointer;
            padding: 0.52rem 0.8rem;
            border-radius: 999px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            backdrop-filter: blur(14px);
            box-shadow: 0 8px 22px rgba(31, 29, 67, 0.09);
        }

        .theme-toggle-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.16);
            transform: translateY(-1px);
        }

        .portal-card {
            position: relative;
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 26px;
            padding: 1.45rem;
            box-shadow: var(--shadow-float);
            border: 1px solid var(--card-border);
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.3s ease, border-color 0.3s ease;
            overflow: hidden;
        }

        .portal-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.9), transparent);
            opacity: 0.85;
            pointer-events: none;
        }

        .portal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 75px rgba(29, 32, 43, 0.18);
        }

        [data-theme="dark"] .portal-card:hover {
            box-shadow: 0 30px 75px rgba(0, 0, 0, 0.28);
        }

        .charts-wrapper {
            align-items: stretch;
        }

        .charts-wrapper>.portal-card {
            min-height: 350px;
        }

        .portal-card h5 {
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .form-control,
        .form-select {
            padding: 0.78rem 0.95rem;
            min-height: 46px;
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            background-color: var(--input-bg);
            font-size: 0.93rem;
            color: var(--text-main);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, transform 0.2s ease;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #a2a6b2;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: rgba(91, 92, 226, 0.25);
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px var(--accent-soft);
            background-color: var(--input-bg);
            color: var(--text-main);
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .btn {
            font-weight: 600;
            border-radius: 12px;
            padding: 0.62rem 1rem;
            transition: all 0.22s ease;
            font-size: 0.84rem;
            letter-spacing: -0.01em;
        }

        .btn:active {
            transform: translateY(1px) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-blue), #7a64dc);
            border: none;
            box-shadow: 0 10px 24px var(--accent-glow);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--accent-blue-hover), #6854c7);
            transform: translateY(-2px);
            box-shadow: 0 14px 30px var(--accent-glow);
            color: #ffffff;
        }

        .btn-outline-secondary {
            border: 1px solid var(--border-soft);
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(10px);
        }

        [data-theme="dark"] .btn-outline-secondary {
            background: rgba(255, 255, 255, 0.04);
        }

        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.80);
            color: var(--text-main);
            border-color: rgba(91, 92, 226, 0.18);
            transform: translateY(-1px);
        }

        .table-responsive {
            border-radius: 18px;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-main);
            margin-bottom: 0;
            table-layout: fixed;
            width: 100%;
        }

        .table thead th {
            font-size: 0.70rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: var(--table-th-color);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.9rem 0.65rem 0.8rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: background-color 0.18s ease;
        }

        .table tbody tr:hover {
            background: rgba(91, 92, 226, 0.045);
        }

        .table tbody td {
            vertical-align: middle;
            border-bottom: 1px solid var(--border-soft);
            padding: 1rem 0.65rem;
            color: var(--text-main);
            font-size: 0.91rem;
            word-break: break-word;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 18%;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 20%;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 22%;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 15%;
            text-align: right;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 25%;
            text-align: right;
        }

        .modal-backdrop.show {
            opacity: 0.55;
        }

        .modal-content {
            background: var(--card-bg);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border-radius: 24px;
            border: 1px solid var(--card-border);
            box-shadow: 0 35px 100px rgba(20, 22, 31, 0.28);
            color: var(--text-main);
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid var(--border-soft);
            padding: 1.4rem 1.5rem 1.05rem;
        }

        .modal-title {
            font-family: var(--font-serif);
            font-size: 1.95rem;
            line-height: 1;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .btn-close {
            filter: var(--btn-close-filter, none);
            opacity: 0.65;
        }

        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        #alerts {
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            body.container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            #nav {
                align-items: flex-start !important;
                gap: 1rem;
                flex-wrap: wrap;
            }

            #nav>div {
                width: 100%;
                justify-content: space-between;
            }

            .dashboard-title {
                font-size: 3rem;
                margin-bottom: 1.35rem;
            }

            .portal-card {
                border-radius: 20px;
                padding: 1.1rem;
            }

            .charts-wrapper>.portal-card {
                min-height: 320px !important;
            }

            .table {
                min-width: 690px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-title {
                font-size: 2.55rem;
            }

            .nav {
                padding-left: 0.2rem;
                padding-right: 0.2rem;
            }

            .theme-toggle-btn {
                padding: 0.48rem 0.68rem;
            }
        }
    </style>
</head>

<body class="container py-4">

    <!-- Top Navigation -->
    <div id="nav" class="mb-4 d-flex justify-content-between align-items-center">
        <a href="#" class="brand-logo">✦ Portal</a>
        <div class="d-flex align-items-center gap-2">
            <!-- Dark/Light Mode Toggle Button -->
            <button class="theme-toggle-btn" id="themeToggle" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                <span id="themeIcon">🌙</span> <span class="d-none d-sm-inline" id="themeText">Dark</span>
            </button>
            <ul class="nav justify-content-end align-items-center bg-dark bg-opacity-10 rounded-pill px-3 py-1 mb-0" style="backdrop-filter: blur(10px);">
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Hi, <?= $user ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="dashboard-title">Financial Overview</h1>

    <div id="alerts" class="mb-3"></div>

    <!-- Charts Section -->
    <div class="charts-wrapper d-flex gap-4 flex-wrap mb-4">
        <div class="portal-card flex-grow-1" style="position: relative; height: 350px; min-width: 300px;">
            <h5 class="mb-3" style="font-weight: 600; font-size: 1.1rem;">Budget vs Expenses</h5>
            <div style="position: relative; height: 260px; width: 100%;">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>

        <div class="portal-card" style="position: relative; height: 350px; width: 100%; max-width: 400px; flex-grow: 1;">
            <h5 class="mb-3" style="font-weight: 600; font-size: 1.1rem;">Spending by Category</h5>
            <div style="position: relative; height: 260px; width: 100%;">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Expenses Table Section -->
    <div class="portal-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h5 class="mb-0" style="font-weight: 600; font-size: 1.25rem;">Recent Expenses</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" onclick="openAddModal()">
                    + Log New Expense
                </button>
                <a href="../exports/export.php" class="btn btn-outline-secondary btn-sm">
                    Export CSV
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="expenses-table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Category</th>
                        <th scope="col">Note</th>
                        <th scope="col" class="text-end">Amount</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody id="expenses-body">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Budget Form Section -->
    <div class="portal-card mb-4">
        <h5 class="mb-3" style="font-weight: 600; font-size: 1.25rem;">Set Monthly Budget</h5>
        <form id="budgetForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="budget_category" class="form-label">Category</label>
                    <select name="category_id" id="budget_category" class="form-select categories" required></select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" name="amount" placeholder="0.00" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <select class="form-select" name="month" id="budget_month" required>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <input type="number" min="2020" max="2099" class="form-control" name="year" id="budget_year" placeholder="YYYY" required>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary">Save Budget</button>
            </div>
        </form>
    </div>

    <!-- Expense Modal -->
    <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="expenseModalLabel">Log New Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="expenseForm">
                        <input type="hidden" name="id" id="expense_id">

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control" placeholder="0.00" required>
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Category</label>
                            <select name="category_id" id="categories" class="form-select categories" required></select>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note (Optional)</label>
                            <input type="text" name="note" id="note" class="form-control" placeholder="What was this for?">
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-2">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Save Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/charts.js"></script>
    <script src="../assets/js/categories.js"></script>
    <script src="../assets/js/expenses.js"></script>
    <script src="../assets/js/budgets.js"></script>             
    <script>
        const expenseModal = new bootstrap.Modal(document.getElementById('expenseModal'));

        // --- Dark Mode State Management ---
        const htmlElement = document.documentElement;
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');

        const savedTheme = localStorage.getItem('portal_theme') || 'light';
        if (savedTheme === 'dark') {
            htmlElement.setAttribute('data-theme', 'dark');
            themeIcon.textContent = '☀️';
            themeText.textContent = 'Light';
        }

        function toggleTheme() {
            const currentTheme = htmlElement.getAttribute('data-theme');
            if (currentTheme === 'dark') {
                htmlElement.removeAttribute('data-theme');
                localStorage.setItem('portal_theme', 'light');
                themeIcon.textContent = '🌙';
                themeText.textContent = 'Dark';
            } else {
                htmlElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('portal_theme', 'dark');
                themeIcon.textContent = '☀️';
                themeText.textContent = 'Light';
            }
        }

        function openAddModal() {
            const formElement = document.getElementById("expenseForm");
            formElement.reset();
            delete formElement.dataset.editId;

            document.getElementById("expense_id").value = "";
            document.getElementById("expenseModalLabel").textContent = "Log New Expense";
            document.getElementById("modalSubmitBtn").textContent = "Save Expense";
            document.getElementById("date").valueAsDate = new Date();

            if (typeof expenseModal !== "undefined") {
                expenseModal.show();
            }
        }

        function initBudgetDefaults() {
            const today = new Date();
            const currentMonth = today.getMonth() + 1;
            const currentYear = today.getFullYear();

            const monthSelect = document.getElementById('budget_month');
            const yearInput = document.getElementById('budget_year');

            if (monthSelect) monthSelect.value = currentMonth;
            if (yearInput) yearInput.value = currentYear;
        }

        initBudgetDefaults();
        loadExpenses();
        loadCategories();
    </script>
</body>

</html>