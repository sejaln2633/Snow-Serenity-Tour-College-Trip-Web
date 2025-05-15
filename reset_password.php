<?php
// reset_password.php - Password Reset Form
session_start();
include('db.php');

$error_message = '';
$success_message = '';
$token = '';  // Initialize the $token variable

// Check if the token exists in the URL parameters
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the password_resets table and is not expired
    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expiry > NOW()");
    $stmt->execute(array($token));
    $reset_request = $stmt->fetch();

    if ($reset_request) {
        // Token found and is not expired, process the password change
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the new password from the form
            $new_password = $_POST['new_password'];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the users table
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->execute(array($hashed_password, $reset_request['email']));

            // Delete the token from the password_resets table (used once)
            $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->execute(array($token));

            $success_message = "Your password has been successfully reset!";
        }
    } else {
        // Invalid or expired token
        $error_message = "Invalid or expired token!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Reset some default styles */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #71b7e6, #9b59b6);
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #444;
}

.login-container {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 420px;
    animation: fadeInUp 0.6s ease forwards;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    color: #6a1b9a;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.error-message,
.success-message {
    font-size: 14px;
    padding: 12px 15px;
    border-radius: 6px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 600;
    letter-spacing: 0.5px;
    animation: fadeIn 0.8s ease forwards;
}

.error-message {
    background-color: #fce4e4;
    color: #d32f2f;
    border: 1px solid #d32f2f;
}

.success-message {
    background-color: #e8f5e9;
    color: #388e3c;
    border: 1px solid #388e3c;
}

.row {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #6a1b9a;
    letter-spacing: 0.5px;
}

input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

input[type="password"]:focus {
    border-color: #9b59b6;
    outline: none;
    box-shadow: 0 0 8px rgba(155, 89, 182, 0.6);
}

button[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(45deg, #9b59b6, #8e44ad);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 1px;
    box-shadow: 0 6px 15px rgba(155, 89, 182, 0.5);
    transition: background 0.4s ease;
    user-select: none;
}

button[type="submit"]:hover {
    background: linear-gradient(45deg, #8e44ad, #7d3c98);
}

.back-to-login {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
}

.back-to-login a {
    color: #6a1b9a;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.back-to-login a:hover {
    color: #9b59b6;
    text-decoration: underline;
}

/* Animations */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Responsive */
@media (max-width: 480px) {
    .login-container {
        padding: 25px 30px;
        width: 90%;
    }
    button[type="submit"] {
        font-size: 16px;
        padding: 12px;
    }
}

    </style>
</head>
<body>

    <div class="login-container">
        <h2>Reset Password</h2>

        <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <!-- Use the token in the action URL -->
        <form action="reset_password.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
            <div class="row">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="row">
                <button type="submit">Submit</button>
            </div>
        </form>

        <div class="back-to-login">
            <a href="login.php">Back to Login</a>
        </div>
    </div>

</body>
</html>
