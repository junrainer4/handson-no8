<?php
require 'db.php';

$conn->query("
    CREATE TABLE IF NOT EXISTS persons (
        id             INT AUTO_INCREMENT PRIMARY KEY,
        fname          VARCHAR(80)  NOT NULL,
        mname          VARCHAR(80),
        lname          VARCHAR(80)  NOT NULL,
        age            TINYINT UNSIGNED NOT NULL,
        gender         VARCHAR(30)  NOT NULL,
        email          VARCHAR(120) NOT NULL,
        address        VARCHAR(255) NOT NULL,
        contact_number VARCHAR(20)  NOT NULL,
        created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

$errors  = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function clean($val) {
        return htmlspecialchars(strip_tags(trim($val)));
    }

    $fname   = clean($_POST['fname']         ?? '');
    $mname   = clean($_POST['mname']         ?? '');
    $lname   = clean($_POST['lname']         ?? '');
    $age     = (int)($_POST['age']           ?? 0);
    $gender  = clean($_POST['gender']        ?? '');
    $email   = clean($_POST['email']         ?? '');
    $address = clean($_POST['address']       ?? '');
    $contact = clean($_POST['contactnumber'] ?? '');

    if (empty($fname)) $errors['fname'] = 'First name is required.';
    if (empty($lname)) $errors['lname'] = 'Last name is required.';
    if ($age < 1 || $age > 120) $errors['age'] = 'Enter a valid age (1-120).';

    $allowed_genders = ['Male', 'Female', 'Non-binary', 'Prefer not to say'];
    if (!in_array($gender, $allowed_genders)) $errors['gender'] = 'Please select a gender.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter a valid email address.';
    if (strlen($address) < 5) $errors['address'] = 'Address must be at least 5 characters.';
    if (!preg_match('/^(09|\+639)\d{9}$/', $contact)) $errors['contact'] = 'Enter a valid PH number (e.g. 09171234567).';

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO persons (fname, mname, lname, age, gender, email, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssissss', $fname, $mname, $lname, $age, $gender, $email, $address, $contact);
        if ($stmt->execute()) $success = true;
        $stmt->close();
    }
}

$persons = [];
$result  = $conn->query("SELECT * FROM persons ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) $persons[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Output 3 and 4</title>
</head>
<body>

<div class="container">
    <h1>PHP Output No. 3 and 4</h1>

    <fieldset>
        <legend>Register a Person</legend>
        <?php if ($success): ?><span class="success">Record saved successfully!</span><?php endif; ?>

        <form action="index.php" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>" placeholder="Enter First Name" />
                    <?php if (isset($errors['fname'])): ?><span class="err"><?php echo $errors['fname']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td><input type="text" name="mname" value="<?php echo htmlspecialchars($_POST['mname'] ?? ''); ?>" placeholder="Enter Middle Name" /></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($_POST['lname'] ?? ''); ?>" placeholder="Enter Last Name" />
                    <?php if (isset($errors['lname'])): ?><span class="err"><?php echo $errors['lname']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Age</td>
                <td>
                    <input type="number" name="age" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" placeholder="Enter Age" min="1" max="120" />
                    <?php if (isset($errors['age'])): ?><span class="err"><?php echo $errors['age']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender">
                        <option value="">-- Select Gender --</option>
                        <?php foreach (['Male', 'Female', 'Non-binary', 'Prefer not to say'] as $g): ?>
                            <option value="<?php echo $g; ?>" <?php echo (($_POST['gender'] ?? '') === $g) ? 'selected' : ''; ?>><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['gender'])): ?><span class="err"><?php echo $errors['gender']; ?></span><?php endif; ?>
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
                <td>Address</td>
                <td>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>" placeholder="Enter Address" />
                    <?php if (isset($errors['address'])): ?><span class="err"><?php echo $errors['address']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>
                    <input type="text" name="contactnumber" value="<?php echo htmlspecialchars($_POST['contactnumber'] ?? ''); ?>" placeholder="e.g. 09171234567" />
                    <?php if (isset($errors['contact'])): ?><span class="err"><?php echo $errors['contact']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit Data">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>

    <?php if (!empty($persons)): ?>
    <fieldset>
        <legend>List of Registered Persons</legend>
        <table class="list-table">
            <thead>
                <tr>
                    <th>#</th><th>First Name</th><th>Middle Name</th><th>Last Name</th>
                    <th>Age</th><th>Gender</th><th>Email</th><th>Address</th>
                    <th>Contact Number</th><th>Date Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($persons as $i => $p): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($p['fname']); ?></td>
                    <td><?php echo htmlspecialchars($p['mname']); ?></td>
                    <td><?php echo htmlspecialchars($p['lname']); ?></td>
                    <td><?php echo htmlspecialchars($p['age']); ?></td>
                    <td><?php echo htmlspecialchars($p['gender']); ?></td>
                    <td><?php echo htmlspecialchars($p['email']); ?></td>
                    <td><?php echo htmlspecialchars($p['address']); ?></td>
                    <td><?php echo htmlspecialchars($p['contact_number']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($p['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <?php endif; ?>
</div>

</body>
</html>