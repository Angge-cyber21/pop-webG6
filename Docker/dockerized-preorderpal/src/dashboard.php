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
    <link rel="icon" type="image/png" href="new-logo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PreOrder Pal</title>
    <style>
        html, body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 12px 20px;
        }

        .navbar .left {
            display: flex;
            align-items: center;
        }

        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        .navbar .left img.logo {
            height: 40px;
            width: 40px;
            margin-right: 10px;
        }

        .navbar .site-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-right: 15px;
        }

        .dropdown-menu {
            display: none;
            position: fixed;
            top: 60px;
            left: 20px;
            background-color: white;
            color: #004080;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            min-width: 160px;
            flex-direction: column;
        }

        .dropdown-menu a {
            padding: 12px 16px;
            text-decoration: none;
            color: #004080;
            font-weight: bold;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #e6f0ff;
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

        .reservation-section {
            padding: 60px 20px;
            text-align: center;
        }

        .reservation-section h1 {
            font-size: 2.8rem;
            color: #004080;
        }

        .reservation-section p {
            max-width: 700px;
            margin: auto;
            font-size: 1.2rem;
        }

        .reservation-section img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .reservation-section a.button {
            display: inline-block;
            background: linear-gradient(135deg, #004080, #007acc);
            color: white;
            padding: 14px 32px;
            border: none;
            font-weight: bold;
            font-size: 1.1rem;
            border-radius: 50px;
            box-shadow: 0 8px 16px rgba(0, 64, 128, 0.2);
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .reservation-section a.button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(0, 64, 128, 0.3);
        }

        /* Slideshow Styles */
        .slideshow {
            position: relative;
            max-width: 100%;
            height: 350px;
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
            height: 350px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .slideshow {
                height: 250px;
            }

            .reservation-section img {
                height: 250px;
            }
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
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="left">
        <button id="menuToggle" onclick="toggleMenu()" class="menu-toggle">☰</button>
        <img src="new-logo.png" alt="PreOrder Pal Logo" class="logo" />
        <div class="site-name">PreOrder Pal</div>
    </div>
    <div class="right">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</span>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<!-- Table Reservation Section -->
<section class="reservation-section">
    <h1>Reserve Your Table</h1>
    <p>Plan your dining experience in advance. Select your location, time, and party size to secure your reservation with ease.</p>
    <img src="https://restaurant.eatapp.co/hs-fs/hubfs/WordPress-Table-Reservation-plugin-1000x562-1.webp" alt="Table Reservation">
    <a href="choose_location.php" class="button">Make a Reservation</a> 
</section>

<!-- Slideshow -->
<div class="slideshow">
    <div class="slides" id="slideContainer">
        <img src="20170107-203712-largejpg_rotated_90" alt="Dining">
        <img src="images" alt="Meal">
        <img src="images (1)" alt="Restaurant Table">
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

<!-- Menu Dropdown -->
<div id="menuDropdown" class="dropdown-menu">
    <a href="javascript:void(0);" onclick="openAboutUs()">About Us</a>
    <a href="#contact-us">Contact Us</a>
</div>

<!-- About Us Modal -->
<div id="aboutUsModal" style="display:none; position:fixed; z-index:10000; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.6);">
    <div style="background:white; margin:5% auto; padding:20px; border-radius:10px; width:90%; max-width:800px; position:relative;">
        <span onclick="closeAboutUs()" style="position:absolute; top:10px; right:20px; font-size:1.5rem; cursor:pointer;">&times;</span>
        <h2 style="color: #004080; text-align: center; margin-bottom: 30px;">Meet the Team</h2>
        <p style="text-align: center; max-width: 600px; margin: 0 auto 30px;">
            Welcome to PreOrder Pal — your smart solution for seamless dining reservations and order management. Our team of passionate Computer Engineering students is dedicated to building user-friendly web tools that simplify how you interact with your favorite restaurants.
        </p>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 25px;">
            <!-- Team Member Cards -->
            <div style="width: 150px; text-align: center;">
                <img src="495071746_2227949027650538_8973228642559065597_n.jpg" alt="Khristian Acuzar" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <strong>Khristian Acuzar</strong><br>
                <span style="font-size: 0.9rem; color: #666;">UI/UX Designer</span>
            </div>
            <div style="width: 150px; text-align: center;">
                <img src="494819232_1427104071975303_2711388034454505738_n.jpg" alt="Angeline Aguilar" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <strong>Angeline Aguilar</strong><br>
                <span style="font-size: 0.9rem; color: #666;">Backend & Frontend Dev | Database Manager</span>
            </div>
            <div style="width: 150px; text-align: center;">
                <img src="494572777_994222016208675_8633879662162749425_n.jpg" alt="Jamaica Alvarez" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <strong>Jamaica Alvarez</strong><br>
                <span style="font-size: 0.9rem; color: #666;">Frontend Developer | Logo Creator</span>
            </div>
            <div style="width: 150px; text-align: center;">
                <img src="494578883_2167290437041722_3523411169221274441_n.jpg" alt="Angilyn Antipolo" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <strong>Angilyn Antipolo</strong><br>
                <span style="font-size: 0.9rem; color: #666;">Frontend Developer</span>
            </div>
            <div style="width: 150px; text-align: center;">
                <img src="484629629_3187168041422759_7140601740242773635_n.jpg" alt="Kiarry Jaurigue" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <strong>Kiarry Jaurigue</strong><br>
                <span style="font-size: 0.9rem; color: #666;">Frontend Developer</span>
            </div>
        </div>
    </div>
</div>


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

    function toggleMenu() {
        const menu = document.getElementById('menuDropdown');
        const menuToggle = document.getElementById('menuToggle');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    
            
        // Toggle the icon to 'X' when the menu is open
        if (menu.style.display === 'block') {
            menuToggle.textContent = '✖';  // Change to 'X'
        } else {
            menuToggle.textContent = '☰';  // Change back to '☰'
        }
    }

    function openAboutUs() {
        document.getElementById('aboutUsModal').style.display = 'block';
    }

    function closeAboutUs() {
        document.getElementById('aboutUsModal').style.display = 'none';
    }
</script>

</body>
</html>
