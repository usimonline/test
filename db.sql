CREATE TABLE IF NOT EXISTS `users` (
    `id` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `username` VARCHAR(255) NOT NULL,
    `salt` VARCHAR(100) NOT NULL
) ENGINE=INNODB;
