<?php
/**
 * CIEcured — Admin login.
 *
 * One shared admin account (see auth.php for the username/password).
 * On a correct login, marks the session as logged in and sends staff
 * on to the dashboard.
 */

require __DIR__ . '/auth.php';

// Already logged in? Skip straight to the dashboard instead of
// showing the form again.
if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = '';
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
    }

    $password = '';
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    }

    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Log In — CIEcured</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-wrap">
  <div class="login-card">
    <div class="login-logo">
      <span class="logo-mark">
        <img src="assets/img/logo.png" alt="CIEcured logo">
      </span>
      <span>
        CIEcured
        <small>Admin</small>
      </span>
    </div>

    <h1>Staff Log In</h1>
    <p class="login-sub">Sign in to view and respond to reports.</p>

    <?php if ($error !== ''): ?>
      <div class="login-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="login.php" class="login-form">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" autocomplete="username" autofocus required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" autocomplete="current-password" required>

      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>
</div>

</body>
</html>
