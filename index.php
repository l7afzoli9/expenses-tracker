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
    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=Caveat:wght@600&display=swap" rel="stylesheet">
    <link rel>
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
