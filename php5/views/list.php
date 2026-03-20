<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Output 5 - Faculty List</title>
</head>
<body>

<div class="container">
    <h1>PHP Output No. 5</h1>
    <h2>Faculty List</h2>

    <?php if (isset($msg) && $msg): ?>
        <?php $msgs = ['created' => 'Faculty record added.', 'updated' => 'Faculty record updated.', 'deleted' => 'Faculty record deleted.']; ?>
        <span class="success"><?php echo $msgs[$msg] ?? ''; ?></span>
    <?php endif; ?>

    <p><a href="index.php?action=create">+ Add New Faculty</a></p>

    <?php if (empty($faculty)): ?>
        <fieldset>
            <legend>All Faculty</legend>
            <p>No faculty records found. <a href="index.php?action=create">Add one now.</a></p>
        </fieldset>
    <?php else: ?>
    <fieldset>
        <legend>All Faculty</legend>
        <table>
            <thead>
                <tr>
                    <th>#</th><th>First Name</th><th>Middle Name</th><th>Last Name</th>
                    <th>Age</th><th>Gender</th><th>Address</th><th>Position</th><th>Salary</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faculty as $i => $f): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($f['fname']); ?></td>
                    <td><?php echo htmlspecialchars($f['mname']); ?></td>
                    <td><?php echo htmlspecialchars($f['lname']); ?></td>
                    <td><?php echo htmlspecialchars($f['age']); ?></td>
                    <td><?php echo htmlspecialchars($f['gender']); ?></td>
                    <td><?php echo htmlspecialchars($f['address']); ?></td>
                    <td><?php echo htmlspecialchars($f['position']); ?></td>
                    <td>&#8369; <?php echo number_format($f['salary'], 2); ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?php echo $f['id']; ?>">Edit</a>
                        &nbsp;|&nbsp;
                        <form action="index.php?action=delete&id=<?php echo $f['id']; ?>" method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this record?')">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <?php endif; ?>
</div>

</body>
</html>