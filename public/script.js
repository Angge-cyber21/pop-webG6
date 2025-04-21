document.getElementById('showSignup').addEventListener('click', function() {
    document.getElementById('loginContainer').style.display = 'none';
    document.getElementById('signupContainer').style.display = 'block';
});

document.getElementById('showLogin').addEventListener('click', function() {
    document.getElementById('signupContainer').style.display = 'none';
    document.getElementById('loginContainer').style.display = 'block';
});

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const username = document.getElementById('newUsername').value;
    const password = document.getElementById('newPassword').
    value;}
)