CREATE SCHEMA IF NOT EXISTS `php_serenatto`;
USE `php_serenatto`;

CREATE TABLE `produtos` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`tipo` ENUM ('Café', 'Almoço') NOT NULL,
	`nome` VARCHAR(45) NOT NULL,
	`descricao` VARCHAR(90) NOT NULL,
	`url_imagem` VARCHAR(80) NOT NULL,
	`preco` DECIMAL(5, 2) NOT NULL
);



INSERT INTO `produtos`
	(`tipo`, `nome`, `descricao`, `url_imagem`, `preco`)
VALUES
	(1, 'Café Cremoso', 'Café cremoso irresistivelmente suave e que envolve seu paladar', 'cafe-cremoso.jpg', 5.00),
	(1, 'Café com Leite', 'A harmonia perfeita do café e do leite, uma experiência reconfortante', 'cafe-com-leite.jpg', 2.00),
	(1, 'Cappuccino', 'Café suave, leite cremoso e uma pitada de sabor adocicado', 'cappuccino.jpg', 7.00),
	(1, 'Café Gelado', 'Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo.', 'cafe-gelado.jpg', 3.00),
	(2, 'Bife', 'Bife, arroz com feijão e uma deliciosa batata frita', 'bife.jpg', 27.90),
	(2, 'Filé de peixe', 'Filé de peixe salmão assado, arroz, feijão verde e tomate.', 'prato-peixe.jpg', 24.99),
	(2, 'Frango', 'Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante', 'prato-frango.jpg', 23.00),
	(2, 'Fettuccine', 'Prato italiano autêntico da massa do fettuccine com peito de frango grelhado', 'fettuccine.jpg', 22.50);
