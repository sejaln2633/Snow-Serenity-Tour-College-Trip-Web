<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include the database connection file
include('db.php');

// Check if an ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Update the status of the application to 'approved'
    $query = "UPDATE trip_applications SET status = 'approved' WHERE id = :id";
    $stmt = $pdo->prepare($query);

    // Execute the query with the correct parameter format
    $stmt->execute(array('id' => $id));

    // Set a success message and redirect back to the dashboard
    $_SESSION['success_message'] = "Application approved successfully!";
    header("Location: admin-dashboard.php");
    exit;
} else {
    // If no ID is provided or it's invalid, redirect to the dashboard with an error
    $_SESSION['error_message'] = "Invalid application ID.";
    header("Location: admin-dashboard.php");
    exit;
}
?>
