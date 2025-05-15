<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include('db.php');

// Set a success message after rejection
$successMessage = '';

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    // Sanitize and ensure the ID is an integer
    $id = intval($_GET['id']);

    // Check if the ID is valid
    if ($id > 0) {
        // Prepare the SQL query to update the application's status to 'rejected'
        $query = "UPDATE trip_applications SET status = 'rejected' WHERE id = :id";  // Changed table name here to 'trip_applications'
        $stmt = $pdo->prepare($query);

        // Execute the query with the application ID using array() syntax for older PHP versions
        if ($stmt->execute(array(':id' => $id))) { // Changed [] to array()
            // Set a success message in the session
            $successMessage = "Application with ID $id has been rejected successfully.";
        } else {
            // If the query fails, set an error message
            $_SESSION['error_message'] = "Failed to reject application with ID $id.";
        }
    } else {
        $_SESSION['error_message'] = "Invalid application ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .error-alert {
            padding: 15px;
            background-color: #f44336;
            color: white;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            text-align: center;
            margin-top: 20px;
        }

        .logout-btn a {
            color: #007bff;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Application Rejection</h2>

        <!-- Success Message -->
        <?php if ($successMessage): ?>
            <div class="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Error Message (if any) -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-alert">
                <?php echo $_SESSION['error_message']; ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <!-- Button to go back to the admin dashboard -->
        <a href="admin-dashboard.php" class="btn">Back to Dashboard</a>
    </div>

</body>
</html>
