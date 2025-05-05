const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3306;

// Middleware
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// MySQL connection

   const pool = mysql.createPool({
       host: '127.0.0.1',
       user: 'root', // Replace with your MySQL username
       password: 'Mayyra21aaaAngge', // Replace with your MySQL password
       database: 'preorderpal', // Replace with your database name
       waitForConnections: true,
       connectionLimit: 10,
       queueLimit: 0,
       connectTimeout: 10000 // Increase timeout to 10 seconds
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
    db.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
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

// Signup route
app.post('/signup', (req, res) => {
    const { username, password } = req.body;
    db.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.status(201).send('User  registered successfully');
    });
});

// Start the server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
