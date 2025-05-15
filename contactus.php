<?php
    // PHP section for dynamic content (e.g., current year)
    $year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - DYPIMCA</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #c9f1f9, #a2d4f8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        img {
            display: block;
            margin: 40px auto 10px auto;
            width: 180px;
            height: auto;
            transition: transform 0.5s ease-in-out;
        }

        img:hover {
            transform: scale(1.05);
        }

        h1 {
            text-align: center;
            font-size: 3rem;
            color: #012840;
            text-transform: uppercase;
            margin-bottom: 10px;
            animation: slideIn 1.5s ease-in-out;
        }

        h1 u {
            border-bottom: 3px solid #012840;
            padding-bottom: 5px;
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

        .footer-menu {
            max-width: 900px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            animation: fadeUp 1.8s ease-in-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-menu h2, .footer-menu h3 {
            text-align: center;
            color: #084b83;
        }

        .footer-menu a {
            text-decoration: none;
            color: #0d3a5f;
            font-weight: bold;
            font-size: 1.2rem;
            display: block;
            margin: 10px 0;
            transition: color 0.3s ease, transform 0.3s ease;
            text-align: center;
        }

        .footer-menu a:hover {
            color: #008cff;
            transform: scale(1.05);
        }

        a.back-link {
            display: inline-block;
            text-align: center;
            margin: 30px auto 10px;
            background-color: #084b83;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a.back-link:hover {
            background-color: #062f5a;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #012840;
            color: #fff;
            margin-top: 50px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }

            .footer-menu h2, .footer-menu h3 {
                font-size: 1.1rem;
            }

            .footer-menu a {
                font-size: 1rem;
            }

            a.back-link {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <img src="images/DYP_LOGO.png" alt="DYP Logo"> 

    <!-- Heading -->
    <h1><u>Contact Us</u></h1>

    <!-- Contact Info -->
    <div class="footer-menu">
        <h2>
            D. Y. Patil Institute of Master of Computer Applications and Management,<br>
            Dr. D. Y. Patil Educational Complex,<br>
            Sector 29, Nigdi Pradhikaran,<br>
            Akurdi, Pune 411044.
        </h2>

        <h3><u>EMAIL:</u></h3>
        <a href="mailto:enquiry@dypimca.ac.in">enquiry@dypimca.ac.in</a>

        <h3><u>DIRECTOR EMAIL:</u></h3>
        <a href="mailto:director@dypimca.ac.in">director@dypimca.ac.in</a>

        <h3><u>PHONES:</u></h3>
        <a href="tel:+91-020-27640998">+91-020-27640998</a>
        <a href="tel:+91-9923602480">+91-9923602480</a>
    </div>

    <!-- Back Button -->
    <div style="text-align: center;">
        <a href="homepage.php" class="back-link"><h3>← Back to Home</h3></a>
    </div>

    <!-- Footer -->
    <footer>
        &copy; <?php echo $year; ?> D. Y. Patil Institute of Master of Computer Applications and Management. All rights reserved.
    </footer>

</body>
</html>
