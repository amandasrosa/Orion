CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `flag_admin` boolean NOT NULL DEFAULT 0,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `active` boolean NOT NULL DEFAULT 1,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `optionA` varchar(200) DEFAULT NULL,
  `optionB` varchar(200) DEFAULT NULL,
  `optionC` varchar(200) DEFAULT NULL,
  `optionD` varchar(200) DEFAULT NULL,
  `answer` enum('a','b','c','d') DEFAULT NULL,
  `active` boolean NOT NULL DEFAULT 1,
  PRIMARY KEY (`question_id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` int(2) NOT NULL,
  `testDate` date NOT NULL,
  PRIMARY KEY (`result_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO user (flag_admin, username, password, first_name, last_name, email, phone)
VALUES (1,"amanda","brazil","Amanda","Rosa","amanda@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (1,"denis","brazil","Denis","Gois","denis@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (1,"araceli","brazil","Araceli","Teixeira","araceli@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (0,"user","user","Robert","Smith","user@lambton.com","6475555555");