-- DML Evan Leach 220085087 Team 28
-- Populate the users table
INSERT INTO users (username, email, password, user_role) 
VALUES ('evan_leach', 'evanteam28@aston.com', 'hashed_password', 'customer');

-- Populate the products table
INSERT INTO products (title, description, price, genre, publisher, developer, stock_quantity) 
VALUES ('Game Title', 'Description of the game', 59.99, 'Action', 'Game Publisher', 'Game Developer', 100);

-- Populate the orders table
INSERT INTO orders (user_id, total_price, Status) 
VALUES (1, 120.00, 'pending');

-- Populate the order details table
INSERT INTO order_details (order_id, product_id, quantity, price_per_unit) 
VALUES (1, 1, 2, 59.99);

-- Populate the reviews table
INSERT INTO reviews (product_id, user_id, rating, comment) 
VALUES (1, 1, 5, 'Great game!');

-- Populate the wishlist table
INSERT INTO wishlist (user_id, product_id) 
VALUES (1, 2);

-- Update a users email
UPDATE users 
SET email = 'new_email@example.com' 
WHERE user_id = 1;

-- Update a products price
UPDATE products 
SET price = 49.99 
WHERE product_id = 1; 

-- Deleting a user
DELETE FROM users 
WHERE user_id = 1;

-- Deleting a product from wishlist
DELETE FROM wishlist 
WHERE user_id = 1 AND product_id = 2;

-- Querying data
SELECT * FROM products;

-- Selecting orders for a user
SELECT * FROM orders 
WHERE user_id = 1;