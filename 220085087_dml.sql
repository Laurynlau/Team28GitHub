-- DML Evan Leach 220085087 Team 28
-- Populate the users table
INSERT INTO users (username, email, password, user_role) 
VALUES ('evan_leach', 'evanteam28@aston.com', 'hashed_password', 'customer');

-- Populate the genres table
INSERT INTO genres (name)
VALUES 
('Adventure'),
('Board'),
('Puzzle'),
('Simulation'),
('Sports');

-- Populate the console types table
INSERT INTO console_types (name)
VALUES 
('Nintendo Switch'),
('PlayStation'),
('Xbox'),
('PC'),
('Nintendo Wii'),
('Multiple Platforms'),
('PlayStation and PC'),
('Xbox and PC'),
('PlayStation, Xbox, and PC'),
('PlayStation and Xbox'),
('PlayStation, Xbox, PC, and Nintendo Switch');

-- Populate the publishers table
INSERT INTO publishers (name)
VALUES
('Nintendo'),
('Sony Interactive Entertainment'),
('Panic'),
('ConcernedApe'),
('United Soft Media'),
('Days of Wonder'),
('Space Cowboys'),
('Hans im Glück'),
('Z-Man Games'),
('Enhance Games'),
('Valve Corporation'),
('Thekla, Inc.'),
('Ustwo'),
('Hempuli'),
('Electronic Arts'),
('Paradox Interactive'),
('Xbox Game Studios'),
('Frontier Developments'),
('2K Sports'),
('Psyonix');

-- Populate the developers table
INSERT INTO developers (name)
VALUES 
('Nintendo'),
('Sony Interactive Entertainment'),
('Santa Monica Studio'),
('Naughty Dog'),
('Campo Santo'),
('ConcernedApe'),
('Exozet'),
('Days of Wonder'),
('Asmodee Digital'),
('Monstars Inc., Resonair'),
('Valve Corporation'),
('Thekla, Inc.'),
('Ustwo'),
('Hempuli'),
('Maxis'),
('Colossal Order'),
('Asobo Studio'),
('Paradox Development Studio'),
('Frontier Developments'),
('EA Vancouver'),
('Visual Concepts'),
('Psyonix'),
('Nintendo EAD');

-- Populate the products table
INSERT INTO products (title, description, price, genre_id, console_type_id, publisher_id, developer_id, stock_quantity, image_path) 
VALUES -- Adventure Games
('The Legend of Zelda: Breath of the Wild', 'Adventure game for Nintendo Switch', 45.99, 1, 1, 1, 1, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zelda.jpg?raw=true'),
('Journey', 'Adventure game for PlayStation, PC', 14.99, 1, 7, 2, 3, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Journey.jpg?raw=true'),
('Uncharted 4: A Thief’s End', 'Adventure game for PlayStation', 45.99, 1, 2, 2, 4, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/uncharted4.jpg?raw=true'),
('Firewatch', 'Adventure game for PlayStation, Xbox, PC', 14.99, 1, 9, 3, 5, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/firewatch.jpeg?raw=true'),
('Stardew Valley', 'Adventure game for Multiple Platforms', 11.99, 1, 6, 4, 6, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/stardewvalley.png?raw=true'),
-- Board Games
('Catan Universe', 'Board game for Multiple Platforms', 0.00, 2, 6, 5, 7, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Catan_Universe.jpg?raw=true'),
('Ticket to Ride', 'Board game for Multiple Platforms', 14.99, 2, 6, 7, 8, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/ticket_to_ride.jpg?raw=true'),
('Splendor', 'Board game for Multiple Platforms', 8.50, 2, 6, 8, 9, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/splendor.jpg?raw=true'),
('Carcassonne', 'Board game for Multiple Platforms', 3.99, 2, 6, 9, 10, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/carcassonne.jpg?raw=true'),
('Pandemic: The Board Game', 'Board game for Multiple Platforms', 0.99, 2, 6, 10, 10, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/pandemic.jpg?raw=true'),
-- Puzzle Games
('Tetris Effect', 'Puzzle game for Multiple Platforms', 19.99, 3, 6, 11, 11, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Tetris.jpg?raw=true'),
('Portal 2', 'Puzzle game for Multiple Platforms', 8.50, 3, 6, 12, 12, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Portal2cover.jpg?raw=true'),
('The Witness', 'Puzzle game for Multiple Platforms', 9.99, 3, 6, 13, 13, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thewitness.jpg?raw=true'),
('Monument Valley', 'Puzzle game for Multiple Platforms', 6.99, 3, 6, 14, 14, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/monumentvalley.jpg?raw=true'),
('Baba Is You', 'Puzzle game for Multiple Platforms', 14.99, 3, 6, 15, 15, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/baba.jpg?raw=true'),
-- Simulation Games
('The Sims 4', 'Simulation game for Multiple Platforms', 0.00, 4, 6, 16, 16, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thesims.jpg?raw=true'),
('Cities: Skylines', 'Simulation game for Multiple Platforms', 7.49, 4, 6, 17, 17, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/citiesskylines.jpg?raw=true'),
('Microsoft Flight Simulator', 'Simulation game for PC, Xbox', 35.99, 4, 3, 18, 18, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Microsoft_Flight_Simulator.png?raw=true'),
('Stellaris', 'Simulation game for Multiple Platforms', 10.49, 4, 6, 17, 19, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Stellaris_cover.png?raw=true'),
('Planet Zoo', 'Simulation game for Multiple Platforms', 10.49, 4, 6, 19, 19, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zoo.jpeg?raw=true'),
-- Sports Games
('EA FC24', 'Sports game for Multiple Platforms', 29.99, 5, 6, 16, 20, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/eafc24.jpeg?raw=true'),
('NBA 2K24', 'Sports game for Multiple Platforms', 22.49, 5, 6, 20, 21, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/nba2k24.png?raw=true'),
('Rocket League', 'Sports game for Multiple Platforms', 0.00, 5, 6, 21, 21, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/rocket.jpeg?raw=true'),
('Wii Sports', 'Sports game for Nintendo Wii', 30.99, 5, 5, 1, 23, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/wii.jpeg?raw=true'),
('Mario Kart 8 Deluxe', 'Sports game for Nintendo Switch', 49.99, 5, 1, 1, 23, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/mariokart8.jpg?raw=true');

-- Start of Transaction for consistency in multi-table updates
START TRANSACTION;

-- Populate the orders table
INSERT INTO orders (user_id, total_price, Status) 
VALUES (1, 120.00, 'pending');

-- Populate the order details table
INSERT INTO order_details (order_id, product_id, quantity, price_per_unit) 
VALUES (1, 1, 2, 59.99);

-- Populate the previous orders table
INSERT INTO previous_orders (user_id, order_id, completion_date, total_price) 
VALUES (1, 1, '2023-01-15 08:00:00', 120.00);

-- End of Transaction
COMMIT;

-- Populate the reviews table
INSERT INTO reviews (product_id, user_id, rating, comment) 
VALUES (1, 1, 5, 'Great game!');

-- Populate the wishlist table
INSERT INTO wishlist (user_id, product_id) 
VALUES (1, 2);

-- Update a user's email
UPDATE users 
SET email = 'new_email@example.com' 
WHERE user_id = 1;

-- Update a product's price
UPDATE products 
SET price = 49.99 
WHERE product_id = 1; 

-- Deleting a user (Soft delete approach) 
-- To delete a user, uncomment and replace '1' with the user_id you want to delete
-- UPDATE users SET active = false WHERE user_id = 1;

-- Deleting a product from wishlist
-- To delete a product from the wishlist, uncomment and replace '1' and '2' with user_id and product_id
-- DELETE FROM wishlist WHERE user_id = 1 AND product_id = 2;

-- Querying data by genre
SELECT p.*
FROM products p
JOIN genres g ON p.genre_id = g.genre_id
WHERE g.name = 'Adventure';

-- Querying data by console type
SELECT p.*
FROM products p
JOIN console_types ct ON p.console_type_id = ct.console_type_id
WHERE ct.name LIKE '%PlayStation%';

-- Querying products within a price range (Parameterized values for flexibility)
-- SELECT * FROM products WHERE price >= lower_limit AND price <= upper_limit;

-- Define the lower and upper limits for the price range
SET @lower_limit = 10.00;
SET @upper_limit = 50.00;

-- Create a temporary table to store the results
CREATE TEMPORARY TABLE TempTable (
    product_id INT,
    product VARCHAR(255),
    price DECIMAL(10, 2)
);

-- Insert the products within the specified price range into the temporary table
INSERT INTO TempTable (product_id, product, price)
SELECT product_id, product, price
FROM product
WHERE price >= @lower_limit AND price <= @upper_limit;

-- Retrieve the results from the temporary table
SELECT * FROM TempTable;

-- Drop the temporary table
DROP TEMPORARY TABLE TempTable;

-- Querying orders for a specific user
SELECT * FROM orders 
WHERE user_id = 1;

-- Retrieve all publishers
SELECT * FROM publishers;

-- Retrieve all developers
SELECT * FROM developers;

-- Retrieve products with their publisher and developer names
SELECT p.title, p.description, p.price, p.genre_id, p.console_type_id, pub.name AS publisher_name, dev.name AS developer_name
FROM products p
JOIN publishers pub ON p.publisher_id = pub.publisher_id
JOIN developers dev ON p.developer_id = dev.developer_id;
