<?php
session_start();
include('db.php'); // your PDO connection as $pdo

$message = "";
$show_payment_form = false;
$student_email = '';
$fixed_amount = 5000;

if (isset($_POST['check_email'])) {
    $student_email = trim($_POST['check_email']);

    // Check if email exists in users table
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$student_email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $message = "Email not found in users. Please register first.";
    } else {
        // Check trip_applications for approved status for this email
        $stmt2 = $pdo->prepare("SELECT status FROM trip_applications WHERE email = ? ORDER BY applied_at DESC LIMIT 1");
        $stmt2->execute([$student_email]);
        $application = $stmt2->fetch(PDO::FETCH_ASSOC);

        if (!$application) {
            $message = "No trip application found for this email.";
        } elseif (strtolower($application['status']) != 'approved') {
            $message = "Your trip application is not approved yet. Please contact the faculty.";
        } else {
            $show_payment_form = true;
        }
    }
}

if (isset($_POST['pay_now'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $payment_mode = $_POST['payment_mode'];

    // Double-check approval status before payment
    $stmt = $pdo->prepare("SELECT status FROM trip_applications WHERE email = ? ORDER BY applied_at DESC LIMIT 1");
    $stmt->execute([$email]);
    $application = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$application) {
        $message = "No trip application found for this email.";
    } elseif (strtolower($application['status']) != 'approved') {
        $message = "Your trip application is not approved yet. Please contact the faculty.";
    } else {
        // Insert payment record or update trip_applications to mark payment done
        // Assuming you want to mark payment done by adding a 'payment_status' field or similar
        // Since your schema doesn’t have payment_status in trip_applications, let's create a payments table or just update trip_applications

        // For this example, let's update trip_applications with a new field payment_done = 1

        // Check if payment already done (you can create a field 'payment_done' in trip_applications: tinyint default 0)
        // Here, assuming payment_done column exists
        $stmtCheckPayment = $pdo->prepare("SELECT payment_done FROM trip_applications WHERE email = ? ORDER BY applied_at DESC LIMIT 1");
        $stmtCheckPayment->execute([$email]);
        $paymentCheck = $stmtCheckPayment->fetch(PDO::FETCH_ASSOC);

        if ($paymentCheck && $paymentCheck['payment_done'] == 1) {
            $message = "You have already made the payment of ₹$fixed_amount.";
        } else {
            // Update payment_done to 1
            $updatePayment = $pdo->prepare("UPDATE trip_applications SET payment_done = 1 WHERE email = ? ORDER BY applied_at DESC LIMIT 1");
            if ($updatePayment->execute([$email])) {
                $_SESSION['payment_message'] = "Payment of ₹$fixed_amount successful via " . htmlspecialchars($payment_mode) . ". Thank you, " . htmlspecialchars($name) . "!";
                header("Location: payment.php");
                exit();
            } else {
                $message = "Payment processing failed, please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Trip Payment</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #74ebd5, #acb6e5);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }

  .content {
    background: #fff;
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    max-width: 450px;
    width: 100%;
    animation: fadeIn 0.8s ease-in-out;
  }

  h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 26px;
  }

  .message {
    padding: 12px 15px;
    margin: 15px 0;
    border-radius: 8px;
    font-size: 0.95em;
    animation: slideDown 0.6s ease-in-out;
  }

  .error {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 4px solid #f44336;
  }

  .success {
    background-color: #d1e7dd;
    color: #155724;
    border-left: 4px solid #28a745;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  label {
    font-weight: 600;
    color: #444;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="email"],
  input[type="number"],
  select {
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1em;
    transition: all 0.3s ease;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  }

  input:focus,
  select:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
    outline: none;
  }

  button {
    padding: 12px;
    font-size: 1em;
    font-weight: 600;
    background: #4a90e2;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
  }

  button:hover {
    background: #357abd;
    transform: translateY(-2px);
  }

  button:active {
    transform: scale(0.98);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  }

  /* Animations */
  @keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  @keyframes slideDown {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  ::placeholder {
    color: #aaa;
    font-style: italic;
  }
</style>

</head>
<body>

<div class="content">
    <h2>Payment for Kashmir Trip</h2>

    <?php
    if (isset($_SESSION['payment_message'])) {
        echo "<div class='message success'>" . $_SESSION['payment_message'] . "</div>";
        unset($_SESSION['payment_message']);
    }

    if ($message) {
        echo "<div class='message error'>" . htmlspecialchars($message) . "</div>";
    }
    ?>

    <?php if (!$show_payment_form): ?>
        <form method="POST" action="payment.php">
            <label for="check_email">Enter your Email to check approval status:</label>
            <input type="email" id="check_email" name="check_email" required placeholder="Your registered email" />
            <button type="submit">Check Approval</button>
            <div style="text-align: center;">
        <a href="homepage.php"><h3>← Back to Home</h3></a>
    </div>
        </form>
    <?php else: ?>
        <form method="POST" action="payment.php">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required placeholder="Your full name" />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student_email); ?>" readonly />

            <label for="amount">Amount (₹):</label>
            <input type="text" id="amount" name="amount" value="<?php echo $fixed_amount; ?>" readonly disabled />

            <label for="payment_mode">Payment Mode:</label>
            <select id="payment_mode" name="payment_mode" required>
                <option value="">Select</option>
                <option value="Credit/Debit Card">Credit/Debit Card</option>
                <option value="UPI">UPI</option>
                <option value="Net Banking">Net Banking</option>
            </select>

            <button type="submit" name="pay_now">Pay Now</button>
            <div style="text-align: center;">
        <a href="homepage.php"><h3>← Back to Home</h3></a>
    </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
