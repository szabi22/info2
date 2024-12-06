-- 1. Create the database
CREATE DATABASE news_site;

-- 2. Use the database
USE news_site;

-- 3. Create the `news` table
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    publish_date DATE NOT NULL
);

-- 4. Create the `comments` table
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    author VARCHAR(100),
    content TEXT NOT NULL,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
);

-- 5. Insert sample data into the `news` table
INSERT INTO news (title, content, publish_date)
VALUES 
('New AI Tool Announced', 'Details about the new AI tool...', '2024-10-20'),
('AMD Releases New Processor', 'AMD unveiled its latest...', '2024-10-19');

-- 6. Insert sample data into the `comments` table
INSERT INTO comments (news_id, author, content)
VALUES 
(1, 'Peter', 'Great news!'),
(1, 'Emma', 'Looking forward to it.');
