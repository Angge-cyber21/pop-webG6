app.post('/login', async (req, res) => {
  const { username, password } = req.body;

  try {
    const [rows] = await db.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password]);

    if (rows.length > 0) {
      res.send(`Welcome, ${username}!`);
    } else {
      res.send('Invalid credentials');
    }
  } catch (err) {
    console.error(err);
    res.status(500).send('Database error');
  }
});
