<?php
// register.php - Account Creation

session_start();
include('db.php'); // Make sure this file connects to your database properly

$error_message = ''; // Variable to hold error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Manually generate a salt (since random_bytes is not available)
        // We will use uniqid() and mt_rand() to create a salt
        $salt = '$2a$10$' . substr(uniqid(mt_rand(), true), 0, 22);

        // Hash the password using crypt() function with the generated salt
        $hashed_password = crypt($password, $salt);

        // Check if the email already exists in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if ($user) {
            $error_message = "Email is already taken!";
        } else {
            // Insert the new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
            $stmt->execute(array($email, $hashed_password, $role));

            // Redirect to login page after successful registration
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .row {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Create Account</h2>

        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="row">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="row">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                </select>
            </div>

            <div class="row">
                <button type="submit">Create Account</button>
            </div>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

</body>
</html>
