document.addEventListener('DOMContentLoaded', function () {
    // Toggle Login/Signup Views
    document.getElementById("showSignup").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("loginContainer").style.display = "none";
        document.getElementById("signupContainer").style.display = "block";
    });

    document.getElementById("showLogin").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("signupContainer").style.display = "none";
        document.getElementById("loginContainer").style.display = "block";
    });

    // Handle Login
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const usernameInput = document.getElementById("username");
        const passwordInput = document.getElementById("password");

        if (usernameInput && passwordInput) {
            const username = usernameInput.value;
            const password = passwordInput.value;

            fetch('https://pop-webg6.onrender.com/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            })
            .then(response => {
                if (!response.ok) throw new Error("Login failed.");
                return response.text();
            })
            .then(data => {
                localStorage.setItem('username', username);
                window.location.href = 'mainpage.html';
            })
            .catch(error => {
                alert(error.message);
                console.error('Login Error:', error);
            });
        } else {
            console.error('Login input elements not found');
            alert('Login input elements not found');
        }
    });

    // Handle Signup
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event
