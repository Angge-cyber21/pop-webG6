const express = require('express');
const db = require('./database');
const path = require('path');
const app = express();

// Use Replit's environment port or default to 3000
const port = process.env.PORT || 3000;

// Middleware to handle POST form data
app.use(express.urlencoded({ extended: true }));

// Serve static files from public folder
app.use(express.static('public'));

// Route for login.html
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'login.html'));
});

// Handle login form
app.post('/login', (req, res) => {
  const { username, password } = req.body;
  console.log(`Username: ${username}, Password: ${password}`);
  res.send(`Logged in as ${username}`);
});

app.listen(port, () => {
  console.log(`✅ Server running at http://localhost:${port}`);
});
