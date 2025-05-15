<?php
// index.php - Homepage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Trip</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        background: url('https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        color: #fff;
        position: relative;
        animation: fadeIn 1.2s ease-in;
    }

    body::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
        width: 85%;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        margin: 30px auto;
        animation: fadeIn 1.5s ease-in-out;
    }

    header h1 {
        font-size: 2.8em;
        color: #ffffff;
        margin-bottom: 15px;
    }

    nav ul {
        list-style: none;
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    nav ul li a {
        background: rgba(255, 255, 255, 0.2);
        padding: 12px 24px;
        border-radius: 25px;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
    }

    nav ul li a:hover {
        background: rgba(255, 255, 255, 0.4);
        color: #000;
        transform: scale(1.05);
    }

    .intro {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        text-align: center;
        padding: 60px 20px;
        max-width: 800px;
        margin: 40px auto;
        animation: fadeIn 2s ease;
    }

    .intro h2 {
        font-size: 2.5em;
        color: #ffffff;
        margin-bottom: 20px;
    }

    .intro p {
        font-size: 1.3em;
        color: #e0e0e0;
        margin-bottom: 30px;
    }

    .intro a {
        text-decoration: none;
        font-size: 1.1em;
        background-color: rgba(0, 188, 212, 0.9);
        color: white;
        padding: 12px 24px;
        border-radius: 30px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        display: inline-block;
        margin-top: 20px;
    }

    .intro a:hover {
        background-color: rgba(2, 136, 209, 1);
        transform: translateY(-3px);
    }

    footer {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        text-align: center;
        padding: 20px 0;
        margin-top: 40px;
        font-size: 1em;
        z-index: 1;
        position: relative;
    }

    @media (max-width: 768px) {
        nav ul {
            flex-direction: column;
            gap: 15px;
        }

        header h1 {
            font-size: 2em;
        }

        .intro h2 {
            font-size: 2em;
        }

        .intro p {
            font-size: 1.1em;
        }
    }
</style>

</head>
<body>
    <header>
        <div class="container">
            <h1>WELCOME TO COLLEGE TRIP APPLICATION WEBSITE</h1>
            <nav>
                <ul>
                    <li><a href="register.php">CREATE AN ACCOUNT</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="intro">
        <div class="container">
            <h2>Join Our Amazing College Trip</h2>
            <p>Sign up for an unforgettable experience with your friends!</p>
            <a href="homepage.php"><h3>BACK</h3></a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 College Trip. All rights reserved.</p>
    </footer>
</body>
</html>