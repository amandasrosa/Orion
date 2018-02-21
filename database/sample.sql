INSERT INTO user (flag_admin, username, password, first_name, last_name, email, phone)
VALUES (1,"amanda","brazil","Amanda","Rosa","amanda@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (1,"denis","brazil","Denis","Gois","denis@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (1,"araceli","brazil","Araceli","Teixeira","araceli@lambton.com","6475555555");
INSERT INTO user (flag_admin, username, password, first_name, last_name,  email, phone)
VALUES (0,"user","user","Robert","Smith","user@lambton.com","6475555555");

INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (1,1,8,NOW(),'DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (2,1,0,NOW(),'ABORTED');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (3,1,0,'2018-01-10','DOING');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (4,1,2,'2018-02-10','DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (1,2,0,'2018-01-20','ABORTED');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (2,2,0,'2018-02-15','DOING');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (3,2,8,'2018-01-05','DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (4,1,0,'2018-01-12','ABORTED');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (1,1,8,2018-01-02,'DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (2,1,0,2018-01-03,'ABORTED');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (3,1,0,'2018-01-11','DOING');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (4,1,2,'2018-02-13','DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (1,2,0,NOW(),'ABORTED');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (2,2,0,NOW(),'DOING');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (3,2,8,'2018-01-16','DONE');
INSERT INTO `result`(`user_id`, `subject_id`, `grade`, `testDate`, `status`) VALUES (4,1,0,'2018-01-02','ABORTED');