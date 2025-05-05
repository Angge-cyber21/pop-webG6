const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const app = express();
const port = process.env.PORT || 3000;

// Middleware
const cors = require('cors');
app.use(cors({
  origin: 'https://pop-webg6.onrender.com', // or specify your frontend URL e.g., 'https://yourfrontend.onrender.com'
}));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// MySQL connection
const pool = mysql.createPool({
  host: 'switchyard.proxy.rlwy.net',
  port: 23306,
  user: 'root',
  password: 'pzkHaVmorxnSHWxzpIYNLWPBWaultzTU',
  database: 'railway',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
  connectTimeout: 10000
});

// Example query using the pool
pool.query('SELECT * FROM yourTable', (err, results) => {
  if (err) {
    console.error('Error executing query:', err);
    return;
  }
  console.log('Query results:', results);
});
// Close the pool when done
process.on('SIGINT', () => {
  pool.end((err) => {
    if (err) {
      console.error('Error closing the pool:', err);
    }
    console.log('Connection pool closed.');
    process.exit();
  });
});

// Root route
app.get('/', (req, res) => {
    res.send('Welcome to PreorderPal API!');
});

// Login route
app.post('/login', (req, res) => {
    const { username, password } = req.body;
    pool.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
        if (err) {
            console.error("DB error:", err);
            return res.status(500).send(err);
        }
        if (results.length > 0) {
            res.status(200).send('Login successful');
        } else {
            res.status(401).send('Invalid username or password');
        }
    });
});

// Frontend: Sign Up request

const signupForm = document.getElementById('signupForm');  // Assuming you have a form with this ID

signupForm.addEventListener('submit', (e) => {
  e.preventDefault();  // Prevent the form from reloading the page
  
  // Get user inputs
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // Send the signup request to the backend
  fetch('https://pop-webg6.onrender.com', {  // Replace with your backend URL here
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      username: username,
      password: password
    })
  })
  .then(res => res.json())  // Assuming your backend returns JSON
  .then(data => {
    if (data === 'User registered successfully') {
      console.log('Signup successful');
      // You can add any success message here, or redirect the user to the login page
    } else {
      console.log('Signup failed', data);
    }
  })
  .catch(err => console.error('Error during signup:', err));
});

// Start the server
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
