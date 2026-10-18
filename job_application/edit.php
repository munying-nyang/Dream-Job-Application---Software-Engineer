<?php

require 'db.php';

// Get the ID from the URL
$id = $_GET['id'];

// Fetch the specific record to pre-fill the form
$stmt = $pdo->prepare("SELECT * FROM job_applications WHERE id = ?");
$stmt->execute([$id]);
$app = $stmt->fetch();

if (!$app) {
    die("Application not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Application</title>
</head>
<body>

    <h2>Edit Application for <?= $app['first_name'] ?></h2>

    <form action="action.php" method="POST">
        <!-- Hidden input to pass the ID during update -->
        <input type="hidden" name="id" value="<?= $app['id'] ?>">
        
        <label>First Name:</label> <input type="text" name="first_name" value="<?= $app['first_name'] ?>" required><br><br>
        <label>Last Name:</label> <input type="text" name="last_name" value="<?= $app['last_name'] ?>" required><br><br>
        <label>Email:</label> <input type="email" name="email" value="<?= $app['email'] ?>" required><br><br>
        <label>Phone:</label> <input type="text" name="phone" value="<?= $app['phone'] ?>" required><br><br>
        <label>Position:</label> 
        <select name="position_applied">
            <option value="Software Engineer" <?= $app['position_applied'] == 'Software Engineer' ? 'selected' : '' ?>>Software Engineer</option>
            <option value="Network Admin" <?= $app['position_applied'] == 'Network Admin' ? 'selected' : '' ?>>Network Admin</option>
            <option value="Database Admin" <?= $app['position_applied'] == 'Database Admin' ? 'selected' : '' ?>>Database Admin</option>
        </select><br><br>
        <label>Years of Experience:</label> <input type="number" name="experience_years" value="<?= $app['experience_years'] ?>" required><br><br>
        <label>Expected Salary:</label> <input type="number" step="0.01" name="expected_salary" value="<?= $app['expected_salary'] ?>" required><br><br>
        
        <button type="submit" name="update">Update Application</button>
        <a href="index.php">Cancel</a>
    </form>

</body>
</html>