<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName   = htmlspecialchars($_SESSION['user_name'] ?? 'User');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker — Smart Personal Finance & Budget Management</title>

    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=Caveat:wght@600&display=swap" rel="stylesheet">

    <style>
        /* --- CSS Variables --- */
        :root {
            --bg-light: #ffffff;
            --bg-offwhite: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-blue: #1d4ed8;
            --accent-blue-hover: #1e3a8a;
            --accent-blue-light: #eff6ff;
            --accent-green: #16a34a;
            --accent-red: #dc2626;
            --border-soft: rgba(0, 0, 0, 0.06);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 20px 40px -15px rgba(0, 0, 0, 0.07);
            --shadow-float: 0 30px 60px -20px rgba(0, 50, 150, 0.15);

            --font-serif: "Instrument Serif", Georgia, serif;
            --font-sans: "Inter", -apple-system, sans-serif;
            --font-hand: "Caveat", cursive;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-main);
            background-color: var(--bg-light);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        /* --- Hero Section --- */
        .hero {
            background: linear-gradient(180deg, #3742fa 0%, #5352ed 35%, #8c7ae6 68%, #f8a5c2 100%);
            position: relative;
            color: #ffffff;
            padding: 1.5rem 2rem 12rem 2rem;
            text-align: center;
            overflow: hidden;
        }

        /* Subtle CSS stars */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(2px 2px at 20px 30px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(2px 2px at 40px 70px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(2px 2px at 90px 40px, #ffffff, rgba(0, 0, 0, 0)),
                radial-gradient(2.5px 2.5px at 160px 120px, #ffffff, rgba(0, 0, 0, 0));
            background-repeat: repeat;
            background-size: 200px 200px;
            opacity: 0.4;
            pointer-events: none;
        }

        .nav {
            max-width: 1200px;
            margin: 0 auto 5rem auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .brand {
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            gap: 1.75rem;
            font-size: 0.95rem;
            font-weight: 500;
            align-items: center;
        }

        .nav-links a {
            opacity: 0.9;
        }

        .nav-links a:hover {
            opacity: 1;
        }

        .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.4rem 1.1rem;
            border-radius: 999px;
            opacity: 1;
        }

        .hero-content {
            max-width: 820px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-family: var(--font-serif);
            font-size: clamp(3rem, 6vw, 4.6rem);
            font-weight: 400;
            line-height: 1.05;
            letter-spacing: -0.01em;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .hero p {
            font-size: 1.15rem;
            font-weight: 400;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            max-width: 660px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.55;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* --- Buttons --- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: 999px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            text-decoration: none;
        }

        .btn-white {
            background-color: #ffffff;
            color: var(--accent-blue);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2);
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.28);
            transform: translateY(-2px);
        }

        .btn-blue {
            background-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.39);
        }

        .btn-blue:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        /* --- Mockup Container (Hero Overlap) --- */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-mockup-wrapper {
            margin-top: -8rem;
            margin-bottom: 7rem;
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
        }

        .mockup-window {
            width: 100%;
            max-width: 920px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow-float);
            border: 1px solid rgba(255, 255, 255, 0.6);
            overflow: hidden;
        }

        .mockup-header {
            background: linear-gradient(135deg, #a7b5ff 0%, #c4b5fd 50%, #fbcfe8 100%);
            height: 220px;
            position: relative;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .mockup-nav {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #1e1b4b;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .mockup-badge {
            background: rgba(255, 255, 255, 0.85);
            color: #065f46;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .mockup-body {
            background: #ffffff;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mockup-inner-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid var(--border-soft);
            max-width: 580px;
            margin-top: -110px;
            position: relative;
            box-shadow: var(--shadow-lg);
        }

        .mockup-inner-card h3 {
            font-family: var(--font-serif);
            font-size: 2.25rem;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .mini-progress {
            width: 100%;
            height: 8px;
            background: #f1f5f9;
            border-radius: 999px;
            margin: 16px 0 20px 0;
            overflow: hidden;
        }

        .mini-progress-fill {
            height: 100%;
            width: 65%;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            border-radius: 999px;
        }

        .mockup-stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .mockup-stat-box {
            background: var(--bg-offwhite);
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 12px;
            text-align: left;
        }

        .mockup-stat-box span {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .mockup-stat-box strong {
            font-size: 0.95rem;
            color: var(--text-main);
        }

        /* --- Typography Sections --- */
        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 3.5rem auto;
        }

        .section-header h2 {
            font-family: var(--font-serif);
            font-size: clamp(2.3rem, 4vw, 3.4rem);
            font-weight: 400;
            line-height: 1.15;
            letter-spacing: -0.01em;
            margin-bottom: 1.25rem;
            color: #0f172a;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.125rem;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        /* --- Feature Pills Layout --- */
        .pills-container {
            position: relative;
            max-width: 900px;
            margin: 0 auto 6rem auto;
        }

        .pill-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.85rem;
        }

        .pill-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #ffffff;
            padding: 0.6rem 1.25rem;
            border-radius: 999px;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            font-size: 0.925rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
            cursor: default;
        }

        .pill-item:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .pill-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* Hand-drawn annotation */
        .annotation {
            position: absolute;
            bottom: -48px;
            left: 50%;
            transform: translateX(10%);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .annotation-text {
            font-family: var(--font-hand);
            color: var(--accent-blue);
            font-size: 1.35rem;
            transform: rotate(-3deg);
            margin-top: 24px;
        }

        /* --- Feature Zig-Zag Rows --- */
        .feature-row {
            display: flex;
            align-items: center;
            gap: 5rem;
            margin: 7rem 0;
        }

        .feature-row.reverse {
            flex-direction: row-reverse;
        }

        .feature-text {
            flex: 1;
        }

        .feature-text h3 {
            font-family: var(--font-serif);
            font-size: 2.4rem;
            font-weight: 400;
            margin-bottom: 1.25rem;
            line-height: 1.15;
            color: #0f172a;
        }

        .feature-text p {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .feature-visual {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* UI Stack */
        .ui-stack {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 420px;
        }

        .ui-card-sm {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            padding: 1.15rem;
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            transition: transform 0.3s;
        }

        .ui-card-sm:hover {
            transform: translateX(6px);
        }

        .ui-card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bar-container {
            width: 100%;
            height: 6px;
            background: #f1f5f9;
            border-radius: 999px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 999px;
        }

        /* Notification Cards */
        .ui-notifications {
            position: relative;
            width: 100%;
            max-width: 400px;
            height: 290px;
        }

        .ui-notif-card {
            position: absolute;
            width: 100%;
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .ui-notif-card:nth-child(1) {
            top: 0;
            z-index: 3;
            transform: scale(1);
        }

        .ui-notif-card:nth-child(2) {
            top: 70px;
            z-index: 2;
            transform: scale(0.96);
            opacity: 0.9;
        }

        .ui-notif-card:nth-child(3) {
            top: 135px;
            z-index: 1;
            transform: scale(0.92);
            opacity: 0.75;
        }

        .badge-blue {
            background: var(--accent-blue);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: bold;
        }

        /* File Export Visual */
        .ui-export-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: var(--shadow-lg);
            position: relative;
        }

        .export-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.25rem;
        }

        .export-table-preview {
            width: 100%;
            font-size: 0.8rem;
            border-collapse: collapse;
            margin-bottom: 1.25rem;
        }

        .export-table-preview th {
            color: var(--text-muted);
            border-bottom: 1px solid #e2e8f0;
            padding: 6px 8px;
            text-align: left;
        }

        .export-table-preview td {
            padding: 6px 8px;
            border-bottom: 1px solid #f8fafc;
            color: var(--text-main);
        }

        /* Security Card */
        .ui-security-card {
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .security-item:last-child {
            border-bottom: none;
        }

        .sec-check {
            color: #16a34a;
            font-weight: bold;
        }

        /* --- Divider --- */
        hr {
            border: none;
            border-top: 1px dashed #cbd5e1;
            margin: 6rem auto;
            max-width: 800px;
        }

        /* --- 2x2 Grid --- */
        .grid-2x2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3.5rem 3rem;
            margin: 4rem 0 6rem 0;
        }

        .grid-card {
            background: transparent;
        }

        .grid-card h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.25rem 0 0.75rem 0;
            letter-spacing: -0.01em;
            color: #0f172a;
        }

        .grid-card p {
            color: var(--text-muted);
            font-size: 1.05rem;
            line-height: 1.6;
        }

        /* --- Footer / CTA Section --- */
        .cta-section {
            text-align: center;
            padding: 8rem 1.5rem 0 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .cta-icon {
            width: 52px;
            height: 52px;
            background: var(--accent-blue);
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem auto;
            font-size: 1.5rem;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
        }

        .cta-section h2 {
            font-family: var(--font-serif);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }

        .cta-section p {
            color: var(--text-muted);
            max-width: 580px;
            margin: 0 auto 2.5rem auto;
            font-size: 1.15rem;
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 6rem auto 3rem auto;
            font-size: 0.925rem;
            color: var(--text-muted);
            text-align: left;
            position: relative;
            z-index: 2;
        }

        .footer-links a {
            color: var(--text-main);
            font-weight: 500;
        }

        .footer-links a:hover {
            color: var(--accent-blue);
        }

        .footer-graphic {
            width: 100%;
            height: 250px;
            background: linear-gradient(180deg, transparent 0%, #1e293b 100%);
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            margin-top: -100px;
            position: relative;
            z-index: 1;
            transform: scaleX(1.5);
        }

        /* --- Responsive Adjustments --- */
        @media (max-width: 900px) {

            .feature-row,
            .feature-row.reverse {
                flex-direction: column;
                gap: 3rem;
                text-align: center;
            }

            .grid-2x2 {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 2rem;
                align-items: center;
                text-align: center;
            }

            .mockup-inner-card {
                margin-top: -60px;
            }

            .annotation {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Hero Header -->
    <section class="hero">
        <nav class="nav">
            <div class="brand">💸 Expense Tracker</div>
            <div class="nav-links">
                <?php if ($isLoggedIn): ?>
                    <span style="opacity: 0.9; font-weight: 500;">Hi, <?= $userName ?></span>
                    <a href="pages/dashboard.php" class="active">Dashboard</a>
                    <a href="pages/profile.php">Profile</a>
                    <a href="pages/logout.php">Logout</a>
                <?php else: ?>
                    <a href="pages/login.php" class="active">Login</a>
                    <a href="pages/register.php">Register</a>
                    <a href="#features">Features</a>
                <?php endif; ?>
            </div>
        </nav>

        <div class="hero-content">
            <h1>Master your money.<br>Track expenses, budget with confidence.</h1>
            <p>Gain complete visibility into your daily finances. Log transactions in seconds, set category budgets, spot spending leaks with real-time charts, and take full control without messy spreadsheets.</p>
            <div class="hero-actions">
                <?php if ($isLoggedIn): ?>
                    <a href="pages/dashboard.php" class="btn btn-white">Open Dashboard &rarr;</a>
                <?php else: ?>
                    <a href="pages/register.php" class="btn btn-white">Get Started Free</a>
                    <a href="pages/login.php" class="btn btn-glass">Sign In</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container">

        <!-- Overlapping Mockup -->
        <div class="hero-mockup-wrapper">
            <div class="mockup-window">
                <div class="mockup-header">
                    <div class="mockup-nav">✦ Monthly Overview — <?= date('F Y') ?></div>
                    <div class="mockup-badge">
                        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></span>
                        Budget on Track
                    </div>
                </div>
                <div class="mockup-body">
                    <div class="mockup-inner-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%;"></span>
                            <span style="font-size: 0.875rem; color: var(--text-muted); font-weight: 500;">Active Month Progress</span>
                        </div>
                        <h3>$1,640.50 <span style="font-size: 1.1rem; color: var(--text-muted); font-family: var(--font-sans); font-weight: 400;">/ $2,400.00 spent</span></h3>
                        
                        <div class="mini-progress">
                            <div class="mini-progress-fill"></div>
                        </div>

                        <div class="mockup-stats-row">
                            <div class="mockup-stat-box">
                                <span>Food</span>
                                <strong>$420.00</strong>
                            </div>
                            <div class="mockup-stat-box">
                                <span>Rent</span>
                                <strong>$850.00</strong>
                            </div>
                            <div class="mockup-stat-box">
                                <span>Transport</span>
                                <strong>$165.50</strong>
                            </div>
                        </div>

                        <a href="<?= $isLoggedIn ? 'pages/dashboard.php' : 'pages/login.php' ?>" class="btn btn-blue" style="width: 100%;">
                            <?= $isLoggedIn ? 'Go to Live Dashboard' : 'Start Tracking Expenses' ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <div class="section-header" id="features">
            <h2>Your finances deserve clarity, not complicated spreadsheets. Track fast, budget easily.</h2>
            <p>Expense Tracker provides an intuitive, distraction-free platform to monitor where your money goes. Record daily expenses with notes and dates, compare spending against set limits, and analyze your financial health at a glance.</p>
        </div>

        <!-- Feature Pills -->
        <div class="pills-container">
            <div class="pill-grid">
                <div class="pill-item">
                    <div class="pill-icon" style="background: #2563eb;">✦</div>
                    <span>Instant expense logging (CRUD)</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #16a34a;">$</div>
                    <span>Monthly category budgets</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #8b5cf6;">📈</div>
                    <span>Interactive Chart.js visual analytics</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #ef4444;">⚠️</div>
                    <span>Over-budget warning badges</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #0ea5e9;">📥</div>
                    <span>One-click CSV spreadsheet export</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #f59e0b;">🌓</div>
                    <span>Dark mode & glassmorphism UI</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #10b981;">🔒</div>
                    <span>Bcrypt password encryption</span>
                </div>
                <div class="pill-item" style="position: relative;">
                    <div class="pill-icon" style="background: #6366f1;">🛡️</div>
                    <span>Multi-tenant data isolation</span>
                </div>
            </div>

            <!-- Hand-drawn SVG Arrow & Text -->
            <div class="annotation">
                <svg width="40" height="40" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M45 45 C 30 45, 10 30, 5 10" stroke="#2563eb" stroke-width="2" fill="none" stroke-linecap="round" />
                    <path d="M5 10 L 15 12 M 5 10 L 8 20" stroke="#2563eb" stroke-width="2" fill="none" stroke-linecap="round" />
                </svg>
                <span class="annotation-text">Zero complex setup<br>needed</span>
            </div>
        </div>

        <hr>

        <!-- Feature Row 1: Budgets -->
        <div class="feature-row">
            <div class="feature-visual">
                <div class="ui-stack">
                    <div class="ui-card-sm">
                        <div class="ui-card-row">
                            <strong style="color: #0f172a;">Food & Dining</strong>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #16a34a;">$420 / $500</span>
                        </div>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 84%; background: #16a34a;"></div>
                        </div>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">$80 remaining</span>
                    </div>

                    <div class="ui-card-sm">
                        <div class="ui-card-row">
                            <strong style="color: #0f172a;">Transport</strong>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #2563eb;">$165 / $200</span>
                        </div>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 82.5%; background: #2563eb;"></div>
                        </div>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">$35 remaining</span>
                    </div>

                    <div class="ui-card-sm" style="border-left: 3px solid #dc2626;">
                        <div class="ui-card-row">
                            <strong style="color: #dc2626;">Entertainment</strong>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #dc2626;">$180 / $150</span>
                        </div>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: 100%; background: #dc2626;"></div>
                        </div>
                        <span style="font-size: 0.8rem; color: #dc2626; font-weight: 500;">⚠️ Over budget by $30.00</span>
                    </div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Set monthly category budgets and stop leaks before they grow</h3>
                <p>Define realistic monthly spending thresholds for each category. Our smart dashboard continuously computes your actual expenses against your targets, alerting you the moment a category goes over budget.</p>
            </div>
        </div>

        <!-- Feature Row 2: Analytics & Charts -->
        <div class="feature-row reverse">
            <div class="feature-visual">
                <div class="ui-notifications">
                    <div class="ui-notif-card" style="border: 2px solid var(--accent-blue-light);">
                        <div class="badge-blue">📊</div>
                        <div>
                            <strong style="display:block; font-size: 0.95rem;">Spent vs. Budget Visualizer</strong>
                            <span style="color: var(--accent-blue); font-weight: 600; font-size: 1.1rem;">Bar & Line Chart</span>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Dynamic monthly synchronization</div>
                        </div>
                    </div>
                    <div class="ui-notif-card">
                        <div style="width:32px; height:32px; background:#eff6ff; border-radius:6px; display:flex; align-items:center; justify-content:center; color:#2563eb; font-weight:bold;">🍩</div>
                        <div>
                            <strong style="font-size: 0.9rem; display:block;">Category Distribution</strong>
                            <span style="font-size: 0.8rem; color: var(--text-muted);">Rent 48% • Food 25% • Transport 12%</span>
                        </div>
                    </div>
                    <div class="ui-notif-card">
                        <div style="width:32px; height:32px; background:#f0fdf4; border-radius:6px; display:flex; align-items:center; justify-content:center; color:#16a34a; font-weight:bold;">✓</div>
                        <div>
                            <strong style="font-size: 0.9rem; display:block;">Total Savings This Month</strong>
                            <span style="font-size: 0.8rem; color: #16a34a; font-weight: 600;">+$759.50 below total budget</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Visualize your spending habits with live Chart.js analytics</h3>
                <p>Numbers alone don't give you the full story. Integrated dual charts present your financial trends at a glance: a mixed bar/line chart contrasting budget caps against actual spends, alongside an interactive breakdown pie chart.</p>
            </div>
        </div>

        <!-- Feature Row 3: CSV Export -->
        <div class="feature-row">
            <div class="feature-visual">
                <div class="ui-export-card">
                    <div class="export-header">
                        <div style="width:40px; height:40px; background:#e0f2fe; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.25rem;">📄</div>
                        <div>
                            <strong style="display:block; font-size:0.95rem;">expenses-export.csv</strong>
                            <span style="font-size:0.8rem; color:var(--text-muted);">Instant spreadsheet download</span>
                        </div>
                    </div>
                    <table class="export-table-preview">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2026-11-15</td>
                                <td>Groceries</td>
                                <td>$64.20</td>
                            </tr>
                            <tr>
                                <td>2026-11-14</td>
                                <td>Gas Station</td>
                                <td>$45.00</td>
                            </tr>
                            <tr>
                                <td>2026-11-12</td>
                                <td>Apartment Rent</td>
                                <td>$850.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="font-size: 0.8rem; color: #0284c7; font-weight: 600;">✓ Formatted for Excel, Sheets, & Accounting</div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Export complete financial logs with a single click</h3>
                <p>You always own your data. Whenever you need to file taxes, generate reports, or run deeper spreadsheets formulas, export your full transaction history cleanly into standard CSV format.</p>
            </div>
        </div>

        <!-- Feature Row 4: Security -->
        <div class="feature-row reverse">
            <div class="feature-visual">
                <div class="ui-security-card">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: #16a34a; color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Protected ✓</div>
                    <h5 style="font-size: 1rem; margin-bottom: 1rem; color:#0f172a;">Data Security Architecture</h5>
                    
                    <div class="security-item">
                        <span class="sec-check">✓</span>
                        <span>Bcrypt password hashing (cost factor 12)</span>
                    </div>
                    <div class="security-item">
                        <span class="sec-check">✓</span>
                        <span>PDO prepared queries (SQLi immune)</span>
                    </div>
                    <div class="security-item">
                        <span class="sec-check">✓</span>
                        <span>Strict user-level data isolation</span>
                    </div>
                    <div class="security-item">
                        <span class="sec-check">✓</span>
                        <span>Session fixation prevention</span>
                    </div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Engineered with privacy and rock-solid database integrity</h3>
                <p>Your financial records are strictly isolated to your user account. With prepared statements, parameterized queries, and bcrypt password hashing, your finances stay strictly confidential.</p>
            </div>
        </div>

        <hr>

        <!-- 2x2 Grid -->
        <div class="section-header" style="text-align: left; margin-left: 0;">
            <h2 style="margin-bottom: 1rem;">Everything you need to track spending,<br>nothing you don't.</h2>
            <p style="max-width: 700px;">Built for speed, clarity, and daily reliability. No heavy frameworks, no bloated dependencies, just clean PHP and vanilla JavaScript running on your own server.</p>
        </div>

        <div class="grid-2x2">
            <div class="grid-card">
                <div class="pill-icon" style="background: #2563eb; width: 36px; height: 36px; font-size: 1rem;">⚡</div>
                <h4>Lightning-Fast CRUD</h4>
                <p>Log an expense in seconds. Quick inline edit and delete actions keep your transaction history accurate and up-to-date effortlessly.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #16a34a; width: 36px; height: 36px; font-size: 1rem;">🎯</div>
                <h4>Category-Level Budgeting</h4>
                <p>Set specific monthly targets per category. Unique relational constraints ensure you never get duplicated budgets for the same period.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #dc2626; width: 36px; height: 36px; font-size: 1rem;">⚠️</div>
                <h4>Instant Spending Warnings</h4>
                <p>Clear visual alerts highlight whenever a category's total expenses cross the defined threshold, helping you adjust your spending in real time.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #8b5cf6; width: 36px; height: 36px; font-size: 1rem;">📱</div>
                <h4>Responsive & Dark Mode</h4>
                <p>Check and log your finances on your desktop, tablet, or phone with a tailored user interface and built-in theme support.</p>
            </div>
        </div>

    </main>

    <!-- CTA & Footer -->
    <footer class="cta-section">
        <div class="cta-icon">💸</div>
        <h2>Take control of your personal<br>finances today.</h2>
        <p>Start tracking your expenses and mastering your monthly budgets in a clean, private, and intuitive dashboard.</p>
        <?php if ($isLoggedIn): ?>
            <a href="pages/dashboard.php" class="btn btn-blue" style="margin-bottom: 2rem;">Go to Dashboard</a>
        <?php else: ?>
            <a href="pages/register.php" class="btn btn-blue" style="margin-bottom: 2rem;">Create Free Account</a>
        <?php endif; ?>

        <div class="footer-links">
            <div style="max-width: 500px; line-height: 1.6;">
                <strong>Expense Tracker</strong> — Full-stack personal finance application powered by PHP, MySQL, Bootstrap 5 & Chart.js.<br><br>
                Self-hosted, private, and secure.
            </div>
            <div style="display: flex; gap: 2.5rem; align-items: flex-start;">
                <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                    <a href="pages/dashboard.php">Dashboard</a>
                    <a href="pages/login.php">Login</a>
                    <a href="pages/register.php">Register</a>
                    <a href="pages/profile.php">Profile</a>
                </div>
            </div>
        </div>

        <div style="font-size: 0.8rem; color: var(--text-muted); position: relative; z-index: 2; text-align: left; max-width: 1000px; margin: 0 auto 2rem auto;">
            All rights reserved, <?= date('Y') ?> • Expense Tracker
        </div>

        <!-- Decorative Bottom Graphic -->
        <div class="footer-graphic"></div>
    </footer>

</body>

</html>
