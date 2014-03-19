/* Tablea user */
CREATE TABLE IF NOT EXISTS user (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(20) NOT NULL,
  email varchar(128) NOT NULL,
  password varchar(128) NOT NULL,
  temp_password varchar(128) DEFAULT NULL,
  date_tmp_password datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB ;



CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT 'CONSTRAINT FOREIGN KEY (userId) REFERENCES user(id)',
  `name` varchar(50) NOT NULL,
  `firstName` varchar(40) DEFAULT NULL,
  `description` text,
  `isAuthor` tinyint(1) NOT NULL DEFAULT '0',
  `isEditor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogueId` int(11) DEFAULT NULL COMMENT 'CONSTRAINT FOREIGN KEY (catalogueId) REFERENCES catalogue(id)',
  `title` varchar(250) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `author` varchar(250) NOT NULL,
  `language` varchar(200) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `description` text,
  `publication` date DEFAULT NULL,
  `date_create` date NOT NULL,
  `isbn` int(13) DEFAULT NULL,
  `push` tinyint(1) NOT NULL DEFAULT '0',
  `epub` varchar(250) DEFAULT NULL,
  `mobi` varchar(250) DEFAULT NULL,
  `pdf` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `library` (
  `userId` int(11) NOT NULL COMMENT 'CONSTRAINT FOREIGN KEY (userId) REFERENCES user(id)'
  `bookId` int(11) NOT NULL COMMENT 'CONSTRAINT FOREIGN KEY (bookId) REFERENCES book(id)',
) ENGINE=InnoDB