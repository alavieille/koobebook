CREATE TABLE IF NOT EXISTS user (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(20) NOT NULL,
  email varchar(128) NOT NULL,
  password varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB

INSERT INTO user (username, password, email) VALUES ('test1', 'pass1', 'test1@example.com');
INSERT INTO user (username, password, email) VALUES ('test2', 'pass2', 'test2@example.com');
INSERT INTO user (username, password, email) VALUES ('test3', 'pass3', 'test3@example.com');
INSERT INTO user (username, password, email) VALUES ('test4', 'pass4', 'test4@example.com');
INSERT INTO user (username, password, email) VALUES ('test5', 'pass5', 'test5@example.com');
INSERT INTO user (username, password, email) VALUES ('test6', 'pass6', 'test6@example.com');
INSERT INTO user (username, password, email) VALUES ('test7', 'pass7', 'test7@example.com');
INSERT INTO user (username, password, email) VALUES ('test8', 'pass8', 'test8@example.com');
