-- 1. Create the database
CREATE DATABASE idojaras_jelentes;

-- 2. Use the database
USE idojaras_jelentes;

-- 3. Create the `news` table
CREATE TABLE varosok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    lakossag DECIMAL(5, 2) NOT NULL
);

-- 4. Create the `comments` table
CREATE TABLE idojaras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    varos_id INT NOT NULL,
    datum VARCHAR(100),
    homerseklet VARCHAR(100) ,
    FOREIGN KEY (varos_id) REFERENCES varosok(id) ON DELETE CASCADE
);

-- 5. Insert sample data into the `news` table
INSERT INTO varosok (nev, lakossag)
VALUES 
('London', 8.9),
('Parizs', 7.9),
('Budapest', 1.9);

-- 6. Insert sample data into the `comments` table
INSERT INTO idojaras (varos_id, datum, homerseklet)
VALUES 
(1, '2002.12.1', '5 C'),
(2, '2005.2.1', '20 C'),
(2, '2012.1.1', '9 C');
