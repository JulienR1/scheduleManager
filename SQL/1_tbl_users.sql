CREATE TABLE Users(
id MEDIUMINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
firstname TINYTEXT NOT NULL,
lastname TINYTEXT NOT NULL,
email TINYTEXT NOT NULL,
pwd LONGTEXT NOT NULL,
creationDate DATE NOT NULL,
isAdmin BOOL NOT NULL DEFAULT FALSE,
isActive BOOL NOT NULL DEFAULT FALSE,
img TINYTEXT
);