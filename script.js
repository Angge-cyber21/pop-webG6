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
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        fetch('https://pop-webg6.onrender.com/login', { // <-- Use deployed backend here
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
    });

    // Handle Signup
    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const newUsername = document.getElementById('newUsername').value;
        const newPassword = document.getElementById('newPassword').value;

        fetch('https://pop-webg6.onrender.com/signup', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username: newUsername, password: newPassword })
        })
        .then(response => {
            if (!response.ok) throw new Error("Signup failed.");
            return response.text();
        })
        .then(message => {
            alert(message);
            localStorage.setItem('username', newUsername);
            window.location.href = 'mainpage.html';
        })
        .catch(error => {
            alert(error.message);
            console.error('Signup Error:', error);
        });
    });
});
