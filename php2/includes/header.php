<?php
$pageTitle  = $pageTitle  ?? 'PHP Output 2';
$activePage = $activePage ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
</head>
<body>

<nav>
    <a href="index.php"           class="<?php echo $activePage === 'home'     ? 'active' : ''; ?>">Home</a>
    <a href="register.php"        class="<?php echo $activePage === 'register' ? 'active' : ''; ?>">Register</a>
    <a href="login.php"           class="<?php echo $activePage === 'login'    ? 'active' : ''; ?>">Login</a>
    <a href="forgot_password.php" class="<?php echo $activePage === 'forgot'   ? 'active' : ''; ?>">Forgot Password</a>
</nav>