DROP TABLE IF EXISTS agenda;

CREATE TABLE agenda (
  id INT AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL,
  telefono VARCHAR(12) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO agenda (nombre, telefono) VALUES ('Jorge', '666006600');
