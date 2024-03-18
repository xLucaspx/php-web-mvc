CREATE SCHEMA IF NOT EXISTS `php_serenatto`;
USE `php_serenatto`;

CREATE TABLE `users` (
	`id` INT AUTO_INCREMENT NOT NULL,
	`email` VARCHAR (75) NOT NULL,
	`password_hash` VARCHAR(255),
	PRIMARY KEY (`id`, `email`)
);

CREATE TABLE `types` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`type` VARCHAR(25) NOT NULL
);

CREATE TABLE `products` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	-- `tipo` ENUM ('Café', 'Almoço') NOT NULL,
	`type_id` INT NOT NULL,
	`name` VARCHAR(45) NOT NULL,
	`description` VARCHAR(90) NOT NULL,
	`image_url` VARCHAR(80),
	`price` DECIMAL(5, 2) NOT NULL,
	CONSTRAINT fk_tipo_produto FOREIGN KEY (`type_id`) REFERENCES `types` (`id`)
);

-- password: #senhaLucas01
INSERT INTO `users` (`email`, `password_hash`) VALUES ('lucas@serenatto.com', 'argon2id$v=19$m=65536,t=4,p=1$U3RnQWpOMnZ6b2xzdlVJQw$A35SP+01MlCnuPiKDcNa2sGQxYZSQolt0wBLmF4jtpw');

INSERT INTO `types` (`type`) VALUES
	('Café'), ('Almoço'), ('Lanches'), ('Sobremesas'), ('Sucos naturais');

INSERT INTO `products`
	(`type_id`, `name`, `description`, `image_url`, `price`)
VALUES
	(1, 'Café Cremoso', 'Café cremoso irresistivelmente suave e que envolve seu paladar', 'cafe-cremoso.jpg', 5),
	(1, 'Café com Leite', 'A harmonia perfeita do café e do leite, uma experiência reconfortante', 'cafe-com-leite.jpg', 2),
	(1, 'Cappuccino', 'Café suave, leite cremoso e uma pitada de sabor adocicado', 'cappuccino.jpg', 7),
	(1, 'Café Gelado', 'Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo', 'cafe-gelado.jpeg', 3),
	(2, 'Bife', 'Bife, arroz com feijão e uma deliciosa batata frita', 'bife.jpg', 27.9),
	(2, 'Filé de peixe', 'Filé de peixe salmão assado, arroz, feijão verde e tomate.', 'prato-peixe.jpg', 24.99),
	(2, 'Frango', 'Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante', 'prato-frango.jpg', 23),
	(2, 'Fettuccine', 'Prato italiano autêntico da massa do fettuccine com peito de frango grelhado', 'fettuccine.jpg', 22.5),
	(3, 'Pastel de Carne', 'Pastel de massa caseira frito na hora recheado com carne e ovo cozido', null, 8.5),
	(3, 'Pastel de Frango', 'Pastel de massa caseira frito na hora recheado com frango e queijo', null, 8.5),
	(3, 'Folhado de frango', 'Pastel folhado assado delicioso recheado de frango com catupiry', null, 8.75),
	(4, 'Petit Gateau', 'Bolo de chocolate cremoso servido acompanhado de sorvete de creme', null, 12.29),
	(4, 'Salada de frutas', 'Deliciosa e saudável salada de frutas, sempre fresca e apetitosa!', null, 6),
	(4, 'Quindim', 'O tradicional e amado quindim!', null, 7.25),
	(5, 'Suco de laranja', 'Delicioso suco de laranja, natural e bem gelado!', null, 7.5),
	(5, 'Suco de melancia', 'Disponível apenas no verão, refrescante suco natural de melancia', null, 9),
	(5, 'Suco de abacaxi com hortelã', 'O favorito dos clientes; natural, refrescante e saboroso', null, 7.5);

-- functions:
DELIMITER $$

CREATE FUNCTION countProductsByType(typeId INT)
RETURNS INT READS SQL DATA
BEGIN
	RETURN (SELECT COUNT(`id`) FROM `products` WHERE `type_id` = typeId);
END $$

CREATE FUNCTION getTypeAveragePrice(typeId INT)
	RETURNS DECIMAL(5, 2) READS SQL DATA
BEGIN
	DECLARE totalProducts INT;
	DECLARE priceSum DECIMAL(5,2);

	SELECT countProductsByType(typeId) INTO totalProducts;

	IF totalProducts = 0 THEN
		RETURN 0;
	END IF;

	SELECT COALESCE(SUM(`price`), 0) INTO priceSum FROM `products` WHERE `type_id` = typeId;

	RETURN priceSum / totalProducts;
END $$

DELIMITER ;
