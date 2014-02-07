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


/* Table catalogue */
CREATE TABLE IF NOT EXISTS catalogue (
  id int(11) NOT NULL AUTO_INCREMENT,
  userId int(11) NOT NULL
  COMMENT "CONSTRAINT FOREIGN KEY (userId) REFERENCES user(id)",
  description TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB ;


/* Table book */
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogueId` int(11) NOT NULL COMMENT 'CONSTRAINT FOREIGN KEY (catalogueId) REFERENCES catalogue(id)',
  `title` varchar(250) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `author` varchar(250) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `description` text,
  `editor` varchar(250) DEFAULT NULL,
  `publication` date DEFAULT NULL,
  `isbn` int(13) DEFAULT NULL,
  `epub` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;