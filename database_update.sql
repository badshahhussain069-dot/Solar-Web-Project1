
USE solar_project;

ALTER TABLE bookings
ADD status VARCHAR(50) DEFAULT 'Pending';

CREATE TABLE IF NOT EXISTS products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    price VARCHAR(50)
);

INSERT INTO products(product_name, price) VALUES
('Solar Panel', '25000'),
('Solar Battery', '18000'),
('Solar Inverter', '12000');
