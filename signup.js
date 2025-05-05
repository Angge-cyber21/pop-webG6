// Frontend JavaScript to handle the form submission and make a POST request
const signupForm = document.getElementById('signupForm');

signupForm.addEventListener('submit', (e) => {
  e.preventDefault();  // Prevent the form from refreshing the page
  
  // Get the user input values
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // Send the signup request to the backend
  fetch('https://pop-api.onrender.com/signup', {  // Your deployed backend URL
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username: username,
      password: password
    })
  })
  .then(res => res.text())  // Handle response as text (as your server returns text)
  .then(data => console.log(data))  // Log success message or handle it as needed
  .catch(err => console.error('Error:', err));  // Log any errors
});
