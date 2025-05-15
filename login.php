<?php
// login.php - Student Login
session_start();
include('db.php'); // Make sure this file connects to your database properly

$error_message = ''; // Variable to hold error message

// Custom function to verify password using crypt
function custom_password_verify($password, $hashed_password) {
    return crypt($password, $hashed_password) === $hashed_password;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $role = $_POST['role'];

    // Check for valid student login
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch();

    if ($user) {
        // If user exists, check the password using custom password verify function
        if (custom_password_verify($password, $user['password'])) {
            // If credentials are correct, start a session and redirect to dashboard
            $_SESSION['user_id'] = $user['id'];
            if($user['role']=='admin'){
                $_SESSION['admin_logged_in'] = true;
                header('Location: admin-dashboard.php');

            }else{
                header('Location: dashboard.php');
            }
            exit;
        } else {
            // If password is incorrect
            $error_message = "Invalid login credentials!";
        }
    } else {
        // If no user is found with the provided email
        $error_message = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
    /* Full page background with soft pastel Kashmir vibe */
body {
  margin: 0;
  padding: 0;
  height: 100vh;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: url('kashmir.jpg') no-repeat center center fixed;
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow: hidden;
  color: #333;
}

/* Light translucent overlay with subtle blur for softness */
body::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  z-index: 0;
}

/* Main container with gentle glass effect */
.login-container {
  position: relative;
  z-index: 1;
  width: 500px;
  padding: 40px 36px;
  background: rgba(255, 255, 255, 0.75);
  border-radius: 30px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.07);
  border: 1px solid rgba(200, 200, 200, 0.3);
  backdrop-filter: blur(15px);
  -webkit-backdrop-filter: blur(15px);
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.3s ease;
}

.login-container:hover {
  transform: translateY(-8px);
}

/* Heading */
.login-container h2 {
  margin-bottom: 50px;
  font-size: 2.2rem;
  font-weight: 600;
  color: #4a4a4a;
  letter-spacing: 1.2px;
  text-align: center;
}

/* Form styles */
form {
  width: 100%;
}

label {
  font-size: 1rem;
  color: #555;
  margin-bottom: 6px;
  display: block;
  font-weight: 600;
}

input[type="email"],
input[type="password"] {
  width: 95%;
  padding: 14px 16px;
  margin-bottom: 20px;
  font-size: 1rem;
  border-radius: 12px;
  border: 1.8px solid #c8d0e7;
  background: #f7f9fc;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.07);
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  outline: none;
  color: #444;
}

input[type="email"]::placeholder,
input[type="password"]::placeholder {
  color: #a9b0c0;
  font-style: italic;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #91a8d0;
  box-shadow: 0 0 10px #91a8d0aa;
  background: #ffffff;
}

/* Submit button */
button[type="submit"] {
  width: 100%;
  padding: 14px 16px;
  font-size: 1.1rem;
  font-weight: 700;
  color: white;
  background: linear-gradient(135deg, #89abe3, #b6c1f0);
  border: none;
  border-radius: 14px;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(137, 171, 227, 0.6);
  transition: background 0.4s ease, box-shadow 0.4s ease;
}

button[type="submit"]:hover {
  background: linear-gradient(135deg, #a6bbe9, #d0d9fc);
  box-shadow: 0 6px 18px rgba(166, 187, 233, 0.8);
}

/* Error message */
.error-message {
  color: #d9534f;
  font-weight: 600;
  margin-bottom: 18px;
  text-align: center;
}

/* Forgot password and signup links */
.forgot-password,
.signup-link {
  font-size: 0.9rem;
  text-align: center;
  margin-top: 16px;
  color: #708090;
  user-select: none;
}

.forgot-password a,
.signup-link a {
  color: #4a6fa5;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.forgot-password a:hover,
.signup-link a:hover {
  color: #7289da;
  text-decoration: underline;
}

</style>

</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="row">
                <button type="submit">Login</button>
            </div>
        </form>

        <div class="forgot-password">
            <a href="forgetpass.php">Forgot Password?</a>
        </div>

        <div class="signup-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </div>
    </div>

</body>
</html>
