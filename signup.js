// Frontend JavaScript to handle the form submission and make a POST request
const signupForm = document.getElementById('signupForm');

signupForm.addEventListener('submit', (e) => {
  e.preventDefault();  // Prevent the form from refreshing the page

  // Get the user input values
  const usernameInput = document.getElementById('newUsername');
  const passwordInput = document.getElementById('newPassword');

  if (usernameInput && passwordInput) {
      const username = usernameInput.value;
      const password = passwordInput.value;
  } else {
      console.error('Input elements not found');
  }
     
  // Send the signup request to the backend
  fetch('https://pop-api.onrender.com/signup', {  // Your deployed backend URL
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username: username,
      password: password,
    })
  })
  .then(res => res.text())  // Handle response as text
  .then(data => {
  alert(data);  // Show message to user
  localStorage.setItem('username', username);  // Store username
  window.location.href = 'mainpage.html'; // Redirect to main page
  })
  .catch(err => {
    console.error('Signup error:', err);
    alert('Signup failed. Please try again.');
  });
});
