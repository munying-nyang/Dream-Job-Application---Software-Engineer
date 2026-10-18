<?php

require 'db.php';

// INSERTION
if (isset($_POST['insert'])) {
    $sql = "INSERT INTO job_applications (first_name, last_name, email, phone, position_applied, experience_years, expected_salary) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['first_name'], $_POST['last_name'], $_POST['email'], 
        $_POST['phone'], $_POST['position_applied'], 
        $_POST['experience_years'], $_POST['expected_salary']
    ]);
    
    // Redirect back to the main page after inserting
    header("Location: index.php");
    exit();
}

// UPDATING
if (isset($_POST['update'])) {
    $sql = "UPDATE job_applications 
            SET first_name = ?, last_name = ?, email = ?, phone = ?, position_applied = ?, experience_years = ?, expected_salary = ? 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['first_name'], $_POST['last_name'], $_POST['email'], 
        $_POST['phone'], $_POST['position_applied'], 
        $_POST['experience_years'], $_POST['expected_salary'],
        $_POST['id']
    ]);
    
    // Redirect back to the main page after updating
    header("Location: index.php");
    exit();
}

// DELETION
if (isset($_GET['delete_id'])) {
    $sql = "DELETE FROM job_applications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['delete_id']]);
    
    // Redirect back to the main page after deleting
    header("Location: index.php");
    exit();
}
?>