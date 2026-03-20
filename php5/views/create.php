<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Output 5 - Add Faculty</title>
</head>
<body>

<div class="container">
    <h1>PHP Output No. 5</h1>

    <fieldset>
        <legend>Add New Faculty</legend>
        <form action="index.php?action=create" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($data['fname'] ?? ''); ?>" placeholder="Enter First Name" />
                    <?php if (isset($errors['fname'])): ?><span class="err"><?php echo $errors['fname']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td><input type="text" name="mname" value="<?php echo htmlspecialchars($data['mname'] ?? ''); ?>" placeholder="Enter Middle Name" /></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($data['lname'] ?? ''); ?>" placeholder="Enter Last Name" />
                    <?php if (isset($errors['lname'])): ?><span class="err"><?php echo $errors['lname']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Age</td>
                <td>
                    <input type="number" name="age" value="<?php echo htmlspecialchars($data['age'] ?? ''); ?>" placeholder="Enter Age" min="18" max="80" />
                    <?php if (isset($errors['age'])): ?><span class="err"><?php echo $errors['age']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender">
                        <option value="">Select Gender</option>
                        <?php foreach (['Male', 'Female'] as $g): ?>
                            <option value="<?php echo $g; ?>" <?php echo (($data['gender'] ?? '') === $g) ? 'selected' : ''; ?>><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['gender'])): ?><span class="err"><?php echo $errors['gender']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($data['address'] ?? ''); ?>" placeholder="Enter Address" />
                    <?php if (isset($errors['address'])): ?><span class="err"><?php echo $errors['address']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Position</td>
                <td>
                    <input type="text" name="position" value="<?php echo htmlspecialchars($data['position'] ?? ''); ?>" placeholder="e.g. Instructor I" />
                    <?php if (isset($errors['position'])): ?><span class="err"><?php echo $errors['position']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Salary</td>
                <td>
                    <input type="number" name="salary" step="0.01" min="0" value="<?php echo htmlspecialchars($data['salary'] ?? ''); ?>" placeholder="e.g. 25000.00" />
                    <?php if (isset($errors['salary'])): ?><span class="err"><?php echo $errors['salary']; ?></span><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Save Faculty">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>

    <a href="index.php">← Back to Faculty List</a>
</div>

</body>
</html>