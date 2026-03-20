<?php
$pageTitle  = 'Forgot Password - PHP Output 2';
$activePage = 'forgot';

$errors  = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Enter a valid email address.';

    if (empty($errors))
        $success = true;
}

require 'includes/header.php';
?>

<div class="form-container">
    <div class="form-box">
        <h2>Forgot Password</h2>
        <p>Enter your email and we will send you a reset link.</p>
        <br>

        <?php if ($success): ?>
            <p class="success">Reset link sent. Please check your inbox.</p>
        <?php endif; ?>

        <form action="forgot_password.php" method="POST">
        <table>
            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="Enter your Email" />
                    <?php if (isset($errors['email'])): ?><span class="err"><?php echo $errors['email']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Send Reset Link">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
        <p><a href="login.php">← Back to Login</a></p>
    </div>
</div>

<?php require 'includes/footer.php'; ?>