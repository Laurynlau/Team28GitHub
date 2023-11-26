-- DML Evan Leach 220085087 Team 28
-- Populate the users table
INSERT INTO users (username, email, password, user_role) 
VALUES ('evan_leach', 'evanteam28@aston.com', 'hashed_password', 'customer');

-- Populate the products table
INSERT INTO products (title, description, price, genre, console_type, publisher, developer, stock_quantity, image_path) 
VALUES 
('The Legend of Zelda: Breath of the Wild', 'Adventure game for Nintendo Switch', 45.99, 'Adventure', 'Nintendo Switch', 'Nintendo', 'Nintendo', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zelda.jpg?raw=true'),
('Journey', 'Adventure game for PlayStation, PC', 14.99, 'Adventure', 'PlayStation, PC', 'Sony Interactive Entertainment', 'Santa Monica Studio', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Journey.jpg?raw=true'),
('Uncharted 4: A Thief’s End', 'Adventure game for PlayStation', 45.99, 'Adventure', 'PlayStation', 'Sony Interactive Entertainment', 'Naughty Dog', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/uncharted4.jpg?raw=true'),
('Firewatch', 'Adventure game for PlayStation, Xbox, PC', 14.99, 'Adventure', 'PlayStation, Xbox, PC', 'Panic', 'Campo Santo', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/firewatch.jpeg?raw=true'),
('Stardew Valley', 'Adventure game for Multiple Platforms', 11.99, 'Adventure', 'PlayStation, Xbox, PC, Nintendo Switch', 'ConcernedApe', 'ConcernedApe', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/stardewvalley.png?raw=true'),
-- Board Games
('Catan Universe', 'Board game for Multiple Platforms', 0.00, 'Board', 'PlayStation, Xbox, PC, Nintendo Switch', 'United Soft Media', 'Exozet', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Catan_Universe.jpg?raw=true'),
('Ticket to Ride', 'Board game for Multiple Platforms', 14.99, 'Board', 'PlayStation, Xbox, PC, Nintendo Switch', 'Days of Wonder', 'Days of Wonder', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/ticket_to_ride.jpg?raw=true'),
('Splendor', 'Board game for Multiple Platforms', 8.50, 'Board', 'PlayStation, Xbox, PC, Nintendo Switch', 'Space Cowboys', 'Asmodee Digital', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/splendor.jpg?raw=true'),
('Carcassonne', 'Board game for Multiple Platforms', 3.99, 'Board', 'PlayStation, Xbox, PC, Nintendo Switch', 'Hans im Glück', 'Asmodee Digital', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/carcassonne.jpg?raw=true'),
('Pandemic: The Board Game', 'Board game for Multiple Platforms', 0.99, 'Board', 'PlayStation, Xbox, PC, Nintendo Switch', 'Z-Man Games', 'Asmodee Digital', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/pandemic.jpg?raw=true'),
-- Puzzle Games
('Tetris Effect', 'Puzzle game for Multiple Platforms', 19.99, 'Puzzle', 'PlayStation, Xbox, PC, Nintendo Switch', 'Enhance Games', 'Monstars Inc., Resonair', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Tetris.jpg?raw=true'),
('Portal 2', 'Puzzle game for Multiple Platforms', 8.50, 'Puzzle', 'PlayStation, Xbox, PC, Nintendo Switch', 'Valve Corporation', 'Valve Corporation', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Portal2cover.jpg?raw=true'),
('The Witness', 'Puzzle game for Multiple Platforms', 9.99, 'Puzzle', 'PlayStation, Xbox, PC, Nintendo Switch', 'Thekla, Inc.', 'Thekla, Inc.', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thewitness.jpg?raw=true'),
('Monument Valley', 'Puzzle game for Multiple Platforms', 6.99, 'Puzzle', 'PlayStation, Xbox, PC, Nintendo Switch', 'Ustwo', 'Ustwo', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/monumentvalley.jpg?raw=true'),
('Baba Is You', 'Puzzle game for Multiple Platforms', 14.99, 'Puzzle', 'PlayStation, Xbox, PC, Nintendo Switch', 'Hempuli', 'Hempuli', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/baba.jpg?raw=true'),
-- Simulation Games
('The Sims 4', 'Simulation game for Multiple Platforms', 0.00, 'Simulation', 'PlayStation, Xbox, PC, Nintendo Switch', 'Electronic Arts', 'Maxis', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thesims.jpg?raw=true'),
('Cities: Skylines', 'Simulation game for Multiple Platforms', 7.49, 'Simulation', 'PlayStation, Xbox, PC, Nintendo Switch', 'Paradox Interactive', 'Colossal Order', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/citiesskylines.jpg?raw=true'),
('Microsoft Flight Simulator', 'Simulation game for PC, Xbox', 35.99, 'Simulation', 'PC, Xbox', 'Xbox Game Studios', 'Asobo Studio', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Microsoft_Flight_Simulator.png?raw=true'),
('Stellaris', 'Simulation game for Multiple Platforms', 10.49, 'Simulation', 'PlayStation, Xbox, PC, Nintendo Switch', 'Paradox Interactive', 'Paradox Development Studio', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Stellaris_cover.png?raw=true'),
('Planet Zoo', 'Simulation game for Multiple Platforms', 10.49, 'Simulation', 'PlayStation, Xbox, PC, Nintendo Switch', 'Frontier Developments', 'Frontier Developments', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zoo.jpeg?raw=true'),
-- Sports Games
('EA FC24', 'Sports game for Multiple Platforms', 29.99, 'Sports', 'PlayStation, Xbox, PC, Nintendo Switch', 'Electronic Arts', 'EA Vancouver', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/eafc24.jpeg?raw=true'),
('NBA 2K24', 'Sports game for Multiple Platforms', 22.49, 'Sports', 'PlayStation, Xbox, PC, Nintendo Switch', '2K Sports', 'Visual Concepts', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/nba2k24.png?raw=true'),
('Rocket League', 'Sports game for Multiple Platforms', 0.00, 'Sports', 'PlayStation, Xbox, PC, Nintendo Switch', 'Psyonix', 'Psyonix', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/rocket.jpeg?raw=true'),
('Wii Sports', 'Sports game for Nintendo Wii', 30.99, 'Sports', 'Nintendo Wii', 'Nintendo', 'Nintendo EAD', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/wii.jpeg?raw=true'),
('Mario Kart 8 Deluxe', 'Sports game for Nintendo Switch', 49.99, 'Sports', 'Nintendo Switch', 'Nintendo', 'Nintendo EAD', 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/mariokart8.jpg?raw=true');

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
-- Change to the desired genre
SELECT * FROM products WHERE genre = 'Adventure';

-- Change to query desired console
SELECT * FROM products WHERE console_type LIKE '%PlayStation%';

-- Change values to find desired price range
SELECT * FROM products WHERE price = 0.00 OR price BETWEEN [0.99] AND [49.99];

-- Selecting orders for a user
SELECT * FROM orders 
WHERE user_id = 1;

-- Populate the previous orders table
INSERT INTO previous_orders (user_id, order_id, order_date, total_price) 
VALUES (1, 1, '2023-01-15 08:00:00', 120.00);

-- Query to retrieve all publishers
SELECT * FROM publishers;

-- Query to retrieve all developers
SELECT * FROM developers;

-- Query to retrieve products with their publisher and developer
SELECT p.title, p.description, p.price, p.genre, p.console_type, pub.name AS publisher_name, dev.name AS developer_name
FROM products p
JOIN publishers pub ON p.publisher_id = pub.publisher_id
JOIN developers dev ON p.developer_id = dev.developer_id;
