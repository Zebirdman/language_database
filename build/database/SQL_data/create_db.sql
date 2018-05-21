CREATE SCHEMA `database`;
USE `database`;
CREATE USER 'language_user'@'%' IDENTIFIED BY '.Hudeg9m5';
GRANT ALL PRIVILEGES ON `database` . * TO 'language_user'@'%';
flush privilages;
