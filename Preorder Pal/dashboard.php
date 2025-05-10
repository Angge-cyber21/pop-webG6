<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="preorder-pal-logo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PreOrder Pal</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #004080;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 12px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .left {
            display: flex;
            align-items: center;
        }

        .navbar .left img.logo {
            height: 40px;
            width: 40px;
            margin-right: 10px;
        }

        .navbar .site-name {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar .right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar .right span {
            font-weight: bold;
        }

        .navbar .right a {
            color: white;
            text-decoration: none;
            border: 2px solid white;
            padding: 6px 12px;
            border-radius: 4px;
            transition: 0.3s;
        }

        .navbar .right a:hover {
            background-color: white;
            color: #004080;
        }

        .hero {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(to bottom, #e6f0ff, #ffffff);
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #004080;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: auto;
            color: #333;
        }

        .bottom-section {
            display: flex;
            justify-content: center;
            gap: 60px;
            padding: 20px;
            background-color: white;
            flex-wrap: wrap;
        }

        .bottom-section .option {
            text-align: center;
            cursor: pointer;
        }

        .bottom-section .option img {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .bottom-section .option img:hover {
            transform: scale(1.05);
        }

        .bottom-section .option p {
            margin-top: 10px;
            font-weight: bold;
            font-size: 1rem;
            color: #004080;
        }

        .slideshow {
            position: relative;
            max-width: 700px;
            height: 300px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 300%;
        }

        .slides img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .dots {
            text-align: center;
            margin-top: 10px;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
        }

        .dot.active {
            background-color: #004080;
        }

        .contact-section {
            background-color: #f1f1f1;
            padding: 40px 20px;
            text-align: center;
        }

        .contact-section h2 {
            color: #004080;
            margin-bottom: 20px;
        }

        .contact-section form {
            max-width: 600px;
            margin: auto;
        }

        .contact-section input, .contact-section textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-section button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-section button:hover {
            background-color: #0066cc;
        }

        footer {
            text-align: center;
            padding: 20px 10px;
            background-color: #004080;
            color: white;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                text-align: center;
            }
            .bottom-section {
                flex-direction: column;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Navigation</h2>
        <a href="javascript:void(0);" onclick="openAboutUs()">About Us</a>
        <a href="#contact-us">Contact Us</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="left">
            <img src="preorder-pal-logo.png" alt="PreOrder Pal Logo" class="logo" />

                <div class="site-name">PreOrder Pal</div>
            </div>
            <div class="right">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</span>
                <a href="logout.php">Logout</a>
            </div>
        </nav>

        <!-- Hero -->
        <section class="hero">
            <h1>Welcome to PreOrder Pal</h1>
            <p>Your modern restaurant assistant for table reservations, meal pre-ordering, and seamless payments—all in one place.</p>
        </section>

        <!-- Options Section -->
        <section class="bottom-section">
            <div class="option" onclick="window.location.href='choose_location.php'">
                <img src="https://restaurant.eatapp.co/hs-fs/hubfs/WordPress-Table-Reservation-plugin-1000x562-1.webp" alt="Table Reservation" />
                <p>Table Reservation</p>
            </div>
            <div class="option" onclick="window.location.href='foods_drinks.php'">
                <img src="https://thumbs.dreamstime.com/b/pre-order-food-line-icon-order-meal-sign-vector-restaurant-plate-fork-knife-symbol-179002895.jpg" alt="Pre-order Meal" />
                <p>Pre-order Meal</p>
            </div>
            <div class="option" onclick="window.location.href='payment.php'">
                <img src="https://swissuplabs.com/wordpress/wp-content/uploads/2016/04/free-icons-dribbble-pack1.png" alt="Payment Options" />
                <p>Payment Options</p>
            </div>
        </section>

        <!-- Slideshow -->
        <div class="slideshow">
            <div class="slides" id="slideContainer">
                <img src="https://images.unsplash.com/photo-1541544181002-3f78f280f0c5" alt="Dining">
                <img src="https://images.unsplash.com/photo-1555992336-c938b1b1e1a4" alt="Meal">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1" alt="Restaurant Table">
            </div>
            <div class="dots">
                <span class="dot active" onclick="moveSlide(0)"></span>
                <span class="dot" onclick="moveSlide(1)"></span>
                <span class="dot" onclick="moveSlide(2)"></span>
            </div>
        </div>

        <!-- Contact Us Section -->
        <section class="contact-section" id="contact-us">
            <h2>Contact Us</h2>
            <form action="send_message.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required />
                <input type="email" name="email" placeholder="Your Email" required />
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 PreOrder Pal. All rights reserved.</p>
        </footer>
    </div>
</div>

<!-- About Us Modal -->
<div id="aboutUsModal" style="display:none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
    <div style="background-color: #fff; margin: 10% auto; padding: 20px; border-radius: 10px; width: 90%; max-width: 600px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); position: relative;">
        <span onclick="closeAboutUs()" style="position: absolute; top: 10px; right: 20px; font-size: 24px; cursor: pointer;">&times;</span>
        <h2 style="color: #004080; text-align: center;">Meet the Team</h2>
        <ul style="list-style: none; padding: 0; text-align: center;">
            <li><strong>Khristian Andrei Acuzar</strong> –  UI/UX Designer</li>
            <li><strong>Angeline Aguilar</strong> – Backend-frontend Developer, Database Manager</li>
            <li><strong>Jamaica Rose Alvarez</strong> – Frontend Developer</li>
            <li><strong>Angilyn Antipolo</strong> – Frontend Developer</li>
            <li><strong>Kiarry Jake Jaurigue</strong> – Frontend Developer</li>
        </ul>
    </div>
</div>

<!-- JavaScript for slideshow -->
<script>
    let currentIndex = 0;
    const slides = document.getElementById('slideContainer');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        slides.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');
        currentIndex = index;
    }

    function moveSlide(index) {
        showSlide(index);
    }

    setInterval(() => {
        currentIndex = (currentIndex + 1) % 3;
        showSlide(currentIndex);
    }, 4000);

    function openAboutUs() {
        document.getElementById('aboutUsModal').style.display = 'block';
    }

    function closeAboutUs() {
        document.getElementById('aboutUsModal').style.display = 'none';
    }

    // Close modal if user clicks outside the modal box
    window.onclick = function(event) {
        const modal = document.getElementById('aboutUsModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
</script>
</body>
</html>
