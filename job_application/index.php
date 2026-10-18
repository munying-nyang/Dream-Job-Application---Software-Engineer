<?php

require 'db.php';

$stmt = $pdo->query("SELECT * FROM job_applications ORDER BY id DESC");
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Application System</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-group { margin-bottom: 10px; }
        input, select { padding: 5px; width: 200px; }
    </style>
</head>
<body>

    <h2>Dream Job Application Form (Software Engineer)</h2>

    <!-- INSERTION FORM -->
    <form action="action.php" method="POST">
        <div class="form-group"><label>First Name:</label> <input type="text" name="first_name" required></div>
        <div class="form-group"><label>Last Name:</label> <input type="text" name="last_name" required></div>
        <div class="form-group"><label>Email:</label> <input type="email" name="email" required></div>
        <div class="form-group"><label>Phone:</label> <input type="text" name="phone" required></div>
        <div class="form-group">
            <label>Position:</label> 
            <select name="position_applied">
                <option value="Software Engineer">Software Engineer</option>
                <option value="Network Admin">Network Admin</option>
                <option value="Database Admin">Database Admin</option>
            </select>
        </div>
        <div class="form-group"><label>Years of Experience:</label> <input type="number" name="experience_years" required></div>
        <div class="form-group"><label>Expected Salary:</label> <input type="number" step="0.01" name="expected_salary" required></div>
        <button type="submit" name="insert">Submit Application</button>
    </form>

    <hr>

    <!-- TABLE TO DISPLAY RECORDS -->
    <h3>Submitted Applications</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Experience (Yrs)</th>
            <th>Expected Salary</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($applications as $app): ?>
        <tr>
            <td><?= $app['id'] ?></td>
            <td><?= $app['first_name'] . ' ' . $app['last_name'] ?></td>
            <td><?= $app['email'] ?></td>
            <td><?= $app['phone'] ?></td>
            <td><?= $app['position_applied'] ?></td>
            <td><?= $app['experience_years'] ?></td>
            <td><?= $app['expected_salary'] ?></td>
            <td><?= $app['date_added'] ?></td>
            <td>
                <!-- UPDATE LINK -->
                <a href="edit.php?id=<?= $app['id'] ?>">Edit</a> | 
                <!-- DELETE LINK -->
                <a href="action.php?delete_id=<?= $app['id'] ?>" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>