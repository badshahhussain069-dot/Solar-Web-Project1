
CREATE DATABASE IF NOT EXISTS solar_project;
USE solar_project;

CREATE TABLE IF NOT EXISTS bookings(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    city VARCHAR(100),
    system_size VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
