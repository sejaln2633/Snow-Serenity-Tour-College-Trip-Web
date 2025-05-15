<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - D.Y. Patil Institute</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #b2f7ef, #efffb2);
            color: #333;
            overflow-x: hidden;
        }

        .header-image {
            width: 100%;
            height: 950px;
            object-fit: cover;
            animation: zoomIn 4s ease-in-out forwards;
        }

        @keyframes zoomIn {
            0% {
                transform: scale(1.1);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            color: #0c0c0c;
            font-size: 3em;
            margin-top: 20px;
            animation: fadeDown 2s ease-in-out;
        }

        @keyframes fadeDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about-text {
            width: 100%;
            max-width: 1500px;
            margin: 30px auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeUp 2s ease-in-out;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        marquee {
            background-color: rgb(3, 14, 55);
            color: white;
            padding: 10px;
            font-weight: bold;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                letter-spacing: 1px;
            }
            50% {
                letter-spacing: 3px;
            }
        }

        a {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9em;
            color: #555;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .about-text {
                padding: 20px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <img src="images/images-1.jpeg.jpg" alt="DY Patil Institute" class="header-image">

    <h1><u>About Us</u></h1>

    <div class="about-text">
        <h2>D. Y. Patil Institute of Master of Computer Applications and Management is one of the premier institutes of Computer Application established during 2002 by Dr. D. Y. Patil Pratishthan. 
        This institute has carved-out a special niche for imparting quality education to cater to the needs of community at large. 
        Since its inception, the institute is striving in the pursuit of academic excellence and good governance. 
        The institute is situated on the green and scenic campus of D. Y. Patil Pratishthan’s Educational Complex, Akurdi, Pune. 
        The institute has state-of-the-art infrastructure with modern amenities to meet the current needs of the technical education.</h2>
    </div>

    <marquee behavior="scroll" direction="left">
        THIS WEBSITE IS DESIGNED BY MCA STUDENTS (DR. D. Y. PATIL COLLEGE OF COMPUTER APPLICATIONS AND MANAGEMENT)
    </marquee>

    <div style="text-align: center;">
        <a href="homepage.php"><h3>← Back to Home</h3></a>
    </div>

    <footer>
        &copy; 2025 D. Y. Patil Institute of MCA. All rights reserved.
    </footer>
</body>
</html>
