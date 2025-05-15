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
    print($role);

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
    /* Body Styling with Blurred Background */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    /* Optional dark overlay for better contrast */
    body::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        z-index: 0;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
        font-size: 26px;
        letter-spacing: 1px;
    }

    .register-container {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.15);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        width: 100%;
        max-width: 400px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .row {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #fff;
    }

    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        color: #333;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
    }

    input:focus,
    select:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.7);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: rgba(58, 134, 255, 0.9);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.2s, background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: rgba(58, 134, 255, 1);
        transform: scale(1.03);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #eee;
    }

    .login-link a {
        color: #a5d8ff;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        color: #ffffff;
    }

    .error-message {
        color: #ff6b6b;
        background-color: rgba(255, 0, 0, 0.1);
        padding: 10px;
        border: 1px solid rgba(255, 0, 0, 0.3);
        border-radius: 6px;
        margin-bottom: 20px;
        text-align: center;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        50% { transform: translateX(5px); }
        75% { transform: translateX(-5px); }
        100% { transform: translateX(0); }
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
                    <option value="admin">admin</option>
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
