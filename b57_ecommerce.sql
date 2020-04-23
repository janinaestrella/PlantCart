CREATE DATABASE b57_ecommerce;

USE b57_ecommerce; 

-- Table structure for table `categories`

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE, 
   PRIMARY KEY (`id`)
); 

-- Table structure for table `products`

CREATE TABLE `products` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`price` FLOAT NOT NULL,
	`description` TEXT NOT NULL,
	`image` varchar(255) NOT NULL,
	`category_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

-- Table structure for table `payment_modes`

CREATE TABLE `payment_modes` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

-- Table structure for table `statuses`

CREATE TABLE `statuses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL, 
  PRIMARY KEY (`id`)
);

-- Table structure for table `roles`

CREATE TABLE `roles` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

-- Table structure for table `users`

CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL UNIQUE,
	`role_id` INT(255) NOT NULL,
	PRIMARY KEY (`id`)
);

-- Table structure for table `transactions`

CREATE TABLE `transactions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`transaction_code` varchar(255) NOT NULL,
	`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`total` FLOAT NOT NULL,
	`user_id` INT NOT NULL,
	`payment_mode_id` INT NOT NULL,
	`status_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `product_transactions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`quantity` INT NOT NULL,
	`transaction_id` INT NOT NULL,
	`product_id` INT NOT NULL,
	PRIMARY KEY (`id`)
); 

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`);

ALTER TABLE `products` ADD CONSTRAINT `products_fk0` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`);

ALTER TABLE `transactions` ADD CONSTRAINT `transactions_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `transactions` ADD CONSTRAINT `transactions_fk1` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_modes`(`id`);

ALTER TABLE `transactions` ADD CONSTRAINT `transactions_fk2` FOREIGN KEY (`status_id`) REFERENCES `statuses`(`id`);

ALTER TABLE `product_transactions` ADD CONSTRAINT `product_transactions_fk0` FOREIGN KEY (`transaction_id`) REFERENCES `transactions`(`id`);

ALTER TABLE `product_transactions` ADD CONSTRAINT `product_transactions_fk1` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`);


INSERT INTO `roles`(`name`) VALUES ('admin'),('user');
INSERT INTO `payment_modes`(`name`) VALUES ('Cash on Delivery'),('Over the Counter');
INSERT INTO `statuses`(`name`) VALUES ('Pending'),('Processing'),('Done'),('Rejected');
INSERT INTO `categories` (`name`) VALUES ('Accessories'), ('Gadget'), ('Clothes');

