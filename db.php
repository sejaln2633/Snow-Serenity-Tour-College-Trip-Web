<?php
// db.php - Database Connection

// Database connection parameters
$db_host = 'localhost';  // Database host, usually localhost
$db_name = 'college_trip';  // Your database name
$db_user = 'root';  // Your database username
$db_pass = 'root';  // Your database password

try {
    // Create a new PDO instance and set error mode to exception
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally, you can set the default character set to utf8
    $pdo->exec("SET NAMES 'utf8'");

} catch (PDOException $e) {
    // If the connection fails, display an error message
    die("Could not connect to the database $db_name :" . $e->getMessage());
}
?>
