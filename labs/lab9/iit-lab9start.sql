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

CREATE TABLE IF NOT EXISTS actors (
    actorid INT AUTO_INCREMENT PRIMARY KEY,
    first VARCHAR(100) NOT NULL,
    last VARCHAR(100) NOT NULL,
    dob DATE NOT NULL
);

INSERT INTO actors (actorid, first, last, dob) VALUES
(1, 'Cate', 'Blanchett', '1969-05-14'),
(2, 'Scarlett', 'Johansson', '1984-11-22'),
(3, 'George', 'Clooney', '1961-05-06'),
(4, 'Holly', 'Hunter', '1958-03-20'),
(5, 'John', 'Turturro', '1957-02-28'),
(6, 'Elijah', 'Wood', '1981-01-28'),
(7, 'Joseph', 'Fiennes', '1970-05-27'),
(8, 'Geoffrey', 'Rush', '1951-07-06');

-- --------------------------------------------------------
-- Table: movie_actors
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS movie_actors (
    movieid INT NOT NULL,
    actorid INT NOT NULL,
    PRIMARY KEY (movieid, actorid),
    FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
    FOREIGN KEY (actorid) REFERENCES actors(actorid) ON DELETE CASCADE
);

INSERT INTO movie_actors (movieid, actorid) VALUES
(1, 1), -- Elizabeth  Cate Blanchett
(1, 7), -- Elizabeth  Joseph Fiennes
(1, 8), -- Elizabeth  Geoffrey Rush

(2, 2), -- Black Widow  Scarlett Johansson

(3, 3), -- Oh Brother Where Art Thou? George Clooney
(3, 4), -- Oh Brother Where Art Thou? Holly Hunter
(3, 5), -- Oh Brother Where Art Thou? John Turturro

(4, 1), -- Fellowship of the Ring Cate Blanchett
(4, 6), -- Fellowship of the Ring Elijah Wood

(5, 3); -- Up in the Air George Clooney
