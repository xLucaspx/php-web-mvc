<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Repository;

use PDO;
use PDOStatement;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\NewTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeReportDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\UpdateTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class PdoTypeRepository implements TypeRepository
{
	public function __construct(
		private PDO $connection
	) {}

	/** @return TypeDetailsDto[] */
	#[\Override]
	function all(): array
	{
		$sql = 'SELECT `id`, `type` FROM `types`';
		$statement = $this->connection->query($sql);

		return $this->hydrateTypeList($statement);
	}

	/** @return TypeReportDto[] */
	#[\Override]
	function allReport(): array
	{
		$sql = <<<END
			SELECT
				`id`,
				`type`,
				countproductsbytype(`id`) AS `total_products`,
				gettypeaverageprice(`id`) AS `average_price`
			FROM `types`
		END;

		$statement = $this->connection->query($sql);
		$data = $statement->fetchAll();

		$list = array_map(function (array $typeData) {
			[
				'id' => $id,
				'type' => $type,
				'total_products' => $totalProducts,
				'average_price' => $averagePrice
			] = $typeData;

			return new TypeReportDto($id, $type, $totalProducts, $averagePrice);
		}, $data);

		return $list;
	}

	#[\Override]
	function findById(int $id): TypeDetailsDto|false
	{
		$sql = 'SELECT `id`, `type` FROM `types` WHERE `id` = :id';
		$statement = $this->connection->prepare($sql);
		$statement->bindValue('id', $id);

		$statement->execute();
		$data = $statement->fetch();

		if (!$data) {
			return false;
		}

		return new TypeDetailsDto($id, $data['type']);
	}

	#[\Override]
	function add(NewTypeDto $data): bool
	{
		$sql = 'INSERT INTO `types` (`type`) VALUES (:type)';
		$statement = $this->connection->prepare($sql);

		return $statement->execute(['type' => $data->type]);
	}

	#[\Override]
	function update(UpdateTypeDto $data): bool
	{
		$sql = 'UPDATE `types` SET `type` = :type WHERE `id` = :id';
		$statement = $this->connection->prepare($sql);

		$statement->bindValue(':type', $data->type);
		$statement->bindValue(':id', $data->id, PDO::PARAM_INT);

		return $statement->execute();
	}

	#[\Override]
	function delete(int $id): bool
	{
		$statement = $this->connection->prepare("DELETE FROM `types` WHERE `id` = :id");
		return $statement->execute(['id' => $id]);
	}

	/** @return TypeDetailsDto[] */
	private function hydrateTypeList(PDOStatement $statement): array
	{
		$data = $statement->fetchAll();

		$list = array_map(function (array $typeData) {
			['id' => $id, 'type' => $type,] = $typeData;

			return new TypeDetailsDto($id, $type);
		}, $data);

		return $list;
	}
}
