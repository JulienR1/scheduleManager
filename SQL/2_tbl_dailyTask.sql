CREATE TABLE dailyTask(
    id MEDIUMINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name TINYTEXT NOT NULL,
    targetStartTime TIME NOT NULL,
    targetEndTime TIME,
    targetQuantity TINYTEXT
);