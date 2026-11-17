<?php
require_once '../includes/auth_guard.php';
require_once '../includes/db.php';

$user_id = $_SESSION['user_id'];
$success = '';
$error   = '';

// ── Handle password change form ───────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_psw'];
    $new_psw = $_POST['new_psw'];
    $confirm = $_POST['confirm_psw'];

    // Fetch current hash
    $stmt = $pdo->prepare('select password from users where id = ?');
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!password_verify($current, $user['password'])) {
        $error = 'Current password is incorrect.';
    } elseif ($new_psw !== $confirm) {
        $error = 'New passwords do not match.';
    } elseif (strlen($new_psw) < 8) {
        $error = 'New password must be at least 8 characters.';
    } else {
        $hash = password_hash($new_psw, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $pdo->prepare('update users set password = ? where id = ?');
        $stmt->execute([$hash, $user_id]);
        $success = 'Password updated successfully.';
    }
}

// ── Fetch user info to display ────────────────────────────────────────────────
$stmt = $pdo->prepare('select name, email from users where id = ?');
$stmt->execute([$user_id]);
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">💸 Expense Tracker</span>
    <div class="d-flex gap-2">
        <a href="../pages/dashboard.php" class="btn btn-outline-light btn-sm">Dashboard</a>
        <a href="../pages/logout.php"    class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container py-4" style="max-width: 520px">

    <!-- User info -->
    <div class="card p-4 mb-4">
        <h5 class="mb-3">Account Info</h5>
        <p class="mb-1"><strong>Name:</strong> <?= htmlspecialchars($info['name']) ?></p>
        <p class="mb-0"><strong>Email:</strong> <?= htmlspecialchars($info['email']) ?></p>
    </div>

    <!-- Change password -->
    <div class="card p-4">
        <h5 class="mb-3">Change Password</h5>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_psw" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="new_psw" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_psw" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Password</button>
        </form>
    </div>

</div>
</body>
</html>