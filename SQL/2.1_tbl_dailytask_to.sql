CREATE TABLE dayToDailytask(
	targetDate DATE NOT NULL,
    dailyTaskID MEDIUMINT NOT NULL
);

CREATE TABLE dailytaskToUser(
	dailytaskID MEDIUMINT NOT NULL,
    userID MEDIUMINT NOT NULL
);

ALTER TABLE daytodailytask
ADD FOREIGN KEY (dailytaskID) REFERENCES dailytask(id);

ALTER TABLE dailytasktouser
ADD FOREIGN KEY (userID) REFERENCES users(id);


ALTER TABLE dailytasktouser
ADD FOREIGN KEY (dailytaskID) REFERENCES dailytask(id);