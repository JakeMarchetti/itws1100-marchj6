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


