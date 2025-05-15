<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "college_trip";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize success and error message variables
$successMessage = '';
$errorMessage = '';

// Check if application ID is passed via GET parameter
if (isset($_GET['id'])) {
    $application_id = $_GET['id'];

    // Fetch the submitted application details from the database using the application ID
    $sql = "SELECT * FROM trip_applications WHERE id = $application_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch application data
        $application = $result->fetch_assoc();
        $successMessage = "Application submitted successfully! We will contact you soon.";
    } else {
        $errorMessage = "Application not found.";
    }
} else {
    $errorMessage = "Invalid request.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Success</title>
    <style>
       * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 15px;
}

.message-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    max-width: 600px;
    width: 100%;
    animation: fadeIn 0.7s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
    font-size: 30px;
}

.success-message,
.error-message {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 18px;
    text-align: center;
}

.success-message {
    background-color: #e1f8e6;
    color: #2e7d32;
    border-left: 6px solid #4caf50;
}

.error-message {
    background-color: #ffe6e6;
    color: #c62828;
    border-left: 6px solid #f44336;
}

.application-details {
    margin-top: 15px;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.application-details p {
    font-size: 16px;
    color: #333;
    margin: 8px 0;
    line-height: 1.5;
}

.application-details strong {
    font-weight: 600;
    color: #000;
}

a {
    display: inline-block;
    margin-top: 25px;
    padding: 12px 25px;
    background: linear-gradient(to right, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 50px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

a:hover {
    background: linear-gradient(to right, #5a67d8, #6b46c1);
    transform: translateY(-2px);
}

    </style>
</head>
<body>

<div class="message-container">
    <h1>Application Status</h1>

    <?php if ($successMessage): ?>
        <div class="success-message">
            <p><?php echo $successMessage; ?></p>
            <p><strong>Application Details:</strong></p>
            <div class="application-details">
                <p><strong>Name:</strong> <?php echo $application['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $application['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $application['phone']; ?></p>
                <p><strong>Course:</strong> <?php echo $application['course']; ?></p>
                <p><strong>Class:</strong> <?php echo $application['class']; ?></p>
                <p><strong>Destination:</strong> <?php echo $application['destination']; ?></p>
                <p><strong>Gender:</strong> <?php echo $application['gender']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $application['dob']; ?></p>
                <p><strong>Emergency Contact:</strong> <?php echo $application['emergency_contact']; ?></p>
                <p><strong>Address:</strong> <?php echo nl2br($application['address']); ?></p>
            </div>
        </div>
    <?php elseif ($errorMessage): ?>
        <div class="error-message">
            <p><?php echo $errorMessage; ?></p>
        </div>
    <?php endif; ?>
    <a href="logout.php">LOGOUT</a>
</div>

           

</body>
</html>
