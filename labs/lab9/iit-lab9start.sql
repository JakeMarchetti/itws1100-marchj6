-- create the tables for our movies
CREATE TABLE `movies` (
   `movieid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` varchar(100) NOT NULL,
   `year` char(4) DEFAULT NULL,
   PRIMARY KEY (`movieid`)
);
-- insert data into the tables
INSERT INTO movies
VALUES (1, "Elizabeth", "1998"),
   (2, "Black Widow", "2021"),
   (3, "Oh Brother Where Art Thou?", "2000"),
   (
      4,
      "The Lord of the Rings: The Fellowship of the Ring",
      "2001"
   ),
   (5, "Up in the Air", "2009");

CREATE TABLE actors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first VARCHAR(100) NOT NULL,
    last VARCHAR(100) NOT NULL,
    dob DATE NOT NULL
);

INSERT INTO actors (first, last, dob) VALUES
('Cate', 'Blanchett', '1969-05-14'),
('Scarlett', 'Johansson', '1984-11-22'),
('George', 'Clooney', '1961-05-06'),
('Holly', 'Hunter', '1958-03-20'),
('John', 'Turturro', '1957-02-28'),
('Elijah', 'Wood', '1981-01-28'),
('Joseph', 'Fiennes', '1970-05-27'),
('Geoffrey', 'Rush', '1951-07-06');

SELECT * 
FROM actors
WHERE dob >= '1960-01-01';

CREATE TABLE movie_actors (
    movieid INT NOT NULL,
    actorid INT NOT NULL,
    PRIMARY KEY (movieid, actorid),
    FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
    FOREIGN KEY (actorid) REFERENCES actors(actorid) ON DELETE CASCADE
);

INSERT INTO movie_actors (movie_id, actor_id) VALUES
INSERT INTO movie_actors (movieid, actorid) VALUES
(1, 1), -- Elizabeth -> Cate Blanchett
(1, 7), -- Elizabeth -> Joseph Fiennes
(1, 8), -- Elizabeth -> Geoffrey Rush
(2, 2), -- Black Widow -> Scarlett Johansson
(3, 3), -- O Brother Where Art Thou? -> George Clooney
(3, 4), -- O Brother Where Art Thou? -> Holly Hunter
(3, 5), -- O Brother Where Art Thou? -> John Turturro
(4, 1), -- Fellowship of the Ring -> Cate Blanchett
(4, 6), -- Fellowship of the Ring -> Elijah Wood
(5, 3); -- Up in the Air -> George Clooney

SELECT m.title, a.first, a.last
FROM movies m
JOIN movie_actors ma ON m.movieid = ma.movieid
JOIN actors a ON a.actorid = ma.actorid
ORDER BY m.title, a.last, a.first;