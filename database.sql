CREATE SCHEMA `contact_manager` ;
CREATE TABLE `contact_manager`.`contacts` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(255) NOT NULL,
      `email` VARCHAR(255) NULL,
      `phone` INT(11) NULL,
      `photo` VARCHAR(255) NULL,
      PRIMARY KEY (`id`)
);
