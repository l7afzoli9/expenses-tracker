<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal — Your beautiful freelance toolkit</title>

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
            /* Rich multi-stop gradient resembling the starry sunset */
            background: linear-gradient(180deg, #4252e6 0%, #7663e6 35%, #b17ae6 65%, #f19fa5 100%);
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
            margin: 0 auto 6rem auto;
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
            gap: 2rem;
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
            padding: 0.4rem 1rem;
            border-radius: 999px;
            opacity: 1;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-family: var(--font-serif);
            font-size: clamp(3rem, 6vw, 4.5rem);
            font-weight: 400;
            line-height: 1.05;
            letter-spacing: -0.01em;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .hero p {
            font-size: 1.125rem;
            font-weight: 400;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            max-width: 640px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
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
        }

        .btn-white {
            background-color: #ffffff;
            color: var(--accent-blue);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.15);
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
            margin-bottom: 8rem;
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
        }

        .mockup-window {
            width: 100%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: var(--shadow-float);
            border: 1px solid rgba(255, 255, 255, 0.6);
            overflow: hidden;
        }

        .mockup-header {
            background: linear-gradient(135deg, #a7b5ff 0%, #e2d1ff 50%, #ffd1e4 100%);
            height: 240px;
            position: relative;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
        }

        .mockup-nav {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
            display: inline-block;
            height: fit-content;
        }

        .mockup-body {
            background: #ffffff;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mockup-inner-card {
            background: var(--bg-offwhite);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid var(--border-soft);
            max-width: 500px;
            margin-top: -100px;
            /* Pulls card up into the header area */
            position: relative;
            background: #fff;
            box-shadow: var(--shadow-lg);
        }

        .mockup-inner-card h3 {
            font-family: var(--font-serif);
            font-size: 2.25rem;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        /* --- Typography Sections --- */
        .section-header {
            text-align: center;
            max-width: 780px;
            margin: 0 auto 4rem auto;
        }

        .section-header h2 {
            font-family: var(--font-serif);
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            font-weight: 400;
            line-height: 1.1;
            letter-spacing: -0.01em;
            margin-bottom: 1.5rem;
            color: #000;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.125rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        /* --- Feature Pills Layout --- */
        .pills-container {
            position: relative;
            max-width: 850px;
            margin: 0 auto 6rem auto;
        }

        .pill-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .pill-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            background: #ffffff;
            padding: 0.6rem 1.25rem;
            border-radius: 999px;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            font-size: 0.95rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
            cursor: default;
        }

        .pill-item:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .pill-icon {
            width: 26px;
            height: 26px;
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
            bottom: -45px;
            left: 50%;
            transform: translateX(-10%);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .annotation-text {
            font-family: var(--font-hand);
            color: var(--accent-blue);
            font-size: 1.35rem;
            transform: rotate(-4deg);
            margin-top: 25px;
        }

        /* --- Feature Zig-Zag Rows --- */
        .feature-row {
            display: flex;
            align-items: center;
            gap: 5rem;
            margin: 8rem 0;
        }

        .feature-row.reverse {
            flex-direction: row-reverse;
        }

        .feature-text {
            flex: 1;
        }

        .feature-text h3 {
            font-family: var(--font-serif);
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 1.25rem;
            line-height: 1.1;
            color: #000;
        }

        .feature-text p {
            color: var(--text-muted);
            font-size: 1.125rem;
            line-height: 1.7;
        }

        .feature-visual {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Specific Pure CSS UI Illustrations */

        /* 1. Project Type Stack */
        .ui-stack {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 400px;
        }

        .ui-card-sm {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            padding: 1.25rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: transform 0.3s;
        }

        .ui-card-sm:hover {
            transform: translateX(5px);
        }

        .ui-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--bg-offwhite);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* 2. Notification Cards */
        .ui-notifications {
            position: relative;
            width: 100%;
            max-width: 380px;
            height: 280px;
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
            top: 60px;
            z-index: 2;
            transform: scale(0.95);
            opacity: 0.8;
        }

        .ui-notif-card:nth-child(3) {
            top: 110px;
            z-index: 1;
            transform: scale(0.9);
            opacity: 0.5;
        }

        .ui-notif-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .badge-blue {
            background: var(--accent-blue);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        /* 3. Contract Signature */
        .ui-contract {
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .ui-contract::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.5;
            pointer-events: none;
        }

        .signature-box {
            background: #ffffff;
            border: 2px solid var(--accent-blue);
            border-radius: 8px;
            height: 80px;
            margin: 1.5rem 0;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signature-path {
            font-family: var(--font-hand);
            font-size: 2.5rem;
            color: #000;
        }

        /* --- Divider --- */
        hr {
            border: none;
            border-top: 1px dashed #cbd5e1;
            margin: 6rem auto;
            max-width: 800px;
        }

        /* --- Payments 2x2 Grid --- */
        .grid-2x2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4rem 3rem;
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
            width: 48px;
            height: 48px;
            background: var(--accent-blue);
            color: white;
            border-radius: 12px;
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
            color: #000;
        }

        .cta-section p {
            color: var(--text-muted);
            max-width: 540px;
            margin: 0 auto 2.5rem auto;
            font-size: 1.125rem;
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 6rem auto 3rem auto;
            font-size: 0.9rem;
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

        /* Simulated bottom landscape */
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
                gap: 3rem;
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
                /* Hide complex absolute positioning on small screens */
            }
        }
    </style>
</head>

<body>

    <!-- Hero Header -->
    <section class="hero">
        <nav class="nav">
            <div class="brand">✦ Portal</div>
            <div class="nav-links">
                <a href="pages/login.php" class="active">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="#">Contact</a>
            </div>
        </nav>

        <div class="hero-content">
            <h1>Your beautiful Expense Tracker.<br>From sending proposals to getting paid</h1>
            <p>Make your services stand out by presenting them with finesse. Forget emailing PDFs, late payments, or not hearing back. Use Portal to send branded digital proposals, collect project payments, run subscription-based services, transfer large deliverables, & more.</p>
            <button class="btn btn-white">Join beta</button>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container">

        <!-- Overlapping Mockup -->
        <div class="hero-mockup-wrapper">
            <div class="mockup-window">
                <div class="mockup-header">
                    <div class="mockup-nav">✦ All Projects</div>
                    <!-- Decorative robot/avatar placeholder -->
                    <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.4); border-radius: 12px; backdrop-filter: blur(4px);"></div>
                </div>
                <div class="mockup-body">
                    <div class="mockup-inner-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                            <span style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%;"></span>
                            <span style="font-size: 0.875rem; color: var(--text-muted); font-weight: 500;">Active Project Status</span>
                        </div>
                        <h3>0 &rarr; 1 Mobile App Design for a travel companion app</h3>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 24px; line-height: 1.6;">You have successfully paid the down payment and started the project. When the agreed work is completed by the freelancer and all the work is handed over, pay the remaining amount.</p>
                        <button class="btn btn-blue" style="width: 100%;">Pay 11,500€</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <div class="section-header">
            <h2>Your projects deserve a beautiful digital home, not another PDF. Present with finesse, impress, get paid fast.</h2>
            <p>Portal is here to give you a more efficient, modern, and personalized way to present your services and get paid. No more back and forth sending PDF proposals and invoices, or chasing clients for timely payments.</p>
            <p>Instead, Portal gives your project a beautiful digital home, branded to be truly yours. It lets you take care of the most important steps when it comes to freelancing, from sending proposals to collecting payments, running subscriptions, and sharing large deliverables.</p>
        </div>

        <!-- Feature Pills -->
        <div class="pills-container">
            <div class="pill-grid">
                <div class="pill-item">
                    <div class="pill-icon" style="background: #2563eb;">✦</div>
                    <span>Create stunning proposals</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #22c55e;">↓</div>
                    <span>Receive payments</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #f59e0b;">↻</div>
                    <span>Run subscriptions</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #f472b6;">K</div>
                    <span>Sell services with Klarna</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #22c55e;">$</div>
                    <span>Collect down payments & tips</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #3b82f6;">⚡</div>
                    <span>Track client activity</span>
                </div>
                <div class="pill-item">
                    <div class="pill-icon" style="background: #2563eb;">👤</div>
                    <span>Personalize your portals</span>
                </div>
                <div class="pill-item" style="position: relative;">
                    <div class="pill-icon" style="background: #22c55e;">✍</div>
                    <span>Sign freelance contracts</span>
                </div>
            </div>

            <!-- Hand-drawn SVG Arrow & Text -->
            <div class="annotation">
                <svg width="40" height="40" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M45 45 C 30 45, 10 30, 5 10" stroke="#2563eb" stroke-width="2" fill="none" stroke-linecap="round" />
                    <path d="M5 10 L 15 12 M 5 10 L 8 20" stroke="#2563eb" stroke-width="2" fill="none" stroke-linecap="round" />
                </svg>
                <span class="annotation-text">Latest feature<br>release</span>
            </div>
        </div>

        <hr>

        <!-- Section 2 Text -->
        <div class="section-header">
            <h2>A freelance toolkit you can use for any type of project, big or small. Create Portals, share hours, transfer assets, get paid, and never send another invoice again.</h2>
            <p>Portal gives you the tools to set up any project with breeze, including design subscriptions or retainers - rad as heck, I know! Naturally, large file sharing is built-in, so you can share large deliverables when the work is done.</p>
        </div>

        <!-- Alternating Rows -->
        <div class="feature-row">
            <div class="feature-visual">
                <div class="ui-stack">
                    <div class="ui-card-sm">
                        <div class="ui-icon-box">🥞</div>
                        <div>
                            <strong style="display:block; color:#000;">Fixed-price</strong>
                            <span style="font-size: 0.85rem; color: var(--text-muted);">For projects with a clear scope and low risk</span>
                        </div>
                    </div>
                    <div class="ui-card-sm">
                        <div class="ui-icon-box">💼</div>
                        <div>
                            <strong style="display:block; color:#000;">Subscription</strong>
                            <span style="font-size: 0.85rem; color: var(--text-muted);">Great fit for productized services</span>
                        </div>
                    </div>
                    <div class="ui-card-sm">
                        <div class="ui-icon-box">🚩</div>
                        <div>
                            <strong style="display:block; color:#000;">Milestone-based</strong>
                            <span style="font-size: 0.85rem; color: var(--text-muted);">For larger & complex projects</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Create Portals for a wide range of projects, from fixed-price and hourly to subscriptions</h3>
                <p>Whether it's a one-off gig, ongoing hourly work, milestone-driven project, or even subscription, Portal makes everything easy and joyful to manage for both you and your client.</p>
            </div>
        </div>

        <div class="feature-row reverse">
            <div class="feature-visual">
                <div class="ui-notifications">
                    <!-- Mockup layered cards -->
                    <div class="ui-notif-card" style="border: 2px solid var(--accent-blue-light);">
                        <div class="badge-blue">✦</div>
                        <div>
                            <strong style="display:block; font-size: 0.9rem;">New Payment Received</strong>
                            <span style="color: var(--accent-blue); font-weight: 600; font-size: 1.1rem;">+4,500€</span>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">10:02 AM</div>
                        </div>
                    </div>
                    <div class="ui-notif-card">
                        <div style="width:32px; height:32px; background:#e2e8f0; border-radius:6px;"></div>
                        <div>
                            <strong style="font-size: 0.9rem; display:block;">Landing page for Cakedesk</strong>
                            <span style="font-size: 0.8rem; color: var(--text-muted);">2,250€ • paid</span>
                        </div>
                    </div>
                    <div class="ui-notif-card">
                        <div style="width:32px; height:32px; background:#e2e8f0; border-radius:6px;"></div>
                        <div>
                            <strong style="font-size: 0.9rem; display:block;">iOS app design for Nugget</strong>
                            <span style="font-size: 0.8rem; color: var(--text-muted);">3,000€ • paid</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Run productized services or collect retainers on autopilot</h3>
                <p>Scale your business with productized services or retainers generating reoccurring revenue, while giving the client ease of mind and easy access to subscription management.</p>
            </div>
        </div>

        <div class="feature-row">
            <div class="feature-visual">
                <!-- Abstract representation of files/folders -->
                <div style="position: relative; width: 300px; height: 250px;">
                    <div style="position: absolute; top: 20px; left: 0; width: 140px; height: 180px; background: #e2e8f0; border-radius: 16px; transform: rotate(-10deg); box-shadow: var(--shadow-md);"></div>
                    <div style="position: absolute; top: 30px; right: 10px; width: 160px; height: 160px; background: #64748b; border-radius: 16px; transform: rotate(15deg); box-shadow: var(--shadow-md); display:flex; align-items:flex-end; padding: 1rem; color: white; font-weight: 600; font-size: 0.8rem;">Launch_vid.mp4<br>350.2 MB</div>
                    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 160px; height: 180px; background: linear-gradient(180deg, #60a5fa, #3b82f6); border-radius: 16px; box-shadow: var(--shadow-lg); border: 2px solid white; display:flex; align-items:flex-end; padding: 1rem; color: white; font-weight: 600; font-size: 0.8rem;">Cover.raw<br>50.5 MB</div>
                </div>
            </div>
            <div class="feature-text">
                <h3>Transfer large files as deliverables, before or after the client pays</h3>
                <p>Easily transfer up to 5GB as deliverables, with full control over access. Decide whether clients can download files before or after they've completed payment - it's entirely up to you.</p>
            </div>
        </div>

        <div class="feature-row reverse">
            <div class="feature-visual">
                <div class="ui-contract">
                    <div style="position: absolute; top: 1rem; right: 1rem; background: var(--accent-blue); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Web Design Default ✓</div>
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 1rem; line-height: 1.5;">All design drafts, concepts, and final deliverables created under this Agreement, whether selected or not, shall be considered Confidential Information...</p>
                    <div style="font-size: 0.8rem; font-weight: 600; margin-top: 1.5rem;">Client signature</div>
                    <div class="signature-box">
                        <span class="signature-path">John Doe</span>
                    </div>
                    <button class="btn btn-blue" style="width: 100%; padding: 0.75rem; font-size: 0.9rem;">Sign Contract</button>
                </div>
            </div>
            <div class="feature-text">
                <h3>Sign Freelance Contracts to make your projects legally binding</h3>
                <p>Portal auto-generates contracts for you and your clients to sign. Just set up your templates once - customize terms and other details, and Portal fills in the rest. No more dragging fields, clunky builders, or extra costs.</p>
            </div>
        </div>

        <hr>

        <!-- Payment Section -->
        <div class="section-header" style="text-align: left; margin-left: 0;">
            <h2 style="margin-bottom: 1rem;">Stop chasing clients for payments.<br>Instead, make paying dead simple.</h2>
            <p style="max-width: 700px;">Make client's life easier and get paid on time - it's a win-win situation. Reduce the risk of late payments by allowing your client to pay effortlessly within your Portal, offering 40+ payment methods.</p>
        </div>

        <div class="grid-2x2">
            <div class="grid-card">
                <div class="pill-icon" style="background: #2563eb; width: 36px; height: 36px; font-size: 1rem;">💳</div>
                <h4>Offer 40+ worldwide payment options</h4>
                <p>Let clients choose their preferred payment option, from major cards and bank transfers to wallets like ApplePay, GooglePay, PayPal and others.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #22c55e; width: 36px; height: 36px; font-size: 1rem;">$</div>
                <h4>Collect down payments & receive tips with ease</h4>
                <p>Secure your client's commitment by collecting customizable down payments and earn tips for going the extra mile.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #f472b6; width: 36px; height: 36px; font-size: 1rem;">K</div>
                <h4>Get paid now, let clients pay later with Klarna</h4>
                <p>Sell high-priced services to a larger client base and offer flexibility with buy now, pay later options, including Klarna, Afterpay or Affirm.</p>
            </div>

            <div class="grid-card">
                <div class="pill-icon" style="background: #f59e0b; width: 36px; height: 36px; font-size: 1rem;">↻</div>
                <h4>Receive reoccurring payments or retainers with ease</h4>
                <p>Easily set up subscriptions to run productized services or receive retainers, creating consistent income and a smooth experience for clients.</p>
            </div>
        </div>

    </main>

    <!-- CTA & Footer -->
    <footer class="cta-section">
        <div class="cta-icon">✦</div>
        <h2>Grow your freelance business<br>with Portal. Join beta now.</h2>
        <p>Join the beta program now to be one of the first ones to give Portal a spin. Present your next project with finesse, impress, get paid fast.</p>
        <button class="btn btn-blue" style="margin-bottom: 2rem;">Join beta</button>

        <div class="footer-links">
            <div style="max-width: 500px; line-height: 1.6;">
                Check out <a href="#">Droppable</a> - macOS app for large file sharing, designed for creatives. Learn about the stories and builders behind your favorite apps on <a href="#">App Stacks</a>.<br><br>
                With much love from Berlin, Germany.
            </div>
            <div style="display: flex; gap: 2rem; align-items: flex-start;">
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <a href="#">Contact</a>
                    <a href="#">Blog</a>
                    <a href="#">Legal</a>
                </div>
            </div>
        </div>

        <div style="font-size: 0.8rem; color: var(--text-muted); position: relative; z-index: 2; text-align: left; max-width: 1000px; margin: 0 auto 2rem auto;">
            All rights reserved, 2025
        </div>

        <!-- Decorative Bottom Graphic -->
        <div class="footer-graphic"></div>
    </footer>

</body>

</html>