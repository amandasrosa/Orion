CREATE DATABASE IF NOT EXISTS orion;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `flag_admin` boolean NOT NULL DEFAULT 0,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
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
  `status` enum('DOING','ABORTED','DONE') DEFAULT NULL,
  PRIMARY KEY (`result_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;