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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']); // This will only be 'Kashmir'
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $emergency_contact = mysqli_real_escape_string($conn, $_POST['emergency_contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);

    // Insert the application data into the database
    $sql = "INSERT INTO trip_applications (name, email, phone, destination, gender, dob, emergency_contact, address, course, class)
            VALUES ('$name', '$email', '$phone', '$destination', '$gender', '$dob', '$emergency_contact', '$address', '$course', '$class')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the result page to display success message
        $application_id = $conn->insert_id;
        header("Location: application_success.php?id=" . $application_id);
        exit();
    } else {
        // Error message
        $errorMessage = "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Trip Application</title>
    <style>
        <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #a1c4fd, #c2e9fb);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 500px;
        animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        text-align: center;
        color: #1f3c88;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin: 15px 0 5px;
        color: #333;
        font-weight: 600;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 10px;
        font-size: 15px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #1f3c88;
        box-shadow: 0 0 8px rgba(31, 60, 136, 0.2);
        outline: none;
    }

    textarea {
        resize: vertical;
    }

    button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(to right, #1f3c88, #5a73c9);
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        transition: transform 0.3s, background 0.3s;
    }

    button:hover {
        transform: scale(1.03);
        background: linear-gradient(to right, #1a2b6d, #4d62b6);
    }

    p {
        text-align: center;
        color: green;
        font-size: 16px;
    }

    @media (max-width: 600px) {
        .form-container {
            padding: 30px 20px;
        }
    }
</style>

    </style>
    <script>
        // JavaScript to dynamically change class options based on selected course
        function updateClassOptions() {
            var course = document.getElementById("course").value;
            var classSelect = document.getElementById("class");
            classSelect.innerHTML = ""; // Clear current options

            if (course == "MBA") {
                var option1 = document.createElement("option");
                option1.value = "MBA I";
                option1.textContent = "MBA I";
                var option2 = document.createElement("option");
                option2.value = "MBA II";
                option2.textContent = "MBA II";
                classSelect.appendChild(option1);
                classSelect.appendChild(option2);
            } else if (course == "MCA") {
                var option1 = document.createElement("option");
                option1.value = "MCA I";
                option1.textContent = "MCA I";
                var option2 = document.createElement("option");
                option2.value = "MCA II";
                option2.textContent = "MCA II";
                classSelect.appendChild(option1);
                classSelect.appendChild(option2);
            }
        }
    </script>
</head>
<body>

<div class="form-container">
    <h1>Apply for the College Trip</h1>
    <form method="POST" action="dashboard.php">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="destination">Trip Destination:</label>
        <select id="destination" name="destination" required>
            <option value="Kashmir">Kashmir</option>
        </select>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="emergency_contact">Emergency Contact Number:</label>
        <input type="text" id="emergency_contact" name="emergency_contact" required>

        <label for="address">Home Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <label for="course">Course:</label>
        <select id="course" name="course" required onchange="updateClassOptions()">
            <option value="MBA">MBA</option>
            <option value="MCA">MCA</option>
        </select>

        <label for="class">Class:</label>
        <select id="class" name="class" required>
            <!-- Class options will be populated based on course selection -->
        </select>

        <button type="submit">Apply Now</button>
    </form>
    <a href="application_success.php"></a>
</div>

</body>
</html>
