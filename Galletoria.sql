DROP DATABASE IF EXISTS galletoria;
CREATE DATABASE galletoria;
USE galletoria;

CREATE TABLE usuarios (
id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nick VARCHAR(40) NOT NULL,
cantidadGalletas INT NOT NULL DEFAULT(0),
cpc INT NOT NULL DEFAULT(1),
galletoriers INT NOT NULL DEFAULT(0),
ultimaCon DATETIME NOT NULL,
galletoriersAfk decimal NOT NULL DEFAULT(0)
);

INSERT INTO usuarios (nick, cantidadGalletas, ultimaCon) VALUES ("guga", 150, now());