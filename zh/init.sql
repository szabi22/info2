
USE film_ratings;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    release_year INT NOT NULL
);

CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

INSERT INTO movies (title, release_year) VALUES
    ('Shrek', 2001),
    ('Thor', 2011),
    ('Dune', 2021);

INSERT INTO ratings (movie_id, user_name, score) VALUES
    (1, 'Péter', 3),
    (1, 'Anna', 4),
    (1, 'Tamás', 2),
    (2, 'Péter', 5),
    (2, 'Anna', 4),
    (2, 'Zoltán', 3);
