<?php
// forgetpass.php - Password Reset
session_start();
include('db.php');

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch();

    if ($user) {
        // Fallback to mt_rand() for token generation if random_bytes() and openssl are unavailable
        if (function_exists('openssl_random_pseudo_bytes')) {
            // Secure token generation using OpenSSL
            $token = bin2hex(openssl_random_pseudo_bytes(16)); // 32 characters
        } else {
            // Fall back to mt_rand() for generating a token
            $token = '';
            for ($i = 0; $i < 32; $i++) {
                $token .= mt_rand(0, 255);  // Generate random 256-bit token
            }
        }

        // Insert the token into the password_resets table with 1 hour expiry
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
        $stmt->execute(array($email, $token));

        // Send the reset email with the token
        mail($email, "Password Reset", "Click the link to reset your password: https://yourdomain.com/reset_password.php?token=$token");

        // Success message
        $success_message = "A password reset link has been sent to your email address!";
    } else {
        // Error message if email does not exist
        $error_message = "No user found with that email address!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
    /* Reset & base */
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  height: 100vh;
  font-family: 'Poppins', Arial, sans-serif;
  background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  display: flex;
  justify-content: center;
  align-items: center;
  color: #444;
}

/* Glassy container */
.login-container {
  background: rgba(255, 255, 255, 0.85);
  border-radius: 24px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  width: 380px;
  max-width: 90%;
  padding: 36px 32px 42px;
  text-align: center;
  transition: transform 0.25s ease;
}

.login-container:hover {
  transform: translateY(-8px);
}

h2 {
  font-weight: 700;
  font-size: 2.4rem;
  margin-bottom: 28px;
  color: #5a5a5a;
  letter-spacing: 1.1px;
  text-shadow: 0 1px 1px #ffffffcc;
}

/* Messages */
.error-message,
.success-message {
  margin-bottom: 20px;
  font-weight: 600;
  border-radius: 12px;
  padding: 12px 18px;
  font-size: 1rem;
  max-width: 100%;
  user-select: none;
  box-shadow: 0 4px 8px rgba(0,0,0,0.08);
}

.error-message {
  background: #fef0f0;
  color: #d9534f;
  border: 1.5px solid #e74c3c;
}

.success-message {
  background: #ecf9f1;
  color: #2ecc71;
  border: 1.5px solid #27ae60;
}

/* Form layout */
form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Label style */
label {
  font-weight: 600;
  font-size: 1rem;
  margin-bottom: 6px;
  color: #666;
  text-align: left;
}

/* Inputs */
input[type="email"] {
  padding: 14px 16px;
  font-size: 1rem;
  border-radius: 14px;
  border: 1.8px solid #bfcddf;
  background: #f9fbfc;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  outline: none;
  color: #444;
  font-weight: 500;
}

input[type="email"]::placeholder {
  font-style: italic;
  color: #a0a9bb;
}

input[type="email"]:focus {
  border-color: #8fbcf7;
  box-shadow: 0 0 8px #8fbcf7aa;
  background: #ffffff;
}

/* Button */
button[type="submit"] {
  background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
  padding: 16px;
  font-size: 1.2rem;
  font-weight: 700;
  color: white;
  border: none;
  border-radius: 18px;
  cursor: pointer;
  box-shadow: 0 6px 20px rgba(116, 235, 213, 0.6);
  transition: background 0.4s ease, box-shadow 0.4s ease;
}

button[type="submit"]:hover {
  background: linear-gradient(135deg, #66d1c9 0%, #7ea4de 100%);
  box-shadow: 0 8px 26px rgba(102, 209, 201, 0.8);
}

/* Back to login link */
.back-to-login {
  margin-top: 26px;
  font-size: 0.95rem;
  font-weight: 600;
  color: #5c7cba;
  user-select: none;
  transition: color 0.3s ease;
}

.back-to-login a {
  color: #5c7cba;
  text-decoration: none;
  border-bottom: 2px solid transparent;
  padding-bottom: 2px;
  transition: border-color 0.3s ease;
}

.back-to-login a:hover {
  color: #3761a8;
  border-color: #3761a8;
}

/* Responsive */
@media (max-width: 480px) {
  .login-container {
    padding: 30px 20px 36px;
    width: 90%;
  }

  h2 {
    font-size: 1.9rem;
  }

  button[type="submit"] {
    font-size: 1.1rem;
  }
}
</style>
</head>
<body>

    <div class="login-container">
        <h2>Forgot Password</h2>

        <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="reset_password.php" method="POST">
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="row">
                <button type="submit">Reset Password</button>
            </div>
        </form>

        <div class="back-to-login">
            <a href="login.php">Back to Login</a>
        </div>
    </div>

</body>
</html>
