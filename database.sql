CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    email TEXT,
    contact VARCHAR(20),
    movie TEXT,
    age INT,
    tickets INT,
    total DECIMAL(10, 2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);