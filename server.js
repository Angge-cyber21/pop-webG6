const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const app = express();
const port = process.env.PORT || 3000;

// Middleware
const cors = require('cors');
app.use(cors({
  origin: 'https://angge-cyber21.github.io'
}));
app.use(bodyParser.json());
app.use(express.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.json());

// MySQL connection
const pool = mysql.createPool({
  host: 'switchyard.proxy.rlwy.net',
  port: 23306,
  user: 'root',
  password: 'Mayyra21aaaAngge',
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
    console.log('Received login:', username, password); // Add this log
    pool.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
        if (err) {
            console.error("DB error:", err);
            return res.status(500).send(err);
        }
        console.log('Query Results:', results); // Add this log
        if (results.length > 0) {
            res.status(200).send('Login successful');
        } else {
            res.status(401).send('Invalid username or password');
        }
    });
});

// Signup endpoint (backend)
app.post('/signup', (req, res) => {
    const { username, password } = req.body;
    console.log('Received signup:', username, password); // Add this log
    pool.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], (err, results) => {
        if (err) {
            console.error('Error during signup:', err); // Log the error
            return res.status(500).send(err);
        }
        console.log('Signup success:', results); // Add this log
        res.status(201).send('User registered successfully');
    });
});



// Start the server
app.listen(process.env.PORT || 3000, () => {
  console.log('Server running');
});
