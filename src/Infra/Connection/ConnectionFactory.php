<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Connection;

class ConnectionFactory
{
	public static function getConnection(): \PDO
	{
		$connection = new \PDO('mysql:host=localhost;port=3306;dbname=php_serenatto', 'user01', 'admin');
		$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

		return $connection;
	}
}
