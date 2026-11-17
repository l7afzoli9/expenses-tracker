<?php
session_start();
require_once '../includes/db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error_code = $_GET['error'] ?? '';

$error_messages = [
    'empty'        => 'Please fill in all required fields.',
    'invalidEmail' => 'Please enter a valid email address.',
    'short'        => 'Password must be at least 8 characters long.',
    'invalidpsw'   => 'Password must contain uppercase, lowercase, numbers, and special characters.',
    'exists'       => 'An account with this email already exists.'
];

$error = $error_messages[$error_code] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $psw   = trim($_POST['psw'] ?? '');

    $pswPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';

    # ===================== Check Inputs Validation =====================
    if (empty($name) || empty($email) || empty($psw)) {
        $error_code = 'empty';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error_code = 'invalidEmail';
    } elseif (strlen($psw) < 8) {
        $error_code = 'short';
    } elseif (!preg_match($pswPattern, $psw)) {
        $error_code = 'invalidpsw';
    } else {
        # ===================== Check Existing Users =====================
        $sql  = 'select id from users where email = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error_code = 'exists';
        }
    }

    if (!empty($error_code)) {
        header('Location: register.php?error=' . urlencode($error_code));
        exit;
    } else {
        # ===================== Creating New User =====================
        $hpsw = password_hash($psw, PASSWORD_DEFAULT);

        $sql  = 'insert into users (name, email, password) values (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $hpsw]);

        header('Location: login.php?registered=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Portal</title>
    
    <!-- Premium Fonts matching the Landing Page -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-offwhite: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-blue: #2563eb;
            --accent-blue-hover: #1d4ed8;
            --border-soft: #e2e8f0;
            --font-serif: "Instrument Serif", Georgia, serif;
            --font-sans: "Inter", -apple-system, sans-serif;
            --shadow-lg: 0 20px 40px -15px rgba(0,0,0,0.1);
            --shadow-float: 0 30px 60px -20px rgba(0,50,150,0.25);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-main);
            /* Rich starry gradient from the landing page hero */
            background: linear-gradient(135deg, #4252e6 0%, #7663e6 35%, #b17ae6 65%, #f19fa5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            -webkit-font-smoothing: antialiased;
            position: relative;
        }

        /* Subtle starry overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                radial-gradient(2px 2px at 20px 30px, #ffffff, rgba(0,0,0,0)),
                radial-gradient(2px 2px at 40px 70px, #ffffff, rgba(0,0,0,0)),
                radial-gradient(2.5px 2.5px at 160px 120px, #ffffff, rgba(0,0,0,0));
            background-repeat: repeat;
            background-size: 200px 200px;
            opacity: 0.3;
            pointer-events: none;
            z-index: 0;
        }

        /* Premium Glassmorphism Container */
        .auth-wrapper {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            width: 100%;
            max-width: 420px;
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: var(--shadow-float);
            border: 1px solid rgba(255, 255, 255, 0.6);
            position: relative;
            z-index: 1;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--accent-blue);
            margin-bottom: 1rem;
            display: inline-block;
        }

        .brand-header h1 {
            font-family: var(--font-serif);
            font-size: 2.75rem;
            font-weight: 400;
            color: var(--text-main);
            line-height: 1.1;
        }

        .brand-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: 0.5rem;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f87171;
            text-align: center;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            background-color: var(--bg-offwhite);
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.2s ease;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background-color: #ffffff;
        }

        .btn-submit {
            width: 100%;
            background-color: var(--accent-blue);
            color: #ffffff;
            font-family: inherit;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.875rem;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.3);
        }

        .btn-submit:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .form-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .form-footer a {
            color: var(--text-main);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .form-footer a:hover {
            color: var(--accent-blue);
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        
        <div class="brand-header">
            <span class="brand-logo">✦ Portal</span>
            <h1>Create an account</h1>
            <p>Join beta and build your freelance toolkit</p>
        </div>

        <?php if ($error): ?>
            <div class="alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="name@example.com" required>
            </div>

            <div class="form-group">
                <label for="psw">Password</label>
                <input type="password" id="psw" name="psw" placeholder="Create a strong password" required>
            </div>

            <button type="submit" class="btn-submit">Register</button>
        </form>
        
        <div class="form-footer">
            Already have an account? <a href="login.php">Log in here</a>
        </div>

    </div>

</body>
</html>