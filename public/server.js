const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
const port = 5500;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Replace with your MySQL username
    password: 'Mayyra21aaaAngge', // Replace with your MySQL password
    database: 'preorderpal'
});

// Connect to MySQL
db.connect(err => {
    if (err) {
        console.error('Database connection failed: ' + err.stack);
        return;
    }
    console.log('Connected to database.');
});

// User registration endpoint
app.post('/api/register', (req, res) => {
    const { username, password } = req.body;

    // Hash the password
    const hashedPassword = bcrypt.hashSync(password, 8);

    // Insert user into the database
    db.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, hashedPassword], (error, results) => {
        if (error) {
            return res.status(500).json({ success: false, message: 'User  registration failed: ' + error });
        }
        res.status(201).json({ success: true, message: 'User  registered successfully!' });
    });
});

// User login endpoint
app.post('/api/login', (req, res) => {
    const { username, password } = req.body;

    // Find user in the database
    db.query('SELECT * FROM users WHERE username = ?', [username], (error, results) => {
        if (error || results.length === 0) {
            return res.status(401).json({ success: false, message: 'Invalid username or password' });
        }

        // Check password
        const user = results[0];
        const passwordIsValid = bcrypt.compareSync(password, user.password);
        if (!passwordIsValid) {
            return res.status(401).json({ success: false, accessToken: null, message: 'Invalid password' });
        }

        // Create a token (optional)
        const token = jwt.sign({ id: user.id }, 'your_secret_key', { expiresIn: 86400 }); // 24 hours

        res.status(200).json({ success: true, accessToken: token });
    });
});

// Start the server
app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});