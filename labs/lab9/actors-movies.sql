DROP TABLE IF EXISTS movie_actors;

CREATE TABLE IF NOT EXISTS movie_actors (
    movieid INT(10) UNSIGNED NOT NULL,
    actorid INT NOT NULL,
    PRIMARY KEY (movieid, actorid),
    CONSTRAINT fk_movieactors_movie
        FOREIGN KEY (movieid) REFERENCES movies(movieid)
        ON DELETE CASCADE,
    CONSTRAINT fk_movieactors_actor
        FOREIGN KEY (actorid) REFERENCES actors(actorid)
        ON DELETE CASCADE
) ENGINE=InnoDB;
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