CREATE TABLE books (
  id     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title  VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  year   INT NOT NULL,
  PRIMARY KEY (id)
);
 
INSERT INTO books (title, author, year) VALUES
('Il Nome della Rosa', 'Umberto Eco', 1980),
('Se questo è un uomo', 'Primo Levi', 1947),
('I Promessi Sposi', 'Alessandro Manzoni', 1827);