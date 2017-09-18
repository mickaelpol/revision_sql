CREATE DATABASE product;
USE product;

CREATE TABLE produit (
	pro_id INT AUTO_INCREMENT PRIMARY KEY,
	pro_product_name VARCHAR(100),
	pro_price FLOAT,
	pro_image VARCHAR(255)
);