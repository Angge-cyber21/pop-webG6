CREATE DATABASE your_database_name;

USE your_database_name;

CREATE TABLE users (
  id INT IDENTITY(1,1) PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Sample user
INSERT INTO users (username, password) VALUES ('admin', '1234');
