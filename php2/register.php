<?php
$pageTitle  = 'Register - PHP Output 2';
$activePage = 'register';

$errors  = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname    = trim($_POST['fname']    ?? '');
    $lname    = trim($_POST['lname']    ?? '');
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm']  ?? '');

    if (empty($fname))
        $errors['fname'] = 'First name is required.';
    if (empty($lname))
        $errors['lname'] = 'Last name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Enter a valid email address.';
    if (strlen($password) < 6)
        $errors['password'] = 'Password must be at least 6 characters.';
    if ($password !== $confirm)
        $errors['confirm'] = 'Passwords do not match.';

    if (empty($errors))
        $success = true;
}

require 'includes/header.php';
?>

<div class="form-container">
    <div class="form-box">
        <h2>Register</h2>

        <?php if ($success): ?>
            <p class="success">Account registered successfully! <a href="login.php">Go to Login</a></p>
        <?php endif; ?>

        <form action="register.php" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>" placeholder="Enter First Name" />
                    <?php if (isset($errors['fname'])): ?><span class="err"><?php echo $errors['fname']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($_POST['lname'] ?? ''); ?>" placeholder="Enter Last Name" />
                    <?php if (isset($errors['lname'])): ?><span class="err"><?php echo $errors['lname']; ?></span><?php endif; ?>
                </td>
            </tr>
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
                <td>Confirm Password</td>
                <td>
                    <input type="password" name="confirm" placeholder="Confirm Password" />
                    <?php if (isset($errors['confirm'])): ?><span class="err"><?php echo $errors['confirm']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Register">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

<?php require 'includes/footer.php'; ?>