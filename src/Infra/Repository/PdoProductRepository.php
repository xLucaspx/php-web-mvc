<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Repository;

use PDO;
use PDOStatement;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\NewProductDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\ProductDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\UpdateProductDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;

class PdoProductRepository implements ProductRepository
{
	public function __construct(
		private PDO $connection
	) {}

	/** @return ProductDetailsDto[] */
	#[\Override]
	function all(): array
	{
		$sql = <<<END
			SELECT
				p.id, t.type, p.name, p.description, p.image_url, p.price
			FROM products p
				INNER JOIN types t ON p.type_id = t.id
			ORDER BY type, price
		END;
		$statement = $this->connection->query($sql);

		return $this->hydrateProductList($statement);
	}

	/** @return ProductDetailsDto[] */
	#[\Override]
	function allByType(TypeDetailsDto $type): array
	{
		$sql = <<<END
			SELECT
				p.id, t.type, p.name, p.description, p.image_url, p.price
			FROM products p
				INNER JOIN types t ON p.type_id = t.id
			WHERE t.id = :typeId
			ORDER BY type, price
		END;
		$statement = $this->connection->prepare($sql);
		$statement->execute(['typeId' => $type->id]);

		return $this->hydrateProductList($statement);
	}

	#[\Override]
	function findById(int $id): ProductDetailsDto|false
	{
		$sql = <<<END
			SELECT
				t.type, p.name, p.description, p.image_url, p.price
			FROM products p
				INNER JOIN types t ON p.type_id = t.id
			WHERE p.id = :productId
		END;
		$statement = $this->connection->prepare($sql);
		$statement->bindValue('productId', $id);

		$statement->execute();
		$productData = $statement->fetch();

		if (!$productData) {
			return false;
		}

		[
			'type' => $type,
			'description' => $description,
			'name' => $name,
			'image_url' => $imageUrl,
			'price' => $price
		] = $productData;
		return new ProductDetailsDto($id, $type, $name, $description, $imageUrl, $price);
	}

	#[\Override]
	function add(NewProductDto $data): bool
	{
		$sql = <<<END
			INSERT INTO products
				(`type_id`, `name`, `description`, `image_url`, `price`)
			VALUES
				(:typeId, :name, :description, :imageUrl, :price)
		END;

		$statement = $this->connection->prepare($sql);

		return $statement->execute([
			'typeId' => $data->typeId,
			'name' => $data->name,
			'description' => $data->description,
			'imageUrl' => $data->imageUrl,
			'price' => $data->price
		]);
	}

	#[\Override]
	function update(UpdateProductDto $data): bool
	{
		$updateImageSql = $data->imageUrl ? ', `image_url` = :imageUrl' : '';
		$sql = <<<END
			UPDATE products SET 
				`type_id` = :typeId,
				`name` = :name,
				`description` = :description,
				`price` = :price
				$updateImageSql
			WHERE `id` = :id
		END;
		$statement = $this->connection->prepare($sql);

		$statement->bindValue('typeId', $data->typeId);
		$statement->bindValue('name', $data->name);
		$statement->bindValue('description', $data->description);
		$statement->bindValue('price', $data->price);
		$statement->bindValue('id', $data->id, PDO::PARAM_INT);

		if ($data->imageUrl) {
			$statement->bindValue(':imageUrl', $data->imageUrl);
		}

		return $statement->execute();
	}

	#[\Override]
	function delete(int $id): bool
	{
		$statement = $this->connection->prepare("DELETE FROM `products` WHERE `id` = :id");
		return $statement->execute(['id' => $id]);
	}

	/** @return ProductDetailsDto[] */
	private function hydrateProductList(PDOStatement $statement): array
	{
		$data = $statement->fetchAll();

		$list = array_map(function (array $productData) {
			[
				'id' => $id,
				'type' => $type,
				'description' => $description,
				'name' => $name,
				'image_url' => $imageUrl,
				'price' => $price
			] = $productData;

			return new ProductDetailsDto($id, $type, $name, $description, $imageUrl, $price);
		}, $data);

		return $list;
	}
}
