CREATE DATABASE IF NOT EXISTS dwes07;
USE dwes07;
DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario (
  id INT AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

-- Pass 1234
INSERT INTO usuario (id, nombre, pass) VALUES (1, "Usuario1", "$2y$10$/iA4EmrZomQaaRunBI62ne2JfmbxdY/o9dZNTI3QMkUrOjv8g7mJq");

-- Pass 4321
INSERT INTO usuario (id, nombre, pass) VALUES (2, "Usuario2", "$2y$10$jN.zmPfIMmRrdN3kcsFLJeucweMfszkLb0niowOhcl6d9M5.oT/1O");

CREATE TABLE usuariosg (
  id INT AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);


DROP TABLE IF EXISTS `auth_tokens`;

CREATE TABLE `auth_tokens` (
    `id` integer(11) not null AUTO_INCREMENT,
    `token` char(33),
    `userid` integer(11) not null,
    `expires` datetime, -- or datetime
    PRIMARY KEY (`id`)
);

INSERT INTO `auth_tokens` (token, userid, expires) VALUES('98a8a61f4583f87bb0361b355db95274ba0de3eec824b81b7932fbb57605',1, now() + INTERVAL 1 DAY);
INSERT INTO `auth_tokens` (token, userid, expires) VALUES('f54fe1b07affbc49c9f54a6dc81a03444e5ecbcf38cc80746705880beff7',1, now() + INTERVAL 1 DAY);
INSERT INTO `auth_tokens` (token, userid, expires) VALUES('ea07efd83224eae01a41535499ff13ddcadfb52e73de158787e507bdbccf',2, now() + INTERVAL 1 DAY);
INSERT INTO `auth_tokens` (token, userid, expires) VALUES('820a1422b23df434751733efb31820ae0f9f080ad80236d18e5ca4aa581f',2, now() + INTERVAL 1 DAY);

GRANT ALL PRIVILEGES ON dwes07.* TO 'usu_bbdd'@'localhost';
FLUSH PRIVILEGES;