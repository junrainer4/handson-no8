<?php
$pageTitle  = 'Login - PHP Output 2';
$activePage = 'login';

$errors  = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Enter a valid email address.';
    if (empty($password))
        $errors['password'] = 'Password is required.';

    if (empty($errors))
        $success = true;
}

require 'includes/header.php';
?>

<div class="form-container">
    <div class="form-box">
        <h2>Login</h2>

        <?php if ($success): ?>
            <p class="success">Login successful!</p>
        <?php endif; ?>

        <form action="login.php" method="POST">
        <table>
            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="Enter Email" />
                    <?php if (isset($errors['email'])): ?><span class="err"><?php echo $errors['email']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Enter Password" />
                    <?php if (isset($errors['password'])): ?><span class="err"><?php echo $errors['password']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Login">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
        <p><a href="forgot_password.php">Forgot your password?</a></p>
        <p>No account yet? <a href="register.php">Register here</a></p>
    </div>
</div>

<?php require 'includes/footer.php'; ?>