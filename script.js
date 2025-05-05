// Show the signup form when "Sign up" is clicked
document.getElementById('showSignup').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    document.getElementById('loginContainer').style.display = 'none'; // Hide login form
    document.getElementById('signupContainer').style.display = 'block'; // Show signup form
});

// Show the login form when "Login" is clicked
document.getElementById('showLogin').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    document.getElementById('signupContainer').style.display = 'none'; // Hide signup form
    document.getElementById('loginContainer').style.display = 'block'; // Show login form
});

// JavaScript for handling login
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => {
        if (response.ok) {
            return response.json(); // Parse JSON response
        } else {
            throw new Error('Login failed. Please check your username and password.');
        }
    })
    .then(data => {
        // Store the username in local storage
        localStorage.setItem('username', data.username); // Use the username from the response
        // Redirect to the main page
        window.location.href = 'mainpage.html';
    })
    .catch(error => {
        alert(error.message); // Show the error message
        console.error('Error:', error);
    });
});

// JavaScript for handling signup
document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    const newUsername = document.getElementById('newUsername').value;
    const newPassword = document.getElementById('newPassword').value;

    fetch('http://localhost:3000/signup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: newUsername, password: newPassword })
    })
    .then(response => {
        if (response.ok) {
            return response.text(); // Get the response text
        } else {
            throw new Error('Signup failed. Please try again.');
        }
    })
    .then(data => {
        alert(data); // Show the response message
        // Optionally, you can automatically log in the user after signup
        // Uncomment the following lines if you want to log in the user automatically
        /*
        document.getElementById('username').value = newUsername;
        document.getElementById('password').value = newPassword;
        document.getElementById('loginForm').dispatchEvent(new Event('submit'));
        */
    })
    .catch(error => {
        alert(error.message); // Show the error message
        console.error('Error:', error);
    });
});