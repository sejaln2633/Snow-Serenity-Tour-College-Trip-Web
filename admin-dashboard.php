<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include('db.php');

// Fetch all trip applications
$query = "SELECT * FROM trip_applications ORDER BY applied_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard - Applications & Payments</title>
    <!-- Inside <head> -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }

    body {
        background: linear-gradient(to right, #e0eafc, #cfdef3);
        color: #333;
        min-height: 100vh;
        padding: 30px 0;
    }

    .container {
        width: 95%;
        max-width: 1200px;
        margin: auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }

    h2 {
        text-align: center;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 600;
        color: #007bff;
        margin-top: 40px;
        padding-bottom: 8px;
        border-bottom: 2px solid #007bff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 14px;
        border-bottom: 1px solid #ddd;
        text-align: left;
        font-size: 15px;
    }

    th {
        background-color: #007bff;
        color: white;
        font-weight: 600;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
        margin-right: 5px;
    }

    .action-btn:hover {
        opacity: 0.9;
    }

    .action-btn.approve {
        background-color: #28a745;
        color: white;
    }

    .action-btn.reject {
        background-color: #dc3545;
        color: white;
    }

    .disabled-btn {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 50px;
        text-transform: uppercase;
    }

    .badge.approved {
        background-color: #28a745;
        color: white;
    }

    .badge.rejected {
        background-color: #dc3545;
        color: white;
    }

    .badge.pending {
        background-color: #ffc107;
        color: black;
    }

    .badge.payment-yes {
        background-color: #17a2b8;
        color: white;
    }

    .badge.payment-no {
        background-color: #6c757d;
        color: white;
    }

    .logout-btn {
        text-align: right;
        margin-top: 30px;
    }

    .logout-btn a {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        transition: 0.3s;
    }

    .logout-btn a:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #4CAF50;
        color: white;
        padding: 14px;
        margin-bottom: 20px;
        border-radius: 6px;
        text-align: center;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 13px;
        }

        .action-btn {
            font-size: 12px;
        }

        .section-title {
            font-size: 18px;
        }

        .logout-btn a {
            padding: 6px 12px;
            font-size: 14px;
        }
    }
</style>

</head>
<body>

<div class="container">

    <h2>Faculty Dashboard</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
    <?php endif; ?>

    <!-- Approvals Section -->
    <div class="section-title">Applications Awaiting Action</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Destination</th>
                <th>Gender</th>
                <th>Course</th>
                <th>Class</th>
                <th>Applied At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $has_pending = false;
        foreach ($applications as $app):
            if ($app['status'] === 'Pending'):
                $has_pending = true;
        ?>
            <tr>
                <td><?= htmlspecialchars($app['id']) ?></td>
                <td><?= htmlspecialchars($app['name']) ?></td>
                <td><?= htmlspecialchars($app['destination']) ?></td>
                <td><?= htmlspecialchars($app['gender']) ?></td>
                <td><?= htmlspecialchars($app['course']) ?></td>
                <td><?= htmlspecialchars($app['class']) ?></td>
                <td><?= htmlspecialchars($app['applied_at']) ?></td>
                <td><?= htmlspecialchars($app['status']) ?></td>
                <td>
                    <button class="action-btn" onclick="approveApplication(<?= $app['id'] ?>)">Approve</button>
                    <button class="action-btn reject-btn" onclick="rejectApplication(<?= $app['id'] ?>)">Reject</button>
                </td>
            </tr>
        <?php endif; endforeach; ?>
        <?php if (!$has_pending): ?>
            <tr><td colspan="9">No pending applications.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Payments Section -->
    <div class="section-title">Payment Status</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Destination</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Applied At</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($applications) > 0): ?>
            <?php foreach ($applications as $app): ?>
                <tr>
                    <td><?= htmlspecialchars($app['id']) ?></td>
                    <td><?= htmlspecialchars($app['name']) ?></td>
                    <td><?= htmlspecialchars($app['email']) ?></td>
                    <td><?= htmlspecialchars($app['phone']) ?></td>
                    <td><?= htmlspecialchars($app['destination']) ?></td>
                    <td><?= htmlspecialchars($app['status']) ?></td>
                    <td>
                        <?= $app['payment_done'] == 1 ? '<span style="color:green;">Yes</span>' : '<span style="color:red;">No</span>' ?>
                    </td>
                    <td><?= htmlspecialchars($app['applied_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No applications found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="logout-btn">
        <a href="logout.php">Logout</a>
    </div>

</div>

<script>
    function approveApplication(id) {
        if (confirm("Approve this application?")) {
            window.location.href = "approve.php?id=" + id;
        }
    }

    function rejectApplication(id) {
        if (confirm("Reject this application?")) {
            window.location.href = "reject.php?id=" + id;
        }
    }
</script>

</body>
</html>
